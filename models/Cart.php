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

}