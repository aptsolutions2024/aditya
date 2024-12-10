<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View RM-RCIR Stock Details | Aditya</title>

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
    .table thead th {
    color: #232324;
    font-weight: 500;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                             <li class="breadcrumb-item"><a href="<?php echo base_url('RMRCIR');?>">RM RCIR</a></li>
                            
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
 

                            <div class="row">
                            <h2 style="width: 82%;">RM-RCIR Details Stock : <?php echo $id = base64_decode($_GET['ID']);?></h2>
                            <hr>
                            </div>
                            <br>  
                         
                         <?php   if(!empty($getRMRCIRDetailsStock)){ ?>
                            <div class="row">
                                 <div class="col-sm-3">
                                      <?php 
                                      $supplierD=  $this->GetQueryModel->getSupplierById($getRMRCIRDetailsStock[0]['supplier_id']);

                                    ?>
                                    <label class="form-label">Supplier Name</label>
                                    
                                   <input type="text" class="form-control" name="suppliername" value="<?php echo $supplierD['name']; ?>" readonly>
                                    
                                 </div>
                                 <div class="col-sm-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date"  class="form-control" value="<?php echo $getRMRCIRDetailsStock[0]['date']; ?>" readonly>
                        
                                 </div>
                                  <div class="col-sm-3">
                                    <label class="form-label">Supplier Challan No.</label>
                                     <input type="text" class="form-control" name="supplier_challan_no" value="<?php echo $getRMRCIRDetailsStock[0]['challan_no']; ?>" readonly>
                                   
                                 </div>
                                    <div class="col-sm-3">
                                    <label class="form-label">Supplier Challan Date </label>
                                     <input type="date" class="form-control" name="supplier_challan_date" value="<?php echo $getRMRCIRDetailsStock[0]['challan_date']; ?>" readonly>
                                   
                                 </div>
                                
                            </div><br>
                               <div class="row">
                                      <div class="col-sm-3">
                                    <label class="form-label">RM ID </label>
                                     <input type="text" class="form-control" name="supplier_challan_date" value="<?php echo $getRMRCIRDetailsStock[0]['rm_id']; ?>" readonly>
                                 </div>
                                  <div class="col-sm-3">
                                    <label class="form-label">RM Name </label>
                                    <?php 
                                      $rmdata = $this->GetQueryModel->getRawMaterialbyrmid($getRMRCIRDetailsStock[0]['rm_id']);
                                    ?>
                                     <input type="text" class="form-control" name="supplier_challan_date" value="<?php echo $rmdata['name']; ?>" readonly>
                                 </div>
                               </div><hr>
                               <br>
                            <table id="" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <!--<th>DET RCIR ID</th>-->
                                          <th>Branch ID</th>
                                        <th>Rec. Qty</th>
                                        <th>Rec. Doc Type</th>
                                        <th>Rec. Doc Id</th>
                                        <th>Used Qty</th>
                                        <th>Used Doc Type</th>
                                        <th>Used Doc Id</th>
                                        <!--<th>Booked Qty</th>-->
                                        <!--<th>Booked Doc Type</th>-->
                                        <!--<th>Booked Doc Id</th>-->
                                        <th>Rej. Qty</th>
                                        <th>Rej. Doc Type</th>
                                        <th>Rej. Doc Id</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 // echo "<pre>";print_r($getRMRCIRDetailsStock);echo "<pre>";
                                        $count=0;
                                        $totalIss=0;$totalRec=0;$totalbooked=0;$totalrej=0;
                                        
                                        $det_rmrcir_id=$getRMRCIRDetailsStock[0]['det_rmrcir_id'];
                                        $mast_rmrcir_id=$getRMRCIRDetailsStock[0]['mast_rmrcir_id'];
                                        $tran_rmpo_det_id=$getRMRCIRDetailsStock[0]['tran_rmpo_det_id'];
                                        $rm_id=$getRMRCIRDetailsStock[0]['rm_id'];
                                        
                                foreach ($getRMRCIRDetailsStock as $key => $value) { 
                                            $count++;
                                          $branchD = $this->GetQueryModel->getBranchbyId($value['branch_id']);
                                     ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td><?=$branchD['name'];?></td>
                                          <td ><?=$value['received_qty'];
                                        $totalRec=($totalRec+$value['received_qty']);
                                        ?></td>
                                        <td ><?=$value['received_doc_type'];?></td>
                                        <td ><?=$value['received_doc_id'];?></td>
                                        <td><?=$value['issue_qty'];
                                        $totalIss=($totalIss+$value['issue_qty']);
                                        ?></td>
                                        <td><?=$value['issue_doc_type'];?></td>
                                        <td><?=$value['issue_doc_id'];?></td>
                                         <!--<td>-->
                                       <!--//$value['booked_qty'];-->
                                       <!-- //   $totalbooked=($totalbooked+$value['booked_qty']);-->
                                      
                                         <!--</td>-->
                                        <!--<td ><?=$value['booked_doc_type'];?></td>-->
                                        <!-- <td ><?=$value['booked_doc_id'];?></td>-->
                                       
                                        <td ><?=$value['rejected_qty'];
                                        $totalrej=($totalrej+$value['rejected_qty']);
                                        ?></td>
                                        <td ><?=$value['rejected_doc_type'];?></td>
                                        <td ><?=$value['rejected_doc_id'];?></td>
                                    </tr>
                                    <?php }                             ?>
                                </tbody>
                            </table>
                                <table id="" class="table" style="width:100%">
                                <tbody>
                                      <tr>
                                         <td>Total Received Qty</td>
                                         <td><input class="form-control" type="text" name ="received_qty"  value="<?=$totalRec;?>" readonly></td>
                                         <td>Total Used Qty</td>
                                         <td><input class="form-control" type="text" name ="issue_qty"  value="<?=$totalIss;?>" readonly></td>
                                         <!--<td>Total Booked Qty</td>-->
                                         <!--<td><input class="form-control" type="text" name ="booked_qty"  value="<?=$totalbooked;?>" readonly></td>-->
                                           <td>Total Scrap Qty</td>
                                         <td><input class="form-control" type="text" name ="rejected_qty"  value="<?=$totalrej;?>" readonly></td>
                                    </tr>
                                   
                                </tbody>
                            </table><hr>
                             <table id="" class="table" style="width:100%">
                                <tbody>
                            <tr><?php $totcolor=round($totalRec-$totalIss-$totalrej,3);?>
                                    <h4>Total Balance Quantity : <?php echo $totalRec." - ".$totalIss." - ".$totalrej." = ";
                                    if($totcolor<0){
                                        echo "<span style='color:red;'>".$totcolor."</span>";
                                    }else{
                                          echo "<span style='color:green;'>".$totcolor."</span>";
                                    };?> </h4>
                             </tr>
                              </tbody>
                            </table><hr>
                                <table id="" class="table" style="width:100%">
                                <thead>
                                    <tr><h2>Stock Adjustment : <h2></tr>
                                      <p  style="color:red;text-transform:capitalize;">To reduce the stock in the system, please enter negative(-) adjustment quantity.
                                        <br>To increase the stock in the system, please enter positive(+) adjustment quantity. </p>
                                </thead>
                                <tbody>
                                 
                                    
                        <?php echo form_open('/RMStockAdjustment', array('autocomplete' => 'off','class' => 'row g-3'));?> 
                        <input type="hidden" name ="date"  value="<?php echo $getRMRCIRDetailsStock[0]['date']; ?>" >
                                
                          <?  if(!empty($rmstockAdjustDet)){ 
                                        $det_rmrcir_id=$rmstockAdjustDet['det_rmrcir_id'];
                                        $mast_rmrcir_id=$rmstockAdjustDet['mast_rmrcir_id'];
                                        $tran_rmpo_det_id=$rmstockAdjustDet['tran_rmpo_det_id'];
                                        $rm_id=$rmstockAdjustDet['rm_id'];
                                        $totalIss=$rmstockAdjustDet['issue_qty'];
                                        $totalRec=$rmstockAdjustDet['received_qty'];
                                        $totalrej=$rmstockAdjustDet['rejected_qty'];
                                        
                                        
                                      ?>
                                         <input type="hidden" name ="editid"  value="<?=$rmstockAdjustDet['id'];?>" >
                                         
                             <?php }else{
                                  $adjQty=$totalRec-$totalIss-$totalrej; 
                                            if($adjQty>0){
                                               $totalIss=$adjQty;
                                               $totalRec=0;
                                            }else if($adjQty<0){
                                                $totalRec=$adjQty;
                                                $totalIss=0;
                                            }else{
                                                $totalIss=0;
                                                $totalRec=0;
                                            }
                             }     ?>
                             
                          
                               <tr>
                                     
                                        <input type="hidden" name ="det_rmrcir_id"  value="<?=$det_rmrcir_id;?>" >
                                        <input type="hidden" name ="mast_rmrcir_id"  value="<?=$mast_rmrcir_id;?>" >
                                        <input type="hidden" name ="tran_rmpo_det_id"  value="<?=$tran_rmpo_det_id;?>" >
                                        <input type="hidden" name ="rm_id"  value="<?=$rm_id;?>" >
                                         <!--<td>Received Qty</td>-->
                                         <!--<td><input class="form-control" type="text" name ="received_qty"  value="<?=$totalRec;?>" ></td>-->
                                            <td>Adjustment Qty</td>
                                         <td><input class="form-control" type="text" name ="issue_qty"  value="<?=$totalRec;?>" ></td>                                         
                                         <td>Scrap Qty</td>
                                         <td><input class="form-control" type="text" name ="rejected_qty"  value="<?=$totalrej;?>" ></td>
                                         
                                  <?php   if(!empty($rmstockAdjustDet)){ ?>
                                    <td><button type="submit" class="btn btn-primary submit" >Update</button></td>
                                    <?php }else{ ?>
                                      <td><button type="submit" class="btn btn-primary submit" >ADD</button></td>
                                    <?php } ?>
                                </form> 
                                     
                                    </tr>
                                </tbody>
                            </table>
                            <?php }else{?>
                            <h3 style="text-align:center;color:red;">No Stock Details Found for this RM-RCIR</h3>
                           <?php } ?>

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
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
  } );
</script>
</body>

</html>