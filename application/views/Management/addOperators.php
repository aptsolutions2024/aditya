<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Operators | Aditya</title>

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

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('Operators') ?>">Operators</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php if($getuser['id']==''){ ?>
                    <h2 class="mb-3">Add Operator</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Edit Operator</h2>
                    <?php } ?>

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php  error_reporting(0); if($_SESSION['createU']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createU'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($getuser['id']==''){ ?>
                                        <?php echo form_open('/createOperators', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {
                                    $getUserRole = $this->ManagementModel->getUserRole($getuser['id']);
                                    
                                    ?>
                                        <?php echo form_open('/updateOperators', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getuser['id'];?>">
                                    <?php } ?>
                                        <div class="col-md-4">
                                            <label class="form-label">First Name <label class="mandatory">*</label></label>
                                            <input  id="txtFirstname" name="txtFirstname" onkeypress="return allowOnlyLetters(event,this);" onkeypress="return allowOnlyLetters(event,this);" type="text" class="form-control" placeholder="First Name" value="<?php echo set_value('txtFirstname', $getuser[fname]); ?>" style="text-transform: uppercase">
                                            <?php echo form_error('txtFirstname');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label  class="form-label">Middle Name</label>
                                            <input   id="txtMiddleName" name="txtMiddleName" onkeypress="return allowOnlyLetters(event,this);" type="text" class="form-control" placeholder="Middle Name" value="<?php echo set_value('txtMiddleName', $getuser[mname]) ?>" style="text-transform: uppercase">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Last Name<label class="mandatory">*</label></label>
                                            <input  id="txtLastName" name="txtLastName" onkeypress="return allowOnlyLetters(event,this);" type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('txtLastName', $getuser[lanme]) ?>" style="text-transform: uppercase">
                                            <?php echo form_error('txtLastName');?>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address</label>
                                            <input maxlength="1500" id="txtAddress" name="txtAddress" type="text" class="form-control" placeholder="Address" value="<?php echo set_value('txtAddress', $getuser[address]) ?>">
                                            <?php echo form_error('txtAddress');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Contact No</label></label>
                                            <input maxlength="10" minlength="10" onkeypress="return isNumberKey(event)"  id="txtContactNumber" name="txtContactNumber" type="text" class="form-control" placeholder="Contact No" value="<?php echo set_value('txtContactNumber', $getuser[contact_no]) ?>">
                                            <?php echo form_error('txtContactNumber');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Email ID</label>
                                            <input maxlength="50" id="txtEmailID" name="txtEmailID" type="email" class="form-control" placeholder="Email ID" value="<?php echo set_value('txtEmailID', $getuser[email_id]) ?>">
                                            <?php echo form_error('txtEmailID');?>
                                        </div> 
                                         <div class="col-md-4">
                                       <label class="form-label">Select Branch<label class="mandatory">*</label></label>
                                        <?php $getBranchval = set_value('branch_id'); ?>
                                            <select id="branch_id" name="branch_id" class="form-select" >
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getBranchval==$branch['id']){ echo "selected";} if($branch[id]== $getuser[branch_id]){ echo "selected"; }?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                        
                                        <?php if($getuser['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="/users"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="/users"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } ?>
                                        </form>
                                        <!-- END : Block styled form -->

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </section>


                </div>
            </div>

            <?php  $this->load->view('/include/footer'); ?>

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <?php  $this->load->view('/include/sidebar'); ?>


            </div>
        </nav>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - MAIN NAVIGATION -->


    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    <!-- SCROLL TO TOP BUTTON -->
    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
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
    
<script>
    function allowOnlyLetters(e, t) {
    if (window.event) {
        var charCode = window.event.keyCode;
    }
    else if (e) {
        var charCode = e.which;
    }
    else { return true; }
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
        return true;
    else {
        
        return false;
    }
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<style>
    .dropdown dd,
    .dropdown dt {
        margin: 0px;
        padding: 0px;
        line-height: 1;
    }

    .dropdown ul {
        margin: -1px 0 0 0;

    }

    .dropdown dd {
        position: relative;
    }

    .dropdown a,
    .dropdown a:visited {
        color: #75868f;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .dropdown dt a {
       display: block;
      padding: 10px 3px 0px 10px;
       
    }

    .dropdown dt a span,
    .multiSel span {
        cursor: pointer;
        display: inline-block;
        padding: 2px;
        font-size: 12px;

    }
    .dropdown dt a span,
    .multiSel span  p{
        font-size: 12px;


    }
    .dropdown dd ul {
        z-index: 100;
        background: #ffff;
        border: 1px solid rgba(0,0,0,.07);
        border-radius: 0.4375rem;
        color: #75868f;
        display: none;
        left: 0px;
        padding: 2px;
        position: absolute;
        top: 2px;
        width: 100%;
        list-style: none;
        height:115px;
        overflow: auto;
    }

    .dropdown span.value {
        display: none;
    }
    .dropdown dd ul li{
        font-size: 12px!important;
    }
    .dropdown dd ul li a {
        padding: 5px;
        display: block;

    }

    .dropdown dd ul li a:hover {
        background-color: #fff;
    }
    input[type="checkbox"] {
        height: auto!important;
        width: auto!important;
    }





    .dropdown1 dd,
    .dropdown1 dt {
        margin: 0px;
        padding: 0px;
        line-height: 1;
    }

    .dropdown1 ul {
        margin: -1px 0 0 0;

    }

    .dropdown1 dd {
        position: relative;
    }

    .dropdown1 a,
    .dropdown1 a:visited {
        color: #75868f;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .dropdown1 dt a {
       display: block;
      padding: 10px 3px 0px 10px;
       
    }

    .dropdown1 dt a span,
    .multiSel1 span {
        cursor: pointer;
        display: inline-block;
        padding: 2px;
        font-size: 12px;

    }
    .dropdown1 dt a span,
    .multiSel1 span  p{
        font-size: 12px;


    }
    .dropdown1 dd ul {
        z-index: 100;
        background: #ffff;
        border: 1px solid rgba(0,0,0,.07);
        border-radius: 0.4375rem;
        color: #75868f;
        display: none;
        left: 0px;
        padding: 2px;
        position: absolute;
        top: 2px;
        width: 100%;
        list-style: none;
        height:115px;
        overflow: auto;
    }

    .dropdown1 span.value {
        display: none;
    }
    .dropdown1 dd ul li{
        font-size: 12px!important;
    }
    .dropdown1 dd ul li a {
        padding: 5px;
        display: block;

    }

    .dropdown1 dd ul li a:hover {
        background-color: #fff;
    }
    


</style>
</body>

</html>