<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>RM Stock Summary As On : <?php echo ($to_date)?date('d-m-Y',strtotime($to_date)):date('d-m-Y'); ?></title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('RMStockSummary');?>">RMStockSummary</a></li>
                            
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
  

                            <div class="row">
                            <h2 style="width: 82%;">RM Stock Summary As On : <?php echo ($to_date)?date('d-m-Y',strtotime($to_date)):date('d-m-Y'); ?></h2>
                            
                            </div>

                            <?php echo form_open('/RMStockSummary', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>


                                    <div class="col-md-3">
                                       <label class="form-label">To Date<label class="mandatory">*</label></label>
                                       <input id="to_date" name="to_date" type="date" class="form-control" value="<?php echo set_value('to_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                       <?php echo form_error('to_date');?>
                                    </div>


                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        

                                        <br><br>
                            
                            <div style="overflow-x: scroll;">
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th width="15%">Part No.</th>
                                        <th>RM Name</th>
                                    
                                       <?php 
                                          $brdata = $this->getQueryModel->getBranch();
                                         
                                          foreach($brdata as $br){ ?>
                                                   <th><?=$br['name'];?> In KGS</th>
                                                   <!--<th><?=$br['name'];?> In RS</th>-->
                                                            <?php } ?>    
                                        <th>Total In KGS</th>
                                        <!--<th>Total In RS</th>-->
                                      
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                                         $rmdata1 = $this->getQueryModel->getRawMaterial();
	                                     $toDate=($to_date)?$to_date:date('Y-m-d');
	                                     $sr=0;
	                                     
                                     foreach($rmdata1 as $rm){
                                        
                                         $RMStockSummary = $this->getQueryModel->getRMStockSummary($toDate,$rm['rm_id']);
                                     $totalqty=0;$totalamt=0;
                                       if(!empty($RMStockSummary)){   
                                             $sr++;
                                             
                                     ?>
                                    <tr>
                                        <td><?=$sr;?></td>
                                         <td align="center"> <?php
                                         $partData= $this->getQueryModel->getPartRmbyid($rm['rm_id']);
                                         foreach($partData as $part){
                                             $pdata= $this->getQueryModel->getPartsById($part['part_id']);
                                             echo $pdata['partno']." </br>";
                                         }  ?>
                                         </td>
                                        <td ><?=$rm['rm_id']." - ".$rm['name'];?></td>
                                        <?php
                                        $count=sizeof($brdata);
                                        $k=0;
                                      //echo $totalqty."<br>";
                                        $brid=1;
                                        while($k<$count && $brid<=$count){
                                        
                                        if($RMStockSummary[$k]['branch_id']==$brid) {
                                            echo "<td >".round($RMStockSummary[$k]['qty'],3)."</td>";
                                            // echo "<td >".$RMStockSummary[$k]['amount']."</td>";
                                            $totalqty=$totalqty+round($RMStockSummary[$k]['qty'],3);
                                            $totalamt=$totalamt+$RMStockSummary[$k]['amount'];
                                            $k++; 
                                            $brid++;
                                              
                                        }else{
                                            echo "<td>-</td>";
                                            // echo "<td>-</td>"; 
                                            $brid++;
                                        } 
                                         
                                        }
                                        ?>
                                        <td ><?=round($totalqty,3);?></td>
                                        <!--<td ><?=$totalamt;?></td>-->
                                        
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
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
function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteOptsRecord",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
   location.reload();
   }
   });
}
}
</script>
</body>

</html>