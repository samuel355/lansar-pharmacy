<?php
    include_once "db_connection.php";
    if(isset($_POST['diagnose_name'])){
        $diagnose_name = mysqli_escape_string($con, $_POST['diagnose_name']);
        
        //Insert
        $query = "INSERT INTO diagnosis(DIAGNOSE_NAME) VALUES('{$diagnose_name}')";
        $inset = mysqli_query($con, $query);
        if($inset){
            echo "success";
        }else{
            echo 'Sorry something went wrong.';
        }
    }
?>