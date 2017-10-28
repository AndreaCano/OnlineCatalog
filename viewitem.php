<?php
    session_start();
    

    include 'dbconnection.php';
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
    
    function getUserInfo($userId) {
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
        $userInfo = getUserInfo($_GET['itemId']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add User </title>
    </head>
    <body>
        
       First Name: <?=$userInfo['firstName']?> <br>
       Last Name: <?=$userInfo['lastName']?><br>
       Email: <?=$userInfo['email']?><br>
       University ID: <?=$userInfo['universityId']?><br>
       Phone: <?=$userInfo['phone']?><br>
       Gender: <?= $userInfo['gender'] ?><br>
       Role: <?=$userInfo['role']?><br>
        Department: <?php 
                        $departments = getDepartmentInfo();
                        foreach ($departments as $record) {
                            if($userInfo['deptId']==$record['departmentId']){ 
                                echo $record['deptName'];
                            }
                        }
                    ?><br>
    </body>
</html>