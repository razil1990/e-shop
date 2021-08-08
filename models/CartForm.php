<?php 

namespace app\models;

use yii\base\Model;

class CartForm extends Model
{
    public $order;
    

    public function rules()
    {
        return [
            [['order'], 'trim'],
            [['order'], 'required'],
            ['order', 'match', 'pattern' => '/^\[[{"productId":"\d","quantity":"\d"}]+\]$/i']
        ];
    }
}