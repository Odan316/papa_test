<?php

namespace app\modules\api_v1\controllers;

use app\modules\api_v1\components\actions\TravelIndexAction;
use app\modules\api_v1\components\actions\TravelViewAction;
use yii\rest\ActiveController;

/**
 * Class DriverTimeController
 * @package app\modules\api_v1\controllers
 */
class TravelController extends ActiveController
{
    public $modelClass = 'app\modules\api_v1\models\Driver';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => TravelIndexAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'view' => [
                'class' => TravelViewAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ]
        ];
    }
}
