<?php

namespace app\components;

/**
 * Class SchemaHelper
 * It contains helper functions for migrations
 *
 * @package app\components
 * @author Andreev Sergey <si.andreev316@gmail.com>
 * @version 1.0
 */
class SchemaHelper
{
    /**
     * Return tableOptions param for e.g. 'createTable' method based on DB driver
     *
     * @param null|string $driverName DB driver name. If not specified, empty string will be returned.
     *
     * @return null|string tableOptions param for e.g. 'createTable' method.
     */
    public static function getTableOptions($driverName = null)
    {
        $tableOptions = null;

        switch($driverName){
            case 'mysql':
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
                break;
            default:
                break;
        }

        return $tableOptions;
    }
}