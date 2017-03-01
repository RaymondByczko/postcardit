<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @file Welcomepostcardit.php
 * @location application/controllers/
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-28, February 28, 2017
 * @purpose This is the highest level controller first encountered
 * that is, upon the user bringing up the postcardit web site.
 */
class Welcomepostcardit extends CI_Controller {


	public function __construct()
	{
			parent::__construct();
			// url is needed for site_url.
			$this->load->helper(array('url'));
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcomepostcardit
	 *	- or -
	 * 		http://example.com/index.php/welcomepostcardit/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcomepostcardit/welcome');
	}
}
