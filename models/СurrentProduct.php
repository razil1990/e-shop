<?php

namespace app\models;

use yii\db\ActiveRecord;

class СurrentProduct extends ActiveRecord 
{
    
    public static function tableName() {
        return '{{'.TABLE.'}}';
    }    


}