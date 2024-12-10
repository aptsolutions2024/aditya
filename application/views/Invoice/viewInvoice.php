<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Invoice | Aditya</title>

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
    <style>
        
         table.commontoggle tr td.details-control {
    background: url('<?php echo base_url() ?>public/assets/img/details_open.png') no-repeat center center;
    cursor: pointer;
    }
  table.commontoggle  tr.shown td.details-control {
        background: url('<?php echo base_url() ?>public/assets/img/details_close.png') no-repeat center center;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('viewInvoice');?>">Invoice</a></li>
                            
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

                                   <?php  if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>   
                                     <?php if($_SESSION['insuffstock']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['insuffstock'];?>
                                        </div>
                                    <?php } ?>  
                            <div class="row">
                            <h2 style="width: 80%;">Invoice</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addInvoice');?>"><button type="button" class="btn btn-secondary" style="float: right;">Add/Update Invoice</button></a>
                             </div>
                            </div>

                            <?php echo form_open('/viewInvoice', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    <div class="col-md-4">
                                       <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                       <?php $cn= set_value('Customer_Id'); ?>
                                       <select id="Customer_Id" name="Customer_Id" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getparts['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('Customer_Id');?>
                                    </div>

                                    <div class="col-md-2">
                                       <label class="form-label">Schedule Date<label class="mandatory">*</label></label>
                                       <input id="schedule_date" name="schedule_date" type="month" class="form-control" value="<?php echo set_value('schedule_date', $getparts[schedule_date]); ?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('schedule_date');?>
                                    </div>


                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                            
   <div style="overflow:auto;">
                            <table id="example" class="display commontoggle" style="width:100%;text-transform: uppercase;">
                                <thead>
                                    <tr>
                                       
                                        <th width="10%">Action</th>
                                        <!--<th>Mast ID</th>-->
                                        <!--<th>Branch</th>-->
                                        <!--<th>Customer Name</th>-->
                                        <th>Part No.</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice No.</th>
                                        <th>Invoice Qty</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                    foreach ($getInvMast as $key => $mvalue) { 
                                            $count++;
                                        $query = $this->db->query("SELECT * FROM mast_customer where id=".$mvalue['customer_id']);
                                        $custdata = $query->row_array();
                                         $pData = $this->getQueryModel->getPartsById($mvalue['part_id']);
                                             $bData = $this->getQueryModel->getBranchbyId($mvalue['branch_id']);
                                     ?>
                                    <tr>
                                        <td>
                                          <a class="btn btn-icon btn-sm btn-primary btn-hover" href="<?php echo base_url('editInvDetails');?>?ID=<?php echo base64_encode($mvalue['id']); ?>"><i class="demo-pli-pen-5 fs-5"></i></a>    
                                          <a class="btn btn-icon btn-sm btn-danger btn-hover" onclick="deleteRecord('<?=$mvalue['id'];?>','<?=$mvalue['inv_det_id'];?>');"><i class="demo-pli-trash fs-5"></i></a>
                                        </td>
                                        <!--<td><?=$mvalue['id']." - ".$mvalue['inv_det_id'];?></td>-->
                                        <!--<td><?=$bData['name'];?></td>-->
                                        <!--<td><?=$custdata['name'];?></td>-->
                                        <td><?=$mvalue['part_id']." - ".$pData['partno']."  ".$pData['name'];?></td>
                                        <td><?=date('d-m-Y',strtotime($mvalue['date']));?></td>
                                        <td><?=$mvalue['invoice_no'];?></td>
                                        <td><?=$mvalue['qty'];?></td>
                                    </tr>
                                    
                                    <?php  } ?>
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
    
 var schedule_date =$("#schedule_date").val();    
 if(schedule_date=='')
 {
var monthControl = document.querySelector('input[type="month"]');
var date= new Date();
var month=("0" + (date.getMonth() + 1)).slice(-2);
var year=date.getFullYear();
monthControl.value = `${year}-${month}`;
 showSch();
}
} );

function showSch()
{
    var formSubmitFlag =$("#formSubmitFlag").val();
    if(formSubmitFlag==0 || formSubmitFlag=='')
    {
    var frm = document.getElementById("formSch");
    frm.submit();
    }
    //window.location.href = "<?php echo base_url(); ?>schedule";
}
function deleteRecord(mastid,invdetId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteInvoiceRecord",
   method:"POST",
   data:{mastid:mastid,invdetId:invdetId},
   success:function(result)
   {
     alert('Affected Records:'+result);
      location.reload();
   }
   });
}
}
function toggleTable(num){
    $("#collapse"+num).toggle();
     $("tr#detailrow"+num).toggleClass("shown");
}
</script>
</body>

</html>