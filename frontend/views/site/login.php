<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
use derekisbusy\panel\PanelWidget;

$this->title = 'Login';

?>

<div class="site-login">

  <h1  class="text-center">เข้าสู่ระบบ</h1>
    <div class="row">
    	<div class="col-lg-5">
    	
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['class'=>'form-control border-input','autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control border-input']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                   
                </div>
           <?php ActiveForm::end(); ?>
           
    	</div> 
    	<div class="col-lg-2"></div>
    		<div class="col-lg-5"><br><?php  echo AuthChoice::widget(['baseAuthUrl' => ['site/auth']  ]);?><p> เข้าสู่ระบบด้วย facebook</p></div>
    
   	</div>  
   		
</div>
<!-- popup -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">เข้าสู่ระบบด้วย</h4>
        </div>
        <div class="modal-body">
        	<div class="col-md-5"></div>
					<?php  echo AuthChoice::widget(['baseAuthUrl' => ['site/auth']  ]);?>
			
	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
      </div>
      
    </div>
  </div>
