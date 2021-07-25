<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;

class ProductController extends Controller {

    public function actionIndex() {

        $this->view->title = 'product';
        $products = Product::find()->all();
        return $this->render('index', compact('products')); 
    }

    public function actionView($id) {
        
        $this->view->title = 'current product';
        $products = Product::find()->where(['product_id' => $id])->all();
        if($products) {
            $title = $products[0]->category->title;
            define('TABLE', 'product_'. $title);
        } else {
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        return $this->render('view', compact('products')); 
    }

}