<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Tran-DPR | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Tran-DPR">Daily Production Report</a></li>
                            
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
                                           
                                        <h2 style="width: 80%;">Daily Production Report</h2>
                                 
                                        <div class="col-2" align="right" >  
                                            <a href="<?php echo base_url("Create-DPR"); ?>" class="btn btn-secondary" >Add DPR</a></div>
                                        </div>
                            

                             <?php echo form_open('/Tran-DPR', array('autocomplete' => 'off','class' => 'row g-3')); ?>

                                      
                                        </form>

                                        <br><br>

                            <table id="example" class="display" style="width:100%">
                                <thead >
                                    <tr>
                                        <th width="5%">Action</th>
                                     
                                        <th width="10%">Sr.No.</th>
                                        <th>Date</th>
                                        <th>Count</th>
                                      
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getDprData as $key => $value) 
                                        { 

                                            $count++;
                                     ?>
                                        <tr class="sch_qty">
                                         <td>
                                        <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?= base_url();?>Update-DPR?Id=<?php echo base64_encode($value['dpr_date']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>
                                        
                                                
                                        </td>
                                       
                                       
                                        <td align="center"> <?= $count; ?></td>
                                        <td> <?= date("d-M-Y", strtotime($value['dpr_date'])); ?></td>
                                        <td> <?= $value['Count']; ?></td>
                                        
                                        
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr>
                             <!-- <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary Update">Save</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div> --> </form>

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
$(document).ready(function() 
{
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );


} );

// $('select[name="usStock"]').on('change', function(){    
//     alert($(this).val());    
// });

$('.usStock').on('change', function() {

     var drval = $(this).val();

  if(drval == "YES")
  {
     //var Req_Qty = $(this).closest('td').next('.Req_Qty').text();
    // var ActivQty = $(this).closest('td').prev('.ActivQty').text();
    // var scheduled_qty = $(this).closest('td').prev('.scheduled_qty').text();

        var scheduled_qty =  $(this).closest('tr').find('.scheduled_qty').text();
        var ActivQty =  $(this).closest('tr').find('.ActivQty').text();
        var ReqVal = (scheduled_qty - ActivQty);
        $(this).closest('tr').find('.Req_Qty').text(ReqVal);
        $(this).closest('tr').find('.planning_qty').val(ReqVal);

  }else{
        var scheduled_qty =  $(this).closest('tr').find('.scheduled_qty').text();
        var ActivQty =  $(this).closest('tr').find('.ActivQty').text();
        var ReqVal = (scheduled_qty);
        $(this).closest('tr').find('.Req_Qty').text(ReqVal);
         $(this).closest('tr').find('.planning_qty').val(ReqVal);
  }

  


}); 
function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteOptsRecord",
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