<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Delivery Challan Print | Aditya</title>

    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url();?>viewDeliveryC">View Delivery Challan</a> </li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3 btnprnt">Delivery Challan Print
                    </h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                      
                                      <div class="col-md-4 btnprnt">
                                            <label class="form-label">Choose Copy Type <label class="mandatory">*</label></label>
                                            <?php $cn= set_value('Copy'); ?>
                                            <select id="Copy" class="form-select" onchange="getCopyType(this.value);" >
                                                <option value="ORIGINAL Copy">ORIGINAL Copy</option> 
                                                <option value="DUPLICATE Copy">DUPLICATE Copy</option> 
                                                <option value="TRIPLICATE Copy">TRIPLICATE Copy</option> 
                                                  <option value="ALL Copy">ALL Copy</option> 

                                            </select>
                                            <br>
                                        <br>
                                        </div>
                                        
                                        <?php
                                        /* print_r($getDCMastById);
                                        echo "<pre>";
                                        print_r($getDCDetails); echo "</pre>"; */
                                        ?>
                                            <div class="pagebreak">
                                      <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                          <tr>
                                              <td style="text-align:right;" colspan="8"><span class="getCopyType">ORIGINAL Copy</span></td>
                                         </tr>
                                         <tr>
                                            <td style="text-align: center;" colspan="8">
                                                  <span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                                                  <span ><?php echo $companyDetails['address'];?></span><br>
                                                  <span style=""><span style="">EMAIL ID : </span><?php echo $companyDetails['email_id'];?></span>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td style="text-align: center;" colspan="2">
                                              <b>GST NUMBER </b>: <?php echo $companyDetails['gst_no'];?>
                                            </td>
                                            <td style="text-align: center;" colspan="6">
                                             <b> STATE CODE</b> : <?php echo $companyDetails['state_code'];?>
                                            </td>
                                        </tr>
                                              
                                        <tr>
                                            <td style="text-align: center;font-size: 20px;font-weight: 600;" colspan="8">
                                                DELIVERY CHALLAN
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;" colspan="2">
                                               <b> CHALLAN NUMBER</b> : <?php echo $getDCMastById['id'];
                                            echo   (is_numeric($getDCMastById['dc_no']))?" ":" - ".$getDCMastById['dc_no'];?>
                                            </td>
                                            <td style="text-align: center;" colspan="6">
                                                <b>CHALLAN DATE </b>: <?php echo date("d-m-Y",strtotime($getDCMastById['date']));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php  $supplierD=  $this->getQueryModel->getSupplierById($getDCMastById['supplier_id']); ?>
                                            <td  colspan="1" style="text-transform:uppercase;">
                                                <b>TO </b> :
                                            </td>
                                            <td  colspan="7" style="text-transform:uppercase;">
                                                            <?=$supplierD['name'];?><br>
                                                            <?=$supplierD['address'];?><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="1" style="text-transform:uppercase;">
                                                      <b>GST No  </b> :
                                            </td>
                                            <td  colspan="7" style="text-transform:uppercase;">
                                                         <?=$supplierD['gst_no'];?><br>
                                            </td> 
                                        </tr>
                                            <tr>
                                                <th> SR.NO. </th>
                                                <th width='30%'> MATERIAL SPECIFICATION </th>
                                                <th> HSN CODE </th>
                                                <th> QTY IN NOS</th>
                                                <th> QTY IN KGS</th>
                                                <th> RATE </th>
                                                <th> UOM </th>
                                                <th> TOTAL AMOUNT </th>
                                            </tr>
                                              <?php 
                                              $sr=1;
                                              $grand_total=0;
                                             // echo "<pre>";print_r($getDCDetails);echo "</pre>";
                                              foreach($getDCDetails as $dcdetails){    
                                              $totamt=0;
                                              $op=$dcdetails['op_id'];
                                              $op_name=$this->getQueryModel->getOperationsById($op);
                                              $partD =  $this->getQueryModel->getPartsById($dcdetails['part_id']);
                                              ?>
                                            <tr>
                                                <td width="5%"> <?=$sr;?></td>
                                                <td> <?php echo $partD['partno']."-".$partD['name']."<br>Operation : ".$op_name['Name']."<br>".$getDCMastById['remarks']."<br>".$dcdetails['partpo_remark'];  ?></td>
                                                <td> <?php echo $partD['hsncode'];?></td>
                                                <td> <?php echo $dcdetails['qty'];?></td>
                                                 <td> <?php echo $dcdetails['qty_in_kgs'];?></td>
                                                <td> <?php echo $dcdetails['part_rate'];?></td>
                                                <td> <?php echo $partD['uom'];?></td>
                                                <td> <?php 
                                                
                                                if($dcdetails['uom']=='PKG' || $dcdetails['uom']=='KGS'){
                                                    
                                                     echo ($dcdetails['qty_in_kgs']*$dcdetails['part_rate']);
                                                       $grand_total=($grand_total)+($dcdetails['qty_in_kgs']*$dcdetails['part_rate']);
                                                }else{
                                                     echo ($dcdetails['qty']*$dcdetails['part_rate']); 
                                                       $grand_total=($grand_total)+($dcdetails['qty']*$dcdetails['part_rate']);
                                                }
                                              
                                                //echo $dcdetails['total_amount'];
                                                ?>
                                                </td>
                                                
                                            </tr>
                                            
                                            
                                            <!--<tr>-->
                                            <!--    <td><b>Remarks </b>:</td>-->
                                            <!--    <td colspan="7"><?php echo $dcdetails['partpo_remark'];?></td>-->
                                            <!--</tr>-->
                                               <?php 
                                             
                                               $sr++; } ?>
                                              
                                              
                                            <tr>
                                                <td colspan="3"> <b>VEHICLE NUMBER</b> : <?php echo $getDCMastById['vehicle_no'];?> <br>
                                                <b>TRANSPORTER NAME </b>: <?php echo $getDCMastById['transporter_name'];?> 
                                                </td>
                                                <td colspan="4" align="right"> <b>GRAND TOTAL</b> </td>
                                                <td colspan="1"> <b><?php echo $grand_total;?></b> </td>
                                                
                                            </tr>
                                              
                                            <tr>
                                                <td align="right" colspan="8">
                                                For,<?php echo $companyDetails['name'];?><br><br><br>
                                                Authorised Signatory
                                                </td>
                                            </tr>
                                              
                                            <tr>
                                                <td align="center" colspan="8">
                                                To be completed by processor/job worker at the time of dispatches, back to the manufacturer, original copy to be retained by job worker. Duplicate copy to be dispatched alongwith goods.
                                                </td>
                                            </tr>
                                              
                                            <tr>
                                                <td align="center" colspan="2" rowspan=2>
                                                Date & Time of dispatch of finished goods to parent factory/another manufacturer and entry no. and date of reciept in the account in the processing factry.
                                                </td>
                                                <td>Challan Number</td>
                                                <td colspan=2>Date</td>
                                                <td >Quantity</td>
                                                <td colspan=2>Nature of processing done</td>
                                            </tr>
                                            <tr>
                                               <td><br><br></td>
                                                <td colspan=2><br><br></td>
                                                <td><br><br></td>
                                                <td colspan=2><br><br></td>
                                         
                                            </tr>
                                            <tr>
                                                <td align="center" colspan="2">
                                                Quantity of waste returned to the parent factory
                                                </td>
                                                <td colspan=6></td>
                                               
                                            </tr>
                                              
                                            <tr>
                                                <td colspan="8">
                                                    Place:
                                                    <br>
                                                    Date :
                                                    <br>
                                                    Name & Address Of the factory :
                                                    <br>
                                                    <span style="float: right;">Signature of the Processor</span>
                                                </td>
                                            </tr>
                                      </table>
                                      </div>
                                      <br>
                                      <div class="cloneTable1 pagebreak">
                                          
                                      </div>
                                      <br>
                                       <div class="cloneTable2">
                                          
                                      </div>
                                    <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
                                    
                                    <a href="/viewDeliveryC"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
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
   table, th, td {
  
  font-size: 10px;
} 
.tableprint{
    width:100%;
   
}
.btnprnt{display:none}
.pagebreak { page-break-after: always; } /* page-break-after works, as well */
 @page  
    { 
        /*margin: 20 20 22px;  */
    	margin: 30mm 8mm 8mm 10mm;
    	
    } 
}

</style>    
<script>
function myFunction() {

window.print();

}

function getCopyType(type)
{
  if($("#Copy").val()=="ALL Copy"){
        $(".getCopyType").text("ORIGINAL Copy"); 
            
            let $el = $('#originalCopy').clone();
            $('.cloneTable1').append($el);
            $(".getCopyType").eq(1).text("DUPLICATE Copy");
              let $el1 = $('#originalCopy').clone();
             $('.cloneTable2').append($el1);
            $(".getCopyType").eq(2).text("TRIPLICATE Copy");
   }else{
        $(".getCopyType").text(type); 
   }
}
</script>
</body>

</html>