<?php
/*
 * @file controllers/Utility.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16 (approx)
 * @purpose To add various utility URLs through its own controller.
 * Database version is one aspect covered by Utility.
 * @todo Loading javascript may change to false.
 * @status working, @todo needs review
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/utility
	 *	- or -
	 * 		http://example.com/index.php/utility/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/utility/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('utility/utility_message');
	}

	/* 
	 * @purpose To adjust the database schema to a certain version in the migration
	 * plan.  To set it at a certain version, make sure $version is the timestamp
	 * associated with the migration file under:
	 * 	postcardit/igniter/application/migrations
	 *
	 * For example, $version can be set to:
	 *	20170215175754
	 * This corresponds to file:
	 * 	20170215175754_add_account.php
	 *
	 * Here is an example where the numerical part is supplied correctly in a URL.
	 * 	http://postcardit.dev/index.php/account/databaseversion/20170215175754
	 */
	public function databaseversion($version)
	{
		$this->load->library('migration');
		if (!$this->migration->version($version))
		{
			show_error($this->migration->error_string());
		}
		echo 'Migration (version) called';
	}
	public function databaseremove()
	{
		// $this->m_log->trace('Account::datebaseremove called');

		$this->load->library('migration');
		if (!$this->migration->version(0))
		{
			show_error($this->migration->error_string());
		}
		echo 'Migration called';
	}
}
