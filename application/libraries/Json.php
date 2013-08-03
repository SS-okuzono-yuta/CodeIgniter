<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * JSON Class
 */
class Json {

	public function convert($data = array())
	{
		return json_encode($this->convert_data($data));
	}

	public function output($data = array())
	{
		$json = $this->convert($data);
		$CI =& get_instance();
		$CI->output
			->set_content_type('application/json')
			->set_output($json);
	}

	private function convert_data($data)
	{
		if (is_object($data)) {
			$data = (Array)$data;
		}
		if (is_array($data)) {
			foreach ($data as &$val) {
				$val = $this->convert_data($val);
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
