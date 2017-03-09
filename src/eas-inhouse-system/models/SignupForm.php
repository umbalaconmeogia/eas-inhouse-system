<?php
namespace app\models;

use yii\base\Model;
use app\models\LoginUser;
/**
 * Signup form
 */
class SignupForm extends LoginUser
{
    public $username;
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\LoginUser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\LoginUser', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        
        // var_dump(1);
        // if (!$this->validate()) {
        //     var_dump(2);
        //     return null;
        // }
        // var_dump(3);
        $user = new LoginUser();

        $user->username = $this->username;
        // $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        var_dump(4);

        return $user->save() ? $user : null;
    }
}