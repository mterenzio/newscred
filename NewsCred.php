<?php
namespace NewsCred;
/**
* 
*
* NewsCred
* Class for working with NewsCred API
* ------------------------------------------------------
* https://github.com/mterenzio/newscred
* License: Apache License, Version 2.0
* Date: 2013-09-29
* Copyright 2013 Matt Terenzio
* http://journalab.com
* matt@journalab.com
* http://twitter.com/mterenzio
* ------------------------------------------------------
* 
*/

class NewsCred {

	private $api = 'http://api.newscred.com';
	private $access_key;
	private $format = 'json';	

	public function __construct($access_key) {
		if (empty($access_key)) {
			throw new Exception('Provide an API key.');
		}
	}		
	
	public function searchArticles() {
		$this->api = $this->api.'/articles?access_key='.$this->access_key;
		if (isset($this->query)) {
			$this->api = $this->api.'&query='.$this->query;
		}
		$results = $this->apiReq();		
		return $results;
	}
	
	private function apiReq() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;	
	}
	
	public function __get($property) {
		if (isset($this->data[$property])) {
			return $this->data[$property];			
		} else {
			return false;
		}
	}
	
	public function __set($property, $value) {
		$this->data[$property] = $value;
	}
	
    public function __isset($property) {
        return isset($this->data[$property]);
    }
	
}
?>