<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "countries".
 *
 * @property int $idCountry
 * @property string|null $Title
 *
 * @property Reservation[] $reservations
 * @property Resorts[] $resorts
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Title'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCountry' => 'Id Country',
            'Title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['idCountry' => 'idCountry']);
    }

    /**
     * Gets query for [[Resorts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResorts()
    {
        return $this->hasMany(Resorts::className(), ['idCountry' => 'idCountry']);
    }

     public static function getCountryNames()
    {
      
        return ArrayHelper::map(Countries::find()->all(),'idCountry','Title');
    }


}
