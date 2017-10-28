<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItem($itemId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                WHERE game_id = $itemId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $user;
    }
    
    
    function showItem($item){
        echo "<a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
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