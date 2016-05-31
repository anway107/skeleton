<?php

use yii\db\Schema;
use yii\db\Migration;

class m160517_190854_error_logs extends Migration
{
    public function up()
    {

        $this->createTable('error_log', [

            'id' => Schema::TYPE_PK. ' AUTO_INCREMENT ',
            'error' => Schema::TYPE_STRING,
            'function' => Schema::TYPE_STRING,
            'class' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);


    }

    public function down()
    {
        echo "m160517_190854_error_logs cannot be reverted.\n";

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
