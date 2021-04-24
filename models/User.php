<?php

namespace app\models;
use Yii;
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{   
  public static function tableName()
  {
    return '{{Users}}';
}


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
     return static::findOne($id);
 }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      return static::findOne(['Username' => $username]);
  }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
       return \Yii::$app->security->validatePassword($password, $this->Password);
    }

    public static function getUsername()
    {
    return User::find()->select(['Username'])->all();
      /*  $query
        ->select('username')
        ->from('users')->all();*/
    }

    public static function SignUp($bool,$model)
    {
        if ($bool)
        {
            $user = new User();
            $user->Username =$model->Username;
            $user->Password = \Yii::$app->security->generatePasswordHash($model->Password);
            $user->Name = $model->Name;
            $user->LastName = $model->LastName;
            $user->DateBirth = $model->DateBirth;
            $user->Sex = $model->Sex;
            $user->Mail = $model->Mail;
            $user->Number = $model->Number; 
            return $user->save();
        }
    }
}
