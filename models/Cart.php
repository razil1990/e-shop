<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord 
{
      
    public static function getProducts($products) {
        $items = [];
        foreach($products as $product) {
            $items[] = $product['productId'];
        }
        sort($items); 
        $items = implode(',',$items);
        if($items && gettype($items) === 'string') {
            $stmt = Yii::$app->db->createCommand("SELECT product_id, title, image_url, price FROM product WHERE product_id IN ({$items})")
            ->queryAll();
        }

        foreach($products as $product) {
            foreach($stmt as $k => $v) {
                if($product['productId'] == $stmt[$k]['product_id']) {
                    $stmt[$k]['quantity'] = intval($product['quantity']);
                }
            }
        }

        if(isset($stmt) && $stmt !== []) {
            return $stmt;
        } else {
            return 'Error';
        }
    }

    // public static function createOrder($products) {
    //     $products = self::getProducts($products);
    //     $orders = [];
    //     if($products) {
    //         foreach($products as &$product) {
    //             $order_id = Yii::$app->db->createCommand('INSERT INTO "order" (order_price) VALUES (:order_price) RETURNING order_id', 
    //             [':order_price' => $product['price'] * $product['quantity']
    //             ])->queryOne();
    //             if($order_id['order_id']) {
    //                 $orders[] = $order_id['order_id'];
    //                 $product['order_id'] = $order_id['order_id'];
    //                 $stmt = Yii::$app->db->createCommand('INSERT INTO order_detail (order_id, product_id, product_quantity) 
    //                 VALUES (:order_id, :product_id, :product_quantity)', [
    //                 ':order_id' => $order_id['order_id'], ':product_id' => $product['product_id'], ':product_quantity'=>$product['quantity']])->execute();
    //                 if(!$stmt) {
    //                     return 'error';
    //                 }
    //             } 
    //             unset($product);
    //         } return ['products' => $products, 'orders' => json_encode($orders)];

    //     } else {
    //         return 'error';
    //     }
    // }
    public static function createOrder($products) {
        $products = self::getProducts($products);
        $orders = [];
        if($products) {
            foreach($products as &$product) {
                $order_id = Yii::$app->db->createCommand('INSERT INTO "order" (product_id, product_quantity, order_price) 
                VALUES (:product_id, :product_quantity,:order_price) RETURNING order_id', 
                [
                    ':product_id' => $product['product_id'],
                    ':product_quantity' => $product['quantity'],
                    ':order_price' => $product['price'] * $product['quantity'],
                ])->queryOne();
                if($order_id['order_id']) {
                    $orders[] = $order_id['order_id'];
                    $product['order_id'] = $order_id['order_id'];
                } 
                unset($product);
            } return ['products' => $products, 'orders' => json_encode($orders)];
        } else {
            return 'error';
        }
    }

    public static function confirmOrder($order_id) {
        $order_id = explode(',', $order_id);
        foreach($order_id as $k) {
            $stmt = Yii::$app->db->createCommand()->update("order", ['order_status' => 'Принят в обработку'], 'order_id = '. $k)->execute();
            if(!$stmt) {
                return false;
            }
        }
        return true;
    }


}