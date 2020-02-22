<?php

use app\components\SchemaHelper;
use Faker\Factory;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%bus}}`.
 */
class m200222_080218_create_bus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = SchemaHelper::getTableOptions($this->db->driverName);

        $this->createTable('{{%bus}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull(),
            'average_speed' => $this->integer()->notNull()
        ], $tableOptions);

        $faker = Factory::create();

        $buses = [];
        for($i = 0; $i < 60; $i++){
            $buses[] = [
                "Bus '{$faker->word()}'",
                $faker->numberBetween(40, 100)
            ];
        }

        $this->batchInsert('{{%bus}}',
            ['title', 'average_speed'],
            $buses);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bus}}');
    }
}
