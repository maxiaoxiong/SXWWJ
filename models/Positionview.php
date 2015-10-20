<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/16
 * Time: 下午6:54
 */
namespace app\models;

use yii\db\ActiveRecord;

class Positionview extends ActiveRecord{
    public static function tableName()
    {
        return 'positionview';
    }
}