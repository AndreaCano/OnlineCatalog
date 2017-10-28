<?php
    session_start();
    

    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    function getUserInfo($itemId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                WHERE game_id = $itemId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    
    if (isset($_GET['itemId'])) {
        $userInfo = getUserInfo($_GET['itemId']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add User </title>
    </head>
    <body>
        
       Game Name: <?=$userInfo['game_name']?> <br>
       Release Year: <?=$userInfo['game_release']?><br>
       Genre: <?=$userInfo['genre']?><br>
       Price: $<?=$userInfo['price']?><br>
    </body>
</html>