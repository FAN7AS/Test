<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $idEmployee
 * @property string|null $Name
 * @property string|null $Lastname
 * @property string|null $sex
 * @property string|null $AddInformation
 *
 * @property Reservation[] $reservations
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Lastname', 'sex', 'AddInformation'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEmployee' => 'Id Employee',
            'Name' => 'Name',
            'Lastname' => 'Lastname',
            'sex' => 'Sex',
            'AddInformation' => 'Add Information',
        ];
    }

    /**
     * Gets query for [[Reservations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['idEmployee' => 'idEmployee']);
    }
}
