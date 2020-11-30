<?php

    require("header.php");

    //fetching all data from the database
    $results = $mysqli->query("select * from (select * from todo order by id desc limit 10)var1 order by id asc");
        
            
?>

    <div id="header">
        <!-- navbar/menu content will go here -->
    </div>

    <div id="container">
        <?php

        if($results->num_rows == 0) {
            echo "<div class='error-box'>You have no ToDos</div>";
        }
        
        while($print_results = $results->fetch_assoc()) {

            if($print_results['todo'] == "") {
                $print_results['todo'] = "empty.";
            }

            echo "<div class='left-box'>" .$print_results['id'] . "</div><div class='right-box'>" . $print_results['todo'] . "</div>";
        }

        ?>

        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="todo">
            <button type="submit">Add To Do</button>
        </form>

        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $todo = $_POST['todo'];

                if(empty($todo)) {
                    echo "to do is empty.";
                }else{
                    
                    $mysqli->query("insert into todo values (null, '".$todo."')");

                    echo "<div class='confirm-box'>To Do added.... Reloading page.</div>";

                }

                header("Refresh:1; http://localhost:3000/index.php");
            }

        ?>

    </div>

<?php

    require("footer.php");

?>