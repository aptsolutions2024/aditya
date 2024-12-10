<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>OB Delivery Challan | Aditya</title>

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
    <style>
        .hideContent{
            display:none;
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
                             <li class="breadcrumb-item active"><a href="<?php echo base_url('viewOBDeliveryC');?>">Delivery Challan Opening Bal.</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">  <?php  echo ($getDCMastById['id']=='')?"Add Delivery Challan Opening Bal - ". $_SESSION['branch_name']:"Update Delivery Challan Opening Bal - ". $_SESSION['branch_name'];?>
                    
                    </h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                        <!-- Block styled form -->
                                        <?php  if($getDCMastById['id']==''){ 
                                            //$readonly='';
                                        ?>
                                        <?php echo form_open('/createDCOB', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { //$readonly='disabled'; ?>
                                        <?php echo form_open('/updateDCOB', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getDCMastById['id'];?>">
                                    <?php } ?>

                                        <div class="col-md-4">
                                            <label class="form-label">Supplier Name <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Supplier_Id'); ?>
                                            <?php if($getDCMastById['id']!=''){ ?>
                                            <input type="hidden" name="Supplier_Id" value="<?=$getDCMastById['supplier_id']?>">
                                            <?php } ?>
                                            <select id="Supplier_Id" name="Supplier_Id" class="form-select alltxtUpperCase" onchange="getConsignee(this.value);" <?php if($getDCMastById['id']!='') echo "disabled";?> >
                                                
                                                <option value="">Choose...</option> 
                                                
                                                <?php $selectedS = $getDCMastById['supplier_id']; foreach($getSupplier as $row){ ?>     
                                                <option value="<?=$row['id'];?>" <?php if($selectedS==$row['id']){ echo "selected";} ?> <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Supplier_Id');?>
                                        </div>

                                         <div class="col-3">
                                            <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                              <?php $seldate=($getDCMastById['id'])?$getDCMastById['date']:date('Y-m-d'); ?>
                                            <input id="Other_date" name="Other_date" type="date" class="form-control" placeholder="Part No." value="<?php echo set_value('Other_date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('Other_date');?>
                                        </div>

                                        

                                    <div class="col-3">
                                            <label class="form-label">Challan No. <label class="mandatory">*</label></label>
                                            <input id="dc_no" name="dc_no" type="text" class="form-control" placeholder="Delivery Challan No." value="<?php echo set_value('dc_no', $getDCMastById[id]); ?>" readonly>
                                            <?php echo form_error('dc_no');?>
                                        </div>
                                        
                                    <div class="col-3 hideContent" >
                                            <label class="form-label">Vehicle No. <label class="mandatory">*</label></label>
                                            <input id="vehicle_no" name="vehicle_no" type="text" class="form-control" placeholder="Vehicle No." value="<?php echo set_value('vehicle_no', $getDCMastById[vehicle_no]); ?>">
                                            <?php echo form_error('vehicle_no');?>
                                        </div>
                                    <div class="col-3 hideContent">
                                            <label class="form-label">Transporter Name <label class="mandatory">*</label></label>
                                            <input id="transporter_name" name="transporter_name" type="text" class="form-control" placeholder="Transporter Name" value="<?php echo set_value('dc_no', $getDCMastById[transporter_name]); ?>">
                                            <?php echo form_error('transporter_name');?>
                                        </div>

                                    <div class="col-9">
                                            <label class="form-label">Remark</label>
                                            <input id="Remark" name="Remark" type="text" class="form-control" placeholder="Remark" value="Opening Balance As On December-2023" readonly>
                                            
                                   </div>


                                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <?php 
                                 
                                if(!empty($getDCDetails))
                                { ?>
                                    <h3>Parts Delivery Challan Details Update</h3>(For existing Parts Purchase Order items)
                                    <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th  align="center">Sr.No.</th>
                                    <th>ID</th>
                                    <th>Part Name</th>
                                    <th>Operation Name</th>
                                    <th>QTY in Nos</th>
                                    <th>QTY in Kgs</th>
                                  
                                    <!--<th>Max Qty</th>-->
                                    
                                    <th>Action</th>
                                    
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php 

                                    $count1=0;
                                    $i=0;
                               
                                    foreach ($getDCDetails as $key => $values) 
                                    {   
                                    $partD =  $this->getQueryModel->getPartsById($values['part_id']);
                                    $OPD=  $this->getQueryModel->getOperation($values['op_id']);
                                    $count1++;
                                    $msg = "";
                                    $readonly="";
                                      $dcRcirDetails=$this->getQueryModel->getDcRCIRDetails($values['id']);                                  
                                       if(empty($dcRcirDetails)){
                                   
                                        $msg = '<a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                    onclick="deleteRecord('.$values['id'].');"><i class="demo-pli-trash fs-5"></i></a>';

                                       }else{
                                        $readonly="readonly";
                                        $msg = "RCIR Done.";
                                       }
                                    ?>

                                    <input type="hidden" name="DCDID[]" value="<?=$values['id']; ?>" >


                                    <tr>
                                    <td align="center">
                                    <?= $count1; ?>
                                    </td>
                                    

                                    <td> <?= $values['id']; ?> </td>
                                    <td> 
                                    <?= $partD['partno'] .'-'.$partD['name']; ?>
                                    <input type="hidden" id="edit_Part_Id<?=$values['id'];?>" name="edit_Part_Id[]" value="<?= $partD['part_id']; ?>">
                                    </td>
                                    <td> 
                                    <?= $OPD['name']; ?>
                                    <input type="hidden" id="edit_Op_Id<?=$values['id'];?>" name="edit_Op_Id[]" value="<?= $OPD['id']; ?>">
                                    </td>
                                     <td>
                                    <input type="text" class="form-control" name="edit_quantity[]" id="edit_quantity<?=$values['id'];?>" value="<?= $values['qty']; ?>" placeholder="Quantity" style="width: 100px;" onInput="editcheckQty(<?=$values['id'];?>)" onkeyup="calculateEditQty(this.value,'num',<?=$values['id'];?>,'<?=base_url('getPartOperationQty')?>')"  readonly>
                                    <div id="editqtyExit<?=$values['id'];?>" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
                                    </td>
                                    <td>
                                    <input type="text" class="form-control" name="edit_qty_in_kgs[]" id="edit_qty_in_kgs<?=$values['id'];?>" value="<?= $values['qty_in_kgs']; ?>" placeholder="Quantity" style="width: 100px;"  onkeyup="calculateEditQty(this.value,'kgs',<?=$values['id'];?>,'<?=base_url('getPartOperationQty')?>')" readonly>
                                    </td>
                                   
                                    <!--<td> -->
                                    <!--<?= $values['max_qty']; ?>-->
                                    <!--<input type="hidden" name="edit_max_qty[]" id="edit_max_qty<?=$values['id'];?>" value="<?= $values['max_qty']; ?>">-->
                                    <!--</td> -->
                                    
                                    <td > 
                                    <?php  echo $msg;  ?>
                                    </td>

                                    </tr>
                                    <?php 

                                    } 
                                    ?>
                                    </tbody>
                                    </table>


                                    

                                    <div style="border: 1px dotted #df5645;margin-top: 10px;"></div>

                                    <?php   } ?>


                                    <h3>Parts Delivery Challan Details Add</h3>(Add new items)
                                    
                                    <?php 
                                if(!empty($_SESSION['dcmsg']))
                                { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['dcmsg'];?></div>

                                 <?php 
                                }
                                ?>
                        <div class="row" style="margin-top: 10px;" id="other">
                            <input type="hidden" id="parts_po_det_id1" name="parts_po_det_id[]" value="">
                        

                            <div class="col-md-3">
                                <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                <input type="hidden" id="Part_Id1" name="Part_Id[]" class="form-select Part_Id" value="">
                                <div class="autocomplete">
                                <input type="search" id="Part_Search1" name="Part_Search[]" class="form-control" value="" onkeyup="searchPart(this.value,1,'<?=base_url('getPartsBySearch')?>')">   
                                <ul id="searchResult1" class="searchResult"></ul>   
                                </div>  
                            </div>
                        
                            <div class="col-md-3">
                                <label class="form-label">Operation <label class="mandatory">*</label></label>
                                <select id="Op_Id1" name="Op_Id[]" class="form-select Op_Id" onChange="getPoRateDetails(1);">
                                <option selected value="">Choose...</option> 
                                </select>
                            </div>
                             <div class="col-md-2">
                                <label class="form-label">Qty in Nos <label class="mandatory">*</label></label>
                                <input id="quantity1" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty in No"  onkeyup="calculateQty(this.value,'num',1,'<?=base_url('getPartOperationQty')?>')">
                            <div id="qtyExit1" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Invalid Qty</div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Qty In kgs <label class="mandatory">*</label></label>
                                <input id="qty_in_kgs1" name="qty_in_kgs[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs"  onkeyup="calculateQty(this.value,'kgs',1,'<?=base_url('getPartOperationQty')?>')">
                            </div> 
     
                            <span class="hideContent">
                             <div class="col-md-1">
                                <label class="form-label">Nos/Kg<label class="mandatory">*</label></label>
                                <input id="part_qty_no1" type="text" class="form-control" readonly>
                            </div> 
                            
                            <div class="col-md-2">
                                <label class="form-label">Max Qty <label class="mandatory">*</label></label>
                                <input id="max_qty1" name="max_qty[]" type="text" class="form-control" value="" placeholder="Max Qty" readonly>
                            </div> 
                            <div class="col-md-4">
                                <label class="form-label">Part Remark <label class="mandatory"></label></label>
                                <input id="part_remark1" name="part_remark[]"  type="text" class="form-control" placeholder="Part Remark" >
                            </div>
                            
                            <div class="col-md-2">
                                <label class="form-label">Rate<label class="mandatory">*</label></label>
                                <input id="rate1" name="rate[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Rate" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label  class="form-label">Unit<label class="mandatory">*</label></label>
                                <input type="text" id="Unit1" name="Unit[]" class="form-control" placeholder="Unit" readonly>
                            </div>
                        
                            <div class="col-md-1">
                                <label class="form-label">IGST %</label>
                                <input id="igst1" name="igst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="IGST" value="" readonly>
                            </div>
                            
                            <div class="col-md-1">
                                <label class="form-label">CGST %</label>
                                <input id="cgst1" name="cgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="CGST" value="" readonly>
                            </div>
                        
                            <div class="col-md-1">
                                <label class="form-label">SGST % </label>
                                <input id="sgst1" name="sgst[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="SGST" value="" readonly>
                            </div>
                            </span>
                            <div class="col-md-1" style="margin-top: 30px;text-align: right;">
                                <a href="javascript:void(0);" onclick="addOrderAccep(this.form);" >
                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                </a>
                            </div>
                        </div>
                        
                        <div id="addOrderAccep1" style="width: 99%;"></div>
                        
                        
                        <!----------------------------Normal Challan Type------------------------------->
                        
                        <div class="row" style="margin-top: 10px;display:none;" id="normal">
                        
                            <div class="col-md-2" style="margin-bottom: 10px;">
                                <label class="form-label">Product Family Name <label class="mandatory">*</label></label>
                                <select id="prod_family" name="prod_family[]" class="form-select" onchange="getNPartsByProdFamily(this.value,1);">
                                <option  value="">Choose...</option>
                                <?php foreach($getProdfamily as $prodf){ ?>
                                <option  value="<?=$prodf['id'];?>" <?php if($pf==$prodf['id']){echo "selected";} ?> <?php if($getparts['prodfamily_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                <?php } ?>
                                </select>
                                <?php echo form_error('prod_family');?>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                <select id="NPart_Id1" name="NPart_Id[]" class="form-select Part_Id" onchange="getNOpByPartId(this.value,1);">
                                <option selected value="">Choose...</option> 
                                </select>
                            </div>
                        
                            <div class="col-md-3">
                                <label class="form-label">Operation <label class="mandatory">*</label></label>
                                <select id="NOp_Id1" name="NOp_Id[]" class="form-select Op_Id">
                                <option selected value="">Choose...</option> 
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="form-label">Quantity <label class="mandatory">*</label></label>
                                <input id="Nquantity" name="Nquantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity" >
                            </div> 
                            
                        
                            <div class="col-md-1" style="margin-top: 30px;text-align: right;">
                                <a href="javascript:void(0);" onclick="addNOrderAccep(this.form);" >
                                <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                </a>
                            </div>
                        </div>
                        
                        <div id="addNOrderAccep1" style="width: 99%;"></div>


                                         
                                        <?php if($getDCMastById['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="<?php echo base_url('viewOBDeliveryC');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('viewOBDeliveryC');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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

    <!--<script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">
    
<script>
$(document).ready(function() 
{
   
    $('#example').DataTable( {
        "paging": false
        
    } );

  
} );

function searchPart(searchval,rowid,baseurl){  
    if($('select#Supplier_Id').val()==""){
       alert("Select supplier first"); 
       $('select#Supplier_Id').focus()
        $("#Part_Search"+rowid).val('');
       return false;
    }
 
 $("#Part_Id"+rowid).val(''); 
  $("#part_qty_no"+rowid).val(''); 
     $("#qty_in_kgs"+rowid).val('');$("#quantity"+rowid).val('');  
 
          var search=searchval;
        if(search != ""){

            $.ajax({
                url: baseurl,
                type: 'post',
                data: {search:search},
                success:function(response){ 
                //console.log(response);
                   $("#searchResult"+rowid).empty();
                   $("#searchResult"+rowid).append(response);                   

                    // binding click event to li
                    $("#searchResult"+rowid+" li").bind("click",function(){
                        setText(this,rowid);
                    });

                }
            });
        }
}
function setText(element,rowid){
    var value = $(element).text();
    var partid = $(element).val();
    if(partid==0){
    $("#Part_Id"+rowid).val("");
    }else if(partid>0){     
           $("#Part_Id"+rowid).val(partid);
    }

    $("#Part_Search"+rowid).val(value);
   
    $("#searchResult"+rowid).empty();
    if(rowid!="Only"){getOpByPartId( partid , rowid )};
}
function calculateQty(current_qty,type,rowid,baseurl){
var Part_Id=$("#Part_Id"+rowid).val();
var Op_Id=$("#Op_Id"+rowid).val();
  $('#part_qty_no'+rowid).val('');
    if(type == 'num'){
          $("#qty_in_kgs"+rowid).val('');
    }else{
        $("#quantity"+rowid).val(''); 
    }
       $('#part_qty_no'+rowid).val('');
//alert("Type :: "+type);
    if(current_qty!=''){
         $.ajax({
           url:baseurl,
           method:"POST",
           data:{Part_Id:Part_Id,Op_Id:Op_Id},
           success:function(result)
           {
            console.log("Op_Id:"+Op_Id+" Part_Id:"+Part_Id +"  Part QTY:-"+result);
                   var part_operation_qty=result;  
                      if(part_operation_qty == '' || part_operation_qty == '0'){
                         part_operation_qty=1;   
                        }
                    $('#part_qty_no'+rowid).val(part_operation_qty);
                    if(part_operation_qty){
                       
                      
                        if(type == 'num'){
                           
                            //Show kgs per quantity
                             var kgs = (current_qty/part_operation_qty);
                            $("#qty_in_kgs"+rowid).val(kgs.toFixed(2)); 
                          // checkQty(rowid,current_qty); 
                        }else{ 
                         
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=(part_operation_qty*current_qty);      
                            $("#quantity"+rowid).val(Math.round(quantity)); 
                              //checkQty(rowid,quantity); 
                           }
                          
                        }
                          
                    }else{
                       $("#qty_in_kgs"+rowid).val('');$("#quantity"+rowid).val('');                          
                    }
           

           }
           });
    }
}
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Part DC?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteDCDetails",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
 return false;
}






var rowCount = 1;
    function addOrderAccep(frm) {
        rowCount ++;
        var baseurl=" '<?=base_url()?>getPartsBySearch ' ";  
        var qtybaseurl=" '<?=base_url()?>getPartOperationQty' ";  
        var qtyinkgs=" 'kgs' ";
        var qtyinnum=" 'num' ";
        var recRow = '<input type="hidden" id="parts_po_det_id'+rowCount+'" name="parts_po_det_id[]" value=""> <span id="rowCount1'+rowCount+'">' +
'<div style="border: 1px dotted #df5645;margin-top: 10px;"></div><div class="row" style="margin-top: 10px;">'+

'<div class="col-md-3"><label class="form-label">Part Name <label class="mandatory">*</label></label><input type="hidden" id="Part_Id'+rowCount+'" name="Part_Id[]" class="form-select Part_Id" value=""><div class="autocomplete"><input type="search" id="Part_Search'+rowCount+'" name="Part_Search[]" class="form-control" value="" onkeyup="searchPart(this.value,'+rowCount+','+baseurl+');"><ul id="searchResult'+rowCount+'" class="searchResult"></ul></div></div>'+

'<div class="col-md-3">'+
'<label class="form-label">Operation <label class="mandatory">*</label></label>'+
'<select id="Op_Id'+rowCount+'" name="Op_Id[]" class="form-select Op_Id" onChange="getPoRateDetails('+rowCount+');">'+
'<option selected value="">Choose...</option> '+
'</select>'+
'</div>'+
'<div class="col-md-2">'+
'<label class="form-label">Qty in Nos <label class="mandatory">*</label></label><input id="quantity'+rowCount+'" name="quantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty in nos" onkeyup="calculateQty(this.value,'+qtyinnum+','+rowCount+','+qtybaseurl+')"><div id="qtyExit'+rowCount+'" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Invalid Qty</div></div>'+

 '<div class="col-md-1">'+
 '<label class="form-label">Qty In kgs <label class="mandatory">*</label></label>'+
 '<input id="qty_in_kgs'+rowCount+'" name="qty_in_kgs[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs"  onkeyup="calculateQty(this.value,'+qtyinkgs+','+rowCount+','+qtybaseurl+')">'+
'</div>'+
'<div class="col-md-1" style="margin-top: 25px;text-align:right;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>';
        jQuery('#addOrderAccep1').append(recRow);
        
    }
    function removeRow1(removeNum) {
    jQuery('#rowCount1'+removeNum).remove();
    rowCount --;
    }
/*function getPartsByProdFamily(Prod_Family_Id,nums)
{
    valempty(nums);
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
}*/
function getOpByPartId(Part_Id,nums)
{
  //  alert("Part_Id-"+Part_Id);
    $("#part_remark"+nums).val('');
    $("#rate"+nums).val('');
    $("#Unit"+nums).val('');
    $("#igst"+nums).val('');
    $("#cgst"+nums).val('');
    $("#sgst"+nums).val(''); 
    //valempty(nums);
    var Supplier_Id =$("#Supplier_Id").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getDCOpByPartId",
      method:"POST",
      data:{Part_Id:Part_Id,Supplier_Id:Supplier_Id},
      success:function(result)
          {
            //alert(result);
             console.log(result);
          $("#Op_Id"+nums).html(result);
          }
      }); 
}

/*---------------------------------Normal Challan ------------------------*/

function getNPartsByProdFamily(Prod_Family_Id,nums)
{
    
    var custId=$("#Customer_Id").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getPartsByProdFamily",
      method:"POST",
      data:{Prod_Family_Id:Prod_Family_Id},
      success:function(result)
      {
      $("#NPart_Id"+nums).html(result);
      }
      }); 
}
function getNOpByPartId(Part_Id,nums)
{
    $("#part_remark"+nums).val('');
    $("#rate"+nums).val('');
    $("#Unit"+nums).val('');
    $("#igst"+nums).val('');
    $("#cgst"+nums).val('');
    $("#sgst"+nums).val('');
    
    var Supplier_Id =$("#Supplier_Id").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getDCOpByPartId",
      method:"POST",
      data:{Part_Id:Part_Id,Supplier_Id:Supplier_Id},
      success:function(result)
      {
         //alert(result);
      $("#NOp_Id"+nums).html(result);
      }
      }); 
}
function getPoRateDetails(cnt)
{
    var Supplier_Id =$("#Supplier_Id").val();
    var Part_Id     =$("#Part_Id"+cnt).val();
    var Op_Id       =$("#Op_Id"+cnt).val();
    //var dataId      = $(this).attr("data-id");
    //alert(dataId);
    $.ajax({
      url:"<?php echo base_url(); ?>getPoRateDetails",
      type:"POST",
     dataType:"json",
      data:{Part_Id:Part_Id,Op_Id:Op_Id,Supplier_Id:Supplier_Id},
      success:function(result)
      {
          console.log(result);
         // alert(result);
          $("#parts_po_det_id"+cnt).val(result.id);
          $("#part_remark"+cnt).val(result.part_remark);
          $("#rate"+cnt).val(result.rate);
          $("#Unit"+cnt).val(result.uom);
          $("#igst"+cnt).val(result.igst);
          $("#cgst"+cnt).val(result.cgst);
          $("#sgst"+cnt).val(result.sgst);
          $("#max_qty"+cnt).val(result.max_qty);
         //alert(result);
      //$("#NOp_Id"+nums).html(result);
      }
      }); 
}

function valempty(nums)
{
    $("#Part_Id"+nums).val('');
    $("#Op_Id"+nums).val('');
    $("#part_remark"+nums).val('');
    $("#rate"+nums).val('');
    $("#Unit"+nums).val('');
    $("#igst"+nums).val('');
    $("#cgst"+nums).val('');
    $("#sgst"+nums).val('');
}

var rowCount = 1;
function addNOrderAccep(frm) {
rowCount ++;
var recRow = '<span id="rowCount1'+rowCount+'">' +
'<div style="border: 1px dotted #df5645;margin-top: 10px;"></div><div class="row" style="margin-top: 10px;"><div class="col-md-2" style="margin-bottom: 10px;"><label class="form-label">Product Family Name <label class="mandatory">*</label></label><select id="prod_family" name="prod_family[]" class="form-select" onchange="getNPartsByProdFamily(this.value,'+rowCount+');"><option  value="">Choose...</option><?php foreach($getProdfamily as $prodf){ ?><option  value="<?=$prodf['id'];?>" <?php if($pf==$prodf['id']){echo "selected";} ?> <?php if($getparts['prodfamily_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option><?php } ?></select> </div>'+

'<div class="col-md-3"><label class="form-label">Part Name <label class="mandatory">*</label></label><select id="NPart_Id'+rowCount+'" name="NPart_Id[]" class="form-select" onchange="getNOpByPartId(this.value,'+rowCount+');"><option selected value="">Choose...</option></select></div>'+

'<div class="col-md-3">'+
'<label class="form-label">Operation <label class="mandatory">*</label></label>'+
'<select id="NOp_Id'+rowCount+'" name="NOp_Id[]" class="form-select Op_Id">'+
'<option selected value="">Choose...</option> '+
'</select>'+
'</div>'+

'<div class="col-md-2">'+
'<label class="form-label">Quantity <label class="mandatory">*</label></label><input id="Nquantity" name="Nquantity[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Quantity"></div>'+

'<div class="col-md-1" style="margin-top: 25px;text-align:right;"><a href="javascript:void(0);" onclick="removeNRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div></div>'
;
jQuery('#addNOrderAccep1').append(recRow);

}
function removeNRow1(removeNum) {
jQuery('#rowCount1'+removeNum).remove();
rowCount --;
}

function getChallanType(type)
{
    /*if(type==1)
    {
        $("#normal").hide();
        $("#other").show();
    }else
    {
        $("#normal").show();
        $("#other").hide();
    }*/
}
function getQtyByKG(nums)
{
	var Part_Id = parseInt($("#Part_Id"+nums).val());
	var qty_in_kgs = parseInt($("#qty_in_kgs"+nums).val());
	
	//$("#quantity"+nums).attr('readonly', 'false');
	
	if(qty_in_kgs != 0)
	{
	    
	   $("#quantity"+nums).prop('readonly', true);
	$.ajax({
      url:"<?php echo base_url(); ?>getQtyByKG",
      method:"POST",
      data:{Part_Id:Part_Id,qty_in_kgs:qty_in_kgs},
      success:function(result)
      {
        checkQty(nums,result);
      $("#quantity"+nums).val(result);
      }
      });
	}else
	{ 
	  //  $("#quantity"+nums).val('');
	    $("#quantity"+nums).prop('readonly', false);
	}
	
       
}
/*function checkQty(nums,quantity)
{
	//var quantity = parseInt($("#quantity"+nums).val());
	var max_qty = parseInt($("#max_qty"+nums).val());
	
	
    if(max_qty < quantity)
    {
        $("#qtyExit"+nums).show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#qtyExit"+nums).hide();
    }
       
}
function editcheckQty(nums)
{

	var quantity    = parseInt($("#edit_quantity"+nums).val());
	var max_qty     = parseInt($("#edit_max_qty"+nums).val());
	
	
    if(max_qty < quantity)
    {
        $("#editqtyExit"+nums).show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#editqtyExit"+nums).hide();
    }
       
}*/
</script>
</body>

</html>