<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Is Production
 *
 * @access	public
 * @return	bool
 */
if (!function_exists('is_production'))
{
	function is_production()
	{
		return ('production' === ENVIRONMENT);
	}
}

/**
 * Is Mobile
 *
 * @access	public
 * @return	bool
 */
if (!function_exists('is_mobile'))
{
	function is_mobile()
	{
		$CI =& get_instance();
		$CI->load->library('user_agent');
		return $CI->agent->is_mobile();
	}
}

/**
 * Debug dump
 *
 * @access	public
 * @param	mixed
 */
if (!function_exists('debug_dump'))
{
	function debug_dump($val)
	{
		if (!is_production())
		{
			echo('<pre>');
			var_dump($val);
			echo('</pre>');
		}
	}
}

/* End of file universal_helper.php */
/* Location: ./application/helpers/universal_helper.php */
