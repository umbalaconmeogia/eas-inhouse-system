<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_user".
 *
 * @property integer $id
 * @property integer $data_status
 * @property string $created_by
 * @property integer $created_at
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $username
 * @property string $password_encryption
 * @property string $access_token
 * @property string $auth_key
 * @property integer $must_change_password
 */
class LoginUser extends \batsg\models\BaseBatsgModel implements \yii\web\IdentityInterface
{
    use \batsg\models\traits\LoginUserTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'created_at', 'updated_at', 'must_change_password'], 'integer'],
            [['username'], 'required'],
            [['password_encryption', 'access_token', 'auth_key'], 'string'],
            [['created_by', 'updated_by', 'username'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_status' => 'Data Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'username' => 'ユーザーネーム',
            'password_encryption' => 'パスワード暗号化',
            'access_token' => 'クッキーキー',
            'auth_key' => '認証キー',
            'must_change_password' => 'パスワード要変更',
        ];
    }
     public function setPassword($password)
    {
        $this->password_encryption = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
