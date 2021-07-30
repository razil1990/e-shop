<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Cart;
use yii\helpers\Json;

class CartController extends Controller {

    public function actionIndex() {
        $this->view->title = 'cart_index';
        $cart = 'cart_orders';
        return $this->render('index', compact('cart')); 
    } 

    public function actionRequest() {
        if(Yii::$app->request->isAjax){
            $request = Yii::$app->request;
            $products = Cart::getProducts(Json::decode($request->bodyParams['products']));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $products;
        }
        return $this->render('index'); 
    }

}