<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItems() {
        global $conn;
        $sql = "SELECT * 
<<<<<<< HEAD
                FROM vg_game
                ORDER BY game_name";
=======
                FROM tc_user
                ORDER BY lastName";
>>>>>>> 61431d04585da319385d2afca88904a4f0c03511
        $statement = $conn->prepare($sql);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $users;
    }
    
    
    function showItems($items){
        foreach($items as $item) {
<<<<<<< HEAD
            echo "<a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
            
            echo "<form action='addtocart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
=======
            echo "<a href='viewitem.php?itemId=".$item['userId']."'>".$item['firstName'] . "  " . $item['lastName']."</a>";
            
            echo "<form action='addtocart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['userId']."'>";
>>>>>>> 61431d04585da319385d2afca88904a4f0c03511
            echo "<input type='submit' value='Add to Cart'>";
            echo "</form>";
            echo "<br />";
        }
    }
    
    if(empty($_SESSION)){
        $_SESSION['ids']=array();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="jumbotron">
            <h1>Item Catalog</h1>
            <h2></h2>
        </div>
        
        <hr>
        <h3>Users</h3>
        <?php $items = getItems(); ?>
        <form action="viewcart.php" style='display:inline'>
            <input type="submit" value="Display Shopping Cart">
        </form>
        <br>
        
        <?php showItems($items); ?>
        </div>
    </body>
</html>