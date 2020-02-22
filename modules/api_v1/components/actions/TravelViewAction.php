<?php


namespace app\modules\api_v1\components\actions;


use app\modules\api_v1\components\CitiesDistanceCalculator;
use app\modules\api_v1\components\TravelTimeCalculator;
use Yii;
use yii\db\ActiveRecordInterface;
use yii\db\Exception;
use yii\rest\ViewAction;

/**
 * Class TravelViewAction
 * Overridden standard REST ViewAction to add additional info
 *
 * @package app\modules\api_v1\components\actions
 */
class TravelViewAction extends ViewAction
{
    /**
     * @param string $id
     * @return ActiveRecordInterface
     * @throws Exception
     */
    public function run($id)
    {
        // Here we virtually calculate distance between cities
        $cdCalculator = new CitiesDistanceCalculator([
            'cityFrom' => Yii::$app->getRequest()->get('cityFrom', null),
            'cityTo'   => Yii::$app->getRequest()->get('cityTo', null)
        ]);
        $distance = $cdCalculator->getDistance();

        // Then we search for driver model
        $model = parent::run($id);

        // Then we query DB for his speed
        $model->best_speed = Yii::$app->db->createCommand("SELECT driver_best_speed({$model->id})")->queryScalar();

        // Finally we calculate his travel time
        $ttCalculator = new TravelTimeCalculator([
            'maxTravelHourPerDay' => 8 // We can alter this to load from config or DB
        ]);
        $model->travel_time = $ttCalculator->getTravelTime($distance, $model->best_speed);

        return $model;
    }
}