<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Tool Summary | Aditya</title>

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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">
    
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('tranToolDetailReport');?>">Tool Summary</a></li>
                            
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

                             <?php  error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>    

                            <div class="row">
                            <h2 style="width: 82%;">Tool Summary</h2>
                            
                            </div>

                           
                            <br><br><br>
                             <div style="overflow: auto;">
                                 <table class="table table-stripped" style="width:100%" id="example1">
                                       <thead>
                                    <tr>
                                    <th>Sr.No</th>
                                    <th>Tool ID</th>
                                    <th>Tool Name</th>
                                     <th>Tool life</th>
                                    <th>Total Qty(DPR+OB)</th>
                                    <th>Grinding Frequency</th>
                                    <th>Grinded on date</th>
                                    <th>QTY after grinding(DPR)</th>
                                </tr>
                                  </thead>
                                      <tbody>
                                   <?php  
                                 
                                $getallTools =  $this->getQueryModel->getTools();
                                $srno=0;
                                 foreach ($getallTools as $key => $value) {
                                 $srno++;
                                    $getToolQty =  $this->getQueryModel->getToolDPRQtyById($value['id']); 
                                     $getToolTotalQty =  $this->getQueryModel->getToolTotalQtyById($value['id']); 
                                    
                                 ?>
                                 <tr>
                                    <td><?=$srno;?></td> 
                                    <td><?=$value['id'];?></td>
                                    <td><?=$value['name'];?></td>
                                    <td><?=number_format($value['ideal_qty'],0,'.',',');?></td>
                                    <td><?=number_format(($getToolTotalQty['dpr_qty']+$getToolTotalQty['ob']),0,'.',',');?></td>
                                    <td><?=number_format($value['grinding_frequency'],0,'.',',');?></td>
                                     <td><?=($getToolQty['grinded_on'])?date('d-m-Y',strtotime($getToolQty['grinded_on'])):"";?></td>
                                    <td><?php echo number_format($getToolQty['dpr_qty'],0,'.',','); ?> </td>
                                </tr>
                                <?php
                               
                                } ?>
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

    <!-- SCROLL TO TOP BUTTON -->
    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->



    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

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
    <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   

<script>
$(document).ready(function() {
 
      $('#example1').DataTable( {
        dom: 'Bfrtip',
        "paging": false,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
} );



</script>
</body>

</html>