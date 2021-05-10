<?php
phpinfo();

$mysqli_connection = new MySQLi('localhost', 'webmaster', 'P0ppy@2021', 'poppylive');
if ($mysqli_connection->connect_error) {
   echo "Not connected, error: " . $mysqli_connection->connect_error;
}
else {
   echo "Connected.";
}