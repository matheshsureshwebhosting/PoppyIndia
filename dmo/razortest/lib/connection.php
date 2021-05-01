<?php

ob_start();

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();


// HTTP
define('HTTP_SERVER', 'https://www.poppyindia.com/demo/');
define('COMPANY_NAME', 'Poppy Mattress');
define('DIR_ROOT', '/home/shineiog/public_html/poppyindia.com/demo/');

define('ID_PREFIX', 'PM');



define('DIR_SLIDER', DIR_ROOT.'images/main-slider/');
define('HTTP_SLIDER', HTTP_SERVER.'images/main-slider/');




class Connection { var $hostname, $username, $password, $database, $connection;

function __construct() {

		$this->hostname = "localhost";//Database host.

		$this->username = "shineiog_poppy"; //Database username.

		$this->password = "4Mo+tkCFJ{g{"; //Database password.

		$this->database = "shineiog_poppy";//Database.local
	

		$this->dbConnection(); 

	}

	

	

	public function dbConnection () {

		$this->connection = mysqli_connect($this->hostname,$this->username,$this->password,$this->database) or die ('Cannot make a connection');

	}

}

$connect = new Connection();
date_default_timezone_set('Asia/Kolkata');
extract($_REQUEST);
?>