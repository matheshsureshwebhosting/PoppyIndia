<?php

ob_start();

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();


// HTTP
define('HTTP_SERVER', 'https://www.poppyindia.com/');
define('HTTPS_SERVER', 'https://www.poppyindia.com/');
define('COMPANY_NAME', 'Poppy Mattress');
define('DIR_ROOT', '/var/www/poppyindia.com/');

define('ID_PREFIX', 'PM');



define('DIR_SLIDER', DIR_ROOT.'images/main-slider/');
define('HTTP_SLIDER', HTTP_SERVER.'images/main-slider/');




class Connection { var $hostname, $username, $password, $database, $connection;

function __construct() {

		$this->hostname = "localhost:3306";//Database host.

		$this->username = "root"; //Database username.

		$this->password = "P0ppy@2021"; //Database password.

		$this->database = "poppylive";//Database.local
	

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