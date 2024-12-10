<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>RM-Purchase Order | Aditya</title>

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
<style>
    .displayNone{
        display:none;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>rm-Purchase-order-data">RM-Purchase Order</a></li>
                            
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
                                <h2 style="width: 87%;">Add RM-Purchase Order</h2><br>
                            <?php }else{?>
                                    <h2 style="width: 87%;">Update RM-Purchase Order</h2><br>
                            <?php } ?>
                            </div>
                                <div class="col-sm-4">

                                        <!-- <select id="example-getting-started" multiple> -->
                                       
                                </div>
                               <!--  <div class="col-sm-4" align="right">
                                     <button class="btn btn-primary mail_draft">Mail Draft</button>
                                </div> -->
                            </div>

                              <?php 
                     
                              if($getTranPoMast['id']==''){ ?>
                                        <?php echo form_open('/AddRmPurchesOrder', array('autocomplete' => 'off')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/UpdateRmPurchesOrder', array('autocomplete' => 'off')); ?>
                                        <input type="hidden" name="editId" value="<?=$getTranPoMast['id'];?>">
                                    <?php } ?>

                            <div class="row">
                                 <div class="col-sm-4">
                                    <label class="form-label">PO ID <label class="mandatory">*</label></label>
                                         <input type="text" readonly name="po_id" value="<?= $getTranPoMast['id']; ?>" class="form-control" placeholder="PO ID">
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Supplier <label class="mandatory">*</label></label>
                                    <?php  $cn= set_value('supplierId'); ?>
                                    <input type="hidden"  name="confirm" id="confirm">
                                      <select id="supplierId" class="form-control" name="supplierId">
                                       
                                            <option value="">Select Supplier</option>
                                            <?php 
                                            if(!empty($Supplier))
                                            {
                                                foreach ($Supplier as $key => $value) 
                                                {
                                                   //$selected = in_array($value['id'],$getTranPoMast) ? 'selected' : "";
                                            ?>
                                                <option <?php if($getTranPoMast['supplier_id']==$value['id']){ echo "selected";} ?> value="<?= $value['id']; ?>" <?php if($cn==$value['id']){ echo "selected";} ?> ><?= $value['name']; ?></option>
                                              
                                            <?php } } ?> 
                                        </select>
                                        <?php echo form_error('supplierId');?>
                                    
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                    <?php $dates = (!empty($getTranPoMast['date'])) ? $getTranPoMast['date'] :  date("Y-m-d"); //echo "#Date#".$dates;  ?>
                                     <input type="date" name="date"  class="form-control"  value="<?php echo $dates; ?>" min="<?php echo $mindate=getMinDate();?>" max="<?php echo $maxdate=getMaxDate();?>">
                                     <?php echo form_error('date');?>
                                 </div>
                                 
                            </div>
                            <br>
                             <div class="row">
                                 <input type="hidden" name="is_openpo" value="N">
                                 <div class="col-sm-4" style="display:none">
                                     <label class="form-label">Is Open PO<label class="mandatory">*</label></label>
                                         <select id="is_assembly"  name="is_openpo" class="form-select">
                                          <option selected value="N" <?= ($getTranPoMast['is_open_po'] == 'N') ? "selected": "" ; ?> >No</option>
                                          <option value="Y" <?= ($getTranPoMast['is_open_po'] == 'Y') ? "selected": "" ; ?> >YES</option>
                                          
                                       </select>
                                    
                                         <!-- <input type="text" name="date" class="form-control" placeholder="PO ID"> -->
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Terms and Conditions <label class="mandatory"></label></label>
                                     <textarea cols="2" class="form-control" name="payment_term"><?php echo set_value('payment_term', $getTranPoMast['payment_terms']); ?></textarea>
                                    
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Remarks<label class="mandatory"></label></label>
                                   <textarea cols="2" name="remark" class="form-control"><?php echo set_value('remark', $getTranPoMast['Remarks']); ?></textarea>
                                 </div>
                                 
                            </div>
                            <br>
                             <?php if(!empty($getRawMaterialbyid)) { ?>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Purchase Order Details Update</h3>(For existing order items)
                           <div style="overflow: auto;">
                            <table id="example1" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th width="15%">Part No</th>
                                        <th>RM ID</th>
                                        <th>RM Name</th>
                                        <th>Quantity</th>
                                        <th>Rate/kg</th>
                                        <th class="displayNone">IGST % </th>
                                        <th class="displayNone">CGST %</th>
                                        <th class="displayNone">SGST %</th>
                                        <th>Branch</th>
                                        <th>Rec. Qty</th>
                                        <th>Open</th>
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php 

                                        $count1=0;
                                        $i=0;
                                       // echo "<pre>";print_r($getRawMaterialbyid);
                                        foreach ($getRawMaterialbyid as $key => $values) 
                                        {   
                                            
                                            //echo "<pre>";print_r($values['open_status']);


                                            //SrNo
                                           
                                            $rm_id = $values['rm_id'];
                                            // $year = $_SESSION['current_year'];

                                            //Row Matterial Name
                                                $RowMatterialName =  $values['name'];

                                            //Reorder Qty
                                                $reorderQty =  ($values['reorderQty'] != 0) ? $values['reorderQty'] : "-";

                                            //Current Stock

                                                  $data = $this->GetQueryModel->getRmStockbyid($rm_id,$_SESSION['current_year']);
                                                
                                                if(!empty($data))
                                                {

                                                    $ob         = $data['ob'];   
                                                    $receipt    = $data['receipt'];   
                                                    $issue      = $data['issue'];  
                                                    $CurrentStk = ($ob + $receipt - $issue);
                                                }
                                                $CurrentStkval = ($CurrentStk != "") ? round($CurrentStk,3) : "-";  

                                            //Planing Requirment Qty

                                                 $res = $this->GetQueryModel->getrmPlanManuQtybyid($rm_id,$dates);
                                                
                                                $result = "-";
                                                if(!empty($res))
                                                {
                                                    $result = $res['plan_req_qty'];
                                                    
                                                }
                                                $PlaningReqQty =  ($result != "") ? $result : "-";
                                                
                                            //Qty
                                                $manual_qty = ($res['manual_qty'] == "") ? "0" : $res['manual_qty'];

                                            //Total
                                                $total =  ($result != "") ? $result + $manual_qty : "-";

                                                $checkboxVal = $values['rm_id']."@".$RowMatterialName."@".$total;
                                                
                                                $RecQty = $this->GetQueryModel->getRecQtyInRCIRStock($values['id']);
                                               
                                                     $count1++;
                                     ?>
                                 
                                    <tr>
                                        <td align="center">
                                            <?= $count1; ?>
                                        </td>
                                        <td  align="center"> 
                                            <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord('<?=$values['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>

                                            <input type="checkbox" disabled checked class="form-check-input" name="checkboxValupdate[]" values="<?= $checkboxVal; ?>" style="display: none;">
                                            <input type="hidden" name="rm_idupdate[]" value="<?= $values['rm_id']; ?>">
                                            <input type="hidden" name="podetail_id[]" value="<?= $values['id']; ?>">
                                        </td>
                                        
                                         <td align="center"> <?php
                                         $partData= $this->GetQueryModel->getPartRmbyid($values['rm_id']);
                                         foreach($partData as $part){
                                             $pdata= $this->GetQueryModel->getPartsById($part['part_id']);
                                             echo $pdata['partno']." </br>";
                                         }  ?>
                                         </td>
                     
                                       <td> <?= $values['rm_id']; ?> </td>
                                       <td> 
                                            <?=$RowMatterialName;?>
                                            <input type="hidden" name="RowMatterialNameupdate[]" value="<?= $RowMatterialName; ?>">
                                        </td> 
                                        <td> 
                                     
                                            <?= $values['ordered_qty']; ?>
                                            <input type="hidden" name="totalqtyupdate[]" value="<?= $values['ordered_qty']; ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="rateupdate[]" value="<?= $values['rate']; ?>" placeholder="Rate">
                                        </td>
                                        <td class="plan_req_qty displayNone" >
                                           <input type="text" class="form-control" value="<?= $values['igst']; ?>" name="igstupdate[]" placeholder="IGST % ">
                                        </td>
                                        <td class="manual_qtytd displayNone">
                                            <input type="text" class="form-control" value="<?= $values['cgst']; ?>" name="cgstupdate[]" placeholder="CGST % ">
                                        </td>
                                        <td class="manual_qtytd displayNone">
                                            <input type="text" class="form-control" value="<?= $values['sgst']; ?>" name="sgstupdate[]" placeholder="SGST % ">
                                        </td>
                                        <td class="manual_qtytd" width="12%">
                                            <select class="form-control" name="branchupdate[]">
                                                
                                                <?php foreach($getBranch as $branch){?>
                                                <option value="<?=$branch['id'];?>" <?php if($values['branch_id']==$branch['id']){echo "selected";} ?>><?=$branch['name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td> <?= $RecQty['received_qty']; ?> </td>
                                        <td width="10%">
                                            <select class="form-control" name="open[]">
                                                <option value='1' <?php if($values['open_status']==1){ echo "selected";} ?> >Open</option>
                                                <option value='0' <?php if($values['open_status']==0){ echo "selected";} ?>>Closed</option>
                                                
                                                
                                            </select>
                                        </td>
                                        

                                     
                                    </tr>
                                    <?php 
                                   
                                } 
                                    ?>
                                </tbody>
                            </table>
</div>

                             <!--<div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary update_btn">Update</button>
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>-->
 <?php } ?>
                            <br>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Purchase Order Details Add</h3> (Add New Items)
    <div style="overflow-y: scroll;">
                            <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                         <?php  if(!empty($_SESSION['oamsg'])) { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['oamsg'];?></div>
                                 <?php   } ?>
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th width="15%">Part No.</th>
                                        <th>RM ID</th>
                                        <th>Raw Material Name</th>
                                        <th>Quantity</th>
                                        <th>Rate/kg</th>
                                        <th class="displayNone">IGST % </th>
                                        <th  class="displayNone">CGST %</th>
                                        <th  class="displayNone">SGST %</th>
                                        <th>Branch</th>
                                        <!--<th>Total</th>-->
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php 
                                        $count1=0;
                                        $i=0;
                                        //	echo "<pre>";print_r($getRawMaterial);	echo "</pre>";
                                        foreach ($getRawMaterial as $key => $value) 
                                        { 

                                            //SrNo
                                           
                                            $rm_id = $value['rm_id'];
                                            // $year = $_SESSION['current_year'];

                                            //Row Matterial Name
                                                $RowMatterialName =  $value['name'];

                                            //Reorder Qty
                                                $reorderQty =  ($value['reorderQty'] != 0) ? $value['reorderQty'] : "-";

                                            //Current Stock

                                                  $data = $this->GetQueryModel->getRmStockbyid($rm_id,$_SESSION['current_year']);
                                                
                                                if(!empty($data))
                                                {

                                                    $ob         = $data['ob'];   
                                                    $receipt    = $data['receipt'];   
                                                    $issue      = $data['issue'];  
                                                    $CurrentStk = ($ob + $receipt - $issue);
                                                }
                                                $CurrentStkval = ($CurrentStk != "") ? round($CurrentStk,3) : "-";  

                                            //Planing Requirment Qty

                                                 $res = $this->GetQueryModel->getrmPlanManuQtybyid($rm_id,$dates);
                                                
                                                $result = "-";
                                                if(!empty($res))
                                                {
                                                    $result = $res['plan_req_qty'];
                                                    
                                                }
                                                $PlaningReqQty =  ($result != "") ? $result : "-";
                                                
                                            //Qty
                                                $manual_qty = ($res['manual_qty'] == "") ? "0" : $res['manual_qty'];

                                            //Total
                                                $total =  ($result != "") ? $result + $manual_qty : "-";

                                                $checkboxVal = $value['rm_id']."@".$RowMatterialName."@".$manual_qty;

                                                if($total > 0 )
                                                {
                                                     $count1++;
                                     ?>
                                        <?php 
                                 
                                   if($manual_qty<=0){ continue; }?> 
                                    <tr>
                                        <td align="center">
                                            <?= $count1; ?>
                                        </td>
                                        <td  align="center"> 
                                            <input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?= $checkboxVal; ?>" >
                                            <input type="hidden" name="rm_id[]" value="<?= $value['rm_id']; ?>">
                                        </td>
                                        
                                       <td align="center"> <?php
                                         $partData= $this->GetQueryModel->getPartRmbyid($value['rm_id']);
                                         foreach($partData as $part){
                                             $pdata= $this->GetQueryModel->getPartsById($part['part_id']);
                                             echo $pdata['partno']." </br>";
                                         }  ?>
                                       </td>
                                         
                                       <td> <?= $value['rm_id']; ?> </td>
                                       <td> 
                                            <?= $RowMatterialName; ?>
                                            <input type="hidden" name="RowMatterialName[]" value="<?= $RowMatterialName; ?>">
                                        </td> 
                                        <td> 
                                            <?= $manual_qty; ?>
                                            <input type="hidden" name="totalqty[]" value="<?= $manual_qty; ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="rate[]" placeholder="Rate" >
                                        </td>
                                        <td class="plan_req_qty displayNone">
                                           <input type="text" class="form-control" name="igst[]" placeholder="IGST % ">
                                        </td>
                                        <td class="manual_qtytd displayNone">
                                            <input type="text" class="form-control" name="cgst[]" placeholder="CGST % ">
                                        </td>
                                        <td class="manual_qtytd displayNone">
                                            <input type="text" class="form-control" name="sgst[]" placeholder="SGST % ">
                                        </td>
                                        <td class="manual_qtytd">
                                            <select class="form-control" name="branch_id[]" class="branch_id">
                                                <?php foreach($getBranch as $branch){?>
                                                <option value="<?=$branch['id'];?>"><?=$branch['name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <!--<td>-->
                                         
                                        <!--</td>-->

                                     
                                    </tr>
                                    <?php 
                                    }   
                                } 
                                    ?>
                                </tbody>
                            </table>
</div>

                            <br>
                            <div class="col-12" >
                            <?php if($_SESSION['branch_id']==1){ ?>
                            <button type="submit" class="btn btn-primary add_btn">Add</button>
                            <?php }else{?>
                           <h4 class="noteTitle">New PO Allowed from Vitthalwadi branch only</h4>
                            <?php } ?>
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


  <!-- Modal -->
<div class="modal fade" id="maildraftmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >

  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="width: 878px; margin-center: 30px; margin-left: -30%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Draft</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%; border: 1px;">
              
                 
                <tbody>
                    <tr>
                        <td>To: <br><br></td>
                        <td><p  id="emailid"></p> </td>

                    </tr>
                     <tr>
                        <td>Subject :</td>
                        <td><input type="text" name="subline" class="form-control"></td>
                    </tr>
                     <tr>
                        <td> <br><br> Body :</td>
                        <td> <br><br>
                            Dear sir,<br>
                            Please give us competitive rates.<br><br>

                            Raw material details are follows.
                            <br><br>
                            <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">Sr.</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Grade</th>
                                      <th scope="col">Length</th>
                                      <th scope="col">Width</th>
                                      <th scope="col">Thikness</th>
                                      <th scope="col">Qty</th>
                                    </tr>
                                  </thead>
                                  <tbody class="tbody">
                                   
                                  </tbody>
                            </table>
                            <p>Regards,<br>

                                Aditya ERP
                                <!-- //Session company name -->
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info">Send</button>
      </div>
    </div>
  </div>
</div>

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
   
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
                                    

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
        var supplierId = $("#supplierId").val();
        var rates = $( "input[name='rate[]']").val();
        if(supplierId!='' && rates!='')
        {
            if (confirm("Sending mail directly to the supplier.?")) 
            {
                $("#confirm").val("yes");
            }else{
                 $("#confirm").val("no");
            }
        }
    });

$('.update_btn').on('click', function()
    {
        var supplierId = $("#supplierId").val();
        var rates = $( "input[name='rate[]']").val();
        if(supplierId!='' && rates!='')
        {
            if (confirm("Sending mail directly to the supplier.?")) 
            {
                $("#confirm").val("yes");
            }else{
                 $("#confirm").val("no");
            }
        }

    });


    var mail_draft = new Array(); 
    
    $('.mail_draft').on('click', function() 
    {
        

       $('input[name="checkboxVal"]:checked').each(function() 
       {
            mail_draft.push($(this).val());
        });

        $.ajax({
               url:"<?php echo base_url(); ?>mailformat",
               method:"POST",
               data:{mail_draft:mail_draft},
               success:function(result)
               {
                    $('#maildraftmodel').modal('show');

                    $(".tbody").append(result);
                    
               }
   });

       $("#emailid").text($("#suppliermail").val()); // 

        // alert(mail_draft);

    });

// manual_qty
$('.manual_qty').on('keyup', function() 
{
        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();

        var mqty = (manualval1 == "-") ? 0 : manualval1;
       
        var totl = (parseInt(mqty) + parseInt(qty) );
        $(this).closest('td').next('td').html(totl);
        

});


    function CloseCustomer(removeNum) 
    {
        location.href = 'rm-Purchase-order-data';

    } 
</script>
</body>

</html>