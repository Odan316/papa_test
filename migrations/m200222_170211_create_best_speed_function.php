<?php

use yii\db\Migration;

/**
 * Class m200222_170211_create_best_speed_function
 */
class m200222_170211_create_best_speed_function extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "DROP FUNCTION IF EXISTS driver_best_speed;";
        $this->execute($sql);

        $sql = "CREATE FUNCTION driver_best_speed(driver_id INT) RETURNS int(11)
                BEGIN
                DECLARE best_speed INT DEFAULT 0;
                    SELECT 
                        MAX(b.average_speed)
                    INTO best_speed FROM
                        bus b
                            LEFT JOIN
                        driver_bus db ON db.bus_id = b.id
                    WHERE
                        db.driver_id = driver_id;
                    RETURN best_speed;
                END";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP FUNCTION IF EXISTS driver_best_speed;";
        $this->execute($sql);
    }
}
