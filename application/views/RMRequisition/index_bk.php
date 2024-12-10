<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title> RM-Requisition</title>

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

    <style type="text/css">
      .visible {
  height: 3em;
  width: 10em;
  background: yellow;
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
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>rm-equisition">RM-Requisition</a></li>
                            
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
                            <h2 style="width: 87%;">RM-Requisition</h2>
                            </div>
                             <?php echo form_open('/rm-equisition', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                   
                                    <div class="col-md-3" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                        <?php $setdate=(set_value('date'))?set_value('date'):date('Y-m');?>
                                       <input id="date" name="date" type="month" class="form-control" value="<?=$setdate;?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                    <div class="col-2" style="margin-top: 17px;">
                                    <button type="submit" class="btn btn-primary submit" >Show</button>
                                    </div>
                                </form>   
                             
                           <br>
                            <div style='overflow:auto'>
    <?php echo form_open('/updateEquisitionNew', array('autocomplete' => 'off','class' => 'row g-3')); ?>
      <input type="hidden" name="selectdate" value="<?= $setdate; ?>">
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
            <thead>
                <tr>
                                <th>Planing Requirment Qty</th>
                    <th  align="center"></th>
        
                    <th width="15%">Part No</th>
                    <th>RM Id</th>
                    <th>Raw Material Name</th>
                    <th>Bin Qty</th>
                    <th>Available Stock As On Today</th>
                 
                    <th>New Order Qty</th>
                    <th align="right">Reserve Qty</th>
                    <th align="right">PO Status</th>
                   
                </tr>
            </thead>
             <?php // echo form_open('/addProdPlanningNew'); ?>
            <tbody>
                <?php 
                    $count=0;
                    foreach ($getRawMaterial as $key => $value) 
                    {
                        
                        
                        //print_r($value);
                        $resPo = $this->GetQueryModel->getPoQtybyRmId($value['rm_id'],$_SESSION['current_year']);
                        //$resPoNew = $this->GetQueryModel->getPoQtybyTranRMPoId($value['rm_id'],$_SESSION['current_year']);
                        $resPoNew = $this->GetQueryModel->getPoQtybyTranRMPoId($value['rm_id'],$_SESSION['current_year']);
                        $POStatus = $this->GetQueryModel->getPOStatusInRequ($value['rm_id']);

                    $flag=(!empty($resPoNew['po_qty']) || $resPoNew['po_qty']==0) ? round($resPoNew['po_qty'],3) : $resPo['pending_qty'];


                        $count++;
                        $rm_id = $value['rm_id'];
                        $rm_name = $value['name'];
                        // $year = $_SESSION['current_year'];
                        //$colorPo = (!empty($resPo['pending_qty'])) ? "#26a69a52" : "";
                       // $colorPo = ($flag) ? "#26a69a52" : "";
                        $colorPo = ($POStatus['open_status']==1) ? "#26a69a52" : "";
                 ?>
                 
                 
                <tr style="background: <?= $colorPo; ?>">
                      <td class="plan_req_qty">
                        <!-- Planing Requirment Qty -->
                        <?php 
                            $getPlanQtyDetail = $this->GetQueryModel->getPlanQtyDetailbyid($rm_id,$setdate);
                            $res = $this->GetQueryModel->getrmPlanManuQtybyid($rm_id,$setdate);
                            //print_r($res);
                            $reserve_qty = $res['reserve_qty'];
                            if(!empty($getPlanQtyDetail))
                            {
                                $tooltip = "";
                                
                                foreach ($getPlanQtyDetail as $key => $value1) 
                                {
                                   
                                    $branch_id = $value1['branch_id'];
                                    $getBranchbyId = $this->GetQueryModel->getBranchbyId($branch_id);

                                    $to_date = date("M Y", strtotime($value1['to_date']));  
                                    $partno = $value1['partno'];
                                    $branch_Nm = $getBranchbyId['name'];
                                    $scheduled_qty = $value1['scheduled_qty'];
                                    $tooltip .= "Month - ".$to_date.", Part - ".$partno.", Branch - ".$branch_Nm."\n";
                                    
                                }
                                // $tooltip .= "</table>";
                            }
                            ?>

                            <div title="<?php echo $tooltip; ?>">

                            <?php
                            

                            $result = "";
                            if(!empty($res))
                            {
                                $result = $res['plan_req_qty'];
                                
                            }
                            echo ($result != "") ? $result : "-";
                            $manual_qty_if_empty = $result+$reorderqty;
                            $manual_qty = ($res['manual_qty'] == "" || $res['manual_qty'] == 0) ? $manual_qty_if_empty : $res['manual_qty'];
                        ?>
                    </td>
                    <td align="center">
                         <input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?=$value['rm_id'];?>" >
                    </td>
                
                      <td align=""> <?php
                     // print_r($value);
                     $partData= $this->GetQueryModel->getPartRmbyid($value['rm_id']);
                     foreach($partData as $part){
                         $pdata= $this->GetQueryModel->getPartsById($part['part_id']);
                        
                         echo $pdata['partno']." </br>";
                         // echo "RM_ID-".$value['rm_id'];
                          
                     }  ?></td>
                    <td  align="center"> <?=$value['rm_id'];?></td>
                   <td> <?=$value['name'];?>  </td>  <!--  Row Matterial Name -->
                    <td> <!--  Reorder qty --> 
                        <?= $reorderqty = ($value['reorderQty'] != 0) ? $value['reorderQty'] : "-"; ?></td>
                    <td>
                        <!-- Current Stock -->
                        <?php 

                            $data = $this->GetQueryModel->getRmStockbyid($rm_id,$_SESSION['current_year']);
                           // print_r($data);
                            $cstock ="-";
                            if(!empty($data))
                            {
                                $ob_total = "";
                                $receipt_total = "";
                                $issue_total = "";
                                $reserve_tot = "";
                                $toottip = "";
                                $current_stock_total = "";
                                foreach ($data as $key => $value) 
                                {
                                    $current_stock       = $value['current_stock'];   
                                    $CurrentStk         = $value['current_stock'];   
                                    $branch_id           = $value['branch_id'];   
                                    $getBranchbyId       = $this->GetQueryModel->getBranchbyId($branch_id);

                                    //$CurrentStk = ($ob + $receipt - $issue - $reserve_qty); //reserve_qty
                                    $cstock     =  ($CurrentStk != "") ? round($CurrentStk,3) : "-"; 
                                    $current_stock_total=$current_stock_total+  $current_stock;  
                                    $toottip .= "Branch - ".$getBranchbyId['name'].", Current Stock - ".$CurrentStk."\n";
                                } 

                                    //$CurrentStk = ($ob_total + $receipt_total - $issue_total - $reserve_tot);

                                    $cstock     =  ($current_stock_total != "") ? round($current_stock_total,3) : "-"; 
                            }
                            // echo $toottip;

                            ?>

                    <div title="<?php echo $toottip; ?>">
                            <?= $cstock; ?>
                    </td>
                   
                    <td class="manual_qtytd">


                          <?php
                               // $txtval  =  ($result != "") ? $result + $manual_qty : "";
                               if($result != "")
                               {
                                   
                                $txtval  =  ($result != "") ? ($result + $reorderqty) - $cstock  : "";
                               }else
                               {
                                  
                                $txtval  =  ($reorderqty != "") ? ($reorderqty)  : "";
                               }
                               
                                $bgColor = "style='width: 100px;'";
                                if (!($res['manual_qty'] == "" || $res['manual_qty'] == 0))
                                {
                                    if($txtval > $manual_qty )
                                    {
                                        $bgColor = "style='background: #f51212a6;color:#fff;width: 100px;'";
                                    }else
                                    {
                                        $bgColor = "style='background: #008000bd;color: #ffff;width: 100px;'";
                                    }
                                }
                            ?>

                            <!-- <input type="hidden" name="manual_hidden" id="manual_hidden" value="<?= $txtval; ?>"> -->
                        <input  class="form-control manual_qty" <?=$bgColor;?> id="manual_qty<?= $rm_id; ?>" name="manual_qty[]" type="text" onInput="getReserverQty(<?= $rm_id; ?>,<?= $txtval; ?>);" value="<?= $manual_qty; ?>">
                    </td>
                    <td align="left"> 
                          <?php
                         
                            $reserve_qty  =  ($reserve_qty != "") ? $reserve_qty : "-";
                          ?>
                       
                        <input type="text" class="form-control" id="ReserverQty<?= $rm_id; ?>" readonly name="reserve_qty[]" style="width: 100px;" value="<?= $reserve_qty; ?>">
                        
                        
                        <input type="hidden" name="rm_name[]" value="<?= $rm_name; ?>">
                        <input type="hidden" name="reorderqty[]" value="<?= $reorderqty; ?>">
                        <input type="hidden" name="cstock[]" value="<?= ($cstock=="-") ? 0 :$cstock; ?>">
                        <input type="hidden" name="plan_req_qty[]" value="<?= ($result == "") ? 0 : $result; ?>">
                        <input type="hidden" name="rm_id[]" value="<?= $rm_id; ?>">
                       
                        
                        <!-- <input type="hidden" name="manual_qtytxt[]" value="<?= ($txtval == "") ? 0 : $txtval; ?>"> -->
                    </td>
                    <td>
                        <?php 
                                
                                //echo (!empty($resPoNew['po_qty']) || $resPoNew['po_qty']==0) ? round($resPoNew['po_qty'],3) : $resPo['pending_qty'];
                                echo ($POStatus['open_status']==1) ? "Order Placed" : "-";
                        ?>
                    </td>

                       

                </tr>
                <?php   } ?>
            </tbody>
        </table>
        </div>
        <!-- <hr> -->
                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary Update">Update</button>
                    <button type="button" id="btnCloseCustomer" onclick="CloseRmreq();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
           "paging":   false,
         "aaSorting": [[ 0, "asc" ]], // Sort by first column descending
         
    } );
} );
function deleteRecord1(editId)
{

if (confirm("Are you sure - delete this Customer?")) 
{
   $.ajax({
   url:"<?php echo base_url(); ?>deleteCustRecord",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
}

// manual_qty
$('.manual_qty').on('keyup', function() 
{

        // var qty = $(this).val();

        // var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        // var manualval1 = manualval.trim();

        //  if(parseInt(qty) >= parseInt(manualval1))
        //  {
        //     var mqty = (manualval1 == "-") ? 0 : manualval1;
        //     var req_val = (qty  - mqty);

        //     var totl = (parseInt(mqty) + parseInt(qty) );
        //     $(this).closest('td').next('td').html(req_val);
        //  }else{

        //     // $(this).closest('input[type=text]').focus();
        //     //$(".manual_qty").focus(function(){ $(this).addClass("focused")});
        //  }

});

$('.manual_qty').on('focusout', function() 
{
   
        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();
        
        var mqty = (manualval1 == "-") ? 0 : manualval1;

         //     if(parseInt(qty) >= parseInt(mqty))
         //     {
         //        // var totl = (parseInt(mqty) + parseInt(qty) );
         //        // var req_val = (qty  - mqty);
         //        // var tds = $(this).closest('td').next('td').html(req_val);
         //        // var rm_id =  this.id;

         //        // $.ajax({
         //        //      url:"<?php echo base_url(); ?>updateEquisition",
         //        //         method:"POST",
         //        //         data:{rmid:rm_id,rm_qty:req_val},
         //        //         success:function(result)
         //        //         {
         //        //         tds.css("background-color", "#5fb35f");
         //        //         tds.css("color", "white");
         //        //     }
         //        // });
         //    }else{
         //         var manualval = $(this).closest('td').prev('.plan_req_qty').text(0);

         //        alert("Total Qty should be greater than planning requirment Qty.");

         //    //$(".manual_qty").focus(function(){ $(this).addClass("focused")});

         // }
    });




    function CloseRmreq(removeNum) 
    {
        location.href = 'MangDashboard';

    }
    function getReserverQty(rmId,orgVal) 
    {
       var ManualVal = $("#manual_qty"+rmId).val();
       var ReserverQty = ManualVal-orgVal;
       $("#ReserverQty"+rmId).val(ReserverQty);
       

    } 
    
    
</script>
</body>

</html>