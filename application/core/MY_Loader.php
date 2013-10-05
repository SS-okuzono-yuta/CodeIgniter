<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extended Loader Class
 */
class MY_Loader extends CI_Loader {

	protected static $master_db = null;
	protected static $slave_db = null;

	public function __construct()
	{
		parent::__construct();
	}

	public function add_view_path($path)
	{
		$this->_ci_view_paths += array($path => TRUE);
	}

	public function change_view_path($path)
	{
		$this->_ci_view_paths = $path;
	}

	/**
	 * Extended Database Loader for Replication
	 *
	 * @param	string	the DB credentials
	 * @param	bool	whether to return the DB object
	 * @param	bool	whether to enable active record (this allows us to override the config setting)
	 * @return	object
	 */
	public function database($params = '', $return = FALSE, $active_record = NULL)
	{
		// Grab the super object
		$CI =& get_instance();

		// Do we even need to load the database class?
		if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->slave_db) AND is_object($CI->slave_db))
		{
			return FALSE;
		}

		require_once(BASEPATH.'database/DB.php');

		if ($return === TRUE)
		{
			return DB($params, $active_record);
		}

		// Initialize the db variable.  Needed to prevent
		// reference errors with some configurations
		$CI->db = '';

		// Load the DB class
		$CI->db =& DB($params, $active_record);
	}

	/**
	 * Master Database Loader
	 */
	public function master_database($params = '')
	{
		// Grab the super object
		$CI =& get_instance();

		if (null === self::$master_db)
		{
			self::$master_db = $CI->load->database($params, TRUE);
		}
		// Load the Master DB class
		$CI->db =& self::$master_db;
	}

	/**
	 * Slave Database Loader
	 */
	public function slave_database($params = '')
	{
		// Grab the super object
		$CI =& get_instance();

		if (null === self::$slave_db)
		{
			if ('' === $params)
			{
				// Is the config file in the environment folder?
				if (defined('ENVIRONMENT') AND file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php'))
				{
					include($file_path);
				}
				else if (!file_exists($file_path = APPPATH.'config/database.php'))
				{
					include($file_path);
				}

				if (isset($slave_group))
				{
					$params = $slave_group;
				}
			}
			self::$slave_db = $CI->load->database($params, TRUE);
		}
		// Load the Master DB class
		$CI->db =& self::$slave_db;
	}

}
// END Extended Loader Class

/* End of file MY_Loader.php */
/* Location: ./application/core/MY_Loader.php */
