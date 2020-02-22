<?php

namespace app\models;

use app\models\queries\BusQuery;
use app\models\queries\DriverQuery;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bus".
 *
 * @property int $id
 * @property string $title
 * @property int $average_speed
 *
 * @property Driver[] $drivers
 */
class Bus extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'average_speed'], 'required'],
            [['average_speed'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'title'         => 'Title',
            'average_speed' => 'Average Speed',
        ];
    }

    /**
     * Gets query for [[Drivers]].
     *
     * @return ActiveQuery|DriverQuery
     * @throws InvalidConfigException
     */
    public function getDrivers()
    {
        return $this->hasMany(Driver::class, ['id' => 'driver_id'])
            ->viaTable('driver_bus', ['bus_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusQuery(get_called_class());
    }
}
