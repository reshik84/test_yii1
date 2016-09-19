<?php

class m160919_141541_feedback extends CDbMigration
{
	public function up()
	{
            $this->createTable('feedback', [
                'id' => 'pk',
                'name' => 'varchar(255)',
                'email' => 'varchar(255)',
                'message' => 'text'
            ]);
	}

	public function down()
	{
            $this->dropTable('feedback');
	}

}