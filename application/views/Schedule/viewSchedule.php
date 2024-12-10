<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Schedule | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('schedule');?>">Schedule</a></li>
                            
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
                            <h2 style="width: 80%;">Schedule</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addSchedule');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add/Update Schedule</button></a>
                             </div>
                            </div>

                            <?php echo form_open('/schedule', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    
                            <input type="hidden" id="formSubmitFlag" value="<?=$formSubmitFlag;?>" >


                                        <div class="col-md-3">
                                       <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                       <?php $cn= set_value('Customer_Id'); ?>
                                       <select id="Customer_Id" name="Customer_Id" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getparts['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('Customer_Id');?>
                                    </div>

                                    <div class="col-md-2">
                                       <label class="form-label">Schedule Date<label class="mandatory">*</label></label>
                                       <input id="schedule_date" name="schedule_date" type="month" class="form-control" value="<?php echo set_value('schedule_date', $getparts[schedule_date]); ?>" min="<?php echo $mindate=minDate();?>" max="<?php echo $maxdate=maxDate();?>">
                                       <?php echo form_error('schedule_date');?>
                                    </div>


                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                            
 <div style="overflow : auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Sch ID</th>
                                        <th>Customer Name</th>
                                        <th>Part No.</th>
                                        <th>Part Name</th>
                                        <!--<th>From Date</th>
                                        <th>To Date</th>-->
                                        <th>Quantity</th>
                                        <th style="width:10%;">Planning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getSchedule as $key => $value) { 
                                            $count++;
                                        
                                        $query = $this->db->query("SELECT * FROM mast_customer where id=".$value['customer_id']);
                                        $custdata = $query->row_array();
                                        
                                        $query = $this->db->query("SELECT * FROM mast_part where part_id=".$value['part_id']);
                                        $partdata = $query->row_array();
                                        $planning = $this->getQueryModel->getProdPlanBySchId($value['id']);
                                        $planningId = $planning['id'];
                                     ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td ><?=$value['id'];?></td>
                                        <td style="text-transform: uppercase"><?=$custdata['name'];?></td>
                                        <td style="text-transform: uppercase"><?=$partdata['partno'];?></td>
                                        <td style="text-transform: uppercase"><?=$partdata['name'];?></td>
                                        <!--<td ><?=date("d M Y",strtotime($value['from_date']));?></td>
                                        <td ><?=date("d M Y",strtotime($value['to_date']));?></td>-->
                                        <td ><?=$value['scheduled_qty'];?>
                                        <input type="text" id="sqty<?=$custdata['id'];?>" value="<?=$value['scheduled_qty'];?>" style="display:none;">
                                        </td>
                                        <td class="text-center text-nowrap" style="width:10%;color: #068906;font-weight: 600;font-size: 15px;">
                                          <?php if($planningId > 0) { echo "Done"; }else{ echo "-"; } ?>     
                                        </td>
                                    </tr>
                                    <?php } ?>
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