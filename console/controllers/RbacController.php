<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;


class RbacController extends Controller {
	
	/* public function actionInit(){
		$auth = Yii::$app->authManager;
		$auth->removeAll();
		Console::output('Removing All! RBAC.....');
		
		$manageUser = $auth->createRole('ManageUser');
		$manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
		$auth->add($manageUser);
		
		$author = $auth->createRole('Author');
		$author->description = 'สำหรับการเขียนบทความ';
		$auth->add($author);
		
		$management = $auth->createRole('Management');
		$management->description = 'สำหรับจัดการข้อมูลผู้ใช้งานและบทความ';
		$auth->add($management);
		
		$admin = $auth->createRole('Admin');
		$admin->description = 'สำหรับการดูแลระบบ';
		$auth->add($admin);
		
		$auth->addChild($management, $manageUser);
		$auth->addChild($management, $author);
		$auth->addChild($admin, $management);
		
		$auth->assign($admin, 1);
		$auth->assign($management, 2);
		$auth->assign($author, 3);
		
		Console::output('Success! RBAC roles has been added.');
	} */
		public function actionInit(){
		 $auth = Yii::$app->authManager;
		$auth->removeAll();
		Console::output('Removing All! RBAC.....');
		
		$admin = $auth->createRole('admin');
		$admin->description = 'ผู้จัดการสิดทธิ์การใช้งาน';
		$auth->add($admin);
		
		$radiolocal = $auth->createRole('radiolocal');
		$radiolocal->description = 'นักรังสีเทคนิค';
		$auth->add($radiolocal);
		
		$hospital = $auth->createRole('hospital');
		$hospital->description = 'โรงพยาบาล';
		$auth->add($hospital);
		
		
		$auth->assign($admin, 1);
		$auth->assign($hospital, 2);
		$auth->assign($radiolocal, 3); 
		Console::output('Success! RBAC roles has been added.');
		}
	
}
?>
