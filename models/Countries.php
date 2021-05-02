<?php

namespace app\models;

use Yii;
use app\models\Resorts;
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
            [['',''],'required','message' =>'Выберите "{attribute}" '],
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
              'CountryNames' => 'Country',
                'ResortNames' => 'Resort',
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

       public static function getChildDrop($ParentDropId)
    {
        $ChildDrop = Resorts::find()->where(['idCountry' => $ParentDropId])->all();
        return $ChildDrop;
    }

}
