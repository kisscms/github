<?php
// FIX - to include the base OAuth lib not in alphabetical order
//require_once( APP . "plugins/oauth/helpers/kiss_oauth.php" );
$oauth = getPath("oauth/helpers/kiss_oauth.php");
if( $oauth === false) exit("Missing dependency: OAuth plugin ( http://github.com/kisscms/oauth )");
require_once( $oauth );

/* Github for KISSCMS */
class Github_OAuth extends KISS_OAuth_v2 {

	function  __construct( $api="github", $url="https://github.com/login" ) {

		$this->url = array(
			'authorize' 		=> $url ."/authorize",
			'request_token' 	=> $url ."/request_token",
			'access_token' 		=> $url ."/access_token",
		);

		parent::__construct( $api, $url );

	}

	function save( $response ){
		//...
		// save to the user session
		$_SESSION['oauth']['github'] = $response;

	}

}
