<?php
/*
 * @file controllers/Postcard.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16
 * @change_history RByczko, 2017-02-19, Enhanced edit functionality.
 * @change_history RByczko, 2017-02-20, Added DRY dir static methods.
 * @change_history RByczko, 2017-02-20, Load javascript library.
 * Enhance upload_complete.
 * @todo Loading javascript may change to false.
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
				$this->load->library(
						'javascript',
						array(
								'autoload' => TRUE
						)
				);
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
			$data = array('upload_data' => $data_file_uploaded, 'id'=>$postcard_id);
			$upload_file = $data_file_uploaded['file_name'];

			$this->load->model('Postcard_model','', TRUE);
			$this->Postcard_model->update_upload_file($postcard_id, $upload_file);
			$this->load->view('postcard/upload_complete', $data);
			// return TRUE;
		}
	}

	/*
	 * @purpose To allow editing of a specific postcard given its postcard_id.
	 */
	public function edit($postcard_id)
	{

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
	 * @purpose To allow sending of a postcard once it has been edited.
	 */
	public function send($postcard_id)
	{
		$this->load->view('postcard/send');
	}
}
