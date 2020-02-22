<?php

use app\components\SchemaHelper;
use yii\db\Migration;

/**
 * Class m200222_080650_create_driver_bus_relation
 */
class m200222_080650_create_driver_bus_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = SchemaHelper::getTableOptions($this->db->driverName);

        $this->createTable('{{%driver_bus}}', [
            'driver_id' => $this->integer()->notNull(),
            'bus_id'    => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('IDX_driver_bus', '{{%driver_bus}}', [
            'driver_id',
            'bus_id'
        ], true);

        $this->addForeignKey('FK_driver_bus',
            '{{%driver_bus}}', 'driver_id',
            '{{%driver}}', 'id',
            'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_bus_driver',
            '{{%driver_bus}}', 'bus_id',
            '{{%bus}}', 'id',
            'RESTRICT', 'CASCADE');

        $driver_bus_links = [];
        for($i = 0; $i < 30; $i++){
            $driver_bus_links[] = [
                $i+1,
                ($i+1)*2,
            ];
            $driver_bus_links[] = [
                $i+1,
                ($i+1)*2 - 1,
            ];
        }

        $this->batchInsert('{{%driver_bus}}',
            ['driver_id', 'bus_id'],
            $driver_bus_links);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_driver_bus', '{{%driver_bus}}');
        $this->dropForeignKey('FK_bus_driver', '{{%driver_bus}}');

        $this->dropTable('{{%driver_bus}}');
    }
}
