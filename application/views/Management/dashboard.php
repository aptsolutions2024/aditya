
<!DOCTYPE html>
<html lang="en">
<?php 
$pageName=$_SERVER['REQUEST_URI']; 
//print_r($_SESSION);die;
$role = $_SESSION['role'];
if(empty($_SESSION['role']))
{
    redirect(base_url('signIn'));
}

?>
<head>
    <meta name="generator" content="Hugo 0.87.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Dashboard | Aditya</title>
   
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

   <style>
   /*.chartwrapper{*/
   /*  height: 342.667px !important;*/
   /*  width: 686.667px !important;  */
   /*}*/
   </style>

</head>
<?php 

if($role==1  && $_SESSION['dashboard']==1){ 
$_SESSION['dashboard']=0;
?>
<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Page title and information -->
                    <h1 class="page-title mb-2">Dashboard</h1>
                    <h2 class="h5">Welcome back to the Dashboard.</h2>
                    <p>Scroll down to see quick links and overviews of your Server, To do list<br> Order status or get some Help using Nifty.</p>
                    <!-- END : Page title and information -->

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="row">
                        
                        <div class="col-xl-12">
                            <div class="row" style="">
                                <div class="col-sm-6">

                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-success text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-data-storage text-reset text-opacity-75 fs-3 me-2"></i> Total Dispatch (QTY IN NOS) - <?=$getLatestYear['year'];?></h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date('F')?></div>
                                                    <span class="fw-bold" id="disp_cmqty">0</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date("M Y", strtotime(getMinDate())); ?> - <?=date('M Y')?></div>
                                                    <span class="fw-bold" id="disp_tillqty">0</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Area Chart -->
                                        <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
                                            <canvas id="_dm-hddChart"></canvas>
                                        </div>
                                        <!-- END : Area Chart -->

                                    </div>
                                    <!-- END : Tile - HDD Usage -->

                                </div>
                                <div class="col-sm-6">

                                    <!-- Tile - Earnings -->
                                    <div class="card bg-info text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-coin text-reset text-opacity-75 fs-2 me-2"></i>Total Dispatch (Value In RS) - <?=$getLatestYear['year'];?></h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date('F')?></div>
                                                    <span class="fw-bold" id="dispatchRS">0</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date("M Y", strtotime(getMinDate())); ?> - <?=date('M Y')?></div>
                                                    <span class="fw-bold" id="dispatchRStill">0</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Line Chart -->
                                        <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
                                            <canvas id="_dm-earningChart"></canvas>
                                        </div>
                                        <!-- END : Line Chart -->

                                    </div>
                                    <!-- END : Tile - Earnings -->

                                </div>
                            </div>
                            <div class="row" style="">
                                <div class="col-sm-6">

                                    <!-- Tile - Sales -->
                                    <div class="card bg-purple text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-basket-coins text-reset text-opacity-75 fs-2 me-2"></i> Total Material Consumed (KG) - <?=$getLatestYear['year'];?></h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date('F');?></div>
                                                    <span class="fw-bold" id="totConsumed">0</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date("M Y", strtotime(getMinDate())); ?> - <?=date('M Y')?></div>
                                                    <span class="fw-bold" id="totConsumedtill">0</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Bar Chart -->
                                        <div class="py-0" style="height: 70px">
                                            <canvas id="_dm-salesChart"></canvas>
                                        </div>
                                        <!-- END : Bar Chart -->

                                    </div>
                                    <!-- END : Tile - Sales -->

                                </div>
                                <div class="col-sm-6">

                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-warning text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-basket-coins text-reset text-opacity-75 fs-2 me-2"></i> Total Schedule Completion (%) - <?=$getLatestYear['year'];?></h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date('F');?></div>
                                                    <span class="fw-bold" id="schcomplPer">0</span><span>%</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto"><?=date("M Y", strtotime(getMinDate())); ?> - <?=date('M Y')?></div>
                                                    <span class="fw-bold" id="schcomplPertill">0</span><span>%</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Horizontal Bar Chart -->
                                        <div class="py-0 pb-2" style="height: 70px">
                                            <canvas id="_dm-taskChart"></canvas>
                                        </div>
                                        <!-- END : Horizontal Bar Chart -->

                                    </div>
                                    <!-- END : Tile - Task Progress -->

                                </div>
                            </div>
                            
                            
                            <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">SCRAP STOCK CHART - AS ON <?php echo date('d-m-Y');?></h5>

                                    <!-- Bar Chart -->
                                    <canvas id="_dm-scrapChart" ></canvas>
                                    <!-- END : Bar Chart -->

                                </div>
                            </div>
                        </div>
                   
                        
                          <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">OPERATOR PERFORMANCE CHART - <?php echo date('M Y');?></h5>

                                    <!-- Bar Chart -->
                                    <canvas id="_dm-OperatorperChart"></canvas>
                                    <!-- END : Bar Chart -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">SCH VS DISPATCH CHART - <?php echo date('M Y');?></h5>

                                    <!-- Line Chart -->
                                    <canvas id="_dm-schvsdisChart"></canvas>
                                    <!-- END : Line Chart -->

                                </div>
                            </div>
                        </div>
                             <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">REJECTION SUMMARY CHART - <?php echo date('M Y');?></h5>

                                    <!-- Line Chart -->
                                    <canvas id="_dm-rejSummChart" class="chartwrapper"></canvas>
                                    <!-- END : Line Chart -->

                                </div>
                            </div>
                        </div>
                    </div>
                       <div class="row">
                      
                      <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">TRAN TOOLS CHART</h5>

                                    <!-- Line Chart -->
                                    <canvas id="_dm-tranToolChart" class="chartwrapper"></canvas>
                                    <!-- END : Line Chart -->

                                </div>
                            </div>
                        </div>
                             <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">CONSUMABLE CHART - <?php echo date('M Y');?></h5>

                                    <!-- Line Chart -->
                                    <canvas id="_dm-pieChart" class="chartwrapper"></canvas>
                                    <!-- END : Line Chart -->

                                </div>
                            </div>
                        </div>
                    </div>

                            <!-- Simple state widget -->
                            <div class="card" style="display:none;">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3">
                                            <div class="h3 display-3">95</div>
                                            <span class="h6">New Friends</span>
                                        </div>
                                        <div class="flex-grow-1 text-center ms-3">
                                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                            <button class="btn btn-sm btn-danger">View Details</button>

                                            <!-- Social media statistics -->
                                            <div class="mt-4 pt-3 d-flex justify-content-around border-top">
                                                <div class="text-center">
                                                    <h4 class="mb-1">1,345</h4>
                                                    <small class="text-muted">Following</small>
                                                </div>
                                                <div class="text-center">
                                                    <h4 class="mb-1">23k</h4>
                                                    <small class="text-muted">Followers</small>
                                                </div>
                                                <div class="text-center">
                                                    <h4 class="mb-1">278</h4>
                                                    <small class="text-muted">Posts</small>
                                                </div>
                                            </div>
                                            <!-- END : Social media statistics -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END : Simple state widget -->

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

    

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script>

    <!-- Chart JS Scripts [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/chart.js/chart.min.js" defer></script>

    <!-- Initialize [ SAMPLE ] -->
<!--<script src="<?php echo base_url() ?>public/assets/pages/chart.js" defer></script>-->
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>

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

  // Line Chart
    // ----------------------------------------------
    const lineData = [ {"elapsed": "Jan", "value": 18}, {"elapsed": "Feb", "value": 24}, {"elapsed": "March", "value": 9}, {"elapsed": "Apr", "value": 12}, {"elapsed": "May", "value": 13}, {"elapsed": "Jun", "value": 22}, {"elapsed": "Jul", "value": 11}, {"elapsed": "Aug", "value": 26}, {"elapsed": "Sep", "value": 12}, {"elapsed": "Oct", "value": 19}, {"elapsed": "Nov", "value": 19}, {"elapsed": "Dec", "value": 19} ];
    const lineChart = new Chart(
        document.getElementById("_dm-lineChart"), {
            type: "line",
            data: {
                datasets: [
                    {
                        label: "Total order",
                        data: lineData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            xAxisKey: "elapsed",
                            yAxisKey: "value"
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
                },

                // Tooltip mode
                interaction: {
                    intersect: false,
                },

                scales: {
                    y: {
                        grid: {
                            borderWidth: 0,
                            color: `rgba( ${ mutedColorRGB }, .07 )`
                        },
                        suggestedMax: 30,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            stepSize: 5
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



    // Bar Chart
   // const scrapData = [ { y: "1", a: 100, b: 90 }, { y: "2", a: 75,  b: 65 }, { y: "3", a: 20,  b: 15 }, { y: "5", a: 50,  b: 40 }, { y: "6", a: 75,  b: 95 }, { y: "7", a: 15,  b: 65 }, { y: "8", a: 70,  b: 100 }, { y: "9", a: 100, b: 70 }, { y: "10", a: 50, b: 70 }, { y: "11", a: 20, b: 10 }, { y: "12", a: 40, b: 90 } ];
      $.ajax({
        type: "GET",
        url: "<?=base_url();?>getScrapStkChart",
        dataType: "json",
        success: function (data) 
    { 
           //chart.series[0].setData(data);
         
           var scrapData = data;
            
        const barChart1 = new Chart(
        document.getElementById("_dm-scrapChart"), {
            type: "bar",
            data: {
                datasets: [
                    {
                        label: "MS",
                        data: scrapData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            xAxisKey: "br",
                            yAxisKey: "ms"
                        }
                    },
                    {
                        label: "St. Steel",
                        data: scrapData,
                        borderColor: infoColor,
                        backgroundColor: infoColor,
                        parsing: {
                            xAxisKey: "br",
                            yAxisKey: "ss"
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
                        //suggestedMax: 150,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            //stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'QUANTITY IN KGS',
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
                        text: 'BRANCH',
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
            
        }
    });


    // Bar Chart for operator performance
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>operatorPersummDashboard",
        dataType: "json",
        success: function (data) 
        { 
          
         //console.log(data);
           var operatorPerData = data;
                var colorpie=new Array();
            var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                 };
            operatorPerData.forEach(function(item){
         
            colorpie.push(dynamicColors());
            });
            const barChart3 = new Chart(
            document.getElementById("_dm-OperatorperChart"), {
            type: "bar",
            data: {
                datasets: [
                    {
                        label: "<?php echo date('M-Y');?>",
                        data: operatorPerData,
                        borderWidth: 2,
                        //borderColor: primaryColor,
                        backgroundColor: colorpie,
                        parsing: {
                            xAxisKey: "fname",
                            yAxisKey: "performance"
                        }
                    },
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
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                           // stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'PERFORMANCE PERCENTAGE',
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
                        text: 'OPERATORS',
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
            
        }
    });

 //Pie Chart for consumable
 
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>getConsumablePieChart",
        dataType: "json",
        success: function (data) 
    { 
           const response =data;

            var datapie   = new Array();
            var labelpie = new Array();
            var colorpie=new Array();
            var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                 };
            response.forEach(function(item){
            datapie.push(item.issue_qty);
            labelpie.push(item.grade);
            colorpie.push(dynamicColors());
            });
        const barChart2 = new Chart(
        document.getElementById("_dm-pieChart"), {
            //type: "doughnut",
              type: "pie",
             data:{
                labels:labelpie,
                datasets: [{
                    label: "Sample Pie Chart",
                    data:datapie,
                    backgroundColor: colorpie,
                }
                ],
                hoverOffset: 4,
                 borderColor: "#fff"
            },
            options: {
                responsive: true,
                legend: {
                  display: false  
                },
                animation: {
                  animateScale: true,
                  animateRotate: true
                }
              }

        }
    ); 
            
        }
    });
    //Schedule VS Dispatch chart
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>getCSchVSDischart",
        dataType: "json",
        success: function (data){ 
           //chart.series[0].setData(data);
         
           var schvsdisChart = data;
            
        const barChart1 = new Chart(
        document.getElementById("_dm-schvsdisChart"), {
            type: "bar",
            data: {
                datasets: [
                    {
                        label: "Scheduled Qty",
                        data: schvsdisChart,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            xAxisKey: "name",
                            yAxisKey: "scheduled_qty"
                        }
                    },
                    {
                        label: "Invoice Qty",
                        data: schvsdisChart,
                        borderColor: infoColor,
                        backgroundColor: infoColor,
                        parsing: {
                            xAxisKey: "name",
                            yAxisKey: "inv_qty"
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
                        //suggestedMax: 150,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            //stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'QUANTITY',
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
                        text: 'CUSTOMER',
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
            
        }
    });
   // Bar Chart for Rejection Summary customer wise

    $.ajax({
        type: "GET",
        url: "<?=base_url();?>RejSummaryDashboardR",
        dataType: "json",
        success: function (data) 
    { 
           //chart.series[0].setData(data);
         console.log(data);
         if(data){
           var rejData = data;
                var colorpie=new Array();
            var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                 };
            rejData.forEach(function(item){
            colorpie.push(dynamicColors());
            });
        const barChart3 = new Chart(
        document.getElementById("_dm-rejSummChart"), {
            type: "bar",
              data: {
                datasets: [
                    {
                        label: "Rejected QTY",
                        data: rejData,
                        borderWidth: 2,
                        //borderColor: primaryColor,
                        backgroundColor: colorpie,
                        parsing: {
                            xAxisKey: "customer",
                            yAxisKey: "rejected_qty"
                        }
                    },
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
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'REJECTED QTY',
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
                        text: 'CUSTOMER',
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
    }
            
        }
    });

// Bar Chart for Rejection Summary customer wise

    $.ajax({
        type: "GET",
        url: "<?=base_url();?>TranToolsDashboardR",
        dataType: "json",
        success: function (data) 
    { 
           //chart.series[0].setData(data);
         console.log(data);
           var toolData = data;
            
        const barChart3 = new Chart(
        document.getElementById("_dm-tranToolChart"), {
            type: "bar",
              data: {
                datasets: [
                    {
                        label: "Ideal Qty",
                        data: toolData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            //xAxisKey: "grinded_on",
                            xAxisKey: "tname",
                            yAxisKey: "ideal_qty"
                        }
                    },
                     {
                        label: "Max Qty",
                        data: toolData,
                        borderWidth: 2,
                        borderColor: infoColor,
                        backgroundColor: infoColor,
                        parsing: {
                            //xAxisKey: "grinded_on",
                            xAxisKey: "tname",
                            yAxisKey: "max_qty"
                        }
                    },
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
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            stepSize: 50
                        },
                        title: {
                        display: true,
                        text: 'IDEAL QTY',
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
                        text: 'TOOLS',
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
            
        }
    });
    
    // Total Dispatch QTY monthwise and from start to current month date
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>totalDispatch",
        dataType: "json",
        success: function (data) 
        { 
           console.log(data);
          $('span#disp_cmqty').text(data.current_month_total);
          $('span#disp_tillqty').text(data.overall);
        }
    });
    // Total Dispatch in RS monthwise and from start to current month date
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>totalDispatchInRS",
        dataType: "json",
        success: function (data) 
        { 
           console.log(data);
          $('span#dispatchRS').text(data.current_month_total);
          $('span#dispatchRStill').text(data.overall);
        }
    });
    // Total Consumed Material QTY monthwise and from start to current month date
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>totalConsumedMaterial",
        dataType: "json",
        success: function (data) 
        { 
           console.log(data);
          $('span#totConsumed').text(data.current_month_total);
          $('span#totConsumedtill').text(data.overall);
        }
    });
    // Total Consumed Material QTY monthwise and from start to current month date
    $.ajax({
        type: "GET",
        url: "<?=base_url();?>totalSchCompletion",
        dataType: "json",
        success: function (data) 
        { 
           console.log(data);
          $('span#schcomplPer').text(data.current_month_total);
          $('span#schcomplPertill').text(data.overall);
        }
    });
});
</script>

</body>
<?php }else{?>
<body class="jumping">
<style>
    .userdetailsdiv{
        padding-top: 0.5rem!important;text-transform: uppercase;margin: auto;
    }
    .userdetails{
        color:#c3c5c7!important;
    }
    .no_profle_img{
           width: auto;
         height: 250px; 
    }
    .borderdiv{
   
    border-top: 2px solid #dce1e7;
   
    }
</style>
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
                      
                            <li class="breadcrumb-item"><a href="<?php echo base_url('UserDashboard');?>">Home</a></li>
                            
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
                             <div class="row" style="min-height:400px;margin:auto;">
                              
                             <h2 class="h2" style="text-transform: uppercase;">Welcome <?=$_SESSION['username']?></h2>
                             <div class="borderdiv"></div>
            					<div class="col-sm-8 userdetailsdiv" style="">
            					  <div class="row">
            					      
            					   <div class="col-sm-4"> <h5 class="">Name     :  </h5></div><div class="col-sm-8"> <h5 class="userdetails"><?=$_SESSION['name']?></h5></div>
            					    <div class="col-sm-4"> <h5 class="">email_id :  </h5></div><div class="col-sm-8"> <h5 class="userdetails"><?=$_SESSION['email_id']?> </h5></div>
            					    <div class="col-sm-4"> <h5 class="">company_name :  </h5></div><div class="col-sm-8"> <h5 class="userdetails"><?=$_SESSION['company_name']?> </h5></div>
            					    <div class="col-sm-4"> <h5 class="">branch_name : </h5></div><div class="col-sm-8">  <h5 class="userdetails"><?=$_SESSION['branch_name']?> </h5></div>
            					    <div class="col-sm-4"> <h5 class="">role_name :  </h5></div><div class="col-sm-8"> <h5 class="userdetails"><?=$_SESSION['role_name']?> </h5></div>
            					    <div class="col-sm-4"> <h5 class="">Year : </h5></div><div class="col-sm-8">  <h5 class="userdetails"><?=$_SESSION['current_year']?> </h5></div>
            					  </div>
            					</div>
            					<div class="col-sm-4 userdetailsdiv">
            					    <div class="mininav-toggle text-center">
                                        <img class="mainnav__avatar  no_profle_img rounded-circle border" src="<?php echo base_url() ?>public/assets/img/profile-photos/no-profile-pic.jpg" alt="Profile Picture">
                                        <?php echo date("Y-m-d H:i:s");?>
                                    </div>
            					</div>
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

    

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script>

    <!-- Chart JS Scripts [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/chart.js/chart.min.js" defer></script>

    <!-- Initialize [ SAMPLE ] -->
<!--<script src="<?php echo base_url() ?>public/assets/pages/chart.js" defer></script>-->
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>


</body>

<?php } ?>
</html>