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


        $exp_date = mysqli_escape_string($con, $_POST['expiry-date']);
        $quantity = mysqli_escape_string($con, $_POST['quantity']);
        $price = mysqli_escape_string($con, $_POST['price']);

        if(empty($sup_email) || empty($sup_contact)){
            $query = "UPDATE medicines_stock SET NAME = '{$med_name}', DIAGNOSE_NAME = '{$diagnose_name}', GENERIC_NAME = '{$generic_name}', EXPIRY_DATE = '{$exp_date}', QUANTITY = '{$quantity}', MRP = '{$price}', SUPPLIER_NAME = '{$sup_name}' WHERE ID = '{$med_id}' ";
            $update = mysqli_query($con, $query);
            if($update){
                echo 'success';
                exit;
            }
        }

        if(!empty($sup_email) || !empty($sup_contact)){
            $query1 = "UPDATE medicines_stock SET NAME = '{$med_name}', DIAGNOSE_NAME = '{$diagnose_name}', GENERIC_NAME = '{$generic_name}', EXPIRY_DATE = '{$exp_date}', QUANTITY = '{$quantity}', MRP = '{$price}', SUPPLIER_NAME = '{$sup_name}', SUPPLIER_EMAIL = '{$sup_email}' ,SUPPLIER_CONTACT = '{$sup_contact}' WHERE ID = '{$med_id}' ";
            $update1 = mysqli_query($con, $query1);
            if($update1){
                echo 'success';
                exit;
            }
        }
        
    }
?>