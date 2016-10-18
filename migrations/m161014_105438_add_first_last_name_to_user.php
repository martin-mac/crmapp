<?php

use yii\db\Migration;

class m161014_105438_add_first_last_name_to_user extends Migration
{
    public function up()
    {
		$this->addColumn('user', 'first_name', 'varchar(100) AFTER `id`');
		$this->addColumn('user', 'last_name', 'varchar(100) AFTER `first_name`');
    }

    public function down()
    {
        $this->dropColumn('user', 'last_name');		
        $this->dropColumn('user', 'first_name');		
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
