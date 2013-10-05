<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extended Model Class
 */
class MY_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->master_database();
	}

	public function initialize()
	{
	}

}
// END Extended Model Class

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
