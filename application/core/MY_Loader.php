<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extended Loader Class
 */
class MY_Loader extends CI_Loader {

	public function __construct()
	{
		parent::__construct();
	}

	protected function _add_view_path($path)
	{
		$this->_ci_view_paths += array($path => TRUE);
	}

	protected function _change_view_path($path)
	{
		$this->_ci_view_paths = $path;
	}

}
// END Extended Loader Class

/* End of file MY_Loader.php */
/* Location: ./application/core/MY_Loader.php */
