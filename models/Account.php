<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "account".
 *
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $role
 *
 * @property Post[] $posts
 */
class Account extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'role'], 'required'],
            [['username', 'name', 'role'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 250],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['username' => 'username']);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    public function getId()
    {
        return $this->username;
    }
    public function validatePassword($password)
    {
        $account = static::findIdentity($this->getId());
        return $account !== null && Yii::$app->security->validatePassword($password, $account->password);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        return null; // Anda bisa mengembalikan nilai yang sesuai di sini jika diperlukan
    }

    public function validateAuthKey($authKey)
    {
        return false; // Anda bisa mengatur logika validasi sesuai kebutuhan Anda di sini
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Tidak digunakan dalam autentikasi sederhana.
        return null;
    }

}
