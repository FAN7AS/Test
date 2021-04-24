<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resorts".
 *
 * @property int $idResorts
 * @property int $idCountry
 * @property string $Title
 * @property string|null $Description
 *
 * @property Reservation[] $reservations
 * @property Countries $idCountry0
 */
class Resorts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resorts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idResorts', 'idCountry', 'Title'], 'required'],
            [['idResorts', 'idCountry'], 'integer'],
            [['Title', 'Description'], 'string', 'max' => 45],
            [['idResorts'], 'unique'],
            [['idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['idCountry' => 'idCountry']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idResorts' => 'Id Resorts',
            'idCountry' => 'Id Country',
            'Title' => 'Title',
            'Description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['idResort' => 'idResorts']);
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
}
