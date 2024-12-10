<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Part Stock Details | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('PartMvmtDatewiseDetails');?>">Datewise Documents</a></li>
                            
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

                            <div class="row">
                            <h2 style="width: 82%;">Datewise Documents</h2>
                            
                            </div>

                            <?php echo form_open('/PartMvmtDatewiseDetails', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                   
                                     <div class="col-md-3">
                                                           <label class="form-label">From Date<label class="mandatory">*</label></label>
                                                           <?php $fromdate=(set_value('schedule_from_date'))?set_value('schedule_from_date'):getMinDate();?>
                                                           <input id="schedule_from_date" name="schedule_from_date" type="date" class="form-control" value="<?=$fromdate;?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                                           <?php echo form_error('schedule_from_date');?>
                                                        </div>
                        
                                                        <div class="col-md-3">
                                                           <label class="form-label">To Date<label class="mandatory">*</label></label>
                                                            <?php $todate=(set_value('schedule_to_date'))?set_value('schedule_to_date'):date('Y-m-d');?>
                                                           <input id="schedule_to_date" name="schedule_to_date" type="date" class="form-control" value="<?=$todate;?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                                           <?php echo form_error('schedule_to_date');?>
                                                        </div>
                                                        
                                                         <div class="col-md-4">
                                        <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                         <?php $pId= set_value('Part_Id');  $pname= set_value('Part_Search');?>
                                        <input type="hidden" id="Part_IdOnly" name="Part_Id" class="form-select Part_Id" value="<?=$pId;?>">
                                           <div class="autocomplete">
                                              <input type="search" id="Part_SearchOnly" name="Part_Search" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value,'Only','<?=base_url('getPartsBySearch')?>')">   
                                              <ul id="searchResultOnly" class="searchResult"></ul>   
                                           </div>  
                                            <?php echo form_error('Part_Search');?>  
                                          <?php echo form_error('Part_Id');?>  
                                    </div>
                                  
                                                        
                                                        
                                    <div class="col-2" style="margin-top: auto;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                    </div>
                            </form>
                                        <br><br>
                            
                            <div style="">
                            <?php
                            error_reporting(0);
                            if(!empty($partStockDatewiseDetails)){ ?>
                            <br>
                             <div style="overflow: auto;">
                                <table class="table" style="width:100%;text-transform:uppercase;" id="example1">
                                  <thead>
                                    <tr>
                                    <th style="width:8%">Date</th>
                                    <th>Type</th>
                                    <th>DOC ID</th>
                                    <th style="width:8%">Inv No</th>
                                    <th>Move From</th>
                                    <th>Move To</th>
                                    <th>Operation</th>
                                    <th>Issue Qty</th>
                                    <th>Received Qty</th>
                                    <th>Rec. Type</th>
                                    <th>DC Detail</th>
                                    <th>Branch</th>
                                    </tr>
                                  </thead>
                                 <tbody>
                                   <?php  
                                   $finalstock=0;
                                 //  echo "<pre>";  print_r($partStockDatewiseDetails); echo "</pre>";
                                foreach ($partStockDatewiseDetails as $key1 => $value1) { 
                                       $branchD =  $this->getQueryModel->getBranchbyId($value1['branch_id']);
                                       $operD=$this->getQueryModel->getOperation($value1['op_id']); 
                                         $sequnceNo=$this->getQueryModel->getSequenceNo($value1['part_id'],$value1['op_id']); 
                                       ?>
                                  <tr <?php if($value1['op_id']==47 && $value1['issue_doc_type']=='invoice'){ echo 'style="background:#25476a2e;"';}?>>
                                      
                                   <?php if($value1['op_id']==47 && $value1['issue_doc_type']=='invoice'){
                                         $MastInvNo=  $this->getQueryModel->getMastInvNoById($value1['issue_doc_id']);?>
                                     
                                      <td><?=date('d-m-Y',strtotime($MastInvNo['inv_date']));?></td> 
                                      <td><?php echo "Invoice";?></td> 
                                      
                                   <?php }else{ ?>
                                      
                                    <td><?=date('d-m-Y',strtotime($value1['dpr_date']));?></td> 
                                    <td><?=$value1['type'];?></td> 
                                    <?php } ?>
                                    
                                    <td><?=$value1['mast_id']."  -  ".$value1['det_id'];?></td>
                                    <td><?php if($value1['op_id']==47 && $value1['issue_doc_type']=='invoice'){
                                         $MastInvNo=  $this->getQueryModel->getMastInvNoById($value1['issue_doc_id']);
                                         echo $MastInvNo['invoice_no']."<br>";
                                    } ?></td> 
                                    <td><?php
                                     if(substr($value1['move_from'],0,1)=='S'){
                                              $supplierD=  $this->getQueryModel->getSupplierById(substr($value1['move_from'],1,6));
                                              echo $supplierD['name']; 
                                            }else if(substr($value1['move_from'],0,1)=='B'){
                                               $branchD=  $this->getQueryModel->getBranchbyId(substr($value1['move_from'],1,6));
                                                echo $branchD['name'];
                                            }else{
                                                echo " - ";
                                            }                                            ?>
                                    </td> 
                                    <td><?php
                                        if(substr($value1['move_to'],0,1)=='S'){
                                              $supplierD=  $this->getQueryModel->getSupplierById(substr($value1['move_to'],1,6));
                                              echo $supplierD['name']; 
                                        }else if(substr($value1['move_from'],0,1)=='B'){
                                               $branchD=  $this->getQueryModel->getBranchbyId(substr($value1['move_to'],1,6));
                                                echo $branchD['name'];
                                        }else{
                                                echo " - ";
                                        }
                                        ?>
                                    </td>
                                    <td><?php if($value1['op_id']==47 && $value1['issue_doc_type']=='invoice'){ echo "Invoice"; }else{ echo $sequnceNo." - ".$operD['name'];}?></td>
                                    <td><?=$value1['issue_qty'];?></td> 
                                    <td><?=$value1['received_qty']+$value1['inprocess_loss_qty'];?></td>
                                    <td><?=$value1['received_doc_type'];?></td> 
                                    <td><?php
                                    if($value1['received_doc_type']=='dc_rcir'){
                                                  $res = $this->getQueryModel->getDCDetailsbydocId($value1['det_id']);
                                                  
                                                  echo $res['dc_details'];
                                    }
                                    ?></td> 
                                    <td><?=$branchD['name'];?></td>
                                </tr>
                                <?php
                              //  } 
                                } ?>
                                </tbody>
                            </table>
                            </div>
                            <?php } ?>
                           
                            </div>

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
    <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   

<script>
$(document).ready(function() {
 
      $('#example1').DataTable( {
        dom: 'Bfrtip',
       "bPaginate": false,
    } );
    
} );



</script>
</body>

</html>