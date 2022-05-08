<?php
    include_once "db_connection.php";

    if(isset($_POST['medicine-name'])){

        $med_id = mysqli_escape_string($con, $_POST['med_id']);
        $med_name = mysqli_escape_string($con, $_POST['medicine-name']);
        $diagnose_name = mysqli_escape_string($con, $_POST['diagnose-name']);
        $generic_name = mysqli_escape_string($con, $_POST['generic-name']);
        $sup_name = mysqli_escape_string($con, $_POST['suppliers-name']);


        $sup_email = mysqli_escape_string($con, $_POST['sup-email']);
        $sup_contact = mysqli_escape_string($con, $_POST['sup-contact']);
        $sup_address = mysqli_escape_string($con, $_POST['sup-address']);


        $exp_date = mysqli_escape_string($con, $_POST['expiry-date']);
        $quantity = mysqli_escape_string($con, $_POST['quantity']);
        $price = mysqli_escape_string($con, $_POST['price']);

        if(empty($sup_email) || empty($sup_contact) || empty($sup_address)){
            $query = "UPDATE medicines_stock SET NAME = '{$med_name}', DIAGNOSE_NAME = '{$diagnose_name}', GENERIC_NAME = '{$generic_name}', EXPIRY_DATE = '{$exp_date}', QUANTITY = '{$quantity}', MRP = '{$price}', SUPPLIER_NAME = '{$sup_name}' ";
        }
    }
?>