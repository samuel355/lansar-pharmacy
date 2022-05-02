<?php
    include_once "db_connection.php";
    if(isset($_POST['drug-name'])){
        $drug_name = $_POST['drug-name'];
        echo $drug_name;
    }
?>