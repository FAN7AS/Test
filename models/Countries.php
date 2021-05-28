<?php

namespace app\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Countries extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['Title'], 'string', 'max' => 45],
            [['',''],'required','message' =>'Выберите "{attribute}" '],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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
     * @return ActiveQuery
     */
    public function getReservations(): ActiveQuery
    {
        return $this->hasMany(Reservation::class, ['idCountry' => 'idCountry']);
    }

    /**
     * Gets query for [[Resorts]].
     *
     * @return ActiveQuery
     */
    public function getResorts(): ActiveQuery
    {
        return $this->hasMany(Resorts::class, ['idCountry' => 'idCountry']);
    }

       public static function getChildDrop($ParentDropId): array
       {
        return Resorts::find()->where(['idCountry' => $ParentDropId])->all();
    }
    public static function getCountry(): array
    {
        return Countries::find()->all();
    }
    public static function getCountryDeatails($idCountry): array
    {
        return Countries::find()->where(['idCountry' => $idCountry])->all();
    }
}
