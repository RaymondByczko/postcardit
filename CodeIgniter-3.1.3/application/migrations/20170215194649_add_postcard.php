<?php
/*
 * This class adds an postcard table to the postcardit web application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_postcard extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(array(
			'postcard_id'=>array(
				'type'=>'INT',
				'constraint'=>5,
				'unsigned'=>TRUE,
				'auto_increment'=>TRUE
			),
			'postcard_author'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
			),
			'postcard_recipient_name'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
			),
			'postcard_recipient_email'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
			),
			'postcard_message'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
			),
			'postcard_active'=>array(
				'type'=>'INT'
			),
		));
		$this->dbforge->add_key('postcard_id', TRUE);
		// $attributes = array('ENGINE'=>'InnoDB');
		$attributes = array();

		$this->dbforge->create_table('postcard', FALSE, $attributes);
	}
	public function down()
	{
		$this->dbforge->drop_table('postcard', TRUE);
	}
}
?>
