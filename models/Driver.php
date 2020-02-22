<?php

namespace app\models;

use app\models\queries\BusQuery;
use app\models\queries\DriverQuery;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property string $fio
 * @property string $birth_date
 *
 * @property Bus[] $buses
 */
class Driver extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'birth_date'], 'required'],
            [['birth_date'], 'safe'],
            [['fio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'fio'        => 'Fio',
            'birth_date' => 'Birth Date',
        ];
    }

    /**
     * Gets query for [[Buses]].
     *
     * @return ActiveQuery|BusQuery
     * @throws InvalidConfigException
     */
    public function getBuses()
    {
        return $this->hasMany(Bus::class, ['id' => 'bus_id'])
            ->viaTable('driver_bus', ['driver_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DriverQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DriverQuery(get_called_class());
    }
}
