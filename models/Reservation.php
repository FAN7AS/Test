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
            [['idCity', 'idCountry', 'idResort', 'idEmployee'], 'required'],
            [['idCity', 'idCountry', 'idResort', 'idEmployee', 'LengthOfNights', 'NumberOfPeople'], 'integer'],
            [['DateBirth'], 'safe'],
            [['mail', 'Number'], 'string', 'max' => 45],
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
            'idCity' => 'Id City',
            'idCountry' => 'Id Country',
            'idResort' => 'Id Resort',
            'idEmployee' => 'Id Employee',
            'LengthOfNights' => 'Length Of Nights',
            'DateBirth' => 'Date Birth',
            'mail' => 'Mail',
            'Number' => 'Number',
            'NumberOfPeople' => 'Number Of People',
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
     * Gets query for [[IdResort0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdResort0()
    {
        return $this->hasOne(Resorts::className(), ['idResorts' => 'idResort']);
    }
}
