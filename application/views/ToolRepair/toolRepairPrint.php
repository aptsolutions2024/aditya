<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>TRepair Print | Aditya</title>

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url();?>viewToolRepair">Tool Repair</a> </li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3 btnprnt">Tool Repair Details Print
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
                                        //  print_r($getoolRepairDetailsById);
                                        // echo "<pre>";
                                        // print_r($getDRDetails); echo "</pre>"; 
                                        ?>
                                            <div class="pagebreak">
                                      <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                          <tr>
                                              <td style="text-align:right;" colspan="12"><span class="getCopyType">ORIGINAL Copy</span></td>
                                         </tr>
                                         <tr>
                                            <td style="text-align: center;" colspan="12">
                                                  <span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                                                  <span ><?php echo $companyDetails['address'];?></span><br>
                                                  <span style=""><span style="">EMAIL ID : </span><?php echo $companyDetails['email_id'];?></span>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td style="text-align: center;" colspan="6">
                                              <b>GST NUMBER </b>: <?php echo $companyDetails['gst_no'];?>
                                            </td>
                                            <td style="text-align: center;" colspan="6">
                                             <b> STATE CODE</b> : <?php echo $companyDetails['state_code'];?>
                                            </td>
                                        </tr>
                                              
                                        <tr>
                                            <td style="text-align: center;font-size: 20px;font-weight: 600;" colspan="12">
                                                TOOL REPAIR DETAILS
                                            </td>
                                        </tr>
                                         <tr>
                                            <td  colspan="2" style="text-transform:uppercase;">
                                                <b>TOOL NAME </b> :
                                            </td>
                                            <td  colspan="10" style="text-transform:uppercase;">
                                            <?php
                                            echo $getoolRepairDetailsById['tool_name'];  ?>                                              
                                            <br>
                                            </td>
                                        </tr>
                                            <tr>
                                            <td  colspan="2" style="text-transform:uppercase;">
                                                <b>TOOL MAKER </b> :
                                            </td>
                                            <td  colspan="10" style="text-transform:uppercase;">
                                            <?php
                                            echo $getoolRepairDetailsById['tool_maker'];  ?>                                              
                                            <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="4">
                                               <b> IDENTIFIED DATE</b> : <?=($getoolRepairDetailsById['identified_on'] && $getoolRepairDetailsById['identified_on']!='0000-00-00')?date('d-m-Y',strtotime($getoolRepairDetailsById['identified_on'])):"";?>
                                            </td>
                                            <td  colspan="4">
                                                <b> ISSUE DATE</b> :<?=($getoolRepairDetailsById['issue_date'] && $getoolRepairDetailsById['issue_date']!='0000-00-00')?date('d-m-Y',strtotime($getoolRepairDetailsById['issue_date'])):"";?>
                                            </td>
                                            <td  colspan="4">
                                                <b>RECEIVED DATE </b>:<?=($getoolRepairDetailsById['received_date'] && $getoolRepairDetailsById['received_date']!='0000-00-00')?date('d-m-Y',strtotime($getoolRepairDetailsById['received_date'])):"";?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="4" style="text-transform:uppercase;">
                                                <b>Estimated Amount (Rs.) </b> :   <?=number_format($getoolRepairDetailsById['estimated_amt'],2);?><br>
                                            </td>
                                            <td  colspan="4" style="text-transform:uppercase;">
                                                <b>Advance Amount (Rs.)</b> :  <?=number_format($getoolRepairDetailsById['advance_amt'],2);?><br>
                                            </td>
                                             <td  colspan="4" style="text-transform:uppercase;">
                                                <b>Bal. Amount Paid (Rs.)</b> :  <?=number_format($getoolRepairDetailsById['tot_amt_paid'],2);?><br>
                                            </td>
                                        </tr>
                                           <tr>
                                            <td  colspan="10" style="text-transform:uppercase;text-align:right;">
                                                <b>TOTAL (Rs.)</b> 
                                            </td>
                                            <td  colspan="2" style="text-transform:uppercase;">
                                                <?=number_format(($getoolRepairDetailsById['advance_amt']+$getoolRepairDetailsById['tot_amt_paid']),2);?>
                                            </td>
                                        </tr>
                                            <tr>
                                            <td  colspan="12" style="text-transform:uppercase;">
                                                <b>REMARKS </b> :  <?=$getoolRepairDetailsById['remarks'];?>
                                            </td>
                                            <!--<td  colspan="10" style="text-transform:uppercase;">-->
                                            <!--    <?=$getoolRepairDetailsById['remarks'];?>-->
                                            <!--</td>-->
                                        </tr>
                                     
                                            
                                             <tr>
                                                <td align="right" colspan="12">
                                                  <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="12">
                                                For,<?php echo $companyDetails['name'];?><br><br><br>
                                                Authorised Signatory
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="12">
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
                                    
                                    <a href="/viewDefectRegiModule"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
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
  
  font-size: 12px;
} 
.tableprint{
    width:100%;
   
}
.btnprnt{display:none}
.pagebreak { page-break-after: always; } /* page-break-after works, as well */
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