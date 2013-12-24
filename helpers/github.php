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

	// REST methods
	function  get( $service="", $params=array() ){

		// check cache before....
		//...

		$url = $this->api . $service .".json";

		$results = $this->oauth->request($url, 'GET', $params);

		return json_decode( $results );

	}


	function  post() {

	}

	function  put() {

	}

	function  delete() {

	}

	// Helpers

	function token(){
		return $this->oauth->request("https://api.github.com/authorizations", "POST", array("grant_type"=>"client_credentials") );
	}
}

?>