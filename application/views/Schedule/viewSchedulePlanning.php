<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Schedule Planning - <?php echo date('F Y',strtotime(set_value('schedule_date', $getparts[schedule_date]))); ?> | Aditya</title>

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
          table.dataTable tbody td, table.dataTable thead th {
    padding: 8px 7px;
}
table.dataTable thead th {
    position: -webkit-sticky; // this is for all Safari (Desktop & iOS), not for Chrome
    position: sticky;
    top: 0;
    z-index: 1; // any positive value, layer order is global
 
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

                             <?php echo form_open('/createSchedulePlanning', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    
                            <input type="hidden" id="formSubmitFlag" value="<?=$formSubmitFlag;?>" >
                                        <div class="col-md-3">
                                       <label class="form-label">Customer Name</label>
                                       <?php $cn= set_value('Customer_Id'); ?>
                                       <select id="Customer_Id" name="Customer_Id" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php //print_r($getCustName);
                                          foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getparts['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('Customer_Id');?>
                                    </div>

                                    <div class="col-md-2">
                                       <label class="form-label">Schedule Date<label class="mandatory">*</label></label>
                                       <input id="schedule_date" name="schedule_date" type="month" class="form-control" value="<?php echo set_value('schedule_date', $getparts[schedule_date]); ?>"  min="<?php echo $mindate=minDate();?>" max="<?php echo $maxdate=maxDate();?>">
                                       <?php echo form_error('schedule_date');?>
                                    </div>

                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                                       
 <div style="max-height:800px;overflow:auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <!--<th></th>-->
                                        <!--<th>Sr.No.</th>-->
                                        <th>Customer</th>
                                        <!--<th>Part ID</th>-->
                                        <th>Part Details</th>
                                        <th>Schedule Qty</th>
                                      
                                        <!--<th>Use Stock</th>-->
                                        <th>Req. Qty</th>
                                        <th>Planning Qty</th>
                                        <th>Operation </th>
                                        <th>Location </th>
                                        
                                        <th>Final Stock</th>
                                        <th>Inprocess Stock</th>
                                        <th>Bin Quantity</th>
                                        <th>Active Stock</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                 <?php echo form_open('/addProdPlanningNew', array('onsubmit' => 'return checkPlanning()')); ?>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        //print_r($getSchedulePlanning);
                                        foreach ($getSchedulePlanning as $key => $value) 
                                        { 
                                          
                                         
                                        $count++;
                                        $query = $this->db->query("SELECT * FROM mast_part where part_id=".$value['part_id']);
                                        $partdata = $query->row_array();
                                        
                                        $query = $this->db->query("SELECT * FROM mast_customer where id=".$value['customer_id']);
                                        $custdata = $query->row_array();

                                        $ob         =$value['ob'];
                                        $receipt    =$value['receipt'];
                                        $issue      =$value['issue'];
                                        $reserve_qty =$value['reserve_qty'];    

                                        $CurrentStock = $value['FinalStock'] + $value['InprocessQty'];
                                     
                                        
                                       
                                        $ActivQty     =($CurrentStock) - ($partdata['bin_qty']);
                                        $reqQty       =($value['scheduled_qty'])-($ActivQty);

                                        $getFirstOperaion = $this->getQueryModel->getFirstOperaion($value['part_id']);
                                        $getBranch = $this->getQueryModel->getBranch();
                                        //print_r($getFirstOperaion);die;
                                     
                                         $op_id = ( !empty($getFirstOperaion['op_id'])) ?  $getFirstOperaion['op_id'] : "";
                                         
                                        $prodSche =  $this->getQueryModel->getProdPlanBySchId($value['id']);
                                        
                                        if($prodSche['schedule_id'] == $value['id'])
                                        {
                                          $bg = 'background: #26a69a52;'; 
                                           $checkbox = "1";  
                                        } else
                                        {
                                            $bg = '';  
                                             $checkbox = "0";  
                                        }
                                     ?>
                                     
                                    <tr class="sch_qty" style="<?=$bg;?>">
                                     <!--  <td> 
                                        <?php  if($prodSche['schedule_id'] == $value['id']) {  ?>
                                            
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('SchedulePlanningR');?>?ID=<?php echo base64_encode($prodSche['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>
                                    <?php } ?>
                                    </td>-->
                                        <td><input type="checkbox" <?= ($checkbox == 1) ? "disabled" : ""; ?> class="form-check-input" name="checkboxVal[]" value="<?=$value['id'];?>" ></td>
                                        <!--<td><?=$count;?></td>-->
                                        <td style="text-transform: uppercase"><?=$custdata['name'];?></td>
                                      
                                        <td style="text-transform: uppercase"><?=$value['part_id'];?> - <?=$partdata['partno'].' - '.$partdata['name'];?></td>
                                        <td class="scheduled_qty"><?=$value['scheduled_qty'];?></td>
                                       
                                       <!-- <td>
                                            <?php 
                                                    $checkedsel  = ($ActivQty > 0) ? "" : "disabled";
                                                    $checkedse  = ($ActivQty > 0) ? "YES" : "NO";

                                            ?>
                                               
                                            <select name="usStock[]" class="usStock">

                                                <?php
                                                if($checkedse == 'YES')
                                                { ?>
                                                <option value="<?= $checkedse; ?>"><?= $checkedse; ?></option>
                                                <option value="NO">NO</option>

                                               <?php  }else{ ?>

                                                <option value="<?= $checkedse; ?>"><?= $checkedse; ?></option>
                                                
                                                <?php }

                                                ?>
                                            </select>
                                            </td>-->
                                        <td class="Req_Qty"><?=$reqQty;?></td>
                                        <td class="planning_qty">
                                           <input type="text" class="planning_qty" value="<?= $prodSche['planning_qty']; ?>" name="planning_qty[]" size='10'>
                                        </td>
                                        <td>
                                              <?php 
                                              //echo "OPID:".$op_id;
                                                $getOperation = $this->getQueryModel->getOperation($op_id);
                                                echo $getOperation['name'];

                                              ?>  
                                        </td>
                                        <td>
                                             <!-- //part id operation assigned outof 1,2,3  -->
                                            <select name="location[]" class="form-select" style="padding: 8px 2px;">
                                       
                                                <?php
                                                $branch_id = $prodSche['branch_id'];
                                                $supplier_id = $prodSche['supplier_id'];
                                                if($op_id == 1 || ($op_id!=2 && $op_id!=3))
                                                {
                                                 
                                                    foreach ($getBranch as $key => $value1) 
                                                    { 
                                                       // if($op_id == 1){ 
                                                            
                                                    ?>
                                                    <option value=<?= $value1['id']; ?> <?php if($branch_id == $value1['id']) {echo "selected";} ?> ><?= $value1['name']; ?> </option>
                                                   
                                               
                                                 <?php // }
                                                    }
                                                }else{
                                                    $type = ($op_id == 2) ? "2" : "3";
                                                 //  $type='3';
                                                    $getSuppliers = $this->SupplierModel->getSuppliers($type);
                                                    
                                                    foreach ($getSuppliers as $key => $values) 
                                                    {
                                                       $selected = ($supplier_id == $values['id']) ? "selected" : "";
                                                        ?>
                                                        <option value="<?= $values['id']; ?>" <?=$selected; ?> > <?= $values['name']; ?> </option>
                                                            
                                                   <?php 
                                                        
                                                    }

                                                }
                                              
                                                ?>
                                            </select>
                                        </td>
                                        <td><?=$value['FinalStock'];?></td>
                                        <td><?=$value['InprocessQty'];?></td>
                                        <td><?=$partdata['bin_qty'];?></td>
                                        <td class="ActivQty"><?=$ActivQty;?></td>
                                        
                                        <!--<td class="text-center text-nowrap">-->

                                        <?php // echo form_open('/schedulePlanning1'); ?>
                                         <input type="hidden"  name="usStock[]" class="usStock" value="NO">
                                        <input type="hidden" name="op_id[]" value="<?= $op_id;?>">
                                        <input type="hidden" name="scheduleId[]" value="<?=$value['id'];?>">
                                        <input type="hidden" name="reqQty[]" id="reqQty" value="<?=$reqQty;?>">
                                        <input type="hidden" name="scheduled_qty[]" value="<?=$value['scheduled_qty'];?>">
                                        <input type="hidden" name="CurrentStock[]" value="<?=$CurrentStock;?>">
                                        <input type="hidden" name="ActiveStock[]" value="<?=$ActivQty;?>">
                                        <input type="hidden" name="partId[]" value="<?=$partdata['part_id'];?>">
                                        <input type="hidden" name="partName[]" value="<?=$partdata['name'];?>">
                                        <input type="hidden" name="partno[]" value="<?=$partdata['partno'];?>">
                                        <input type="hidden" name="toDate[]" value="<?=$value['to_date'];?>">
                                        <!-- <button type="submit" class="btn btn-icon btn-sm btn-primary btn-hover"><i class="demo-pli-pen-5 fs-5"></i></button> -->
                                        <!--</td>-->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                            <hr>
                             <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary Update">Save</button>
                                                 <!--<button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>-->
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


$(document).ready(function() 
{
   
    // $('table#example').DataTable( {
    //     dom: 'Bfrtip',
    //     'bPaginate': false,
    //     buttons: [
    //         'csv', 'excel', 'pdf', 'print'
    //     ]
    // } );

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
}

$('.usStock').on('change', function() {

     var drval = $(this).val();

  if(drval == "YES")
  {
     //var Req_Qty = $(this).closest('td').next('.Req_Qty').text();
    // var ActivQty = $(this).closest('td').prev('.ActivQty').text();
    // var scheduled_qty = $(this).closest('td').prev('.scheduled_qty').text();

        var scheduled_qty =  $(this).closest('tr').find('.scheduled_qty').text();
        var ActivQty =  $(this).closest('tr').find('.ActivQty').text();
        var ReqVal = (scheduled_qty - ActivQty);
        $(this).closest('tr').find('.Req_Qty').text(ReqVal);
        $(this).closest('tr').find('.planning_qty').val(ReqVal);

  }else{
        var scheduled_qty =  $(this).closest('tr').find('.scheduled_qty').text();
        var ActivQty =  $(this).closest('tr').find('.ActivQty').text();
        var ReqVal = (scheduled_qty);
        $(this).closest('tr').find('.Req_Qty').text(ReqVal);
         $(this).closest('tr').find('.planning_qty').val(ReqVal);
  }

  


}); 
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

function checkPlanning()
{

 var checkboxes = document.getElementsByName('checkboxVal[]');
var checkedvals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
if (checkboxes[i].checked) 
{
checkedvals += ","+checkboxes[i].value;
}
}
if (checkedvals) checkedvals = checkedvals.substring(1);
///alert(checkedvals);
if(checkedvals == '')
{
    alert("Please select the record!");
    return false;
}
}
</script>
</body>

</html>