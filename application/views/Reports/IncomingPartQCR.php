<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title class="contentTohide">Incoming Part QC Report | Aditya</title>

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
<style>
    @media print {
           .pagebreak {  
               clear: both;
               page-break-after: always;
           } 
        
	.contentTohide  {
		display: none;
	}
 

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('IncomingPartQCR');?>">Incoming Part QC Report</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">                    </p>

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

                            <div class="row contentTohide">
                            <h2 style="width: 80%;">Incoming Part QC Report</h2>
                               <div class="contentTohide" style="float:right;width:20%;">
                                <button class="btn btn-icon btn-sm btn-danger btn-hover" onclick="myFunction()"  style="float:right;"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></button>
                            </div>
                            </div>

                            <?php echo form_open('/IncomingPartQCR', array('autocomplete' => 'off','class' => 'row g-3 contentTohide','id' => 'formSch')); ?>
                           

                                    <div class="col-md-2">
                                       <label class="form-label">From Date<label class="mandatory">*</label></label>
                                       <input id="from_date" name="from_date" type="date" class="form-control" value="<?php echo set_value('from_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('from_date');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">To Date<label class="mandatory">*</label></label>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo set_value('to_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('to_date');?>
                                    </div>
                                    
                                    <div class="col-md-2">
                                       <label class="form-label">Select Branch<label class="mandatory">*</label></label>
                                        <?php $getBranchval = set_value('branch_id'); ?>
                                            <select id="branch_id" name="branch_id" class="form-select" >
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getBranchval==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                    <!--<div class="col-md-3">-->
                                    <!--   <label class="form-label">Raw Material</label>-->
                                    <!--   <?php $getRMVal = set_value('rm_id'); ?>-->
                                    <!--        <select id="rm_id" name="rm_id" class="form-select">-->
                                    <!--            <option value="">Select RM</option>-->
                                    <!--            <?php foreach($getRawMaterial as $rm){ ?>                                              -->
                                    <!--            <option value="<?=$rm['rm_id'];?>" <?php if($getRMVal == $rm['rm_id']) {echo "selected";} ?> ><?=$rm['name'];?></option>-->
                                    <!--           <?php } ?>-->

                                    <!--        </select>-->
                                    <!--        <?php echo form_error('rm_id');?>-->
                                    <!--</div>-->

                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
    
                                        </form>
                                        
                                   
                                <br><br>
                 
                            <div style="overflow-x: scroll;" id="reportContent">
                                  <?php $branch_name='';
                                foreach($getBranch as $branch){                                              
                                               if($getBranchval==$branch['id']){ 
                                                   $branch_name= $branch['name'];}
                                }?>
                                    <?php 
                                 // echo "<pre>";print_r($getPartQC);echo "</pre>";
                                        
                                        $totIss=0;$totRece=0;$totRej=0;$totBook=0;
                                        $dprdate1='';
                                        $dprId='';  
                                        $rcirmastid='';
                                        if(!empty($getPartQC)){
                                        foreach ($getPartQC as $dprdate) { 
                                           $supplier  = $this->getQueryModel->getSupplierById($dprdate['supplier_id']); 
                                            if($rcirmastid!=$dprdate['mast_id'] || $rcirmastid==""){ 
                                                 if($rcirmastid!=""){
                                                  echo '<thead><tr>
                                                           <th rowspan="3" colspan="8">REMARK : </th>
                                                           <th colspan="9">REMARKS : ACCEPTED / REJECTED / COND.ACCEPTED </th>
                                                        </tr>
                                                        <tr>
                                                           <th colspan="2"></th>
                                                           <th colspan="3"></th>
                                                           <th colspan="4"></th>
                                                        </tr>
                                                        <tr>
                                                           <th colspan="2">DATE</th>
                                                           <th colspan="3">INSPECTOR</th>
                                                           <th colspan="4"></th>
                                                        </tr>  </thead></tbody>
                                                     </table><br><br> <div class="pagebreak"></div>';
                                                  }
                                             $rcirmastid=$dprdate['mast_id'];
                                             ?>
                                     
                                            <table id="example" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6">Supplier's Name : <span style="text-transform:uppercase;"><?=$supplier['name'];?></span></th>
                                                        <th colspan="5">Supplier Code </th>
                                                        <th colspan="6"> 
                                                        <span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                                                        <span><?php echo $companyDetails['address'];?></span><br></th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan="3" colspan="5">PO Ref. : <?=$dprdate['mast_partspo_id'];?></th>
                                                         <th rowspan="3" colspan="4">Branch : <?=$branch_name;?></th>
                                                        <th rowspan="3" colspan="4">REPORT NO. : <?=$dprdate['mast_id'];?></th>
                                                        <th colspan="4" style="text-align:center;"> SUPPLIER CHALLAN  </th>
                                                    </tr>
                                                    <tr style="text-align:center;">
                                                       <th colspan="2">NO.</th>
                                                       <th colspan="2">DATE</th>
                                                    </tr>
                                                    <tr style="text-align:center;">
                                                       <th colspan="2"><?=$dprdate['challan_no'];?></th>
                                                       <th colspan="2"><?=$dprdate['challan_date'];?></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan='4'>Part RCIR Date  :   <?=date("d-m-Y",strtotime($dprdate['date']));?></th>
                                                         <th colspan='13'></th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan='2'>Sr No.</th>
                                                        <th rowspan='2'>Part Description </th>
                                                        <th rowspan='2'>Operation </th>
                                                        <th rowspan='2'>Qty </th>
                                                        <th colspan='1'>Specification </th>
                                                        <th colspan='11'>Observations </th>
                                                         <th>Remark </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Parameter</th>
                                                         <th>Dim</th>
                                                        <th >1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                        <th>5</th>
                                                        <th>6</th>
                                                        <th>7</th>
                                                        <th>8</th>
                                                        <th>9</th>
                                                        <th>10</th>
                                                                                       
                                                        </tr>
                                                </thead>
                                                <tbody>
                                            
                                             
                                            
                                            
                                                
                                            <?php   $srno=0;
                                            }
                                               
                                               $partD=$this->getQueryModel->getPartBypartid($dprdate['part_id']);
                                               $operD=$this->getQueryModel->getOperation($dprdate['op_id']);
                                               $qualityD=$this->getQueryModel->getQualityChecksbyId($dprdate['qc_id']);
                                  
                                     ?>
                                    <tr style="background-color:<?php if($dprdate[reading]=='D'){ echo '#00bcd429'; }else{ echo '#80808040'; }?>">
                                        <?php if ($dprId!=$dprdate['mast_id']){
                                                    $srno++;
                                                    $dprId=$dprdate['mast_id'];
                                        ?>
                                        
                                            <td><?=$srno."-".$dprdate['det_partsrcir_id'];?></td>
                                            <td> <?=$partD['partno']." - ".$partD['name'];?>  </td>
                                            
                                            <?}else{echo "<td></td><td></td>";}?>
                                            
                                            <td> <?=$operD['name'];?>  </td>
                                            <td><?=$dprdate['qty'];?></td>
                                            <td> <?=$qualityD['name'];?>  </td>
                                            <td> <?php if($dprdate['ideal_value'] && $dprdate['tolerance'])
                                            {
                                                echo $dprdate['ideal_value']." ± ".$dprdate['tolerance'];
                                                
                                            }
                                            elseif($dprdate['ideal_value']){
                                                
                                                  echo  $dprdate['ideal_value'];  
                                                  
                                            }
                                            else{
                                                echo "-";
                                            }?>  </td>
                                            <td><?php if($dprdate[reading1]){ echo $dprdate[reading1]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading2]){ echo $dprdate[reading2]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading3]){ echo $dprdate[reading3]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading4]){ echo $dprdate[reading4]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading5]){ echo $dprdate[reading5]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading6]){ echo $dprdate[reading6]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading7]){ echo $dprdate[reading7]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading8]){ echo $dprdate[reading8]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading9]){ echo $dprdate[reading9]; }else{ echo "-";} ?></td>
                                            <td><?php if($dprdate[reading10]){ echo $dprdate[reading10]; }else{ echo "-";} ?></td>
                                            <td><?php echo $dprdate[qc_remarks]; ?></td>
                                    </tr>
                                    
                                    <?php } 
                                      echo '<thead><tr>
                                               <th rowspan="3" colspan="8">REMARK : </th>
                                               <th  colspan="9">REMARKS : ACCEPTED / REJECTED / COND.ACCEPTED </th>
                                            </tr>
                                            <tr>
                                               <th colspan="2"></th>
                                               <th colspan="3"></th>
                                               <th colspan="4"></th>
                                            </tr>
                                            <tr>
                                               <th colspan="2">DATE</th>
                                               <th colspan="3">INSPECTOR</th>
                                               <th colspan="4"></th>
                                            </tr>        
                                              </thead></tbody>
                                         </table><br><br> <div class="pagebreak"></div>';
                                        }
                                    ?>
                          
                         
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

<script>
$(document).ready(function() {
  
  
} );

    function myFunction() {
  
     var printContents = document.getElementById("reportContent").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
    }
    
 

</script>

</body>

</html>