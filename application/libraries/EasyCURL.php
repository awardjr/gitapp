<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//As we're only dealing with gets, the implementation will be kept simple
class EasyCURL {

	private $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}

    public function curl_get($url)
    {
    	$this->CI->load->helper('url');

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, site_url());
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$results = curl_exec($curl);
		
		curl_close($curl);
		return json_decode($results); 
    }
}
