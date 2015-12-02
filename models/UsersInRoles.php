<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UsersInRoles".
 *
 * @property string $UserId
 * @property string $RoleId
 */
class UsersInRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UsersInRoles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'RoleId'], 'required'],
            [['UserId', 'RoleId'], 'string', 'max' => 38]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'RoleId' => 'Role ID',
        ];
    }
}
