<?php
/*
 * @file Postcard_model.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16 February 16, 2017
 * @purpose To implement a CI model to access the postcard table
 * in the database.
 * @change_history 2016-01-06, January 06, 2016, Started this file
 * @status incomplete
 */
class Postcard_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function add($email, $from, $recipient_name, $message) 
	{
		$data = array (
			'postcard_author'=>$from,
			'postcard_recipient_email'=>$email,
			'postcard_recipient_name'=>$recipient_name,
			'postcard_message'=>$message,
			'postcard_active'=>'1'
		);
		$this->load->database();
		$ins = $this->db->insert_string('postcard', $data);
		$query = $this->db->query($ins);
		$id = $this->db->insert_id();
		// @todo return associate array with query, id keys.
		return $id;
	}
	public function activate($account_id)
	{

		$this->load->database();
		$data = array (
			'account_active'=>'1'
		);
		$where = 'account_id='.$account_id;
		$str = $this->db->update_string('account', $data, $where);

		$query = $this->db->query($str);
	}
	/*
	 * set_number given the account id and a new number, this method
	 * updates that account.
	 */
	public function set_number($account_id, $number)
	{
		$data = array(
			'number'=>$number	
		);
		$where = array(
			'account_id'=>$account_id
		);
		$this->load->database();
		$this->db->update('reminder', $data, $where); 
		// return $query->result();
	}
	/*
	 * delete Given an account_id, this method deletes that account.
	 */
	public function delete($account_id)
	{
		$this->load->database();
		$this->db->where('account_id', $account_id);
		$this->db->delete('account');
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
///
	public function delete_entry($account_id, $reminder_id)
	{
/**
		$data = array(
			'account_id'=>$account_id,
			// @todo - fix - datetime not datatime 
			'reminder_datatime'=>$reminder_datetime,
			'message'=>$message
		);
**/
		$this->load->database();
		$this->db->where('reminder_id', $reminder_id);
		$this->db->delete('reminder');
	}
////
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
