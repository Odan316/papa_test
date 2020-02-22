<?php


namespace app\modules\api_v1\components;

use yii\base\BaseObject;

/**
 * Class TravelTimeCalculator
 *
 * @package app\modules\api_v1\components
 */
class TravelTimeCalculator extends BaseObject
{
    /**
     * @var int Should be via from object config
     */
    public $maxTravelHourPerDay;

    /**
     * Calculates travel time, given distance and speed
     *
     * @param int $distance
     * @param int $speed
     * @return int
     */
    public function getTravelTime(int $distance, int $speed)
    {
        return (int)ceil(($distance / $speed) / $this->maxTravelHourPerDay);
    }
}