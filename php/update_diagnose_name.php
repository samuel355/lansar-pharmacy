<?php
    include_once "db_connection.php";

    if(isset($_POST['diagnose-name'])){
        $diagnose_name = mysqli_escape_string($con, $_POST['diagnose-name']);
        $diagnose_id = mysqli_escape_string($con, $_POST['diagnose-id']);
       
        //update
        $query = "UPDATE diagnosis SET DIAGNOSE_NAME = '{$diagnose_name}' WHERE ID = '{$diagnose_id}' ";
        $update = mysqli_query($con, $query);

        if($update){
            echo "success";
        }else{
            echo "Sorry something went wrong updating";
        }
    }
?>