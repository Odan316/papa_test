<?php

namespace app\models\queries;

use app\models\Bus;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Bus]].
 *
 * @see \app\models\Bus
 */
class BusQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Bus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
