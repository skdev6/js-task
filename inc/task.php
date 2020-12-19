<?php
    require_once "config.php";  

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    if(!$connect){
        throw new Exception("Can't connect to database");
    }else{ 
        $action = $_POST['action'];
        if ("add" == $action) {
            $task = $_POST['task'];
            $date = $_POST['date'];
            if ($task) {
                $query = "INSERT INTO js_task (task, date) VALUES ('{$task}', '{$date}')"; 
                mysqli_query($connect, $query); 
            }
            header("Location: /js-task/index.php"); 
        } 
    }
?>