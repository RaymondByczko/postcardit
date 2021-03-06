<?php
/*
 * @file controllers/Postcard.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16
 * @change_history RByczko, 2017-02-19, Enhanced edit functionality.
 * @change_history RByczko, 2017-02-20, Added DRY dir static methods.
 * @change_history RByczko, 2017-02-20, Load javascript library.
 * @change_history RByczko, 2017-02-21, Provide for uploaded pic in upload_complete.
 * Enhance upload_complete.
 * @change_history RByczko, 2017-02-23, Added save_canvas method.
 * @change_history RByczko, 2017-02-23, Added log4php. Added save_postcard.
 * @change_history RByczko, 2017-02-25, Enhance save_postcard.
 * @change_history RByczko, 2017-02-25, Add json return for save_postcard.
 * @change_history RByczko, 2017-02-26, Add subject to add method.
 * @change_history RByczko, 2017-02-26, Change naming convention app wide (from, to, etc).
 * @change_history RByczko, 2017-02-26, Added static method send_postcard.
 * @change_history RByczko, 2017-02-27, Fix method send.
 * @change_history RByczko, 2017-02-28, Enhance add method with try-catch.
 * @change_history RByczko, 2017-03-01, Add cancel method (which will delete a postcard
 * in the process of it being made).
 * Also added: send, send_postcard_ajax
 * @todo Loading javascript may change to false.
 * @status working, but @todo needs cleanup, especially save_postcard.
 * However, at least I am able to see the _POST parameters.
 * @change_history RByczko, 2017-03-05, Adjust loading of helpers.
 * Cleanup.
 * @change_history RByczko, 2017-03-06, Added about method.
 * @change_history RByczko, 2017-03-10, Added processing of trace and sending it to log.
 * @change_history RByczko, 2017-03-14, Changed from public to private, the _add method.
 * In this way, per CodeIgniter documentation, it cannot be served via URL request.
 * @change_history RByczko, 2017-03-14, Fixed About going to add instead of remaining
 * in exception view, when exception is handled in add method.  Supplied exception method
 * to Postcard class.
 * @change_history RByczko, 2017-03-15, Refactored code by adding _recurse_trace($trace).
 * It was factored out of the add method.  It will be used by other methods.
 * Refactored upload_now by introducing try-catch, _upload_now.
 * @test The test artifact in _upload_now($postcard_id) yield a pass.  It was logged.
 * _recurse_trace is in draft stage @todo fix
 * _recurse_trace_ve is the preferred recurse method.
 * @change_history RByczko, 2017-03-16, Refactored edit by introducing try-catch, _edit.
 * @test The test artifact in _edit($postcard_id) yielded a pass.  It was logged.
 * Documented the proxy methods that call the real ones (add, edit, upload_now).
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once('Logger.php');
require_once('PHPMailer-master/PHPMailerAutoload.php');
require_once('config/mailerconfig.php');

Logger::configure('../postcarditlog4php.xml');

class Postcard extends CI_Controller {

		// These private members support 'apache log4php'.
		private $m_cc_dot=null;
		private $m_log=null;

		public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
				$this->load->library(
						'javascript',
						array(
								'autoload' => TRUE
						)
				);

				/* Setup 'apache log4php' */
				$cc = get_called_class();
				$this->m_cc_dot = str_replace("\\", ".", $cc);
				$this->m_log = \Logger::getLogger($this->m_cc_dot);
				$this->m_log->trace('Postcard contructor called');
				$this->m_log->trace('...logger name='.$this->m_cc_dot);

				// $this->output->enable_profiler(TRUE);
        }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/postcard
	 *	- or -
	 * 		http://example.com/index.php/postcard/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/postcard/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->m_log->trace('Postcard::index called');
		$this->load->view('utility_message');
	}

	/*
	 * This set of four *_dir static functions
	 * allow a DRY approach to specifying certain
	 * directories.  They are static because
	 * no object state is required of them.
	 *
	 * Although each return values looks like
	 * an absolute path, these are actually
	 * appended to APPPATH.  They are actually
	 * relative.
	 *
	 * The 'img' parent directory implies
	 * each subdirectory is related.
	 */
	static public function uploads_dir()
	{
		return '/img/uploads/';
	}

	static public function inprocess_dir()
	{
		return '/img/inprocess/';
	}

	static public function sent_dir()
	{
		return '/img/sent/';
	}

	static public function sent_80x80_dir()
	{
		return '/img/sent_80x80/';
	}

	/*
	 * This static method utilizes a PHPMailer class object that
	 * sets up the email, attaches the edited image, and sends it.
	 */
	static public function send_postcard(
		$from_email,
		$from_name,
		$to_name,
		$to_email,
		$subject,
		$message,
		$inprocess_path_name)
	{
		date_default_timezone_set('Etc/UTC');

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = $mailerconfig['SMTPDebug'];
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = $mailerconfig['Host'];
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = $mailerconfig['Port'];
		//Whether to use SMTP authentication
		$mail->SMTPAuth = $mailerconfig['SMTPAuth'];
		//Username to use for SMTP authentication
		$mail->Username = $mailerconfig['Username'];
		//Password to use for SMTP authentication
		$mail->Password = $mailer['Password'];
		//Set who the message is to be sent from
		$mail->setFrom($from_email, $from_name);
		//Set an alternative reply-to address
		// @todo adjust reply
$mail->addReplyTo('raymondbyczko@att.net', 'Ray Byczko');
		//Set who the message is to be sent to
		$mail->addAddress($to_email, $to_name);
		//Set the subject line
		$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

$mail->msgHTML('<pre>Some HTML</pre>');
		//Replace the plain text body with one created manually
		$mail->AltBody = $message;
		//Attach an image file
		$mail->addAttachment($inprocess_path_name);

		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!";
		}
	}


	/*
	 * generate_unique_id generates a unique number.
	 * time is sufficient for a prototype site.
	 * @todo improve uniqueness with random number.
	 */
	public static function generate_unique_id()
	{
		return time();
	}

	/* 
	 * @purpose To initially specify the postcard by uploading/taking a picture.
	 * A new postcard record is added to the database.
	 * Because it is declared as private, it cannot be served via a URL request.
	 * The initial underscore serves the same purpose, but is for backward compatability.
	 */
	private function _add()
	{

		$this->m_log->trace('Postcard::_add called');
		if (! file_exists(APPPATH.'/views/postcard/add.php'))
		{
			show_404();
		}
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('from_name', 'From name', 'required');
		$this->form_validation->set_rules('from_email', 'From email', 'required');
		$this->form_validation->set_rules('to_name', 'Recipient name', 'required');
		$this->form_validation->set_rules('to_email', 'Recipient email', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Postcard message', 'required');

		if ($this->form_validation->run() == FALSE)
		{

			$this->m_log->trace('... form_validation returns FALSE');
			$this->load->view('postcard/add');
		}
		else
		{
			$this->m_log->trace('... form_validation returns TRUE');

			// @todo use isset on post vars
			$from_name = $_POST['from_name'];
			$from_email = $_POST['from_email'];
			$to_name = $_POST['to_name'];
			$to_email = $_POST['to_email'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];

			$this->m_log->trace('... from_name='.$from_name);
			$this->m_log->trace('... from_email='.$from_email);
			$this->m_log->trace('... to_name='.$to_name);
			$this->m_log->trace('... to_email='.$to_email);
			$this->m_log->trace('... subject='.$subject);
			$this->m_log->trace('... message='.$message);


			// The following is a test artifact to see how well exceptions are logged via
			// log4php
			// throw new Exception('Test error right before database');
			// Create the postcard here.
			$this->load->model('Postcard_model','', TRUE);
			$id = $this->Postcard_model->add($from_name, $from_email, $to_name, $to_email, $subject, $message);

			$data = array(
							'from_name'=>$from_name,
							'from_email'=>$from_email,
							'to_name'=>$to_name,
							'to_email'=>$to_email,
							'subject'=>$subject,
							'message'=>$message,
							'postcard_id'=>$id
						);
			$this->load->view('postcard/add_complete', $data);

		}
		// echo 'Postcard add called';
	}

	/*
	 * This is a proxy, in a way, that serves to call the real add (that is _add).
	 * This method provides the scaffolding of a try-catch block, logging if an
	 * exception is picked up, and then display of an 'exception' (that is, error)
	 * page.
	 */
	public function add()
	{
		try {
			$this->_add();
		}
		catch (Exception $e)
		{
			$unique_id = Postcard::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Postcard::_add exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			// $this->m_log->trace('... trace='.$trace);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Postcard::_add exception END');

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
     * An alternative to logging a trace recursively, using var_export.
	 */
	private function _recurse_trace_ve($trace)
	{
		$ve_trace = var_export($trace, TRUE);
		$this->m_log->trace('... ... var_export($trace, TRUE)='.$ve_trace);
	}

	/*
	 * recursively explores the trace.  This implementation is draft.
	 * $trace is an array and needs to be more properly recursed into.
	 */
	private function _recurse_trace($trace)
	{
		// Recursively look into trace (to a limited level).
		// @todo This can be made into a method.  It is likely to be reused.
		// by other public controller methods.
		if (!is_array($trace))
		{
			return;
		}
		foreach ($trace as $val_trace)
		{
			if (!is_array($val_trace))
			{
				return;
			}

			$ve_val_trace = var_export($val_trace, TRUE);
			$this->m_log->trace('... ... val trace='.$ve_val_trace);
			foreach ($val_trace as $key=>$value)
			{
				$this->m_log->trace('... ... ... key='.$key);
				$this->m_log->trace('... ... ... value='.$value);
				// if ($value == 'Array')
				if (is_array($value))
				{
					$this->m_log->trace('... ... ... ... value is an array');
					foreach ($value as $key2=>$value2)
					{
						$this->m_log->trace('... ... ... ... key2='.$key2);
						$this->m_log->trace('... ... ... ... value2='.$value2);
					}
				}
			}
		}
	}


	/*
	 * The view postcard/exception needs a controller method, so here it is.
	 * That view is utilized in the exception handler for the add method.
	 * Soon, it will be utilized in the other public methods.
	 *
	 * This method helps display exceptions to the user in a usable format,
	 * by relying on a unique_id, which is a) displayed to the user b) inserted
	 * into the log file.
	 *
	 * note: e_site_url is eventually supplied to data-url, which is utilized by
	 * the JQuery Mobile framework.
	 * @idea The exceptions can be stored into a database table
	 */
	public function exception($unique_id)
	{
			$e_site_url = site_url('postcard/exception/'.$unique_id);
			$data = array(
				'unique_id'=>$unique_id,
				'message'=>'Please check log trace looking for unique_id:'.$unique_id,
				'e_site_url'=>$e_site_url
			);
			$this->load->view('postcard/exception', $data);
	}
	
	/*
	 * This is a proxy, in a way, that serves to call the real upload_now
	 * (that is _upload_now).
	 *
	 * This method provides the scaffolding of a try-catch block, logging if an
	 * exception is picked up, and then display of an 'exception' (that is, error)
	 * page.
	 */
	public function upload_now($postcard_id)
	{
		try {
			$this->_upload_now($postcard_id);
		}
		catch (Exception $e)
		{
			$unique_id = Postcard::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Postcard::_upload_now exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Postcard::_upload_now exception END');

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

	private function _upload_now($postcard_id)
	{
		$this->m_log->trace('Postcard::upload called');
		$this->m_log->trace('...postcard_id='.$postcard_id);
		$dir = Postcard::uploads_dir();
		$config['upload_path']	= APPPATH.'..'.$dir;
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']		= '300KB';
		$config['max_width']	=  '1024';
		$config['max_height']	=  '1024';
		// $config['file_name'] = 'renamed.jpg';


		// The following is a test artifact to see how well exceptions are logged via
		// log4php
		// throw new Exception('Test error in _upload_now');

		$this->load->helper(array('url', 'form'));
		$this->load->library('upload', $config);
		// $this->load->helper(array('form','url'));
		if ( $this->upload->do_upload("userfile") == FALSE)
        {
			$data = array('error' => $this->upload->display_errors(), 'id'=>$postcard_id);
			// $this->load->view('postcard/upload/'.$postcard_id, $data);
			$this->load->view('postcard/upload', $data);
			// return FALSE;
		}
		else
		{

			// $this->load->helper(array('url'));
			$data_file_uploaded = $this->upload->data();
			$upload_file = $data_file_uploaded['file_name'];

			$this->load->model('Postcard_model','', TRUE);
			$this->Postcard_model->update_upload_file($postcard_id, $upload_file);

			// $query = $this->Postcard_model->get_upload_file($postcard_id);
			// $upload_file = $query[0]->postcard_upload_file;
			$upload_path_name = Postcard::uploads_dir().$upload_file;

			$data = array('upload_data' => $data_file_uploaded, 'upload_path_name'=>$upload_path_name, 'postcard_id'=>$postcard_id);

			$this->load->view('postcard/upload_complete', $data);
			// return TRUE;
		}
	}

	/*
	 * @purpose To allow editing of a specific postcard given its postcard_id.
	 */
	private function _edit($postcard_id)
	{

		$this->m_log->trace('Postcard::edit called');
		$this->m_log->trace('...postcard_id='.$postcard_id);
		$this->load->model('Postcard_model','', TRUE);
		$query = $this->Postcard_model->get_upload_file($postcard_id);
		$upload_file = $query[0]->postcard_upload_file;
		$upload_path_name = Postcard::uploads_dir().$upload_file;


		$query2 = $this->Postcard_model->get_postcard($postcard_id);
		$postcard_message = $query2[0]->postcard_message;

		// The following is a test artifact to see how well exceptions are logged via
		// log4php
		// throw new Exception('Test error in _edit');

		$data = array('postcard_id'=>$postcard_id, 'upload_path_name'=>$upload_path_name, 'postcard_message'=>$postcard_message);
		$this->load->view('postcard/edit', $data);
		// echo 'Postcard edit called';
	}

	/*
	 * This is a proxy, in a way, that serves to call the real edit (that is _edit).
	 * This method provides the scaffolding of a try-catch block, logging if an
	 * exception is picked up, and then display of an 'exception' (that is, error)
	 * page.
	 */
	public function edit($postcard_id)
	{
		try {
			$this->_edit($postcard_id);
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
			$unique_id = Postcard::generate_unique_id();
			$message=$e->getMessage();
			$file=$e->getFile();
			$line=$e->getLine();
			$trace=$e->getTrace();

			$this->m_log->trace('Postcard::_edit exception START');
			$this->m_log->trace('... unique_id='.$unique_id);
			$this->m_log->trace('... message='.$message);
			$this->m_log->trace('... file='.$file);
			$this->m_log->trace('... line='.$line);
			$ve_trace = var_export($trace, TRUE);
			$this->m_log->trace('... var_export($trace, TRUE)='.$ve_trace);
			$this->_recurse_trace_ve($trace);
			$this->m_log->trace('Postcard::_edit exception END');

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
	 * @purpose To allow saving of a postcard image once it has been edited via canvas.
	 * This method will be used in a url that is called with a POST parameter, as part
	 * of an ajax interaction.
	 *
	 * This method will return a json data structure indicated how and if the postcard
	 * was saved.
	 *
	 * The POST paramter imagedata is expected.  It represents the contents of a jpg, png or other 
	 * impage postcard file.
	 */
	public function save_postcard($postcard_id)
	{
		header('Content-Type: text/json');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('imagedata', 'Imagedata', 'required');
		$this->m_log->trace('Postcard::save_postcard called');
		$imagedata = $this->input->post('imagedata');
		$post_interface_problem = FALSE;

		//// Putting into the log imagedata tends to be very large.
		//// The call to log trace under this is left here just in case.
		// $this->m_log->trace('... imagedata='.$imagedata);

		// Log the various post parameters.  This was a challenge.
		// Although seen on the console of firebug, this method at times
		// could not see the correct POST parameter.
		//
		// It was eventually cleared up using $.post instead of $.ajax.
		// @todo This is a subject of further research.
		$ak = array_keys($_POST);
		foreach ($ak as $key=>$val)
		{
			$this->m_log->trace('... POST VAL='.$val);
		}
		if ($imagedata == NULL)
		{
			$this->m_log->trace('... imagedata is NULL');
		}
		else
		{
			$this->m_log->trace('... imagedata is not NULL');
			// This means the post parameter is not present.
			$post_interface_problem = TRUE;
		}
		$this->m_log->trace('...postcard_id='.$postcard_id);

		if ($post_interface_problem == FALSE)
		{
			$ret_json = array(
						'ret_code'=>-1, /* 0 is success; -n is failure */
						'reason'=>'The expected post parameter imagedata does not exist',
						'file'=>__FILE__,
						'line'=>__LINE__
			);
			echo json_encode($ret_json);
			return;
		}
		$this->load->model('Postcard_model','', TRUE);
		$query = $this->Postcard_model->get_upload_file($postcard_id);
		$upload_file = $query[0]->postcard_upload_file;
		$inprocess_path_name = '.'.Postcard::inprocess_dir().$upload_file;

		$this->m_log->trace('...inprocess_path_name='.$inprocess_path_name);

		$imagedata = str_replace('data:image/png;base64,', '', $imagedata);
		$imagedata = str_replace('data:image/jpg;base64,', '', $imagedata);
		$imagedata = str_replace(' ', '+', $imagedata);
		$data = base64_decode($imagedata);


		$success = file_put_contents($inprocess_path_name, $data);
		$this->m_log->trace('...success='.$success);

		// $this->load->view('postcard/save_postcard');

		$ret_json = array(
					'ret_code'=>0, /* 0 is success; -n is failure */
					'reason'=>'Successful saving of postcard at'.$inprocess_path_name,
					'file'=>__FILE__,
					'line'=>__LINE__
		);
		echo json_encode($ret_json);
		return;
	}
	/*
	 * @purpose To allow sending of a postcard once it has been edited.
	 */
	public function send($postcard_id)
	{

		$this->m_log->trace('Postcard::send called');
		$this->m_log->trace('... postcard_id='.$postcard_id);
		$this->load->model('Postcard_model','', TRUE);
		$query = $this->Postcard_model->get_postcard($postcard_id);
		$upload_file = $query[0]->postcard_upload_file;
		$inprocess_path_name = '.'.Postcard::inprocess_dir().$upload_file;

		$this->m_log->trace('...inprocess_path_name='.$inprocess_path_name);
		$data = array(
			'inprocess_path_name'=>$inprocess_path_name,
			'postcard_id'=>$postcard_id
		);
		$this->load->view('postcard/send', $data);
	}
	
	/*
	 * This method is actually mean to be called as a post, and is an ajax call back.
	 * However, it may not use many POST parameters, since the postcard_id can be used
	 * to retrieve relevant info from the database.
	 */
	public function send_postcard_ajax($postcard_id, $use_post)
	{

		$from_email = '';
		$from_name = '';
		$to_name = '';
		$to_email = '';
		$subject = '';
		$message = '';
		$inprocess_path_name = '';

		if ($use_post == 1)
		{
			// USE POST MECHANISM.
			$from_email = $_POST['from_email'];
			$from_name = $_POST['from_name'];
			$to_name = $_POST['to_name'];
			$to_email = $_POST['to_email'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$inprocess_path_name = $_POST['inprocess_path_name'];
		}
		else
		{
			// USE DATABASE
			$query = $this->Postcard_model->get_postcard($postcard_id);
			$from_email = '';
			$from_name =  $query[0]->postcard_author;
			$to_name = $query[0]->postcard_recipient_name;
			$to_email = $query[0]->postcard_recipient_email;
			$subject = $query[0]->postcard_subject;
			$message = $query[0]->postcard_message;
			$upload_file = $query[0]->postcard_upload_file;
			$inprocess_path_name = '.'.Postcard::inprocess_dir().$upload_file;

		}

		Postcard::send_postcard(
			$from_email,
			$from_name,
			$to_name,
			$to_email,
			$subject,
			$message,
			$inprocess_path_name
		);
	}

	/*
	 * @purpose To allow cancelling (i.e. removal) of a specific postcard given its postcard_id.
	 */
	public function cancel($postcard_id)
	{

		$this->m_log->trace('Postcard::cancel called');
		$this->m_log->trace('...postcard_id='.$postcard_id);
		$this->load->model('Postcard_model','', TRUE);
		// $id = $this->Postcard_model->delete($postcard_id);

		$query = $this->Postcard_model->get_upload_file($postcard_id);
		$upload_file = $query[0]->postcard_upload_file;
		$upload_path_name = Postcard::uploads_dir().$upload_file;

		$this->m_log->trace('... upload_path_name='.$upload_path_name);

		$exists_upload = file_exists($upload_path_name);

		$this->m_log->trace('... exists_upload='.$exists_upload);

		$this->Postcard_model->delete($postcard_id);


		$data = array('postcard_id'=>$postcard_id, 'upload_file'=>$upload_file);
		// @todo need to inform user of postcard deletion (maybe via dialog).
		$this->load->view('welcomepostcardit/welcome', $data);

	}

	/*
	 * about displays information, via a dialog, about the
	 * postcard it website
	 */
	public function about()
	{

		// THE FOLLOWING WILL GENERATE AN EXCEPTION.
		// $this->load->trace('Postcard::about called');
		$this->m_log->trace('Postcard::about called');
		$this->load->helper(array('url'));
		$data = array();
		$this->load->view('postcard/about', $data);
	}
}
