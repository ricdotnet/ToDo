<?php

    require("header.php");

    if(isset($_SESSION['name'])) {
        echo "logged in";
        header("Location: index.php");
    }

?>

<div id="header">
    
</div>

<div id="container">
    
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <input class="input-box mb25" name="username" placeholder="Username">
        <input class="input-box mb25" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

<?php

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        //check for username
        if(empty($username)) {
            echo "<div class='error-box'>You need to enter a username.</div>";
            header("Refresh: 1; login.php");

        //check for password
        } else if(empty($password)) {
            echo "<div class='error-box'>You need to enter a password.</div>";
            header("Refresh: 1; login.php");
        
        //confirm login and redirect to home
        } else if(!empty($username) && (!empty($password))) {
            
            //check with the database
            $results = $mysqli->query("select username from users where username = '". $username ."' and password = '". $password ."'");

            if($results->num_rows == 0) {

                echo "<div class='error-box'>No account found with those details.</div>";
                header("Refresh: 1; login.php");

            } else {

                $account = $results->fetch_assoc();
                $_SESSION["name"] = $username;

                echo "<div class='confirm-box'>Logged in. Redirecting...</div>";
                header("Refresh: 1; login.php");

            }

            // if(!$account) {
            //     echo "no accounts";
            // } else {
            //     session_start();
            //     echo "<div class='confirm-box'>Logged in. Redirecting...</div>";
            //     header("Refresh: 2; http://localhost:3000");
            // }

        }

    }

?>

</div><!-- end container -->

<?php

    require("footer.php");

?>