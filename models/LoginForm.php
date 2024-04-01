<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $account = $this->getUser();

            if (!$account || !Yii::$app->security->validatePassword($this->password, $account->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }


    public function login()
    {
        if ($this->validate()) {
            $account = Account::findOne(['username' => $this->username]);
            if ($account && \Yii::$app->security->validatePassword($this->password, $account->password)) {
                return \Yii::$app->user->login($account, $this->rememberMe ? 3600*24*30 : 0);
            }
        }
        return false;
    }
    




    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Account::findOne(['username' => $this->username]);
        }

        return $this->_user;
    }
}
