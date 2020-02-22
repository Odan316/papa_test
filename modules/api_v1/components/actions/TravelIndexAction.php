<?php


namespace app\modules\api_v1\components\actions;


use app\modules\api_v1\components\CitiesDistanceCalculator;
use app\modules\api_v1\components\TravelTimeCalculator;
use app\modules\api_v1\models\Driver;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\rest\IndexAction;

/**
 * Class TravelIndexAction
 * Overridden standard REST IndexAction to add fixed sorting and additional field
 *
 * @package app\modules\api_v1\components\actions
 */
class TravelIndexAction extends IndexAction
{
    /**
     * We override this function to alter basic ActiveDataProvider query to have possibility to sort by drivers speed
     * and subsequently calculate travel time for every found model
     *
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        // Here we virtually calculate distance between cities
        $cdCalculator = new CitiesDistanceCalculator([
            'cityFrom' => Yii::$app->getRequest()->get('cityFrom', null),
            'cityTo'   => Yii::$app->getRequest()->get('cityTo', null)
        ]);
        $distance = $cdCalculator->getDistance();

        // Then we add driver maximal speed calculation via DB-stored function and add fixed sorting by it
        $dataProvider = parent::prepareDataProvider();
        /** @var ActiveQuery $query */
        $query = $dataProvider->query;
        $query
            ->addSelect([
                '*',
                new Expression("driver_best_speed(driver.id) AS best_speed")
            ])
            ->orderBy(['best_speed' => SORT_DESC]);

        // Finally we iterate found models to calculate theirs travel time
        array_map(function (Driver $model) use ($distance) {

            $ttCalculator = new TravelTimeCalculator([
                'maxTravelHourPerDay' => 8 // We can alter this to load from config or DB
            ]);
            $model->travel_time = $ttCalculator->getTravelTime($distance, $model->best_speed);

        }, $dataProvider->getModels());

        return $dataProvider;
    }
}