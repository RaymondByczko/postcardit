<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_postcard_upload_file_postcard extends CI_Migration {
	public function up()
	{
		$fields = array(
			'postcard_upload_file'=>array(
				'type'=>'VARCHAR',
				'constraint'=>'255',
				'null'=>TRUE
			)
		);
		$this->dbforge->add_column('postcard', $fields);
	}
	public function down()
	{
		$this->dbforge->drop_column('postcard', 'postcard_upload_file');
	}
}
?>
