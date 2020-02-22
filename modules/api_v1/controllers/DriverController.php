<?php

namespace app\modules\api_v1\controllers;

use yii\rest\ActiveController;

/**
 * Class DriverController
 * @package app\modules\api_v1\controllers
 */
class DriverController extends ActiveController
{
    public $modelClass = 'app\modules\api_v1\models\Driver';
}
