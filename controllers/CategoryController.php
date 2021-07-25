<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\Category;

class CategoryController extends Controller {


    public function actionIndex() {

        $this->view->title = 'category_index';
        $categories = Category::find()->all();
        return $this->render('index', compact('categories')); 
    }

    public function actionView($id) {
        
        if($id < 0){
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        $this->view->title = 'category_view';
        $categories = Category::find()->where(['category_id' => $id])->all();
        if($categories === []) throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        return $this->render('view', compact('categories')); 
    }

    public function actionShow($id) {
        
        if($id < 0){
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        $this->view->title = 'category_show';
        $categories = Category::find()->where(['parent_id' => $id])->all();
        if($categories === []) throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        return $this->render('show', compact('categories')); 
    }    

}