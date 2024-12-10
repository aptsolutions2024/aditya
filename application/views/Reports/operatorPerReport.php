<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="">
    <title>Operator Performance Print | Aditya</title>

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
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/bootstrap-multiselect.css">

     <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />

    
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
                               <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('OperPerformanceR');?>">Operator Performance Print</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                   
                    

                    <section>
                        <div class="row">
                             <h2 class="mb-3 btnprnt">Operator Performance Print</h2>
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                      <?php //echo '<pre>';print_r($Getoperators); echo "</pre>"; ?>
                                      <div class="row" style="margin-bottom: 20px;">
                                      <div class="col-md-4 btnprnt">
                                            <label class="form-label">Choose Operator <label class="mandatory">*</label></label>
                                           
                                            <select id="operator" class="form-select" onchange="getOperPer();" >
                                                <option value=""></option> 
                                               <?php foreach($Getoperators as $operator){ ?>
                                                <option value="<?=base64_encode($operator['id']);?>"><?=$operator['fullname']?></option>
                                               <?php }?>

                                            </select>                                           
                                        </div>
                                        <div class="col-md-3 btnprnt"> 
                                            <label class="form-label">From Date <label class="mandatory">*</label></label>
                                            <input type="date" name="fromDate" id="fromDate" onchange="getOperPer();" value="" required="" class="form-control" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                        </div>
                                        <div class="col-md-3 btnprnt"> 
                                            <label class="form-label">To Date <label class="mandatory">*</label></label>
                                            <input type="date" name="toDate" id="toDate" onchange="getOperPer();" value="" required="" class="form-control" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                        </div>
                                    </div>
                                        <div id="operatorinfo" style="overflow: auto;">
                                            
                                        </div>
                                     
                                      
                                      <br>
                                    <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
                                    
                                    <a href="<?php echo base_url('OperPerformanceR');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
                                    </div>
                                    <br>
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


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
    <script src="<?php echo base_url() ?>public/assets/js/bootstrap-multiselect.js"></script>
 <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  font-size: 15px;
}


@media print
{
.btnprnt{display:none}
}

</style>    
<script>
$( document ).ready(function() {
    getOperPer();
});
function myFunction() {

window.print();

}
function getOperPer(){
   var operId=$("#operator option:selected").val();
    var operName=$("#operator option:selected").text();
    var fromDate=$('#fromDate').val();
     var toDate=$('#toDate').val();
    
      if(fromDate>toDate && toDate!=""){
          alert("Invalid Dates"); 
          $("#operatorinfo").html("");
          //return;
      }
      
 
    $.ajax({
            url: "<?php echo base_url('showOPereport') ?>",
            type: "GET",
            data: { id:operId,fromDate:fromDate,toDate:toDate
             },          
            success: function( response ) {       
               console.log(response);
               $("#operatorinfo").html(response);
               $(".operatorName").html(operName);

                 if(fromDate!="" && fromDate!=null){

                let objectDate = new Date(fromDate);
                let fromday = objectDate.getDate();
                let frommonth = objectDate.getMonth();
                frommonth=frommonth + 1;
                let fromyear = objectDate.getFullYear();
                console.log(fromday+"/"+frommonth+"/"+fromyear);
                 $(".displayFromdate").html(fromday+"/"+frommonth+"/"+fromyear);
             }
             
              if(toDate!="" && toDate!=null){
              
                let objectDate1 = new Date(toDate);
                let todateday = objectDate1.getDate();
                let tomonth = objectDate1.getMonth();
                tomonth=tomonth + 1;
                let toyear = objectDate1.getFullYear();
                 $(".displayTodate").html(todateday+"/"+tomonth+"/"+toyear);
             }
             

            }
        });

}
function getCopyType(type)
{
   $("#getCopyType").text(type); 
}
</script>
</body>

</html>