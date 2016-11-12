<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_user".
 *
 * @property string $id
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
            [['username', 'password_encryption'], 'required'],
            [['id', 'created_by', 'updated_by', 'username', 'password_encryption', 'access_token', 'auth_key'], 'string'],
            [['data_status', 'created_at', 'updated_at', 'must_change_password'], 'integer'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data_status' => Yii::t('app', 'Data Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'username' => Yii::t('app', 'Username'),
            'password_encryption' => Yii::t('app', 'Password Encryption'),
            'access_token' => Yii::t('app', 'Access Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'must_change_password' => Yii::t('app', 'Must Change Password'),
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Store the hashed password.
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_encryption = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Check if a password is correct comparing to saved one.
     * @param string $password
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_encryption);
    }

    /**
     * Generate auth_key for new record.
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::beforeSave()
     */
    public function beforeSave($insert)
    {
        $result = parent::beforeSave($insert);
        if ($result && $this->isNewRecord) {
            // Set auth_key
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        return $result;
    }
}
