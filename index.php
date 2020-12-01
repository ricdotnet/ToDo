<?php

    require("header.php");

    //check if session exists
    if(isset($_SESSION['name'])) {

?>

    <div id="header">
        <!-- navbar/menu content will go here -->
        <div class="width80">

            <?php echo "<a href='logout.php'>Logout.</a>"; ?>

        </div>
    </div>

    <div class="container">

        <?php

        echo "<h4>Hi ". $_SESSION['name'] .".<br>Please see below your To Do list.</h4>";

        $username = $_SESSION['name']; //copy session name to $username

        //fetching all data from the database

        $getuser = $mysqli->query("select id from users where username = '". $username ."'");
        $gotuser = $getuser->fetch_assoc();

        $userid = $gotuser['id'];

        //$results = $mysqli->query("select * from (select * from todo order by id desc limit 10)var1 order by id asc");
        $results = $mysqli->query("select * from todo where user = '". $userid ."' order by id desc limit 10");

        //no todos message
        if($results->num_rows == 0) {
            echo "<div class='error-box mb25'>You have no ToDos</div>";
        }

        //id for todo display
        $number = 1;
        
        //while loop to print todos
        while($print_results = $results->fetch_assoc()) {

            //if a todo is empty show empty text
            if($print_results['todo'] == "") {
                $print_results['todo'] = "invalid.";
            }

            //print todo list
            echo "<div class='left-box'>" .$number++ . "</div><div class='right-box'>" . $print_results['todo'] . "</div>";
        }

        ?>

        <!-- input form -->
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input class="input-box mb25" type="text" name="todo">
            <button type="submit">Add To Do</button>
        </form>

        <?php

            //posting function
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $todo = $_POST['todo'];

                //check if input box is empty. do not send if true
                if(empty($todo)) {
                    echo "<div class='error-box'>to do is empty.</div>";
                }else{
                    
                    //if valid then post and reload
                    $mysqli->query("insert into todo values (null, '". $todo ."', '". $userid ."')");

                    //confirmation message
                    echo "<div class='confirm-box'>To Do added.... Reloading page.</div>";

                }

                //reload the page after a second
                header("Refresh:1; http://localhost:3000/index.php");
            }

        ?>

    </div>

<?php

            //if session is not started show login/register button
        } else {

            echo "<div class='container mt50'>";
        echo "<p class='mb25'>Hey visitor.<br>If you have an account please login.<br>If you don't, register.</p>";
        echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
            echo "</div>";
    }
    

    require("footer.php");

?>