<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View RM Stock Details | Aditya</title>

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
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                              <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('RMConsumptionR');?>">RM Consumption Details</a></li>
                            
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
                          <h2 class="mb-3 btnprnt">RM Consumption Details</h2>
                          <div class="col-md-12 mb-6">
                       <div class="card mb-3">
                        <div class="card-body">
                            <?php echo form_open('/RMConsumptionR', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
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
                             

                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                            
                            <div>
                                     <div style="overflow: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Grade</th>
                                        <th>Issue Qty (KG)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($RMConsumpDetails)){
                                       // print_r($RMConsumpDetails);
                                        $srno=0;
                                        $totIss=0;
                                        $RMConsumpData = json_decode($RMConsumpDetails,true);
                                        foreach ($RMConsumpData as $key => $value) { 
                                            $srno++;
                                        
                                      //  $rmdata = $this->getQueryModel->getRawMaterialbyrmid($value['rm_id']);
                                         //  $brData = $this->getQueryModel->getBranchbyId($value['branch_id']);
                                     ?>
                                    <tr>
                                        <td><?=$srno;?></td>
                                        <td style="text-transform: uppercase;"><?=$value['grade'];?></td>
                                        <td ><?=($value['issue_qty'])?$value['issue_qty']:" - ";
                                              $totIss=$totIss+$value['issue_qty'];?>
                                        </td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                         </div>
                            </div>
                                <?php 
                                if(!empty($RMConsumpDetails)){ ?>
                                     <div style="overflow-y: scroll;">
                                       <table class="table table_stripped" style="text-align: center;">
                                           
                                        <tr>
                                            <th>Total Issue Qty</th>
                                        </tr>
                                        <tr>
                                            <td style="color: red;font-size: 24px;"><?=$totIss;?></td>
                                        </tr>
                                     
                                 
                                          <tr>
                                            <th>
                                                  <div class="col-md-8 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                        
                                                            <h5 class="card-title">RM Consumption chart</h5>
                        
                                                            <!-- Bar Chart -->
                                                            <canvas id="_dm-consumptChart" style="">
                                                                
                                                            </canvas>
                                                           
                                                            <!-- END : Bar Chart -->
                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                         
                                    </table>
                                    </div>
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
<script>
$(document).ready(function() {
    $('#example').DataTable( {
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
         
          var  consumptionData = <?=$RMConsumpDetails;?>;
            
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