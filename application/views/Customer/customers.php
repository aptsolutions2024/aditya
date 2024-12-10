<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Customer | Aditya</title>

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

                          <li class="breadcrumb-item"><a href="/MangDashboard">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('Customers') ?>">Customer</a></li>
                            
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
                            <?php error_reporting(0); if($_SESSION['createC']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createC'];?>
                                        </div>
                                    <?php } ?>

                           
                             <div class="row">
                            <h2 style="width: 80%;">Customers</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?= base_url(); ?>addCustomers"><button type="button" class="btn btn-secondary" style="float: right;">Add Customer</button></a>
                             </div>
                            </div>

                           
                            <div style="overflow : auto;">
                            <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <!--<th>Sr.No.</th>-->
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        
                                        <th>GST No</th>
                                        <th>Address</th>
                                        <th>Email Id</th>
                                        <th>State Code</th>
                                        <th>Bank Details</th>
                                        <th>Credit Period</th>
                                        <th>Vendor Code</th>
                                        <th>Contact Person Details</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($customers as $key => $value) 
                                        { 
                                            $count++;
                                        
                                     ?>
                                    <tr>
                                       <!-- <td><?=$count;?></td>-->
                                         <td>
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?= base_url();?>addCustomers?ID=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord1('<?=$value['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>
                                                
                                        </td>
                                        <td><?=$value['id'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['name'];?></td>
                                        
                                        <td><?=$value['gst_no'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['address'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['email_id'];?></td>
                                        <td style="text-transform: uppercase"><?=$value['stateCode'];?></td>
                                        <td style="text-transform: uppercase"><?='Bank Name - '.$value['bankName'].' , <br> Account No - '.$value['bank_acno'].' , <br> IFSC Code - '.$value['IFSCCode'];?></td>
                                        <td><?=$value['credit_period'];?></td>
                                        <td><?=$value['vendor_code'];?></td>
                                        <td><?=$value['contact_person_details'];?></td>
                                       
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

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
function deleteRecord1(editId)
{

if (confirm("Are you sure - delete this Customer?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteCustRecord",
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