<?php
    include_once "db_connection.php";

    if(isset($_POST['diagnose-name'])){
        $diagnose_name = mysqli_escape_string($con, $_POST['diagnose-name']);
        $diagnose_id = mysqli_escape_string($con, $_POST['diagnose-id']);
        echo $diagnose_name;
    }
?>