<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Tool History Card | Aditya</title>

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
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
<style>
.select2-container .select2-selection--single{
    display: block;
    width: 100%;
   padding: 1.1rem 1rem;
    font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.07);
    appearance: none;
    border-radius: 0.4375rem;
    box-shadow: inset 0 1px 2px rgb(55 60 67 / 8%);
    transition: border-color .35s ease-in-out,box-shadow .35s ease-in-out;
        border: 1px solid rgb(55 60 67 / 25%);
 }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    line-height: 11px !important;
    text-transform:uppercase !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 37px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 0px !important;
    overflow: visible !important;
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
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                               <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('tranToolDetailReport');?>">Tool History Card</a></li>
                            
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

                             <?php  error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>    

                            <div class="row btnprnt">
                            <h2 style="width: 82%;">Tool History Card</h2>
                            
                            </div>
                           <div class="row btnprnt">
                            <?php echo form_open('/tranToolDetailReport', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    <div class="col-md-4" >
                                            <label class="form-label">Tool Name <label class="mandatory">*</label></label>
                                             <?php  $cn=set_value('Tool_Name');?> 
                                               <select class="form-select" name="Tool_Name" id="Tool_Name">
                                                    <option value="">Select Tools</option>
                                                  <?php 
                                                  foreach($getallTools as $tool){ ?>
                                                       <option value="<?=$tool['id'];?>" <?php if($cn==$tool['id']){ echo "selected"; }?>><?=$tool['name'];?></option>
                                                  <?php  }?> 
                                               </select>
                                                <?php echo form_error('Tool_Name');?>
                                        </div>
                                   <div class="col-md-2">
                                       <label class="form-label">From Date<label class="mandatory">*</label></label>
                                       <?php $fromdate=set_value('from_date'); ?>
                                       <input id="from_date" name="from_date" type="date" class="form-control" value="<?php echo $fromdate; ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('from_date');?>
                                    </div>
                                    
                                    <div class="col-md-2">
                                       <label class="form-label">To Date<label class="mandatory">*</label></label>
                                        <?php $todate=set_value('to_date'); ?>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo $todate; ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('to_date');?>
                                    </div>
                                  
                                        <div class="col-2" style="margin-top: auto;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>
 </div>
                           
                            <br><br><br>
                           <div class="pagebreak">
                                      <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                        
                                         <tr>
                                            <td style="text-align: center;" colspan="6">
                                                  <span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                                                  <span ><?php echo $companyDetails['address'];?></span><br>
                                                  <span style=""><span style="">EMAIL ID : </span><?php echo $companyDetails['email_id'];?></span>
                                            </td>
                                             <td style="text-align: center;" colspan="2">
                                              <b>F No-:F/15/01 </b>
                                            </td>
                                         </tr>
                                        <tr>
                                            <td style="text-align: center;font-size: 20px;font-weight: 600;" colspan="6">
                                                TOOL HISTORY CARD
                                            </td>
                                              <td style="text-align: center;" colspan="2">
                                              <b>Rev Date-:<?php echo date('d-m-Y'); ?></b>
                                            </td>
                                        </tr>
                                       
                                        <!--<tr>-->
                                        <!--    <td  colspan="3" style="text-transform:uppercase;">-->
                                        <!--        <b>Part Name </b> :-->
                                        <!--    </td>-->
                                        <!--    <td colspan="5"></td>-->
                                        <!--</tr>-->
                                        <!--<tr>-->
                                        <!--    <td  colspan="3" style="text-transform:uppercase;">-->
                                        <!--        <b>Part No </b> :-->
                                        <!--    </td>-->
                                        <!--    <td colspan="5"></td>-->
                                        <!--</tr>-->
                                         <tr>
                                            <td  colspan="3" style="text-transform:uppercase;">
                                                <b>Tool life </b> : <?php echo number_format($tData['ideal_qty'],0,'.',',');?>
                                            </td>
                                            <td colspan="5"></td>
                                        </tr>
                                         <tr>
                                            <td  colspan="3" style="text-transform:uppercase;">
                                                <b>Tool Grinding Frequency </b> :<?php echo number_format($tData['grinding_frequency'],0,'.',',');?>
                                            </td>
                                            <td colspan="5"></td>
                                        </tr>
                                     
                                        <tr>
                                            <th>Loading date</th>
                                            <th>Unloading date</th>
                                            <th>Part Name</th>
                                            <th>Machine No</th>
                                            <th>Production Qty</th>
                                            <th>Remaining Tool life</th>
                                            <th>Tool Condition/Remark</th>
                                            <th>Type</th>
                                        </tr>
                                        
                                            <tr> 
                                               <td  colspan="4" style="text-transform:uppercase;">
                                                <b>Used Quantity </b> :
                                            </td>
                                            <td colspan="4">
                                                <?php
                                                      $rem_tool_life =  $this->getQueryModel->getRemToollife();
                                                echo number_format($rem_tool_life['ob'],0,'.',',');
                                                
                                                ?>
                                            </td>
                                            </tr>
                                              <?php 
                                              $sr=1;
                                              $grand_total=0;
                                            // echo "<pre>";print_r($getToolDetails);echo "</pre>";
                                             $countofres=count($getToolDetails);
                                            $dateArray = array();
      
    //  1   2    3    6
      
                                       $prev_record_date = '';
                                       $consecutive_date_flag= 0;
                                       $remaining_qty= $tData['ideal_qty']-$tData['ob'];
                                       $productionQty=0+$rem_tool_life['ob'];
                                       
                                          foreach($getToolDetails as   $key=>$val)
                                          {  echo "<tr>";
                                              if ($prev_record_date==''   )
                                              {   $prev_record_date = $getToolDetails[$key]['date'];
                                                  echo "<td>".date('d-m-Y',strtotime($prev_record_date))."</td>";

                                              }
                                              else
                                              {
                                             /* if ($consecutive_date_flag==1)
                                              {
                                                  echo "<td>-</td>";
                                                 
                                              }
                                              else
                                              {*/
                                                      echo "<td>".date('d-m-Y',strtotime($getToolDetails[$key]['date']))."</td>";
                                             
                                              //}
                                              }
                                               $consecutive_date_flag=0;
                                               $next_record_date = $getToolDetails[$key+1]['date'];
                                              // $next_record_part_id= $getToolDetails[$key+1]['part_id'];
                                               $next_prev_date = date('Y-m-d',strtotime('+1 day', strtotime($getToolDetails[$key]['date'])));
                                            //  echo $next_prev_date."     ----   ".$next_record_date."<br>";
                                              if($next_record_date ==$next_prev_date && $getToolDetails[$key+1]['part_id'] == $getToolDetails[$key]['part_id'])
                                                {echo "<td>-</td>"; $consecutive_date_flag=1;}
                                              else
                                              {
                                                 echo "<td>". date('d-m-Y',strtotime($getToolDetails[$key]['date']))."</td>";
                                                 $consecutive_date_flag= 0;
                                              }
                                               $prev_record_date = $getToolDetails[$key]['date'];
                                               
                                                $totamt=0;
                                                $mData =  $this->getQueryModel->getMachineById($val['machine_id']);
                                                $pData =  $this->getQueryModel->getPartsById($val['part_id']);
                                               
                                               ?>
                                                <td style="text-transform:uppercase;"> <?php echo $pData['partno']." - ".$pData['name'];?></td>
                                                <td style="text-transform:uppercase;"> <?php echo $mData['name'];?></td>
                                                <td> <?php
                                                $productionQty+=$val['qty'];
                                                
                                                echo number_format($val['qty'],0,'.',',');
                                                ?></td>
                                                <td> <?php
                                                    $remaining_qty=($remaining_qty-$val['qty']);
                                                     echo  number_format($remaining_qty,0,'.',',');
                                                     ?>
                                                </td>
                                               <td><?=$val['remark'];?></td>
                                               <td><?=$val['type'];?></td>
                                            </tr>
                                              
                                            <?php   } ?>
                                              <tr style="font-size:18px;color:green;">
                                                <td colspan="4">  Total </td>
                                                <td colspan="4"> <?=number_format($productionQty,0,'.',',');?></td>
                                            </tr>  
                                             <tr>
                                                <td colspan="8">  </br> </td>
                                            </tr>  
                                                 <tr>
                                                <td colspan="8"></br></td>
                                            </tr> 
                                            <tr>
                                                <td align="left" colspan="8">
                                               Prepared By-M.R
                                                </td>
                                            </tr>
                                              
                                           
                                      </table>
                           

                        </div>
                         <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
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
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
    
   

<script>
$(document).ready(function() {
   $('select#Tool_Name').select2();
    //   $('#example1').DataTable( {
    //     dom: 'Bfrtip',
    //     "paging": false,
    //     buttons: [
    //         'csv', 'excel', 'pdf', 'print'
    //     ]
    // } );
    
} );

function myFunction() {

window.print();

}

</script>
</body>

</html>