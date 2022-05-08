<?php
    include_once "db_connection.php";
    if(isset($_GET['getDiag'])){
        $select = "SELECT * FROM diagnosis"; 
        $query = mysqli_query($con, $select);
        $output = '';
        while($row = mysqli_fetch_assoc($query)){
            $id = $row['ID'];
            $name = $row['DIAGNOSE_NAME'];
            $output .='
                <option data-id = "'.$id.'" value="'.$name.'"> '.$name.' </option>
            ';
        }

    }
    echo $output;
?>