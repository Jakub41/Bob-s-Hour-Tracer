<?php
//Database connection
$db_host		  = "host=127.0.0.1";
$db_port		  = "port=5432";
$db_name		  = "dbname=hourtracer";
$db_user		  = "user=postgres";
$db_password 	= "password="; //the second password you set when installing postgresql

$db = pg_connect("$db_host $db_port $db_name $db_user $db_password");
if (!$db) {
    die("Error : Unable to open database");
}

?>
