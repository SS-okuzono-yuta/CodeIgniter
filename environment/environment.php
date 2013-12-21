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
 *     development
 *     testing
 *     maintenance
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */

if (getenv('CI_IN_MAINTENANCE')) {
	define('ENVIRONMENT', 'maintenance');
} else {
	if (getenv('CI_IN_DEVELOPMENT')) {
		define('ENVIRONMENT', 'development');
	} else {
		define('ENVIRONMENT', 'production');
	}
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
			error_reporting(E_ALL | E_STRICT);
		break;
	
		case 'production':
			error_reporting(E_ALL & ~E_DEPRECATED);
		break;

		case 'testing':
			error_reporting(0);
		break;

		case 'maintenance':
			exit('The application is in maintenance.');

		default:
			exit('The application environment is not set correctly.');
	}
}
if (getenv('CI_DISABLE_ERROR_REPORTING')) {
	error_reporting(0);
}
