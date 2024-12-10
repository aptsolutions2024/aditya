<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title> RM-OB</title>

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

    <style type="text/css">
      .visible {
  height: 3em;
  width: 10em;
  background: yellow;
}
    </style>
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
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>rmob">RMOB</a></li>
                            
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
                            <h2 style="width: 87%;">RM-Opening Balance - <?=$_SESSION['branch_name']; ?></h2>
                            </div>
                              <div style="overflow : auto;">
    <?php echo form_open('/createRMOB', array('autocomplete' => 'off','class' => 'row g-3')); ?>
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
            <thead>
                <tr>
                    <th  align="center"></th>
                    <th  align="center">Sr.No.</th>
                    <th>RM Id</th>
                    <th>Raw Material Name</th>
                    <th>Qty in Kgs</th>
                </tr>
            </thead>
             <?php // echo form_open('/addProdPlanningNew'); ?>
            <tbody>
                <?php 
                    $count=0;
                    foreach ($getRawMaterial as $key => $value) 
                    {
                        $count++;
                        ?>
                 
                 
                <tr style="background: <?= $colorPo; ?>">

                    <td align="center">
                         <input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?=$value['rm_id'];?>" >
                    </td>
                    
                    
                    <td align="center">
                        <?= $count; ?>
                    </td>
                    
                    
                    <td  align="center"> <?= $value['rm_id']; ?>
                        
                    </td>
                    
                    
                   <td> <?= $value['name']; ?>
                   </td>  <!--  Row Matterial Name -->
                   
                   
                    <td> <!--  Reorder qty --> 
                      <input type="text" class="form-control" id="rmob_qty<?= $value['rm_id']; ?>" name="rmob_qty[]" style="width: 100px;" value="<?=($value['ob'])?$value['ob']:0;?>">
                  </td>
                    <input type="hidden" name="rm_id[]" value="<?=$value['rm_id'];?>">
                       <input type="hidden" name="ob_id[]" value="<?=$value['obid'];?>">
                </tr>
                <?php   } ?>
            </tbody>
        </table>
        <!-- <hr> -->
                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary Update">Update</button>
                    <button type="button" id="btnCloseCustomer" onclick="CloseRmreq();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> 
        </form>
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
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
    } );
} );
function deleteRecord1(editId)
{

if (confirm("Are you sure - delete this Customer?")) 
{
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

// manual_qty
$('.manual_qty').on('keyup', function() 
{

        // var qty = $(this).val();

        // var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        // var manualval1 = manualval.trim();

        //  if(parseInt(qty) >= parseInt(manualval1))
        //  {
        //     var mqty = (manualval1 == "-") ? 0 : manualval1;
        //     var req_val = (qty  - mqty);

        //     var totl = (parseInt(mqty) + parseInt(qty) );
        //     $(this).closest('td').next('td').html(req_val);
        //  }else{

        //     // $(this).closest('input[type=text]').focus();
        //     //$(".manual_qty").focus(function(){ $(this).addClass("focused")});
        //  }

});

$('.manual_qty').on('focusout', function() 
{
   
        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();
        
        var mqty = (manualval1 == "-") ? 0 : manualval1;

         //     if(parseInt(qty) >= parseInt(mqty))
         //     {
         //        // var totl = (parseInt(mqty) + parseInt(qty) );
         //        // var req_val = (qty  - mqty);
         //        // var tds = $(this).closest('td').next('td').html(req_val);
         //        // var rm_id =  this.id;

         //        // $.ajax({
         //        //      url:"<?php echo base_url(); ?>updateEquisition",
         //        //         method:"POST",
         //        //         data:{rmid:rm_id,rm_qty:req_val},
         //        //         success:function(result)
         //        //         {
         //        //         tds.css("background-color", "#5fb35f");
         //        //         tds.css("color", "white");
         //        //     }
         //        // });
         //    }else{
         //         var manualval = $(this).closest('td').prev('.plan_req_qty').text(0);

         //        alert("Total Qty should be greater than planning requirment Qty.");

         //    //$(".manual_qty").focus(function(){ $(this).addClass("focused")});

         // }
    });




    function CloseRmreq(removeNum) 
    {
        location.href = 'MangDashboard';

    }
    function getReserverQty(rmId,orgVal) 
    {
       var ManualVal = $("#manual_qty"+rmId).val();
       var ReserverQty = ManualVal-orgVal;
       $("#ReserverQty"+rmId).val(ReserverQty);
       

    } 
    
    
</script>
</body>

</html>