<?php
namespace app\modules\api_v1\models;

use DateTime;

/**
 * Class Driver
 * Extended Driver AR for using in REST v1
 *
 * @package app\modules\api_v1\models
 */
class Driver extends \app\models\Driver
{
    public $best_speed;
    public $travel_time;

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'id',
            'fio',
            'birth_date',
            'age' => function($model){
                $birthDate = new DateTime($model->birth_date);
                $nowDate = new DateTime();
                return $nowDate->diff($birthDate)->format('%y');
            }
        ];
    }

    /**
     * @inheritDoc
     */
    public function extraFields()
    {
        return [
            'buses',
            'travel_time'
        ];
    }
}