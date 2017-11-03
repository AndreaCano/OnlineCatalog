<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItems() {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game";
                //ORDER BY game_name";
                
                  $statement = $conn->prepare($sql);
        $statement->execute();
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
      
        
         if (isset($_GET['search'])){
             
              $namedParameters = array();
           /*  if (!empty($_GET['ge_name'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " WHERE game_name LIKE  :game_name  "; //using named parameters
            $namedParameters[':game_name'] = "%" . $_GET['game_name'] . "%";

             }*/
             
              if (!empty($_GET['genre'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " WHERE genre = :genre"; //using named parameters
            $namedParameters[':genre'] =   $_GET['genre'] ;

         }   
         }
        $sql .= "ORDER BY game_name";
        
        
        return $games;
    }
    
   
    function showItems($items){
        foreach($items as $item) {
            echo "<a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
            
            echo "<form action='addtocart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            echo '<button class="add" value="'.$item['game_name'].'">Add to cart</button>';
            echo "</form>";
            echo "<br />";
        }
    }
    
     if(isset($_GET['add']) && $_GET['add'] == 'Add to Cart') {
        echo "<h4>Game has been added to cart</h4>";
    }
    function getConsole() {
    global $conn;
    $sql = "SELECT DISTINCT(console_name)
            FROM `vg_console` 
            ORDER BY console_name";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['console_name'] . "</option>";
        
    }
}


function getGenre() {
    global $conn;
    $sql = "SELECT DISTINCT(genre)
            FROM `vg_game` 
            ORDER BY genre";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['genre'] . "</option>";
        
    }
}

    if(!isset($_SESSION['ids']) || empty($_SESSION['ids'])){
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
            <h1>Retro Video Game Catalog</h1>
            <h2></h2>
        </div>
        
        
       
        <hr>
        <h3>Game Stock</h3>
        <?php $items = getItems(); ?>
        <form action="viewcart.php" style='display:inline' method="get">
            <input type="submit" value="Display Shopping Cart">
            
            
                Game Name: <input type="text" name="game_name" placeholder="Game Name"/>
             
                Genre:<select name="genre">
                <option value="">Select One</option>
                    <?=getGenre()?>
                </select>
                
                Console:<select name="console">
                <option value="">Select One</option>
                    <?=getConsole()?>
                </select>
                <input type="submit" name="search" value="Search"/>
        </form>
        <br>
        
        <?php showItems($items); ?>
        </div>
        
        <script>
        
        function add(game) {

                 return "";
        }
                $(document).ready(function(){
                    $(".add").click(function(){
                        alert("Added " + $(this).attr('value') + " item to your cart.");
                    });
                });
        </script>
    </body>
</html>