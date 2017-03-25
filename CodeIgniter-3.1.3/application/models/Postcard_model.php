<?php
/*
 * @file Postcard_model.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16 February 16, 2017
 * @purpose To implement a CI model to access the postcard table
 * in the database.
 * @change_history 2017-02-19, February 19, 2017, Removed
 * methods from remindme (inherited via cp-paste).  Either delete
 * or reconstructed for postcard.
 * Added delete (postcard) method.
 * Added update_upload_file method.
 * Added activate method.
 * Added deactivate method.
 * Added delete method.
 * Added get_upload_file method.
 * @change_history 2017-02-26, February 26, 2017, Added subject parameter to
 * add method.  Changed name convention (from, to, etc).
 * @change_history 2017-03-01, March 1, 2017, Added log4php logging.
 * @status incomplete
 * @todo adjust get_accounts to get_postcards or delete it.
 * @change_history 2017-03-05, March 5, 2017. Adjust loading of helpers.
 * @change_history RByczko, 2017-03-21, March 21, 2017, Added schema() method
 * for returning table and field information regarding the backing database
 * used by postcardit.
 * @change_history RByczko, 2017-03-22, March 22, 2017, Added:
 * postcard_get($postcard_id_start, $num_postcards).
 */

require_once('Logger.php');

class Postcard_model extends CI_Model {


	// These private members support 'apache log4php'.
	private $m_cc_dot=null;
	private $m_log=null;

	public function __construct()
	{
		parent::__construct();

		/* Setup 'apache log4php' */
		$cc = get_called_class();
		$this->m_cc_dot = str_replace("\\", ".", $cc);
		$this->m_log = \Logger::getLogger($this->m_cc_dot);
		$this->m_log->trace('Postcard_model contructor called');
		$this->m_log->trace('...logger name='.$this->m_cc_dot);
	}

	/*
	 * postcard_get: gets a number of postcards equal to $num_postcards
	 * with ids (postcard_id that is) starting at $postcard_id_start.
	 * @todo  Will the select grab $num_postcards scattered among the
	 * database, not be consecutive, and then the limit applied?
	 * postcard_get's aim is the same as follows:
	 * 		* put all records in asc order by postcard_id.
	 *		* starting with postcard_id_start, grab the num_postcards
	 *			starting from the there.
	 *		* return the set so comprised.
	 */
	public function postcard_get($postcard_id_start, $num_postcards)
	{
		$this->m_log->trace('Postcard_model::postcard_get called');
		$this->load->database();
		$where = array(
			'postcard_id>=' => $postcard_id_start
		);
		$limit = $num_postcards;
		$this->db->order_by('postcard_id', 'ASC');
		$query = $this->db->get_where('postcard', $where, $limit); 
		$ve_query = var_export($query, TRUE);
		$this->m_log->trace('... ve_query='.$ve_query);
		$this->m_log->trace('Postcard_model::postcard_get end');
		return $query->result();
	}

	/*
	 * This model method figures out database related information
	 * for postcardit.  This includes tables and the fields within
	 * each table.
	 *
	 * The information is returned via an array with keys a) tables
	 * b) fields. The fields value is an array with keys, each of which
	 * is a table name.
	 *
	 */
	public function schema()
	{

		$this->m_log->trace('Postcard_model::schema called');
		$this->load->database();
		$tables = $this->db->list_tables();
		$schema_array = array(
			'tables'=>$tables,
			'fields'=>array()
		);
		foreach ($tables as $table)
		{
			$this->m_log->trace('... table='.$table);
		}
		foreach ($tables as $table)
		{
			$fields = $this->db->list_fields($table);
			$schema_array['fields'][$table] = $fields;
		}
		$this->m_log->trace('Postcard_model::schema return');
		return $schema_array;
	
	}
	public function add($from_name, $from_email, $to_name, $to_email, $subject, $message) 
	{

		$this->m_log->trace('Postcard_model::add called');

		$data = array (
			'from_name'=>$from_name,
			'from_email'=>$from_email,
			'to_name'=>$to_name,
			'to_email'=>$to_email,
			'subject'=>$subject,
			'message'=>$message,
			'active'=>'1'
		);
		$this->load->database();
		$ins = $this->db->insert_string('postcard', $data);
		$this->m_log->trace('... ins='.$ins);
		$query = $this->db->query($ins);
		$id = $this->db->insert_id();
		// @todo return associate array with query, id keys.

		$this->m_log->trace('Postcard_model::add return');
		return $id;
	}
	/*
     * activate the postcard entry identified by postcard_id.
	 */
	public function activate($postcard_id)
	{

		$this->load->database();
		$data = array (
			'active'=>'1'
		);
		$where = 'postcard_id='.$postcard_id;
		$str = $this->db->update_string('postcard', $data, $where);

		$query = $this->db->query($str);
	}

	/*
     * deactivates the postcard entry identified by postcard_id.
	 */
	public function deactivate($postcard_id)
	{

		$this->load->database();
		$data = array (
			'active'=>'0'
		);
		$where = 'postcard_id='.$postcard_id;
		$str = $this->db->update_string('postcard', $data, $where);

		$query = $this->db->query($str);
	}

	/*
	 * update_upload_file: given the postcard id and an upload file name,
	 * this method updates the relevant row in table postcard.
	 */
	public function update_upload_file($postcard_id, $upload_file)
	{
		$data = array(
			'postcard_upload_file'=>$upload_file
		);
		$where = array(
			'postcard_id'=>$postcard_id
		);
		$this->load->database();
		$this->db->update('postcard', $data, $where); 
		// return $query->result();
	}
	/*
	 * get_upload_file given the postcard id, this method returns
	 * the postcard upload file data only.
	 */
	public function get_upload_file($postcard_id)
	{
		$this->load->database();
		$where = array(
			'postcard_id'=>$postcard_id
		);
		$this->db->select('postcard_upload_file');
		$query = $this->db->get_where('postcard', $where); 
		return $query->result();
	}


	public function get_postcard($postcard_id)
	{
		$this->load->database();
		$where = array(
			'postcard_id'=>$postcard_id
		);
		$query = $this->db->get_where('postcard', $where); 
		return $query->result();
	}


	/*
	 * delete Given an postcard_id, this method deletes that postcard.
	 */
	public function delete($postcard_id)
	{
		$this->load->database();
		$this->db->where('postcard_id', $postcard_id);
		$this->db->delete('postcard');
		/* @todo This could possibly return the number of postcards deleted. */
	} 

	/*
	 * id_account_name gets the id and other info given the account_name.
	 */
	public function id_account_name($account_name)
	{
		$this->load->database();
		$this->db->where('account_name', $account_name);
		var_dump($account_name);
		$query = $this->db->get('account');
		var_dump($query);
		return $query;
	} 

	// cp-paste-todo-remaining-start
	// follow is cp/paste from Reminder_model.php.
	public function insert_entry($account_id, $reminder_datetime, $message)
	{
		$data = array(
			'account_id'=>$account_id,
			/* @todo - fix - datetime not datatime */
			'reminder_datatime'=>$reminder_datetime,
			'message'=>$message
		);
		$this->load->database();
		$this->db->insert('reminder', $data);
	}

	/*
	 * Given a postcard_id, this method deletes the postcard entry
	 * associated with it. WE ALREADY HAVE DELETE
	 */
	public function redundant_delete($postcard_id)
	{
		$this->load->database();
		$this->db->where('postcard_id', $postcard_id);
		$this->db->delete('reminder');
	}

	/* @todo 01-01-16 */
	public function get_accounts()
	{
		$this->load->database();
		$query = $this->db->get('account');
		var_dump($query);
		return $query;
	}
}

?>
