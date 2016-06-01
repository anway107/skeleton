<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160513_053153_mail_log extends Migration
{
    public function up()
    {
        $this->createTable('mail_log', [

            'id' => Schema::TYPE_PK. ' AUTO_INCREMENT ',
            'subject' => Schema::TYPE_STRING,
            'to' => Schema::TYPE_STRING,
            'data' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        echo "m160513_053153_mail_log cannot be reverted.\n";
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
