
<!DOCTYPE html>
<html lang="en">
<?php 
$pageName=$_SERVER['REQUEST_URI']; 
//print_r($_SESSION);die;
$role = $_SESSION['role'];
if(empty($_SESSION['role']))
{
    redirect(base_url('signIn'));
}

?>
<head>
    <meta name="generator" content="Hugo 0.87.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Reports | Aditya</title>
   
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

   <style>
   /*.chartwrapper{*/
   /*  height: 342.667px !important;*/
   /*  width: 686.667px !important;  */
   /*}*/
   a.customlinks{
      color: #25476a;
       text-decoration: none;
   }
   .reportTiles .row{
      
   }
.bg-light-orange {
    background-color: rgba(255, 101, 50, 0.15)!important;
}
.bg-light-primary {
    background-color: rgba(52, 96, 255, 0.15)!important;
}
.bg-light-pink {
    background-color: rgba(231, 46, 123, 0.15)!important;
}
.bg-light-success {
    background-color: rgb(18 191 35 / 15%)!important;
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

                    <!-- Page title and information -->
                    <h1 class="page-title mb-2">Reports</h1>
                    </br>
                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                     <div class="card mb-3">
                        <div class="card-body">
                    <div class="row">
                        
                        <div class="col-xl-12 reportTiles">

<!----------------------------------------------------------Starts of 4 tiles---------------------------------------------------------------------------------------->
                           <h2>Dispatch</h2>
                            <div class="row" style="">
                                <div class="col-sm-4">
                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-light-orange  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                          <h5 class="mb-3"><i class="demo-psi-bar-chart text-reset text-opacity-75 fs-3 me-2"></i> 
                                            <a href="<?php echo base_url();?>SchVSDesPatchR" class="customlinks <?php if($pageName=='/SchVSDesPatchR'){ echo "active";} ?>">Sch. VS Dispatch</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - HDD Usage -->
                                </div>
                                <div class="col-sm-4">
                                    <!-- Tile - Earnings -->
                                    <div class="card bg-light-orange  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-calendar-4 text-reset text-opacity-75 fs-2 me-2"></i>
                                                  <a href="<?php echo base_url();?>SchVSDisPatchByCust" class="customlinks <?php if($pageName=='/SchVSDisPatchByCust'){ echo "active";} ?>">Sch. VS Dispatch By Customer</a>
                                        
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Earnings -->
                                </div>
                            </div>
                             
<!----------------------------------------------------------End of 4 tiles---------------------------------------------------------------------------------------->
<!----------------------------------------------------------Raw Material---------------------------------------------------------------------------------------->
     <h2>Raw Material</h2>
   <div class="row" style="">
                                <div class="col-sm-4">
                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                          <h5 class="mb-3"><i class="demo-psi-file-search text-reset text-opacity-75 fs-3 me-2"></i> 
                                           <a href="<?php echo base_url();?>RMStockSummary" class="customlinks <?php if($pageName=='/RMStockSummary'){ echo "active";} ?>">RM Stock Summary</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - HDD Usage -->
                                </div>
                                  <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-file-search text-reset text-opacity-75 fs-2 me-2"></i> 
                                                <a href="<?php echo base_url();?>RMStockDetails" class="customlinks <?php if($pageName=='/RMStockDetails'){ echo "active";} ?>">RM Stock Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                                   <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-download-window text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>RMConsumptionR" class="customlinks <?php if($pageName=='/RMConsumptionR'){ echo "active";} ?>">RM Consumption Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                                   <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-gear text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>RMtraceability" class="customlinks <?php if($pageName=='/RMtraceability'){ echo "active";} ?>">RM traceability</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                                 <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-gear text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>RMPODetailsReport" class="customlinks <?php if($pageName=='/RMPODetailsReport'){ echo "active";} ?>">RM PO Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                            </div>
 <!----------------------------------------------------------Parts---------------------------------------------------------------------------------------->                           
                                <h2>Parts</h2> 
                            <div class="row" style="">
                                   <div class="col-sm-4">
                                    <!-- Tile - Earnings -->
                                    <div class="card bg-light-pink   overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-coin text-reset text-opacity-75 fs-2 me-2"></i>
                                            <a href="<?php echo base_url();?>PartStockDetailsRevision" class="customlinks <?php if($pageName=='/PartStockDetailsRevision'){ echo "active";} ?>">Parts Stock Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Earnings -->
                                </div>
                              
                                <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-pink   overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-folder text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>AllPartStockDetails" class="customlinks <?php if($pageName=='/AllPartStockDetails'){ echo "active";} ?>">All Parts Stock Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                            </div>
    <!----------------------------------------------------------End of 4 tiles---------------------------------------------------------------------------------------->

    <!----------------------------------------------------------Scrap---------------------------------------------------------------------------------------->                           
                                <h2>Scrap</h2> 
   <div class="row" style="">
        
                                <div class="col-sm-4">
                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-light-success   overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                          <h5 class="mb-3"><i class="demo-psi-recycling text-reset text-opacity-75 fs-3 me-2"></i> 
                                           <a href="<?php echo base_url();?>ScrapStockR" class="customlinks <?php if($pageName=='/ScrapStockR'){ echo "active";} ?>">Scrap Stock Details</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - HDD Usage -->
                                </div>
                              <div class="col-sm-4">
                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-light-success   overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                          <h5 class="mb-3"><i class="demo-psi-recycling text-reset text-opacity-75 fs-3 me-2"></i> 
                                           <a href="<?php echo base_url();?>ScrapStockSummary" class="customlinks <?php if($pageName=='/ScrapStockSummary'){ echo "active";} ?>">Scrap Stock Summary</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - HDD Usage -->
                                </div>
                            </div>
      <!----------------------------------------------------------Quality Control---------------------------------------------------------------------------------------->                           
        <h2>Quality Control</h2> 
                            <div class="row" style="">
                                     <div class="col-sm-4">
                                    <!-- Tile - Earnings -->
                                    <div class="card bg-light-orange  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-inbox-into text-reset text-opacity-75 fs-2 me-2"></i>
                                            <a href="<?php echo base_url();?>InprocessDprQCR" class="customlinks <?php if($pageName=='/InprocessDprQCR'){ echo "active";} ?>">Inprocess DPR QC Report</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Earnings -->
                                </div>
                                <div class="col-sm-4">
                                    <!-- Tile - Sales -->
                                    <div class="card bg-light-orange  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-inbox-into text-reset text-opacity-75 fs-2 me-2"></i> 
                                              <a href="<?php echo base_url();?>IncomingPartQCR" class="customlinks <?php if($pageName=='/IncomingPartQCR'){ echo "active";} ?>">Incoming Part QC Report</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Sales -->
                                </div>
                                  <div class="col-sm-4">
                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-light-orange  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                          <h5 class="mb-3"><i class="demo-psi-inbox-into text-reset text-opacity-75 fs-3 me-2"></i> 
                                           <a href="<?php echo base_url();?>RejectionSummaryR" class="customlinks <?php if($pageName=='/RejectionSummaryR'){ echo "active";} ?>">Rejection Stock Summary</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - HDD Usage -->
                                </div>
                             
                            </div>
    <!----------------------------------------------------------End of 4 tiles---------------------------------------------------------------------------------------->
     <!----------------------------------------------------------Tools---------------------------------------------------------------------------------------->                           
        <h2>Tools</h2> 
        <div class="row" style="">
   
                              
                                <div class="col-sm-4">
                                    <!-- Tile - Earnings -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-right-4 text-reset text-opacity-75 fs-2 me-2"></i>
                                            <a href="<?php echo base_url();?>tranToolDetails" class="customlinks <?php if($pageName=='/tranToolDetails'){ echo "active";} ?>">Tool Summary</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Earnings -->
                                </div>
                        
                                <div class="col-sm-4">
                                    <!-- Tile - Sales -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-share text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>tranToolDetailReport" class="customlinks <?php if($pageName=='/tranToolDetailReport'){ echo "active";} ?>">Tool History Card</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Sales -->
                                </div>
                                   <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-primary  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-speech-bubble-3 text-reset text-opacity-75 fs-2 me-2"></i> 
                                              <a href="<?php echo base_url();?>toolRepairDetailsReport" class="customlinks <?php if($pageName=='/toolRepairDetailsReport'){ echo "active";} ?>">Tool Repair Details Report</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
                               
                            </div>
    <!----------------------------------------------------------End of 4 tiles---------------------------------------------------------------------------------------->
      <!----------------------------------------------------------Miscellaneous---------------------------------------------------------------------------------------->                           
        <h2>Miscellaneous</h2> 
        <div class="row" style="">
        <div class="col-sm-4">
                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-light-pink  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-warning-window text-reset text-opacity-75 fs-2 me-2"></i> 
                                             <a href="<?php echo base_url();?>invoiceDetailsReport" class="customlinks <?php if($pageName=='/invoiceDetailsReport'){ echo "active";} ?>">Insufficient Invoice Qty</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Task Progress -->
                                </div>
            <div class="col-sm-4">
                                    <!-- Tile - Sales -->
                                    <div class="card bg-light-pink   overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-monitor-tablet text-reset text-opacity-75 fs-2 me-2"></i> 
                                              <a href="<?php echo base_url();?>PartMvmtDatewiseDetails" class="customlinks <?php if($pageName=='/PartMvmtDatewiseDetails'){ echo "active";} ?>">Datewise Documents ( For a Part )</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Sales -->
                                </div>
                                <div class="col-sm-4">
                                    <!-- Tile - Sales -->
                                    <div class="card bg-light-pink  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-paper-plane text-reset text-opacity-75 fs-2 me-2"></i> 
                                              <a href="<?php echo base_url();?>OperPerformanceR" class="customlinks <?php if($pageName=='/OperPerformanceR'){ echo "active";} ?>">Operator Performance</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Sales -->
                                </div>
                            </div>
   
   
   <div>
       
       <div class="col-sm-4">
                                    <!-- Tile - Sales -->
                                    <div class="card bg-light-pink  overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-paper-plane text-reset text-opacity-75 fs-2 me-2"></i> 
                                              <a href="<?php echo base_url();?>DPRDeletedEntries" class="customlinks <?php if($pageName=='/DPRDeletedEntries'){ echo "active";} ?>">DPR Del. Entries</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- END : Tile - Sales -->
                                </div>
   </div>
   
   

                        </div>
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

    

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script>

    <!-- Chart JS Scripts [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/chart.js/chart.min.js" defer></script>

    <!-- Initialize [ SAMPLE ] -->
<!--<script src="<?php echo base_url() ?>public/assets/pages/chart.js" defer></script>-->
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>



</body>

</html>