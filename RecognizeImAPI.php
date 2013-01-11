<?php
/**
 * api call wrapper
 */
class RecognizeImAPI {
	//! soap client instance
	private static $api;
	private static $config;

	//! connect
	public static function init(){
		self::$config = require('config.php');
		self::$api = new SoapClient(NULL, array('location' => self::$config['URL'], 'uri' => self::$config['URL'], 'trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
		$r = self::$api->auth(self::$config['CLIENT_ID'], self::$config['CLAPI_KEY'], NULL);
		if (is_object($r))
			$r = (array)$r;
		if ($r['status']) {
			throw new Exception("Cannot authenticate");
		}
	}

	/**
	 * wrap api call
	 * @param $name fn name
	 * @param $arguments fn args
	 */
	public static function __callStatic($name, $arguments) {
		$r = call_user_func_array(array(self::$api, $name), $arguments);
		if (is_object($r))
			$r = (array)$r;
		if (!$r['status']) {
			return array_key_exists('data', $r)?$r['data']:NULL;
		}		
		throw new Exception($r['message'], $r['status']);
	}

	/**
	 * Recognize object using image
	 * @param $image query
	 * @param $mode Recognition mode. Should be 'single' or 'multi'. Default is 'single'.
	 * @param $allResults if TRUE returns all recognized objects in 'single' mode; otherwize only the best one
	 * @returns associative array containg recognition result
	 */
	public static function recognize($image, $mode = 'single', $allResults = FALSE) {
			if (!in_array($mode, array('single', 'multi')))
				throw new Exception('Wrong \'mode\' value. Should be "single" or "multi"');
			$hash = md5(self::$config['API_KEY'].$image);
			$url = self::$config['URL'].'/recognize/';
			if ($mode == 'multi') {
				$url .='multi/';
			} else if ($allResults) {
				$url .= 'allResults/';
			}
			$url .= self::$config['CLIENT_ID'];
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('x-itraff-hash: '.$hash, 'Content-type: image/jpeg'));
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $image);
			$obj = curl_exec($ch);
			$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($status != '200')
				throw new Exception('Cannot upload photo');
			return (array)json_decode($obj);
	}
};
RecognizeImAPI::init();
