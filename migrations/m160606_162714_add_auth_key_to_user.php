<?php

use yii\db\Migration;

/**
 * Handles adding auth_key to table `user`.
 */
class m160606_162714_add_auth_key_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
		$this->addColumn('user', 'auth_key', 'string UNIQUE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'auth_key');		
    }
}
