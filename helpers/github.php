<?php
/* Github for KISSCMS */
class Github {

	private $api;
	private $oauth;
	private $config;
	private $creds;
	private $cache;

	function  __construct() {
		// main URL
		$this->api = "https://api.github.com/";

		// load all the necessery subclasses
		$this->oauth = new Github_OAuth();

		$this->config = $GLOBALS['config']['github'];
		// get/update the creds
		$this->creds = $this->oauth->creds();

	}

	function request($method='GET', $service="", $params=array() ){

		$url = $this->api . $service;
		// add access token
		if( empty($params["oauth_token"]) ) $params["oauth_token"] = $this->creds["access_token"];

		$http = new Http();
		$http->setMethod($method);
		$http->setParams( $params );
		$http->execute( $url );

		if($http->error) die($http->error);

		// decode json string as a php object
		$results = json_decode($http->result);
		// check if the response if valid
		$valid = ( !empty($results->meta->code) && $results->meta->code == 200 );

		// log errors...

		// just return the repsonse (or the whole response to display error messages
		return ($valid) ? $results->response : $results;

	}

	// REST methods
	function  get( $service="", $params=array() ){

		// check cache before....
		//...
		$results = $this->request('GET', $service, $params );

		return $results;

	}


	function  post( $service="", $params=array() ){

		$results = $this->request('POST', $service, $params );

		return $results;

	}

	function  put( $service="", $params=array() ){

		$results = $this->request('PUT', $service, $params );

		return $results;

	}

	function  delete( $service="", $params=array() ){

		$results = $this->request('DELETE', $service, $params );

		return $results;

	}

	// Helpers

	function token(){
		return $this->oauth->request("https://api.github.com/authorizations", "POST", array("grant_type"=>"client_credentials") );
	}
}

?>