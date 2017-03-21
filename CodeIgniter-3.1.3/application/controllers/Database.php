<?php
/*
 * @file controllers/Database.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-03-18
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
	 * @purpose To initially specify the postcard by uploading/taking a picture.
	 * A new postcard record is added to the database.
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
}
