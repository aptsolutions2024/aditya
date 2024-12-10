<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>User | Aditya</title>
    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--- -->

    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/bootstrap.min.css">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/nifty.min.css">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-icons.min.css">

    <!-- Demo purpose CSS [ DEMO ] -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css"> -->
</head>
<body class="">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root front-container">
        

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">

                    <!-- Login card -->
                    <div class="card shadow-lg">
                        <div class="card-body" style="max-width: 350px;min-width: 350px;">
                          
                           <?php error_reporting(0); if($_SESSION['createU']!=''){ ?>
                                  <div style="color: #ff0000;font-size: 14px;"><?=$_SESSION['createU'];?></div>
                           <?php } ?>
                                        <?php echo form_open('/updateResetUserpass', array('autocomplete' => 'off','class' => 'mt-4','id'=>'updatepassword')); ?>
                                   
                                        <input type="hidden" name="editId" value="<?=base64_decode($_GET['id']);?>">
                                        <div class="col-md-12">
                                            <label class="form-label">New Password<label class="mandatory">*</label></label>
                                            <input maxlength="100" id="txtPassword" name="txtPassword" type="password" class="form-control" placeholder="Password" value="">
                                            <?php echo form_error('txtPassword');?>
                                        </div>  
                                          <div class="col-md-12">
                                            <label class="form-label">Confirm Password<label class="mandatory">*</label></label>
                                            <input maxlength="100" id="txtCPassword" name="txtCPassword" type="password" class="form-control" placeholder="Password" value="">
                                            <?php echo form_error('txtCPassword');?>
                                        </div><br>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                        </div>
                    </div>
                    <!-- END : Login card -->


                </div>
            </div>
        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    </div>
            <!-- End - Collection Of Images -->

</div>
</div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->

   

    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->
    
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>
    
<script>
$(document).ready(function() {
   		$("#updatepassword").validate({
	      	rules: {
	        
	         	txtPassword: 'required',
	         	txtCPassword: {
	            	required: true,
	            	equalTo : "#txtPassword",
	         	},
	      	},
	      	messages: {
			   	txtPassword: 'New Password is required',
			   	txtCPassword: {
			   		required : 'Confirm Password is required',
			   		equalTo : 'Password not matching',
			   	}
			},
	   });
	});
	

</script>

</body>

</html>