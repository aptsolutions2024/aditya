<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Consumables RCIR | Aditya</title>

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
                             <li class="breadcrumb-item active"><a href="<?php echo base_url('ConsumeRCIR');?>">Consumables RCIR</a></li>
                            
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
                                <h2 style="width: 87%;">Add Consumables RCIR</h2><br>
                            <?php }else{?>
                                    <h2 style="width: 87%;">Update Consumables RCIR</h2><br>
                            <?php } ?>
                            </div>
                                <div class="col-sm-4">

                                        <!-- <select id="example-getting-started" multiple> -->
                                       
                                </div>
                               <!--  <div class="col-sm-4" align="right">
                                     <button class="btn btn-primary mail_draft">Mail Draft</button>
                                </div> -->
                            </div>

                             
                                        <?php echo form_open('/createConsumRCIR', array('autocomplete' => 'off')); ?>
                                    

                            <div class="row">
                                 
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Supplier <label class="mandatory">*</label></label>
                                      <select id="supplierId"  class="form-control alltxtUpperCase" name="supplierId" onChange="getRCIRQty(this.value);">
                                       <?php $getTranPoMast = set_value('supplierId'); ?>
                                            <option value="">Select Supplier</option>
                                            <?php 
                                            if(!empty($Supplier))
                                            {
                                                foreach ($Supplier as $key => $value) 
                                                {
                                                   
                                            ?>
                                                <option <?php if($getTranPoMast == $value['id']) {echo "selected";} ?> value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                              
                                            <?php } } ?> 
                                        </select>
                                    
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                      <?php $seldate=date('Y-m-d'); ?>
                                    <input type="date" name="date"  class="form-control" value="<?php echo set_value('date',$seldate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                    <?php echo form_error('date');?>
                                 </div>
                                 
                                 
                            </div>
                            <br>
                             <div class="row">
                                 <div class="col-sm-4">
                                     <label class="form-label">Ref. PO<label class="mandatory">*</label></label>
                                     <?php $ref_po = set_value('ref_po') ?>
                                         <select id="ref_po"  name="ref_po" class="form-select">
                                          <option selected value="N" <?= ($ref_po == 'N') ? "selected": "" ; ?> >No</option>
                                          <option value="Y" <?= ($ref_po == 'Y') ? "selected": "" ; ?> >YES</option>
                                          
                                       </select>
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Supplier Challan No. <label class="mandatory"></label></label>
                                     <input type="text" class="form-control" name="supplier_challan_no" value="<?php echo set_value('supplier_challan_no') ?>">
                                    <?php echo form_error('supplier_challan_no');?>
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Supplier Challan Date <label class="mandatory"></label></label>
                                     <input type="date" class="form-control" name="supplier_challan_date" value="<?php echo set_value('supplier_challan_date') ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                    <?php echo form_error('supplier_challan_date');?>
                                 </div>
                                 </div>
                                 <br>
                             <div class="row">
                                 <div class="col-sm-12">
                                    <label class="form-label">Remarks</label>
                                   <textarea cols="2" name="remark" class="form-control" ><?php echo set_value('remark') ?></textarea>
                                 </div>
                                 
                            </div>
                            
                            <br>
                             <?php   if(!empty(getConsumpoDetailsBySupl)) { ?>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Part RCIR</h3>(For New order items)
                              <div style="overflow: auto;">
                            <table id="example1" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th>Description</th>
                                        <th>Ord. Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Igst%</th>
                                        <th>SGST%</th>
                                        <th>CGST%</th>
                                        <th>Received Qty</th>
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php for( $i = 0; $i < sizeof($getConsumpoDetailsBySupl); $i++) { ?>
                                    <tr>
                                        <td > 1 </td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['description'];?></td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['qty'];?></td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['uom'];?> </td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['rate'];?> </td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['igst'];?> </td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['sgst'];?> </td>
                                        <td > <?=$getConsumpoDetailsBySupl[$i]['cgst'];?> </td>
                                        <td > 
                                         <input id="Operation_Name" name="Operation_Name" type="text" value='125' class="form-control" placeholder="Quantity" >
                                        </td>
                          
                                     
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

</div>
                             <div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
 <?php } ?>
                            <br>
                            
                            
                            
                            
                            
                            <br>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <?php 
                                if(!empty($_SESSION['oamsg'])) { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['oamsg'];?></div>

                                 <?php   } ?>

                            
                               
                                <div class="col-md-12 " id="RCIRQty" style="overflow: auto;"></div>
                            


                            
                            
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
    

    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script> -->

<script>
$( document ).ready(function() {
    var supId = '<?=$getTranPoMast;?>';
    if(supId !='')
    {
    getRCIRQty(supId);
    }
});
function getRCIRQty(supId)
{
$.ajax({
   url:"<?php echo base_url(); ?>getRCIRQty",
   method:"POST",
   data:{supId:supId},
   success:function(result)
   {
    //console.log(result);
    $("#RCIRQty").html(result);
   }
   });
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