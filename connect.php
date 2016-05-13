<?php
/*** mysql hostname ***/
$hostname = '127.0.0.1';

/*** mysql username ***/
$dbusername = 'root';

/*** mysql password ***/
$password = 'root';

$dbh = new PDO("mysql:host=$hostname;dbname=MovieZ", $dbusername, $password);
?>