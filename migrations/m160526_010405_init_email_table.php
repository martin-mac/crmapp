<?php

use yii\db\Migration;

class m160526_010405_init_email_table extends Migration
{
    public function up()
    {
		$this->createTable(
			'email',
				[
				'id' => 'pk',
				'purpose' => 'string',
				'address' => 'string',
				'customer_id' => 'int not null'
				]
				);
			$this->addForeignKey('customer_email', 'email',
					'customer_id', 'customer', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('customer_email', 'email');
		$this->dropTable('email');
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
