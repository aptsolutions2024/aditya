<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Part Supplier Schedule | Aditya</title>

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
                                    
                           
                             <br>
                             <?php $Supplier_Id = $_POST['Supplier_Id']; $schedule_date = date("M Y",strtotime($_POST['schedule_date']));
                             $suppDetails = $this->GetQueryModel->getSupplierById($Supplier_Id);
                             $subject = "Supplier Schedule for Month - $schedule_date ($suppDetails[name]) ";
                             ?>
                            <h3><?=$subject;?></h3>
                            
                            
                            
                                        
                                        
                                        <div class="col-md-4" >
                                            <label class="form-label">Branch Name<label class="mandatory">*</label></label>
                                            <select id="branch_id" name="branch_id" class="form-select" style="text-transform: uppercase">
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getuser[branch_id]==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                        </div>

                            <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th>Part ID</th>
                                        <th>Part No.</th>
                                        <th>Part Name</th>
                                        <th>Planning Qty</th>
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php 
                                        
                                        $count1=0;
                                        $i=0;
                                        foreach ($addSupplierSchedule as $key => $value) 
                                        { 
                                            
                                         

                                            $count1++;
                                            $partDetails=$this->GetQueryModel->getPartsById($value['part_id']); 
                       
                                     ?>
                                     
                                    <tr>
                                        <td align="center">
                                            <?= $count1; ?>
                                        </td>
                                        <td  align="center"> 
                                            <input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?=$value['req_id'];?>" >
                                            
                                        </td>

                                       <td> <?= $value['part_id']; ?>
                                       <input type="hidden" value="<?=$value['part_id'];?>" id="part_id<?=$value['req_id'];?>">
                                       <input type="hidden" id="prod_plan_id<?=$value['req_id'];?>" value="<?=$value['prod_plan_id'];?>">
                                        </td>
                                       <td> <?= $partDetails['partno']; ?> 
                                       <input type="hidden" value="<?=$partDetails['partno'];?>" id="part_no<?=$value['req_id'];?>">
                                      </td>
                                       <td> <?= $partDetails['name']; ?> 
                                       <input type="hidden" value="<?=$partDetails['name'];?>" id="part_name<?=$value['req_id'];?>">
                                        </td>
                                       <td> <?= $value['plan_req_qty']; ?> 
                                       <input type="hidden" value="<?=$value['plan_req_qty'];?>" id="part_qty<?=$value['req_id'];?>">
                                    </td>
                                        
                                        

                                     
                                    </tr>
                                    <?php 
                                    
                                } 
                                    ?>
                                </tbody>
                            </table>



                            <div class="col-12" align="center">
                            <button type="button" class="btn btn-primary add_btn" onclick="updateSupplierSchedule();">Submit</button>
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
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
    <!-- ~~~~~~~~~~~~~~~~~~~~~~Model start~~~~~~~~~~~~~~~~~~~~~~~~ -->


  <!-- Modal -->
<div class="modal fade" id="maildraftmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >

  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="width: 878px; margin-center: 30px; margin-left: -30%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Draft</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%; border: 1px;">
              
                 
                <tbody>
                    <tr>
                        <td>To: <br><br></td>
                        <td><p  id="emailid"></p> </td>

                    </tr>
                     <tr>
                        <td>Subject :</td>
                        <td><input type="text" name="subline" class="form-control"></td>
                    </tr>
                     <tr>
                        <td> <br><br> Body :</td>
                        <td> <br><br>
                            Dear sir,<br>
                            Please give us competitive rates.<br><br>

                            Raw material details are follows.
                            <br><br>
                            <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">Sr.</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Grade</th>
                                      <th scope="col">Length</th>
                                      <th scope="col">Width</th>
                                      <th scope="col">Thikness</th>
                                      <th scope="col">Qty</th>
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
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info">Send</button>
      </div>
    </div>
  </div>
</div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~model end~~~~~~~~~~~~~~~~~~~~~~~ -->
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
    

    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script> -->

<script>
$(document).ready(function() 
{
   
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
                                    

    $('#example').DataTable( {
        "paging": false
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
    } );

    $('#example1').DataTable( {
        "paging": false
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
    } );
} );
function updateSupplierSchedule()
{
    var checkboxes = document.getElementsByName('checkboxVal[]');
    var checkedvals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
    if (checkboxes[i].checked) 
    {
    //checkedvals += ","+checkboxes[i].value+"#"+$("#part_id"+checkboxes[i].value).val()+"#"+$("#part_no"+checkboxes[i].value).val()+"#"+$("#part_name"+checkboxes[i].value).val()+"#"+$("#part_qty"+checkboxes[i].value).val();
    checkedvals += ","+checkboxes[i].value+"#"+$("#part_id"+checkboxes[i].value).val()+"#"+$("#prod_plan_id"+checkboxes[i].value).val()+"#"+$("#part_qty"+checkboxes[i].value).val();
    }
    }
    if (checkedvals) checkedvals = checkedvals.substring(1);
    

    var branch_id   = $("#branch_id").val();
    var SupId       = "<?=$_POST['Supplier_Id'];?>";
    var SchDate     = "<?=$_POST['schedule_date'];?>";
    var subject     = "<?=$subject;?>";

    $("#branch_id").removeClass('bordererror');
    if(branch_id ==""){
    $("#branch_id").focus();
    error ="Please Select branch";
    $("#branch_id").val('');
    $("#branch_id").addClass('bordererror');
    $("#branch_id").attr("placeholder", error);
    return false;
    } 
    else if(checkedvals=='')
    {
        alert("Please select parts details.");
        return false;
    } else 
    {
        $.ajax({
         url:"<?php echo base_url(); ?>updateSupplierSchedule",
         method:"POST",
         data:{checkedvals:checkedvals,branch_id:branch_id,SupId:SupId,SchDate:SchDate,subject:subject},
         success:function(result)
         {
             alert(result);
          //alert("Record Updated!");
           location.reload();
         }
         }); 
    }
}

    function CloseCustomer(removeNum) 
    {
        location.href = 'supplierSchedule';

    } 


</script>
</body>

</html>