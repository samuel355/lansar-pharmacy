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
    <script src="js/manage_diagnosis.js"></script>
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
          createHeader('shopping-bag', 'Manage Diagnosis', 'Manage Existing Diagnosis');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="by_name" placeholder="By Medicine Name" onkeyup="searchDiagnosis(this.value, 'name');">
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
            				<th id="diagnose_name" style="width: 20%;">Diagnosis Name </th>
                    <th style="width: 15%;">Action </th>
            			</tr>
            		</thead>
            		<tbody id="medicines_div">
                  <?php
                    require 'php/manage_diagnosis.php';
                    showDiagnosis(0);
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


  <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <a href="javascript:void(0);"  data-dismiss="modal" class="btn btn-primary cancel-btn"><i class="fa fa-close text-danger"></i></a>
        </div>
        <form id="diagnose-name-form">
          <div class="modal-body">
            <div class="form-group">
              <label for="diagnose-name">Diagnose Name</label>
              <input type="text" id="diagnose-name" name="diagnose-name" class="form-control">
              <input type="hidden" id="diagnose-id" name="diagnose-id" class="form-control">
              <span class="text-danger diagnose-name-error"></span>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-6">
                <a id="confirm-update" href="javascript:void(0);"class="btn btn-success continue-btn">Update</a>
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

        //Pop Up Selected Diagnose Title
        $('.edit-btn').on('click', function(){
          var id = $(this).attr('data-id');

          $.ajax({
            url: "php/get_diagnose_name.php",
            method: "GET",
            data: {diagnose_id: id},

            success: function(data){
              $('#edit-modal').modal('show');
              $('#diagnose-name').val(data);
              $('#diagnose-id').val(id);
            }
          })
          
        })

        //Update
        $('#confirm-update').on('click', function(e){
          e.preventDefault();

          if($.trim($('#diagnose-name').val()).length == 0){
            errMsg = 'Diagnose name cannot be empty';
            $('.diagnose-name-error').text(errMsg);
          }else{
            errMsg = ' ';
            $('.diagnose-name-error').text(errMsg);

            $.ajax({
              url: 'php/update_diagnose_name.php',
              method: 'POST',
              data: $('#diagnose-name-form').serialize(),

              success: function(data){
                if(data === 'success'){
                  alert('Updated Successfully');
                  
                }else{
                  $('.diagnose-name-error').text(data);
                }
              },
              error: function(err){
                console.log(err)
              }
            })
          }
        })
      })
    </script>
  </body>
</html>
