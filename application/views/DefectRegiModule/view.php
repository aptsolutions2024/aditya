<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Defect Registration | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('viewDefectRegiModule');?>">Defect Registration</a></li>
                            
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
                            <h2 style="width: 80%;">Defect Registration</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addDefectRegiModule');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add Defect Registration</button></a>
                             </div>
                            </div>
                                                <?php 
                                if(!empty($_SESSION['dcmsg']))
                                { ?>
                                      <br>      <br>
                                <div style="font-size: 15px;color:green;margin-bottom: 10px;"><?=$_SESSION['dcmsg'];?></div>

                                 <?php 
                                }
                                ?>  
                                <?php echo form_open('/viewDefectRegiModule', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                   
                                    <div class="col-md-3" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                        <?php $showdate=date('Y-m');?>
                                       <input id="date" name="date" type="month" class="form-control" value="<?php echo set_value('date',$showdate);?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                    <div class="col-2" style="margin-top: 17px;">
                                    <button type="submit" class="btn btn-primary submit" >Show</button>
                                    </div>
                                </form>   
                             
                           <br>
                            <div style="overflow:auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                               <!--`id`, `date`, `status`, part_id`, `part_no`, `part_name`, `loc_type`, `loc_name`, `loc_id`, `root_cause_det`, `action_started_date`, `completed_date`,-->
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Reporting Date</th>
                                        <th>Part No</th>
                                        <th>Loc. Type</th>
                                        <th>Loc. Name</th>
                                         <th>Action taken Date</th>
                                        <th>Completed Date</th>
                                        
                                        <th>Team Formation</th>
                                        <th>Defect Description</th>
                                        <th>Containment Actions</th>
                                        <th>Root Cause Det.</th>
                                        <th>Develop perm corr actions</th>
                                        <th>Implement perm corr actions</th>
                                        <th>Prevention</th>
                                        <th>Congratulate team</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;
                                  // print_r($getDefectregistration);
                                        foreach ($getDefectregistration as $key => $value) { 
                                         // $supplierD=  $this->getQueryModel->getSupplierById($value['loc_id']);
                                          
                                            $count++;
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('addDefectRegiModule');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('defregPrint');?>?ID=<?php echo base64_encode($value['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>       
                                      </td>
                                        <td ><?=$value['id'];?></td>
                                        <td ><?=$value['status'];?></td>
                                        <td><?=date('d-m-Y',strtotime($value['date']));?></td>
                                        <td><?=$value['part_id']." - ".($getDRMastById['part_no'])?$getDRMastById['part_no']." - ":"";$value['part_name'];?></td>
                                        <td><?=$value['loc_type'];?></td>
                                        <td ><?=$value['loc_name'];?></td>
                                        <td ><?=($value['action_started_date']!="")?date('d-m-Y',strtotime($value['action_started_date'])):" ";?></td>
                                        <td ><?=($value['completed_date']!="")?date('d-m-Y',strtotime($value['completed_date'])):" ";?></td>
     <!--`team_formation`, `defect_desc`, `containment_actions`, `root_cause_det`, `develop_perm_corr_actions`, `implement_perm_corr_actions`, `prevention`, `congratulate_team`,-->
                         
                                        <td ><?=$value['team_formation'];?></td>
                                        <td ><?=$value['defect_desc'];?></td>
                                        <td ><?=$value['containment_actions'];?></td>
                                        <td ><?=$value['root_cause_det'];?></td>
                                        <td ><?=$value['develop_perm_corr_actions'];?></td>
                                        <td ><?=$value['implement_perm_corr_actions'];?></td>
                                        <td ><?=$value['prevention'];?></td> 
                                        <td ><?=$value['congratulate_team'];?></td>
                            
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

    <?php  $this->load->view('/include/jsPage'); ?>
    
<script>
function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteDefregDetails",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
       alert(result);
   location.reload();
   }
   });
}
}
</script>
</body>

</html>