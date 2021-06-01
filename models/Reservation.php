<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property int $idReservation
 * @property int $idCity
 * @property int $idCountry
 * @property int $idResort
 * @property int|null $idHotel
 * @property int|null $RoomType
 * @property string|null $DateBirth
 * @property string|null $mail
 * @property string|null $Number
 * @property int|null $NumberOfPeople
 * @property string|null $DateAdded
 * @property int $idEmployee
 * @property int|null $LengthOfNights
 *
 * @property Cities $idCity0
 * @property Countries $idCountry0
 * @property Employees $idEmployee0
 * @property Hotels $idHotel0
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
        if (Yii::$app->user->isGuest) {
            return [
                [['idCity', 'idCountry', 'idResort', 'idHotel', 'mail', 'Number', 'DateBirth'], 'required', 'message' => "Заполните \"" . $this->getAttributeLabel('{attribute}') . "\""],
                [['idCity', 'idCountry', 'idResort', 'idHotel', 'RoomType', 'NumberOfPeople', 'idEmployee', 'LengthOfNights'], 'integer', 'message' => 'Только целое число'],
                [['DateBirth', 'DateAdded'], 'safe'],
                [['mail', 'Number'], 'string', 'max' => 145],
                ['NumberOfPeople', 'number', 'max' => 8, 'min' => 1, 'tooBig' => 'Не более 8', 'tooSmall' => 'Не менее 1'],
                ['LengthOfNights', 'number', 'max' => 16, 'min' => 2, 'tooBig' => 'Не более 16', 'tooSmall' => 'Не менее 2'],
                [['idCity'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['idCity' => 'idCity']],
                [['idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['idCountry' => 'idCountry']],
                [['idEmployee'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::class, 'targetAttribute' => ['idEmployee' => 'idEmployee']],
                [['idHotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotels::class, 'targetAttribute' => ['idHotel' => 'idHotel']],
                [['idResort'], 'exist', 'skipOnError' => true, 'targetClass' => Resorts::class, 'targetAttribute' => ['idResort' => 'idResorts']],
            ];
        } else
            return [
                [['idCity', 'idCountry', 'idResort', 'idHotel'], 'required', 'message' => "Заполните \"" . $this->getAttributeLabel('{attribute}') . "\""],
                [['idCity', 'idCountry', 'idResort', 'idHotel', 'RoomType', 'NumberOfPeople', 'idEmployee', 'LengthOfNights'], 'integer', 'message' => 'Только целое число'],
                [['DateBirth', 'DateAdded'], 'safe'],
                [['mail', 'Number'], 'string', 'max' => 145],
                ['NumberOfPeople', 'number', 'max' => 8, 'min' => 1, 'tooBig' => 'Не более 8', 'tooSmall' => 'Не менее 1'],
                ['LengthOfNights', 'number', 'max' => 16, 'min' => 2, 'tooBig' => 'Не более 16', 'tooSmall' => 'Не менее 2'],
                [['idCity'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['idCity' => 'idCity']],
                [['idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['idCountry' => 'idCountry']],
                [['idEmployee'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::class, 'targetAttribute' => ['idEmployee' => 'idEmployee']],
                [['idHotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotels::class, 'targetAttribute' => ['idHotel' => 'idHotel']],
                [['idResort'], 'exist', 'skipOnError' => true, 'targetClass' => Resorts::class, 'targetAttribute' => ['idResort' => 'idResorts']],
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
            'idHotel' => 'Отель',
            'RoomType' => 'Количество комнат',
            'DateBirth' => 'Дата рождения',
            'mail' => 'Почта',
            'Number' => 'Номер',
            'NumberOfPeople' => 'Туристы',
            'DateAdded' => 'Date Added',
            'idEmployee' => 'Сотрудник',
            'LengthOfNights' => 'Количество ночей',
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
        return $this->hasOne(Countries::className(), ['idCountry' => 'idCountry']);
    }

    /**
     * Gets query for [[IdEmployee0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmployee0()
    {
        return $this->hasOne(Employees::className(), ['idEmployee' => 'idEmployee']);
    }

    /**
     * Gets query for [[IdHotel0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdHotel0()
    {
        return $this->hasOne(Hotels::className(), ['idHotel' => 'idHotel']);
    }

    /**
     * Gets query for [[IdResort0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdResort0()
    {
        return $this->hasOne(Resorts::className(), ['idResorts' => 'idResort']);
    }

    public static function AddReservation($model)
    {
        $Employee = Date('d') % 2 === 0 ?
            Employees::find()->select('idEmployee')->where(['idEmployee' => 1])->asArray()->all() :
            Employees::find()->select('idEmployee')->where(['idEmployee' => 2])->asArray()->all();
        if (!Yii::$app->user->isGuest) {
            $model->idCity = $_POST["Reservation"]["idCity"];
            $model->idCountry = $_POST["Reservation"]["idCountry"];
            $model->idResort = $_POST["Reservation"]["idResort"];
            $model->idEmployee = $Employee[0]['idEmployee'];
            $model->LengthOfNights = $_POST["Reservation"]["LengthOfNights"];
            $model->DateBirth = Yii::$app->user->identity->DateBirth;
            $model->mail = Yii::$app->user->identity->Mail;
            $model->Number = Yii::$app->user->identity->Number;
            $model->NumberOfPeople = $_POST["Reservation"]["NumberOfPeople"];
            $model->DateAdded = Date('Y-m-d G:i:s');
        } elseif (Yii::$app->user->isGuest) {
            $model->idCity = $_POST["Reservation"]["idCity"];
            $model->idCountry = $_POST["Reservation"]["idCountry"];
            $model->idResort = $_POST["Reservation"]["idResort"];
            $model->idEmployee = $Employee[0]['idEmployee'];
            $model->LengthOfNights = $_POST["Reservation"]["LengthOfNights"];
            $model->DateBirth = $_POST["Reservation"]["DateBirth"];
            $model->mail = $_POST["Reservation"]["mail"];
            $model->Number = $_POST["Reservation"]["Number"];
            $model->NumberOfPeople = $_POST["Reservation"]["NumberOfPeople"];
            $model->DateAdded = Date('Y-m-d G:i:s');

        }
        return $model->save();
    }
}
