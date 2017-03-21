<?php
/*
 * @file php/logging_support/CIL_Controller.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-03-18
 * @change_history RByczko, 2017-
 * @purpose The CIL_Controller class extends CI_Controller by
 * adding logging capability to CI_Controller.  This reuse
 * of software is done by inheritance.
 * @todo The exception method might be redundant since its
 * provided in CIE_Controller class. It might be removed.
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once('Logger.php');
require_once('logging_support/CIL_Controller.php');
Logger::configure('../postcarditlog4php.xml');

abstract class CIL_Controller extends CI_Controller {

		// These protected members support 'apache log4php'.
		protected $m_cc_dot=null;

		protected $m_log=null;

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
				// @todo check this
				// $cc = get_class();
				$this->m_cc_dot = str_replace("\\", ".", $cc);
				$this->m_log = \Logger::getLogger($this->m_cc_dot);
				$this->m_log->trace('CIL_Controller contructor called');
				$this->m_log->trace('...logger name (get_called..)='.$this->m_cc_dot);

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
	

}
