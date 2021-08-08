<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Cart;
use yii\helpers\Json;
use app\models\CartForm;

class CartController extends Controller {

    public function actionIndex() {
        $this->view->title = 'cart_index';
        $cart = 'cart_orders';
        $model = new CartForm();
        
        // if($model['order']) {
            debug($model);die;
            return $this->render('index', ['model' => $model]);
        // }
        // $empty = 1;
        // return $this->render('index', compact('empty'));
    } 

    public function actionRequest() {
        if(Yii::$app->request->isAjax){
            $request = Yii::$app->request;
            $products = Cart::getProducts(Json::decode($request->bodyParams['products']));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $products;
        }
        $empty = 1;
        return $this->render('index', compact('empty'));
        // return $this->render('index'); 
    }

    public function actionOrder() {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $request = $request->bodyParams["CartForm"]['order'];
            $products = Json::decode($request);
            $products = Cart::createOrder($products);
            return $this->render('order', $products); 
        }
        $empty = 1;
        return $this->render('index', compact('empty'));
    // return $this->render('index'); 
    }

    public function actionConfirm() {
        if(Yii::$app->request->isAjax){
            $order = Json::decode(Yii::$app->request->bodyParams['order']);
            $order = $order[0];
            if($order['confirm'] === 1) {
                if(Cart::confirmOrder(trim($order['orders'], '[]'))) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return 1; 
                }
            }
            return 'error';
        }
        $empty = 1;
        return $this->render('index', compact('empty'));
    }
}