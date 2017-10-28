<?php
function getDatabaseConnection($dbname = 'tcp'){
    
    /*$host = 'us-cdbr-iron-east-05.cleardb.net';//cloud 9
    $dbname = 'heroku_0f5cc24af187a3f';
    $username = 'b3d9df8340a3c9';
    $password = '8f3e3255';*/
    $host = 'localhost';//cloud 9
    $dbname = 'vg';
    $username = 'root';
    $password = '';
    
    //using different database variables in Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn;
    
}
?>