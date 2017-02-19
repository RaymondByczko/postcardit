<?php
/*
 * @file controllers/Postcard.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16
 * @change_history RByczko
 * @status working, but @todo needs cleanup
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postcard extends CI_Controller {

		public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
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
		$this->load->view('utility_message');
	}

	/* 
	 * @purpose To initially specify the postcard by uploading/taking a picture.
	 * A new postcard record is added to the database.
	 */
	public function add()
	{
		// $this->m_log->trace('Postcard::add');
		if (! file_exists(APPPATH.'/views/postcard/add.php'))
		{
			show_404();
		}
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('from', 'Postcard author', 'required');
		$this->form_validation->set_rules('recipient', 'Postcard recipient', 'required');
		$this->form_validation->set_rules('message', 'Postcard message', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('postcard/add');
		}
		else
		{
			// @todo use isset on post vars
			$email = $_POST['email'];
			$from = $_POST['from'];
			$recipient = $_POST['recipient'];
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
			$id = $this->Postcard_model->add($email, $from, $recipient, $message);

			$data = array(
							'email'=>$email,
							'from'=>$from,
							'recipient'=>$recipient,
							'message'=>$message,
							'id'=>$id
						);
			$this->load->view('postcard/add_complete', $data);

		}
		// echo 'Postcard add called';
	}

	public function upload_now($postcard_id)
	{
// ini_set('display_errors', '1'); error_reporting(E_ALL);
		$config['upload_path']	= APPPATH.'/uploads/';
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
			$data = array('upload_data' => $this->upload->data(), 'id'=>$postcard_id);
			$this->load->view('postcard/upload_complete', $data);
			// return TRUE;
		}
	}

	/*
	 * @purpose To allow editing of a specific postcard given its postcard_id.
	 */
	public function edit($postcard_id)
	{
		$this->load->view('postcard/edit');
		// echo 'Postcard edit called';
	}

	/*
	 * @purpose To allow sending of a postcard once it has been edited.
	 */
	public function send($postcard_id)
	{
		$this->load->view('postcard/send');
	}
}
