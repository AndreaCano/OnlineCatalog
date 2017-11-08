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
        <title>Item Details </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
       <style>
        @import url('css/styles.css');
        </style>
    </head>
    <body>
    <div id="item" class='jumbotron'>
       <h1 style="margin-top:-200px;"><?=$userInfo['game_name']?> Details </h1>
       </div>
       <table class="table table-hover">
            <thead>
      <tr>
        <th>Item</th>
        <th>Console</th>
        <th>Developer</th>
        <th>Release Year</th>
        <th>Genre</th>
        <th>Price</th>
        </tr>
        </thead>
        
        <tbody>
       <tr>
        <td>Game Name: <?=$userInfo['game_name']?> </td>
       <td>Console: <?=$userInfo['console_name']?></td>
       <td>Developer: <?=$userInfo['developer_name']?></td>
       <td>Release Year: <?=$userInfo['game_release']?></td>
       <td>Genre: <?=$userInfo['genre']?></td>
       <td>Price: $<?=$userInfo['price']?></td>
       </tr>
       </tbody>
       <form action="index.php">
            <div id="admin">
            <button class= "btn" type="submit" value="back"><span class="glyphicon glyphicon-arrow-left"></span> back</button>
             <div>
         </form>
    </body>
</html>