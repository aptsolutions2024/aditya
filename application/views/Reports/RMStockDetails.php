<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View RM Stock Details | Aditya</title>

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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
.select2-container .select2-selection--single{
    display: block;
    width: 100%;
   padding: 1.1rem 1rem;
    font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.07);
    appearance: none;
    border-radius: 0.4375rem;
    box-shadow: inset 0 1px 2px rgb(55 60 67 / 8%);
    transition: border-color .35s ease-in-out,box-shadow .35s ease-in-out;
        border: 1px solid rgb(55 60 67 / 25%);
 }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    line-height: 11px !important;
    text-transform:uppercase !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 37px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 0px !important;
    overflow: visible !important;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('RMStockDetails');?>">RMStockDetails</a></li>
                            
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

                             <?php  error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>    

                            <div class="row">
                            <h2 style="width: 82%;">RM Stock Details</h2>
                            
                            </div>

                            <?php echo form_open('/RMStockDetails', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    
                            <input type="hidden" id="formSubmitFlag" value="<?=$formSubmitFlag;?>" >
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
                                       <label class="form-label">Select Branch<label class="mandatory">*</label></label>
                                        <?php $getBranchval = set_value('branch_id'); ?>
                                            <select id="branch_id" name="branch_id" class="form-select" >
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getBranchval==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                            </div>
                             <div class="col-md-3">
                                       <label class="form-label">Raw Material</label>
                                       <?php $getRMVal = set_value('rm_id'); ?>
                                            <select id="rm_id" name="rm_id" class="form-select">
                                                <option value="">Select RM</option>
                                                <?php foreach($getRawMaterial as $rm){ ?>                                              
                                                <option value="<?=$rm['rm_id'];?>" <?php if($getRMVal == $rm['rm_id']) {echo "selected";} ?> ><?=$rm['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('rm_id');?>
                            </div>

                            <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                             </div>
                                        
                        </form>

                        <br><br>
                            
                            <div style="overflow-x: scroll;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Part No</th>
                                        <th>Suppl Name</th>
                                        <th>Challan No.</th>
                                        <th>Challan Date</th>
                                        <th>Issue Qty</th>
                                        <th>Issue Doc Type</th>
                                        <th>Issue Doc Id</th>
                                        <th>Issue Date</th>
                                        <!--<th>Booked Qty</th>-->
                                        <!--<th>Booked Doc Type</th>-->
                                        <!--<th>Booked Doc Id</th>-->
                                        <th>Received Qty</th>
                                        <th>Received Doc Type</th>
                                        <th>Received Doc Id</th>
                                        <th>Rejected Qty</th>
                                        <th>Rejected Doc Type</th>
                                        <th>Rejected Doc Id</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    //echo "<pre>";print_r($RMStockDetails);
                                        $count=0;
                                        $totIss=0;$totRece=0;$totRej=0;$totBook=0;
                                        foreach ($RMStockDetails as $key => $value) { 
                                            $count++;
                                        
                                      //  $rmdata = $this->getQueryModel->getRawMaterialbyrmid($value['rm_id']);
                                         //  $brData = $this->getQueryModel->getBranchbyId($value['branch_id']);
                                         $supplierD=  $this->getQueryModel->getSupplierById($value['supplier_id']);
                                     ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                         <td align="center"> <?php
                                         $partData= $this->getQueryModel->getPartRmbyid($value['rm_id']);
                                         foreach($partData as $part){
                                             $pdata= $this->getQueryModel->getPartsById($part['part_id']);
                                             echo $pdata['partno']." </br>";
                                         }  ?>
                                         </td>
                                        <td><?=$supplierD['name'];?></td>
                                        <td><?=$value['challan_no'];?></td>
                                        <td><?=date('d-m-Y',strtotime($value['challan_date']));?></td>
                                        <td><?=($value['issue_qty'])?$value['issue_qty']:" - ";
                                        $totIss=$totIss+$value['issue_qty'];
                                        ?></td>
                                        <td><?=$value['issue_doc_type'];?></td>
                                        <td><?=$value['issue_doc_id'];?></td>
                                           <td><?=date('d-m-Y',strtotime($value['tran_date']));?></td>
                                        <!--<td>-->
                                         <?php // ($value['booked_qty'])?$value['booked_qty']:" - ";
                                        // $totBook=$totBook+$value['booked_qty'];?>
                                        <!--</td>-->
                                        <!--<td ><?=$value['booked_doc_type'];?></td>-->
                                        <!--<td ><?=$value['booked_doc_id'];?></td>-->
                                        <td><?=($value['received_qty'])?$value['received_qty']:" - ";
                                        $totRece=$totRece+$value['received_qty'];
                                        ?></td>
                                        <td><?=$value['received_doc_type'];?></td>
                                        <td><?=$value['received_doc_id'];?></td>
                                         <td><?=($value['rejected_qty'])?$value['rejected_qty']:" - ";
                                         $totRej=$totRej+$value['rejected_qty'];
                                         ?></td>
                                        <td><?=$value['rejected_doc_type'];?></td>
                                        <td><?=$value['rejected_doc_id'];?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                         
                            </div>
                               <table class="table table_stripped">
                                <tr>
                                    <th>Total Recieved Qty</th>
                                    <th>Total Issue Qty</th>
                                    <th>Total Rejected Qty</th>
                                    <!-- <th>Final Stock</th>-->
                                     <!--<th>Total Booked Qty</th>-->
                                </tr>
                                <tr>
                                    <td style="color: green;font-size: 24px;"><?=round($totRece,2);?></td> 
                                    <td style="color: red;font-size: 24px;"><?=round($totIss,2);?></td>
                                    <td style="color: red;font-size: 24px;"><?=round($totRej,2);?></td>
                                    <!--<td style="color: green;font-size: 24px;"><?=round(($totRece-$totIss-$totRej),2);?></td>
                                    <td style="font-size: 24px;"><?=$totBook;?></td>-->
                                </tr>
                            </table>

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    
       $('select#rm_id').select2();
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
 var schedule_date =$("#schedule_date").val();    
 if(schedule_date=='')
 {
var monthControl = document.querySelector('input[type="month"]');
var date= new Date();
var month=("0" + (date.getMonth() + 1)).slice(-2);
var year=date.getFullYear();
monthControl.value = `${year}-${month}`;
 showSch();
}
} );

function showSch()
{
    var formSubmitFlag =$("#formSubmitFlag").val();
    if(formSubmitFlag==0 || formSubmitFlag=='')
    {
    var frm = document.getElementById("formSch");
    frm.submit();
    }
    //window.location.href = "<?php echo base_url(); ?>schedule";
}
function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteOptsRecord",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
   location.reload();
   }
   });
}
}
</script>
</body>

</html>