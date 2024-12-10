<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>DC Operation RCIR | Aditya</title>

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
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url('viewDCOperation');?>">DC Operation RCIR</a></li>
                            
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
                            <!-- <h2 style="width: 87%;">RM-Requisition Email</h2> -->

                              <div class="col-sm-5">
                                <?php
                                if(empty($_GET['ID']))
                                {
                                ?>
                                <h2 style="width: 87%;">Add DC Operation RCIR</h2><br>
                            <?php }else{?>
                                    <h2 style="width: 87%;">Update DC Operation RCIR</h2><br>
                            <?php } ?>
                            </div>
                                <div class="col-sm-4">

                                        <!-- <select id="example-getting-started" multiple> -->
                                       
                                </div>
                               <!--  <div class="col-sm-4" align="right">
                                     <button class="btn btn-primary mail_draft">Mail Draft</button>
                                </div> -->
                            </div>

                             <?php   if(empty($_GET['ID'])){ ?>
                                        <?php echo form_open('/createDCRCIR', array('autocomplete' => 'off'));
                                        $disablesupl="";
                                        ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateDCRCIR', array('autocomplete' => 'off'));
                                        $disablesupl="disabled";
                                        ?>
                                          <input type="hidden" name="mast_edit_id" value="<?=$getPRCIRMast['id']?>">
                                          <input type="hidden" name="supplierId" value="<?=$getPRCIRMast['supplier_id']?>">
                                     <?php } ?>
                                     
                                   

                            <div class="row">
                                 
                                 <div class="col-sm-3">
                                    <label class="form-label">Select Supplier <label class="mandatory">*</label></label>
                                      <select id="supplierId"  class="form-control alltxtUpperCase" name="supplierId" onChange="getDCRCIRQty(this.value);" <?=$disablesupl?>>
                                       <?php $getTranPoMast = set_value('supplierId'); $suppId = $getPRCIRMast['supplier_id']; ?>
                                            <option value="">Select Supplier</option>
                                            <?php
                                            if(!empty($Supplier))
                                            {
                                                foreach ($Supplier as $key => $value) 
                                                {
                                                   
                                            ?>
                                                <option <?php if($getTranPoMast == $value['id']) {echo "selected";} ?> <?php if($suppId == $value['id']) {echo "selected";} ?> value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                              
                                            <?php } } ?> 
                                        </select>
                                    
                                 </div>
                                <!-- <div class="col-sm-4">
                                    <label class="form-label">Select DC No. <label class="mandatory">*</label></label>
                                      <select id="getDCListBySuppId"  class="form-control" name="DC_No" onChange="getDCRCIRQty(this.value);">
                                       <option  value="">Choose DC No.</option>
                                        </select>
                                    
                                 </div>-->
                                 <div class="col-sm-3">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                      <?php $seldate=($_GET['ID'])?$getPRCIRMast['date']:date('Y-m-d'); ?>
                                    <input type="date" name="date"  class="form-control" value="<?php echo set_value('date',$seldate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                    <?php echo form_error('date');?>
                                 </div>
                                    <div class="col-sm-3">
                                    <label class="form-label">Supplier Challan No. <label class="mandatory">*</label></label>
                                     <input type="text" class="form-control" name="supplier_challan_no" value="<?php echo set_value('supplier_challan_no',$getPRCIRMast['challan_no']) ?>">
                                    <?php echo form_error('supplier_challan_no');?>
                                 </div>
                                    <div class="col-sm-3">
                                    <label class="form-label">Supplier Challan Date <label class="mandatory">*</label></label>
                                      <?php $challandate=($_GET['ID'])?$getPRCIRMast['challan_date']:date('Y-m-d'); ?>
                                     <input type="date" class="form-control" name="supplier_challan_date" value="<?php echo set_value('supplier_challan_date',$challandate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                    <?php echo form_error('supplier_challan_date');?>
                                 </div>
                            </div>
                            
                                 <!--<div class="col-sm-4">-->
                                 <!--    <label class="form-label">Ref. PO<label class="mandatory">*</label></label>-->
                                 <!--    <?php $ref_po = set_value('ref_po') ?>-->
                                 <!--        <select id="ref_po"  name="ref_po" class="form-select">-->
                                 <!--         <option selected value="N" <?= ($ref_po == 'N') ? "selected": "" ; ?> >No</option>-->
                                 <!--         <option value="Y" <?= ($ref_po == 'Y') ? "selected": "" ; ?> >YES</option>-->
                                          
                                 <!--      </select>-->
                                 <!--</div>-->
                              
                              
                                
                                 <br>
                             <div class="row">
                                 <div class="col-sm-12">
                                    <label class="form-label">Remarks</label>
                                   <textarea cols="2" name="remark" class="form-control" ><?php echo set_value('remark',$getPRCIRMast['remarks']) ?></textarea>
                                 </div>
                                 
                            </div>
                             <?php   if(!empty($getPartRCIRDetails)) { ?>
                             
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>DC Operation RCIR Update</h3>
                           <div style="overflow:auto;">
                            <table id="example1" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                         <th>RCIR ID</th>
                                        <th>Part ID</th>
                                        <th>Part No.</th>
                                        <th>Part Name</th>
                                        <th>Operation Name</th>
                                        <th>Qty in Nos</th>
                                        <th>Inproc. Loss Qty</th>
                                        <th>Action</th>
                                        
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                   <?php  $count=1;
                                   foreach($getPartRCIRDetails as $row)
                            			{ 
                            			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
                            			 $operD = $this->GetQueryModel->getOperation($row['op_id']);
                            			$checkIssqty = $this->GetQueryModel->getUsedQty($row['id']);
                            	
                            			 //echo "<pre>";print_r($row);
                                   ?>
                                   <input type="hidden" name="edit_id[]" value="<?=$row['id']?>">
                                   <input type="hidden" name="edit_Quantity[]" value="<?=$row['qty'];?>">
                                    <tr>
                                        <td > <?=$count;?> </td>
                                        <td > <?=$row['mast_partsrcir_id']." - ".$row['id'];?> </td>
                                        <td > <?=$row['part_id'];?> </td>
                                        <td > <?=$partD['partno'];?> </td>
                                        <td > <?=$partD['name'];?> </td>
                                        <td > <?=$operD['name'];?> </td>
                                        <td > <?=$row['qty'];?> </td>
                                         <td > <?=$row['inprocess_loss_qty'];?> </td>
                                        <td style="font-size: 14px;color: #047004;"> 
                                        <?php if($row['rejected_qty']=='' && $checkIssqty==0){ ?>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onClick="deleteBookedQty(<?=$row['id']?>);"><i class="demo-pli-trash fs-5"></i></a>
                                        <?php }elseif($checkIssqty>0){
                                            echo "Qty Processed";
                                        }elseif($row['Accepted_type_det']=='D'){
                                              echo "Rework-".$row['rejected_qty']; 
                                        }else{
                                           echo "QC Done."; 
                                        }
                                        ?>
                                        </td>
                                     
                                    </tr>
                                    
                                    <?php $count++; } ?>
                                </tbody>
                            </table>
</div>
<br>
                            <!-- <div class="col-12" >
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>-->
                           
 <?php } ?>
 
                            <br>
                            
                            
                            
                            
                            
                            <br>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <?php 
                                if(!empty($_SESSION['oamsg'])) { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['oamsg'];?></div>

                                 <?php   } ?>

                            
                               
                                <div class="col-md-12 " id="RCIRQty" style="overflow-y: scroll;"></div>
                            


                            
                            
                </form>
                                              

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
    <!-- ~~~~~~~~~~~~~~~~~~~~~~Model start~~~~~~~~~~~~~~~~~~~~~~~~ -->


  <!-- Modal -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~model end~~~~~~~~~~~~~~~~~~~~~~~ -->
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
     <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 

    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script> -->

<script>

/*function getDCListBySupps(Supp_Id)
{
    var selectedId = '<?=$getTranPoMast;?>';
     $.ajax({
      url:"<?php echo base_url(); ?>getDCListBySuppId",
      method:"POST",
      data:{Supp_Id:Supp_Id,selectedId:selectedId},
      success:function(result)
      {
      $("#getDCListBySuppId").html(result);
      }
      });
}*/

$( document ).ready(function() {
    var supId = '<?=$getTranPoMast;?>';
    if(supId=='')
    {
    var supId = '<?=$suppId;?>';
    }
    if(supId !='')
    {
    getDCRCIRQty(supId);
    }
});
function getDCRCIRQty(supId)
{
    var MastId  = "<?=$getPRCIRMast['supplier_id'];?>";
    //var dcNo    =$("#getDCListBySuppId").val();
$.ajax({
   url:"<?php echo base_url(); ?>getDCRCIRQty",
   method:"POST",
   data:{supId:supId,MastId:MastId},
   success:function(result)
   {
    //console.log(result);
    $("#RCIRQty").html(result);
   }
   });
}

function getQtyByKG(nums)
{
	var Part_Id = parseInt($("#part_id"+nums).val());
	var qty_in_kgs = parseInt($("#qty_in_kgs"+nums).val());
	
	//$("#quantity"+nums).attr('readonly', 'false');
	
	if(qty_in_kgs != 0)
	{
	    
	   $("#rcir_qty"+nums).prop('readonly', true);
	$.ajax({
      url:"<?php echo base_url(); ?>getQtyByKG",
      method:"POST",
      data:{Part_Id:Part_Id,qty_in_kgs:qty_in_kgs},
      success:function(result)
      {
        checkQty(nums,result);
      $("#rcir_qty"+nums).val(result);
      }
      });
	}else
	{ 
	    $("#rcir_qty"+nums).val('');
	    $("#rcir_qty"+nums).prop('readonly', false);
	}
	
       
}

function checkQty(id,rcir_qty)
{
    
	//var rcir_qty    = parseInt($("#rcir_qty"+id).val());
	var bal_qty     = parseInt($("#bal_qty"+id).val());
	
	
    if(bal_qty < rcir_qty)
    {
        $("#editqtyExit"+id).show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#editqtyExit"+id).hide();
    }
       
}

function deleteBookedQty(id)
{
    var type = 'DCOperation';
     if (confirm("Are you sure?")) {
          $.ajax({
            url:"<?php echo base_url(); ?>deleteBookedQty",
            method:"POST",
            data:{id:id,type:type},
            success:function(result)
            {
            location.reload();
            }
            });
    }
    return false;
  
}

</script>
</body>
<style>
    th, td {
    border: 1px solid #ebebeb;
    padding: 5px;
    text-align: center;
}
</style>
</html>