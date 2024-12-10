<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Tool Repair | Aditya</title>

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

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
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
                             <li class="breadcrumb-item active"><a href="<?php echo base_url('viewToolRepair');?>">Tool Repair</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">            </p>
                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <h2 class="mb-3">  <?php  echo ($getoolRepairDetailsById['id']=='')?"Add Tool Repair Details":"Update Tool Repair Details";?>
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
                                        <?php  
                                     //   print_r($getoolRepairDetailsById);
                                        if($getoolRepairDetailsById['id']==''){ 
                                            //$readonly='';                                        ?>
                                        <?php echo form_open('/createToolRepair', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { //$readonly='disabled'; ?>
                                        <?php echo form_open('/updateToolRepair', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getoolRepairDetailsById['id'];?>">
                                    <?php } ?>
                    <div class="row">
                        <?php
                        if($companyDetails['tool_repair']=='1'){ ?>
                              <div class="col-md-3" >
                                            <label class="form-label">Tool Name <label class="mandatory">*</label></label>
                                             <?php   $cn= ($getoolRepairDetailsById['tool_id'])?$getoolRepairDetailsById['tool_id']:set_value('tool_name'); ?>
                                               <select class="form-select" name="tool_name" id="tool_name">
                                                    <option value="">Select Tools</option>
                                                  <?php 
                                                  foreach($getTools as $tool){ ?>
                                                       <option value="<?=$tool['id'];?>" <?php if($cn==$tool['id']){ echo "selected"; }?>><?=$tool['name'];?></option>
                                                  <?php  }?> 
                                               </select>
                                                <?php echo form_error('tool_name');?>
                             </div>
                                    <?php if($_GET['ID']!=''){ ?>
                                <div class="col-md-3">
                                            <label class="form-label">Tool Maker <?php if($_GET['ID']!=''){ ?><label class="mandatory">*</label><?php } ?></label>
                                         
                                            <?php   $cn1= ($getoolRepairDetailsById['supplier_id'])?$getoolRepairDetailsById['supplier_id']:set_value('tool_maker'); ?>
                                            <select id="tool_maker" name="tool_maker" class="form-select alltxtUpperCase">
                                            <option value="">Choose...</option> 
                                            <?php foreach($getSupplier as $row){ ?>     
                                                <option value="<?=$row['id'];?>" <?php if($cn1==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php echo form_error('tool_maker');?>
                        </div>
                        <?php } ?>
                             <?php }else{  ?>
                               <div class="col-md-3">
                                <label class="form-label">Tool Name <label class="mandatory">*</label></label>
                                 <?php $tool_name=$getoolRepairDetailsById['tool_name']; ?>
                                  <input type="text" name="tool_name" value="<?php echo set_value('tool_name',$tool_name);?>" class="form-control">
                                <?php echo form_error('tool_name');?>
                                </div>
                                       <?php if($_GET['ID']!=''){ ?>
                             <div class="col-md-3">
                                <label class="form-label">Tool maker <?php if($_GET['ID']!=''){ ?><label class="mandatory">*</label><?php } ?></label>
                                 <?php $tool_maker=$getoolRepairDetailsById['tool_maker']; ?>
                                  <input type="text" name="tool_maker" value="<?php echo set_value('tool_maker',$tool_maker);?>" class="form-control">
                                <?php echo form_error('tool_maker');?>
                         </div>
                         <?php } ?>
                    <?php  } ?>
                               <div class="col-3">
                                            <label class="form-label">Identified On<label class="mandatory">*</label></label>
                                              <?php $identified_on=($getoolRepairDetailsById['identified_on'])?$getoolRepairDetailsById['identified_on']:""; ?>
                                            <input id="identified_on" name="identified_on" type="date" class="form-control" value="<?php echo set_value('identified_on',$identified_on); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('identified_on');?>
                                      
                                </div>
                             
                      <?php if($_GET['ID']!=''){ ?>
                                      <div class="col-3">
                                            <label class="form-label">Issue Date <label class="mandatory">*</label></label>
                                              <?php $seldate=($getoolRepairDetailsById['issue_date'])?$getoolRepairDetailsById['issue_date']:""; ?>
                                            <input id="issue_date" name="issue_date" type="date" class="form-control" value="<?php echo set_value('issue_date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('issue_date');?>
                                      
                                </div>
                                       <div class="col-3">
                                            <label class="form-label">Received Date </label>
                                              <?php $received_date=($getoolRepairDetailsById['received_date'])?$getoolRepairDetailsById['received_date']:''; ?>
                                            <input id="received_date" name="received_date" type="date" class="form-control" value="<?php echo set_value('received_date',$received_date); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('received_date');?>
                                        </div>
                                         
                        <?php } ?>
                   
                </div>
      
     <!--`id`, `tool_id`, `tool_name`, `remarks`, `issue_date`, `estimated_amt`, `advance_amt`, `supplier_id`, `tool_maker`, `received_date`, `tot_amt_paid` -->
                    <div class="row"  style="margin-top:2%;">
                     
                      <div class="col-md-3">
                            <label class="form-label">Estimated Amount <?php if($_GET['ID']!=''){ ?><label class="mandatory">*</label><?php } ?></label>
                             <?php $estimated_amt=$getoolRepairDetailsById['estimated_amt']; ?>
                              <input type="text" name="estimated_amt" value="<?php echo set_value('estimated_amt',$estimated_amt);?>" class="form-control">
                            <?php echo form_error('estimated_amt');?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Advance Amount <?php if($_GET['ID']!=''){ ?><label class="mandatory">*</label><?php } ?></label>
                             <?php $advance_amt=$getoolRepairDetailsById['advance_amt']; ?>
                              <input type="text" name="advance_amt" value="<?php echo set_value('advance_amt',$advance_amt);?>" class="form-control">
                            <?php echo form_error('advance_amt');?>
                        </div>
                          <?php if($_GET['ID']!=''){ ?>
                          <div class="col-md-3">
                            <label class="form-label">Tot. Amount Paid <label class="mandatory">*</label></label>
                             <?php $tot_amt_paid=$getoolRepairDetailsById['tot_amt_paid']; ?>
                              <input type="text" name="tot_amt_paid" value="<?php echo set_value('tot_amt_paid',$tot_amt_paid);?>" class="form-control">
                            <?php echo form_error('tot_amt_paid');?>
                        </div>
                        <?php } ?>
                        
                     
                    </div>
                    <div class="col-md-3">
                                <label class="form-label">New Development <label class="mandatory">*</label></label>
                             
                                <?php   $cn111= ($getoolRepairDetailsById['new_development'])?$getoolRepairDetailsById['new_development']:set_value('new_development'); ?>
                                <select id="new_development" name="new_development" class="form-select alltxtUpperCase">
                                    <option value="">Choose...</option> 
                                    <option value="Y" <?php if($cn111=='Y'){echo "selected";} ?> >Yes</option>
                                    <option value="N" <?php if($cn111=='N'){echo "selected";} ?> >No</option>
                                </select>
                                <?php echo form_error('new_development');?>
                        </div>
                    <div class="col-md-9">
                            <label class="form-label">Remarks.</label>
                            <textarea id="remarks" name="remarks" type="text" class="form-control" placeholder="Remarks." ><?php echo set_value('remarks', $getoolRepairDetailsById[remarks]); ?></textarea>
                            
                        </div>

                <div style="border: 1px solid #25476a;" class="col-md-12 "></div>                                <br>
                
                                        <?php if($getoolRepairDetailsById['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="<?php echo base_url('viewToolRepair');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('viewToolRepair');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
<script>
$(document).ready(function() {
   $('select#tool_name').select2();
} );
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Defect Regi. details ?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>dddd",
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