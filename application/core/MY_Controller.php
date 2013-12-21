<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extended Controller Class
 */
class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		set_exception_handler(array($this, 'exception_handler'));
	}

	public function exception_handler(Exception $e)
	{
		debug_log("#{$e->getCode()}: {$e->getMessage()}", 'exception');
	}

}
// END Extended Controller Class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
