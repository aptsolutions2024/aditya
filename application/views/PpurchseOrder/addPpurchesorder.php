<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Part Purchase Order | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>" >Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('OtherPo');?>">Part Purchase Order</a></li>
                            
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

                              <div class="col-sm-5">
                                <?php
                                if(empty($_GET['ID']))
                                {
                                ?>
                                <h2 style="width: 87%;">Add Part Purchase Order</h2><br>
                            <?php }else{?>
                                    <h2 style="width: 87%;">Update Part Purchase Order</h2><br>
                            <?php } ?>
                            </div>
                                <div class="col-sm-4">
 
                                </div>
                               
                            </div>

                              <?php echo form_open('/showSupplierSch', array('autocomplete' => 'off')); ?>

                            <div class="row">
                                 <div class="col-sm-4">
                                    <label class="form-label">PO ID <label class="mandatory">*</label></label>
                                         <input type="text" readonly name="po_id" value="<?= $getTranPoMast['id']; ?>" class="form-control" placeholder="PO ID">
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Supplier <label class="mandatory">*</label></label>
                                      <select id="supplierId"  class="form-control" name="supplierId" onchange="GetTranScheduleParts(this.value);">
                                       
                                            <option value="">Select Supplier</option>
                                            <?php 
                                            if(!empty($getSupplier))
                                            {
                                                foreach ($getSupplier as $key => $value) 
                                                {
                                                   $selected = in_array($value['id'],$getTranPoMast) ? 'selected' : "";
                                            ?>
                                                <option <?= $selected; ?> value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                                              
                                            <?php } } ?> 
                                        </select>
                                        <?php echo form_error('supplierId');?>
                                    
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Select Date <label class="mandatory">*</label></label>
                                    <?php $dates = (!empty($getTranPoMast['date'])) ? $getTranPoMast['date'] :  date("Y-m-d"); ?>
                                     <input type="date" name="date"  class="form-control" value="<?php echo $dates; ?>">
                                 </div>
                                 
                            </div>
                            <br>
                             <div class="row">
                                 <div class="col-sm-4">
                                     <label class="form-label">Is Open PO<label class="mandatory">*</label></label>
                                         <select id="is_assembly"  name="is_openpo" class="form-select">
                                          <option selected value="N" <?= ($getTranPoMast['is_open_po'] == 'N') ? "selected": "" ; ?> >No</option>
                                          <option value="Y" <?= ($getTranPoMast['is_open_po'] == 'Y') ? "selected": "" ; ?> >YES</option>
                                          
                                       </select>
                                    
                                         <!-- <input type="text" name="date" class="form-control" placeholder="PO ID"> -->
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Payment Terms <label class="mandatory"></label></label>
                                     <textarea cols="2" class="form-control" name="payment_term" ><?= $getTranPoMast['payment_terms']; ?></textarea>
                                    
                                 </div>
                                 <div class="col-sm-4">
                                    <label class="form-label">Remarks<label class="mandatory"></label></label>
                                   <textarea cols="2" name="remark" class="form-control" ><?= $getTranPoMast['Remarks']; ?></textarea>
                                 </div>
                                 
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Show</button>

                            </div>
                            
                            
                            
                            <br>
                             <?php if(!empty($getRawMaterialbyid)) { ?>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Part Purchase Order Details Update</h3>(For existing order items)
                       
                            <table id="example1" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th>Part Id</th>
                                        <th>Part No</th>
                                        <th>Quantity</th>
                                        <th>Operation</th>
                                        <th>Rate</th>
                                        <th>IGST % </th>
                                        <th>CGST %</th>
                                        <th>SGST %</th>
                                        <th>Total</th>
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php 

                                        $count1=0;
                                        $i=0;
                                        foreach ($getRawMaterialbyid as $key => $values) 
                                        {   
                                            
                                            


                                            //SrNo
                                           
                                            $rm_id = $values['rm_id'];
                                            // $year = $_SESSION['current_year'];

                                            //Row Matterial Name
                                                $RowMatterialName =  $values['name'];

                                            //Reorder Qty
                                                $reorderQty =  ($values['reorderQty'] != 0) ? $values['reorderQty'] : "-";

                                            //Current Stock

                                                  $data = $this->GetQueryModel->getRmStockbyid($rm_id,'2022 - 23');
                                                
                                                if(!empty($data))
                                                {

                                                    $ob         = $data['ob'];   
                                                    $receipt    = $data['receipt'];   
                                                    $issue      = $data['issue'];  
                                                    $CurrentStk = ($ob + $receipt - $issue);
                                                }
                                                $CurrentStkval = ($CurrentStk != "") ? round($CurrentStk,3) : "-";  

                                            //Planing Requirment Qty

                                                 $res = $this->GetQueryModel->getrmPlanManuQtybyid($rm_id,'2022 - 23');
                                                
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

                                                $checkboxVal = $values['rm_id']."@".$RowMatterialName."@".$total;

                                               
                                                     $count1++;
                                     ?>
                                    <tr>
                                        <td align="center">
                                            <?= $count1; ?>
                                        </td>
                                        <td  align="center"> 
                                            <a class="btn btn-icon btn-sm btn-danger btn-hover" 
                                        onclick="deleteRecord('<?=$values['id'];?>');"><i class="demo-pli-trash fs-5"></i></a>

                                            <input type="checkbox" disabled checked class="form-check-input" name="checkboxValupdate[]" values="<?= $checkboxVal; ?>" style="display: none;">
                                            <input type="hidden" name="rm_idupdate[]" value="<?= $values['rm_id']; ?>">
                                            <input type="hidden" name="podetail_id[]" value="<?= $values['id']; ?>">
                                        </td>

                                       <td> <?= $values['rm_id']; ?> </td>
                                       <td> 
                                            <?= $RowMatterialName; ?>
                                            <input type="hidden" name="RowMatterialNameupdate[]" value="<?= $RowMatterialName; ?>">
                                        </td> 
                                        <td> 
                                            <?= $values['ordered_qty']; ?>
                                            <input type="hidden" name="totalqtyupdate[]" value="<?= $values['ordered_qty']; ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="rateupdate[]" value="<?= $values['rate']; ?>" placeholder="Rate">
                                        </td>
                                        <td class="plan_req_qty">
                                           <input type="text" class="form-control" value="<?= $values['igst']; ?>" name="igstupdate[]" placeholder="IGST % ">
                                        </td>
                                        <td class="manual_qtytd">
                                            <input type="text" class="form-control" value="<?= $values['cgst']; ?>" name="cgstupdate[]" placeholder="CGST % ">
                                        </td>
                                        <td class="manual_qtytd">
                                            <input type="text" class="form-control" value="<?= $values['sgst']; ?>" name="sgstupdate[]" placeholder="SGST % ">
                                        </td>
                                        <td>
                                         
                                        </td>

                                     
                                    </tr>
                                    <?php 
                                   
                                } 
                                    ?>
                                </tbody>
                            </table>


                             <div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="partsPurchseOrder"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                            </div>
 <?php } ?>
                            <br>
                            <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                            <br>
                            <h3>Part Purchase Order Details Add</h3> (Add New Items)

                            <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th></th>
                                        <th>Part ID</th>
                                        <th>Part No</th>
                                        <th>Quantity</th>
                                        <th>Operation</th>
                                        <th>Rate</th>
                                        <th>IGST % </th>
                                        <th>CGST %</th>
                                        <th>SGST %</th>
                                        <th>Total</th>
                                       
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php
                                    print_r($getPartsPO);
                                    
                                    ?>
                                </tbody>
                            </table>



                            <div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <a href="partsPurchseOrder"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
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
function deleteRecord(editId)
{

if (confirm("Are you sure - Delete This Purchase Order?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>deleteRmOrder",
   method:"POST",
   data:{id:editId},
   success:function(result)
   {
    location.reload();
   }
   });
}
}

    var mail_draft = new Array(); 
    $('.mail_draft').on('click', function() 
    {
        

       $('input[name="checkboxVal"]:checked').each(function() 
       {
            mail_draft.push($(this).val());
        });

        $.ajax({
               url:"<?php echo base_url(); ?>mailformat",
               method:"POST",
               data:{mail_draft:mail_draft},
               success:function(result)
               {
                    $('#maildraftmodel').modal('show');

                    $(".tbody").append(result);
                    
               }
   });

       $("#emailid").text($("#suppliermail").val()); // 

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

    function GetTranScheduleParts(supplierId) 
    {
        $.ajax({
            url:"<?php echo base_url(); ?>GetTranScheduleParts",
            method:"POST",
            data:{supplierId:supplierId},
            success:function(result)
            {
            $(".tbody").append(result);
            
            }
        });

    } 
</script>
</body>

</html>