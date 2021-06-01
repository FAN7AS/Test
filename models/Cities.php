<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $idCity
 * @property string|null $Title
 * @property string|null $Region
 *
 * @property Reservation[] $reservations
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Title', 'Region'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCity' => 'Id City',
            'Title' => 'Title',
            'Region' => 'Region',
        ];
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['idCity' => 'idCity']);
    }
    public static function getCity($idCity): array
    {
        $data=Cities::find()->where(['idCity' =>$idCity])->all();
        return $data;
    }
}
