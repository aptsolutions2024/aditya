<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Raw Material PO Print | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('rm-Purchase-order-data');?>">RM-Purchase-order</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3 btnprnt">Raw Material PO Print   </h2>
                    

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

                                            </select>
                                            <br>
                                        <br>
                                        </div>
                                      <table style="width: 100%;">
                                             <tr>
                                              <td style="text-align: right;" colspan="6"><span id="getCopyType">ORIGINAL Copy</span></td>
                                              </tr>
                                          
                                              <tr>
                                                  <td style="text-align: center;" colspan="4">
                                              <span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                                                  <span ><?php echo $companyDetails['address'];?></span><br>
                                                
                                              
                                                <span style="float: left;"><span style="font-weight: 600;">EMAIL ID :- </span><?php echo $companyDetails['email_id'];?></span>
                                                <span style="float: right;">
                                                    <span style="font-weight: 600;text-transform: uppercase;">
                                                     GST NUMBER :- <?php echo $companyDetails['gst_no'];?>
                                                </span>
                                                </span>
                                              
                                              </td>
                                          </tr>
                                           
                                              
                                            <tr>
                                                <td style="text-align: center;font-size: 20px;font-weight: 600;" colspan="4">
                                                PURCHASE ORDER
                                                </td>
                                            </tr>
                                            
                                            
                                        <tr>
                                            <td style="" colspan="3">
                                                <div style="display: flex;">
                                                 <?php 
                                                 
                                                    //echo "<pre>";print_r($getOtherpo);echo "</pre>";
                                                 $supplierD=  $this->GetQueryModel->getSupplierById($getOtherpo['supplier_id']); ?>
                                                    <div style="width: 20%;"> <b> Name of Supplier </b> :- </div>
                                                    <div >
                                                               <span style="font-weight: 600;text-transform: uppercase;">
                                                        <?=$supplierD['name'];?>
                                                        <br>
                                                         <?=$supplierD['address'];?>
                                                </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td  colspan="3">
                                                P.O. No. :- FEL/R/<?php echo $getOtherpo['id'];?>
                                                <br>
                                                Date  :- <?php echo date("d.m.Y", strtotime($getOtherpo['date'])) ;?>
                                            </td>
                                        </tr>
                                              
                                           <tr>
                                                <td  colspan="3"><span style="font-weight: 600;"> GST NUMBER:-</span>
                                                 <span style="text-transform: uppercase;">  <?php echo $supplierD['gst_no'];?></span>
                                               
                                                </td>
                                                <td  colspan="3">
                                               
                                                </td>
                                            </tr>     
                                              
                                              
                                            <tr>
                                                <td  colspan="3"><span style="font-weight: 600;">Contact Person.:-</span>
                                                    <?php
                                                    //echo $supplierD['contact_person_details'];
                                                    $contact_persons=explode('-', $supplierD['contact_person_details']);
                                                    $telephone;
                                                    for($i=0;$i<1;$i++){
                                                     $personval=explode(',',$contact_persons[$i]);
                                                     if($personval[0]){
                                                       echo $personval[0];
                                                     }
                                                     if($personval[1]){
                                                       $telephone = $personval[1];
                                                     }
                                                    }
                                                    ?>
                                               
                                                </td>
                                                <td  colspan="3">
                                               <!--W.E.F.  <?php if(!empty($getOtherpo['date'])){echo date("d.m.Y", strtotime($getOtherpo['date'])) ;}?>-->
                                                </td>
                                            </tr>
                                              
                                            <tr>
                                                <td  colspan="3">
                                               <span style="font-weight: 600;">Tele. No.:- </span><?php if($telephone){ echo $telephone; }?>
                                                </td>
                                                <td  colspan="3">
                                               
                                                </td>
                                            </tr>
                                              
                                            <tr style="text-align: center;">
                                                <th width="10%"> Sr.<br> No. </th>
                                                <th width="60%"> Description of Material </th>
                                                <th width="15%"> Qty.(Kgs) </th>
                                                <th width="15%"> Rate<br> Per Kg. </th>
                                            </tr>                                             
                                           
                                              <?php 
                                              $sr=1;
                                              
                                   //     echo "<pre>";print_r($getOtherpoDetails);echo "</pre>";
                                              foreach($getOtherpoDetails as $podetails){ 
                                              $getRMName = $this->GetQueryModel->getrmById($podetails['rm_id']);
                                                ?>
                                                <tr style="text-align: center;">
                                                <td> <?=$sr;?> </td>
                                                <td style="text-align: left;"><?php echo $getRMName['name'];?></td>
                                                <td> <?php echo $podetails['ordered_qty'];?></td>
                                                <td> <?php echo $podetails['rate'];?></td>
                                                </tr>
                                                <?php $sr++; } ?>
                                           
                                            
                                            <tr>
                                                <td  colspan="4">
                                                <b>Terms and Conditions :-</b>
                                              <?php echo "<pre>"; echo $getOtherpo['payment_terms']; echo "</pre>";?>
                                                </td>
                                            </tr>        
                                            <tr>
                                                <td align="right" colspan="4">
                                                For, <?php echo $companyDetails['name'];?>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                AUTHORISED SIGNATORY
                                                </td>
                                            </tr>
                                              
                                            
                                              
                                              
                                              
                                      </table>
                                      
                                      <br>
                                    <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
                                    
                                    <a href="<?php echo base_url('rm-Purchase-order-data');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
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
function myFunction() {

        window.print();

    }
    function getCopyType(type)
{
   $("#getCopyType").text(type); 
}
</script>
</body>

</html>