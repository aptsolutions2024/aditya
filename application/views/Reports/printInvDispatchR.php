<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Invoice Quality Check Report Print | Aditya</title>

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
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  font-size: 15px;
}

#content div.repheading{

}


@media print
{
.btnprnt{display:none}
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
                             <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('viewInvoice');?>">Invoice</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>
          
            </div>
             

            <div class="content__boxed">
                <div class="content__wrap">

                       <div class="repheading btnprnt"><h2 class="mb-3">Invoice Pre Dispatch Inspection Report </h2></div>
                    <?php  //echo "<pre>";   print_r($getQCById);  echo "</pre>";?>

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                      <?php //echo '<pre>';print_r($Getoperators); echo "</pre>"; ?>
                                      <div class="row" style="margin-bottom: 20px;">
                                      <table style="width: 100%;">
                                        <tr>
                                              <td style="text-align: center;" colspan="12">
                                          <span style="font-size: 20px;font-weight: 600;font-style: italic;"><?php echo $companyDetails['name'];?> </span>
                                          
                                          </td>
                                        </tr>   
                                        <tr>
                                              <td style="text-align: center;padding: 20px;" colspan="12">
                                          <span style="font-size: 25px;font-weight: 600;">Pre Dispatch Inspection Report </span>
                                          
                                          </td>
                                        </tr> 
                                        <tr>
                                              <td style="text-align:left;" colspan="3">
                                          <span style="font-size: 10px;font-weight: 600;">CUSTOMER NAME : <?php echo $getInvDetailsforR['cust_name'];?>  </span></td>
                                          <td style="text-align:left;" colspan="5">
                                          <span style="font-size: 10px;font-weight: 600;">PART NUMBER / MOD STATUS </span><BR><BR>
                                           <span style="font-size: 10px;font-weight: 600;">PART NO : <?php echo $getPartNameById['partno'];?>   </span></td>
                                          <td style="text-align:left;" colspan="4">
                                          <span style="font-size: 10px;font-weight: 600;">INVOICE NO :<?php echo $getInvDetailsforR['invoice_no'];?></span><BR>
                                          <span style="font-size: 10px;font-weight: 600;">QUANTITY : <?php echo $getInvDetailsforR['qty'];?></span><BR>
                                          <span style="font-size: 10px;font-weight: 600;">DATE : <?php echo $getInvDetailsforR['date'];?></span>
                                          </td>
                                        </tr>  
                                        <tr>
                                        <td style="" colspan="3"></td>
                                          <td style="text-align:left;" colspan="5">
                                          <span style="font-size: 10px;font-weight: 600;">PART NAME : <br><?php echo $getPartNameById['name'];?> </span>
                                           <span style="font-size: 10px;font-weight: 600;"> </span></td>
                                          <td style="" colspan="4">
                                          </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="12"></td>
                                        </tr> 
            <tr>
                <th> SR. &nbsp; NO. </th>
                <th> PARAMETER   </th>
                <th> SPECIFICATION</th>
                <th colspan="5"> SUPPLIER MESUREMENT RESULTS </th>
                <th> STATUS </th>
                <th> REM. </th>
            </tr>             

              <?php
                 $sr_no=1;
                //echo "<pre>";print_r($getQCById);echo "</pre>";
               foreach($getQCById as $key => $value){               
               ?>
                <tr>
                    <td> <?=$sr_no;?> </td>
                    <td style="text-transform:uppercase;"> <?php echo $value['quality_name'];?></td>
                    <td> <?php echo  $value['max_value']." - ".$value['min_value'];  ?>
                    </td>
                    <?php 
                        echo "<td>".$value['reading1']."</td>";
                        echo "<td>".$value['reading2']."</td>";
                        echo "<td>".$value['reading3']."</td>";
                        echo "<td>".$value['reading4']."</td>";
                        echo "<td>".$value['reading5']."</td>";
                        ?>
                    <td><?php echo $value['final_reading'];?></td>
                    <td><?php echo $value['remark'];?></td>
                                     
                </tr>                                         
           <?php $sr_no++; } ?>
           <tr>
               <td style="padding:30px;" colspan='12'></td>
           </tr>
            <tr>

                <td colspan='6'>PREPARED BY : Q.A Mngr</td>
                <td colspan='6'>APPROVED BY : G.M</td>
            </tr>
               <tr>
               <td style="padding:20px;" colspan='12'></td>
           </tr>
              
              
      </table>
                                    </div>
                                        <div id="operatorinfo">
                                            
                                        </div>
                                     
                                      
                                      <br>
                                    <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
                                    
                                    <a href="<?=base_url();?>editInvDetails?ID=<?=base64_encode($getInvDetailsforR['mast_inv_id']);?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
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
    <script>
function myFunction() {

        window.print();

    }
</script>
   

</body>

</html>