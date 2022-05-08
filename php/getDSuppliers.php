<?php
    include_once "db_connection.php";
    if(isset($_GET['getSup'])){
        $select = "SELECT * FROM suppliers"; 
        $query = mysqli_query($con, $select);
        $output = '';
        while($row = mysqli_fetch_assoc($query)){
            $id = $row['ID'];
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $contact = $row['CONTACT_NUMBER'];
            $output .='
                <option data-id = "'.$id.'" value="'.$name.'"> '.$name.' </option>
            ';
        }

    }
    echo $output;
?>