<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\TestForm;

class TestController extends Controller {


    public function actionIndex() {
        $model = new TestForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('success', ['model'=>$model]);
        } else {
            return $this->render('error', ['model'=>$model]);
        }
    }

}