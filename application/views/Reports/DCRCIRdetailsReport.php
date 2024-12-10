<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title class="contentTohide">RCIR Details Report | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('getDCRCIRDetailsReport');?>">RCIR Details Report</a></li>
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
                            <h2 style="width: 80%;">RCIR Details Report</h2>
                            </div>

                            <?php echo form_open('/getDCRCIRDetailsReport', array('autocomplete' => 'off','class' => 'row g-3 contentTohide','id' => 'formSch')); ?>
                           

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
                                        <label class="form-label">Part Name</label>
                                         <?php $pId= set_value('Part_Id');  $pname= set_value('Part_Search');?>
                                        <input type="hidden" id="Part_IdOnly" name="Part_Id" class="form-select Part_Id" value="<?=$pId;?>">
                                           <div class="autocomplete">
                                              <input type="search" id="Part_SearchOnly" name="Part_Search" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value,'Only','<?=base_url('getPartsBySearch')?>');">   
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
                                        
                                        </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Stock Adj. Date<label class="mandatory">*</label></label>
                                       <input id="stock_adj_date" name="stock_adj_date" type="date" class="form-control" value="<?php echo set_value('stock_adj_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('stock_adj_date');?>
                                    </div>
                                    
                                    <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        </form>
                                        
                                          
                                <br><br>
                 
                            <p style="color:red;text-transform:capitalize;">To reduce the Balance Qty in the system, please enter positive(+) adjustment quantity.
                            
                            <br>To increase the Balance Qty in the system, please enter negative(-) adjustment quantity.  <br>    This will affect the Branch stock.</p>
                              
                                     <h3>RCIR Details </h3>
      
        <table id="example" class="display dt-responsive overflow-auto table table-striped" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
          <th>RCIR No</th>
        <th width='9%'>RCIR Date</th>
        <th>Rec. Supplier Challan No</th>
        <th>Part Details</th>
        <th>Op. Name</th>
        <th>RCIR Qty</th>
        <th>Inproc. Loss Qty</th>
        <th>Used Qty</th>
        <th>Bal. Qty</th>
        <th width='8%'>DOC No</th>
        <th width='9%'>DOC Date</th>
        <th>DOC Type</th>
        <th>Location</th>
        </tr>
        </thead><tbody>
      <?php  
        $total = sizeof($getQty); 
        $rc=1;
          $totalOrderedQty=0;
        $totalRcirQty=0;
        $totalbalQty=0;
        $totinprocess_loss_qty = 0;
      // print_r($getQty);
		foreach($getQty as $row)
		{
			 $partD  = $this->getQueryModel->getPartsById($row['part_id']);
			 $operD=$this->getQueryModel->getOperation($row['op_id']);
			 $RecQtyDetailsAll  = $this->getQueryModel->getRCIRIssueQtyById($row['id']);
			 $bData  = $this->getQueryModel->getBranchbyId($row['branch_id']);
			if($row['rcir_qty']==0 && $row['inprocess_loss_qty']==0){ continue;}
			 //$bal_qty = $row['ordered_qty'] - $RecQtyDetails['rec_qty']-$RecQtyDetails['loss_qty'];
		     $bal_qty= 0;
			$totinprocess_loss_qty = $totinprocess_loss_qty+$row['inprocess_loss_qty'];
			?>
			<tr>
            <td > <?=$row['rcir_mast_id']." - ".$row['id'];?> </td>
            <td > <?=date("d-m-y",strtotime($row['date']));?> </td>
            <td > <?=substr($row['challan_no'],0,30);?> </td>
            <td > <?=$partD['part_id']." - ".$partD['partno']." - ".$partD['name'];?> </td>
            <td > <?=$operD['name'];?></td>
            <td ><b> <?=$row['rcir_qty']?></b> </td>
            <td ><b> <?=$row['inprocess_loss_qty']?></b> </td>
            <td></td><td></td><td></td><td></td><td></td>
            <td><?=$bData['name']?></td>
            </tr>
            <?php
            $srno =0;
            $tot=0;
            $bal_qty=0;
            foreach ($RecQtyDetailsAll as $RecQtyDetails)
            {
                $srno++;
                $tot=$tot+$RecQtyDetails['issue_qty']+$RecQtyDetails['rejected_qty'];
                $trstyle='';
                if($RecQtyDetails['issue_doc_type']=="stock_adj"){
                  $trstyle="color:blue";  
                }
               
                ?>
		    <tr style="<?=$trstyle;?>">
            <td><?=$srno;?></td><td></td><td></td><td></td><td></td><td></td><td></td>
            <td > <?=($RecQtyDetails['issue_qty']!=0)?$RecQtyDetails['issue_qty']:$RecQtyDetails['rejected_qty'];?></td>
            <td> - </td>
            <td > <?=($RecQtyDetails['issue_qty']!=0)?$RecQtyDetails['issue_doc_id']:$RecQtyDetails['rejected_doc_id'];?></td>
            <td > <?=($RecQtyDetails['rejected_qty']>0)?(($RecQtyDetails['updated_on'])?date("d-m-y",strtotime($RecQtyDetails['updated_on'])):""):(($RecQtyDetails['tran_date'])?date("d-m-y",strtotime($RecQtyDetails['tran_date'])):"");?></td>
            <td > <?=($RecQtyDetails['issue_qty']!=0)?substr($RecQtyDetails['issue_doc_type'],0,8):substr($RecQtyDetails['rejected_doc_type'],0,8);?></td>
             <td ><?php
                   $RecQtyDetails['move_to'];
                   if(substr($RecQtyDetails['move_to'],0,1)=='S'){
                                                
                       $supplierD=  $this->getQueryModel->getSupplierById(substr($RecQtyDetails['move_to'],1,6));
                       echo $supplierD['name']; 
                       
                    }else{
                        
                          $branchD=  $this->getQueryModel->getBranchbyId(substr($RecQtyDetails['move_to'],1,6));
                          echo $branchD['name']; 
                    } 
             ?></td>
            </tr>
			
        <?php }
         $totalOrderedQty+=$row['rcir_qty'];
        $totalRcirQty+=$tot;
        $totalbalQty+=($row['rcir_qty']-$tot);
        ?>
        <tr>
              <tr>
             <td></td><td></td><td></td><td> <label class="form-label" style="padding: 0.5rem;font-weight:800;">Stock Value</label></td><td><input class='form-control' type='text' id='adjqty<?=$row['id']?>'></td>
             <td><button class="btn btn-primary" onclick="stockadj('<?=$row['rcir_mast_id'];?>','<?=$row['id']?>','<?=$row['part_id']?>','<?=$row['op_id']?>','<?=$row['branch_id']?>')">Save_Stock_Adj.</button></td>
             <td>Total</td>
            <td ><b><?=$tot?></b></td>
           <td><b><?=($row['rcir_qty']-$tot)?"<span style='color:red'>".($row['rcir_qty']-$tot)."</span>":($row['rcir_qty']-$tot);?></b></td><td></td><td></td><td></td>
            
        </tr>
		    <?php 
		 $rc++;                      
		} ?>
				 <tr style="font-size:18px;color:green;">
           <td></td>
           <td></td>
           <td></td>
           <td>TOTAL</td>
           <td>InPLoss <?=$totinprocess_loss_qty;?></td>
            <td><?=$totalOrderedQty;?></td>
            <td> </td>
            <td><?=$totalRcirQty;?></td>
            <td><?=($totalbalQty)?"<span style='color:red'>".$totalbalQty."</span>":$totalbalQty;;?> </td>
            <td></td>
            <td></td>
            <td></td>
        <!--</tr> -->
        <!--   <tr style="font-size:15px;">-->
        <!--   <td></td>-->
        <!--   <td></td>-->
        <!--   <td></td>-->
        <!--   <td></td>-->
        <!--   <td>Inpro_Loss_Qty</td>-->
        <!--    <td><b>Order_Qty</b> </td>-->
        <!--    <td></td>-->
        <!--    <td><b>RCIR_Qty</b></td>-->
        <!--    <td><b>Bal_Qty</b></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--</tr>-->
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
           url:"<?php echo base_url(); ?>saveStockAdjDCrcir",
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