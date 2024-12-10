<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View RM Movement | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>RMMovement">RM Movement</a></li>
                            
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
                            <h2 style="width: 80%;">RM Movement</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url();?>addRMMovement"><button type="button" class="btn btn-secondary" style="float: right;">Add Movement</button></a>
                             </div>
                             </div>

                           
                            <div style="overflow : auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                         <th>ID</th>
                                            <th>Part No.</th>
                                        <th>Raw Material</th>
                                        <th>Qty</th>
                                        <th>From Branch</th>
                                        <th>To Branch</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getRMMovement as $key => $value) { 
                                            $count++;
                                        /*$fquery = $this->db->query("SELECT name FROM mast_branch where id='$value[from_branch_id]'");
                                        $fdata = $fquery->row_array();
                                       $fdata = $this->getQueryModel->getBranchbyId($value['from_branch_id']);
                                        $tquery = $this->db->query("SELECT name FROM mast_branch where id='$value[to_branch_id]'");
                                        $tdata = $tquery->row_array();*/
                                        
                                        $rmdata = $this->getQueryModel->getRawMaterialbyrmid($value['rm_id']);
                                        $fdata = $this->getQueryModel->getBranchbyId($value['from_branch_id']);
                                        $tdata = $this->getQueryModel->getBranchbyId($value['to_branch_id']);
                                        
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                                   <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('addRMMovement');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i> </a>  -->
                                       <a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url('rmMvmtPrint');?>?ID=<?php echo base64_encode($value['id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a> 
                                        <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" -->
                                        <!--onclick="deleteRMMovement('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>       -->
                                        </td>
                                         <td ><?=$value['id'];?></td>
                                         <td align=""> <?php
                                             // print_r($value);
                                             $partData= $this->getQueryModel->getPartRmbyid($value['rm_id']);
                                             foreach($partData as $part){
                                                 $pdata= $this->getQueryModel->getPartsById($part['part_id']);
                                                 echo $pdata['partno']." </br>";
                                             }  ?>
                                        </td>
                                        <td ><?=$value['rm_id']." - ".$rmdata['name'];?></td>
                                        <td ><?=$value['qty'];?></td>
                                        <td ><?=$fdata['name'];?></td>
                                        <td ><?=$tdata['name'];?></td>
                                        <td ><?=$value['date'];?></td>
                                        
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
function deleteRMMovement(Id)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteRMMovement",
   method:"POST",
   data:{Id:Id},
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