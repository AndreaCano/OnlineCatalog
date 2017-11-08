<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItem($itemId) {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game, vg_console
                WHERE game_id = $itemId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $user;
    }
    
    
    function showItem($item){
     echo"   
    ";
        
        
        echo "<td><a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . "</a> </td><td>" . $item['console_name']."</td><td>Genre: ".$item['genre'] . "</td><td>Release: " . $item['game_release']."</td><td>";
            
            echo "<form action='removefromcart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            echo "<button  class='btn btn-danger' role='button'type='submit' value='Remove from Cart'>
            Remove from Cart &nbsp<span class='glyphicon glyphicon-remove'></span></button>";
            echo "</form></td>";
            echo "</tr>";
            
    }
    
    function getCart(){
        if(isset($_SESSION['ids'])){
            foreach($_SESSION['ids'] as $record){
                $item = getItem($record);
                showItem($item);
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Cart </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
       <style>
        @import url('css/styles.css');
        </style>
   
    </head>
    <body>
        <div class= "jumbotron">
        <h1>Cart</h1>
        </div>
        <table class="table table-hover">
            <thead>
        <tr>
         <th>Name</th>
         <th>Console</th>
         <th>Genre</th>
         <th>Release</th>
        </tr>
        </thead>
        <tbody>
       <?php getCart(); ?>
       </tbody>
       </table>
       
        <form action="index.php">
            <div id="admin">
            <button class= "btn" type="submit" value="back"><span class="glyphicon glyphicon-arrow-left"></span> back</button>
             <div>
           </form>
    </body>
</html>