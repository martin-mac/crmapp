<?php

use yii\db\Migration;

class m160601_081901_init_user_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'user',
            [
                'id' => 'pk',
                'username' => 'string UNIQUE',
                'password' => 'string'
            ]
        );
    }

    public function down()
    {
        $this->dropTable('user');
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
