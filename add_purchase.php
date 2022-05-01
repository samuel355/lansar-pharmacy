<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Purchase</title>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigation -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('bar-chart', 'Add Inventory', 'Add New Drugs');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <!-- manufacturer details content -->
          <div class="row col col-md-12">
            <div class="container">
              <form id="add-drugs" method="POST" class="form">
                <div class="row">
                  <div style="display: none;" class="col-12 text-center alert alert-danger error-text"></div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="drug-name"> Drug Name</label>
                      <input type="text" name="drug-name" id="drug-name" class="form-control">
                      <span class="text-danger drug-name-error mt-3"></span>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
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
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="generic-name"> Generic Name</label>
                      <input type="text" name="generic-name" id="generic-name" class="form-control">
                      <span class="text-danger generic-name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="expiry-date"> Expiry Date (mm/yr)</label>
                      <input type="text" name="expiry-date" id="expiry-date" class="form-control" placeholder="02/22">
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="quantity"> Quantity</label>
                      <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="price"> Price</label>
                      <input type="number" name="price" id="price" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
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
                    </div>
                  </div>
                  <div class="col-md-8 col-12">
                    <div class="form-group supplier-details" style="display: flex; justify-content: space-between">
                        
                    </div>
                  </div>
                  <div class="mt-4 col-md-12 col-12 text-center">
                    <button class="btn btn-primary p-2">Add Drug</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- closing button -->
          <div id="purchase_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      $('#supplier-name').on('change', function(){
        if($.trim($('#supplier-name').val()) == 'select'){
          alert('Select supplier');
          $('.supplier-details').css('display', 'none');
          return false;
        }else{
          var id = $(this).val();
          $.ajax({
            url: 'php/getSupplier.php',
            method: 'GET',
            data: {id: id},

            success: function(data){
              $('.supplier-details').css('display', 'block');
              $('.supplier-details').html(data);
            }
          })
        }
      });

      //Add Drugs
      $('#add-drugs').on('submit', function(e){
        e.preventDefault();
      
        if($.trim($('#drug-name').val()).length == 0 ){
          var errorMsg = 'Enter Drug Name';
          $('.drug-name-error').html(errorMsg)
        }else{
          errorMsg = '';
          $('.drug-name-error').html(errorMsg)
        }

        if($.trim($('#diagnose-name').val()) == 'select' ){
          var errorMsg = 'Select Diagnose Name';
          $('.diagnose-name-error').html(errorMsg)
        }else{
          errorMsg = '';
          $('.diagnose-name-error').html(errorMsg)
        }

        if($.trim($('#generic-name').val()).length == 0 ){
          var errorMsg = 'Enter Generic Name';
          $('.generic-name-error').html(errorMsg)
        }else{
          errorMsg = '';
          $('.generic-name-error').html(errorMsg)
        }
      })
    })
  </script>
</html>
