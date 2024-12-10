<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Inprocess DPR | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Inprocess-dpr');?>">Inprocess DPR QC</a></li>
                            
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

                             <?php echo form_open('/Inprocess-dpr', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <h3 style="width: 87%;">Inprocess - DPR QC</h3>

                                    <div class="col-md-2" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                         <?php $date=(set_value('date'))?set_value('date'):$_SESSION['pendingDate'];?>
                                       <input id="date" name="date" type="month" class="form-control" value="<?php echo $date;?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                     <div class="col-md-3">
                                         <?php $pendingval=(set_value('pendingval'))?set_value('pendingval'):$_SESSION['pendingVal'];?>
                                        
                                        <select class="form-control" name="pendingval" id="pendingval">
                                            <option <?= ($pendingval == "pending") ? "selected" : ""; ?> value="pending"> Pending </option>
                                            <option <?= ($pendingval == "all") ? "selected" : ""; ?> value="all"> All Records</option>
                                    
                                        </select>
                                  <?php echo form_error('pendingval');?>
                                    </div>

                                        <div class="col-2" style="margin-top: 17px;">
                                        <button type="submit" class="btn btn-primary" id="submitInprocess" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
         <div style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <!--<th>Sr.No.</th>-->
                                        <th>DPR ID</th>
                                        <th>Date</th>
                                        <th>Part No</th>
                                        <th>Part Name</th>
                                        <th>Operation</th>
                                        <th>Operator</th>
                                        <th>Qty</th>
                                         <th>Remark</th>
                                        <th>Q.C.</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php  if(!empty($getDprData)){
                                            $i=1;
                                            foreach ($getDprData as $key => $value) {           ?>
                                           
                                    <tr class="sch_qty" style="<?=$bg;?>">
                                        <td><?= $i;  ?></td>
                                        <td><?= $value['id']; ?></td>
                                         <td><?= $value['dpr_date']; ?></td>
                                        <td><?php 
                                            $partdata = $this->GetQueryModel->getPartBypartid($value['part_id']); ?>
                                            <?= $partdata['partno']; ?>
                                        </td>
                                        <td><?= $partdata['name']; ?></td>
                                        <td>
                                            <?php $operation = $this->GetQueryModel->getOperation($value['operation_id']); ?>
                                            <?= $operation['name'];?></td>
                                        <td>
                                            <?php $GetuserById = $this->GetQueryModel->GetuserById($value['operator_id']); ?>
                                            <?= $GetuserById['fullname'];?></td>
                                            <td>
                                                <?=$value['qty']?>
                                            </td>
                                             <td>
                                                <?=$value['qc_remark'];?>
                                            </td>
                                           <td>
                                                <?=($value['qc_checked_by'])?"Done":"";?>
                                            </td>
                                           
                                        <td><a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?= base_url();?>Add-Inprocessdpr?Id=<?php echo base64_encode($value['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a></td>
                                    </tr>
                                <?php $i++; }  }
                                      ?> 
                                   
                                </tbody>
                            </table>
                            </div>
                            <hr>
                             </form>

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
    <?php if($_SESSION['pendingVal']){ ?>
          $('button#submitInprocess').click();
    <?php } ?>
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
   url:"<?php echo base_url(); ?>/deleteRecordInprocess",
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