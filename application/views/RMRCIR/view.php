<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View RM RCIR | Aditya</title>

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
        
         table.commontoggle tr td.details-control {
    background: url('<?php echo base_url() ?>public/assets/img/details_open.png') no-repeat center center;
    cursor: pointer;
    }
  table.commontoggle  tr.shown td.details-control {
        background: url('<?php echo base_url() ?>public/assets/img/details_close.png') no-repeat center center;
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
                            <h2 style="width: 80%;">RM RCIR</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url();?>addRMRCIR"><button type="button" class="btn btn-secondary" style="float: right;">Add RM RCIR</button></a>
                             </div>
                             </div>
                                  
                                <?php echo form_open('/RMRCIR', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                   
                                    <div class="col-md-3" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                    <?php $seldate=(set_value('date'))?set_value('date'):''; ?>    
                                       <input id="date" name="date" type="month" class="form-control" value="<?=$seldate;?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                    <div class="col-2" style="margin-top: 17px;">
                                    <button type="submit" class="btn btn-primary submit" >Show</button>
                                    </div>
                                </form>   
                             
                           <br>
                            <div style="overflow: auto;">
                            <table id="example" class="display commontoggle" style="width:100%">
                                <thead>
                                    <tr>
                                       
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Supplier Name</th>
                                        <th>Challan No.</th>
                                        <th>Challan Date</th>
                                        <th>Part No.</th>
                                        <th>RM Name</th>
                                        <th>QTY</th>
                                      <!--  <th>Used QTY</th>-->        
                                      <th>Bal Qty</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    //error_reporting(E_ALL);
                                        $count=0;
                                        foreach ($getRMRCIR as $key => $value) { 
                                            
                                            $count++;
                                            $sData = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
                                            $RMD  = $this->GetQueryModel->getrmById($value['rm_id']);
                                        //   $stk_adj_cnt='';
                                        //   $no_stk_adj_cnt='';
                                		      //$stkdata = $this->GetQueryModel->getStockAdjcnt($value['id']); 
                                		      //$no_stkdata = $this->GetQueryModel->getNOStockAdjcnt($value['id']); 
                                		      //if(!empty($stkdata)){
                                		      //   $stk_adj_cnt=$stkdata['stk_adj_cnt'];
                                		      //}
                                		      // if(!empty($no_stkdata)){
                                		      //   $no_stk_adj_cnt=$no_stkdata['no_stk_adj_cnt'];
                                		      // }
                                		         //   $usedqty  = $this->GetQueryModel->getRMUsedQty($value['det_id']);
                                		           
                                		           
                                		            $balqty  = $this->GetQueryModel->getRMBalQty($value['det_id']);
                                		            
                                		  
                                     ?>
                                    <tr class="" id="detailrow<?=$value['id'];?>">
                                      
                                        <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url();?>addRMRCIR?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        </td>
                                        <td ><?=$value['id']." - ".$value['det_id'];?></td>
                                        <td><?=$sData['name'];?></td>
                                        <td><?=$value['challan_no'];?></td>
                                        <td><?=date("d-m-Y",strtotime($value['challan_date']));?></td>
                                            <td align=""> <?php
                                             // print_r($value);
                                             $partData= $this->GetQueryModel->getPartRmbyid($value['rm_id']);
                                             foreach($partData as $part){
                                                 $pdata= $this->GetQueryModel->getPartsById($part['part_id']);
                                                
                                                 echo $pdata['partno']." </br>";
                                                 // echo "RM_ID-".$value['rm_id'];
                                                  
                                             }  ?>
                                        </td>
                                        <td><?=$value['rm_id']." - ".$RMD['name'];?></td>
                                        <td><?=number_format($value['qty'],3);?></td>
                                       <!-- <td><?=number_format($usedqty,3);?></td>-->
                                        <td><?=number_format($balqty,3);?></td>
                                        <td style="width: 12%;">
                                            <button class="btn btn-primary"><a class="" style="color: white;" href="<?php echo base_url();?>RMRCIRDetailsStock?ID=<?php echo base64_encode($value['det_id']); ?>">Stock Details</a></button>
                                        </td>
                                        
                                    </tr>
                                  <?php 
                                     } //end for loop
                                     ?>
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

    <?php  $this->load->view('/include/jsPage'); ?>
    
<script>

function deleteRecord(editId)
{
if (confirm("Are you sure delete this user?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteRecord",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
   location.reload();
   }
   });
}
}
function toggleTable(num){
    $("#collapse"+num).toggle();
     $("tr#detailrow"+num).toggleClass("shown");
}
</script>
</body>

</html>