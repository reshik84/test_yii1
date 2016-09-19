<?php

class m160919_143617_feedback2 extends CDbMigration
{
	public function up()
	{
            $this->addColumn('feedback', 'created_at', 'int(11)');
	}

	public function down()
	{
		echo "m160919_143617_feedback2 does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}