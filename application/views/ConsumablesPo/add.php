<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Consumables Purchase Order | Aditya</title>

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

    <!-- Tabulator Style [ OPTIONAL ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/bootstrap-multiselect.css">

     <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">  
    
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>ConsumablesPO">Consumables Purchase Order</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Consumables Purchase Order</h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                        <!-- Block styled form -->
                                        <?php  if($getConsumpo['id']==''){ 
                                            $readonly='';
                                        ?>
                                        <?php echo form_open('/createConsumablesPo', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { $readonly='disabled'; ?>
                                        <?php echo form_open('/updateConsumablesPo', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getConsumpo['id'];?>">
                                    <?php } ?>



                                        <div class="col-md-6">
                                            <label class="form-label">Supplier Name <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Supplier_Id'); ?>
                                            <select id="Supplier_Id" name="Supplier_Id" class="form-select alltxtUpperCase" onchange="getConsignee(this.value);" <?=$readonly;?>
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getSupplier as $row){ ?>                                              
                                                <option value="<?=$row['id'];?>" <?php if($getConsumpo[supplier_id]==$row['id']){ echo "selected";} ?> <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Supplier_Id');?>
                                        </div>

                                         <div class="col-md-6">
                                            <label class="form-label">Date<label class="mandatory">*</label></label>
                                            <input id="Other_date" name="Other_date" type="date" class="form-control" placeholder="Part No." value="<?php echo set_value('Other_date', $getConsumpo[date]); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('Other_date');?>
                                        </div>

                                        

                                    <div class="col-12">
                                            <label class="form-label">Payment Terms</label>
                                            <textarea id="payment_terms" name="payment_terms" type="text" class="form-control" placeholder="Payment Terms"><?php echo set_value('payment_terms', $getConsumpo[payment_terms]); ?></textarea>
                                            
                                        </div>


                                    <div class="col-12">
                                            <label class="form-label">Remark</label>
                                            <textarea id="Remark" name="Remark" type="text" class="form-control" placeholder="Remark" ><?php echo set_value('Remark', $getConsumpo[remarks]); ?></textarea>
                                            
                                        </div>


                                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <?php 
                                 
                                if(!empty($getConsumpoDetails))
                                { ?>
                                    <h3>Consumables Purchase Order Details Update</h3>(For existing Consumables Purchase Order items)
                                    <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                    <thead>
                                    <tr>
                                   
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Remark</th>
                                    <th>Quantity</th>
                                    <th>Rate per piece</th>
                                    <th width="12%">Unit</th>
                                    <th>IGST % </th>
                                    <th>CGST %</th>
                                    <th>SGST %</th>
                                    <th>Action</th>
                                    
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php 

                                    $count1=0;
                                    $i=0;
                                    foreach ($getConsumpoDetails as $key => $values) 
                                    {   
                                    $partD =  $this->getQueryModel->getPartsById($values['part_id']);
                                    $OPD=  $this->getQueryModel->getOperation($values['op_id']);
                                    $count1++;
                                    ?>

                                    <input type="hidden" name="ConsumPOId[]" value="<?= $values['id']; ?>">


                                    <tr>
                                   

                                    <td> <?= $values['id']; ?> </td>
                                   
                                   
                                    <td>
                                    <input type="text" class="form-control" name="edit_Description[]" value="<?= $values['description']; ?>" placeholder="Description">
                                    </td> 
                                    <td>
                                    <input type="text" class="form-control" name="edit_part_remark[]" value="<?= $values['remarks']; ?>" placeholder="Remark">
                                    </td> 
                                    <td>
                                    <input type="text" class="form-control" name="edit_quantity[]" value="<?= $values['qty']; ?>" placeholder="Quantity">
                                    </td>
                                    <td>
                                    <input type="text" class="form-control" name="edit_rate[]" value="<?= $values['rate']; ?>" placeholder="Rate per piece">
                                    </td>
                                    <td>
                                    <input type="text" class="form-control" name="edit_unit[]" value="<?= $values['uom']; ?>" placeholder="Unit">
                                    
                                    </td>
                                    <td class="plan_req_qty">
                                    <input type="text" class="form-control" value="<?= $values['igst']; ?>" name="edit_igst[]" placeholder="IGST % ">
                                    </td>
                                    <td class="manual_qtytd">
                                    <input type="text" class="form-control" value="<?= $values['cgst']; ?>" name="edit_cgst[]" placeholder="CGST % ">
                                    </td>
                                    <td class="manual_qtytd">
                                    <input type="text" class="form-control" value="<?= $values['sgst']; ?>" name="edit_sgst[]" placeholder="SGST % ">
                                    </td>
                                    <td>

                                    </td>
                                    <td  > 
                                    <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                    onclick="deleteRecord('<?=$values['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>

                                    
                                    </td>

                                    </tr>
                                    <?php 

                                    } 
                                    ?>
                                    </tbody>
                                    </table>


                                   <!-- <div class="col-12" align="left">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="/ConsumablesPO"><button type="button" id="btnCloseCustomer"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    </div>-->
                                    

                                    <div style="border: 1px dotted #df5645;margin-top: 10px;"></div>

                                    <?php   } ?>


                                    <h3>Consumables Purchase Order Details Add</h3>(Add new items)
                                    
                                    <?php 
                                if(!empty($_SESSION['oamsg']))
                                { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['oamsg'];?></div>

                                 <?php  } ?>
                                 <div class="row" style="margin-top: 10px;">
                                    
                                

                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">Description <label class="mandatory">*</label></label>
                                            <input id="Description" name="Description[]"  type="text" class="form-control" placeholder="Description" >
                                        </div>
                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">Remark <label class="mandatory">*</label></label>
                                            <input id="part_remark" name="part_remark[]"  type="text" class="form-control" placeholder="Remark" >
                                        </div>

                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">Quantity <label class="mandatory">*</label></label>
                                            <input id="quantity" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity" >
                                        </div>

                                

                                         
                                         <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">Rate per piece<label class="mandatory">*</label></label>
                                            <input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="">
                                        </div>
                                        <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label  class="form-label">Unit<label class="mandatory">*</label></label>
                                        <input id="Unit" name="Unit[]"  type="text" class="form-control" placeholder="Unit" value="">
                                        
                                    </div>

                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">IGST %</label>
                                            <input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">
                                        </div>

                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">CGST %</label>
                                            <input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">
                                        </div>

                                 <div class="col-md-4" style="margin-bottom: 12px;">
                                            <label class="form-label">SGST % </label>
                                            <input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">
                                        </div>
                                        <div class="col-md-4" style="margin-top: 30px;text-align: right;">
                                       <a href="javascript:void(0);" onclick="addOrderAccep(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                       </a>
                                    </div>
                                    </div>

                                    <div id="addOrderAccep1" style="width: 99%;"></div>


                                         
                                        <?php if($getConsumpo['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="<?php echo base_url('ConsumablesPO');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('ConsumablesPO');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->

   
    <!-- Initialize [ SAMPLE ] -->
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/bootstrap-multiselect.js"></script>
    
<script>
$(document).ready(function() 
{
   
    $('#example').DataTable( {
        "paging": false
        
    } );

  
} );
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Consumables Po?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteConsumDetails",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
}

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
    var custSelId='<?=$getConsumpo['customer_id'];?>';
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
        var recRow = '<span id="rowCount1'+rowCount+'">' +
'<div style="border: 1px dotted #df5645;margin-top: 10px;"></div><div class="row" style="margin-top: 10px;">'+


'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">Part Remark <label class="mandatory">*</label></label>'+
'<input id="Description" name="Description[]"  type="text" class="form-control" placeholder="Description" >'+
'</div>'+
'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">Remark <label class="mandatory">*</label></label>'+
'<input id="part_remark" name="part_remark[]"  type="text" class="form-control" placeholder="Remark" >'+
'</div>'+
                                        
'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">Quantity <label class="mandatory">*</label></label><input id="quantity" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity"></div>'+

'<div class="col-md-4">'+
'<label class="form-label">Rate per piece <label class="mandatory">*</label></label>'+
'<input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate per piece" value="">'+
'</div>'+

'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label  class="form-label">Unit<label class="mandatory">*</label></label>'+
'<input id="Unit" name="Unit[]"  type="text" class="form-control" placeholder="Unit" value="">'+
'</div>'+

'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">IGST %</label>'+
'<input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">'+
'</div>'+

'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">CGST %</label>'+
'<input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">'+
'</div>'+

'<div class="col-md-4" style="margin-bottom: 12px;">'+
'<label class="form-label">SGST %</label>'+
'<input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">'+
'</div><div class="col-md-4" style="margin-top: 25px;text-align:right;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
        ;
        jQuery('#addOrderAccep1').append(recRow);
        
    }
    function removeRow1(removeNum) {
    jQuery('#rowCount1'+removeNum).remove();
    rowCount --;
    }
function getPartsByProdFamily(Prod_Family_Id,nums)
{
    
    var custId=$("#Customer_Id").val();
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

</script>
</body>

</html>