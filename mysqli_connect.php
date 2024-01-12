<?php 
DEFINE('HOSTNAME','localhost');
DEFINE('USERNAME', 'root');
DEFINE('PASSWORD', '');
DEFINE('DBNAME','crud');

//creating a connection to php myadmin
$dbcon = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

//check connection
if($dbcon->connect_error) echo "Connection Failed";
else echo "";


?>