<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\RegisterForm;
use app\models\Testuser;
class RegisterController extends Controller {


    public function actionIndex() {

        $model = new RegisterForm;
        if (Yii::$app->request->isPost) {

             $request = Yii::$app->request->post('RegisterForm');
             $test = new Testuser();
                $test->login = $request['login'];
                $test->password_hash = Yii::$app->getSecurity()->generatePasswordHash($request['password']);
                $test->user_hash = Yii::$app->getSecurity()->generatePasswordHash('abcd@#$');
                $test->save();
                debug($request);
                return 'test';

        }
        return $this->render('index', ['model' => $model]);
    }
    
}