<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Quality Checks | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('qualityChecks');?>">Quality Checks</a></li>
                            
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
                            <h2 style="width: 80%;">Quality Checks</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addQualityChecks');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add Quality Checks</button></a>
                             </div>
                            </div>
                            <div style="overflow : auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Material</th>
                                        <th>Quality Checks Type</th>
                                        <th>Inspection Stage</th>
                                        <th>Inspection Method</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getQualityChecks as $key => $value) { 
                                            $count++;
                                        if($value['material']=='R')
                                        {
                                           $material='Raw Material'; 
                                        }else
                                        {
                                           $material='Parts'; 
                                        }

                                        if($value['qc_type']=='V')
                                        {
                                           $qc_type='Visual'; 
                                        }else if($value['qc_type']=='D')
                                        {
                                           $qc_type='Dimentional'; 
                                        }else
                                        {
                                           $qc_type='Certificate'; 
                                        }
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url(addQualityChecks);?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>
                                                
                                        </td>
                                        <td ><?=$value['id'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['name'];?></td>
                                        <td style="text-transform: uppercase"><?=$material;?></td>
                                        <td style="text-transform: uppercase"><?=$qc_type;?></td>
                                        <td style="text-transform: uppercase"><?=$value['inspection_stage'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['inspection_method'];?></td>
                                       
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
   url:"<?php echo base_url(); ?>/QualityChecksController/deleteRecord",
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