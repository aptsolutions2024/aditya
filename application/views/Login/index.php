<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="">
    <title>Login | Aditya</title>

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
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css">


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

                            <div class="text-center">
                                <h1 class="h3">Account Login</h1>
                                <p>Sign In to your account</p>
                            </div>
                           <?php error_reporting(0); if($_SESSION['unmsg']!=''){ ?>
                            <div style="color: #ff0000;font-size: 14px;"><?=$_SESSION['unmsg'];?></div>
                        <?php } ?>
                          <?php error_reporting(0); if($_SESSION['createU']!=''){ ?>
                            <div style="color:limegreen;font-size: 14px;"><?=$_SESSION['createU'];?></div>
                        <?php } ?>
                            <?php echo form_open('/signIn', array('autocomplete' => 'off','class' => 'mt-4')); ?>

                            
                                
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo set_value('username') ?>" onkeyup="branchReset()" onInput="checkUserDetails();" autofocus>
                                    <?php echo form_error('username');?>
                                </div>

                                <div class="mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" onkeyup="branchReset()" onInput="checkUserDetails();">

                                    <?php echo form_error('password');?>

                                </div>
                                
                                <div class="mb-3">
                                    <select id="branchrole" name="branch_id" class="form-select" onChange="getCurrentYear(this.value);">
                                        <option value="">Select Role / Branch</option>
                                        </select>
                                    <?php echo form_error('branch_id');?>
                                </div>
                                
                                <div class="mb-3">
                                    <select id="current_year" name="current_year" class="form-select" >
                                        <option value="">Select Year</option>
                                        </select>
                                    <?php echo form_error('current_year');?>
                                </div>

                                <div class="d-grid mt-5">
                                    <button class="btn btn-primary btn-lg" type="submit">Sign In</button>
                                </div>
                            </form>

                            <div class=" justify-content-between mt-4" style="text-align: center;">
                                <a href="/forgot-password" class="btn-link text-decoration-none">Forgot password ?</a>
                                
                            </div>

                            

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
    <!-- END - BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->
    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
    
<script>
$( document ).ready(function() {
    var username = $("#username").val();  
      var password = $("#password").val();  
      if(password !='')
      {
        checkUserDetails(username,password);
      }
});
    function checkUserDetails(username,password)
    {
      var username = $("#username").val();  
      var password = $("#password").val();  
      //alert(username);
      //alert(password);
      $.ajax({
          url:"<?php echo base_url(); ?>checkUserDetails",
          method:"POST",
          data:{username:username,password:password},
          success:function(result)
          {
              console.log(result);
            if(result != '') 
            {
                $("#branchrole").html(result);
            }else
            {
                $("#branchrole").html(''); 
            }
          
          }
      });
      
    }
function branchReset()
{
   //$("#branchrole").html('');  
}
function getCurrentYear(branchId)
{
    $.ajax({
        url:"<?php echo base_url(); ?>getCurrentYear",
        method:"POST",
        data:{branchId:branchId},
        success:function(result)
        {
            if(result != '') 
            {
                $("#current_year").html(result);
            }else
            {
                $("#current_year").html(''); 
            }
        }
    }); 
}
</script>
</body>

</html>