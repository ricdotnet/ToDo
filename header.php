<?php

ob_start();

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