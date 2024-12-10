<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Parts Open Balance | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('PartsOpeningBal');?>">Parts Opening Balance</a></li>
                            
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
                            <h2 style="width: 87%;">Parts Opening Balance</h2>
                            <div class="mb-3" style="float: right;width: 13%;">
                                 <a href="<?php echo base_url();?>addPartsOpenBal"><button type="button" class="btn btn-secondary">Add Part Opening Balance</button></a>
                             </div>
                             </div>
                             <?php //echo "<pre>";print_r($getPartopenbalList);echo "</pre>";?>
                           
                            <div style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Year</th>
                                        <th>Part Name</th>
                                        <th>Operation</th>
                                        <th>Opening Balance Qty</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getPartopenbalList as $key => $value) { 

                                        $count++;
                                        $pdata = $this->getQueryModel->getPartBypartid($value['part_id']);
                                        $Odata = $this->getQueryModel->getOperation($value['op_id']);
                                        
                                     ?>
                                    <tr>
                                        <td class="text-center text-nowrap">
                                            <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('addPartsOpenBal');?>?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>    
                                        </td>
                                        <td ><?=$value['doc_year'];?></td>
                                        <td ><?=$pdata['partno']." - ".$pdata['name'];?></td>
                                        <td ><?=$Odata['name'];?></td>
                                        <td ><?=$value['received_qty'];?></td>
                                        
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
    

</body>

</html>