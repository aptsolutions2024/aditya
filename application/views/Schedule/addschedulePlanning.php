<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Schedule Planning | Aditya</title>

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
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css"> -->

    
</head>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Schedule Planning</li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Add Schedule Planning</h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                        <!-- Block styled form -->
                                        <?php 

                                           //echo "<pre>"; print_r($_POST);
                                            if($getopts['id']==''){ ?>
                                        <?php echo form_open_multipart('/createSchedule', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open_multipart('/updateSchedule', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="scheduleId" value="<?=$_POST['scheduleId'];?>">
                                    <?php } ?>



                                        <div class="col-md-4">
                                       <label class="form-label">Schedule Qty</label>
                                       <input id="Schedule_Qty" name="Schedule_Qty" type="text" class="form-control" value="<?php echo set_value('Schedule_Qty',$_POST[scheduled_qty]); ?>" readonly >
                                    </div>

                                    <?php
                                     $planningQty=$getBS['planning_qty'];
                                        if($planningQty!='')
                                        {
                                           $ActiveStocks= $_POST[ActiveStock]+$planningQty;
                                        }else
                                        {
                                            $ActiveStocks= $_POST[ActiveStock];
                                        }
                                     ?>
                                        <div class="col-md-4">
                                       <label class="form-label">Active Stock</label>
                                       <input id="ActiveStock" name="ActiveStock" type="text" class="form-control" value="<?=$ActiveStocks; ?>" readonly>
                                    </div>
                                        <div class="col-md-4">
                                       <label class="form-label">Req. Qty</label>
                                       <input id="Req_Qty" name="Req_Qty" type="text" class="form-control" value="<?php echo set_value('Req_Qty',$_POST[reqQty]); ?>" readonly>
                                    </div>
                                        <div class="col-md-4">
                                       <label class="form-label">Part Name</label>
                                       <input id="partName" name="partName" type="text" class="form-control" value="<?php echo set_value('partName',$_POST[partName]); ?>" readonly>
                                    </div>
                                        <div class="col-md-4">
                                       <label class="form-label">Part No.</label>
                                       <input id="partno" name="partno" type="text" class="form-control" value="<?php echo set_value('partno',$_POST[partno]); ?>" readonly>
                                    </div>
                                        <div class="col-md-4">
                                       <label class="form-label">Planning qty<label class="mandatory">*</label></label>
                                       <input id="planning_qty" name="planning_qty" type="text" class="form-control" value="<?php echo set_value('planning_qty'); ?>" />
                                       <?php echo form_error('planning_qty');?>
                                    </div>
                                       

                                     </form>


                            
                                <div style="border: 1px solid #25476a;margin-top: 15px;margin-bottom: 15px;" class="col-md-12 "></div>
                                <h3>Book Stock</h3>
                            <?php echo form_open_multipart('/createReserveStock', array('autocomplete' => 'off','class' => 'row g-3')); ?>

                            <input type="hidden" name="toDate" value="<?=$_POST['toDate'];?>">
                            <input type="hidden" name="schedule_id" value="<?=$_POST['scheduleId'];?>">
                            <input type="hidden" name="partId" value="<?=$_POST['partId'];?>">
                            <input type="hidden" name="ActiveStock" value="<?=$_POST['ActiveStock'];?>">
                            <input type="hidden" name="tppId" value="<?=$getBS['id'];?>">
                            <input type="hidden" name="oldPlanningQty" value="<?=$getBS['planning_qty'];?>">
                                <?php 

                                   $RSPQ= $getBS['planning_qty'];
                                   if($RSPQ!='')
                                   {
                                    $RSPQ= $getBS['planning_qty'];
                                   }else
                                   {
                                    $RSPQ=0;
                                   }
                                   $tppId=$getBS['id'];
                                ?>
                                <div class="col-md-4">
                                <label class="form-label">Planning qty (Nos)<label class="mandatory">*</label></label>
                                <input id="RS_planning_qty" name="RS_planning_qty" type="text" class="form-control" value="<?php echo set_value('RS_planning_qty',$RSPQ); ?>" onchange="addAllPlanningQty();" onInput="checkRSPlanningQty(this.value);" />
                                <?php echo form_error('RS_planning_qty');?>
                                </div>
                                <?php if($tppId=='')
                                    { ?>
                                       <div class="col-4" style="margin-top: 40px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div> 
                                  <?php  } else {?>

                                  <div class="col-4" style="margin-top: 40px;">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                                <?php } ?>
                                
                            </form>

                            <br>

                                

                        <div style="border: 1px solid #25476a;margin-top: 15px;margin-bottom: 15px;" class="col-md-12 "></div>
                           <h3 style="display: flex;">
                            <div style="width: 100%;">Inhouse Production </div>
                            <div class="mb-3" style="float: right;width: 13%;">

                                <?php echo form_open_multipart('/addProdPlanning', array('autocomplete' => 'off','class' => 'row g-3')); ?>

                                        <input type="hidden" name="scheduleId" value="<?=$_POST['scheduleId'];?>">
                                        <input type="hidden" name="reqQty" value="<?=$_POST['reqQty'];?>">
                                        <input type="hidden" name="scheduled_qty" value="<?=$_POST['scheduled_qty'];?>">
                                        <input type="hidden" name="CurrentStock" value="<?=$_POST['CurrentStock'];?>">
                                        <input type="hidden" name="ActiveStock" value="<?=$_POST['ActiveStock'];?>">
                                        <input type="hidden" name="partId" value="<?=$_POST['partId'];?>">
                                        <input type="hidden" name="partName" value="<?=$_POST['partName'];?>">
                                        <input type="hidden" name="partno" value="<?=$_POST['partno'];?>">
                                        <input type="hidden" name="toDate" value="<?=$_POST['toDate'];?>">




                                 <button type="submit" class="btn btn-secondary">Add Planning</button>
                             </form>
                             </div>
                         </h3>
                             <div style="clear: both;"></div>
                            <?php echo form_open_multipart('/createInhouseProduction', array('autocomplete' => 'off','class' => 'row g-3')); ?>

                            <input type="hidden" name="toDate" id="toDate" value="<?=$_POST['toDate'];?>">
                            <input type="hidden" name="schedule_id" id="schedule_id" value="<?=$_POST['scheduleId'];?>">
                            <input type="hidden" name="partId" value="<?=$_POST['partId'];?>">
                                 
                            

                            <!--
                                 <div class="col-md-4">
                                       <label class="form-label">Branch Name<label class="mandatory">*</label></label>
                                            <select id="branch_id" name="branch_id" class="form-select" style="text-transform: uppercase" onchange="getRMForPlanning();">
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getuser[branch_id]==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>

                                 <div class="col-md-4">
                                       <label class="form-label">Planning qty (Nos)<label class="mandatory">*</label></label>
                                       <input id="IP_planning_qty" name="IP_planning_qty" type="text" class="form-control" value="<?php echo set_value('IP_planning_qty',0); ?>"  onchange="getRMForPlanning();addAllPlanningQty();" />
                                       <?php echo form_error('IP_planning_qty');?>
                                    </div>
                                    
                                    

                            <div class="resultserach"></div>

                            <div class="col-4" >
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>


                                -->

                                <table  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Branch Name</th>
                                        <th>Planning Qty</th>
                                        <!--th>Action</th-->
                                       
                                    </tr>
                                </thead>
                                
                                    <?php  $count=0; foreach($getIP as $row){

                                     $count++;
                                     $total=$total+$row['planning_qty'];
                                      ?>
                                    <tr>
                                    <td><?=$count;?></td>
                                    <td><?=$row['name'];?></td>
                                    <td><?=$row['planning_qty'];?></td>
                                    <!--td><a class="btn btn-icon btn-sm btn-primary btn-hover" href="/addProdPlanning?ID=<?php echo base64_encode($row['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a></td-->
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="2" align="right" >Total</td>
                                        <td  ><?=$total;?></td>
                                        
                                    </tr>
                                    </tr>
                                
                            </table>

                                       

<br>

                                <div style="border: 1px solid #25476a;margin-top: 15px;margin-bottom: 15px;" class="col-md-12 "></div>
                                 <h3>Semifinished Boughtout</h3>
                                 <div class="col-md-4">
                                       <label class="form-label">Planning qty (Nos)<label class="mandatory">*</label></label>
                                       <input id="SB_planning_qty" name="SB_planning_qty" type="text" class="form-control" value="<?php echo set_value('SB_planning_qty',0); ?>" onchange="addAllPlanningQty()" />
                                       <?php echo form_error('SB_planning_qty');?>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>


                                            </div>

<br>

                                <div style="border: 1px solid #25476a;margin-top: 15px;margin-bottom: 15px;" class="col-md-12 "></div>
                                 <h3>Finished Boughtout</h3>
                                 <div class="col-md-4">
                                       <label class="form-label">Planning qty (Nos)<label class="mandatory">*</label></label>
                                       <input id="FB_planning_qty" name="FB_planning_qty" type="text" class="form-control" value="<?php echo set_value('FB_planning_qty',0); ?>" onchange="addAllPlanningQty()" />
                                       <?php echo form_error('FB_planning_qty');?>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="/schedulePlanning"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>



                                        <!-- END : Block styled form -->

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </section>


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

    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->
<script>
function getRMForPlanning()
{
    var partId        ='<?=$_POST[partId];?>';
    var branch_id     =$("#branch_id").val();
    var PlanningQty   =$("#IP_planning_qty").val();
    var scheduleId    =$("#schedule_id").val();
    var toDate        =$("#toDate").val();
    $.ajax({
         url:"<?php echo base_url(); ?>getRMForPlanning",
         method:"POST",
         data:{branch_id:branch_id,PlanningQty:PlanningQty,partId:partId,scheduleId:scheduleId,toDate:toDate},
         success:function(result)
         {
            //console.log(result);
            var tableWord = result.indexOf("<table");
            var tableRes = result.substring(tableWord);
            var PQ = result.substring(0, tableWord);
            if(PQ!='')
            {
                $("#IP_planning_qty").val(PQ);
            }
            
            $(".resultserach").show();
            $(".resultserach").html(tableRes);
         }
         });

}

function checkRSPlanningQty(qty)
{
    var ActiveStock='<?=$ActiveStocks;?>';
    var ActiveStock=parseInt(ActiveStock);
    var qty=parseInt(qty);

    if(ActiveStock>=qty)
    {
       $("#RS_planning_qty").removeClass('bordererror'); 
    }else
    {

    $("#RS_planning_qty").focus();
   error ="Insufficient active stock qty.";
   //$("#planning_qty").val('');
   $("#RS_planning_qty").val('');
   $("#RS_planning_qty").addClass('bordererror');
   $("#RS_planning_qty").attr("placeholder", error);
   return false;

    }
}


function addAllPlanningQty()
{
    var RSPQty=$("#RS_planning_qty").val();
    var IPPQty=$("#IP_planning_qty").val();
    var SBPQty=$("#SB_planning_qty").val();
    var FBPQty=$("#FB_planning_qty").val();
    var PQ=parseInt(RSPQty)+parseInt(IPPQty)+parseInt(SBPQty)+parseInt(FBPQty);
    $("#planning_qty").val(PQ);
}

$( document ).ready(function() {
     var RSPQty='<?=$getBS['planning_qty']?>';
     if(RSPQty!='')
     {
       var RSPQty='<?=$getBS['planning_qty']?>'; 
   }else
   {
    var RSPQty=0;
   }
     var PQ=parseInt(RSPQty);
    $("#planning_qty").val(PQ);
});
</script>

<style>
    table, th, td {
  border: 1px solid #ebebeb;
  padding: 10px;
}

.bordererror {
    border: 1px solid #ff0000 !important;
}

.bordererror::-webkit-input-placeholder {
    color: #ff0000;
    font-size: 12px;
}

.bordererror::-moz-placeholder {
    color: #ff0000;
    font-size: 12px;
}
</style>
</body>

</html>