<?php
    session_start();
    
    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItems() {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                NATURAL JOIN vg_console
                WHERE 1";
                //ORDER BY game_name";
        
    if (isset($_GET['search'])){
        
        $namedParameters = array();
        
        
        if (!empty($_GET['gameName'])) {
            //echo $_GET['deviceName'];
            //The following query allows SQL injection due to the single quotes
            $sql .= " AND game_name LIKE '%" . $_GET['gameName'] . "%'";
  
           // $sql .= " AND deviceName LIKE :deviceName"; //using named parameters
            //$namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";

         }
         if (!empty($_GET['genre']) && $_GET['genre']!= "Select One") {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND genre = :gType"; //using named parameters
            $namedParameters[':gType'] =   $_GET['genre'];

         }  
         if (!empty($_GET['console']) && $_GET['console']!= "Select One") {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND console_name = :cType"; //using named parameters
            $namedParameters[':cType'] =   $_GET['console'];

         }  
         

    }//endIf (isset)
    
    else{
        $sql .= " ORDER BY game_name ASC";
    }
       
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        showItems($games);
    }
    
    function display($items){
         foreach($items as $item) {
            echo $item['game_id']." ".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
            
            echo "<form action='addtocart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            echo '<button class="add" value="'.$item['game_name'].'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Add to cart</button>';
          
            echo "<br />";
        }
    }
    
   
    function showItems($items){
        foreach($items as $item) {
            echo "<a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . " " . $item['console_name']."<br>Console: ".$item['console_name'] . "<br>Price: $" . $item['price']."</a><br>";
            
            echo "<form action='addtocart.php' style='display:inline'>";
            echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            echo '<button class="add" value="'.$item['game_name'].'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Add to cart</button>';
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
        <title>Retro Video Games </title>
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
        <form action="viewcart.php" style='display:inline' method="get">
            
            <button type="submit" value="Display Shopping Cart"  >
                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp; Your Shopping cart
                </button>
            
            
               
        </form>
        
        <form method="get">
             Game Name: <input type="text" name="gameName" placeholder="Game Name"/>
             
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
        <?php $items = getItems(); ?>
       
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