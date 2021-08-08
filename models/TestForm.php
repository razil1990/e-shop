<?php

namespace app\models;

use yii\base\Model;

class TestForm extends Model 
{
    
    public $name;
    public $age;

    public function rules()
    {
        return [
            [['name', 'age'], 'required']
        ];
    }

}