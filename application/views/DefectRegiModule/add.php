<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Defect Registration | Aditya</title>

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
                             <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                             <li class="breadcrumb-item active"><a href="<?php echo base_url('viewDefectRegiModule');?>">Defect Registration</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">            </p>
                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">  <?php  echo ($getDefregMastById['id']=='')?"Add Defect Registration":"Update Defect Registration";?>
                    <!--<a href="<?php echo base_url(); ?>dcPrint?ID=<?php echo base64_encode($getDefregMastById['id']); ?>"><span style="float: right;margin-right: 10px;"><i class="demo-pli-printer" aria-hidden="true" style="font-size: 26px;"></i></span></a>-->
                     <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('dcPrint');?>?ID=<?php echo base64_encode($getDefregMastById['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>       -->
                    </h2>
                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                                          <?php 
                                if(!empty($_SESSION['dcmsg']))
                                { ?>
                                <div style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['dcmsg'];?></div>
                                 <br><br>
                                 <?php 
                                }
                                ?>
                                        <!-- Block styled form -->
                                        <?php  if($getDefregMastById['id']==''){                                         ?>
                                        <?php echo form_open('/createDefectReg', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {  ?>
                                        <?php echo form_open('/updateDefectReg', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getDefregMastById['id'];?>">
                                    <?php } ?>
                    <div class="row">
                        <div class="col-3">
                            <label class="form-label">Status <label class="mandatory">*</label></label>
                            <select id="status" name="status" class="form-select">
                                <!--R-Reported,I-Inprocess,C-Completed	-->
                                <?php if($getDefregMastById['id']==''){ ?>
                                            <option value="R" <?php if($getDefregMastById['status']=='R'){ echo "selected";} ?>>Reported</option>
                                            <?php }?>
                                <?php if($_GET['ID']!=''){ ?>
                                 <option value="I" <?php if($getDefregMastById['status']=='I'){ echo "selected";} ?>>Inprocess</option>
                             
                                 <option value="C" <?php if($getDefregMastById['status']=='C'){ echo "selected";}elseif($getDefregMastById['completed_date']){ echo "selected";}?>>Completed</option>
                                 <?php } ?>
                            </select>
                        </div>
  
                       <div class="col-3">
                                            <label class="form-label">Reporting Date <label class="mandatory">*</label></label>
                                              <?php $seldate=($getDefregMastById['id'])?$getDefregMastById['date']:""; ?>
                                            <input id="reporting_date" name="reporting_date" type="date" class="form-control" placeholder="Part No." value="<?php echo set_value('reporting_date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('reporting_date');?>
                     </div>
                      <?php if($_GET['ID']!=''){ ?>
                                       <div class="col-3">
                                            <label class="form-label">Action Started Date <label class="mandatory">*</label></label>
                                              <?php $action_started_date=($getDefregMastById['action_started_date'])?$getDefregMastById['action_started_date']:''; ?>
                                            <input id="action_started_date" name="action_started_date" type="date" class="form-control" value="<?php echo set_value('action_started_date',$action_started_date); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('action_started_date');?>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">Completed Date <label class="mandatory">*</label></label>
                                              <?php $completed_date=($getDefregMastById['completed_date'])?$getDefregMastById['completed_date']:date('Y-m-d'); ?>
                                            <input id="completed_date" name="completed_date" type="date" class="form-control"  value="<?php echo set_value('completed_date',$completed_date); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('completed_date');?>
                                        </div>
                        
                        <?php } ?>
                        </div>
                       
     <?php
     //print_r($companyDetails);
     if($companyDetails['defect_reg']=='1'){ ?>
     <!--`id`, `date`, `status`, `op_id`, `process_name`, `part_id`, `part_no`, `part_name`, `loc_type`, `loc_name`, `loc_id`, `root_cause_det`, `action_started_date`, `completed_date`-->
                     <div class="row">
                      <div class="col-md-3">
                            <label class="form-label">Location Type <label class="mandatory">*</label></label>
                            <?php if($getDefregMastById['id']!=''){ ?>
                                      <input type="hidden" name="loc_type" value="<?=$getDefregMastById['loc_type']?>">
                            <?php } ?>
                            <?php $loc_typeval= ($getDefregMastById['loc_type'])?$getDefregMastById['loc_type']:set_value('loc_type'); ?>
                            <select id="loc_type" name="loc_type" class="form-select" onChange="getLocationbyType(this.value)">
                                <option value="">Choose...</option>
                                 <option value="C" <?php if($loc_typeval=='C'){ echo "selected";} ?>>Customer</option>
                                 <option value="S" <?php if($loc_typeval=='S'){ echo "selected";} ?>>Supplier</option>
                                 <option value="I" <?php if($loc_typeval=='I'){ echo "selected";} ?>>Inhouse</option>
                            </select>
                            <?php echo form_error('loc_type');?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Location Name <label class="mandatory">*</label></label>
                            <?php 
                            $loc_name= set_value('loc_id'); 
                            if($getDefregMastById['id']!=''){ ?>
                                <input type="hidden" name="loc_name" value="<?=$getDefregMastById['loc_name']?>">
                                <input type="hidden" name="loc_id" value="<?=$getDefregMastById['loc_id']?>">
                            <?php } ?>
                            <select id="loc_id" name="loc_id" class="form-select alltxtUpperCase"  >
                                 <option value="">Choose...</option>
                                <?php if($getDefregMastById['id']!=''){ ?>
                                  <option selected value="<?=$getDefregMastById['loc_id']?>"><?=$getDefregMastById['loc_name']?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('loc_id');?>
                        </div>
                        <div class="col-md-3">
                                <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                  <?php $Part_Search= set_value('Part_Search');  $Part_Id= set_value('Part_Id');  ?>
                                <input type="hidden" id="Part_Id1" name="Part_Id" class="form-select Part_Id" value="<?=$getDefregMastById['part_id'];?>">
                                <div class="autocomplete">
                                <input type="search" id="Part_Search1" name="Part_Search" class="form-control" value="<?=($getDefregMastById['part_no'])?($getDefregMastById['part_no']." - ".$getDefregMastById['part_name']):"";?>" onkeyup="searchPart(this.value,1,'<?=base_url('getPartsBySearch')?>')">  
                                   <?php echo form_error('Part_Id'); 
                                   echo form_error('Part_Search');?>
                                <ul id="searchResult1" class="searchResult"></ul>   
                                </div>  
                        </div>
                         </div>
                                        

  <?php }else{ 
// -------------------------- if defect =0 ------------------------- 
  ?>
                  
                   <div class="row">
                      <div class="col-3">
                            <label class="form-label">Location Type <label class="mandatory">*</label></label>
                            <?php $loc_typeval= ($getDefregMastById['loc_type'])?$getDefregMastById['loc_type']:set_value('loc_type'); ?>
                            <select id="loc_type" name="loc_type" class="form-select">
                                <option value="">Choose...</option>
                                 <option value="C" <?php if($loc_typeval=='C'){ echo "selected";} ?>>Customer</option>
                                 <option value="S" <?php if($loc_typeval=='S'){ echo "selected";} ?>>Supplier</option>
                                 <option value="I" <?php if($loc_typeval=='I'){ echo "selected";} ?>>Inhouse</option>
                            </select>
                            <?php echo form_error('loc_type');?>
                        </div>
                      
                         <div class="col-md-3">
                                <label class="form-label">Location Name <label class="mandatory">*</label></label>
                                   <?php $cn10=$getDefregMastById['loc_name']; ?>
                                <input type="text" class="form-control" name="loc_name" value="<?php echo set_value('loc_name',$cn10);?>">
                                <?php echo form_error('loc_name');?>
                        </div>
                        <div class="col-md-3">
                                <label class="form-label">Part No <label class="mandatory">*</label></label>
                                 <?php $cn11=$getDefregMastById['part_no']; ?>
                                <input type="text" id="Part_No" name="Part_No" class="form-control" value="<?php echo set_value('Part_No',$cn11);?>">
                                <?php echo form_error('Part_No');?>
                        </div>
                        <div class="col-md-3">
                                <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                <?php $cn12= $getDefregMastById['part_name']; ?>
                                <input type="text" id="Part_Name1" name="Part_Name" class="form-control" value="<?php echo set_value('Part_Name',$cn12);?>">
                                 <?php echo form_error('Part_Name');?>
                        </div>
                         </div>
 <? }  ?>
 
  <!--`team_formation`, `defect_desc`, `containment_actions`, `root_cause_det`, `develop_perm_corr_actions`, `implement_perm_corr_actions`, `prevention`, `congratulate_team`,-->
                                 <div class="col-md-12" >
                                            <label class="form-label">Team Formation</label>
                                            <textarea rows="1" id="team_formation" name="team_formation" type="text" class="form-control" placeholder="Team formation" ><?php echo set_value('team_formation', $getDefregMastById[team_formation]); ?></textarea>
                                            
                                   </div>
                                    <div class="col-md-12">
                                            <label class="form-label">Defect Description</label>
                                            <textarea rows="1" id="defect_desc" name="defect_desc" type="text" class="form-control" placeholder="Defect Description" ><?php echo set_value('defect_desc', $getDefregMastById[defect_desc]); ?></textarea>
                                            
                                   </div>
                                     <div class="col-md-12">
                                            <label class="form-label">Containment Actions</label>
                                            <textarea rows="1" id="containment_actions" name="containment_actions" type="text" class="form-control" placeholder="Containment Actions" ><?php echo set_value('containment_actions', $getDefregMastById[containment_actions]); ?></textarea>
                                            
                                   </div>
    <!--`team_formation`, `defect_desc`, `containment_actions`, `root_cause_det`, `develop_perm_corr_actions`, `implement_perm_corr_actions`, `prevention`, `congratulate_team`,-->
                                   <div class="col-md-12">
                                            <label class="form-label">Root Cause Det.</label>
                                            <textarea rows="1" id="root_cause_det" name="root_cause_det" type="text" class="form-control" placeholder="Root Cause Det." ><?php echo set_value('root_cause_det', $getDefregMastById[root_cause_det]); ?></textarea>
                                            
                                   </div>
                                   <div class="col-md-12">
                                            <label class="form-label">Develop perm corr actions</label>
                                            <textarea rows="1" id="develop_perm_corr_actions" name="develop_perm_corr_actions" type="text" class="form-control" placeholder="Develop perm corr actions" ><?php echo set_value('develop_perm_corr_actions', $getDefregMastById[develop_perm_corr_actions]); ?></textarea>
                                            
                                   </div>
                                    <div class="col-md-12">
                                            <label class="form-label">implement_perm_corr_actions</label>
                                            <textarea rows="1" id="implement_perm_corr_actions" name="implement_perm_corr_actions" type="text" class="form-control" placeholder="Implement perm corr actions" ><?php echo set_value('implement_perm_corr_actions', $getDefregMastById[implement_perm_corr_actions]); ?></textarea>
                                            
                                   </div>
                                    <div class="col-md-12">
                                            <label class="form-label">Prevention</label>
                                            <textarea rows="1" id="prevention" name="prevention" type="text" class="form-control" placeholder="Prevention" ><?php echo set_value('prevention', $getDefregMastById[prevention]); ?></textarea>
                                            
                                   </div>
                                    <div class="col-md-12">
                                            <label class="form-label">Congratulate team</label>
                                            <textarea rows="1" id="congratulate_team" name="congratulate_team" type="text" class="form-control" placeholder="Congratulate Team" ><?php echo set_value('congratulate_team', $getDefregMastById[congratulate_team]); ?></textarea>
                                            
                                   </div>

                                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                        <?php if($getDefregMastById['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="<?php echo base_url('viewDefectRegiModule');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('viewDefectRegiModule');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } ?>
</form>
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

    <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
    
<script>
$(document).ready(function() 
{
   
    $('#example').DataTable( {
        "paging": false
        
    } );

  
} );
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Defect Regi. details ?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteDefregDetails",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
       alert(result);
   location.reload();
   }
   });
}
 return false;
}






/*function getOpByPartId(Part_Id,nums)
{
 
    var Location_Id =$("#loc_id").val();
    var type = $("#loc_type").val();
    $.ajax({
      url:"<?php echo base_url(); ?>getOpByPartIdType",
      method:"POST",
      data:{Part_Id:Part_Id,Location_Id:Location_Id,type:type},
      success:function(result)
          {
            //alert(result);
             console.log(result);
          $("#Op_Id"+nums).html(result);
          }
      }); 
}*/



function removeNRow1(removeNum) {
jQuery('#rowCount1'+removeNum).remove();
rowCount --;
}

function getLocationbyType(type)
{
    //alert("hello....");
      $.ajax({
          url:"<?php echo base_url(); ?>getLocationType",
          method:"POST",
          data:{type:type},
          success:function(result)
          {
          console.log(result);
          $("select#loc_id").html(result);
        
        }
     });
}



</script>
</body>

</html>