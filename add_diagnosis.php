<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Diagnosis</title>
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
          createHeader('bar-chart', 'Add Diagnosis', 'Add New Diagnosis');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <!-- manufacturer details content -->
          <div class="row col col-md-12">
            <div class="container">
              <form id="add_diagnosis" method="POST" class="form">
                <div class="row">
                  <div style="display: none;" class="col-12 text-center alert alert-danger error-text"></div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="form-group">
                      <label for="diagnose_name"> Diagnose Name</label>
                      <input type="text" name="diagnose_name" id="diagnose_name" class="form-control">
                      <span class="text-danger diagnose_name-error mt-3"></span>
                    </div>
                    <button class="btn btn-primary p-2">Add Diagnosis</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- closing button -->

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>

  <script>
    $(document).ready(function(){

      //Add Diagnosis
      $('#add_diagnosis').on('submit', function(e){
        e.preventDefault();
      
        if($.trim($('#diagnose_name').val()).length == 0 ){
          var errorMsg = 'Enter Diagnosis Name';
          $('.diagnose_name-error').html(errorMsg)
        }else{
          errorMsg = '';
          $('.diagnose_name-error').html(errorMsg)
        }

        if($.trim($('#diagnose-name').val()) == 'select' ){
          var errorMsg = 'Select Diagnose Name';
          $('.diagnose-name-error').html(errorMsg)
        }else{
          errorMsg = '';
          $('.diagnose-name-error').html(errorMsg);

          $.ajax({
            url: 'php/add-new-diagnosis.php',
            method: 'POST',
            data: $('#add_diagnosis').serialize(),
            success: function(data){
              if(data === 'success'){
                alert('Added successfully')
                $('#add_diagnosis')[0].reset()
                window.location.reload(true)
              }else{
                $('.error-text').css('display', 'block'),
                $('.error-text').html(data).fadeOut(8000);
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
</html>
