<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Part Movement Supplier | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('PartsMovementSupl');?>">Part Movement Supplier</a></li>
                            
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
                            <h2 style="width: 80%;">Parts Movement Supplier</h2>
                            <div class="mb-4" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('AddPartsMovementSupl');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add Part Movement Supplier </button></a>
                             </div>
                            </div>
                             <div style="overflow:auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <!--<th>Action</th>-->
                                        <th>DC ID</th>
                                        <th>RCIR ID</th>
                                        <th>Part Name</th>
                                        <th>From Operation</th>
                                        <th>From Supplier</th>
                                        <th>To Operation</th>
                                        <th>To Supplier</th>
                                        <th>RCIR Qty</th>
                                        <th>DC Qty</th>
                                        <th>Branch</th>
                                        <th>Tran Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                       //echo "<pre>"; print_r($getPartsSuplMovement);echo "</pre>";
//`id`, `part_id`, `tran_date`, `rcir_op_id`, `dc_op_id`, `rcir_id`, `dc_id`, `rcir_supl_id`, `dc_supl_id`, `rcir_qty`, `dc_qty`, `branch_id`
                                        foreach ($getPartsSuplMovement as $key => $value) { 
                                            $count++;
                                        $pdata = $this->getQueryModel->getPartBypartid($value['part_id']);
                                        $FromOP = $this->getQueryModel->getOperation($value['rcir_op_id']);
                                        $ToOP = $this->getQueryModel->getOperation($value['dc_op_id']);
                                        $fdata = $this->getQueryModel->getSupplierById($value['rcir_supl_id']);
                                        $tdata = $this->getQueryModel->getSupplierById($value['dc_supl_id']);
                                        $bData = $this->getQueryModel->getBranchbyId($value['branch_id']);
                                     ?>
                                    <tr>
                                        <td ><?=$count;?></td>
                                        <!--<td class="text-center text-nowrap">-->
                                        <!--   <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('addPartsMovement');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>  -->
                                        <!--   <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('partMvmtPrint');?>?ID=<?php echo base64_encode($value['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a> -->
                                        <!--</td>-->
                     <!--`id`, `part_id`, `tran_date`, `rcir_op_id`, `dc_op_id`, `rcir_id`, `dc_id`, `rcir_supl_id`, `dc_supl_id`, `rcir_qty`, `dc_qty`, `branch_id`-->
                                         <td ><?=$value['dc_id'];?></td>
                                        <td ><?=$value['rcir_id'];?></td>
                                        <td ><?=$pdata['partno']." - ".$pdata['name'];?></td>
                                        <td ><?=$FromOP['name'];?></td>
                                        <td ><?=$fdata['name'];?></td>
                                        <td ><?=$ToOP['name'];?></td>
                                        <td ><?=$tdata['name'];?></td>
                                        <td ><?=$value['rcir_qty'];?></td>
                                        <td ><?=$value['dc_qty'];?></td>
                                        <td ><?=$bData['name'];?></td>
                                        <td ><?=date('d-m-Y',strtotime($value['tran_date']));?></td>
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
   url:"<?php echo base_url(); ?>/deleteTrantoolRec",
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