<?php

    require("header.php");

    //fetching all data from the database
    //$results = $mysqli->query("select * from (select * from todo order by id desc limit 10)var1 order by id asc");
    $results = $mysqli->query("select * from todo order by id desc limit 10");
        
            
?>

    <div id="header">
        <!-- navbar/menu content will go here -->

        <?php

            if(isset($_SESSION['name'])) {
                echo "<a href='logout.php'>Logout.</a>";
            } else {
                echo "<a href='login.php'>Login.</a>";
            }

        ?>

    </div>

    <div id="container">

        <?php

            if(isset($_SESSION['name'])) {
                echo "<h4>Hi ". $_SESSION['name'] .".<br>Please see below your To Do list.</h4>";
            } else {
                echo "Hey visitor. It seems that you don't have an account. Please register one.";
            }

        //no todos message
        if($results->num_rows == 0) {
            echo "<div class='error-box mb25'>You have no ToDos</div>";
        }
        
        //while loop to print todos
        while($print_results = $results->fetch_assoc()) {

            //if a todo is empty show empty text
            if($print_results['todo'] == "") {
                $print_results['todo'] = "empty.";
            }

            //print todo list
            echo "<div class='left-box'>" .$print_results['id'] . "</div><div class='right-box'>" . $print_results['todo'] . "</div>";
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
                    $mysqli->query("insert into todo values (null, '".$todo."')");

                    //confirmation message
                    echo "<div class='confirm-box'>To Do added.... Reloading page.</div>";

                }

                //reload the page after a second
                header("Refresh:1; http://localhost:3000/index.php");
            }

        ?>

    </div>

<?php

    require("footer.php");

?>