<?php

namespace app\models;

use Cassandra\Date;
use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property int $idReservation
 * @property int $idCity
 * @property int $idCountry
 * @property int $idResort
 * @property int $idEmployee
 * @property int|null $LengthOfNights
 * @property string|null $DateBirth
 * @property string|null $mail
 * @property string|null $Number
 * @property int|null $NumberOfPeople
 *
 * @property Cities $idCity0
 * @property Countries $idCountry0
 * @property Employees $idEmployee0
 * @property Resorts $idResort0
 */
class Reservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservation';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['idCity', 'idCountry', 'idResort',], 'required', 'message' => "Заполните \"" . $this->getAttributeLabel('{attribute}') . "\""],
            [['idCity', 'idCountry', 'idResort', 'idEmployee', 'LengthOfNights', 'NumberOfPeople'], 'integer', 'message' => 'Только целое число'],
            [['DateBirth'], 'safe'],
            [['mail', 'Number'], 'string', 'max' => 145],
            ['mail', 'email'],
            ['NumberOfPeople', 'number', 'max' => 8, 'min' => 1, 'tooBig' => 'Не более 8', 'tooSmall' => 'Не менее 1'],
            ['LengthOfNights', 'number', 'max' => 16, 'min' => 2, 'tooBig' => 'Не более 16', 'tooSmall' => 'Не менее 2'],
            [['idCity'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['idCity' => 'idCity']],
            [['idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['idCountry' => 'idCountry']],
            [['idEmployee'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['idEmployee' => 'idEmployee']],
            [['idResort'], 'exist', 'skipOnError' => true, 'targetClass' => Resorts::className(), 'targetAttribute' => ['idResort' => 'idResorts']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idReservation' => 'Id Reservation',
            'idCity' => 'Город',
            'idCountry' => 'Страна',
            'idResort' => 'Курорт',
            'idEmployee' => 'Сотрудник',
            'LengthOfNights' => 'Количество ночей',
            'DateBirth' => 'Дата рождения',
            'mail' => 'Почта',
            'Number' => 'Номер',
            'NumberOfPeople' => 'Туристы',
        ];
    }

    /**
     * Gets query for [[IdCity0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity0()
    {
        return $this->hasOne(Cities::className(), ['idCity' => 'idCity']);
    }

    /**
     * Gets query for [[IdCountry0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCountry0()
    {
        return $this->hasOne(Countries::class, ['idCountry' => 'idCountry']);
    }

    /**
     * Gets query for [[IdEmployee0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmployee0()
    {
        return $this->hasOne(Employees::class, ['idEmployee' => 'idEmployee']);
    }

    /**
     * Gets query for [[IdResort0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdResort0()
    {
        return $this->hasOne(Resorts::class, ['idResorts' => 'idResort']);
    }

    public static function AddReservation($model)
    {
        $Employee= Date('d') % 2 === 0 ?
            Employees::find()->select('idEmployee')->where(['idEmployee' => 1])->asArray()->all() :
            Employees::find()->select('idEmployee')->where(['idEmployee' => 2])->asArray()->all();
        if (!Yii::$app->user->isGuest)
        {
            $model->idCity = $_POST["Reservation"]["idCity"];
            $model->idCountry = $_POST["Reservation"]["idCountry"];
            $model->idResort = $_POST["Reservation"]["idResort"];
            $model->idEmployee =$Employee[0]['idEmployee'];
            $model->LengthOfNights = $_POST["Reservation"]["LengthOfNights"];
            $model->DateBirth = Yii::$app->user->identity->DateBirth;
            $model->mail = Yii::$app->user->identity->Mail;
            $model->Number = Yii::$app->user->identity->Number;
            $model->NumberOfPeople = $_POST["Reservation"]["NumberOfPeople"];
            $model->save();
            return $model->save();
        }
        elseif (Yii::$app->user->isGuest)
        {

            $model->idCity = $_POST["Reservation"]["idCity"];
            $model->idCountry = $_POST["Reservation"]["idCountry"];
            $model->idResort = $_POST["Reservation"]["idResort"];
            $model->idEmployee =$Employee[0]['idEmployee'];
            $model->LengthOfNights = $_POST["Reservation"]["LengthOfNights"];
            $model->DateBirth = $_POST["Reservation"]["DateBirth"];
            $model->mail =$_POST["Reservation"]["mail"];
            $model->Number = $_POST["Reservation"]["Number"];
            $model->NumberOfPeople = $_POST["Reservation"]["NumberOfPeople"];
            $model->save();
            return $model->save();
        }
    }
}
