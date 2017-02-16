<?php
/*
 * This class adds an account table to the postcardit web application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_account extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(array(
			'account_id'=>array(
				'type'=>'INT',
				'constraint'=>5,
				'unsigned'=>TRUE,
				'auto_increment'=>TRUE
			),
			'account_name'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
			),
			'account_active'=>array(
				'type'=>'INT'
			),
		));
		$this->dbforge->add_key('account_id', TRUE);
		// $attributes = array('ENGINE'=>'InnoDB');
		$attributes = array();

		$this->dbforge->create_table('account', FALSE, $attributes);
	}
	public function down()
	{
		$this->dbforge->drop_table('account', TRUE);
	}
}
?>
