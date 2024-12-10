<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Delivery Challan | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('addDeliveryC');?>">Delivery Challan</a></li>
                            
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
                            <h2 style="width: 80%;">Delivery Challan</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addDeliveryC');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add Delivery Challan</button></a>
                             </div>
                            </div>
                                 
                                <?php echo form_open('/viewDeliveryC', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                   
                                    <div class="col-md-3" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                       <input id="date" name="date" type="month" class="form-control" value="<?php echo set_value('date');?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
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
                                    <tr>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Supplier Name</th>
                                        <th>Date</th>
                                        <th>Challan No.</th>
                                        <th>Branch</th>
                                        <th>DC Type</th>
                                        <th>Remarks</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getTrandcmast as $key => $value) { 
                                            
                                          $supplierD=  $this->getQueryModel->getSupplierById($value['supplier_id']);
                                    
                                            $count++;
                                           
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('addDeliveryC');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" -->
                                        <!--onclick="deleteRecord('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>-->
                                            <a class="btn btn-icon btn-sm btn-danger btn-hover"   href="<?php echo base_url('dcPrint');?>?ID=<?php echo base64_encode($value['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>       
                                        </td>
                                        <td ><?=$value['id'];?></td>
                                        <td style="text-transform: uppercase"><?=$supplierD['name'];?></td>
                                        <td><?=date('d-m-Y',strtotime($value['date']));?></td>
                                        <td><?=$value['dc_no'];?></td>
                                        <td ><?=$value['branch_id'];?></td>
                                        <td ><?=$value['dc_type'];?></td>
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
    
<script>
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