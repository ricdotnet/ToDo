<?php

ob_start();
session_start();

$ip = $_SERVER['HTTP_CLIENT_IP'];

?>
<html>

    <?php

        require("mysqlconn.php");

        //variables
        $title = "To Do App with PHP";

    ?>

    <head>
        <title><?php echo $title ?></title>

        <link rel="stylesheet" href="style.css">
    </head>

    <body>