<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Debug Logging Interface
 */
if (!function_exists('debug_log'))
{
	function debug_log($message, $prefix = 'debug', $php_error = FALSE)
	{
		$_log =& load_class('Log');
		$_log->write_log('DEBUG', $message, $php_error, $prefix.'-', TRUE);
	}
}

/* End of file log_helper.php */
/* Location: ./application/helpers/log_helper.php */
