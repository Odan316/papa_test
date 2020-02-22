<?php

namespace app\modules\api_v1\controllers;

use yii\rest\ActiveController;

/**
 * Class BusController
 * Basic REST controller for model Bus
 *
 * @package app\modules\api_v1\controllers
 */
class BusController extends ActiveController
{
    public $modelClass = 'app\models\Bus';
}
