<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title class="contentTohide">DC Details Report | Aditya</title>

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
<style>
div#example_wrapper{
    overflow:auto;
}
    @media print {
           .pagebreak {  
               clear: both;
               page-break-after: always;
           } 
        
	.contentTohide  {
		display: none;
	}
 

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
                              <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('getDCDetailsReport');?>">DC Details Report</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">                    </p>

                </div>

            </div>


            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card mb-3">
                        <div class="card-body">

                             <?php  error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>    

                            <div class="row contentTohide">
                            <h2 style="width: 80%;">DC Details Report</h2>
                            </div>

                            <?php echo form_open('/getDCDetailsReport', array('autocomplete' => 'off','class' => 'row g-3 contentTohide','id' => 'formSch')); ?>
                           

                                    <div class="col-md-2">
                                       <label class="form-label">From Date<label class="mandatory">*</label></label>
                                       <input id="from_date" name="from_date" type="date" class="form-control" value="<?php echo set_value('from_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('from_date');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">To Date<label class="mandatory">*</label></label>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo set_value('to_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('to_date');?>
                                    </div>
                                      <div class="col-md-2">
                                            <label class="form-label">Supplier Name <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Supplier_Id'); ?>
                                            <select id="Supplier_Id" name="Supplier_Id" class="form-select alltxtUpperCase">
                                            <option value="">Choose...</option> 
                                            <?php foreach($getSupplier as $row){ ?>     
                                                <option value="<?=$row['id'];?>" <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php echo form_error('Supplier_Id');?>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Part Name (Optional)</label>
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
                                        <label class="form-label">Operation</label>
                                        <select id="Op_Id" name="Op_Id" class="form-select">
                                         <option value="">Choose...</option> 
                                        </select>  
                                    </div>
                                    <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Stock Adj. Date<label class="mandatory">*</label></label>
                                       <input id="stock_adj_date" name="stock_adj_date" type="date" class="form-control" value="<?php echo set_value('stock_adj_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('stock_adj_date');?>
                                    </div>

                                        
                                        
                                    
                                        </form>
                                        
                                   
                                <br><br>
                                       <p style="color:red;text-transform:capitalize;">To reduce the Balance Qty in the system, please enter positive(+) adjustment quantity.This will reduce the stock at Supplier end
                                       
                                       
                                           <br>To increase the Balance Qty in the system, please enter negative(-) adjustment quantity. This will increase the stock at Supplier end.</p>
                           
                                    
                                     <h3>DC-Details </h3>
      
        <table id="example" class="display dt-responsive overflow-auto table table-striped" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        
        <th width='8%'>DC No</th>
        <th width='9%'>DC Date.</th>
        <th>DC Challan No</th>
        <th width='20%'>Part Details</th>
        <th>Operation Name</th>
        <th>Order Qty</th>
        <th>RCIR Qty</th>
        <th>Bal. Qty</th>
        <th>RCIR No</th>
        <th width='9%'>RCIR Date</th>
        <th width='9%'>Rec. Supl Challan No</th>
        <th>DOC Type</th>
        </tr>
        </thead><tbody>
      <?php  
      //print_r($getQty);
        $total = sizeof($getQty); 
        $rc=1;
        $totalOrderedQty=0;
        $totalRcirQty=0;
        $totalbalQty=0;
		foreach($getQty as $row)
		{
			 $partD  = $this->getQueryModel->getPartsById($row['part_id']);
			 $operD=$this->getQueryModel->getOperation($row['op_id']);
			 $RecQtyDetailsAll  = $this->getQueryModel->getDCRCIRReceivedQtyByDCId($row['id']);
			// $bData  = $this->getQueryModel->getBranchbyId($RecQtyDetails['branch_id']);
			if($row['ordered_qty']==0){ continue;}
			 //$bal_qty = $row['ordered_qty'] - $RecQtyDetails['rec_qty']-$RecQtyDetails['loss_qty'];
		     $bal_qty= 0;
			
			?>
			<tr>
            <td > <?=$row['dc_mast_id']." - ".$row['id'];?> </td>
            <td > <?=date("d-m-Y",strtotime($row['date']));?> </td>
            <td > <?=$row['dc_no'];?> </td>
            <td > <?=$partD['part_id']." - ".$partD['partno']." - ".$partD['name'];?> </td>
            <td > <?=$operD['name'];?></td>
            <td ><b> <?=$row['ordered_qty']?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            <?php
            $srno =0;
            $tot=0;
            $bal_qty=0;
            foreach ($RecQtyDetailsAll as $RecQtyDetails)
            {
                $srno++;
                $tot=$tot+$RecQtyDetails['rec_qty']+$RecQtyDetails['loss_qty'];
                
                   $trstyle='';
                if($RecQtyDetails['received_doc_type']=="stock_adj"){
                  $trstyle="color:blue";  
                }
			 ?>
		    <tr style="<?=$trstyle;?>">
            <td><?=$srno;?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td > <?=($RecQtyDetails['rec_qty']+$RecQtyDetails['loss_qty']);?></td>
            <td > </td>
            <td > <?=$RecQtyDetails['rcir_id'];?></td>
            <td > <?=($RecQtyDetails['date'])?date("d-m-Y",strtotime($RecQtyDetails['date'])):"";?></td>
            <td > <?=$RecQtyDetails['rec_challan_no'];?></td>
             <td ><?=substr($RecQtyDetails['received_doc_type'],0,8)?></td>
            </tr>
			
        <?php } 
        $totalOrderedQty+=$row['ordered_qty'];
        $totalRcirQty+=$tot;
        $totalbalQty+=($row['ordered_qty']-$tot);
        ?>
        <tr>
           
            <td></td><td></td>
              <td> <label class="form-label" style="padding: 0.5rem;font-weight:800;">Stock Value</label></td>
              <td><input class='form-control' type='text' id='adjqty<?=$row['id']?>'></td>
             <td><button class="btn btn-primary" onclick="stockadj('<?=$row['dc_mast_id'];?>','<?=$row['id']?>','<?=$row['part_id']?>','<?=$row['op_id']?>','<?=$row['branch_id']?>')">Save_Stock_Adj.</button></td>
            <td>Total</td>
            <td ><b><?=$tot;?></b></td>
           <td><b><?=($row['ordered_qty']-$tot)?"<span style='color:red'>".($row['ordered_qty']-$tot)."</span>":($row['ordered_qty']-$tot);?></b></td>
           <td></td>
           <td></td>
           <td></td>
            <td></td>
        </tr>
		    <?php 
		 $rc++;                      
		} ?>
		 <tr style="font-size:18px;color:green;">
           <td></td><td></td><td></td><td></td>
           <td>TOTAL</td>
            <td><?=$totalOrderedQty;?></td>
            <td><?=$totalRcirQty;?></td>
            <td><?=($totalbalQty)?"<span style='color:red'>".$totalbalQty."</span>":$totalbalQty;?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="font-size:15px;">
           <td></td><td></td><td></td><td></td>
            <td></td>
            <td><b>Order_Qty</b> </td>
            <td><b>RCIR_Qty</b></td>
            <td><b>Bal_Qty</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
			</thead></table><br>
                                    
                                    
                             
                          

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
     getDCOpBySupPartId($('#Part_IdOnly').val());
    $('#example').DataTable( {
        dom: 'Bfrtip',
        'aaSorting': [],
        'bPaginate': false,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
  
} );
function getDCOpBySupPartId(Part_Id)
{
  //  alert("Part_id-"+Part_Id);
    var Supplier_Id =$("#Supplier_Id").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getDCOpByPartId",
      method:"POST",
      data:{Part_Id:Part_Id,Supplier_Id:Supplier_Id},
      success:function(result)
      {
       
      $("#Op_Id").html(result);
      $('#Op_Id').val('<?=$post_op_id;?>').attr("selected", "selected");
      
      }
      }); 
}
 function getDPROpByPartId(part_id){
     
 }
function getDCRCIRQty(supId)
{

$.ajax({
   url:"<?php echo base_url(); ?>getDCDetails",
   method:"POST",
   data:{supId:supId},
   success:function(result)
   {
    //console.log(result);
    $("#RCIRQty").html(result);
   }
   });
}
    
  function stockadj(rcir_mast_id,det_id,part_id,op_id,branch_id){
    // alert( "Mast_id-"+rcir_mast_id+"  Det_id-"+det_id);
    var adjqty=$("#adjqty"+det_id).val();
    var supId=$("#Supplier_Id").val();
     $.ajax({
           url:"<?php echo base_url(); ?>saveStockAdjDCdetails",
           method:"POST",
           data:{
               mast_id:rcir_mast_id,
               det_id:det_id,
               part_id:part_id,
               op_id:op_id,
               branch_id:branch_id,
               adjqty:adjqty,
               supId:supId,
           },
           success:function(result)
           {
            alert(result);
             location.reload();
            //console.log(result);
           }
      });
 }

</script>

</body>

</html>