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
 * Also added: send, send_postcard_ajax
 * @todo Loading javascript may change to false.
 * @status working, but @todo needs cleanup, especially save_postcard.
 * However, at least I am able to see the _POST parameters.
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
	 * @purpose To initially specify the postcard by uploading/taking a picture.
	 * A new postcard record is added to the database.
	 */
	public function add()
	{

		$this->m_log->trace('Postcard::add called');
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
			$this->load->view('postcard/add');
		}
		else
		{
			// @todo use isset on post vars
			$from_name = $_POST['from_name'];
			$from_email = $_POST['from_email'];
			$to_name = $_POST['to_name'];
			$to_email = $_POST['to_email'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			/*
			$data = array(
							'email'=>$email,
							'from'=>$from,
							'recipient'=>$recipient,
							'message'=>$message
						);
			*/
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

	public function upload_now($postcard_id)
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


		$this->load->helper('form');
		$this->load->helper('url');
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
			$data_file_uploaded = $this->upload->data();
			$upload_file = $data_file_uploaded['file_name'];

			$this->load->model('Postcard_model','', TRUE);
			$this->Postcard_model->update_upload_file($postcard_id, $upload_file);

			// $query = $this->Postcard_model->get_upload_file($postcard_id);
			// $upload_file = $query[0]->postcard_upload_file;
			$upload_path_name = Postcard::uploads_dir().$upload_file;

			$data = array('upload_data' => $data_file_uploaded, 'upload_path_name'=>$upload_path_name, 'id'=>$postcard_id);

			$this->load->view('postcard/upload_complete', $data);
			// return TRUE;
		}
	}

	/*
	 * @purpose To allow editing of a specific postcard given its postcard_id.
	 */
	public function edit($postcard_id)
	{

		$this->m_log->trace('Postcard::edit called');
		$this->m_log->trace('...postcard_id='.$postcard_id);
		$this->load->model('Postcard_model','', TRUE);
		$query = $this->Postcard_model->get_upload_file($postcard_id);
		$upload_file = $query[0]->postcard_upload_file;
		$upload_path_name = Postcard::uploads_dir().$upload_file;


		$query2 = $this->Postcard_model->get_postcard($postcard_id);
		$postcard_message = $query2[0]->postcard_message;

		$data = array('postcard_id'=>$postcard_id, 'upload_path_name'=>$upload_path_name, 'postcard_message'=>$postcard_message);
		$this->load->view('postcard/edit', $data);
		// echo 'Postcard edit called';
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
			'inprocess_path_name'=>$inprocess_path_name
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
}
