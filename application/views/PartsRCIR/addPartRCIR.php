<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Part RCIR | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>PartsRCIR">Parts RCIR</a></li>
                            
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
                                <h2 style="width: 87%;">Add Part RCIR</h2><br>
                            <?php }else{?>
                                    <h2 style="width: 87%;">Update Part RCIR</h2><br>
                            <?php } ?>
                            </div>
                                <div class="col-sm-4">

                                        <!-- <select id="example-getting-started" multiple> -->
                                       
                                </div>
                               <!--  <div class="col-sm-4" align="right">
                                     <button class="btn btn-primary mail_draft">Mail Draft</button>
                                </div> -->
                            </div>

                             <?php if(empty($_GET['ID']))
                                    {
                                        echo form_open('/createPartRCIR', array('autocomplete' => 'off')); 
                                        
                                       $disablesupl="";
                                    } else { ?>
                                        <?php echo form_open('/updatePartRCIR', array('autocomplete' => 'off'));
                                      
                                         $disablesupl="disabled"; ?>
                                         <input type="hidden" name="supplierId" value="<?=$getPRCIRMast['supplier_id'];?>">
                                     <?php  } ?>
                                  
                                     <input type="hidden" name="mast_edit_id" value="<?=$getPRCIRMast['id']?>">

                            <div class="row">
                                 
                                 <div class="col-sm-3">
                                    <label class="form-label">Select Supplier <label class="mandatory">*</label></label>
                                      <select id="supplierId"  class="form-control  alltxtUpperCase" name="supplierId" onChange="getRCIRQty();" <?=$disablesupl?>>
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
                                 <div class="col-sm-3">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                      <?php $seldate=($_GET['ID'])?$getPRCIRMast['date']:date('Y-m-d'); ?>
                                    <input type="date" name="date"  id="todate" class="form-control" value="<?php echo set_value('date',$seldate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>" onChange="getRCIRQty();">
                                    <?php echo form_error('date');?>
                                 </div>
                                 <div class="col-sm-3">
                                    <label class="form-label">Supplier Challan No. <label class="mandatory"></label></label>
                                     <input type="text" class="form-control" name="supplier_challan_no" value="<?php echo set_value('supplier_challan_no',$getPRCIRMast['challan_no']) ?>">
                                    <?php echo form_error('supplier_challan_no');?>
                                 </div>
                                 <div class="col-sm-3">
                                       <?php $challandate=($_GET['ID'])?$getPRCIRMast['challan_date']:date('Y-m-d'); ?>
                                    <label class="form-label">Supplier Challan Date <label class="mandatory"></label></label>
                                     <input type="date" class="form-control" name="supplier_challan_date" value="<?php echo set_value('supplier_challan_date',$challandate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                    <?php echo form_error('supplier_challan_date');?>
                                 </div>
                                 
                            </div>                           <br>
                             <div class="row">
                                 <div class="col-sm-12">
                                    <label class="form-label">Remarks</label>
                                   <textarea cols="2" name="remark" class="form-control" ><?php echo set_value('remark',$getPRCIRMast['remarks']) ?></textarea>
                                 </div>
                                 
                            </div>
                            
                            <br>
                             <?php   if(!empty($getPartRCIRDetails)) { ?>
                             
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Part RCIR Details Update</h3>
                        <div style="overflow : auto;">
                            <table id="example1" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th>Part ID</th>
                                        <th>Part No.</th>
                                        <th>Part Name</th>
                                        <th>Operation Name</th>
                                        <th>Qty in Nos</th>
                                        <th>Action</th>
                                        
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                   <?php  $count=1;
                                   //echo "<pre>";print_r($getPartRCIRDetails);
                                   foreach($getPartRCIRDetails as $row)
                            			{ 
                            			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
                            			  $operD=$this->GetQueryModel->getOperation($row['op_id']);
                            			  	$checkIssqty = $this->GetQueryModel->getUsedQty($row['id']);
                            			 //echo "<pre>";print_r($row);
                                   ?>
                                   <input type="hidden" name="edit_id[]" value="<?=$row['id']?>">
                                   <input name="edit_Quantity[]" type="hidden" value="<?=$row['qty'];?>">
                                   
                                    <tr>
                                        <td > <?=$count." - ".$row['id'];?> </td>
                                        <td > <?=$row['part_id'];?> </td>
                                        <td > <?=$partD['partno'];?> </td>
                                        <td > <?=$partD['name'];?> </td>
                                        <td > <?=$operD['name'];?> </td>
                                        <td > <?=$row['qty'];?> </td>
                                        <td style="font-size: 14px;color: #047004;"> 
                                        <?php if($row['rejected_qty']=='' && $checkIssqty==0){ ?>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onClick="deleteBookedQty(<?=$row['id']?>);"><i class="demo-pli-trash fs-5"></i></a>
                                        <?php }elseif($checkIssqty>0){
                                            echo "Qty Processed";
                                        }else{
                                           echo "QC Done."; 
                                        }
                                        ?>
                                        </td>
                                        <!--<td > 
                                         <input name="edit_Quantity[]" type="text" value="<?=$row['qty'];?>" class="form-control" placeholder="Quantity"  >
                                        </td>-->
                                        
                                     
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

                            
                               
                                <div class="col-md-12" id="RCIRQty" style="overflow-y: scroll;"></div>
                            


                            
                            
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
$( document ).ready(function() {
    var supId = '<?=$getTranPoMast;?>';
        var MastId = "<?=$_GET['ID'];?>";
    if(supId=='')
    {
    var supId = '<?=$suppId;?>';
    }
    if(supId !='' && MastId != "")
    {
    getRCIRQty();
    }
});
function getRCIRQty()
{
    //alert($('input#todate').val());
    var date = $('input#todate').val();
    var MastId = "<?=$_GET['ID'];?>";
    var supId=$('#supplierId').val();
   // alert(MastId);
    //return false;
    $.ajax({
    url:"<?php echo base_url(); ?>getRCIRQty",
    method:"POST",
    data:{supId:supId,MastId:MastId,date:date},
    success:function(result)
    {
    console.log(result);
    $("#RCIRQty").html(result);
    }
    });
}
function deleteBookedQty(id)
{
      if (confirm("Are you sure?")) {
          $.ajax({
            url:"<?php echo base_url(); ?>deleteBookedQty",
            method:"POST",
            data:{id:id},
            success:function(result)
            {
            location.reload();
            }
          });
    }
    return false;

}

function checkQty(id)
{
	var rcir_qty    = parseInt($("#rcir_qty"+id).val());
	var bal_qty     = parseInt($("#bal_qty"+id).val());
	
    if(bal_qty < rcir_qty)
    {
        $("#qtyExit"+id).show();
    }else
    {
        $("#qtyExit"+id).hide();
    }
       
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