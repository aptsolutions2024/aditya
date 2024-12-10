<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Parts Purchase Order | Aditya</title>

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
     <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">    
<style>
    #example input.form-select, #example input.form-control{
            padding: 6px;
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
                           <li class="breadcrumb-item active"><a href="<?php echo base_url('OtherPo');?>">Parts Purchase Order</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3"><?php if($getOtherpo['id']==''){ echo "Add Parts Purchase Order";}else{ echo "Update Parts Purchase Order"; }?>
                    <a href="<?php echo base_url(); ?>partPOPrint?ID=<?php echo base64_encode($getOtherpo['id']); ?>"><span style="float: right;margin-right: 10px;"><i class="demo-pli-printer" aria-hidden="true" style="font-size: 26px;"></i></span></a>
                    
                    </h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                             <?php error_reporting(0); if($_SESSION['oamsg']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['oamsg'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php  if($getOtherpo['id']==''){ 
                                            $disabled='';
                                        ?>
                                        <?php echo form_open('/createOtherPo', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { $disabled='disabled'; ?>
                                        <?php echo form_open('/updateOtherPo', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getOtherpo['id'];?>">
                                        <input type="hidden" name="Supplier_Id" value="<?=$getOtherpo['supplier_id'];?>">
                                    <?php } ?>



                                        <div class="col-md-6">
                                            <label class="form-label">Supplier Name <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Supplier_Id'); ?>
                                            <select id="Supplier_Id" name="Supplier_Id" class="form-select alltxtUpperCase" onchange="getConsignee(this.value);" <?=$disabled;?>>
                                                <option selected value="">Choose...</option>

                                                <?php foreach($getSupplier as $row){ ?>                                              
                                                <option value="<?=$row['id'];?>" <?php if($getOtherpo[supplier_id]==$row['id']){ echo "selected";} ?> <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Supplier_Id');?>
                                        </div>

                                         <div class="col-md-3">
                                            <label class="form-label">Date<label class="mandatory">*</label></label>
                                             <?php $seldate=($getOtherpo['id'])?$getOtherpo['date']:date('Y-m-d'); ?>
                                            <input id="Other_date" name="Other_date" type="date" class="form-control" placeholder="Part No." value="<?php echo set_value('Other_date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('Other_date');?>
                                        </div>
                                        
                                         <div class="col-md-3">
                                            <label class="form-label">W.E.F Date<label class="mandatory">*</label></label>
                                              <?php $challandate=($getOtherpo['id'])?$getOtherpo['wef_date']:date('Y-m-d'); ?>
                                            <input id="wef_date" name="wef_date" type="date" class="form-control" placeholder="" value="<?php echo set_value('wef_date',$challandate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('wef_date');?>
                                        </div>
                                        

                                    <div class="col-12">
                                            <label class="form-label">Payment Terms</label>
                                            <textarea id="payment_terms" name="payment_terms" type="text" class="form-control" placeholder="Payment Terms"><?php echo set_value('payment_terms', $getOtherpo[Payment_terms]); ?></textarea>
                                            
                                        </div>


                                    <div class="col-12">
                                            <label class="form-label">Remark</label>
                                            <textarea id="Remark" name="Remark" type="text" class="form-control" placeholder="Remark" ><?php echo set_value('Remark', $getOtherpo[remarks]); ?></textarea>
                                            
                                        </div>


                                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <?php 
                               
                                if(!empty($getOtherpoDetails))
                                { ?>
                                    <h3>Parts Purchase Order Details Update</h3>(For existing Parts Purchase Order items)
                                    <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th  align="center">Sr.No.</th>
                                    <th>ID</th>
                                    <th>Part Name</th>
                                    <th>Operation Name</th>
                                    <th>Remark</th>
                                    <th>Qty In Nos</th>
                                    <!--<th>Qty in Kgs</th>-->
                                    <th>Rate</th>
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
                                    $editRid=1;
                                    foreach ($getOtherpoDetails as $key => $values) 
                                    {   
                                    $partD =  $this->getQueryModel->getPartsById($values['part_id']);
                                    $OPD=  $this->getQueryModel->getOperation($values['op_id']);
                                    $count1++;
                                     $poDCDetails=$this->getQueryModel->getPoDCDetails($values['id']);
                                     $poSuplSchedule=$this->getQueryModel->getSuplSchedule($values['id']);
                                      
                                     $readonly=" ";
                                     $disabled=" ";
                                     $msg="";
                                     if(!empty($poDCDetails) || !empty($poSuplSchedule)){
                                       // $readonly="readonly";
                                
                                        if(!empty($poDCDetails)) $msg="DC Done";
                                        if(!empty($poSuplSchedule)) $msg="Sup. Sch. Done";
                                     }else{
                                        $msg= '<a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord('.$values['id'].');"><i class="demo-pli-trash fs-5"></i></a>';
                                     }

                                    ?>

                                


                                    <tr>
                                            <input type="hidden" name="OtherPOId[]" value="<?= $values['id']; ?>">
                                    <td align="center">
                                    <?= $count1; ?>
                                    </td>
                                    

                                    <td> <?= $values['id']; ?> </td>
                                    <td> 
                                    <?= $partD['partno']." - ".$partD['name']; ?>
                                    <input type="hidden" id="edit_Part_Id<?=$editRid;?>" name="edit_Part_Id[]" value="<?= $partD['part_id']; ?>">
                                    </td>
                                    <td> 
                                    <?= $OPD['name']; ?>
                                    <input type="hidden" id="edit_Op_Id<?=$editRid;?>" name="edit_Op_Id[]" value="<?= $OPD['id']; ?>">
                                    </td> 
                                    <td>
                                    <input type="text" class="form-control" name="edit_part_remark[]" value="<?= $values['part_remark']; ?>" placeholder="Part Remark" <?php echo $readonly;?>>
                                    </td> 
                                    <td>
                                    <!--<input type="text" class="form-control" id="edit_quantity<?=$editRid;?>" name="edit_quantity[]" value="<?= $values['qty']; ?>" placeholder="Quantity" <?php echo $readonly;?> onkeypress="return isDecimalNumber(event)"   onkeyup="calculateEditQty(this.value,'num',1,'<?=base_url('getPartOperationQty')?>')">-->
                                      <input type="text" class="form-control" id="edit_quantity<?=$editRid;?>" name="edit_quantity[]" value="<?= $values['qty']; ?>" placeholder="Quantity" <?php echo $readonly;?> onkeypress="return isDecimalNumber(event)" >
                                    </td>
                                    <!--<td>-->
                                    <!-- <input type="text" class="form-control" id="edit_qty_in_kgs<?=$editRid;?>" name="edit_qty_in_kgs[]" value="<?= $values['qty_in_kgs']; ?>" placeholder="Quantity" <?php echo $readonly;?> onkeypress="return isDecimalNumber(event)" >-->
                                    <!--</td>-->
                                    <td>
                                    <input type="text" class="form-control" name="edit_rate[]" value="<?= $values['rate']; ?>" placeholder="Rate per piece" <?php echo $readonly;?>>
                                    </td>
                                    <td>
                                    <select id="edit_unit" name="edit_unit[]" class="form-select" <?php echo $readonly;?>>
                                          <option  value="">Choose...</option>
                                          <option value="GMS" <?php if($values['uom']=='GMS'){echo 'selected';} ?>>GMS</option>
                                          <option value="KGS" <?php if($values['uom']=='KGS'){echo 'selected';} ?> >KGS</option>
                                          <option value="NOS" <?php if($values['uom']=='NOS'){echo 'selected';} ?> >NOS</option>
                                          <option value="PKG" <?php if($values['uom']=='PKG'){echo 'selected';} ?>>PER KGS</option>
                                          <option value="PP" <?php if($values['uom']=='PP'){echo 'selected';} ?> >PER PIECE</option>
                                       </select>
                                    </td>
                                    <td class="plan_req_qty">
                                    <input type="text" class="form-control" value="<?= $values['igst']; ?>" name="edit_igst[]" placeholder="IGST % " <?php echo $readonly;?>>
                                    </td>
                                    <td class="manual_qtytd">
                                    <input type="text" class="form-control" value="<?= $values['cgst']; ?>" name="edit_cgst[]" placeholder="CGST % " <?php echo $readonly;?>>
                                    </td>
                                    <td class="manual_qtytd">
                                    <input type="text" class="form-control" value="<?= $values['sgst']; ?>" name="edit_sgst[]" placeholder="SGST % " <?php echo $readonly;?>>
                                    </td>
                                   
                                    <td> 
                                    <?php echo $msg;  ?>                                    
                                    </td>

                                    </tr>
                                    <?php 
                                       $editRid++;
                                    } 
                                    ?>
                                    </tbody>
                                    </table>                                 
                                    

                                    <div style="border: 1px dotted #df5645;margin-top: 10px;"></div>

                                    <?php   } ?>


                                    <h3>Parts Purchase Order Details Add</h3>(Add new items)
                                 <div class="row" style="margin-top: 10px;">
                                    
                              
                                       <div class="col-md-3">
                                            <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                            <input type="hidden" id="Part_Id1" name="Part_Id[]" class="form-select Part_Id" value="">
                                           <div class="autocomplete">
                                                  <?php echo set_value('Part_Search[]');?>
                                              <input type="search" id="Part_Search1" name="Part_Search[]" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value,1,'<?=base_url('getPartsBySearch')?>')">   
                                              <?php echo form_error('Part_Search[]');?>
                                              <ul id="searchResult1" class="searchResult"></ul>   
                                           </div>  
                                                
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Operation <label class="mandatory" >*</label></label>
                                              <?php echo set_value('Op_Id[]');?>
                                            <select id="Op_Id1" name="Op_Id[]" class="form-select Op_Id">
                                                <option selected value="">Choose...</option> 
                                            </select>
                                            <?php echo form_error('Op_Id[]');?>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Part Remark ( ± )</label>
                                            <input id="part_remark" name="part_remark[]"  type="text" class="form-control" placeholder="Part Remark" >
                                        </div>

                                         <div class="col-md-3">
                                            <label class="form-label">Qty In Nos<label class="mandatory">*</label></label>
                                            <!--<input id="quantity1" name="quantity[]"  type="text" class="form-control" placeholder="Quantity" onkeypress="return isDecimalNumber(event)"   onkeyup="calculateQty(this.value,'num',1,'<?=base_url('getPartOperationQty')?>')">-->
                                             <?php echo set_value('quantity[]');?>
                                             <input id="quantity1" name="quantity[]"  type="text" class="form-control" placeholder="Quantity" onkeypress="return isDecimalNumber(event)">
                                            <?php echo form_error('quantity[]');?>
                                            </div>

                                         <!--<div class="col-md-2">-->
                                         <!--   <label class="form-label">Qty in kgs <label class="mandatory">*</label></label>-->
                                         <!--     <input id="qty_in_kgs1" name="qty_in_kgs[]"  type="text" class="form-control" placeholder="Quantity" onkeypress="return isDecimalNumber(event)">-->
                                         <!--   </div>-->

                                

                                         
                                         <div class="col-md-2">
                                            <label class="form-label">Rate<label class="mandatory">*</label></label>
                                              <?php echo set_value('rate[]');?>
                                            <input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="">
                                        <?php echo form_error('rate[]');?>
                                        </div>
                                        <div class="col-md-2">
                                            <label  class="form-label">Unit<label class="mandatory">*</label></label>
                                                <?php echo set_value('Unit[]');?>
                                        <select id="Unit" name="Unit[]" class="form-select">
                                          <option  value="">Choose...</option>
                                          <option value="GMS">GMS</option>
                                          <option value="KGS" selected>KGS</option>
                                          <option value="NOS">NOS</option>
                                          <option value="PKG">PER KGS</option>
                                          <option value="PP">PER PIECE</option>
                                       </select>
                                           <?php echo form_error('Unit[]');?>
                                    </div>

                                 <div class="col-md-2">
                                            <label class="form-label">IGST %</label>
                                            <input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">
                                        </div>

                                 <div class="col-md-2">
                                            <label class="form-label">CGST %</label>
                                            <input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">
                                        </div>

                                 <div class="col-md-2">
                                            <label class="form-label">SGST % </label>
                                            <input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">
                                        </div>
                                        <div class="col-md-1" style="margin-top: 30px;text-align: right;">
                                       <a href="javascript:void(0);" onclick="addOrderAccep(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                       </a>
                                    </div>
                                    </div>

                                    <div id="addOrderAccep1" style="width: 99%;"></div>


                                         
                                        <?php if($getOtherpo['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="/OtherPo"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('OtherPo');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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

   <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   
  

    
<script>
$(document).ready(function() 
{

   
    $('#example').DataTable( {
        "paging": false
        
    } );

  
} );



function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Part Po?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteOtherDetails",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
}



function getConsignee(custId)
{
    var custSelId='<?=$getOtherpo['customer_id'];?>';
    $.ajax({
   url:"<?php echo base_url(); ?>getConsignee",
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
        var baseurl=" '<?=base_url()?>getPartsBySearch ' ";   
        var qtybaseurl=" '<?=base_url()?>getPartOperationQty' ";  
         var qtyinkgs=" 'kgs' ";
          var qtyinnum=" 'num' ";
        rowCount ++;
        var recRow = '<span id="rowCount1'+rowCount+'">' +
'<div style="border: 1px dotted #df5645;margin-top: 10px;"></div><div class="row" style="margin-top: 10px;"><div class="col-md-3"><label class="form-label">Part Name <label class="mandatory">*</label></label><input type="hidden" id="Part_Id'+rowCount+'" name="Part_Id[]" class="form-select Part_Id" value=""><div class="autocomplete"><input type="search" id="Part_Search'+rowCount+'" name="Part_Search[]" class="form-control" value="" onkeyup="searchPart(this.value,'+rowCount+','+baseurl+');"><ul id="searchResult'+rowCount+'" class="searchResult"></ul></div></div>'+

'<div class="col-md-3">'+
'<label class="form-label">Operation <label class="mandatory">*</label></label>'+
'<select id="Op_Id'+rowCount+'" name="Op_Id[]" class="form-select Op_Id">'+
'<option selected value="">Choose...</option> '+
'</select>'+
'</div>'+

'<div class="col-md-3">'+
'<label class="form-label">Part Remark ( ± )</label>'+
'<input id="part_remark" name="part_remark[]"  type="text" class="form-control" placeholder="Part Remark" >'+
'</div>'+
                                        
'<div class="col-md-3"><label class="form-label">Qty In Nos<label class="mandatory">*</label></label><input id="quantity'+rowCount+'" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity"></div>'+

'<div class="col-md-2">'+
'<label class="form-label">Rate <label class="mandatory">*</label></label>'+
'<input id="rate" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="">'+
'</div>'+

'<div class="col-md-2">'+
'<label  class="form-label">Unit<label class="mandatory">*</label></label>'+
'<select id="Unit" name="Unit[]" class="form-select">'+
'<option  value="">Choose...</option>'+
'<option value="GMS">GMS</option>'+
'<option value="KGS" selected >KGS</option>'+
'<option value="NOS" >NOS</option>'+
'<option value="PKG" >PER KGS</option>'+
'<option value="PP" >PER PIECE</option>'+
'</select>'+
'</div>'+

'<div class="col-md-2">'+
'<label class="form-label">IGST %</label>'+
'<input id="igst" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="">'+
'</div>'+

'<div class="col-md-2">'+
'<label class="form-label">CGST %</label>'+
'<input id="cgst" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="">'+
'</div>'+

'<div class="col-md-2">'+
'<label class="form-label">SGST %</label>'+
'<input id="sgst" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="">'+
'</div><div class="col-md-1" style="margin-top: 25px;text-align:right;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
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
function getOpByPartId(Part_Id,nums)
{
    //alert(Part_Id);
    var Supplier_Id =$("#Supplier_Id").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getOpByPartId",
      method:"POST",
      data:{Part_Id:Part_Id,Supplier_Id:Supplier_Id},
      success:function(result)
      {
      console.log(result);
      $("#Op_Id"+nums).html(result);
      }
      }); 
}
</script>
</body>

</html>