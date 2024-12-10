<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add RMQC | Aditya</title>

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
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css"> -->

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
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                             <li class="breadcrumb-item"><a href="<?= base_url('MangDashboard'); ?>"> Home </a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('RMQC'); ?>"> Add Raw Material Quality Check</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">
                    </p>
                </div>
            </div>
          

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php 
                     if($_GET['Id'] ==''){ ?>
                    <h2 class="mb-3">Add RMQC</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update RMQC</h2>
                    <?php } ?>

                    <?php
                        // echo "<pre>";
                        // print_r($GetDPRById);
                        // die;


                    ?>

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       <?php error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($GetDPRById[0]['dpr_date']==''){  ?>
                                        <?php echo form_open('/CreateRMQC', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {  ?>
                                        <?php echo form_open('/Update-DPR', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } ?>
                                    <input type="hidden" name="editId" class="editId" value="<?= (!empty($GetDPRById)) ? $GetDPRById['id'] : 0;?>">
                                        <form class="row g-3">
                                           
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                            <label for="" class="form-label">Select Date : <label class="mandatory"></label></label>
                                        </div>
                                         <div class="col-md-2"> 
                                            <input type="month" name="txtDate" onchange="datesel(1);" <?= (!empty($GetDPRById[0][dpr_date]) ? "readonly" : "" ) ?> value="<?= $GetDPRById[0][dpr_date]; ?>" required class="form-control txtDate" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                        </div>
                                       <div class="col-md-1" align="center" style="margin-top:27px;">
                                            <label for="" class="form-label"> Supplier : <label class="mandatory"></label></label>
                                        </div>
                                         <div class="col-md-2"> 
                                           <select class="form-control txtsupplier" onchange="suppselect();" required name="txtsupplier">
                                            <option> Select Supplier </option>
                                            <?php
                                            foreach ($getSupplier as $key => $value) 
                                                { if($value['supl_type'] == 1) {?>
                                               <option value=<?= $value['id']; ?>> <?= $value['name']; ?> </option>
                                                
                                            <?php } } ?>
                                           </select>
                                        </div>
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                            <label for="" class="form-label">RM Name: <label class="mandatory"></label></label>
                                        </div>
                                         <div class="col-md-2"> 
                                            <select class="form-control txtrmname" onchange="getQty();" required name="txtrmname">
                                            <option> Select Row Material </option>
                                           
                                           </select>
                                        </div>
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                            <label for="" class="form-label">Rec Qty.: <label class="mandatory"></label></label>
                                        </div>
                                         <div class="col-md-2"> 
                                            <div><input class="form-control rec_qty" value="" readonly></div>
                                        </div>
                                        <div class="datatable1"></div>

                          

                                               <div class="col-md-12 modal-footer">
 


                                            <?php 

                                            $id = base64_decode($_GET['Id']);

                                            if($id == ''){ ?>
                                         
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary update_btn">Update</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    </form>
                                        <!-- END : Block styled form -->
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </section>
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
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/dataTables.buttons.min.js"></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->

<script type="text/javascript">

    var editval = $(".editId").val();

    $( document ).ready(function() 
    {
        datesel(1);

         $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );

    });



     function editpartsfn()
    {
      
          var date = new Date($('.txtDate').val());
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var date = [year, month, day].join('-');

                $.ajax({
                    url: "<?= base_url('getProdPart_Id'); ?>",
                    data: {date : date},
                    // dataType: "json",
                    type: "POST",
                    success: function(data)
                    {
                        $(".edit_part").html(data);
                    }
                });
       
    }


   if(editval != 0)
   {

        var part_ids1 = $(".part_ids1").val();
        partsfn(part_ids1);
        datesel(1);
        txttools2();
      
   }

    function datesel(id)
    {
       

        // $('.txtDate').on('change', function()
        // {
          var date = new Date($('.txtDate').val());
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var date = [year, month, day].join('-');

                $.ajax({
                    url: "<?= base_url('getProdPart_Id'); ?>",
                    data: {date : date},
                    // dataType: "json",
                    type: "POST",
                    success: function(data)
                    {
                        console.log(data);

                        $(".parts"+id).html(data);
                    }
                });
       // });
    }
  

function txttools2() 
{

   // $('.txttools').on('change', function()
   // {
        var dataid = ($(".txttools").find(':selected').data('id'));
        var dataqty = ($(".txttools").find(':selected').data('qty'));

        $(".idealqty").text(dataqty);

        $(".tool_latestDate").val(dataid);

        $.ajax({
                url: "<?= base_url('getToolSucess'); ?>",
                data: {date : dataid},
                // dataType: "json",
                type: "POST",
                success: function(data)
                {
                    var perc = Math.round(100*data/dataqty)

                        $(".qtyaftlat").val(data);
                        $(".percentage").text(perc+'%');
                        $('#theprogressbar').attr('aria-valuenow', perc).css('width', perc+'%');
                        $('#theprogressbar').attr('aria-valuenow', perc).css('width', perc+'%');


                        if(perc > 85)
                        {
                            $("#theprogressbar" ).addClass( "progress-bar progress-bar-striped bg-warning" );
                        }
                        if(perc > 100)
                        {
                           
                            $("#theprogressbar" ).addClass( "progress-bar progress-bar-striped bg-danger" );
                        }


                }
            });



   // });
}

    function getQty() 
    {
      var rm_qty = ($('.txtrmname').find(':selected').data('id'));

      $('.rec_qty').val(rm_qty);

        
        $.ajax({
            url: "<?= base_url('getRmDatatable'); ?>",
            data: {rm_qty : rm_qty},
            type: "POST",
            success: function(data)
            {
                // $(".txtrmname").html(data);
                 $('.datatable1').append(data);
            }
        });


    

       // $('.datatable1').append(recRow1);

    }
    function suppselect() 
    {
        var supplier_id = $(".txtsupplier option:selected").val();
        $.ajax({
            url: "<?= base_url('getRMBySupplId'); ?>",
            data: {supplier_id : supplier_id},
            // dataType: "json",
            type: "POST",
            success: function(data)
            {
                $(".txtrmname").html(data);
            }
        });
    }
function operationfn(id) 
{
    var part_id      = $(".parts"+id+" option:selected").val();
    var Operations  = $(".Operations"+id+" option:selected").val();
    
            $.ajax({
                url: "<?= base_url('getToolbyPartOperation'); ?>",
                data: {part_id : part_id,Op_id : Operations},
               
                type: "POST",
                success: function(data)
                {
                    $(".txttools"+id).html(data);
                }
            });
      
}
$('.Operations1').change(function() {
  

     var prod_plan_id = ($('.parts1').find(':selected').data('id'));
    

     $('#prod_plan_id').val(prod_plan_id);
});



var rowCount2 = 2;
    function addDpr(frm) {
        
        datesel(rowCount2);
        
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div style="border: 1px dotted #df5645;margin-top: 15px;"></div><br><div class="row"><div class="col-md-3"><label for="" class="form-label">Select Part<label class="mandatory">*</label></label><input type="hidden" class="part_ids1" name="part_ids" value="<?= $GetDPRById[part_id]; ?>"><select class="form-control parts'+rowCount2+'" name="txtpart[]" onchange="partsfn('+rowCount2+')" required><option value=""> Select Part</option></select></div> <div class="col-md-3"><label for="" class="form-label">Operations <label class="mandatory">*</label></label><select class="form-control Operations'+rowCount2+'" onchange="operationfn('+rowCount2+')" required name="txtoperations[]"><option value="">Select Operations</option></select><?php echo form_error('txttype');?></div>  <div class="col-md-3"><label for="" class="form-label">Tools <label class="mandatory">*</label></label> <select class="form-control txttools'+rowCount2+'" onchange="txttools2()" required name="txttools[]"> <option value="">Select Tools</option></select><?php echo form_error('txttype');?>
</div> <div class="col-md-3"><label for="" class="form-label">Machine <label class="mandatory">*</label></label><select class="form-control" required name="txtmachines[]"> <option value="">Select Machine</option><?php foreach ($Getmachine  as $key => $value5) 
{
$selected = ($GetDPRById['machine_id'] == $value5['id']) ? "selected" : "";
?>
<option <?= $selected; ?> value="<?= $value5['id']; ?>"><?= $value5['name']; ?></option><?php }?>
</select><?php echo form_error('txttype');?>
</div><div class="col-md-3"><label for="" class="form-label">Scrap Used <label class="mandatory">*</label></label><select class="form-control" required name="txtscrap[]"><option value="N" <?= ($GetDPRById[scrap_used] == "N") ? "selected" : "" ?> >No</option><option value="Y" <?= ($GetDPRById[scrap_used] == "Y") ? "selected" : "" ?>>YES</option></select><?php echo form_error('txttype');?></div><div class="col-md-3"><label for="" class="form-label">Operator<label class="mandatory">*</label></label><select class="form-control txtoperator" name="txtoperator[]" required><option value="">Select Operator</option><?php foreach ($Getusers as $key => $value4) 
{
     $selected = ($GetDPRById['operator_id'] == $value4['id']) ? "selected" : "";
?>
<option <?= $selected; ?> value="<?= $value4['id']; ?>"><?= $value4['fname']; ?></option><?php }?>
</select><?php echo form_error('txttype');?>
</div><div class="col-md-3"><label for="" class="form-label">Work Hours<label class="mandatory">*</label></label><input id="txthours"  name="txthours[]" type="text" maxlength="11"   style="text-transform: uppercase"   class="form-control" placeholder="Work Hours 00 Hours. 00 minutes" value="<?php echo set_value('txthours', $GetDPRById[work_hours]); ?>"><?php echo form_error('txthours');?>
</div><div class="col-md-3"><label for="" class="form-label">Qty<label class="mandatory">*</label></label><input id="txtQty" name="txtQty[]"  type="number" maxlength="11"   style="text-transform: uppercase"   class="form-control" placeholder="Qty" value="<?php echo set_value('txtQty', $GetDPRById[qty]); ?>"><?php echo form_error('txtQty');?>
</div>  <div class="col-md-11"><label for="" class="form-label">Remark<label class="mandatory"></label></label><textarea class="form-control" name="txtremark[]" placeholder="Remark" style="height: 10px;"> <?= (!empty($GetDPRById)) ? $GetDPRById[remarks] : "" ?></textarea></div><div class="col-md-1" align="center" style="margin-top: 39px;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div> </div>';
    jQuery('#addDpr1').append(recRow);

        rowCount2 ++;
    }
     function removeRow1(removeNum) {
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }


    function CloseCustomer(removeNum) 
    {
        location.href = 'RMQC';
    } 

    $('#txtQty').focusout('change', function()
    {
        var partid = $(".parts option:selected").val();
        var qty = $(this).val();
        $.ajax({
                    url: "<?= base_url('getRMByPartId'); ?>",
                    data: {partid : partid,qty:qty},
                    // dataType: "json",
                    type: "POST",
                    success: function(data)
                    {
                       if(data == 0)
                       {

                       }else
                       {
                           $("#txtQty").val(); 
                       }
                    }
                });
        
    });
</script>

</body>

</body>

</html>