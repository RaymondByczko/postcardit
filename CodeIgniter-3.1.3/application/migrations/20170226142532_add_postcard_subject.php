<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_postcard_subject extends CI_Migration {
	public function up()
	{
		$fields = array(
			'subject'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'255',
				'null'=>TRUE
			)
		);
		$this->dbforge->add_column('postcard', $fields);
	}
	public function down()
	{
		$this->dbforge->drop_column('postcard', 'postcard_subject');
	}
}
?>
