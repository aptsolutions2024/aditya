<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Rejection Stock Summary | Aditya</title>

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
    <style>
        .tableHeading{
               font-size: 1.125rem;
                border: 1px dotted black;
                text-align: center;
                padding: 10px;
                background: gainsboro;
        }
        div.dataTables_wrapper {
    overflow: scroll;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('RejectionSummaryR');?>">Rejection Summary</a></li>
                            
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                       
                    </p>

                </div>

            </div>


            <div class="content__boxed">
                <div class="content__wrap">
                    <section>
                      <div class="row">
                          <h2 class="mb-3 btnprnt">Rejection Summary</h2>
                          <div class="col-md-12 mb-6">
                       <div class="card mb-3">
                        <div class="card-body">
                            <?php echo form_open('/RejectionSummaryR', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                   <div class="col-md-3">
                                       <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                       <?php $cn= set_value('Customer_Id'); ?>
                                       <select id="Customer_Id" name="Customer_Id" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getparts['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('Customer_Id');?>
                                    </div>
                                    <div class="col-md-3">
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
                             

                                        <div class="col-2" style="margin-top: 50px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                            
                            <div>
                         <!---------------------- For Tran DPR Quality Check -------------------------------->  
                           <br>
                          <h4 class="tableHeading">DPR Quality Check</h4>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>DPR ID</th>
                                        <th>QC Type</th>
                                        <th>QC Name</th>
                                        <th>Time</th>
                                        <th>Operation Name</th> 
                                        <th>Operator Name</th>  
                                        <th>Tool Name</th> 
                                        <th>Machine Name</th> 
                                        <th>Branch Name</th>
                                        <th>Rejected Qty</th>
                                        <th>Ideal Val</th>
                                        <th>Toler.</th>
                                        <th>Piece Sel.</th>
                                        <th>R1</th>
                                        <th>R2</th>
                                        <th>R3</th>
                                        <th>R4</th>
                                        <th>R5</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($getRejDPRSummary)){
                                   
                                        $srno=0;
                                        $totRej=0;
                                        //$RMConsumpData = json_decode($getRejSummary,true);
                                        //echo '<pre>';print_r($getRejSummary);echo '</pre>';
                                        foreach ($getRejDPRSummary as $key => $value) { 
                                        
                                        
                                           $qctableData = $this->getQueryModel->GetQcDPRById($value['dpr_id']);
                                       
                                          $brData = $this->getQueryModel->getBranchbyId($value['branch_id']);
                                          $opData = $this->getQueryModel->getOperationsById($value['op_id']);
                                         
                                           $toolData = $this->getQueryModel->getToolById($value['tool_id']);
                                           $machData = $this->getQueryModel->getMachineById($value['machine_id']);
                                           $operatorData = $this->getQueryModel->GetuserById($value['operator_id']);
                                       foreach ($qctableData as $key1 => $value1) {
                                            $srno++;
                                        $qcData = $this->getQueryModel->getQualityChecksbyId($value1['qc_id']);
                                     ?>
                                    <tr>
                                         <td><?=$srno;?></td>
                                         <td><?=$value['dpr_id'];?></td>
                                         <td><?=$qcData['qc_type'];?></td>
                                         <td><?=$qcData['name'];?></td>
                                         <td><?=$value1['time'];?></td>
                                          <td><?=$opData['Name'];?></td>  
                                          <td><?=$operatorData['fullname'];?></td>  
                                           <td><?=$toolData['name'];?></td>  
                                            <td><?=$machData['name'];?></td>  
                                          <td><?=$brData['name'];?></td>
                                             <td ><?=($value['rejected_qty'])?$value['rejected_qty']:" - ";
                                              $totRej=$totRej+$value['rejected_qty'];?>
                                        </td>
                                        <td><?=$value1['ideal_value'];?></td>
                                        <td><?=$value1['tolerance'];?></td>
                                        <td><?=$value1['piece_selection'];?></td>
                                        <td><?=$value1['reading1'];?></td>
                                        <td><?=$value1['reading2'];?></td>
                                        <td><?=$value1['reading3'];?></td>
                                        <td><?=$value1['reading4'];?></td>
                                        <td><?=$value1['reading5'];?></td>
                                        <td><?=$value1['qc_remark'];?></td>
                                    </tr>
                                    <?php
                                        }
                                    }} ?>
                                </tbody>
                            </table>
                                <?php 
                                if(!empty($getRejDPRSummary)){ ?>
                                       <table class="table table_stripped" style="text-align: center;">
                                           
                                        <tr>
                                            <th>Total DPR Rejected Qty</th>
                                        </tr>
                                        <tr>
                                            <td style="color: red;font-size: 24px;"><?=$totRej;?></td>
                                        </tr>
                                         
                                    </table>
                               <?php } ?>
                        <!---------------------- For Tran Parts RCIR Quality Check --------------------------------> 
                        <br><br>
                        <h4 class="tableHeading">Parts RCIR Quality Check</h4>
                           <table id="example1" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                         <th>Det RCIR ID</th>
                                         <th>QC Type</th>
                                        <th>QC Name</th>
                                        <th>Time</th>
                                        <th>Operation Name</th>   
                                        <th>Supp. Name</th> 
                                        <th>Branch Name</th>
                                        <th>Rejected Qty</th>
                                        <th>Ideal Val</th>
                                        <th>Toler.</th>
                                        <th>Piece Sel.</th>
                                        <th>R1</th>
                                        <th>R2</th>
                                        <th>R3</th>
                                        <th>R4</th>
                                        <th>R5</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($getRejRCIRSummary)){
                                   
                                        $srno=0;
                                        $totRej=0;
                                       // echo '<pre>';print_r($getRejRCIRSummary);echo '</pre>';
                                        foreach ($getRejRCIRSummary as $key => $value) { 
                                       
                                        
                                         //  $rmdata = $this->getQueryModel->getRawMaterialbyrmid($value['rm_id']);
                                       
                                          $brData = $this->getQueryModel->getBranchbyId($value['branch_id']);
                                          $opData = $this->getQueryModel->getOperationsById($value['op_id']);
                                          
                                            $suplData = $this->getQueryModel->getSupplierById($value['supplier_id']);
                                            
                                               $qctableData1 = $this->getQueryModel->GetQcPartsrcirById($value['det_id']);
                                           foreach ($qctableData1 as $key2 => $value2) { 
                                                 $qcData = $this->getQueryModel->getQualityChecksbyId($value2['qc_id']);
                                                    $srno++;
                                     ?>
                                    <tr>
                                        <td><?=$srno;?></td>
                                         <td><?=$value['det_partsrcir_id'];?></td>
                                           <td><?=$qcData['qc_type'];?></td>
                                        <td><?=$qcData['name'];?></td>
                                        <td><?=$value2['time'];?></td>
                                          <td><?=$opData['Name'];?></td> 
                                            <td><?=$suplData['name'];?></td> 
                                          <td><?=$brData['name'];?></td>
                                             <td ><?=($value['rejected_qty'])?$value['rejected_qty']:" - ";
                                              $totRej=$totRej+$value['rejected_qty'];?>
                                        </td>
                                        <td><?=$value2['ideal_value'];?></td>
                                        <td><?=$value2['tolerance'];?></td>
                                        <td><?=$value2['piece_selection'];?></td>
                                        <td><?=$value2['reading1'];?></td>
                                        <td><?=$value2['reading2'];?></td>
                                        <td><?=$value2['reading3'];?></td>
                                        <td><?=$value2['reading4'];?></td>
                                        <td><?=$value2['reading5'];?></td>
                                        <td><?=$value2['qc_remarks'];?></td>
                                    </tr>
                                    <?php 
                                        }
                                    }} ?>
                                </tbody>
                            </table>
                            </div>
                                <?php 
                                if(!empty($getRejRCIRSummary)){ ?>
                                       <table class="table table_stripped" style="text-align: center;">
                                           
                                        <tr>
                                            <th>Total Parts RCIR Rejected Qty</th>
                                        </tr>
                                        <tr>
                                            <td style="color: red;font-size: 24px;"><?=$totRej;?></td>
                                        </tr>
                                         
                                    </table>
                               <?php } ?>
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
    <!-- Chart JS Scripts [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/chart.js/chart.min.js" defer></script>
      <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );

} );


</script>
<script>
 document.addEventListener( "DOMContentLoaded", () => {

    // Color variables based on css variable.
    // ----------------------------------------------
    const _body           = getComputedStyle( document.body );
    const primaryColor    = _body.getPropertyValue("--bs-comp-active-bg");
    const successColor    = _body.getPropertyValue("--bs-success");
    const infoColor       = _body.getPropertyValue("--bs-info");
    const warningColor    = _body.getPropertyValue("--bs-warning");
    const mutedColorRGB   = _body.getPropertyValue("--bs-muted-color-rgb");
    const grayColor       = "rgba( 180,180,180, .2 )";

           //chart.series[0].setData(data);
         
          var  consumptionData = '';
            
        const barChart1 = new Chart(
        document.getElementById("_dm-consumptChart"), {
            type: "bar",
            data: {
                datasets: [
                    {
                        label: "ISSUE QTY",
                        data: consumptionData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        //backgroundColor: primaryColor,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',  // Bar 1
                            'rgba(54, 162, 235, 0.2)',  // Bar 2
                            'rgba(255, 206, 86, 0.2)',  // Bar 3
                            'rgba(75, 192, 192, 0.2)',  // Bar 4
                            'rgba(153, 102, 255, 0.2)', // Bar 5
                            'rgba(255, 159, 64, 0.2)'   // Bar 6
                        ],
                        parsing: {
                            xAxisKey: "grade",
                            yAxisKey: "issue_qty"
                        }
                    }
                ]
            },

            options : {
                plugins :{
                    legend: {
                        display: true,
                        align: "end",
                        labels: {
                            color: `rgb( ${ mutedColorRGB })`,
                            boxWidth: 10,
                        }
                    },
                    tooltip : {
                        position : "nearest"
                    }
                },

                interaction: {
                    mode : "index",
                    intersect: false,
                },

                scales: {
                    y: {
                        grid: {
                            borderWidth: 0,
                            color: `rgba( ${ mutedColorRGB }, .07 )`
                        },
                        suggestedMax: 150,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'ISSUE QTY',
                        font: { size: 15 },
                        color : `rgb( ${ mutedColorRGB })`
                      }
                    },
                    x: {
                        grid: {
                            borderWidth: 0,
                            drawOnChartArea: false
                        },
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            autoSkip: true,
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 7
                        },
                        title: {
                        display: true,
                        text: 'GRADE',
                        font: { size: 15 },
                        color : `rgb( ${ mutedColorRGB })`
                      }
                    }
                },

                elements: {
                    // Dot width
                    point : {
                        radius: 3,
                        hoverRadius: 5
                    },
                    // Smooth lines
                    line: {
                        tension: 0.2
                    }
                }
            }
        }
    );
            
        

} );


</script>
</body>

</html>