<?php
    require_once "config.php";  

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    if(!$connect){
        throw new Exception("Can't connect to database");
    }else{ 
        echo "Connect <br>"; 
    //    $query = "INSERT INTO js_task (task, date) VALUES ('Task 1', '2020-9-11')";   
    //    echo mysqli_query($connect, $query);    
    }
?>