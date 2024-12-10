<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Tool Repair Details | Aditya</title>

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
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                           <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('toolRepairDetailsReport');?>">Tool Repair Details Report</a></li>
                            
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
                            <h2 style="width: 80%;">Tool Repair Details</h2>
                         
                            </div>
                                 
                                <?php echo form_open('/toolRepairDetailsReport', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                          
                                <div class="col-md-3">
                                            <label class="form-label">Tool Maker</label>
                                           
                                            <?php   $cn1= ($getoolRepairDetailsById['supplier_id'])?$getoolRepairDetailsById['supplier_id']:set_value('tool_maker'); ?>
                                            <select id="tool_maker" name="tool_maker" class="form-select alltxtUpperCase">
                                            <option value="">Choose...</option> 
                                            <?php foreach($getSupplier as $row){ ?>     
                                                <option value="<?=$row['id'];?>" <?php if($cn1==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php echo form_error('tool_maker');?>
                               </div>
                               <div class="col-md-3" >
                                            <label class="form-label">Status <label class="mandatory">*</label></label>
                                             <?php   $cn =set_value('status'); ?>
                                               <select class="form-select" name="status" id="status">
                                                   <option value="">Select Status</option>
                                                   <option value="identified" <?php if($cn=='identified'){ echo "selected"; }?>>Identified</option>
                                                   <option value="issued" <?php if($cn=='issued'){ echo "selected"; }?>>Issued</option>
                                                   <option value="received" <?php if($cn=='received'){ echo "selected"; }?>>Received</option>
                                               </select>
                                                <?php echo form_error('status');?>
                               </div>
                                
                                    <div class="col-md-2" style="margin-top: 3%;">
                                    <button type="submit" class="btn btn-primary submit" >Show</button>
                                    </div>
                                </form>   
                                          <?php 
                                if(!empty($_SESSION['dcmsg']))
                                { ?>
                                      <br>      <br>
                                <div style="font-size: 15px;color:green;margin-bottom: 10px;"><?=$_SESSION['dcmsg'];?></div>

                                 <?php 
                                }
                                ?>  
                           <br>
                           
                            <div style="overflow:auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                      <th>Action</th>
                                        <th>ID</th>
                                        <th>Tool Name</th>
                                        <!--<th>New Development</th>-->
                                        <th>Tool Maker</th>
                                        <!--<th>Identified on</th>-->
                                        <!--<th>Issue Date</th>-->
                                        <!--<th>Received Date</th>-->
                                        <!--<th>Estimated Amt.</th>-->
                                        <!--<th>Advance Amt.</th>-->
                                        <th>Tot Amount Paid</th>
                                        <!--<th>Total</th>-->
                                        <th>Nature of repair work</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;
                                 //  print_r($getToolRepair);
                                  
                                foreach ($getToolRepair as $key => $value) { 
                                            
                                         // $supplierD=  $this->getQueryModel->getSupplierById($value['loc_id']);
                                          
                                            $count++;
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('addToolRepair');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" -->
                                        <!--onclick="deleteRecord('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>-->
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('toolRepairPrint');?>?ID=<?php echo base64_encode($value['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>       
                                      </td>
                                <!--`id`, `tool_id`, `tool_name`, `remarks`, `issue_date`, `estimated_amt`, `advance_amt`, `supplier_id`, `tool_maker`, `received_date`, `tot_amt_paid`,-->
                                        <td ><?=$value['id'];?></td>
                                        <td ><?=$value['tool_id']." - ".$value['tool_name'];?></td>
                                        <!--<td ><?=$value['new_development'];?></td>-->
                                        <td ><?=$value['tool_maker'];?></td>
                                        <!--<td><?=($value['identified_on'] && $value['identified_on']!='0000-00-00')?date('d-m-Y',strtotime($value['identified_on'])):"";?></td>-->
                                        <!--<td><?=($value['issue_date'] && $value['issue_date']!='0000-00-00')?date('d-m-Y',strtotime($value['issue_date'])):"";?></td>-->
                                        <!--<td><?=($value['received_date'] && $value['received_date']!='0000-00-00')?date('d-m-Y',strtotime($value['received_date'])):"";?></td>-->
                                        <!--<td><?=($value['estimated_amt'])?$value['estimated_amt']:" - ";?></td>-->
                                        <!--<td><?=($value['advance_amt'])?$value['advance_amt']:" - ";?></td>-->
                                        <td ><?=($value['tot_amt_paid'])?$value['tot_amt_paid']:" - ";?></td>
                                        <!--<td ><?=($value['advance_amt']+$value['tot_amt_paid']);?></td>-->
                                        <td ><?=$value['remarks'];?></td>
                                     
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
        <script src="<?php echo base_url() ?>public/assets/js/bootstrap-multiselect.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
<script>
$(document).ready(function() {
   $('select#tool_name').select2();
} );
function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteDCRecord",
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