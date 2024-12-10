<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Parts | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('parts') ?>">Parts</a></li>
                            
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
                            <h2 style="width: 80%;">Parts</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addParts');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add Parts</button></a>
                             </div>
                            </div>
                           
                            <div style="overflow : scroll;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Part No.</th>
                                        <th>Part Name</th>
                                        
                                        <th>Product Family</th>
                                        
                                        <th>UOM</th>
                                        <th>Net Weight</th>
                                        <th>HSN Code</th>
                                        <th>Bin Quantity</th>
                                        <th>Raw Material</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getParts as $key => $value) { 
                                            $count++;

                                        $query = $this->db->query("SELECT mrm.name as rmname,rp.rm_id FROM rel_part_rm rp, mast_rm mrm where rp.part_id='$value[part_id]' and rp.rm_id=mrm.rm_id");
                                        $rmname = $query->result_array();

                                        $query = $this->db->query("SELECT mp.Name as opName FROM rel_part_operation rpo, mast_operation mp where rpo.part_id='$value[part_id]' and rpo.op_id=mp.id and rpo.isdeleted=0");
                                        $opName = $query->result_array();

                                        $query = $this->db->query("SELECT mqc.name as qcName FROM rel_part_qc rpqc, mast_quality_checks mqc where rpqc.part_id='$value[part_id]' and rpqc.qualityID=mqc.id");
                                        $qcName = $query->result_array();


                                        
                                     ?>
                                    <tr>
                                       <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('addParts');?>?ID=<?php echo base64_encode($value['part_id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" -->
                                        <!--onclick="deleteRecord('<?=$value['part_id'];?>');"><i class="demo-pli-trash fs-5"></i></a>-->
                                         <!--<a class="btn btn-icon btn-sm btn-danger btn-hover" href="<?php echo base_url(preDispatchIR);?>?ID=<?php echo base64_encode($value['part_id']);?>"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></a>        -->
                                        </td>
                                        <td ><?=$value['part_id'];?></td>
                                         <td><?=$value['partno'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['name'];?></td>
                                        
                                        <td style="text-transform: uppercase"><?=$value['pfName'];?></td>
                                       
                                        <td><?=$value['uom'];?></td>
                                        <td><?=$value['netweight'];?></td>
                                        <td><?=$value['hsncode'];?></td>
                                        <td><?=$value['bin_qty'];?></td>
                                        <td>
                                            <?php
                                            $rm='';
                                            foreach($rmname as $rmn)
                                            {
                                               
                                               $rm=$rm.$rmn['rm_id'].'-'.$rmn['rmname'].' , ';
                                               
                                            }
                                               echo $rm1= rtrim($rm,', ');
                                            ?>
                                        </td>
                                       <!-- <td>
                                            <?php
                                            $opn='';
                                            foreach($opName as $opmn)
                                            {
                                               
                                               $opn=$opn.$opmn['opName'].' , ';
                                               
                                            }
                                               echo rtrim($opn,', ');
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $qcn='';
                                            foreach($qcName as $qcmn)
                                            {
                                               
                                               $qcn=$qcn.$qcmn['qcName'].' , ';
                                               
                                            }
                                               echo rtrim($qcn,', ');
                                            ?>
                                        </td>-->
                                        
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
   url:"<?php echo base_url(); ?>/RawMaterialController/deleteRecord",
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