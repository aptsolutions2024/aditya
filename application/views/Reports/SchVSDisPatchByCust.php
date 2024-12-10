<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Schedule VS Dispatch By Customer | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('SchVSDisPatchByCust');?>">Schedule VS Dispatch By Customer</a></li>
                            
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

                            <?php echo form_open('/SchVSDisPatchByCust', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
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
                                
                                    <div class="col-md-2">
                                       <label class="form-label">Select month<label class="mandatory">*</label></label>
                                         <?php  $schedule_from_date = set_value('date');
                                           $selfromdate=($schedule_from_date)?$schedule_from_date:date('Y-m');
                                         ?>
                                       <input id="date" name="date" type="month" class="form-control" value="<?php echo set_value('date',$selfromdate); ?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>
                                    <div class="col-2" style="margin-top: 40px;">
                                    <button type="submit" class="btn btn-primary" >Show</button>
                                    </div>
                                        
                                </form>
                                        <br><br>
                                 <?php 
                                 if(!empty($getScheduleQtyInvoiceQtyAll)){ ?>   
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Part Name</th>
                                        <th>Schedule Qty</th>
                                        <th>Invoice Qty</th>
                                        <th>Percent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;
                                    //echo "<pre>";print_r($getScheduleQtyInvoiceQtyAll);echo "</pre>";
                                    foreach($getScheduleQtyInvoiceQtyAll as $row){
                                        $count++;
                                        $cD = $this->getQueryModel->getCustomersbyid($row['customer_id']);
                                      //  $pD = $this->getQueryModel->getPartsById($row['part_id']);
                                    ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td><?=$cD['name'];?></td>
                                        <td><?=$row['partno'];?></td>
                                        <td><?=round($row['scheduled_qty'],2);?></td>
                                        <td><?=round($row['inv_qty'],2);?></td>
                                        <?php $per=round((($row['inv_qty']*100)/$row['scheduled_qty']),2);?>
                                        <td style='color:<?=($per>=100)?"green":"red";?>'><?=$per."%";?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <?php } ?>
<br>
<?php if(!empty($getScheduleQtyInvoiceQtyAll)){?>
                                <div class="row">
                                    <div class="col-md-12" style="position: relative;height:1500px;">
                                      
                                        
                                        <!-- Bar Chart -->
                                        <canvas id="ScheduleVSDispatchbyCust"></canvas>
                                        <!-- END : Bar Chart -->
                                            
                                    </div>
                                </div>
                                <?php } ?>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        pageLength: 25,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
   // var pId = '<?=$pf;?>';
   // getPartsByProdFamily(pId);
} );

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


    // Bar Chart
    // ----------------------------------------------
    const scheduleData =<?=(!empty($getScheduleQtyInvoiceQtyAll))?json_encode($getScheduleQtyInvoiceQtyAll):0;?>;
   // const InvData =""; 
           
        /*const barData = [ { y: "1", a: 100, b: 90 }, { y: "2", a: 75,  b: 65 },];*/
        const barChart = new Chart(
        document.getElementById("ScheduleVSDispatchbyCust"), {
            type: "bar",
            data: {
                datasets: [
                    {
                        label: "Schedule Qty",
                        data: scheduleData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            xAxisKey: "scheduled_qty",
                            yAxisKey: "partno"
                        }
                    },
                    {
                        label: "Invoice Qty",
                        data: scheduleData,
                        borderColor: infoColor,
                        backgroundColor: infoColor,
                        parsing: {
                            xAxisKey: "inv_qty",
                            yAxisKey: "partno"
                        }
                    }
                ]
            },

            options : {
              indexAxis: 'y',
              responsive: true,
              maintainAspectRatio: false,
                plugins :{
                    legend: {
                        display: true,
                        align: "end",
                        labels: {
                            color: `rgb( ${ mutedColorRGB })`,
                            boxWidth: 20,
                        }
                    },
                    tooltip : {
                        position : "nearest"
                    },
                    title: {
                       display: true,
                       text: 'Schedule VS Dispatch Report',
                       color: 'navy',
                       position: 'top',
                      font : { size: 20  },
                    },
                },

                interaction: {
                    mode : "index",
                    intersect: false,
                },
                scales: {
                 
                    y: {
                        grid: {
                            borderWidth: 0,
                            drawOnChartArea: false
                        },
                        ticks: {
                            font : { size: 12  },
                            color : `rgb( ${ mutedColorRGB })`,
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation:0,
                        }
                    },
                    x: {
                        grid: {
                            borderWidth: 0,
                            color: `rgba( ${ mutedColorRGB }, .07 )`
                        },
                        //suggestedMax: 150,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: true,
                            stepSize: 1000
                        }
                    },
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
                } ,
          
                
            }
        }
    );


});




</script>
</body>

</html>