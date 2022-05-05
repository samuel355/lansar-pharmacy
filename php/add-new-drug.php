<?php
    include_once "db_connection.php";
    if(isset($_POST['drug-name'])){
        $drug_name = mysqli_escape_string($con, $_POST['drug-name']);
        $diagnose_name = mysqli_escape_string($con, $_POST['diagnose-name']);
        $generic_name = mysqli_escape_string($con, $_POST['generic-name']);
        $expiry_date = mysqli_escape_string($con, $_POST['expiry-date']);
        $quantity = mysqli_escape_string($con, $_POST['quantity']);
        $price = mysqli_escape_string($con, $_POST['price']);
        $supplier_name = mysqli_escape_string($con, $_POST['supplier-full-name']);
        $supplier_email = mysqli_escape_string($con, $_POST['supplier-email']);
        $supplier_contact = mysqli_escape_string($con, $_POST['supplier-contact']);

        //insert into medicine stocks.
        $query = "INSERT INTO medicines_stock(NAME, DIAGNOSE_NAME, GENERIC_NAME, EXPIRY_DATE, QUANTITY, MRP, SUPPLIER_NAME, SUPPLIER_EMAIL, SUPPLIER_CONTACT)
            VALUES('{$drug_name}', '{$diagnose_name}', '{$generic_name}', '{$expiry_date}', '{$quantity}', '{$price}', '{$supplier_name}', '{$supplier_email}', '{$supplier_contact}' )";
        $insert = mysqli_query($con, $query);
        if($insert){
            echo 'success';
        }else{
            echo 'Sorry Something went wrong. Try again later';
        }

    }
?>