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
                          <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url(Supplier) ?>">Supplier</a></li>
                          
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
                    <h2 class="mb-3">Add Supplier</h2>
                    <?php } else { ?>
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
                                                <option value="1" <?= ($getsupplier[supl_type] == 1) ? "selected" : ""; ?> >Raw Material Supplier</option>
                                                <option value="2" <?= ($getsupplier[supl_type] == 2) ? "selected" : ""; ?> >Operations sub Contractor (labor charge )</option>
                                                <option value="3" <?= ($getsupplier[supl_type] == 3) ? "selected" : ""; ?>>Production Supplier (with material)</option>
                                                <option value="4" <?= ($getsupplier[supl_type] == 4) ? "selected" : ""; ?>>Consumables</option>
                                            </select>
                                            
                                            <!-- <input id="txtGSTNo" type="text" name="txtGSTNo"  maxlength="15"   style="text-transform: uppercase"  onkeypress="return ValidateAlphaNumeric(event);" class="form-control" placeholder="type" value="<?php echo set_value('gst_no', $getsupplier[name]); ?>"> -->

                                             <?php echo form_error('txttype');?>
                                        </div>                                       

                                        <div class="col-md-8">
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
                                                <input id="txtContactPerson" style="text-transform: uppercase" name="txtContactPerson[]" onkeypress = "return NumberAlphaBetDashUnderscoreSpace(event,this);"  type="text" class="form-control" placeholder="Contact Person" value="<?php  echo $txtValue[0]; ?>">
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

                                                <div class="col-md-1 <?=$string;?>" style="margin-top: 0px;"> 
                                                <a href="javascript:void(0);" onclick="removeRowInDB('<?=$string;?>');" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 35px;">
                                                </a>
                                                </div>
                                           <?php } } ?>

                                             <div class="col-md-4">
                                                <input id="txtContactPerson" name="txtContactPerson[]" style="text-transform: uppercase" type="text" class="form-control" placeholder="Contact Person" value="">
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


                                                <div class="col-md-1" style="margin-top: 0px;">
                                                <a href="javascript:void(0);" onclick="addContactPerson(this.form);" >
                                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                                </a>
                                                </div>

                                            </div>  <div id="addContactPerson1" style="width:99%;"></div>

                                             <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                        <h3>Add Operations</h3>
                                        <div class="row mb-3">
                              
                              <div class="col-sm-4">
                                  <label for="cylinderRetL" class=" col-form-label">Operation Name</label>
                                  <?php 
                                  // echo "<pre>";
                                  // print_r($GetOperationsGroup);
                                  ?>
                                 <select multiple size="15" class="form-control list operation_name"  name="operation_id[]" id="operation_id" style="height: 160px;">
                                    <?php 
                                        $id = base64_decode($_GET['ID']);
                                        $datas = [];
                                        if($id != "")
                                        {
                                            foreach($SupRelation as $val1) 
                                            {
                                                $datas[] = $val1['op_id'];
                                            }
                                        }

                                     $id = base64_decode($_GET['ID']);
                                      
                                         
                                    foreach ($GetOperationsGroup as $key => $value) 
                                    {   if($id != "")
                                        { 
                                             if(in_array($value['operation_id'], $datas))
                                                { ?>
                                                
                                            <?php }else{ ?>
                                                <option value="<?= $value['operation_id']; ?>"> <?= $value['group_name']."  - ".$value['operation_Name']; ?></option> 

                                            <?php }

                                         } else{ ?>
                                        <option value="<?= $value['operation_id']; ?>"> <?= $value['group_name']."  - ".$value['operation_Name']; ?></option> 

                                    <?php } } ?>
                                 </select>
                              </div>
                              <div class="col-sm-1">
                              <br>  <br>
                                 <button type="button" id="moveall" class="btn btn-outline-info">>></button><br>
                                 <button type="button" id="moveone" class="btn btn-outline-secondary" style="width: 44px;">></button><br>
                              
                                 <button type="button" id="removeone" class="btn btn-outline-secondary" style="width: 44px;"><</button><br>
                                 <button type="button" id="removeall" class="btn btn-outline-danger"><<</button><br>
                              </div>
                              <div class="col-sm-4">
                               
                                  <label for="cylinderRetL" class=" col-form-label">Operation Name</label>
                                 <select multiple size="15" class="form-control list" data-target="avaliable" name="operation_name[]" id="operationName" style="height: 160px;">
                                    <?php 
                                        $id = base64_decode($_GET['ID']);
                                      
                                        if($id != "")
                                        {
                                            foreach ($GetOperationsGroup as $key => $value) 
                                            {  
                                                if(in_array($value['operation_id'], $datas))
                                                { ?>
                                                <option selected value="<?= $value['operation_id']; ?>"> <?= $value['group_name']."  - ".$value['operation_Name']; ?></option> 
                                       
                                        <?php   } 
                                            } 
                                        } 
                                    ?>

                                 </select>
                              </div>
                              <div class="col-md-1 col-sm-1" align="center">

                                 <br><br><br><br>

                              <button type="button" id="upone" value="Up" class="btn btn-outline-secondary" style="width: 44px;">⇧</button><br>

                              <button type="button" id="downone" value="Down" class="btn btn-outline-secondary" style="width: 44px;">⇩</button><br>

                              </div>
                           </div>
                                        <div id="addContactPerson1" style="width:99%;"></div>


                                               <div class="col-md-12 modal-footer">
                                            <?php 

                                            $id = base64_decode($_GET['ID']);

                                            if($id == ''){ ?>
                                         
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary update_btn">Update</button>
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
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

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
</script>


<script type="text/javascript">
 
$(".update_btn").click(function()
{
        $("#operationName").attr("selected", "selected");
        // alert("");

}); 


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




// $(function() {
//   // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
//   var my_options = $('.facilities select option');
//   var selected = $('.facilities').find('select').val();

//   my_options.sort(function(a,b) {
//     if (a.text > b.text) return 1;
//     if (a.text < b.text) return -1;
//     return 0
//   })

//   $('.facilities').find('select').empty().append( my_options );
//   $('.facilities').find('select').val(selected);
  
//   // set it to multiple
//   $('.facilities').find('select').attr('multiple', true);
  
//   // remove all option
//   $('.facilities').find('select option[value=""]').remove();
//   // add multiple select checkbox feature.
//   $('.facilities').find('select').multiselect();
// })



    
var rowCount2 = 1;
    function addContactPerson(frm) {

        rowCount2 ++;
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-4"><input id="txtContactPerson" name="txtContactPerson[]" onkeypress = "return;"  type="text" class="form-control" placeholder="Contact Person"><?php echo form_error('txtContactPerson');?></div><div class="col-md-4"><input id="txtContactNo'+rowCount2+'" name="txtContactNo[]" onkeypress="return isNumberKey(event)" maxlength="10" type="text" class="form-control" placeholder="Contact No"><?php echo form_error('txtContactNo');?></div><div class="col-md-3"><input id="txtEmailID" name="txtEmailID[]" style="text-transform: uppercase" maxlength="50" type="text" class="form-control" placeholder="Email ID"><?php echo form_error('txtEmailID');?></div>'+
       '<div class="col-md-1" style="margin-top: 0px;"><a href="javascript:void(0);" onclick="removeRow2('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
        ;
        jQuery('#addContactPerson1').append(recRow);
        
    }

    var rowCount3 = 1;
    function addConsigneePerson(frm) {
        rowCount3 ++;
        var recRow = '<span id="rowCount3'+rowCount3+'">' +
        '<div class="row" style="margin-top:10px;" ><div class="col-md-3"></label><input id="txtCname" name="txtCName[]" onkeypress = "return NumberAlphaBetDashUnderscoreSpace(event,this);"  type="text" class="form-control" placeholder="Consignee Name"><?php echo form_error('txtCname');?></div><div class="col-md-4"></label><input id="txtCAddress" name="txtCAddress[]"   type="text" class="form-control" placeholder="Consignee Address"><?php echo form_error('txtCAddress');?></div><div class="col-md-2"></label></label><input id="txtCgstno" name="txtCgstno[]" maxlength="50" type="text" class="form-control" placeholder="Gst No"><?php echo form_error('txtCgstno');?></div><div class="col-md-2"><label class="form-label"><input id="txtCstatecode" name="txtCstatecode[]" maxlength="50" type="text" class="form-control" placeholder="State Code"><?php echo form_error('txtCstatecode');?></div><div class="col-md-1" style="margin-top: 0px;"><a href="javascript:void(0);" onclick="removeRow3('+rowCount3+');" ><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>';
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

    $('.mutliSelect input[type="checkbox"]').on('click', function() 
    {
        var menuId = $(this).val();
        alert(menuId);
        $.ajax({
                url: "<?= base_url('getoperationname'); ?>",
                data: {id : menuId},
                dataType: "json",
                type: "POST",
                success: function(data)
                {
                    $("#operationname").html(data);
                }
        });

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

    // -------------------------

     $(".dropdown2 dt a").on('click', function() {
        $(".dropdown2 dd ul").slideToggle('fast');
    });

    $(".dropdown2 dd ul li a").on('click', function() {
        $(".dropdown2 dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown2")) $(".dropdown2 dd ul").hide();
    });

    $('.mutliSelect2 input[type="checkbox"]').on('click', function() {

        var title = $(this).closest('.mutliSelect2').find('input[type="checkbox"]').val(),
            title = $(this).val() + ",";

        if ($(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            $('.multiSel2').append(html);
            $(".hida").hide();
        } else {
            $('span[title="' + title + '"]').remove();
            var ret = $(".hida");
            $('.dropdown2 dt a').append(ret);

        }
    });


$('#moveone').click(function () {
return !$('#operation_id option:selected').remove().appendTo('#operationName');
});
$('#removeone').click(function () {
return !$('#operationName option:selected').remove().appendTo('#operation_id');
});
$('#moveall').click(function () {
return !$('#operation_id option').remove().appendTo('#operationName');
});
$('#removeall').click(function () {
return !$('#operationName option').remove().appendTo('#operation_id');
});
</script>

</body>

</body>

</html>