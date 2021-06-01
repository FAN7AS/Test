<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property int $idHotel
 * @property int|null $idResort
 * @property string|null $Title
 * @property string|null $pictureHolel
 *
 * @property Resorts $idResort0
 * @property Reservation[] $reservations
 */
class Hotels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idResort'], 'integer'],
            [['Title', 'pictureHolel'], 'string', 'max' => 45],
            [['idResort'], 'exist', 'skipOnError' => true, 'targetClass' => Resorts::className(), 'targetAttribute' => ['idResort' => 'idResorts']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idHotel' => 'Id Hotel',
            'idResort' => 'Id Resort',
            'Title' => 'Title',
            'pictureHolel' => 'Picture Holel',
        ];
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

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['idHotel' => 'idHotel']);
    }
    public static function getHotel($idHotel): array
    {
        $data=Hotels::find()->where(['idHotel' =>$idHotel])->all();
        return $data;
    }
}
