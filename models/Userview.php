<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/15
 * Time: 上午10:29
 */

namespace app\models;

use yii\db\ActiveRecord;

class Userview extends ActiveRecord{
    public function rules()
    {
        return [
            [['UserName', 'Password', 'RoleId', 'RoleName'], 'required'],
            [['UserName', 'LoweredUserName', 'Email', 'LoweredEmail', 'PasswordQuestion', 'Comment', 'RoleName', 'LoweredRoleName', 'Description'], 'string'],
            [['IsAnonymous', 'IsApproved', 'IsLockedOut'], 'boolean'],
            [['LastActivityDate', 'CreateDate', 'LastLoginDate', 'LastPasswordChangedDate', 'LastLockoutDate', 'FailedPasswordAttemptWindowStart', 'FailedPasswordAnswerAttemptWindowStart'], 'safe'],
            [['PasswordFormat', 'FailedPasswordAttemptCount', 'FailedPasswordAnswerAttemptCount'], 'integer'],
            [['UserId', 'RoleId'], 'string', 'max' => 38],
            [['MobileAlias', 'MobilePIN'], 'string', 'max' => 16],
            [['Password', 'PasswordSalt', 'PasswordAnswer'], 'string', 'max' => 128]
        ];
    }
}