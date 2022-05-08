<?php
    include_once "db_connection.php";

    if(isset($_GET['diagnose_id'])){
        $id = $_GET['diagnose_id'];

        //Select
        $query = "SELECT * FROM diagnosis WHERE ID = '{$id}' ";
        $select = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($select)){
            $d_id = $row['ID'];
            $d_name = $row['DIAGNOSE_NAME'];
            echo $d_name;
        }
    }


?>