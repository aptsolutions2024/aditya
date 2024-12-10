<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Supplier | Aditya</title>

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
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />

    
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
                            <li class="breadcrumb-item active" aria-current="page">Add Supplier</li>

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

<h2 class="mb-3">Add Supplier</h2>
<?php }else{ ?>
<h2 class="mb-3">Update Supplier</h2>     
<?php } ?>


                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($getsupplier['id']==''){ ?>
                                        <?php echo form_open('/createSupplier', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateSupplier', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getsupplier['id'];?>">
                                    <?php } ?>
                                        <form class="row g-3">
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Supplier Name<label class="mandatory">*</label></label>
                                            <input id="txtName" maxlength="40" name="txtName" value="<?=$getsupplier['name'];?>"   style="text-transform: uppercase"  onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Supplier Name" value="<?php echo set_value('txtName', $getsupplier[name]); ?>">
                                             <?php echo form_error('txtName');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="" class="form-label">Email.<label class="mandatory">*</label></label>
                                            <input id="txtEmail" type="text" value="<?=$getsupplier['email_id'];?>" name="txtEmail"  style="text-transform: uppercase"  onkeypress="return ValidateAlphaNumeric(event);" class="form-control" placeholder="Email" value="<?php echo set_value('txtEmail'); ?>">
                                             <?php echo form_error('txtEmail');?>
                                        </div>  
                                          <div class="col-md-4">
                                            <label for="" class="form-label">Supplier Type<label class="mandatory">*</label></label>
                                            
                                            <select id="txttype"  name="txttype" class="form-control">
                                                <option value="">Select Supplier</option>
                                                <option value="1" <?= ($getsupplier[supl_type] == 1) ? "selected" : ""; ?> >Row matterial Supplier</option>
                                                <option value="2" <?= ($getsupplier[supl_type] == 2) ? "selected" : ""; ?> >Operations sub Contractor</option>
                                                <option value="3" <?= ($getsupplier[supl_type] == 3) ? "selected" : ""; ?>>Production Supplier</option>
                                                <option value="4" <?= ($getsupplier[supl_type] == 4) ? "selected" : ""; ?>>Consumables</option>
                                            </select>
                                            
                                            <!-- <input id="txtGSTNo" type="text" name="txtGSTNo"  maxlength="15"   style="text-transform: uppercase"  onkeypress="return ValidateAlphaNumeric(event);" class="form-control" placeholder="type" value="<?php echo set_value('gst_no', $getsupplier[name]); ?>"> -->

                                             <?php echo form_error('txttype');?>
                                        </div>                                       

                                        <div class="col-8">
                                            <label for="" class="form-label">Address<label class="mandatory">*</label></label>
                                            <input id="txtAddress" maxlength="150" name="txtAddress" style="text-transform: uppercase"  onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Address" value="<?php echo set_value('txtAddress', $getsupplier[address]); ?>">
                                            <?php echo form_error('txtAddress');?>
                                        </div>
                                         <div class="col-md-4">
                                            <label for="" class="form-label">GST No.<label class="mandatory">*</label></label>
                                            <input id="txtGSTNo" type="text" name="txtGSTNo"  maxlength="15"   style="text-transform: uppercase"  onkeypress="return ValidateAlphaNumeric(event);" class="form-control" placeholder="GST No." value="<?php echo set_value('txtGSTNo', $getsupplier[gst_no]); ?>">
                                             <?php echo form_error('txtGSTNo');?>
                                        </div>  
                                       
                                                                          
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Bank Name<label class="mandatory">*</label></label>
                                            <input id="txtBankName" maxlength="30" name="txtBankName"   style="text-transform: uppercase"  onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Bank Name" value="<?php echo set_value('txtBankName', $getsupplier[bankName]); ?>">
                                            <?php echo form_error('txtBankName');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Account No.<label class="mandatory">*</label></label>
                                            <input id="txtAccountNo" name="txtAccountNo" maxlength="15" onkeypress="return isNumberKey(event)" type="text" class="form-control" placeholder="Account No." value="<?php echo set_value('txtAccountNo', $getsupplier[bank_acno]); ?>">
                                             <?php echo form_error('txtAccountNo');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">IFSC Code<label class="mandatory">*</label></label>
                                            <input id="txtIFSCCode" name="txtIFSCCode" type="text" maxlength="11"   style="text-transform: uppercase"  onkeypress="return ValidateAlphaNumeric(event);" class="form-control" placeholder="IFSC Code" value="<?php echo set_value('txtIFSCCode', $getsupplier[IFSCCode]); ?>">
                                            <?php echo form_error('txtIFSCCode');?>
                                        </div>
                                        <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                        <h3>Add Contact Person</h3>
                                        
                                          <div class="col-md-4">
                                              <label  class="form-label">Contact Person<label class="mandatory"></label></label>
                                          </div>
                                           <div class="col-md-4">
                                             <label  class="form-label">Contact No<label class="mandatory"></label></label>
                                          </div>
                                           <div class="col-md-4">
                                               <label class="form-label">Email ID<label class="mandatory"></label></label>
                                          </div>

                                        <div class="row" style="margin-top:10px;" >
                                            <?php 
                                            
                                              $contactPerDetails = rtrim($getsupplier['contact_person_details'],"-");

                                               if(!empty($contactPerDetails))
                                               {
                                                    $txtcontactPerDetails = explode("-", $contactPerDetails);

                                               

                                               foreach ($txtcontactPerDetails as $key => $value) 
                                               {
                                                    $txtValue = explode(",",$value);
                                                    $string = str_replace(' ', '', $txtValue[0]);
                                                ?>
                                           <div class="col-md-4 <?=$string;?>" >
                                                <input id="txtContactPerson" style="text-transform: uppercase" name="txtContactPerson[]" onkeypress = "return NumberAlphaBetDashUnderscoreSpace(event,this);" maxlength="20" type="text" class="form-control" placeholder="Contact Person" value="<?php  echo $txtValue[0]; ?>">
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

                                                <div class="col-md-1 <?=$string;?>" style="margin-top: 25px;"> 
                                                <a href="javascript:void(0);" onclick="removeRowInDB('<?=$string;?>');" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 35px;">
                                                </a>
                                                </div>
                                           <?php } } ?>

                                             <div class="col-md-4">
                                                <input id="txtContactPerson" name="txtContactPerson[]" style="text-transform: uppercase"   maxlength="20" type="text" class="form-control" placeholder="Contact Person" value="">
                                                 <?php echo form_error('txtContactPerson');?>
                                            </div>

                                            <div class="col-md-4">
                                                <input id="txtContactNo" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No" value="">
                                                 <?php echo form_error('txtContactNo');?>
                                            </div>
                                            <div class="col-md-3">
                                                <input id="txtEmailID" type="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID" value="">
                                                 <?php echo form_error('txtEmailID');?>
                                            </div> 


                                                <div class="col-md-1" style="margin-top: 25px;">
                                                <a href="javascript:void(0);" onclick="addContactPerson(this.form);" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                                </a>
                                                </div>

                                            </div>  <div id="addContactPerson1" style="width:99%;"></div>

                                             <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                        <h3>Add Operations</h3>
                                        
                                        <div class="row" style="margin-top:10px;" >
                                             
                                             <dl class="dropdown">

                                                <dt >
                                                    <a href="#"  >
                                                        <span  class="hida form-control">Select Month</span>
                                                        <p class="multiSel"></p>
                                                    </a>
                                                </dt>

                                                <dd>
                                                    <div class="mutliSelect">
                                                        <ul>
                                                            <li>
                                                                <input type="checkbox" value="JUN" name="month[]" />JUN</li>
                                                            <li>
                                                                <input type="checkbox" value="JUL" name="month[]" />JUL</li>
                                                            <li>
                                                                <input type="checkbox" value="AUG" name="month[]" />AUG</li>
                                                            <li>
                                                                <input type="checkbox" value="SEP" name="month[]" />SEP</li>
                                                            <li>
                                                                <input type="checkbox" value="OCT" name="month[]" />OCT</li>
                                                            <li>
                                                                <input type="checkbox" value="OCT-I" name="month[]" />OCT-I</li>
                                                            <li>
                                                                <input type="checkbox" value="OCT-II" name="month[]" />OCT-II</li>
                                                            <li>
                                                                <input type="checkbox" value="NOV" name="month[]" />NOV</li>
                                                            <li>
                                                                <input type="checkbox" value="DEC" name="month[]" />DEC</li>
															<li>
                                                                <input type="checkbox" value="JAN" name="month[]" />JAN</li>
                                                            <li>
                                                                <input type="checkbox" value="FEB" name="month[]" />FEB</li>
                                                            <li>
                                                                <input type="checkbox" value="MAR" name="month[]" />MAR</li>
                                                            <li>
                                                                <input type="checkbox" value="APR" name="month[]" />APR</li>
                                                            <li>
                                                                <input type="checkbox" value="MAY" name="month[]" />MAY</li>
                                     																
                                                        </ul>
                                                    </div>
                                                </dd>

                                            </dl>
                                            
                                            
                                            
                                            <div class="col-md-4">
                                            <label for=""  class="form-label">Operation Group<label class="mandatory"></label></label>
                                            <select id="operationgrp" multiple name="operationgrp" class="form-control operationgrp">

                                                <option value="">Select Operation Group</option>
                                               <?php

                                               foreach ($OperationGrp as $key => $value) 
                                               {

                                                ?>
                                                   <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                               <?PHP }

                                               ?>
                                            </select>

                                            
                                        </div>  


                                        <div class="col-md-4">
                                            <label for="" class="form-label">Operations<label class="mandatory"></label></label>

                                            <select multiple class="form-control" name="operationname[]" id="operationname">
                                                   <?php
                                                   if(!empty($getOperation))
                                                   {

                                                   foreach ($getOperation as $key => $valuess) 
                                                   { ?>
                                                         <option selected value="<?= $valuess['id']; ?>"><?= $valuess['name']; ?></option>
                                                  <?php  }
                                                    }


                                                   ?>
                                            </select>

                                           
                                            </div>  
                                        </div>  
                                        <div id="addContactPerson1" style="width:99%;"></div>




<!-- 
                                         <div class="modal-footer">
                                                 <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div> -->

                                               <div class="col-md-2 modal-footer">
                                            <?php 

                                            $id = base64_decode($_GET['ID']);

                                            if($id == ''){ ?>
                                         
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } ?>

                                    </div>


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
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js" defer></script> -->


    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->

    <script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
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
</body>

</html>

<script type="text/javascript">


  $('.operationgrp').change(function() 
  {
       var menuId = $(this).val();

       $.ajax({
                url: "<?= base_url('getoperationname'); ?>",
                data: {id : menuId},
                dataType: "json",
                type: "POST",
                success: function(data)
                {
                    // alert(data);

                    $("#operationname").html(data);
                }
        });



  });




$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.facilities select option');
  var selected = $('.facilities').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.facilities').find('select').empty().append( my_options );
  $('.facilities').find('select').val(selected);
  
  // set it to multiple
  $('.facilities').find('select').attr('multiple', true);
  
  // remove all option
  $('.facilities').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.facilities').find('select').multiselect();
})



    
var rowCount2 = 1;
    function addContactPerson(frm) {

        rowCount2 ++;
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-4"><input id="txtContactPerson" name="txtContactPerson[]" onkeypress = "return;" maxlength="20" type="text" class="form-control" placeholder="Contact Person"><?php echo form_error('txtContactPerson');?>
                                            </div><div class="col-md-4"><input id="txtContactNo'+rowCount2+'" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No"><?php echo form_error('txtContactNo');?>
                                            </div><div class="col-md-3"><input id="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID"><?php echo form_error('txtEmailID');?>
                                            </div>'+
       '<div class="col-md-1" style="margin-top: 25px;"><a href="javascript:void(0);" onclick="removeRow2('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
        ;
        jQuery('#addContactPerson1').append(recRow);
        
    }

    var rowCount3 = 1;
    function addConsigneePerson(frm) {
        rowCount3 ++;
        var recRow = '<span id="rowCount3'+rowCount3+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-3"></label><input id="txtCname" name="txtCName[]" onkeypress = "return NumberAlphaBetDashUnderscoreSpace(event,this);" maxlength="20" type="text" class="form-control" placeholder="Consignee Name"><?php echo form_error('txtCname');?></div><div class="col-md-4"></label><input id="txtCAddress" name="txtCAddress[]"  maxlength="10" type="text" class="form-control" placeholder="Consignee Address"><?php echo form_error('txtCAddress');?>
                                            </div><div class="col-md-2"></label></label><input id="txtCgstno" name="txtCgstno[]" maxlength="50" type="text" class="form-control" placeholder="Gst No"><?php echo form_error('txtCgstno');?></div><div class="col-md-2"><label class="form-label"><input id="txtCstatecode" name="txtCstatecode[]" maxlength="50" type="text" class="form-control" placeholder="State Code"><?php echo form_error('txtCstatecode');?>
                                            </div><div class="col-md-1" style="margin-top: 25px;"><a href="javascript:void(0);" onclick="removeRow3('+rowCount3+');" ><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>';
        jQuery('#addConsigneePerson1').append(recRow);
        
    }
    function CloseCustomer(removeNum) 
    {
        location.href = 'Supplier';

    } 
    function removeRow2(removeNum) 
    {
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }
    function removeRow3(removeNum) 
    {
    jQuery('#rowCount3'+removeNum).remove();
    rowCount3 --;
    }
    function removeRowInDB(removeNum) 
    {
    //alert(removeNum);
        jQuery('.'+removeNum).hide();
        jQuery('.'+removeNum).remove();
        jQuery('#rowCount2').remove();
        rowCount2 --;
    }
</script>



<script>
	function changed(val) {
	if(val=='1'){
     $('#rollnoinput').show();
	  }
	  else{
		$('#rollnoinput').hide();
	  }
	}
	function rollnotoname(val) {

	    if(val==''||val==' '){
	        var data="<span style='font-size:12px;color: red'>Enter the Roll No!</span>";
            $("#msgname").html(data);
        }else {
            $.ajax({
                type: 'POST',
                url: 'rolltoname.php',
                data: {roll: val},
                success: function (data) {

                    $("#msgname").html(data);


                }
            });
        }
	}

    $(".dropdown dt a").on('click', function() {
        $(".dropdown dd ul").slideToggle('fast');
    });

    $(".dropdown dd ul li a").on('click', function() {
        $(".dropdown dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
    });

    $('.mutliSelect input[type="checkbox"]').on('click', function() {

        var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
            title = $(this).val() + ",";

        if ($(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            $('.multiSel').append(html);
            $(".hida").hide();
        } else {
            $('span[title="' + title + '"]').remove();
            var ret = $(".hida");
            $('.dropdown dt a').append(ret);

        }
    });
</script>
<?php include('../footer.php');?>
</body>

<style>
    .dropdown {
        /*position: absolute;*/
        /*top:50%;*/
        /*transform: translateY(-50%);*/
        /*overflow: auto;*/
        height: 20px;
        z-index: 100;
    }

    a {
        color: #fff;
    }

    .dropdown dd,
    .dropdown dt {
        margin: 0px;
        padding: 0px;
        height: 30px;
    }

    .dropdown ul {
        margin: -1px 0 0 0;

    }

    .dropdown dd {
        position: relative;
    }

    .dropdown a,
    .dropdown a:visited {
        color: #fff;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .dropdown dt a {
        background: linear-gradient(#7a9bc4, #7192bb);
        display: block;
        padding: 2px;
        overflow: hidden;
        border: 0;
height: 30px;
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
        background: linear-gradient(#7a9bc4, #7192bb);
        border: 0;
        color: #fff;
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

</style>