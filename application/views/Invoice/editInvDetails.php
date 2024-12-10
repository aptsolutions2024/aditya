<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Add Invoice QC | Aditya</title>

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
<style>
.commonTRcolor tr.updateTable{
   background: lightblue !important;
}
table#example1 tr.trHeading{
        background: #25476a;
    color: white;
    font-size: 16px;
}
table#example1 tr.trHeading td{
    padding: 7px;
}
table .alreadyhaving{
    
}
table .nothaving{
    
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('viewInvoice');?>">Invoice</a></li>
                            
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
                          
                             <?php if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success errorMSGtxt" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                    
                           
                             <div class="row">
                              <div class="col-sm-5">
                              
                                    <h2 style="width: 87%;">ADD Invoice QC </h2><br>
                        <br>
                            </div>
                                <div class="col-sm-4">
                                </div>
                                <br>
                            </div>

                              <?php 
                              if($getTranInvMast['id']!=''){ ?>
                                       <?php echo form_open('/addInvQCdetails', array('autocomplete' => 'off')); ?>
                                        <!--<input type="hidden" name="mast_inv_Id" value="<?=$getTranInvMast['id'];?>">-->
                                    <?php } ?>

                            <div class="row">
                                 <div class="col-sm-3">
                                    <label class="form-label">MAST INV ID <label class="mandatory">*</label></label>
                                         <input type="text" readonly name="mast_inv_id" value="<?= $getTranInvMast['id']; ?>" class="form-control" placeholder="MAST_INV_ID">
                                 </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                       <?php $cn= set_value('Customer_Id'); ?>
                                       <select id="Customer_Id" name="Customer_Id" class="form-select" disabled>
                                          <option  value="">Choose...</option>
                                          <?php 
                                         // echo "<pre>";echo $getCustName['name'];echo "</pre>";
                                          foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getTranInvMast['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('Customer_Id');?>
                                    </div>
                                 <div class="col-sm-3">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                    <?php $dates = (!empty($getTranInvMast['date'])) ? $getTranInvMast['date'] :  date("Y-m-d"); //echo "#Date#".$dates;  ?>
                                     <input type="date" name="date"  class="form-control"  value="<?php echo $dates; ?>" min="<?php echo $mindate=getMinDate();?>" max="<?php echo $maxdate=getMaxDate();?>" readonly>
                                     <?php echo form_error('date');?>
                                 </div>
                                  <div class="col-sm-3">
                                    <label class="form-label">Invoice No <label class="mandatory"></label></label>
                                    <input type="text" class="form-control" name="invoice_no" value="<?php echo set_value('invoice_no', $getTranInvMast['invoice_no']); ?>" readonly>
                                 </div>
                                 <br>
                            </div>
                            <br>
                             <?php if(!empty($getTranInvDetail)) { ?>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Invoice Details</h3>
                       
                            <table id="example1" class="display" style="width:100%">
                                <thead>
                                    <tr> 
                                    <th>Action</th>
                                      <th></th>
                                        <th>Sr.No.</th>
                                        <th>Inv_Det_ID</th>
                                        <th>Part Name</th>
                                        <th>Quantity</th>
                                       
                                    </tr>
                                    <br>
                                </thead>
                               
                                <tbody>
                               
                                    <?php 
                                        $count1=0;
                                        $qcid=0;
                                       // echo "<pre>";print_r($getTranInvDetail);echo "</pre>";
                                        foreach ($getTranInvDetail as $key => $values) 
                                        {
                                                     $count1++;
                                                      $partD  = $this->getQueryModel->getPartsById($values['part_id']);
                                     ?>
                                    <tr class="trHeading">
                                        
                                        <td> 
                                        <input type="checkbox" class="form-check-input" name="checkboxValupdate[]" value="<?=$values['invdet_id'];?>" />
                                        <!--    <a class="btn btn-icon btn-sm btn-danger btn-hover" -->
                                        <!--onclick="deleteRecord('<?=$values['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>-->
                                            <input type="hidden" name="inv_det_id[]" value="<?= $values['invdet_id']; ?>">
                                        </td>
                                        <td>
                                          <a target='_blank'  style="color:white" class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('printInvDispatchR');?>?ID=<?php echo base64_encode($values['invdet_id']);?>&PartId=<?php echo base64_encode($values['part_id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>
                                        </td>
                                        <td>
                                            <?= $count1; ?>
                                        </td>

                                       <td> <?= $values['invdet_id']; ?> </td>
                                       <td> 
                                            <?=$values['part_id'];?> - <?=$partD['partno'].' - '.$partD['name'];?>
                                             <!--<input type="hidden" name="part_id[]" value="<?= $values['part_id']; ?>">-->
                                        </td> 
                                        <td> 
                                            <?= $values['qty']; ?>
                                            <!--<input type="hidden" name="inv_qty[]" value="<?= $values['qty']; ?>">-->
                                        </td>
                                    </tr>
                       
                                    <tr >
                                    <td colspan="12">
                                    <table id="" class="display commonTRcolor table-hover "  >
                                        <thead>
                                            <tr>
                                            <th> Quality Name </th>
                                            <th> Std. Value </th>
                                            <th> Min/Max Value</th>
                                            <th colspan="5"> Supp Measurment Result </th>
                                            <th> Status </th>
                                            <th> REM. </th>
                                            </tr>             
                                        </thead>
                                        <tbody>
                                <?php
                                    $sr_no=1;
                                    $getQCByInvDetId = $this->getQueryModel->getQCByInvDetId($values['invdet_id']); 
                                        if(!empty($getQCByInvDetId)){
                                        // echo "<pre>"; print_r($getQCByInvDetId); echo "</pre>";
                                              echo '<input type="hidden" name="editID[]" value="'.$values['invdet_id'].'">';
                                              $readonly='readonly';
                                           foreach($getQCByInvDetId as $key => $qcvalue){ 
                                                 $getQCDetail = $this->getQueryModel->getQualityChecksbyId($qcvalue['quality_id']); 
                                             
                                           ?>
                                            <tr class="updateTable alreadyhaving">
                                               <input type="hidden" name="editQCPDR<?=$qcid;?>[]" value="<?php echo $qcvalue['id'];?>">
                                               <td style="text-transform:uppercase;"><input type="hidden" name="qualid<?=$qcid;?>[]" value="<?php echo $qcvalue['quality_id'];?>"> <?php echo $getQCDetail['name'];?></td>
                                               <td><?php echo $qcvalue['std_value'];?></td>
                                               <td> 
                                               <?php 
                                                    $maxval=$qcvalue['max_value'];
                                                    $minval=$qcvalue['min_value'];
                                                    
                                                        echo "  ".$minval." - ".$maxval;
                                                       ?>                                 
                                                </td>
                                                <?php if($maxval>0 || $minval>0)
                                                     {
                                                        for($i=1;$i<=5;$i++){ ?>
                                                        <td>
                                                            <input type="text" class="form-control" name="R<?=$i.$qcid?>[]" value="<?php echo $qcvalue['reading'.$i];?>"  <?=$readonly;?> >
                                                        </td>
                                                <?php   } //end of for loop
                                                     }
                                                     else{
                                                    for($i=1;$i<=5;$i++){
                                                        $selectOk='';
                                                        $selectNOTk='';
                                                          if($qcvalue['reading'.$i]=='OK'){
                                                                   $selectOk="selected";
                                                               }else{
                                                                 $selectNOTk ="selected"; 
                                                               }
                                                              
                                                    ?>
                                                       <td>
                                                           <!--<select class="form-select" name="R<?=$i.$qcid?>[]" <?=$readonly;?>>-->
                                                           <!--<option value="OK" <?=$selectOk;?>>OK</option>-->
                                                           <!--<option value="NOT OK" <?=$selectNOTk;?>>NOT OK</option>-->
                                                           <!--</select>-->
                                                             <input type="text" class="form-control" name="R<?=$i.$qcid?>[]" value="<?=$qcvalue['reading'.$i];?>" <?=$readonly;?>
                                                    </td>
                                                     <?php   }
                                                   }
                                
                                                    ?>
                                                <td>
                                                    <?php  
                                                    $FRselectOk="";
                                                    $FRselectNOTk="";
                                                    if($qcvalue['final_reading']=='OK'){
                                                                   $FRselectOk="selected";
                                                               }else{
                                                                 $FRselectNOTk ="selected"; 
                                                               }
                                                              
                                                    ?>
                                                    
                                                      <!--<select class="form-select" name="FR<?=$qcid;?>[]" <?=$readonly;?>>-->
                                                      <!--     <option value="OK" <?=$FRselectOk;?>>OK</option>-->
                                                      <!--     <option value="NOT OK" <?=$FRselectNOTk;?>>NOT OK</option>-->
                                                      <!--     </select>-->
                                                           <input type="text" class="form-control" name="FR<?=$qcid;?>[]" value="<?=$qcvalue['final_reading'];?>" <?=$readonly;?>
                                               </td>
                                                <td><input type="text" class="form-control" name="Rem<?=$qcid;?>[]" value="<?=$qcvalue['remark'];?>" <?=$readonly;?>> </td>                   
                                            </tr>                                         
                           <?php $sr_no++; }
                           }else{
                                 $getQCById = $this->getQueryModel->getQCById($values['part_id']); 
                             foreach($getQCById as $key => $qcvalue){               
                               ?>
                                <tr class="nothaving">
                                  
                                   <td><input type="hidden" name="qualid<?=$qcid;?>[]" value="<?php echo $qcvalue['qualityID'];?>"> <?php echo $qcvalue['quality_name'];?></td>
                                   <td><input type="hidden" name="stdval<?=$qcid;?>[]" value="<?php echo $qcvalue['std_value'];?>"><?php echo $qcvalue['std_value'];?></td>
                                   <td> 
                                   <input type="hidden" name="minval<?=$qcid;?>[]" value="<?php echo $qcvalue['min_value'];?>">
                                   <input type="hidden" name="maxval<?=$qcid;?>[]" value="<?php echo $qcvalue['max_value'];?>">
                                   
                                   <?php 
                                        $maxval=$qcvalue['max_value'];
                                        $minval=$qcvalue['min_value'];
                    
                                        $factor=0;
                            
                                          if($maxval>0 || $minval>0){
                    
                                            $_float = explode(".", $maxval);
                                            $decimal=strlen($_float[1]);
                                            if($decimal==3){ $factor=1000;}
                                            if($decimal==2){ $factor=100;}
                                            if($decimal==1){ $factor=10;}
                    
                                            echo "  ".$minval."/".$maxval;
                                             } ?>                                 
                                    </td>
                                     <?php  if($maxval>0 || $minval>0){
                                            for($i=1;$i<=5;$i++){
                                             echo "<td><input class='form-control' type='text' name='R".$i.$qcid."[]' value='".number_format((rand($minval*$factor,$maxval*$factor)/$factor),$qcvalue['numof_decimal'],'.',',')."'></td>";
                                            }
                    
                    
                                       }else{
                                        for($i=1;$i<=5;$i++){?>
                                           <td>
                                               <select class="form-select" name="R<?=$i.$qcid?>[]">
                                               <option value="OK">OK</option>
                                               <option value="NOT OK">NOT OK</option>
                                               </select>
                                        </td>
                                         <?php   }
                                       }
                    
                                        ?>
                                    <td>  <select class="form-select" name="FR<?=$qcid;?>[]">
                                               <option value="OK">OK</option>
                                               <option value="NOT OK">NOT OK</option>
                                               </select>
                                   </td>
                                 
                                      <td><input type="text" class="form-control" name="Rem<?=$qcid;?>[]"> </td>                 
                                </tr>                                         
                           <?php $sr_no++; }
                           }?>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                                    <?php 
                               $qcid++;
                                } 
                                    ?>
                                   
                                </tbody>
                            </table>


                             <!--<div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary update_btn">Update</button>
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>-->
 <?php } ?>
                            <br>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>



                            <br>
                            <div class="col-12" >
                           
                            <button type="submit" class="btn btn-primary add_btn">Save</button>
                         
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
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
$(document).ready(function() 
{
   
   
 $('#example-getting-started').multiselect();
 
  $('#example').DataTable( {
        "paging": false
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
    } );

    $('#example1').DataTable( {
        "paging": false
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
    } );
    setTimeout(function(){
  $('.errorMSGtxt').html('');
}, 5000);
  
} );
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Purchase Order?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteRmOrder",
   method:"POST",
   data:{id:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
}

$('.add_btn').on('click', function()
    {
        var checkedNum = $('input[name="checkboxValupdate[]"]:checked').length;
        if (!checkedNum) {
            // User didn't check any checkboxes
            alert("Check Record for add/update");
            return false;
        }
       
});

function CloseCustomer(removeNum) 
{
        location.href = 'viewInvoice';
} 
</script>
</body>

</html>