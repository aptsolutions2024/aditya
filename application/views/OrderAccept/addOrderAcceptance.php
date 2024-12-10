<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Order Acceptance | Aditya</title>

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
<style>
   .displayQtyinDetails{
           margin-top: 35%;
   }
</style>
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
                       <li class="breadcrumb-item"><a href="<?php echo base_url('orderAcceptance');?>">Order Acceptance</a></li>
                             </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    <p class="lead">    </p>
                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <?php  if($getOrdAccept['id']==''){ ?>
                    <h2 class="mb-3">Add Order Acceptance</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update Order Acceptance</h2>
                    <?php } ?>
                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                        <!-- Block styled form -->
                                        <?php  if($getOrdAccept['id']==''){ ?>
                                        <?php echo form_open('/createOrderAcceptance', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateOrderAcceptance', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getOrdAccept['id'];?>">
                                    <?php } ?>



                                        <div class="col-md-6">
                                            <label class="form-label">Customer Name <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Customer_Id'); ?>
                                            <select id="Customer_Id" name="Customer_Id" class="form-select" onchange="getConsignee(this.value);">
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getCustName as $row){ ?>                                              
                                                <option value="<?=$row['id'];?>" <?php if($getOrdAccept[customer_id]==$row['id']){ echo "selected";} ?> <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Customer_Id');?>
                                        </div>

                                        <div class="col-md-6">
                                            <label  class="form-label">Consignee Name (B2S Vendor)</label>
                                            <select id="ShowConsignee" name="Consignee_Id" class="form-select">
                                                <option selected value="">Choose...</option> 
                                            </select>
                                           
                                        </div>

                                        
                                        <div class="col-md-4">
                                            <label class="form-label">Customer Pono<label class="mandatory">*</label></label>
                                            <input id="cust_pono" name="cust_pono" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event)"  type="text" class="form-control" placeholder="Customer Pono" value="<?php echo set_value('cust_pono', $getOrdAccept[cust_pono]); ?>" onInput="checkPono(this.value)">
                                            <?php echo form_error('cust_pono');?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pono Date<label class="mandatory">*</label></label>
                                            <input id="cust_podate" name="cust_podate" type="date" class="form-control" placeholder="Part No." value="<?php echo set_value('cust_podate', $getOrdAccept[cust_podate]); ?>">
                                            <?php echo form_error('cust_podate');?>
                                        </div>
                                        <div class="col-md-4">
                                       <label  class="form-label">Labour Po<label class="mandatory">*</label></label>
                                       <?php $un= set_value('labour_po'); ?>
                                       <select id="labour_po" name="labour_po" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <option value="Y" <?php if($getOrdAccept[labour_po]=='Y') {echo "selected";} ?> <?php if($un=='Y'){echo "selected";} ?>>YES</option>
                                          <option value="N" <?php if($getOrdAccept[labour_po]=='N') {echo "selected";} ?> <?php if($un=='N'){echo "selected";} ?>>NO</option>
                                          
                                       </select>
                                       <?php echo form_error('labour_po');?>
                                    </div>

                                    <div class="col-12">
                                            <label class="form-label">Amendment Details</label>
                                            <textarea id="amendment_details" name="amendment_details" type="text" class="form-control" placeholder="Amendment Details" ><?php echo set_value('amendment_details', $getOrdAccept[amendment_details]); ?></textarea>
                                            
                                        </div>

                                    <div class="col-12">
                                            <label class="form-label">Payment Terms</label>
                                            <textarea id="payment_terms" name="payment_terms" type="text" class="form-control" placeholder="Payment Terms"><?php echo set_value('payment_terms', $getOrdAccept[payment_terms]); ?></textarea>
                                            
                                        </div>


                                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <h3>Order Acceptance Details</h3>
                                <?php 
                                if(!empty($_SESSION['oamsg']))
                                { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['oamsg'];?></div>

                                 <?php 
                                }
                                if(!empty($getOADetailsById))
                                {
                                   $editcount=0;
                                  
                                    foreach ($getOADetailsById as $key => $value) 
                                    { 
                                        $editcount++;
                                        $partD = $this->getQueryModel->getPartsById($value['part_id']);
                                        $partno = $partD['partno'];
                                    
                                        $invqty=0;
                                        $balqty="";
                                        $invDet = $this->getQueryModel->getInvQtybyOAdetId($value['id'],$getOrdAccept[customer_id]);
                                        
                                        
                                        $invqty=$invDet['invqty'];
                                        
                                           if($value['qty']<900000){
                                              $balqty=$value['qty']-$invqty; 
                                           }elseif($value['qty']>900000){
                                               $balqty="<span style=color:green;'>OPEN</span>";  
                                           }
                                           
                                     $partSchedule = $this->getQueryModel->getScheduleByOA2Id($value['id']);
                                     if($partSchedule==1)
                                     {
                                         $disabled = 'readonly';
                                     }
                                    ?>

                                    <div class="row" style="margin-top: 10px;">
                                    <input type="hidden" name="editOADID[]" value="<?=$value['id'];?>">
                                        <div class="col-md-3">
                                            <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                            <input type="hidden" id="edit_Part_Id<?=$editcount;?>" name="edit_Part_Id[]" class="form-control" value="<?= $value[part_id]; ?>" >
                                            <div class="autocomplete">
                                              <input type="search" id="edit_Part_Search<?=$editcount;?>" name="edit_Part_Search[]" class="form-control" value="<?php echo $partD['partno']." - ".$partD['name'];?>" onkeyup="searchPartOAEdit(this.value,'<?= $editcount; ?>','<?=base_url('getPartsBySearch')?>')" <?php echo $disabled;?>>   
                                              <ul id="edit_searchResult<?=$editcount;?>" class="searchResult"></ul>   
                                           </div> 
                                           <div id="editpartExit<?=$editcount;?>" style="display:none;font-size: 13px; text-align: center; color: red; margin-top: 5px;">Part Name Already Exists For This Customer.</div>
                   
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">Quantity <label class="mandatory">*</label></label>
                                            <input id="quantity" name="edit_quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity" value="<?=$value['qty'];?>">
                                        </div>

                                

                                 <div class="col-md-3">
                                            <label class="form-label">With Effect From <label class="mandatory">*</label></label>
                                            <input id="with_effect_from" name="edit_with_effect_from[]" type="date" class="form-control" value="<?=$value['with_effect_from'];?>">
                                        </div>

                                         <div class="col-md-3">
                                            <label class="form-label">Rate /Piece <label class="mandatory">*</label></label>
                                            <input id="rate" name="edit_rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="<?=$value['rate'];?>">
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">IGST %</label>
                                            <input id="igst" name="edit_igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="<?=$value['igst'];?>">
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">CGST %</label>
                                            <input id="cgst" name="edit_cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="<?=$value['cgst'];?>">
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">SGST %</label>
                                            <input id="sgst" name="edit_sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="<?=$value['sgst'];?>">
                                </div>
                                  <div class="col-md-1">
                                            <label class="form-label displayQtyinDetails">Inv. Qty<br>
                                            <?php  echo $invqty;?></label>
                                           
                                </div>
                                  <div class="col-md-1">
                                            <label class="form-label displayQtyinDetails">Bal Qty<br>
                                            <?php  echo $balqty; ?>
                                            </label>
                                </div>
                        </div>
                                    
<div style="border: 1px dotted #df5645;margin-top: 10px;"></div>

                                    <?php  } } ?>



                                 <div class="row" style="margin-top: 10px;">
                                 <div class="col-md-3">
                                            <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                               <input type="hidden" id="Part_Id1" name="Part_Id[]" class="form-select Part_Id" value="">
                                               <div class="autocomplete">
                                                  <input type="search" id="Part_Search1" name="Part_Search[]" class="form-control" value="<?=$pname;?>" onkeyup="searchPartOA(this.value,1,'<?=base_url('getPartsBySearch')?>')">   
                                                  <ul id="searchResult1" class="searchResult"></ul>   
                                               </div>  
                                            <div id="partExit1" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Part Name Already Exists For This Customer.</div>
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">Quantity <label class="mandatory">*</label></label>
                                            <input id="quantity" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity" value="">
                                        </div>

                                

                                 <div class="col-md-2">
                                            <label class="form-label">With Effect From <label class="mandatory">*</label></label>
                                            <input id="with_effect_from" name="with_effect_from[]" type="date" class="form-control" value="">
                                        </div>

                                         <div class="col-md-3">
                                            <label class="form-label">Rate /Piece <label class="mandatory">*</label></label>
                                            <input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="">
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">IGST %</label>
                                            <input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">
                                        </div>

                                 <div class="col-md-3">
                                            <label class="form-label">CGST %</label>
                                            <input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">
                                        </div>

                                 <div class="col-md-2">
                                            <label class="form-label">SGST % </label>
                                            <input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">
                                        </div>
                                        <div class="col-md-1" style="margin-top: 30px;">
                                       <a href="javascript:void(0);" onclick="addOrderAccep(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                       </a>
                                    </div>
                                    </div>

                                    <div id="addOrderAccep1" style="width: 99%;"></div>


                                         
                                        <?php if($getOrdAccept['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="/orderAcceptance"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="/orderAcceptance"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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

    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>

   <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">
<script>
$( document ).ready(function() {
    var custId='<?=$getOrdAccept['customer_id'];?>';
getConsignee(custId);
});

    function NumberAlphaBetDashUnderscoreSpace(e) {
    var keyCode = e.keyCode || e.which;    
    //Regex to allow only Alphabets Numbers Dash Underscore and Space
    var pattern = /^[a-z\d\-_\s]+$/i;
    //Validating the textBox value against our regex pattern.
    var isValid = pattern.test(String.fromCharCode(keyCode));   
    return isValid;
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function getConsignee(custId)
{
    var custSelId='<?=$getOrdAccept['customer_id'];?>';
    $.ajax({
   url:"<?php echo base_url(); ?>/getConsignee",
   method:"POST",
   data:{custId:custId,custSelId:custSelId},
   success:function(result)
   {
    $("#ShowConsignee").html(result);
   }
   });
}


var rowCount = 1;
    function addOrderAccep(frm) {
        rowCount ++;
        var baseurl=" '<?=base_url()?>getPartsBySearch ' "; 
      
        var recRow = '<span id="rowCount1'+rowCount+'">' +
'<div style="border: 1px dotted #df5645;margin-top: 10px;"></div><div class="row" style="margin-top: 10px;">'+

'<div class="col-md-3"><label class="form-label">Part Name <label class="mandatory">*</label></label>'+
'<input type="hidden" id="Part_Id'+rowCount+'" name="Part_Id[]" class="form-select Part_Id" value="">'+
   '<div class="autocomplete">'+
    '<input type="search" id="Part_Search'+rowCount+'" name="Part_Search[]" class="form-control" value="" onkeyup="searchPartOA(this.value,'+rowCount+','+baseurl+')">'+   
    '<ul id="searchResult'+rowCount+'" class="searchResult"></ul>'+   
   '</div>'+
'<div id="partExit'+rowCount+'" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Part Name Already Existed</div></div>'+

'<div class="col-md-3"><label class="form-label">Quantity <label class="mandatory">*</label></label><input id="quantity" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity" value=""></div>'+



'<div class="col-md-2">'+
'<label class="form-label">With Effect From <label class="mandatory">*</label></label>'+
'<input id="with_effect_from" name="with_effect_from[]" type="date" class="form-control" value="">'+
'</div>'+

'<div class="col-md-3">'+
'<label class="form-label">Rate /Piece <label class="mandatory">*</label></label>'+
'<input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="">'+
'</div>'+

'<div class="col-md-3">'+
'<label class="form-label">IGST %</label>'+
'<input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">'+
'</div>'+

'<div class="col-md-3">'+
'<label class="form-label">CGST %</label>'+
'<input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">'+
'</div>'+

'<div class="col-md-2">'+
'<label class="form-label">SGST %</label>'+
'<input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">'+
'</div><div class="col-md-1" style="margin-top: 25px;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
        ;
        jQuery('#addOrderAccep1').append(recRow);
        
    }
    function removeRow1(removeNum) {
    jQuery('#rowCount1'+removeNum).remove();
    rowCount --;
    }
function getPartsByProdFamily(Prod_Family_Id,nums)
{
	
	$.ajax({
      url:"<?php echo base_url(); ?>getPartsByProdFamily",
      method:"POST",
      data:{Prod_Family_Id:Prod_Family_Id},
      success:function(result)
      {
      $("#Part_Id"+nums).html(result);
      }
      }); 
}
function editgetPartsByProdFamily(Prod_Family_Id,nums)
{
	
//	var custId=$("#Customer_Id").val();
	$.ajax({
      //url:"<?php echo base_url(); ?>getPartsByProdFamilyByCust",
      url:"<?php echo base_url(); ?>getPartsByProdFamily",
      method:"POST",
      data:{Prod_Family_Id:Prod_Family_Id},
      success:function(result)
      {
      $("#edit_Part_Id"+nums).html(result);
      }
      }); 
}
    function checkPono(val){
        $("#cust_pono").removeClass('bordererror');
            $.ajax({
              url:"<?php echo base_url(); ?>checkPono",
              method:"POST",
              data:{val:val},
              success:function(result)
              {
                  if(result >= 1)
                  {
                     $("#cust_pono").focus();
                       error ="Pono number already exists for OA No. - "+result;
                       $("#cust_pono").val('');
                       $("#cust_pono").addClass('bordererror');
                       $("#cust_pono").attr("placeholder", error);
                       return false; 
                  }
                
              }
              });
    }

    function checkPartExit(val,idCount){
        	var custId=$("#Customer_Id").val();

        $("#partExit"+idCount).hide();
            $.ajax({
              url:"<?php echo base_url(); ?>checkPartExit",
              method:"POST",
              data:{val:val,custId:custId},
              success:function(result)
              {
                  console.log(result);
                  if(result > 0)
                  {
                     $("#Part_Id"+idCount).val('');
                     $("#partExit"+idCount).show();
                  }
                
              }
              });
    }
    
   function checkPartExitEdit(val,idCount){
        	var custId=$("#Customer_Id").val();
            
        $("#editpartExit"+idCount).hide();
            $.ajax({
              url:"<?php echo base_url(); ?>checkPartExit",
              method:"POST",
              data:{val:val,custId:custId},
              success:function(result)
              {   
                  //console.log(result);
                  if(result > 0)
                  {
                     $("#edit_Part_Id"+idCount).val('');
                     $("#editpartExit"+idCount).show();
                  }
                
              }
              });
    }
</script>
</body>

</html>