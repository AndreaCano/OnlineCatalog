<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItem($itemId) {
        global $conn;
        $sql = "SELECT * 
                FROM tc_user
                WHERE userId = $itemId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $user;
    }
    
    
    function showItem($item){
        echo "<a href='viewitem.php?itemId=".$item['userId']."'>".$item['firstName'] . "  " . $item['lastName']."</a><br>";
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