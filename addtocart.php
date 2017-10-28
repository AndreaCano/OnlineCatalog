<?php
    session_start();

    include '../../dbconnection.php';
    $conn = getDatabaseConnection();

    function getDepartmentInfo(){
        global $conn;
        $sql = "SELECT deptName, departmentId
                FROM `tc_department` 
                ORDER BY deptName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
    
    function getItemInfo($userId) {
        global $conn;
        $sql = "SELECT * 
                FROM tc_user
                WHERE userId = $userId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $record;
    }
    
    if (isset($_GET['itemId'])) {
        $itemInfo = getItemInfo($_GET['$itemId']);
        $_SESSION[$_GET['itemId']]=$itemInfo;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
    </body>
</html>