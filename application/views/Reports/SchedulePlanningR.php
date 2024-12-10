<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Schedule Planning Details | Aditya</title>

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

    <style>
   /*     table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px;
    font-size: 15px;
}*/
td span.rctitle{
  float: left;
}
td span.rcvalue{
    float: right;
}
tr.summaryLine1{
    background-color: lightblue;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('schedulePlanning');?>">Schedule Planning</a></li>
                            
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

                        <div class="row"><h2 style="width: 82%;">Schedule Planning Details</h2> </div>

                            
                            <div>
                            <table id="example" class="display table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Docno</th>
                                        <th>DocType</th>
                                        <th>Supplier Name</th>
                                        <th>Operation Name</th>
                                        <th>Date</th>
                                        <th>Qty</th>                                     
                                        <th>Bal Qty</th>
                                        <!-- <th colspan="8">Rec. details</th>     -->
                                    </tr>
                                </thead>
                                <tbody>
                            <?php    //echo "<pre>"; print_r($SSDetails);echo "</pre>";
                             $count=0;
                            foreach ($SSDetails as $key => $value) {    $count++; ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td><?=$value['suppSID'];?></td>
                                        <td>Supp.Sch.</td>
                                        <td ><?=$value['supplier_name'];?></td>
                                        <td ><?=$value['op_name'];?></td>
                                        <td ><?=$value['SDate'];?></td>
                                        <td ><?=$value['Sqty'];?></td>
                                        <td> 0</td>
                                    </tr>
                                    <?php   
                                                      
                                $getSRCIR = $this->getQueryModel->getSSchRCIRDetails($value['suppSID']);
                         
                                    if(!empty($getSRCIR)){
                                    $totRecieved=0;   
                                    $totLoss=0; 
                                    foreach($getSRCIR as $key=>$prcir){ 

                                        ?>
                                     <tr>                                              
                                                <td colspan="6"><span class="rcvalue"> RCIR Details </span></td>                                          
                                                <td colspan="4">
                                                <span class="rctitle">Part-RCIR : </span><span class="rcvalue"><?=$prcir['prcir_id'];?></span><br>
                                                <span class="rctitle">Recieved Qty : </span><span class="rcvalue"><?=$prcir['recQty'];?></span><br>
                                                <span class="rctitle">Date : </span><span class="rcvalue"><?=$prcir['date'];?></span><br>
                                                <span class="rctitle">Inprocess loss Qty: </span><span class="rcvalue"><?=$prcir['inprocess_loss_qty'];?></span>
                                                 </td>
                                     </tr>
                                   
                                    <?php $totRecieved=$totRecieved+$prcir['recQty'];
                                          $totLoss=$totLoss+$prcir['inprocess_loss_qty'];
                                      } ?>
                                      <tr class="summaryLine1">
                                        <td colspan="2"><span class="rctitle">DOC. QTY : </span><span class="rcvalue"><?=$value['Sqty'];?></span></td> 
                                        <td colspan="2"><span class="rctitle">TOT.REC QTY : </span><span class="rcvalue"><?=$totRecieved;?></span></td> 
                                        <td colspan="2"><span class="rctitle">TOT.LOSS QTY : </span><span class="rcvalue"><?=$totLoss;?></span></td>
                                        <td colspan="2"><span class="rctitle">BAL QTY : </span><span class="rcvalue"><?=($value['Sqty']-$totRecieved-$totLoss);?></span></td>
                                      </tr>
                                  <?php }
                                      // Start of DC Details                                 
                                  $SchDCDetails = $this->getQueryModel->getSchDCDetails($value['part_id']);
                                     //print_r($SchDCDetails);
                                  foreach($SchDCDetails as $key=>$DCdet){     ?>                               
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td><?=$DCdet['dcid'];?></td>
                                        <td>Deli.Chln</td>
                                        <td ><?=$dcdet['supplier_name'];
                                         $getSupplier = $this->getQueryModel->getSupplierById($DCdet['supplier_id']);
                                                echo $getSupplier['name'];
                                            ?>
                                        </td>
                                        <td ><?php 
                                                $getOperation = $this->getQueryModel->getOperation($DCdet['op_id']);
                                                echo $getOperation['name'];

                                              ?></td>
                                        <td ><?=$DCdet['date'];?></td>
                                        <td ><?=$DCdet['qty'];?></td>
                                        <td> 0</td>
                                    </tr>
                                   <?php 
                                   if($DCdet['dcid']){ $getDcRCIRDetails = $this->getQueryModel->getSchDcRCIRDetails($DCdet['dcid']);}
                                        // print_r($getDcRCIRDetails);
                                    if(!empty($getDcRCIRDetails)){
                                    $totRecieved=0;   
                                    $totLoss=0; 
                                    foreach($getDcRCIRDetails as $key=>$DCrcir){ ?>
                                     <tr>                                              
                                                <td colspan="6"><span class="rcvalue"> RCIR Details </span></td>                                          
                                                <td colspan="4">
                                                <span class="rctitle">Part-RCIR : </span><span class="rcvalue"><?=$DCrcir['prcir_id'];?></span><br>
                                                <span class="rctitle">Recieved Qty : </span><span class="rcvalue"><?=$DCrcir['recQty'];?></span><br>
                                                <span class="rctitle">Date : </span><span class="rcvalue"><?=$DCrcir['date'];?></span><br>
                                                <span class="rctitle">Inprocess loss Qty: </span><span class="rcvalue"><?=$DCrcir['inprocess_loss_qty'];?></span>
                                                 </td>
                                     </tr>
                                   
                                    <?php
                                          $totRecieved=$totRecieved+$DCrcir['recQty'];
                                          $totLoss=$totLoss+$DCrcir['inprocess_loss_qty'];
                                      }?>
                                    <tr class="summaryLine1">
                                        <td colspan="2"><span class="rctitle">DOC. QTY : </span><span class="rcvalue"><?=$DCdet['qty'];?></span></td> 
                                        <td colspan="2"><span class="rctitle">TOT.REC QTY : </span><span class="rcvalue"><?=$totRecieved;?></span></td> 
                                        <td colspan="2"><span class="rctitle">TOT.LOSS QTY : </span><span class="rcvalue"><?=$totLoss;?></span></td>
                                        <td colspan="2"><span class="rctitle">BAL QTY : </span><span class="rcvalue"><?=($DCdet['qty']-$totRecieved-$totLoss);?></span></td>
                                    </tr>
                                   <?php    }
                                 }
                                   } ?>
                                </tbody>
                            </table>
                    
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

<script>




</script>
</body>

</html>