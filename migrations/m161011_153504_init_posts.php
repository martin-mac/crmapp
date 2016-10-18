<?php

use yii\db\Migration;

class m161011_153504_init_posts extends Migration
{
    public function up()
    {
		$this->createTable(
			'posts',
			[
				'post_id' => 'pk',
				'post_title' => 'string',
				'post_description' => 'text',
				'author_id' => 'int not null' 
			],
			'ENGINE=InnoDB'
		);
		$this->addForeignKey('user_posts_id', 'posts',	'author_id', 'user', 'id');
    }

    public function down()
    {
		$this->dropForeignKey('user_posts_id', 'posts');
		$this->dropTable('posts');
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
