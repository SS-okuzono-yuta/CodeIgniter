<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File:        Safety
 * Version:     0.5
 * Maintainer:  Shintaro Kaneko <kaneshin0120@gmail.com>
 * Last Change: 21-Dec-2013.
 */
class Safety {

	private $CI;

	private $_security_salt;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('security');
		$this->CI->load->helper('Security');

		$this->_security_salt = $this->CI->config->item('security_salt');

		if ($this->_security_salt == '')
		{
			show_error('In order to use the Safety class you are required to set a security salt in your config file.');
		}
	}

	public function get_salt()
	{
		return $this->_security_salt;
	}

	public function do_sha1($value)
	{
		return do_hash($value, 'sha1');
	}

	public function stretch($value, $count = 1000)
	{
		for ($i = 0; $i < $count; ++$i) {
			$value = $this->do_sha1($value);
		}
		return $value;
	}

}
// END Safety Class

/* End of file Safety.php */
/* Location: ./application/libraries/Safety.php */
