<?php  
namespace app\models;
use yii\base\Model;

class SignupForm extends Model{

    public $Username;
    public $Password;
    public $Name;
    public $LastName;
    public $DateBirth;
    public $Sex;
    public $Mail;
    public $Number;
  
    public function rules() {
        return [
            [['Username', 'Password', 'Name', 'LastName', 'DateBirth', 'Sex', 'Mail', 'Number'], 'required', 'message' => 'Заполните поле "{attribute}"'],
             ['Mail', 'email'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'Username' => 'Логин',
            'Password' => 'Пароль',
            'Name' => 'Имя',
            'LastName' => 'Фамилия',
            'DateBirth' => 'Дата рождения',
            'Sex' => 'Пол',
            'Mail' => 'Почта',
            'Number' => 'Телефон',
        ];
    }
    
}

?>