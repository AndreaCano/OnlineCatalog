<?php
    session_start();
    

    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    function getUserInfo($itemId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                INNER JOIN vg_console ON vg_game.console_id = vg_console.console_id 
                INNER JOIN vg_developer ON vg_game.developer_id = vg_developer.developer_id
                WHERE game_id = ".$itemId;
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
       Console: <?=$userInfo['console_name']?><br>
       Developer: <?=$userInfo['developer_name']?><br>
       Release Year: <?=$userInfo['game_release']?><br>
       Genre: <?=$userInfo['genre']?><br>
       Price: $<?=$userInfo['price']?><br>
    </body>
</html>