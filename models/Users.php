<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property string $UserId
 * @property string $UserName
 * @property string $LoweredUserName
 * @property string $MobileAlias
 * @property boolean $IsAnonymous
 * @property string $LastActivityDate
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'UserName'], 'required'],
            [['UserName', 'LoweredUserName'], 'string'],
            [['IsAnonymous'], 'boolean'],
            [['LastActivityDate'], 'safe'],
            [['UserId'], 'string', 'max' => 38],
            [['MobileAlias'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'UserName' => 'User Name',
            'LoweredUserName' => 'Lowered User Name',
            'MobileAlias' => 'Mobile Alias',
            'IsAnonymous' => 'Is Anonymous',
            'LastActivityDate' => 'Last Activity Date',
        ];
    }
}
