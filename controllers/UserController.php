<?php

namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use app\models\User;
use yii\web\Response;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
	
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
		return $behaviors;
	}
	public function actionSignin(){
		$username=Yii::$app->request->post('username');
		$password=Yii::$app->request->post('password');
		$user = User::findOne(['username'=>$username,'password'=>$password]);
		return $user;
	}
	public function actionSignup(){
		$user = new User();
		$username=Yii::$app->request->post('username');
		$password=Yii::$app->request->post('password');
		$user->username = $username;
		$user->password = $password;
		$user->save();
		return $user;
	}
	public function actionChangepassword(){
		$username=Yii::$app->request->post('username');
		$password=Yii::$app->request->post('password');
		$password_new=Yii::$app->request->post('password_new');
		$user = User::findOne(['username'=>$username,'password'=>$password]);
		$user->password = $password_new;
		$user->save();
		return $user;
	}
}