<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Customer | Aditya</title>

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
                          <li class="breadcrumb-item"><a href="/MangDashboard">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url(Customers) ?>">Customer</a></li>
                            
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
<?php
     $id = base64_decode($_GET['ID']);

                                            if($id == ''){ ?>

                    <h2 class="mb-3">Add Customer</h2>
                <?php }else{ ?>
                <h2 class="mb-3">Update Customer</h2>     
<?php } ?>
                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php error_reporting(0); if($_SESSION['createC']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createC'];?>
                                        </div>
                                    <?php } ?>
                                          <?php if($customers['id']==''){ ?>
                                        <?php echo form_open('/createCustomer', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateCustomer', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$customers['id'];?>">
                                    <?php } ?>
                                       
                                            <div class="col-md-4 paddingTop5">
                                                <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                                <input id="txtcustName" name="txtcustName" style="text-transform: uppercase" maxlength="50"  type="text" class="form-control" placeholder="Customer Name" value="<?php echo set_value('txtcustName', $customers[name]); ?>">

                                                 <?php echo form_error('txtcustName');?>
                                            </div>

                                            <div class="col-md-4 paddingTop5">
                                                <label class="form-label">GST No.<label class="mandatory">*</label></label>
                                                <input id="txtGSTNo" name="txtGSTNo" style="text-transform: uppercase"  maxlength="15" type="text" class="form-control" placeholder="GST No." value="<?php echo set_value('txtGSTNo', $customers[gst_no]); ?>">
                                                <?php echo form_error('txtGSTNo');?>
                                            </div>                                        
                                            <div class="col-md-4 paddingTop5">
                                                <label class="form-label">Credit Period(Days)<label class="mandatory">*</label></label>
                                                <input id="txtCreditPeriod" name="txtCreditPeriod"  style="text-transform: uppercase" onkeypress="return isNumberKey(event);" maxlength="3" type="text" class="form-control" placeholder="Credit Period" value="<?php echo set_value('txtCreditPeriod', $customers[credit_period]); ?>">
                                                 <?php echo form_error('txtCreditPeriod');?>
                                            </div>
                                            <div class="col-12 paddingTop5">
                                                <label class="form-label">Address<label class="mandatory">*</label></label>
                                                <textarea id="txtAddress" name="txtAddress" maxlength="150"  class="form-control" placeholder="Address" ><?php echo set_value('txtAddress', $customers[address]); ?></textarea>
                                                 <?php echo form_error('txtAddress');?>
                                            </div>
                                              <div class="col-md-4 paddingTop5">
                                                <label class="form-label">Email<label class="mandatory"></label></label>
                                                <input id="txtemail" name="txtemail" style="text-transform: uppercase" maxlength="50"   type="text" class="form-control" placeholder="Customer Email" value="<?php echo set_value('txtemail', $customers[email_id]); ?>">
                                                 <?php echo form_error('txtemail');?>
                                            </div>
                                             <div class="col-md-4 paddingTop5">
                                                <label class="form-label">State Code<label class="mandatory">*</label></label>
                                                <input id="txtStateCode" name="txtStateCode" style="text-transform: uppercase" maxlength="2"  onkeypress="return isNumberKey(event)" type="text" class="form-control" placeholder="State Code" value="<?php echo set_value('txtStateCode', $customers[stateCode]); ?>">
                                                 <?php echo form_error('txtStateCode');?>
                                            </div>
                                             <div class="col-md-4 paddingTop5">
                                                <label class="form-label">Vendor Code<label class="mandatory">*</label></label>
                                                <input id="txtVendorCode" name="txtVendorCode" style="text-transform: uppercase" maxlength="10"   type="text" class="form-control" placeholder="Vendor Code" value="<?php echo set_value('txtVendorCode', $customers[vendor_code]); ?>">
                                                 <?php echo form_error('txtVendorCode');?>
                                            </div>
                                          
                                            <div class="col-md-4 paddingTop5">
                                                <label  class="form-label">Bank Name</label>
                                                <input id="txtBankName" name="txtBankName"  style="text-transform: uppercase"  type="text" class="form-control" placeholder="Bank Name" value="<?php echo set_value('txtBankName', $customers[bankName]); ?>">
                                                 <?php echo form_error('txtBankName');?>
                                            </div>
                                            <div class="col-md-4 paddingTop5">
                                                <label class="form-label">Account No.</label>
                                                <input id="txtAccountNo" name="txtAccountNo" maxlength="15" onkeypress="return isNumberKey(event)" type="text" class="form-control" placeholder="Account No." value="<?php echo set_value('txtAccountNo', $customers[bank_acno]); ?>">
                                                 <?php echo form_error('txtAccountNo');?>
                                            </div>
                                            <div class="col-md-4 paddingTop5">
                                                <label  class="form-label">IFSC Code</label>
                                                <input id="txtIFSCCode" name="txtIFSCCode"  style="text-transform: uppercase"   maxlength="11" type="text" class="form-control" placeholder="IFSC Code" value="<?php echo set_value('txtIFSCCode', $customers[IFSCCode]); ?>">
                                                 <?php echo form_error('txtIFSCCode');?>
                                            </div>

                                       <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                        <h3>Contact Person</h3>
                                        
                                          <div class="col-md-4">
                                              <label  class="form-label">Contact Person<label class="mandatory">*</label></label>
                                          </div>
                                           <div class="col-md-4">
                                             <label  class="form-label">Contact No<label class="mandatory">*</label></label>
                                          </div>
                                           <div class="col-md-4">
                                               <label class="form-label">Email ID<label class="mandatory">*</label></label>
                                          </div>

                                        <div class="row" style="margin-top:10px;" >
                                            <?php 
                                            
                                              $contactPerDetails1 = rtrim($customers['contact_person_details'],"-");
                                              $contactPerDetails = rtrim($contactPerDetails1,",");

                                               if(!empty($contactPerDetails))
                                               {
                                                    $txtcontactPerDetails = explode("-", $contactPerDetails);

                                               

                                               foreach ($txtcontactPerDetails as $key => $value) 
                                               {
                                                   
                                                   
                                                    $txtValue = explode(",",$value);
                                                    $string = str_replace(' ', '', $txtValue[0]);
                                                ?>
                                            <div class="col-md-4 <?=$string;?>" >
                                                <input id="txtContactPerson" style="text-transform: uppercase" name="txtContactPerson[]"   type="text" class="form-control" placeholder="Contact Person" value="<?php  echo $txtValue[0]; ?>">
                                                 <?php echo form_error('txtContactPerson');?>
                                            </div>
                                            <div class="col-md-4 <?=$string;?>">
                                                <input id="txtContactNo" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No" value="<?= $txtValue[1]; ?>">
                                                 <?php echo form_error('txtContactNo');?>
                                            </div>
                                            <div class="col-md-3 <?=$string;?>">
                                                <input id="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID" value="<?= $txtValue[2]; ?>">
                                                 <?php echo form_error('txtEmailID');?>
                                            </div> 

                                                <div class="col-md-1 <?=$string;?>" > 
                                                <a href="javascript:void(0);" onclick="removeRowInDB('<?=$string;?>');" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 35px;">
                                                </a>
                                                <div><br></div>
                                                </div>
                                           <?php } } ?>

                                             <div class="col-md-4">
                                                <input id="txtContactPerson" style="text-transform: uppercase" name="txtContactPerson[]"   type="text" class="form-control" placeholder="Contact Person" value="">
                                                 <?php echo form_error('txtContactPerson');?><br>
                                            </div>
                                            <div class="col-md-4">
                                                <input id="txtContactNo" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No" value="">
                                                 <?php echo form_error('txtContactNo');?>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID" value="">
                                                 <?php echo form_error('txtEmailID');?>
                                            </div> 


                                                <div class="col-md-1" >
                                                <a href="javascript:void(0);" onclick="addContactPerson(this.form);" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                                </a>
                                                </div>

                                            </div> 


                                            <div id="addContactPerson1" style="width:99%;"></div>

                                       <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                <h3>Consignee</h3>
                                 <div class="col-md-3">
                                      <label  class="form-label">Name<label class="mandatory"></label></label>
                                 </div>
                                  <div class="col-md-4">
                                       <label  class="form-label">Address<label class="mandatory"></label></label>
                                 </div>
                                  <div class="col-md-2">
                                      <label class="form-label">Gst No<label class="mandatory"></label></label>
                                 </div>
                                 <div class="col-md-2">
                                     <label class="form-label">State Code<label class="mandatory"></label></label>
                                 </div>

                            <?php 
                                if(!empty($consignee))
                                {
                                    foreach ($consignee as $key => $value) 
                                    {
                                        
                                        $rmid       = "rm".$value['id'];
                                        $id       = $value['id'];
                                        $cust_id    = $value['cust_id'];
                                        $name       = $value['name'];
                                        $address    = $value['address'];
                                        $gst_no     = $value['gst_no'];
                                        $statecode  = $value['statecode'];
                                        

                            ?>
                                        <div class="row" style="margin-top:10px;" >
                                            <div class="col-md-3 <?= $rmid;?> ">
                                               <input type="hidden" name="txtconId[]" value="<?= $id; ?>">
                                                <input id="txtCname" name="txtCName[]"   type="text" class="form-control" placeholder="Consignee Name" value="<?= $name; ?>">
                                                 <?php echo form_error('txtCname');?>
                                            </div>
                                            <div class="col-md-4 <?=$rmid;?> ">
                                               
                                                <input id="txtCAddress" name="txtCAddress[]"   type="text" class="form-control" placeholder="Consignee Address" value="<?= $address; ?>">
                                                 <?php echo form_error('txtCAddress');?>
                                            </div>
                                            <div class="col-md-2 <?=$rmid;?>">
                                                
                                                <input id="txtCgstno" name="txtCgstno[]" maxlength="50" type="text" class="form-control" placeholder="Gst No" value="<?= $gst_no; ?>">
                                                 <?php echo form_error('txtCgstno');?>
                                            </div> 
                                             <div class="col-md-2 <?=$rmid;?>">
                                               
                                                <input id="txtCstatecode" name="txtCstatecode[]" maxlength="50" type="text" class="form-control" placeholder="State Code" value="<?= $statecode; ?>">
                                                 <?php echo form_error('txtCstatecode');?>
                                            </div>


                                               <!--  <div class="col-md-1 <?=$rmid;?>" style="margin-top: 25px;">
                                                <a href="javascript:void(0);" onclick="removeRowInCNremoveRowInCN('<?=$rmid;?>');" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 35px;">
                                                </a>
                                                </div> -->
                                            </div> 
                                            <?php } }?>

                                            <div class="row" style="margin-top:10px;" >
                                            <div class="col-md-3">
                                                
                                                <input id="txtCname" name="txtCName[]"   type="text" class="form-control" placeholder="Consignee Name">
                                                 <?php echo form_error('txtCname');?>
                                            </div>
                                            <div class="col-md-4">
                                                
                                                <input id="txtCAddress" name="txtCAddress[]"  type="text" class="form-control" placeholder="Consignee Address">
                                                 <?php echo form_error('txtCAddress');?>
                                            </div>
                                            <div class="col-md-2">
                                                
                                                <input id="txtCgstno" name="txtCgstno[]" maxlength="50" type="text" class="form-control" placeholder="Gst No">
                                                 <?php echo form_error('txtCgstno');?>
                                            </div> 
                                             <div class="col-md-2">
                                                
                                                <input id="txtCstatecode" name="txtCstatecode[]" maxlength="50" type="text" class="form-control" placeholder="State Code">
                                                 <?php echo form_error('txtCstatecode');?>
                                            </div>


                                                <div class="col-md-1" >
                                                <a href="javascript:void(0);" onclick="addConsigneePerson(this.form);" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                                </a>
                                                </div>
                                            </div>

                                            <div id="addConsigneePerson1" style="width:99%;"></div>
                                        <hr>
                                        <div class="col-md-12" align="center">
                                            <?php 

                                            $id = base64_decode($_GET['ID']);

                                            if($id == ''){ ?>
                                         
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } ?>

                                    </div>


                                              


                                           <!--  <div class="modal-footer">
                                                 <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div> -->
                                    </form>

                                        <!-- END : Block styled form -->

                                   
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

    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->
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


var rowCount2 = 1;
    function addContactPerson(frm) {
        rowCount2 ++;
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-4"><input id="txtContactPerson" name="txtContactPerson[]" onkeypress = "return;"  type="text" class="form-control" placeholder="Contact Person"><?php echo form_error('txtContactPerson');?>
                                            </div><div class="col-md-4"><input id="txtContactNo'+rowCount2+'" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No"><?php echo form_error('txtContactNo');?>
                                            </div><div class="col-md-3"><input id="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID"><?php echo form_error('txtEmailID');?>
                                            </div><br><br>'+
       '<div class="col-md-1" ><a href="javascript:void(0);" onclick="removeRow2('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
        ;
        jQuery('#addContactPerson1').append(recRow);
        
    }

    var rowCount3 = 1;
    function addConsigneePerson(frm) {
        rowCount3 ++;
        var recRow = '<span id="rowCount3'+rowCount3+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-3"></label><input id="txtCname" name="txtCName[]"   type="text" class="form-control" placeholder="Consignee Name"><?php echo form_error('txtCname');?></div><div class="col-md-4"></label><input id="txtCAddress" name="txtCAddress[]"   type="text" class="form-control" placeholder="Consignee Address"><?php echo form_error('txtCAddress');?>
                                            </div><div class="col-md-2"></label></label><input id="txtCgstno" name="txtCgstno[]" maxlength="50" type="text" class="form-control" placeholder="Gst No"><?php echo form_error('txtCgstno');?></div><div class="col-md-2"><label class="form-label"><input id="txtCstatecode" name="txtCstatecode[]" maxlength="50" type="text" class="form-control" placeholder="State Code"><?php echo form_error('txtCstatecode');?>
                                            </div><div class="col-md-1" ><a href="javascript:void(0);" onclick="removeRow3('+rowCount3+');" ><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>';
        jQuery('#addConsigneePerson1').append(recRow);
        
    }
    function CloseCustomer(removeNum) 
    {
        location.href = 'Customers';

    } 
    function removeRow2(removeNum) 
    {

    jQuery('#rowCount2'+removeNum).remove();
    jQuery('#rowCount2').remove();
    rowCount2 --;
    }
    function removeRowInDB(removeNum) 
    {
    //alert(removeNum);
        jQuery('.'+removeNum).hide();
        jQuery('.'+removeNum).remove();
        jQuery('#rowCount2').remove();
        rowCount2 --;
    }

     function removeRowInCNremoveRowInCN(removeNum) 
    {
       
    //alert(removeNum);
        jQuery('.'+removeNum).hide();
        jQuery('.'+removeNum).remove();
        jQuery('#rowCount2').remove();
        rowCount2 --;
    }

    function removeRow3(removeNum) 
    {
    jQuery('#rowCount3'+removeNum).remove();
    rowCount3 --;
    }

</script>
</body>

</html>