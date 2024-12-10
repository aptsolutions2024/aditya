<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Inprocess DPR QC Report | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('InprocessDprQCR');?>">Inprocess DPR QC Report</a></li>
                            
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

                            <div class="row contentTohide">
                            <h2 style="width: 80%;">Inprocess DPR QC Report</h2>
                             <div class="contentTohide" style="float:right;width:20%;">
                                <button class="btn btn-icon btn-sm btn-danger btn-hover" onclick="myFunction()"  style="float:right;"><span><i class="demo-pli-printer" aria-hidden="true" style="font-size: 20px;"></i></span></button>
                            </div>
                            </div>

                            <?php echo form_open('/InprocessDprQCR', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    
                       

                                    <div class="col-md-2">
                                       <label class="form-label">From Date<label class="mandatory">*</label></label>
                                         <?php $from_date = set_value('from_date'); ?>
                                       <input id="from_date" name="from_date" type="date" class="form-control" value="<?php echo set_value('from_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('from_date');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">To Date<label class="mandatory">*</label></label>
                                       <?php $to_date = set_value('to_date'); ?>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo $to_date; ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
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
                           
                           <?php    $branch_name='';
                                            foreach($getBranch as $branch){                                              
                                                           if($getBranchval==$branch['id']){ 
                                                               $branch_name= $branch['name'];}
                                            }
                                            ?>
                                            
                          
                              <p style="text-align:center;"><span style="font-size: 20px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><BR>
                              <span><?php echo $companyDetails['address'];?></span><br> 
                               <span>Branch : <?=$branch_name;?>  &nbsp;&nbsp;&nbsp;&nbsp;From_date : <?=date("d-m-Y",strtotime($from_date));?>&nbsp;&nbsp;&nbsp;&nbsp;   To_date : <?=date("d-m-Y",strtotime($to_date));?></span></p>
                                    <?php 
                                  // echo "<pre>";print_r($getDPRdate);echo "</pre>";
                                      
                                        $totIss=0;$totRece=0;$totRej=0;$totBook=0;
                                        $dprdate1='';
                                        $dprId='';  
                                        
                                        foreach ($getDPRdate as $dprdate) { 
                                           
                                            if($dprdate1!=$dprdate['dpr_date'] || $dprdate1==""){ 
                                                 if($dprdate1!=""){
                                                  echo "</tbody>
                                                     </table><br><br> <div class='pagebreak'></div>";
                                                  }
                                             $dprdate1=$dprdate['dpr_date'];
                                             ?>
                                            <table id="example" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th colspan='3'>DPR Date : <?=date("d-m-Y",strtotime($dprdate1));?></th>
                                                         <th colspan='13'></th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan='3'>Sr No.</th>
                                                        <th rowspan='3'>Part Description </th>
                                                        <th rowspan='3'>Operation </th>
                                                        <th colspan='2'>Specification </th>
                                                        <th colspan='10'>Observations </th>
                                                         <th rowspan='2'>Remark </th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan='2'>Parameter</th>
                                                         <th rowspan='2'>Dimensions</th>
                                                            <th colspan='1'>First Piece</th>
                                                            <th colspan="8">Inprocess</th>
                                                            <th colspan='1'>Last Piece</th>
                                                            
                                                    </tr>
                                                    <tr>  
                                                        <th >9:30</th>
                                                        <th>10:30</th>
                                                        <th>11:30</th>
                                                        <th>12:30</th>
                                                        <th>1:30</th>
                                                        <th>2:30</th>
                                                        <th>3:30</th>
                                                        <th>4:30</th>
                                                        <th>5:30</th>
                                                        <th>6:30</th>
                                                        <th> <-Time</th>
                                                                                       
                                                        </tr>
                                                </thead>
                                                <tbody>
                                            
                                             
                                            
                                            
                                                
                                            <?php   $srno=0;
                                            }
                                               
                                               $partD=$this->getQueryModel->getPartBypartid($dprdate['part_id']);
                                               $operD=$this->getQueryModel->getOperation($dprdate['operation_id']);
                                               $qualityD=$this->getQueryModel->getQualityChecksbyId($dprdate['qc_id']);
                                           
                                  
                                     ?>
                                    <tr style="background-color:<?php if($dprdate[reading]=='D'){ echo '#00bcd429'; }else{ echo '#80808040'; }?>">
                                        <?php if ($dprId!=$dprdate['dpr_id'] ){
                                                    $srno++;
                                                        $dprId=$dprdate['dpr_id'];
                                        ?>
                                        
                                            <td><?=$srno."-".$dprdate['dpr_id'];?></td>
                                            <td> <?=$partD['partno']." - ".$partD['name'];?>  </td>
                                            
                                            <?}else{echo "<td></td><td></td>";}?>
                                            
                                            <td> <?=$operD['name'];?>  </td>
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
                                            <td><?php echo $dprdate[qc_remark]; ?></td>
                                    </tr>
                                    <?php } 
                                        echo "</tbody>
                                                     </table><br><br> <div class='pagebreak'></div>";
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
  
    
 var schedule_date =$("#schedule_date").val();    
 if(schedule_date=='')
 {
var monthControl = document.querySelector('input[type="month"]');
var date= new Date();
var month=("0" + (date.getMonth() + 1)).slice(-2);
var year=date.getFullYear();
monthControl.value = `${year}-${month}`;
 showSch();
}
} );

function showSch()
{
    var formSubmitFlag =$("#formSubmitFlag").val();
    if(formSubmitFlag==0 || formSubmitFlag=='')
    {
    var frm = document.getElementById("formSch");
    frm.submit();
    }
    //window.location.href = "<?php echo base_url(); ?>schedule";
}

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