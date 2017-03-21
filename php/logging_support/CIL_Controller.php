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
 * @change RByczko, 2017-03-21, Removed exception and other
 * redundant methods as follows:
 *	Removed generate_unique_id
 *	Removed _recurse_trace_ve
 *	Removed _recurse_trace
 *	Removed exception
 * These are all found in CIE_Controller, which is derived from
 * CIL_Controller.
 * @done
 * Also removed redundant require_once for CIL_Controller.php.
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once('Logger.php');
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


}
