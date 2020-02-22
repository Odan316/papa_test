<?php

use app\components\SchemaHelper;
use Faker\Factory;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%driver}}`.
 */
class m200222_080337_create_driver_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = SchemaHelper::getTableOptions($this->db->driverName);

        $this->createTable('{{%driver}}', [
            'id'         => $this->primaryKey(),
            'fio'        => $this->string()->notNull(),
            'birth_date' => $this->dateTime()->notNull()
        ], $tableOptions);

        $faker = Factory::create();

        $drivers = [];
        for($i = 0; $i < 30; $i++){
            $drivers[] = [
                "{$faker->firstName} {$faker->lastName}",
                $faker->dateTimeBetween('-50years', '-20 years')->format("Y-m-d H:i:s")
            ];
        }

        $this->batchInsert('{{%driver}}',
            ['fio', 'birth_date'],
            $drivers);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%driver}}');
    }
}
