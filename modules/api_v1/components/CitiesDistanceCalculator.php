<?php


namespace app\modules\api_v1\components;

use yii\base\BaseObject;

/**
 * Class CitiesDistanceCalculator
 *
 * This class is dummy - it can implements any logic to handle cities and distances
 *
 * @package app\modules\api_v1\components
 */
class CitiesDistanceCalculator extends BaseObject
{
    /**
     * @var string
     */
    public $cityFrom;

    /**
     * @var string
     */
    public $cityTo;

    /**
     * Dummy method, tha emulates distance calculation
     *
     * @return int
     */
    public function getDistance()
    {
        if(!empty($this->cityFrom) && !empty($this->cityTo)){
            return 823;
        }

        return 0;
    }

}