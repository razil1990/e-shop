<?php

namespace app\models;

use yii\db\ActiveRecord;

class Testuser extends ActiveRecord 
{
    public static function tableName() {
        return '{{user}}';
    }    


}