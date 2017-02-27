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
 * @status incomplete
 * @todo adjust get_accounts to get_postcards or delete it.
 */
class Postcard_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function add($from_name, $from_email, $to_name, $to_email, $subject, $message) 
	{
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
		$query = $this->db->query($ins);
		$id = $this->db->insert_id();
		// @todo return associate array with query, id keys.
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
