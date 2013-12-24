<?php


//===============================================
// Configuration
//===============================================

if( class_exists('Config') && method_exists(new Config(),'register')){

	// Register variables
	Config::register("github", "key", "0000000");
	Config::register("github", "secret", "AAAAAAAAA");

}

?>