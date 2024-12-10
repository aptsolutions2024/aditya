<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add/Update Company | Aditya</title>

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('addUpdatecompany');?>">ADD / Update Company</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">            </p>
                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php if($getCompany['id']==''){ ?>
                    <h2 class="mb-3">Add Company</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Edit Company</h2>
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
                                        <!-- 
                                        SELECT `id`, `name`, `address`, `email_id`, `contact_no`, `gst_no`, `state_code`, `tann_no`, `pan_no`, `bank_name`, `IFSCCode`,
                                        `short_name`, `bank_acno`, `defect_reg`, `tool_repair` 
                                        FROM `mast_company` WHERE 1
                                         -->
                      
                                        <?php echo form_open('/createupdateCompany', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getCompany['id'];?>">
                               
                                        <div class="col-md-4">
                                            <label class="form-label">Company Name <label class="mandatory">*</label></label>
                                            <input  id="name" name="name"  type="text" class="form-control" placeholder="Company Name" value="<?php echo set_value('name', $getCompany[name]); ?>" style="text-transform: uppercase">
                                            <?php echo form_error('compname');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Company Short Name</label>
                                            <input maxlength="100" id="short_name" name="short_name" type="text" class="form-control" placeholder="Short Name" value="<?php echo set_value('short_name', $getCompany[short_name]) ?>">
                                            <?php echo form_error('state_code');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label  class="form-label">Address</label>
                                            <input   id="address" name="address" type="text" class="form-control" placeholder="Address" value="<?php echo set_value('address', $getCompany[address]) ?>" style="text-transform: uppercase">
                                            <?php echo form_error('address');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Email Id<label class="mandatory">*</label></label>
                                            <input  id="email_id" name="email_id"  type="email" class="form-control" placeholder="Email ID" value="<?php echo set_value('email_id', $getCompany[email_id]) ?>" style="text-transform: uppercase">
                                            <?php echo form_error('email_id');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Contact No</label>
                                            <input maxlength="10" minlength="10" onkeypress="return isNumberKey(event)"  id="contact_no" name="contact_no" type="text" class="form-control" placeholder="Contact No" value="<?php echo set_value('contact_no', $getCompany[contact_no]) ?>">
                                            <?php echo form_error('contact_no');?>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label">GST No.<label class="mandatory">*</label></label>
                                            <input maxlength="50" id="gst_no" name="gst_no" type="text" class="form-control" placeholder="GST No" value="<?php echo set_value('gst_no', $getCompany[gst_no]) ?>">
                                            <?php echo form_error('gst_no');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">State Code</label>
                                            <input maxlength="10" id="state_code" name="state_code" type="text" class="form-control" placeholder="State Code" value="<?php echo set_value('state_code', $getCompany[state_code]) ?>">
                                            <?php echo form_error('state_code');?>
                                        </div> 
                                        <div class="col-md-4">
                                            <label class="form-label">State Code</label>
                                            <input maxlength="10" id="state_code" name="state_code" type="text" class="form-control" placeholder="State Code" value="<?php echo set_value('state_code', $getCompany[state_code]) ?>">
                                            <?php echo form_error('state_code');?>
                                        </div> 
                                        <div class="col-md-4">
                                            <label class="form-label">TAN No</label>
                                            <input maxlength="20" id="tann_no" name="tann_no" type="text" class="form-control" placeholder="TAN No" value="<?php echo set_value('tann_no', $getCompany[tann_no]) ?>">
                                            <?php echo form_error('tann_no');?>
                                        </div> <div class="col-md-4">
                                            <label class="form-label">PAN No</label>
                                            <input maxlength="20" id="pan_no" name="pan_no" type="text" class="form-control" placeholder="PAN No" value="<?php echo set_value('pan_no', $getCompany[pan_no]) ?>">
                                            <?php echo form_error('pan_no');?>
                                        </div> 
                                        <div class="col-md-4">
                                            <label class="form-label">Bank Name</label>
                                            <input maxlength="100" id="bank_name" name="bank_name" type="text" class="form-control" placeholder="Bank Name" value="<?php echo set_value('bank_name', $getCompany[bank_name]) ?>">
                                            <?php echo form_error('bank_name');?>
                                        </div> 
                                        <div class="col-md-4">
                                            <label class="form-label">Bank Acc. No</label>
                                            <input maxlength="100" id="bank_acno" name="bank_acno" type="text" class="form-control" placeholder="Bank Acc. No" value="<?php echo set_value('bank_acno', $getCompany[bank_acno]) ?>">
                                            <?php echo form_error('state_code');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">IFSC Code</label>
                                            <input maxlength="100" id="IFSCCode" name="IFSCCode" type="text" class="form-control" placeholder="IFSC Code" value="<?php echo set_value('IFSCCode', $getCompany[IFSCCode]) ?>">
                                            <?php echo form_error('state_code');?>
                                        </div> 
                                    <div class="col-md-4">
                                       <label class="form-label">Defect Registration</label>
                                        <?php $defect_reg = set_value('defect_reg'); ?>
                                            <select id="defect_reg" name="defect_reg" class="form-select" >
                                                     <option value="">Choose option...</option>
                                                 <option value="1" <?php if($defect_reg==$getCompany['defect_reg']){ echo "selected";} if($getCompany['defect_reg']==1){ echo "selected"; }?>>From Table</option>
                                                 <option value="0" <?php if($defect_reg==$getCompany['defect_reg']){ echo "selected";} if($getCompany['defect_reg']==0){ echo "selected"; }?>>Enter Value</option>
                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                    <div class="col-md-4">
                                       <label class="form-label">Tool Repair</label>
                                        <?php $tool_repair = set_value('tool_repair'); ?>
                                            <select id="defect_reg" name="defect_reg" class="form-select" >
                                                     <option value="">Choose option...</option>
                                                 <option value="1" <?php if($tool_repair==$getCompany['tool_repair']){ echo "selected";} if($getCompany['tool_repair']==1){ echo "selected"; }?>>From Table</option>
                                                 <option value="0" <?php if($tool_repair==$getCompany['tool_repair']){ echo "selected";} if($getCompany['tool_repair']==0){ echo "selected"; }?>>Enter Value</option>
                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                        <?php if($getCompany['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="/company"><button type="button" id="btnCloseCustomer"   class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="/company"><button type="button" id="btnCloseCustomer"   class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
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