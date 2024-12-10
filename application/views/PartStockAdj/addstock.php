<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Part STock Adjustment</title>

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
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/buttons.dataTables.min.css">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">

    <style type="text/css">
      .visible {
  height: 3em;
  width: 10em;
  background: yellow;
}
.form-check-input {
    width: 2em;
    height: 2em;
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
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>PartsStkAdjustment">Part Stock Adjustment</a></li>
                            
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    <p class="lead">
                    </p>

                </div>

            </div>
 
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card mb-3">
                        <div class="card-body">
                            <?php error_reporting(0); if($_SESSION['createC']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createC'];?>
                                        </div>
                                    <?php } ?>
                                    
                           
                             <div class="row">
                                 
                            <h2 style="width: 87%;">PART STOCK ADJUSTMENT - <?=$_SESSION['branch_name']; ?></h2>
                            </div>
                              <div class="row">
                                <?php echo form_open('/addPartStkAdjustment', array('autocomplete' => 'off','class' => 'row g-3')); ?>   
                                  
                                   <div class="col-md-2">
                                       <label class="form-label">On Date<label class="mandatory">*</label></label>
                                       <?php $to_date=set_value('to_date'); ?>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo $to_date; ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('to_date');?>
                                    </div>
                                   <div class="col-md-3">
                                        <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                         <?php $pId= set_value('Part_Id');  $pname= set_value('Part_Search');?>
                                        <input type="hidden" id="Part_IdOnly" name="Part_Id" class="form-select Part_Id" value="<?=$pId;?>">
                                           <div class="autocomplete">
                                              <input type="search" id="Part_SearchOnly" name="Part_Search" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value,'Only','<?=base_url('getPartsBySearch')?>')">   
                                              <ul id="searchResultOnly" class="searchResult"></ul>   
                                           </div>  
                                            <?php echo form_error('Part_Search');?>  
                                          <?php echo form_error('Part_Id');?>  
                                    </div>
                                    <div class="col-md-2">
                                         <label class="form-label">Select Type<label class="mandatory">*</label></label>
                                        <?php $bstype= set_value('bstype');?>
                                         <select id="bstype" name="bstype" class="form-select">
                                             <option value="">Select Type</option>
                                                <option value="B"  <?php if($bstype=='B'){ echo 'selected';};?> >Branch</option>
                                                <option value="S"  <?php if($bstype=='S'){ echo 'selected';};?> >Supplier</option>
                                        </select>
                                          <?php echo form_error('bstype');?>  
                                    </div>
                                    <div class="col-md-2" style="display:<?=($bstype=='B')?'block':'none';?>" id="selbranchdiv">
                                         <label class="form-label">Branch</label>
                                        <?php $brid= set_value('branch_id');?>
                                         <select id="branch_id" name="branch_id" class="form-select">
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($branch['id']==$brid){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>
                                        </select>
                                          <?php echo form_error('branch_id');?>  
                                    </div>
                                    <div class="col-md-1" style="margin-top: auto;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                    </div>
                                    
                             
                       </form>
                       </div>
                        <div class="row" style="padding: 20px 0;">
                                                                     <p style="color:red;">Negative Stock Adjustment At Supplier Location Should be Done Through Inprocess Loss Qty(DC-RCIR).</p>
                                  <p  style="color:red;text-transform:capitalize;">To reduce the stock in the system, please enter negative(-) adjustment quantity.
                                        <br>To increase the stock in the system, please enter positive(+) adjustment quantity. </p>
                                     </div>
                <div class="row" style="overflow : auto;">
                  
                <?php echo form_open('/updatePartsStkAdj', array('onsubmit' => 'return checkPlanning()')); ?>
                        <table id="example" class="display dt-responsive overflow-auto table table-striped adjQtyBody" style="width:100%;text-transform:uppercase;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sr.No.</th>
                                    <th>Part Name</th>
                                    <th>Branch/Supplier</th>
                                    <th>Operation</th>
                                    <th>Current Qty</th>
                                    <th>Adjustment Qty</th>
                                    <th>Final Quantity</th>
                                  
                                </tr>
                            </thead>
                          
                            <tbody>
                             <?php 
                             $count=0;
                                  //echo "<pre>"; print_r($getPartOpDet);echo "</pre>";
                            $PartD = $this->getQueryModel->getPartsById($pId);
                             foreach ($getPartOpDet as $key => $value) 
                             { 
                              $i=0;
                                  $qtyRes = $this->getQueryModel->getTranPartAdjQty($pId,$value['op_id'],$value['id'],$value['type'],$to_date);
                                  if(!empty($qtyRes['id'])){
                                      
                                       $res = $this->getQueryModel->getTranPartAdjUsedQty($value['type'],$qtyRes['id']);
                                      // echo "Count:".$res."  ID-".$qtyRes['id'];
                                       $i=$res;
                                  }
                                  
                            if($i<=1){
                               // $count++;                             
                                ?>
                                 
                                <tr>
                                    <td>
                                        <input type="hidden" name="partid"  class="form-select" value="<?=$pId;?>">
                                        <input type="hidden" name="date"    class="form-control" value="<?=$to_date;?>">
                                        
                                        <input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?=$count;?>" >
                                        <input type="hidden" name="type[]"  value="<?=$value['type'];?>" >
                                        <input type="hidden" name="op_id[]" value="<?=$value['op_id'];?>">
                                        <input type="hidden" name="bsid[]" value="<?=$value['id'];?>">
                                        <input type="hidden" name="parts_po_det_id[]" value="<?=$value['parts_po_det_id'];?>">
                                        
                                    </td>
                                    <td><?php  $count++; 
                                        echo $count; 
                                        ?>
                                    </td>
                                    <td><?php echo $PartD['partno']." - ".$PartD['name'];?></td>
                                    <td>
                                      <?php 
                                      if($value['type']=="B"){
                                          $branchD =  $this->getQueryModel->getBranchbyId($value['id']);
                                          echo $branchD['name'];
                                      }elseif($value['type']=="S"){
                                           $supplierD=  $this->getQueryModel->getSupplierById($value['id']);
                                            echo $supplierD['name']; 
                                      }
                                      ?>
                                    </td>
                                   <td><!--  Operation Name -->
                                   <?php 
                                         $operD=$this->getQueryModel->getOperation($value['op_id']);
                                        echo $value['sequence_no']." - ".$operD['name']; ?>
                                   </td>  
                                   <td><!--  Operation Name -->
                                    <?php 
                                    
                                      $resCurrQty = $this->getQueryModel->getTranPartStkAdjCurrQty($pId,$value['op_id'],$value['type'],$value['id'],$to_date);
                                      
                                   ?>
                                     <input type="text"  class="form-control" id="current_qty<?= $count; ?>" name="current_qty[]" style="width: 100px;" value="<?=($resCurrQty);?>" readonly>
                                   </td>
                                   <td> <!--  Adjustment qty --> 
                                      <input type="text"    onkeyup="calculateQty(this.value,<?=$count;?>)" class="form-control" id="qty<?= $count; ?>" name="qty[]" style="width: 100px;" value="" >
                                  </td>
                                  <td> <!--  Final qty --> 
                                      <input type="text"   class="form-control" id="final_qty<?= $count; ?>" name="final_qty[]" style="width: 100px;" value="<?=($resCurrQty);?>" readonly>
                                  </td>
                               
                               
                                </tr>
                                <tr>
                                   <td>Remark</td>
                                   <td colspan="7"> <!--  Remarks --> 
                                     <input type="text"   class="form-control" id="remarks<?= $count; ?>" name="remarks[]" value="<?=$qtyRes['remarks'];?>">
                                  </td>
                                  </tr>
                    <?php }else{ ?>
                         <tr>
                                   <td></td>
                                   <td> </td>
                                    <td><?php echo $PartD['partno']." - ".$PartD['name'];?></td>
                                    <td>
                                      <?php 
                                      if($value['type']=="B"){
                                          $branchD =  $this->getQueryModel->getBranchbyId($value['id']);
                                          echo $branchD['name'];
                                      }elseif($value['type']=="S"){
                                           $supplierD=  $this->getQueryModel->getSupplierById($value['id']);
                                            echo $supplierD['name']; 
                                      }
                                      ?>
                                    </td>
                                   <td><!--  Operation Name -->
                                   <?php 
                                         $operD=$this->getQueryModel->getOperation($value['op_id']);
                                        echo $value['sequence_no']." - ".$operD['name']; ?>
                                   </td> 
                                   
                                   <td colspan='3' style="color:#d31435;"> <?php echo $qtyRes['qty'];?> - Quantity Already Used.Cannot be edited. </td>
                                  </tr>
                                   <tr>
                                   <td>Remark</td>
                                   <td colspan="7"> <!--  Remarks --> 
                                     <input type="text"   class="form-control"  value="<?=$qtyRes['remarks'];?>" readonly>
                                  </td>
                                  </tr>
                   <? } 
                    
                    
                    } ?>
                            </tbody>
                        </table>
        <!-- <hr> -->
                <div class="col-12" align="center">
                    <!--<button type="submit" class="btn btn-primary Update">Update</button>-->
                    <button type="button" id="btnCloseCustomer" onclick="CloseRmreq();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> 
        </form>
        </div>
    </div>
</div>
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

   
    <!-- Initialize [ SAMPLE ] -->
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script>
        <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 

<script>
$(document).ready(function() {
    
    $("select#bstype").change(function(){
     
        $("table.adjQtyBody tbody").empty();
       if(this.value=='S'){
           $('#selbranchdiv').hide();
       }else if(this.value=='B'){
           $('#selbranchdiv').show(); 
       }
   });

});
function calculateQty(value,rowid){
    var current_qty=parseInt(($("#current_qty"+rowid).val())?$("#current_qty"+rowid).val():0);
    var adj_qty=parseInt(($("#qty"+rowid).val())?$("#qty"+rowid).val():0);
    var final_qty=parseInt((current_qty+adj_qty));
    $("#final_qty"+rowid).val(final_qty);
   // console.log("current_qty-"+current_qty+"  adj_qty-"+adj_qty+" final_qty-"+final_qty);
    
}
function calculatePartQty(current_qty,type,rowid,Op_Id){
    
     var Part_Id=$(".Part_Id").val();
     var date=$("#to_date").val();
     
     if(Part_Id && Op_Id && date){

       $('#part_qty_no'+rowid).val('');
      
        if(type == 'num'){
              $("#qty_in_kgs"+rowid).val('');
        }else{
            $("#qty"+rowid).val(''); 
        }

        if(current_qty!=''){
             $.ajax({
               url:'<?=base_url('getPartOperationQty')?>',
               method:"POST",
               data:{Part_Id:Part_Id,Op_Id:Op_Id},
               success:function(result)
               {
                console.log(" Part_Id:"+Part_Id+"  Op_Id:"+Op_Id+"  Part OP Qty:-"+result);
                       var part_operation_qty=result;  
                          if(part_operation_qty == '' || part_operation_qty == '0'){
                             part_operation_qty=1;   
                            }
                       
                        if(part_operation_qty){
                            if(type == 'num'){
                               
                                //Show kgs per quantity
                                 var kgs = (current_qty/part_operation_qty);
                                $("#qty_in_kgs"+rowid).val(kgs.toFixed(2)); 
                           
                            }else{ 
                             
                               ////Show quantity per kgs
                               if(current_qty){
                                var quantity=(part_operation_qty*current_qty);      
                                $("#qty"+rowid).val(Math.round(quantity)); 
                                
                               }
                              
                            }
                              
                        }else{
                           $("#qty_in_kgs"+rowid).val('');$("#qty"+rowid).val('');                          
                        }
               
    
               }
               });
        }
 }else{
     alert("Select Part/Operation/Date..");
 }
}

function checkPlanning()
{
 
 var checkboxes = document.getElementsByName('checkboxVal[]');
var checkedvals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
if (checkboxes[i].checked) 
{
checkedvals += ","+checkboxes[i].value;
}
}
if (checkedvals) checkedvals = checkedvals.substring(1);
///alert(checkedvals);
if(checkedvals == '')
{
    alert("Please select the record!");
    return false;
}
}
</script>
</body>

</html>