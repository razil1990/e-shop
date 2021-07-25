<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord 
{
    
    public static function tableName() {
        return '{{product}}';
    }    

    public function getCurrentProduct() {
        return $this->hasOne(СurrentProduct::class, ['product_id' => 'product_id']);
    } 
    
    public function getCategory() {
        return $this->hasOne(Category::class, ['category_id' => 'category_id']);
    } 

}