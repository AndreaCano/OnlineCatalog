<?php
    session_start();

    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    function getItemInfo($gameId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                INNER JOIN vg_console ON vg_game.console_id = vg_console.console_id 
                INNER JOIN vg_developer ON vg_game.developer_id = vg_developer.developer_id
                WHERE game_id = ".$gameId;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    if (isset($_GET['itemId'])) {
        array_push($_SESSION['ids'],$_GET['itemId']);
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
    </body>
</html>