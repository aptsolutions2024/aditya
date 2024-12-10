<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title class="contentTohide">RM PO Details Report | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('RMPODetailsReport');?>">RM PO Details Report</a></li>
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
                            <h2 style="width: 80%;">RM PO Details Report</h2>
                            </div>
  <div class="row" style="">
                            <?php echo form_open('/RMPODetailsReport', array('autocomplete' => 'off','class' => 'row g-3 contentTohide','id' => 'formSch')); ?>
                           
  
                                    <div class="col-md-3" style="text-align: right;margin-top: 26px;">
                                       <label class="form-label">Select Date<label class="mandatory">*</label></label>
                                    </div>
                                    <div class="col-md-3">
                                          <input id="date" name="date" type="month" class="form-control" value="<?php echo set_value('date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                    <div class="col-2" style="margin-top: 17px;">
                                    <button type="submit" class="btn btn-primary" >Show</button>
                                    </div>
  
                                </form>
                                  </div>
                                <br><br>
                                     
        <h3>RM PO Details </h3>
      
        <table id="example" class="display dt-responsive overflow-auto table table-striped" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th>Sr No</th>
        <th>PO ID</th>
        <th>Date</th>
        <th>RM Name</th>
        <th>Supplier</th>
        <th>Ordered Qty</th>
        <th>Rec. Qty</th>
        <th>Bal. Qty</th>
        </tr>
        </thead>
        <tbody>
      <?php  
      //print_r($RMPODetailsReport);
       
        $srno=0;
        $totalOrderedQty=0;
        $totalRcirQty=0;
        $totalbalQty=0;
		foreach($RMPODetailsReport as $row)
		{
		    $srno++;
			$supD  = $this->getQueryModel->getSupplierById($row['supplier_id']);
			$poDet  = $this->getQueryModel->getRMRCIRByPoId($row['id']);
			if($row['ordered_qty']==0){ continue;}
			
		     $bal_qty= 0;
			
			?>
			<tr>
			<td > <?=$srno;?> </td>
            <td > <?=$row['po_mast_id']." - ".$row['id'];?> </td>
            <td > <?=date("d-m-Y",strtotime($row['date']));?> </td>
            <td > <?=$row['rm_name'];?> </td>
            <td > <?=$supD['name'];?> </td>
            <td ><b> <?=$row['ordered_qty']?></b> </td>
            <td ><b> <?=($poDet['qty']-$poDet['rejected_qty']);?></b> </td>
            <td ><b> <?=($row['ordered_qty']-($poDet['qty']-$poDet['rejected_qty']))?></b> </td>
         
            </tr>
           
      <?php } ?>
	</tbody>	
	</table>
	<br>
                          

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

    $('#example').DataTable( {
        dom: 'Bfrtip',
        'aaSorting': [],
        'bPaginate': false,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
  
} );

</script>

</body>

</html>