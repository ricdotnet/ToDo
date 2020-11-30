<?php

    $database = "demo";
    $host = "127.0.0.1";
    $username = "root";
    $password = "";

    $mysqli = new mysqli($host, $username, $password, $database);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

?>