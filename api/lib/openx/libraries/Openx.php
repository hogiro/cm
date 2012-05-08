<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Openx class
 * CodeIgniter library for openx API
 * author => alex michaud (alex.michaud@gmail.com)
 * openx API reference => http://developer.openx.org/api/
 * class documentation => (todo)
 * v0.1 october 4, 2009
 */
class Openx
{
	private $_host;
	private $_api;
	private $_username;
	private $_password;
	private $_port;
	private $_session_id;
	static $_config;
	
	private $_CI;
	
	function __construct()
	{
		$this->_CI = &get_instance();
		
		/*** You should have a file named "openx.php" in your config directory ***/
		$this->_CI->config->load('openx', true);
		
		$this->_config = $this->_CI->config->item('openx');
		$this->_host	= $this->_config['host'];
		$this->_api		= $this->_config['api'];
		$this->_username= $this->_config['username'];
		$this->_password= $this->_config['password'];
		$this->_port 	= $this->_config['port'];
		
		$this->_CI->load->library('xmlrpc');
		
		$this->_logon();
	}
	
	function __destruct()
	{
		$this->_logoff();
	}
	
	/**
	 * logon the openx API service and set the session id
	 * @return void
	 */
	private function _logon()
	{
		$this->_CI->xmlrpc->server($this->_host.$this->_api, $this->_port);
		$this->_session_id = $this->_oxFunction('logon', array($this->_setDataType($this->_username), $this->_setDataType($this->_password)));
	}
	
	/**
	 * logoff the openx API service and unset the session id
	 * @return void
	 */
	private function _logoff()
	{
		$this->_oxFunction('logoff', array($this->_session_id));
		unset($this->_session_id);
	}
	
	/**
	 * Send request to OpenX service
	 * @param array $request
	 * @return mixed
	 */
	private function _request($request)
	{
		$this->_CI->xmlrpc->request($request);
		if(!$this->_CI->xmlrpc->send_request())
		    exit($this->_CI->xmlrpc->display_error());
		else
		{
			$response = $this->_CI->xmlrpc->display_response();
			if(is_numeric($response))
			{
				if(preg_match('/^\d+$/' , $response))
					return intval($response);
				else
					return floatval($response);
			}
			else
				return $response;
		}
	}
	
	/**
	 * Set the xmlrpc method and do the request 
	 * @param string $functionName
	 * @param array $request
	 * @return mixed
	 */
	private function _oxFunction($functionName, $request)
	{
		$this->_CI->xmlrpc->method('ox.'.$functionName);
		return $this->_request($request);
	}
	
	/**
	 * Build a request that can be used by OpenX xmlrpc call
	 * @param array $arguments
	 * @return array
	 */
	private function _buildRequest($arguments)
	{
		$request[] = array($this->_session_id, 'string');
		foreach($arguments as $key=>$value)
			$request[] = $this->_setDataType($value);
		return $request;
	}
	
	/**
	 * Set the data type for the xml-rpc request
	 * @param mixed $value
	 * @return array (xmlrpc format)
	 */
	private function _setDataType($value)
	{
		// if : string contain a numeric value
		if(is_string($value) && is_numeric($value))
		{
			// if : string contain a int
			if(preg_match('/^[+\-]?\d+$/',$value))
				$value = (int)$value;
			// else : must be a float
			else
				$value = (double)$value;
		}
		switch(strtolower(gettype($value)))
		{
			case "boolean" :
				return array($value, 'boolean');
				break;
			case "integer" :
				return array($value, 'int');
				break;
			case "double" :
				return array($value, 'double');
				break;
			case "array" :
				foreach($value as $k=>$v)
					$arr[$k] = $this->_setDataType($v);
				$structOrArray = is_int(key($arr))?'array':'struct';
				return array($arr, $structOrArray);
				break;
			default :
				// if : value is a DateTime object
				if(is_object($value))
					return array($value->format("Ymd"), 'dateTime.iso8601');
				// else : default to string
				else
					return array($value, 'string');
				break;
		}
	}
	
	/**
	 * Magic method. Will be called automatically and "simulate" any OpenX API method.
	 * @param string $method
	 * @param array $args
	 * @return mixed
	 */
	public function __call($method, $args)
	{
		return $this->_oxFunction($method, $this->_buildRequest($args));
	}
}
?>