<?php
namespace frontend\controllers;

use Yii;
use common\models\Work;
use frontend\models\WorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\MyDate;
use common\components\Util;

/**
 * WorkController implements the CRUD actions for Work model.
 */
class WorkController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','view'],
                        'roles'=>['admin']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['create','delete','view','update','work','view-hospital'],
                        'roles'=>['hospital']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['view','index','mywork'],
                        'roles'=>['radiolocal']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['view','index','announce','view-ajax','work'],
                        'roles'=>['@']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['view','index','announce','view-ajax'],
                        'roles'=>['?']
                    ],
                ]
            ] 
        ];
    }

    /**
     * Lists all Work models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post() );
        $dataProvider->query->orderBy([      
            'money1'=> 'DESC'
        ]);
        
      //  var_dump($dataProvider->province); die();

     //   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    



    /**
     * Displays a single Work model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionHospital(){
        $searchModel = new WorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
        return $this->render('/work/hospital',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public  function actoinRadiolocal (){
        $this->render('work/radioloca');
    }
    
    public function actionViewAjax($id)
    {
        return $this->renderPartial('view-ajax', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewHospital($id)
    {
        return $this->renderPartial('view-hospital', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionWork(){
           //  $works = Work::find()->where(['user_id' => Yii::$app->user->id])->all();
      //  return $this->render('work',['works'=>$works ]);
      //  $searchModel =  WorkSearch::find()->where(['user_id'=>\Yii::$app->user->id])->all();
        $searchModel = new WorkSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('work', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Work model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Work();
                if ($model->load(Yii::$app->request->post()))
                {              $model->user_id = \Yii::$app->user->id;
               // var_dump($model); die();
                $model->time_begin = MyDate::Time2int( $model->time_begin);
                $model->time_end = MyDate::Time2int( $model->time_end);
               // var_dump($model); die();
                                
                                if ($model->save())
                                             return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
    }

    /**
     * Updates an existing Work model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
                if ($model->load(Yii::$app->request->post()) ) {
                              $model->user_id = \Yii::$app->user->id;
                              $model->time_begin = MyDate::Time2int( $model->time_begin);
                              $model->time_end = MyDate::Time2int( $model->time_end);
                     //         echo $model->time_begin; die();
                           if ($model->save()){
                               
                                  return $this->redirect(['view', 'id' => $model->id]);
                              }
                } else {    
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
    }
 

    /**
     * Deletes an existing Work model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Work model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Work the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Work::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
  
}
