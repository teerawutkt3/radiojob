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
	<div class="jumbotron">
		<h2 class="text-center text-primary">เลือกสิทธิ์ในการใช้งาน</h2><br><br>
    		<div class="row">
    		
    					<div class="col-md-3"> </div>
    													<div class="col-md-3">
    																<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal"  data-target="#myModal">
    																			<h2>นักรังสีเทคนิค</h2><br>
    																</button>
    													</div>
    													<div class="col-md-3">
    																<button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal"  data-target="#myModal">
    																			<h2>โรงพยาบาล</h2><br>	
    																</button>
    													</div>
    					<div class="col-md-3">
    					</div>
    		</div>
		</div>
    <h1><?= Html::encode($this->title) ?></h1>

  
    <div class="row">
    	<div class="col-lg-5">
    	 <p>Please fill out the following fields to login:</p>
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
	    <div class="col-lg-5">
	     
		</div>  
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
