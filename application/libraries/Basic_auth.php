<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File:        Basic_auth
 * Version:     0.2
 * Maintainer:  Shintaro Kaneko <kaneshin0120@gmail.com>
 * Last Change: 15-Sep-2013.
 */
class Basic_auth {

	private $_default_user = 'admin';
	private $_default_password = '';

	private $_admin_user;
	private $_admin_password;

	private $_logged_in_key = 'logged_in';

	public function __construct()
	{
		$config =& get_config();
		$this->_admin_user = (isset($config['admin_user']))? $config['admin_user'] : $this->_default_user;
		$this->_admin_password = (isset($config['admin_password'])) ? $config['admin_password'] : $this->_default_password;
	}

	public function login()
	{
		$CI =& get_instance();
		$logged_in = $CI->session->userdata($this->_logged_in_key);
		if ($logged_in !== TRUE)
		{
			if ($this->headers_401())
			{
				$CI->session->set_userdata(array(
					$this->_logged_in_key => TRUE
				));
			}
			else
			{
				die("Please enter a valid username and password");
			}
		}
	}

	private function headers_401()
	{
		$CI =& get_instance();
		$user = $this->_admin_user;
		$password = $this->_admin_password;
		if (!$CI->input->server('PHP_AUTH_USER'))
		{
			header('WWW-Authenticate: Basic realm="SMF Studios"');
			header('HTTP/1.0 401 Unauthorized');
		}
		else
		{
			if (($CI->input->server('PHP_AUTH_USER') === $user) && ($CI->input->server('PHP_AUTH_PW') === $password))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

}

/* End of file Basic_auth.php */
/* Location: ./application/libraries/Basic_auth.php */
