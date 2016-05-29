<?php

use yii\db\Migration;

class m160516_162030_init_phone_table extends Migration
{
    public function up()
    {
		$this->createTable(
			'phone',
			[
				'id' => 'pk',
				'customer_id' => 'int not null',
				'number' => 'string',
			],
			'ENGINE=InnoDB'
		);
		$this->addForeignKey('customer_phone_numbers', 'phone',	'customer_id', 'customer', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('customer_phone_numbers', 'phone');
		$this->dropTable('phone');

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
