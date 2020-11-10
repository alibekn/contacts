<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $dob;
    public $gender;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],

            [['dob', 'gender'], 'required'],
            [['gender'], 'integer'],
            [['dob'], 'string']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Пароль',
            'email' => 'Email',
            'sign up' => 'Зарегистрироваться',
            'dob' => 'Дата рождения',
            'gender' => 'Пол'
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->dob = strtotime($this->dob);
        $user->gender = $this->gender;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save();
    }
}
