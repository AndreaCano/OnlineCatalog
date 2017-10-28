<?php
    session_start();

    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    function getItemInfo($gameId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                WHERE game_id = ".$gameId;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $record;
    }
    
    if (isset($_GET['itemId'])) {
        echo $_GET['itemId'];
        $itemInfo = getItemInfo($_GET['itemId']);
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