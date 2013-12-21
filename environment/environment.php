<?php

require_once(__DIR__.'/locale.php');

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development/*
 *     testing
 *     maintenance
 *     production/*
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */

$in_maintenance = 1;

if (!$in_maintenance) {
	if (preg_match('/d\.eure\.jp/', $_SERVER['SERVER_NAME'])) {
		define('ENVIRONMENT', 'development');
	} else {
		define('ENVIRONMENT', 'production');
	}
} else {
	define('ENVIRONMENT', 'maintenance');
}
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		case 'maintenance':
			header('Location: public/error.php');
			exit;

		default:
			exit('The application environment is not set correctly.');
	}
}

