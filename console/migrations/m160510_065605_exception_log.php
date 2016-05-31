<?php

use yii\db\Schema;
use yii\db\Migration;

class m160510_065605_exception_log extends Migration
{
    public function up()
    {
        $this->createTable('exception_log', [

            'id' => Schema::TYPE_PK. ' AUTO_INCREMENT ',
            'exception' => Schema::TYPE_STRING,
            'function' => Schema::TYPE_STRING,
            'stacktace' => Schema::TYPE_TEXT,
            'classname' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        echo "m160510_065605_exception_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
