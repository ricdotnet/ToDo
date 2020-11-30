<?php

    require("mysqlconn.php");

    if(!$mysqli->query("CREATE TABLE todo (id INT PRIMARY KEY AUTO_INCREMENT, todo VARCHAR(255) NOT NULL)")) {
        echo $mysqli->error;
    } else {
        echo "Table todo created succesfully.";
    }

?>