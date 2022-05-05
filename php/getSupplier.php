<?php
    include_once "db_connection.php";
    if(isset($_GET['id'])){
        $supplier_id = $_GET['id'];
        $select = "SELECT * FROM suppliers WHERE ID = '{$supplier_id}' "; 
        $query = mysqli_query($con, $select);
        $output = '';
        while($row = mysqli_fetch_assoc($query)){
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $contact = $row['CONTACT_NUMBER'];
            $output .='
                <div>
                    <label for="supplier-email"> Supplier Email</label>
                    <input readonly type="email" value ="'.$email.'" name="supplier-email" id="supplier-email" class="form-control">
                </div>
                <div>
                    <label for="supplier-contact"> Supplier Contact</label>
                    <input readonly type="number" value ="'.$contact.'" name="supplier-contact" id="supplier-contact" class="form-control">
                </div>
                <div style="display: none">
                    <label for="supplier-contact"> Supplier Full Name</label>
                    <input readonly type="text" value ="'.$name.'" name="supplier-full-name" id="supplier-full-name" class="form-control">
                </div>
            ';
        }

    }
    echo $output;
?>