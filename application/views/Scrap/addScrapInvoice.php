<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Scrap Invoice | Aditya</title>

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
     <!-- Tabulator Style [ OPTIONAL ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/buttons.dataTables.min.css">
    <style>
        input#togglecheckbx {
              width: 19px;
               height: 19px;
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
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                           <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?= base_url('scrapInvoice'); ?>">Scrap Invoice</a></li>
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
                     if(empty($getTranScrapInvoice['id'])){ ?>
                    <h2 class="mb-3">Add Scrap Invoice</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update Scrap Invoice</h2>
                    <?php } ?>


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
                                         <?php 
                                         $readonly="";
                                         if(empty($getTranScrapInvoice['id'])){   ?>
                                        <?php echo form_open('/createScrapInvoice', array('autocomplete' => 'off','class' => 'row g-3'));   ?>
                                         <?php }else{  ?>
                                    <?php echo form_open('/createScrapInvoice', array('autocomplete' => 'off','class' => 'row g-3'));   ?>
                                     <input type="hidden" name="editId" value="<?=$getTranScrapInvoice['id'];?>">
                                     <?php
                                     //print_r($getTranScrapInvoice);
                                     $readonly='readonly';
                                     }  ?>
                                       <p  style="color:red;text-transform:capitalize;">To reduce the Scrap stock in the system, please enter negative(-) adjustment quantity.
                                        <br>To increase the Scrap stock in the system, please enter positive(+) adjustment quantity. </p>
                                        <div class="col-md-3"> 
                                            <?php $seldate=($getTranScrapInvoice['id'])?$getTranScrapInvoice['invoice_date']:date('Y-m-d'); ?>
                                           <label for="" class="form-label">Invoice/Stock_Adj Date : <label class="mandatory">*</label> </label>
                                           <input type="date" id="invoice_date" name="invoice_date" value="<?php echo $seldate;?>"  class="form-control txtDate" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>" onchange="getScrapQty()" <?=$readonly;?> >
                                         </div>
                                         <div class="col-md-3">
                                          
                                            <label for="" class="form-label">Invoice No/For Stock_Adj Put -<label class="mandatory">*</label></label>
                                           
                                                    <input type="text" class="form-control invoice_no" id="invoice_no"  name="invoice_no" value="<?=$getTranScrapInvoice['invoice_no'];?>" onkeypress="return isDecimalNumber(event);" <?=$readonly;?>>
                                        </div> 
                                         <div class="col-md-3">
                                            <label for="" class="form-label">Scrap Type <label class="mandatory">*</label></label>
                                             <?php $selectedS = $getTranScrapInvoice['scrap_type']; ?>  
                                              <select class="form-control txttools1" required name="type" id="type" onchange="getScrapQty()" <?=$readonly;?>>
                                                <option value="NORMAL" <?php if($selectedS=='NORMAL'){ echo "selected";} ?>>NORMAL</option>
                                                <option value="SS" <?php if($selectedS=='SS'){ echo "selected";} ?>>SS</option>
                                            </select>
                                        </div>
                                           <div class="col-md-3">
                                            <label for="" class="form-label">Branch <label class="mandatory">*</label></label>
                                          <select class="form-control branch_id" required name="branch_id" onchange="getScrapQty()" <?=$readonly;?>>
                                              <?php 
                                                  $getBranch = $this->getQueryModel->getBranch();
                                              ?>
                                               <?php $selbranch = $getTranScrapInvoice['branch_id']; ?>  
                                              
                                                <?php foreach ($getBranch  as $key => $value5) {
                                                if($_SESSION['branch_id']==$value5['id']){
                                                ?>
                                                
                                                <option  value="<?= $value5['id']; ?>" <?php if($selbranch==$value5['id']){ echo "selected";} ?>><?= $value5['name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                          
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Invoice Quantity (Kgs) <label class="mandatory">*</label></label>
                                             <input type="text" class="form-control" id="invoice_qty" name="invoice_qty" value="<?=($getTranScrapInvoice['invoice_qty'])?$getTranScrapInvoice['invoice_qty']:0;?>" onkeypress="return isDecimalNumber(event);">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Stock Adj Quantity (Kgs)</label>
                                             <input type="text" class="form-control" id="stock_adj_qty" name="stock_adj_qty" value="<?=($getTranScrapInvoice['stock_adj_qty'])?$getTranScrapInvoice['stock_adj_qty']:0;?>"  >
                                        </div>
                                           <div class="col-md-3">
                                            <label for="" class="form-label">Available Quantity (Kgs)</label>
                                             <input type="text" class="form-control" id="available_qty" name="available_qty" value="<?=$getTranScrapInvoice['available_qty'];?>" onkeypress="return isDecimalNumber(event);"  readonly>
                                        </div>
                                       
                                        <!--<div class="col-md-2">-->
                                        <!--          <button type="button" class="btn btn-primary" onclick="getScrapQty()" style="margin-top: 14%;">Show</button> -->
                                        <!--</div>-->
                                        <div class="col-md-12 modal-footer">
                                     <div class="col-12" align="center">
                                        <button type="submit" class="btn btn-primary Update"><?php if(!empty($getTranScrapInvoice['id'])){ echo "Update"; }else{ echo "Add"; } ?></button>
                                        <button type="button" id="btnCloseCustomer" onclick="CloseRmreq();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div> 
                                    </div>
                                       <div class="row scrapData" style="overflow : auto;"></div>
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
    <?php  $this->load->view('/include/jsPage'); ?>

<script type="text/javascript">


$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        pageLength: 25,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    getScrapQty();
} );

function SelectAll(){
         var selected=$("#togglecheckbx").prop("checked");
         
          $('input[name="checkboxVal[]"]').each(function() {
              
             $('#example input[name="checkboxVal[]"]').prop('checked', selected);
            
         });
         calTotal();
}

function calTotal(){
    //alert("hello");
     var totalval=0;
    $('input[name="checkboxVal[]"]:checked').each(function() {
   
   var num=this.value;
   //console.log(parseFloat($('#scrapVal'+num).val()));
   totalval=(totalval + parseFloat($('#scrapVal'+num).val()));
   });
    $('#totscrapVal').val(totalval);
}

  function isDecimalNumber(evt) {
          var charCode = (evt.which) ? evt.which : evt.keyCode
          if (charCode == 46) {
          return true;
          }
          else if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
          return true;
         }

    function CloseCustomer(removeNum) 
    {
        location.href = 'scrapInvoice';
    } 
    
    function getScrapQty(){
        
             // var date =  $("#txtDate").val();
              //var invoice_no = $(".invoice_no").val();
              var branch_id =  $(".branch_id").val();
              var type = $("#type").val();
              var date=$("#invoice_date").val();
              
             $.ajax({
                url: "<?= base_url('getScrapbyvalue'); ?>",
                data: {branch_id:branch_id,type:type,date:date},
                type: "POST",
                success: function(data)
                {
                    console.log(data);
                    $("#available_qty").val(data);
                     
                }
            });
      
    }
</script>

</body>

</html>