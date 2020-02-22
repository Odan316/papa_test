<?php

namespace app\models\queries;

use app\models\Driver;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Driver]].
 *
 * @see \app\models\Driver
 */
class DriverQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Driver[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Driver|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
