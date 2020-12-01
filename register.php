<?php 

    require("header.php");

    //if session is set redirect to index.php
    if(isset($_SESSION['name'])) {

        //if a session is set redirect to index
        header("Location: index.php");

    } else {

    ?>

    <div id="header"> </div>

    <div class="container">

        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input class="input-box mb25" name="username" placeholder="Username">
            <input class="input-box mb25" name="email" placeholder="Email">
            <input class="input-box mb25" name="password" placeholder="Password">
            <button type="submit">Register Account</button>
        </form>

        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                //if username is empty
                if(empty($username)) {
                    echo "<div class='error-box'>Please enter a username.</div>";
                    header("Refresh: 1; register.php");
                
                //if empty password
                } else if(empty($password)) {
                    echo "<div class='error-box'>Please enter a password.</div>";
                    header("Refresh: 1; register.php");

                //if email is empty
                } else if(empty($email)) {
                    echo "<div class='error-box'>Please enter a valid email.</div>";
                    header("Refresh: 1; register.php");

                //check for repeated username or email
                } else if(!empty($username) && (!empty($email)) && (!empty($password))) {
                    
                    //get usernames and emails from registered users and check for duplicates
                    $check_duplicates = $mysqli->query("select * from users");
                    $duplicates = $check_duplicates->fetch_assoc();

                    //if username is used
                    if($duplicates['username'] == $username) {
                        echo "<div class='error-box'>That username is already being used.</div>";
                        header("Refresh: 1; register.php");

                    //if email address is used
                    } else if($duplicates['email'] == $email) {
                        echo "<div class='error-box'>That email address is already registered.</div>";
                        header("Refresh: 1; register.php");

                    //if all good register the user
                    } else {
                        
                        $mysqli->query("insert into users values (null, '$username', '$password', '$email')"); //insert into database
                        echo "<div class='confirm-box'>User registered with success.</div>"; //show confirmation message

                        header("Refresh: 2; http://localhost:3000"); //redirect to index.php

                    }

                }

            } //end post function

        ?>

    </div>

    <?php

    } //end of else statement

?>