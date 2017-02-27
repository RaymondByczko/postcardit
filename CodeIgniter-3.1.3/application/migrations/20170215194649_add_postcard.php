<?php
/*
 * @file 20170215194649_add_postcard.php
 * @author Raymond Byczko
 * @company self
 * @change_history 2017-02-26, February 26, 2017, Change column names.
 * Modified names to a more uniform convention (to, from, etc).
 */
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
			'from_name'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
				'null'=>TRUE
			),
			'from_email'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
				'null'=>TRUE
			),
			'to_name'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
				'null'=>TRUE
			),
			'to_email'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
				'null'=>TRUE
			),
			'message'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'100',
				'null'=>TRUE
			),
			'active'=>array(
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
