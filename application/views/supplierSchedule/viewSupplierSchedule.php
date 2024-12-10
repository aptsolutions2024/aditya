<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Parts Schedule | Aditya</title>

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
    <style type="text/css">
      .visible {
  height: 3em;
  width: 10em;
  background: yellow;
}
    
   #loader{ 
    position: fixed;
    top: 0;
    z-index: 9999;
    width: 100%;
    height: 100%;
    display: none;
    background: rgba(0,0,0,0.6);
  }
  #loader img{
          width: 100px;
    height: 100px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
  }
        
    </style>
</head>

<body class="jumping">
<div id='loader' style='display: none;'>
            <div class="loader-inner ball-spin-fade-loader"></div>
  <img src='<?=base_url();?>public/assets/resources/loader.gif'>
</div>
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('supplierSchedule');?>">Parts Supplier Schedule</a></li>
                            
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
                            <h2 style="width: 87%;">Parts Schedule</h2>
                            </div>
                            
                            <div class="row">
                            <?php echo form_open('/showSchBySupplierBranch', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch','style' => 'display: contents;')); ?>
                            
                            <input type="hidden" id="formSubmitFlag" value="<?=$formSubmitFlag;?>" >
                            
                            <div class="col-md-3">
                                            <label class="form-label">Supplier Name </label>
                                            <?php $cn= set_value('Supplier_Id'); ?>
                                            <select id="Supplier_Id" name="Supplier_Id" class="form-select alltxtUpperCase" onchange="showSupplierId(this.value);">
                                                <option value="">Choose...</option> 

                                                <?php foreach($getSupplier as $row){ ?>                                              
                                                <option value="<?=$row['id'];?>" <?php if($getOtherpo[supplier_id]==$row['id']){ echo "selected";} ?> <?php if($cn==$row['id']){echo "selected";} ?> ><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Supplier_Id');?>
                                        </div>

                                        <div class="col-md-2">
                                       <label class="form-label">Schedule Date<label class="mandatory">*</label></label>
                                       <input id="schedule_date" name="schedule_date" type="month" class="form-control" value="<?php echo set_value('schedule_date', $getparts[schedule_date]); ?>" onchange="showSchDate(this.value);" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('schedule_date');?>
                                    </div>


                                        <div class="col-md-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        
                                        </div>
                                        
                                        </form>
                                        
                                       
                                            <?php echo form_open('/addSupplierSchedule', array('autocomplete' => 'off','class' => 'row g-3','style' => 'display: contents;')); ?>
                            <!--<input type="hidden" id="SupId" name="SupId" value="">
                            <input type="hidden" id="SchDate" name="SchDate" value="">-->
                                 <div class="col-md-2" style="margin-top: auto;display: flex;">
                           <button type="submit" class="btn btn-secondary" style="float: right;height: 40px;">Add Schedule</button> &nbsp;
                            </div>
                              <div class="col-md-2" style="margin-top: auto;display: flex;">
                           <button type="button" class="btn btn-primary mail_draft" style="float: right;height: 40px;">Send Email</button>
                            </div>
                            </form>
                                   
                                        </div>
                                        
                                        

                                <br><br>
                                        
                  <div style="overflow : auto;">                               
    <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
            <thead>
                <tr>
                    <th  >Sr.No.</th>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Part Id</th>
                    <th>Part No.</th>
                    <th>Part Name</th>
                    <th>Schedule Qty</th>
                    <th>Received Qty</th>
                    <th>Mat. Rec. Branch </th>
                    
                   
                </tr>
            </thead>
           
            <tbody>
                <?php 
                    $count=0;
                    foreach ($getPartsSupplier as $key => $value) 
                    { 
                        $count++;
                       $partDetails = $this->GetQueryModel->getPartsById($value['part_id']); 
                       $bDetails    = $this->GetQueryModel->getBranchbyId($value['receiving_branch_id']); 
                       $supplierD   = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
                       $ReceivedQty    = $this->GetQueryModel->getPartsRCIRQty1($value['id']);
                       $partsrcirId = $value['tran_partsrcir_id'];
                 ?>
                <tr>
                    <td > <?=$count;?> </td>
                    <td > <?=$value['id'];?> </td>
                    <td class="alltxtUpperCase"> <?= $supplierD['name']; ?> </td>
                    <td > <?= $value['part_id']; ?> </td>
                    <td > <?= $partDetails['partno']; ?> </td>
                    <td > <?= $partDetails['name']; ?> </td>
                    <td > <?= $value['qty']; ?> </td>
                    <td > <?= $ReceivedQty['recqty']; ?> </td>
                    <td > <?= $bDetails['name']; ?> </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
      </div>
    </div>
</div>
</div>
            </div>
            
            
            
            
<div class="modal fade" id="maildraftmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >

  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="width: 878px; margin-center: 30px; margin-left: -30%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Draft</h5>
      <button type="button"  class="close modalclose" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%; border: 1px;">
                <tbody>
                    <tr>
                        <td>To: <br><br></td>
                        <td><p  id="emailid"></p> 
                            <input type="hidden" name="emails" id="emails">
                        </td>
                    </tr>
                     <tr>
                    <td>Subject :</td>
                    <td><input type="text" name="subline" class="form-control" id="subline" value=""></td>
                    </tr>         <tr>
                        <td> <br><br> Body :</td>
                        <td> <br><br>
                            Dear sir,<br>
                            Please see the below schedule <span id="Sdate"></span> 
                            <br><br>
                            <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                        <th  >Sr.No.</th>
                                        <th>Part No.</th>
                                        <th>Schedule Qty</th>
                                        <th>Mat. Rec. Branch </th>  
                                    </tr>
                                  </thead>
                                  <tbody class="tbody">
                                  </tbody>
                            </table>
                            <p>Regards,<br>
                                Aditya ERP
                                <!-- //Session company name -->
                            </p>
                        </td>
                    </tr>
                    <tr>
                    <td>Remarks :</td>
                    <td>
                            <textarea name="remarks" class="form-control" id="remarks" ></textarea>
                    </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <!--<a href="<?php echo base_url();?>supplierSchedule">-->
            <button type="button" class="btn btn-danger modalclose" >Close</button>
            <!--</a>-->
        <button type="button" class="btn btn-info sendbtn">Send</button>
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

$('.modalclose').on('click', function() 
{
        $('#maildraftmodel').modal('toggle');
});

} );

function showSch()
{
    var formSubmitFlag =$("#formSubmitFlag").val();
    if(formSubmitFlag==0 || formSubmitFlag=='')
    {
    var frm = document.getElementById("formSch");
    frm.submit();
    }
}
function showSupplierId(id)
{
    $.ajax({
        url:"<?php echo base_url(); ?>getSupplierDetails",
        method:"POST",
        data:{id:id},
        success:function(result)
        {
        var myArray = result.split("^");
        $("#emailid").text(myArray[0]);
        $("#emails").text(myArray[0]);
        
        var schedule_date =$("#schedule_date").val(); 
        var msg =  "Supplier Schedule for Month - "+schedule_date+" ("+myArray[1]+")";
        $("#subline").val(msg);
        }
    });
}
function showSchDate(id)
{
    $("#SchDate").val(id);
}



$('.mail_draft').on('click', function() 
    {
      var schedule_date =$("#schedule_date").val();  
      var Supplier_Id =$("#Supplier_Id").val();  
      
      $("#Supplier_Id").removeClass('bordererror');
        if(Supplier_Id ==""){
           $("#Supplier_Id").focus();
           error ="Please Select Supplier";
           $("#Supplier_Id").val('');
           $("#Supplier_Id").addClass('bordererror');
           $("#Supplier_Id").attr("placeholder", error);
           return false;
        }else{
             showSupplierId(Supplier_Id); 
          $.ajax({
                   url:"<?php echo base_url(); ?>getMailPartsSchedule",
                   method:"POST",
                   data:{
                       schedule_date:schedule_date,
                       Supplier_Id:Supplier_Id,
                   },
                   success:function(result)
                   {
                      
                       $("#Sdate").text(schedule_date);
                     //   $('#maildraftmodel').modal('show');
                       $('#maildraftmodel').modal('toggle');
                        $(".tbody").html(result);
                        
                        
                   }
                });

            /*$("#emailid").text('sagarchavan219@gmil.com'); // show lable
            $("#emails").val($("#suppliermail").val()); // text bx*/
        }

      
    });
    
 $('.sendbtn').on('click', function() 
    {
        var subline = $("#subline").val();
        var schedule_date =$("#schedule_date").val();  
        var remarks =$("#remarks").val();  
         var emails = $("#emailid").text();
           var Supplier_Id =$("#Supplier_Id").val();  
         //alert("Emailid-"+emails);
           if(emails){    
               var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
               if(!emailReg.test(emails)) {  
                    alert("Please enter valid email id");
               }  
           }else{
                  alert("Please set supplier email id");
                  return false;
           }

        if(subline != "")
        {
          //  var emails = $("#emails").val();
           /* var alldata = $("#alldata").val();
            */
                $('#loader').show();
            $.ajax({
                   url:"<?php echo base_url(); ?>PartsSendmail",
                   method:"POST",
                   //data:{subline:subline,emails:emails,alldata:alldata},
                   data:{subline:subline,emails:emails,schedule_date:schedule_date,remarks:remarks,Supplier_Id:Supplier_Id},
                   success:function(result)
                   {
                       alert(result);
                      console.log(result);
                         $('#maildraftmodel').modal('toggle');
                      //  location.reload();
 
                   },
                    complete: function(){
                        $('#loader').hide();
                  }
                });

           
        }else{

            alert("Please provide Subject Line.");
        }
        
    });   
</script>
</body>

</html>