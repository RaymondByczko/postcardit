<?php
/*
 * @file controllers/Database.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-03-18
 * @purpose Database related URL queries (schema, etc) get forwarded through this
 * controller.
 * @change_history RByczko, 2017-03-21 March 21, 2017, Added deletepostcard()
 * and _deletepostcard().
 * @change_history RByczko, 2017-03-24 March 24, 2017 (prior to), Added
 * postname_deletepostcard, _processdelete, processdelete.
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once('Logger.php');
require_once('exception_support/CIE_Controller.php');

Logger::configure('../postcarditlog4php.xml');


function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

class Database extends CIE_Controller {

		private $m_prev_error_handler=null;

		public function __construct()
        {
                parent::__construct();

				$this->prev_error_handler = set_error_handler("exception_error_handler");

        }

		public function __destruct()
		{
			if (!$this->m_prev_error_handler)
			{
				set_error_handler($this->prev_error_handler);
			}

		}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/database
	 *	- or -
	 * 		http://example.com/index.php/database/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/postcard/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->m_log->trace('Database::index called');
		/* @todo Adjust view page brought up. */
		$this->load->view('utility_message');
	}



	/* 
	 * @purpose To gather database schema information so it can be viewed.  It is
	 * done via a model.
	 *
	 * Because it is declared as private, it cannot be served via a URL request.
	 * The initial underscore serves the same purpose, but is for backward compatability.
	 */
	private function _viewschema()
	{

		$this->m_log->trace('Database::_viewschema called');
		if (! file_exists(APPPATH.'/views/database/viewschema.php'))
		{
			show_404();
		}

		// The following is a test artifact to see how well exceptions are logged via
		// log4php
		// throw new Exception('Test error in Database::_viewschema');
		// Get Postcard schema here.
		$this->load->model('Postcard_model','', TRUE);
		$schema_array = $this->Postcard_model->schema();
		$data = $schema_array;
		$this->load->view('database/viewschema', $data);
	}

	/*
	 * This is a proxy, in a way, that serves to call the real schema (that is _schema).
	 * This method provides the scaffolding of a try-catch block, logging if an
	 * exception is picked up, and then display of an 'exception' (that is, error)
	 * page.
	 */
	public function viewschema()
	{
		try {
			$this->_viewschema();
		}
		catch (Exception $e)
		{
			$unique_id = Database::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Database::_viewschema exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			// $this->m_log->trace('... trace='.$trace);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Database::_viewschema exception END');

			// e_site_url will find its way as a data-url.
			$e_site_url = site_url('postcard/exception/'.$unique_id);
			$data = array(
				'unique_id'=>$unique_id,
				'message'=>'Please check log trace looking for unique_id:'.$unique_id,
				'e_site_url'=>$e_site_url
			);
			$this->load->view('postcard/exception', $data);
		}
	}


	/*
	 * @purpose To allow editing of a specific postcard given its postcard_id.
	 */
	private function _database()
	{

		$this->m_log->trace('Database::_database called');

		$data = array();
		$this->load->view('database/database', $data);
	}

	/*
	 * This is a proxy, in a way, that serves to call the real edit (that is _edit).
	 * This method provides the scaffolding of a try-catch block, logging if an
	 * exception is picked up, and then display of an 'exception' (that is, error)
	 * page.
	 */
	public function database()
	{
		try {
			$this->_database();
		}
		catch (Exception $e)
		{
			/*
			 * A unique id is generated and then, a) displayed to the user
			 * and b) put into the log.  This allows users to just report
			 * the unique id to tech support, who can then subsequently
			 * examine the logs to find out what really happened.
			 *
			 * In short, this presents enough but not a deluge of information
			 * to the user, in the event of error.
			 */
			$unique_id = Database::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Database::_database exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Database::_database exception END');

			// e_site_url will find its way as a data-url.
			$e_site_url = site_url('postcard/exception/'.$unique_id);
			$data = array(
				'unique_id'=>$unique_id,
				'message'=>'Please check log trace looking for unique_id:'.$unique_id,
				'e_site_url'=>$e_site_url
			);
			$this->load->view('postcard/exception', $data);
		}
	}

	/*
	 * This method arranges for the deletion of a postcard by
	 * presenting an initial subset of postcards defined by
	 * postcard_id_start and num_postcards.
	 *
	 * postcard_id_start is the postcard_id of the initial row in 
	 * table postcard from which to fetch from.  This row and others,
	 * in the amount of num_postcards, will be fetched from table
	 * postcard.
	 *
	 */
	private function _deletepostcard($postcard_id_start, $num_postcards)
	{

		$this->m_log->trace('Database::_deletepostcard called');
		$this->m_log->trace('... postcard_id_start='.$postcard_id_start);
		$this->m_log->trace('... num_postcards='.$num_postcards);
		if (! file_exists(APPPATH.'/views/database/deletepostcard.php'))
		{
			show_404();
		}

		// The following is a test artifact to see how well exceptions are logged via
		// log4php
		// throw new Exception('Test error in Database::_deletepostcard');
		// Get ...
		$this->load->model('Postcard_model','', TRUE);
		$postcard_array = $this->Postcard_model->postcard_get($postcard_id_start, $num_postcards);

		$ve_postcard_array = var_export($postcard_array, TRUE);
		$this->m_log->trace('... ... ve_postcard_array='.$ve_postcard_array);

		for ($i=0; $i < $num_postcards-1; $i++)
		{
			$this->m_log->trace('... postcard_id='.$postcard_array[$i]->postcard_id);
			$this->m_log->trace('... subject ='.$postcard_array[$i]->subject);
		}
		$data = array(
			'postcard_array'=>$postcard_array,
			'postcard_id_start'=>$postcard_id_start,
			'num_postcards'=>$num_postcards
		);
		$this->load->view('database/deletepostcard', $data);
	}

	public function deletepostcard($postcard_id_start, $num_postcards)
	{
		try {
			$this->_deletepostcard($postcard_id_start, $num_postcards);
		}
		catch (Exception $e)
		{
			$unique_id = Database::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Database::_deletepostcard exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			// $this->m_log->trace('... trace='.$trace);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Database::_deletepostcard exception END');

			// e_site_url will find its way as a data-url.
			$e_site_url = site_url('postcard/exception/'.$unique_id);
			$data = array(
				'unique_id'=>$unique_id,
				'message'=>'Please check log trace looking for unique_id:'.$unique_id,
				'e_site_url'=>$e_site_url
			);
			$this->load->view('postcard/exception', $data);
		}
	}

	/* This static method defines part of the 'protocol' between an action
	 * on a form and the post parameters used by that form.  The names
	 * of some of those post parameters begin with the value returned
	 * by this method.
	 *
	 * The form of interest is one that presents a number of postcard
	 * database records.  If the user chooses one or more, the intention
	 * is to delete those postcards, whose ids are appended to the
	 * return value of this method.
	 *
	 * Here is an example.  The user is presented with database records
	 * such that their ids end with 15 to 19 inclusive, lets say.
	 *
	 * The user choses the record associated with postcard_id equal to 17.
	 * Then along the wire, a post parameter named, checkbox-deletepostcard-17
	 * is seen.  Its as easy as that.
	 *
	 * To extract these from all of the post parameters that might be sent,
	 * notice how easy it is with preg_grep
	 */
	public static function postname_deletepostcard()
	{
		return 'checkbox-deletepostcard-';
	}
	/*
	 * This processes a postcard delete request.
	 *
	 * The exact POST parameters are not known exactly but they follow the
	 * name format of: checkbox-deletepostcard-N where N is a number.
	 */
	private function _processdelete()
	{
		clearstatcache();
		$this->m_log->trace('Database::_processdelete called');
		$this->m_log->trace('... APPPATH='.APPPATH);

		$this->m_log->trace('... FP='.APPPATH.'views/database/processdelete.php');

		if (! file_exists(APPPATH.'/views/database/processdelete.php'))
		{
			$this->m_log->trace('... before 404');
			show_404();
		}
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

		$this->m_log->trace('... after library');
		// @todo use isset on post vars

		$post_keys = array_keys($_POST);

		$this->m_log->trace('... before preg_grep');
		$cd_post_keys = preg_grep("/checkbox-deletepostcard-\d+/", $post_keys);

        $n_post_keys = preg_grep("/deletepostcard-next/", $post_keys);

		$h1 = preg_grep("/hidden-delete-postcard-postcard_id_start/", $post_keys);
		$h2 = preg_grep("/hidden-delete-postcard-num_postcards/", $post_keys);

		$this->m_log->trace('... after preg_grep');
		// $c_name = 'checkbox-deletepostcard-'.$postcard_details->postcard_id;

		$postcard_id_delete = array();
		foreach ($cd_post_keys as $a_post_key)
		{
			$this->m_log->trace('... a_post_key='.$a_post_key);
			$this->m_log->trace('... ... post val='.$_POST[$a_post_key]);
			$postcard_id_name = $a_post_key;

			$l_pndp = strlen(Database::postname_deletepostcard());
			$this->m_log->trace('... ... l_pndp='.$l_pndp);
			$postcard_id = substr($postcard_id_name, $l_pndp);

			$this->m_log->trace('... ... postcard id='.$postcard_id);

			$this->load->model('Postcard_model','', TRUE);
			$this->Postcard_model->delete($postcard_id);

		}

		foreach ($h1 as $h1_post_key)
		{
			$this->m_log->trace('... h1_post_key='.$h1_post_key);
			$this->m_log->trace('... ... post val='.$_POST[$h1_post_key]);
		}

		foreach ($h2 as $h2_post_key)
		{
			$this->m_log->trace('... h2_post_key='.$h2_post_key);
			$this->m_log->trace('... ... post val='.$_POST[$h2_post_key]);
		}

		if (count($n_post_keys) == 1)
		{
			if (count($h1) != 1)
			{
				throw new Exception('Expected hidden-delete-postcard-postcard_id_start not there');
			}
			if (count($h2) != 1)
			{
				throw new Exception('Expected hidden-delete-postcard-num_postcards not there');
			}
			// $postcard_id_start = $_POST[$h1[0]];
			$num_postcards = $_POST[$h2[0]];
			$postcard_id_start = $_POST[$h1[0]] + $num_postcards;
			$this->load->view('database/deletepostcard/'.$num_postcards.'/'.$postcard_id_start, $data);
		}

		$data = array();
		$this->m_log->trace('Database::_processdelete end');
		$this->load->view('database/processdelete', $data);
	}

	public function processdelete()
	{
		try {
			$this->_processdelete();
		}
		catch (Exception $e)
		{
			$unique_id = Database::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Database::_processdelete exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Database::_processdelete exception END');

			// e_site_url will find its way as a data-url.
			$e_site_url = site_url('postcard/exception/'.$unique_id);
			$data = array(
				'unique_id'=>$unique_id,
				'message'=>'Please check log trace looking for unique_id:'.$unique_id,
				'e_site_url'=>$e_site_url
			);
			$this->load->view('postcard/exception', $data);
		}
	}
}
