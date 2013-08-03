<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File:        Basic_auth
 * Version:     0.1
 * Maintainer:  Shintaro Kaneko <kaneshin0120@gmail.com>
 * Last Change: 02-Jul-2013.
 */
class Basic_auth {

	var $_default_user = 'admin';
	var $_default_password = '';

	var $_admin_user;
	var $_admin_password;

	var $_logged_in_key = 'logged_in';

	public function __construct()
	{
		$config =& get_config();
		$this->_admin_user = (isset($config['admin_user']))? $config['admin_user'] : $this->_default_user;
		$this->_admin_password = (isset($config['admin_password'])) ? $config['admin_password'] : $this->_default_password;
	}

	public function require_login()
	{
		$CI =& get_instance();
		$logged_in = $CI->session->userdata($this->_logged_in_key);
		if ($logged_in !== TRUE) {
			$this->headers_401();
			$CI->session->set_userdata(array(
				$this->_logged_in_key => TRUE
			));
		}
	}

	private function headers_401()
	{
		$user = $this->_admin_user;
		$password = $this->_admin_password;
		if (!isset($_SERVER['PHP_AUTH_USER'])) {
			header('WWW-Authenticate: Basic realm="SMF Studios"');
			header('HTTP/1.0 401 Unauthorized');
			echo("Please enter a valid username and password");
			exit();
		} else if (($_SERVER['PHP_AUTH_USER'] === $user) && ($_SERVER['PHP_AUTH_PW'] === $password)) {
			return true;
		} else {
			echo("Please enter a valid username and password");
			exit();
		}
	}

}

/* End of file Basic_auth.php */
/* Location: ./application/libraries/Basic_auth.php */
