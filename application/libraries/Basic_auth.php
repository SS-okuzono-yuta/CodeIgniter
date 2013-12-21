<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File:        Basic_auth
 * Version:     0.3
 * Maintainer:  Shintaro Kaneko <kaneshin0120@gmail.com>
 * Last Change: 21-Dec-2013.
 */
class Basic_auth {

	private $CI;

	private $_admin_user;
	private $_admin_password;

	private $_logged_in_key = 'logged_in';

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('admin');
		$this->_admin_user = $this->CI->config->item('admin_user');
		$this->_admin_password = $this->CI->config->item('admin_password');

		if ($this->_admin_user == '')
		{
			show_error('In order to use the Basic_auth class you are required to set an admin user in your config file.');
		}
	}

	public function login()
	{
		$this->CI->load->library('session');
		$logged_in = $this->CI->session->userdata($this->_logged_in_key);
		if ($logged_in !== TRUE)
		{
			if ($this->headers_401())
			{
				$this->CI->session->set_userdata(array(
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
		$user = $this->_admin_user;
		$password = $this->_admin_password;

		if (($this->CI->input->server('PHP_AUTH_USER') === $user)
			&& ($this->CI->input->server('PHP_AUTH_PW') === $password))
		{
			return TRUE;
		} else {
			header('WWW-Authenticate: Basic realm="SMF Studios"');
			header('HTTP/1.0 401 Unauthorized');
		}
		return FALSE;
	}

}

/* End of file Basic_auth.php */
/* Location: ./application/libraries/Basic_auth.php */
