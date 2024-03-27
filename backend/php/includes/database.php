<?php

// Database Connection settings
$host       = "localhost";
$user       = "root";
$password   = "";
$database   = "user_collection";


$mysql = new mysqli($host, $user, $password, $database);

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

?>

