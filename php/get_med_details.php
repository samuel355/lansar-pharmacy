<?php
    include_once "db_connection.php";

    $output = '';
    if(isset($_GET['med_id'])){
        $med_id = $_GET['med_id'];
        $query = "SELECT * FROM medicines_stock WHERE ID = '{$med_id}' ";
        $select = mysqli_query($con, $query);
        if(mysqli_num_rows($select) > 0){
            $row = mysqli_fetch_assoc($select);
            $drug_name = $row['NAME'];
            $diagnose_name = $row['DIAGNOSE_NAME'];
            $generic_name = $row['GENERIC_NAME'];
            $expiry_date = $row['EXPIRY_DATE'];
            $quantity = $row['QUANTITY'];
            $price = $row['MRP'];
            $sup_name = $row['SUPPLIER_NAME'];
            $sup_email = $row['SUPPLIER_EMAIL'];
            $sup_contact = $row['SUPPLIER_CONTACT'];
        }

        $output .= ' 
            <div class="modal-body">
                <div class="row">
                    <div style="display: none;" class="col-12 text-center alert alert-danger error-text"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="medicine-name"> Drug Name</label>
                        <input type="text" name="medicine-name" id="medicine-name" value="'.$drug_name.'" class="form-control">
                        <span class="text-danger medicine-name-error mt-3"></span>
                        </div>
                    </div>
                    <input type = "hidden" name = "med_id" value="'.$med_id.'">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="diagnose-name">Diagnose Name</label>
                        <select name="diagnose-name" id="diagnose-name" class="form-group custom-select">
                            <option value="'.$diagnose_name.'" selected >'.$diagnose_name.'</option>
                            
                        </select>
                        <span class="text-danger diagnose-name-error"></span>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="form-group">
                        <label for="generic-name"> Generic Name</label>
                        <input type="text" name="generic-name" id="generic-name" class="form-control" value="'.$generic_name.'">
                        <span class="text-danger generic-name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="suppliers-name">Supplier Name</label>
                        <select name="suppliers-name" id="suppliers-name" class="form-group custom-select">
                            <option value="'.$sup_name.'" selected >'.$sup_name.'</option>
                            
                            
                        </select>
                        <span class="text-danger supplier-name-error"></span>
                        </div>
                    </div>
                    <div class="sup-details">
                        
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="expiry-date"> Expiry Date (mm/yr)</label>
                        <input type="text" name="expiry-date" id="expiry-date" class="form-control" placeholder="02/22" value="'.$expiry_date.'">
                        <span class="text-danger expiry-date-error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="quantity"> Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="'.$quantity.'">
                        <span class="text-danger quantity-error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="price">Unit Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="'.$price.'">
                        <span class="text-danger price-error"></span>
                        </div>
                    </div>
                
                </div>
            </div>
        ';
    }
    echo $output;
?>

<script>
    $(document).ready(function(){
        getSuppliers();
        getDiagnoseNames();

        //Get Suppliers
        function getSuppliers(){
            $.ajax({
                data: {getSup: 1},
                url: 'php/getDSuppliers.php',
                method: 'GET',
                success: function(data){
                    $('#suppliers-name').append(data)
                }
            })
        }

        //Get Suppliers
         function getDiagnoseNames(){
            $.ajax({
                data: {getDiag: 1},
                url: 'php/getDiagnoses.php',
                method: 'GET',
                success: function(data){
                    $('#diagnose-name').append(data)
                }
            })
        }

        $('#suppliers-name').on('change', function(){
            var name = $(this).val();
            $.ajax({
                data: {supp_name: name},
                url: 'php/upd_sup.php',
                method: 'GET',

                success: function(data){
                    $('.sup-details').html(data)
                }
            })
        })
    })

</script>