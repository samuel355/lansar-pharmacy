<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Medicines</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_medicine.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('shopping-bag', 'Manage Medicines', 'Manage Existing Medicine');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="by_name" placeholder="By Medicine Name" onkeyup="searchMedicine(this.value, 'name');">
            &emsp;<input type="text" class="form-control" id="by_generic_name" placeholder="By Generic Name" onkeyup="searchMedicine(this.value, 'generic_name');">
            &emsp;<input type="text" class="form-control" id="by_suppliers_name" placeholder="By Supplier Name" onkeyup="searchMedicine(this.value, 'suppliers_name');">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th style="width: 5%;">SL. </th>
            				<th style="width: 20%;">Medicine Name </th>
                    <th style="width: 10%;">Generic Name </th>
                    <th style="width: 10%;">Diagnose </th>
                    <th style="width: 10%;">Price (GHS) </th>
                    <th style="width: 30%;">Quantity </th>
            				<th style="width: 20%;">Supplier </th>
                    <th style="width: 15%;">Action </th>
            			</tr>
            		</thead>
            		<tbody id="medicines_div">
                  <?php
                    require 'php/manage_medicine.php';
                    showMedicines(0);
                  ?>
            		</tbody>
            	</table>
            </div>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>

    <div class="modal fade" id="edit-medicine-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <a href="javascript:void(0);"  data-dismiss="modal" class="btn btn-primary cancel-btn"><i class="fa fa-close text-danger"></i></a>
          </div>
          <form id="update-medicine-form">
              <div class="modal-body">
                <div class="row">
                  <div style="display: none;" class="col-12 text-center alert alert-danger error-text"></div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="drug-name"> Drug Name</label>
                      <input type="text" name="drug-name" id="drug-name" class="form-control">
                      <span class="text-danger drug-name-error mt-3"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="diagnose-name">Diagnose Name</label>
                      <select name="diagnose-name" id="diagnose-name" class="form-group custom-select">
                        <option value="select">Select Diagnose Name</option>
                        <?php
                          include_once "php/db_connection.php";
                          $query = "SELECT * FROM diagnosis";
                          $qry_all = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_array($qry_all)){
                            $diagnose_id = $row['ID'];
                            $diagnose_name = $row['DIAGNOSE_NAME'];
                            echo '
                              <option value="'.$diagnose_name.'">'.$diagnose_name.'</option>
                            ';
                          }
                        ?>
                        
                      </select>
                      <span class="text-danger diagnose-name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="generic-name"> Generic Name</label>
                      <input type="text" name="generic-name" id="generic-name" class="form-control">
                      <span class="text-danger generic-name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="diagnose-name">Supplier Name</label>
                      <select name="supplier-name" id="supplier-name" class="form-group custom-select">
                        <option value="select">Select Supplier Name</option>
                        <?php
                          include_once "php/db_connection.php";
                          $query = "SELECT * FROM suppliers";
                          $qry_all = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_array($qry_all)){
                            $supplier_id = $row['ID'];
                            $supplier_name = $row['NAME'];
                            echo '
                              <option value="'.$supplier_id.'">'.$supplier_name.'</option>
                            ';
                          }
                        ?>
                        
                      </select>
                      <span class="text-danger supplier-name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="expiry-date"> Expiry Date (mm/yr)</label>
                      <input type="text" name="expiry-date" id="expiry-date" class="form-control" placeholder="02/22">
                      <span class="text-danger expiry-date-error"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="quantity"> Quantity</label>
                      <input type="number" name="quantity" id="quantity" class="form-control">
                      <span class="text-danger quantity-error"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="price">Unit Price</label>
                      <input type="number" name="price" id="price" class="form-control">
                      <span class="text-danger price-error"></span>
                    </div>
                  </div>
                  
                </div>
            </div>


            <div class="modal-footer">
              <div class="row">
                <div class="col-6">
                  <a id="confirm-medicine-update" href="javascript:void(0);"class="btn btn-success continue-btn">Update</a>
                </div>
                <div class="col-6">
                  <a href="javascript:void(0);"  data-dismiss="modal" class="btn btn-danger cancel-btn">Cancel</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $('.edit-button').on('click', function(){
          id = $(this).attr('data-id');
          $('#edit-medicine-modal').modal('show');
        })
      })
    </script>
  </body>
</html>
