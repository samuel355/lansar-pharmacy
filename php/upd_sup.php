<?php
    include_once "db_connection.php";

    if(isset($_GET['supp_name'])){
        $sup_name = $_GET['supp_name'];
        $query = " SELECT * FROM suppliers WHERE NAME = '{$sup_name}' ";
        $fetch = mysqli_query($con, $query);
        if(mysqli_num_rows($fetch) > 0 ){
            $row = mysqli_fetch_assoc($fetch);
            $sup_email = $row['EMAIL'];
            $sup_contact = $row['CONTACT_NUMBER'];
            $sup_address = $row['ADDRESS'];
        }
        echo '
            <div class="row ml-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sup-email"> Supplier Email</label>
                        <input type="email" name="sup-email" id="sup-email" class="form-control" value="'.$sup_email.'">
                        <span class="text-danger sup-email-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sup-contact"> Supplier Contact</label>
                        <input type="number" name="sup-contact" id="sup-contact" class="form-control" value="'.$sup_contact.'">
                        <span class="text-danger sup-contact-error"></span>
                    </div>
                </div>
            </div>
        ';
    }
?>