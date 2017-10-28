<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItem($itemId) {
        global $conn;
        $sql = "SELECT * 
<<<<<<< HEAD
                FROM vg_game
                WHERE game_id = $itemId";
=======
                FROM tc_user
                WHERE userId = $itemId";
>>>>>>> 61431d04585da319385d2afca88904a4f0c03511
        $statement = $conn->prepare($sql);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $user;
    }
    
    
    function showItem($item){
<<<<<<< HEAD
        echo "<a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
=======
        echo "<a href='viewitem.php?itemId=".$item['userId']."'>".$item['firstName'] . "  " . $item['lastName']."</a><br>";
>>>>>>> 61431d04585da319385d2afca88904a4f0c03511
    }
    
    function getCart(){
        foreach($_SESSION['ids'] as $record){
            $item = getItem($record);
            showItem($item);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add User </title>
    </head>
    <body>
        
       <?php getCart(); ?>
    </body>
</html>