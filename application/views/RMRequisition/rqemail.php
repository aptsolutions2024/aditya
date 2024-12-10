<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Mail | Aditya</title>

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

    <style>
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>rm-equisition-email">Requisition Email</a></li>
                            
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
                            <!-- <h2 style="width: 87%;">RM-Requisition Email</h2> -->

                              <div class="col-sm-4"><h2 style="width: 87%;">RM-Requisition Email</h2></div>
                                <div class="col-sm-4">

                                        <!-- <select id="example-getting-started" multiple> -->
                                        <select id="suppliermail" multiple class="form-control">
                                            <option>Select Supplier</option>
                                            <?php 
                                            if(!empty($Supplier))
                                            {
                                                foreach ($Supplier as $key => $value) 
                                                {
                                                   
                                            ?>
                                                <option value="<?= $value['email_id']; ?>"><?= $value['name']; ?></option>
                                              
                                            <?php } } ?>
                                        </select>
                                </div>
                                <div class="col-sm-4" align="right">
                                     <button class="btn btn-primary mail_draft">Mail Draft</button>
                                </div>
                            </div>
                            <br>
                        <?php echo form_open('/updateEquisition', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                            <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th>RM ID</th>
                                        <th>Row Matterial Name</th>
                                        <th>Reorder Qty</th>
                                        <th>Current Stock</th>
                                        <th>Planing Requirment Qty</th>
                                        <th>Qty</th>
                                       <!-- <th>Total</th>-->
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php 
                                        $count=0;
                                        //echo "<pre>";print_r($getRawMaterial);echo "</pre>";
                                        foreach ($getRawMaterial as $key => $value) 
                                        { 

                                            //SrNo
                                            $count++;
                                            $rm_id = $value['rm_id'];
                                            // $year = $_SESSION['current_year'];

                                            //Row Matterial Name
                                                $RowMatterialName =  $value['name'];

                                            //Reorder Qty
                                                $reorderQty =  ($value['reorderQty'] != 0) ? $value['reorderQty'] : "-";

                                            //Current Stock

                                                  $data = $this->GetQueryModel->getRmStockbyid($rm_id,$_SESSION['current_year']);
                                                 // echo "<pre> RM STOCK: ";print_r($data);echo "</pre>";
                                                if(!empty($data))
                                                {
                                                    $ob         = $data['ob'];   
                                                    $receipt    = $data['receipt'];   
                                                    $issue      = $data['issue'];  
                                                    $CurrentStk = ($ob + $receipt - $issue);
                                                }
                                                $CurrentStkval = ($CurrentStk != "") ? round($CurrentStk,3) : "-";  

                                            //Planing Requirment Qty

                                                 $res = $this->GetQueryModel->getrmPlanManuQtybyid($rm_id,$_SESSION['current_year']);
                                                
                                                $result = "-";
                                                if(!empty($res))
                                                {
                                                    $result = $res['plan_req_qty'];
                                                    
                                                }
                                                $PlaningReqQty =  ($result != "") ? $result : "-";
                                                
                                            //Qty
                                                $manual_qty = ($res['manual_qty'] == "") ? "0" : $res['manual_qty'];

                                            //Total
                                                $total =  ($result != "") ? $result + $manual_qty : "-";

                                                $checkboxVal = $value['rm_id']."@".$RowMatterialName."@".$manual_qty;
                                                if($total > 0 )
                                                {
                                     ?>
                                    <tr>
                                        <td align="center">
                                            <?= $count; ?>
                                        </td>
                                        <td  align="center"> 
                                            <input type="checkbox" name="checkboxVal" value="<?= $checkboxVal; ?>" >
                                            <input type="hidden" name="rm_id[]" value="<?= $value['rm_id']; ?>">
                                        </td>

                                       <td> <?= $value['rm_id']; ?> </td>
                                       <td> 
                                            <?= $RowMatterialName; ?>
                                        </td> 
                                        <td> 
                                            <?= $reorderQty; ?>
                                        </td>
                                        <td>
                                            <?= $CurrentStkval ?>
                                        </td>
                                        <td class="plan_req_qty">
                                            <?= $PlaningReqQty; ?>
                                        </td>
                                        <td class="manual_qtytd">
                                            
                                            <?= $manual_qty; ?>
                                        </td>
                                        <!--<td>
                                            <?= $total; ?>
                                        </td>-->
                                     
                                    </tr>
                                    <?php  } } ?>
                                </tbody>
                          
                            </table>
                            <!-- <div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div> -->
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseRmreq();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="example" class="display dt-responsive overflow-auto" style="width:100%; border: 1px;">
              
                 
                <tbody>
                    <tr>
                        <td>To: <br><br></td>
                        <td><p  id="emailid"></p> 
                            <input type="hidden" name="emails" id="emails" value="">
                            <input type="hidden" name="alldata" id="alldata" value="">
                        </td>

                    </tr>
                     <tr>
                        <td>Subject :</td>
                        <td><input type="text" name="subline" class="form-control" id="subline"></td>
                    </tr>
                     <tr>
                        <td> <br><br> Body :</td>
                        <td> <br><br>
                            Dear sir,<br>
                            Please give us competitive rates.<br><br>

                            Raw material details are follows.
                            <br><br>
                            <table class="table table-bordered emailbody">
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
        <button type="button" class="btn btn-danger" onclick="CloseRmreq();"  data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info sendbtn">Send</button>
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
    // $(document).ready(function() {
    //     $('#example-getting-started').multiselect();
    // });
                                    

    $('#example').DataTable( {
        "paging": false
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'excel', 'pdf', 'print'
        // ]
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




  function CloseRmreq(removeNum) 
    {
       // location.href = 'rm-equisition-email';
        $("#maildraftmodel").modal('hide'); 

    }
  



    $('.sendbtn').on('click', function() 
    {
        var subline = $("#subline").val();

        if(subline != "")
        {
            var emails = $("#emails").val();
            var alldata = $("#alldata").val();
             $('#loader').show();
        
            $.ajax({
                   url:"<?php echo base_url(); ?>Sendmail",
                   method:"POST",
                   data:{subline:subline,emails:emails,alldata:alldata},
                   success:function(result)
                   {
                      alert(result);
                        location.reload();
 
                   },
                    complete: function(){
                        $('#loader').hide();
                  }
                });

           
        }else{

            alert("Please provide Subject Line.");
        }
        
    });

    //var mail_draft = new Array(); 

    $('.mail_draft').on('click', function() 
    {
        
     var mail_draft = new Array(); 
       $('input[name="checkboxVal"]:checked').each(function() 
       {
            mail_draft.push($(this).val());
        });

       var supval = $("#suppliermail").val();

       if(mail_draft.length > 0 && supval != "")
       {
          $.ajax({
                   url:"<?php echo base_url(); ?>mailformat",
                   method:"POST",
                   data:{mail_draft:mail_draft},
                   success:function(result)
                   {
                        $('#maildraftmodel').modal('show');

                      //  $(".tbody").append(result);
                         $("table.emailbody .tbody").html(result);
                        
                   }
                });

            $("#emailid").text($("#suppliermail").val()); // show lable
            $("#emails").val($("#suppliermail").val()); // text bx
            $("#alldata").val(mail_draft); // text bx



       }else if(supval == "")
       {
        alert("Please select Supplier")

       }else
       {
         alert("Please Select RM")
       }
      
    

        // alert(mail_draft);

    });


// manual_qty
$('.manual_qty').on('keyup', function() 
{

        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();

        var mqty = (manualval1 == "-") ? 0 : manualval1;
       
        var totl = (parseInt(mqty) + parseInt(qty) );
        $(this).closest('td').next('td').html(totl);
        

});


    function CloseCustomer(removeNum) 
    {
        location.href = 'rm-equisition';

    } 
</script>
</body>

</html>