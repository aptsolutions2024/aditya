<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Inhouse Production | Aditya</title>

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
                            <li class="breadcrumb-item active" aria-current="page">Add Inhouse Production Planning</li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Add Inhouse Production</h2>
                   

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                    

                        <div style="border: 1px solid #25476a;margin-top: 15px;margin-bottom: 15px;" class="col-md-12 "></div>
                           <h3>Inhouse Production</h3>
                            <?php  echo form_open_multipart('/createInhouseProduction', array('autocomplete' => 'off','class' => 'row g-3')); ?>

                            <input type="hidden" name="toDate" id="toDate" value="<?=$_POST['toDate'];?>">
                            <input type="hidden" name="scheduleId" id="schedule_id" value="<?=$_POST['scheduleId'];?>">
                            <input type="hidden" name="partId" value="<?=$_POST['partId'];?>">
                            <input type="hidden" name="tempPlanningQty" id="tempPlanningQty" value="">
                                 
                            

                            
                                 <div class="col-md-4">
                                       <label class="form-label">Branch Name<label class="mandatory">*</label></label>
                                            <select id="branch_id" name="branch_id" class="form-select" style="text-transform: uppercase" onchange="getRMForPlanning(1);">
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getPP[branch_id]==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>

                                 <div class="col-md-4">
                                       <label class="form-label">Planning qty (Nos)<label class="mandatory">*</label></label>
                                       <input id="IP_planning_qty" name="IP_planning_qty" type="text" class="form-control" value="<?php echo set_value('IP_planning_qty',0); ?>"  onchange="getRMForPlanningQty(2);" />
                                       <?php echo form_error('IP_planning_qty');?>
                                    </div>
                                    
                                    

                            <div class="resultserach"></div>

                            <div class="col-4" style="display: flex;">
                                    <button type="submit" class="btn btn-primary">Save</button>

</form>

 <?php echo form_open_multipart('/schedulePlanning1', array('autocomplete' => 'off','class' => '')); ?>

                            <input type="hidden" name="scheduleId" value="<?=$_POST['scheduleId'];?>">
                            <input type="hidden" name="reqQty" value="<?=$_POST['reqQty'];?>">
                            <input type="hidden" name="scheduled_qty" value="<?=$_POST['scheduled_qty'];?>">
                            <input type="hidden" name="CurrentStock" value="<?=$_POST['CurrentStock'];?>">
                            <input type="hidden" name="ActiveStock" value="<?=$_POST['ActiveStock'];?>">
                            <input type="hidden" name="partId" id="partId" value="<?=$_POST['partId'];?>">
                            <input type="hidden" name="partName" value="<?=$_POST['partName'];?>">
                            <input type="hidden" name="partno" value="<?=$_POST['partno'];?>">
                            <input type="hidden" name="toDate" value="<?=$_POST['toDate'];?>">


                            &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                             </form>



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

</body>
<script>
$( document ).ready(function() {
getRMForPlanning(1);
});
function getRMForPlanning(type)
{

    var partId          ='<?=$_POST[partId]?>';
    var branch_id       =$("#branch_id").val();
    var PlanningQty     =$("#IP_planning_qty").val();
    var scheduleId      ='<?=$_POST[scheduleId];?>';
    var toDate          ='<?=$_POST[toDate]?>';
    $.ajax({
         url:"<?php echo base_url(); ?>getRMForPlanning",
         method:"POST",
         data:{branch_id:branch_id,PlanningQty:PlanningQty,partId:partId,scheduleId:scheduleId,toDate:toDate,type:type},
         success:function(result)
         {
            //console.log(result);
            var tableWord = result.indexOf("<table");
            var tableRes = result.substring(tableWord);
            var PQ = result.substring(0, tableWord);
            
            if(PQ!='')
            {
                $("#IP_planning_qty").val(PQ);
            }else
            {
                $("#IP_planning_qty").val('');
            }
        
            $(".resultserach").show();
            $(".resultserach").html(tableRes);
         }
         });

}

function getRMForPlanningQty(type)
{

    var partId          ='<?=$_POST[partId]?>';
    var branch_id       =$("#branch_id").val();
    var PlanningQty     =$("#IP_planning_qty").val();
    var scheduleId      ='<?=$_POST[scheduleId];?>';
    var toDate          ='<?=$_POST[toDate]?>';

$.ajax({
         url:"<?php echo base_url(); ?>getRMForPlanning",
         method:"POST",
         data:{branch_id:branch_id,PlanningQty:PlanningQty,partId:partId,scheduleId:scheduleId,toDate:toDate,type:type},
         success:function(result)
         {
            //console.log(result);
            var tableWord = result.indexOf("<table");
            var tableRes = result.substring(tableWord);
            var PQ = result.substring(0, tableWord);
            //alert(PQ);
            if(PQ!='' && (PlanningQty==0 || PlanningQty==''))
            {
                $("#IP_planning_qty").val(PQ);
            }else
            {
                $("#IP_planning_qty").val(PlanningQty);
            }
        
            $(".resultserach").show();
            $(".resultserach").html(tableRes);
         }
         });
}
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
</html>