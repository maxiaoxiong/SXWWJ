<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Membership".
 *
 * @property string $UserId
 * @property string $Password
 * @property integer $PasswordFormat
 * @property string $PasswordSalt
 * @property string $MobilePIN
 * @property string $Email
 * @property string $LoweredEmail
 * @property string $PasswordQuestion
 * @property string $PasswordAnswer
 * @property boolean $IsApproved
 * @property boolean $IsLockedOut
 * @property string $CreateDate
 * @property string $LastLoginDate
 * @property string $LastPasswordChangedDate
 * @property string $LastLockoutDate
 * @property integer $FailedPasswordAttemptCount
 * @property string $FailedPasswordAttemptWindowStart
 * @property integer $FailedPasswordAnswerAttemptCount
 * @property string $FailedPasswordAnswerAttemptWindowStart
 * @property string $Comment
 */
class Membership extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'Password'], 'required'],
            [['PasswordFormat', 'FailedPasswordAttemptCount', 'FailedPasswordAnswerAttemptCount'], 'integer'],
            [['Email', 'LoweredEmail', 'PasswordQuestion', 'Comment'], 'string'],
            [['IsApproved', 'IsLockedOut'], 'boolean'],
            [['CreateDate', 'LastLoginDate', 'LastPasswordChangedDate', 'LastLockoutDate', 'FailedPasswordAttemptWindowStart', 'FailedPasswordAnswerAttemptWindowStart'], 'safe'],
            [['UserId'], 'string', 'max' => 38],
            [['Password', 'PasswordSalt', 'PasswordAnswer'], 'string', 'max' => 128],
            [['MobilePIN'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'Password' => 'Password',
            'PasswordFormat' => 'Password Format',
            'PasswordSalt' => 'Password Salt',
            'MobilePIN' => 'Mobile Pin',
            'Email' => 'Email',
            'LoweredEmail' => 'Lowered Email',
            'PasswordQuestion' => 'Password Question',
            'PasswordAnswer' => 'Password Answer',
            'IsApproved' => 'Is Approved',
            'IsLockedOut' => 'Is Locked Out',
            'CreateDate' => 'Create Date',
            'LastLoginDate' => 'Last Login Date',
            'LastPasswordChangedDate' => 'Last Password Changed Date',
            'LastLockoutDate' => 'Last Lockout Date',
            'FailedPasswordAttemptCount' => 'Failed Password Attempt Count',
            'FailedPasswordAttemptWindowStart' => 'Failed Password Attempt Window Start',
            'FailedPasswordAnswerAttemptCount' => 'Failed Password Answer Attempt Count',
            'FailedPasswordAnswerAttemptWindowStart' => 'Failed Password Answer Attempt Window Start',
            'Comment' => 'Comment',
        ];
    }
}
