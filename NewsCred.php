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

	protected $api = 'http://api.newscred.com';
	protected $access_key;
	protected $format = 'json';
	protected $data;	

	public function __construct($access_key) {
		if (empty($access_key)) {
			throw new Exception('Provide an API key.');
		} else {
			$this->access_key = $access_key;
		}
	}		
	
	public function searchArticles($options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq( $this->api . '/articles' . $params );		
		return $results;
	}

	public function article($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/article/'.$guid.$params);		
		return $results;
	}
	
	public function articleTopics($options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/article/'.$guid.'/topics'.$params);		
		return $results;
	}

	public function articlesImages($options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/article/'.$guid.'/images'.$params);		
		return $results;
	}

	public function relatedArticles($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/article/'.$guid.'/articles'.$params);		
		return $results;
	}

	public function searchStories($options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/stories'.$params);		
		return $results;
	}

	public function categories($options = array()) {
		if (empty($options['query'])) {
			throw new Exception('The query parameter is required.');
		} else {
			$params = $this->setParams($options);
			$results = $this->apiReq($this->api.'/categories'.$params);		
			return $results;			
		}
	}

	public function categoryArticles($dashnamed, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/category/'.$dashnamed.'/articles'.$params);		
		return $results;
	}
								
	public function categoryStories($dashnamed, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/category/'.$dashnamed.'/stories'.$params);		
		return $results;
	}

	public function categoryImages($dashnamed, $options = array()) {
		$params = $this->setParams($options);
		$this->api = $this->api.'/category/'.$dashnamed.'/images'.$params;
		$results = $this->apiReq();		
		return $results;
	}

	public function categoryTopics($dashnamed, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/category/'.$dashnamed.'/images'.$params);		
		return $results;
	}

	public function categorySources($dashnamed, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/category/'.$dashnamed.'/sources'.$params);		
		return $results;
	}

	public function topic($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.$params);		
		return $results;
	}

	public function topicArticles($guid, $options = array()) {
		$params = $this->setParams($options);
		$this->api = $this->api.'/topic/'.$guid.'/articles'.$params;
		$results = $this->apiReq();		
		return $results;
	}

	public function topicStories($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.'/articles'.$params);		
		return $results;
	}
							
	public function topicImages($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.'/images'.$params);		
		return $results;
	}

	public function trendingTopics($options = array()) {
		if (empty($options['query'])) {
			throw new Exception('The query parameter is required.');
		} else {
			$params = $this->setParams($options);
			$results = $this->apiReq($this->api.'/topics/related'.$params);		
			return $results;			
		}
	}

	public function searchTopics($options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topics'.$params);		
		return $results;
	}

	public function topicSources($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.'/sources'.$params);		
		return $results;
	}
				
	public function topicVideos($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.'/videos'.$params);		
		return $results;
	}

	public function relatedTopics($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topic/'.$guid.'/topics'.$params);		
		return $results;
	}

	public function extractRelatedTopics($options = array()) {
		if (empty($options['query'])) {
			throw new Exception('The query parameter is required.');
		} else {
			$params = $this->setParams($options);
			$this->api = $this->api.'/topics/extract'.$params;
			$results = $this->apiReq();		
			return $results;			
		}
	}

	public function relatedTweets($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/topics/extract'.$params);		
		return $results;
	}

	public function searchVideos($options = array()) {
		if (empty($options['query'])) {
			throw new Exception('The query parameter is required.');
		} else {
			$params = $this->setParams($options);
			$results = $this->apiReq($this->api.'/videos'.$params);		
			return $results;			
		}
	}
					
	public function author($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/author/'.$guid.$params);		
		return $results;
	}

	public function authorArticles($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/author/'.$guid.'/articles'.$params);		
		return $results;
	}
		
	public function authorTopics($guid, $options = array()) {
		$params = $this->setParams($options);
		$results = $this->apiReq($this->api.'/author/'.$guid.'/topics'.$params);		
		return $results;
	}
	
	public function searchTweets($guid, $options = array()) {
		if (empty($options['query'])) {
			throw new Exception('The query parameter is required.');
		} else {
			$params = $this->setParams($options);
			$results = $this->apiReq($this->api.'/tweets'.$params);		
			return $results;			
		}

	}
	
	protected function apiReq($req) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $req);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;	
	}
	
	protected function setParams($options = array()) {
		$params = '?access_key='.$this->access_key;
		foreach ($options as $key => $value) {
			$params .= '&'.urlencode($key).'='.urlencode($value);
		}
		$params .= '&format='.urlencode($this->format);
		return $params;	
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
