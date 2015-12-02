<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/15
 * Time: 上午10:29
 */

namespace app\models;

use yii\db\ActiveRecord;

class Item extends ActiveRecord{
    public static function tableName()
    {
        return 'Item';
    }
}