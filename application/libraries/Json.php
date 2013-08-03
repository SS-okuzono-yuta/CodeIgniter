<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * JSON Class
 */
class Json {

	public function encode($data = array())
	{
		$data = $this->_convert_data_to_string($data);
		$CI =& get_instance();
		$CI->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	private function _convert_data_to_string($data)
	{
		if (is_object($data)) {
			$data = (Array)$data;
		}
		if (is_array($data)) {
			foreach ($data as &$val) {
				$val = $this->_convert_data_to_string($val);
			}
			return $data;
		} else if (is_bool($data)) {
			return ($data ? '1' : '0');
		} else if (is_null($data)) {
			return '';
		} else {
			return (string)$data;
		}
	}

}
// END JSON Class

/* End of file Json.php */
/* Location: ./application/libraries/Json.php */
