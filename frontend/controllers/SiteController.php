<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use common\models\Work;
use frontend\models\WorkSearch;
use common\models\AuthAssignment;
use common\models\AuthItem;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * 
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    

    
    public function successCallback($client){
        
        $attributes = $client->getUserAttributes();
        //var_dump($attributes);
        //die();
        if ($attributes){
            $user = User::find()
            ->where(['fb_id'=>$attributes['id']])
            //	->orWhere(['gmail_id'=>$attributes['id']])
            ->one();
            if (!$user){
                if (isset($attributes['isPlusUser'])){
                    $user = new User();
                    $user->fname = $attributes['displayName'];
                    //		$user->gmail_id = $attributes['id'];
                    $user->email = $attributes['emails'][0]['value'];
                    $user->username = $attributes['emails'][0]['value'];
                    Yii::$app->session->set('user_signup', $user);
                    Yii::$app->response->redirect([
                        "/site/register",
                        'model' =>$user
                    ]);
                }else{
                    $user = new User();
                    $user->fname = $attributes['name'];
                    $user->fb_id = $attributes['id'];
                    $user->email = !isset($attributes['email'])?"":$attributes['email'];
                    $user->username = !isset($attributes['email'])?"":$attributes['email'];
                    \Yii::$app->session->set('user_signup', $user);
                    Yii::$app->response->redirect([
                        "/site/register",
                        'model' =>$user
                    ]);
                }
            }else{
                return Yii::$app->user->login($user,0 );
            }
        }else{
            echo "Wrong login format<br>";
            var_dump($attributes);
            die();
        }
    }
    /* action Register */
    public function actionRegister()
    {
        $this->layout = 'popup';
       // $authitem = new AuthItem();
        $model = new User();
        $authassignment = new AuthAssignment();
        if ($model->load(Yii::$app->request->post())) {
           
            if ($model->save()) {
                if (Yii::$app->getUser()->login($model)) {
                    
                    echo "<script>";
                    echo "window.close();";
                    echo "window.opener.location.reload();";
                    echo "</script>";
                  
                }
            }
        }
        if (!Yii::$app->session->get('user_signup')) return $this->redirect("login");
        $model = Yii::$app->session->get('user_signup');
        return $this->render('register', [
            'model' => $model,
            'authassignment'=>$authassignment,
         //   'authitem' => $authitem
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                //	var_dump('1','3'), die(),
                'class' => 'yii\authclient\AuthAction',
                
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      //   $works = Work::find()->where(['user_id' => Yii::$app->user->id])->all();
         $searchModel =   new WorkSearch();
     /*    foreach ($searchModel as $s ):
                    echo "Work : ".$s->id;
                    echo "<br> User id: ".$s->user_id."<br>";
                    
        endforeach; die(); */
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
         $dataProvider->query->andFilterWhere([
             'user_id'=> \Yii::$app->user->id 
         ]);

   
        if (\Yii::$app->user->can('hospital')) {
            return $this->render('/work/hospital',[
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
           ] );
        }
        else if(\Yii::$app->user->can('radiolocal')) return $this->render('/work/radiolocal');
        else 
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
