<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Schedule VS Dispatch | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('SchVSDesPatchR');?>">Schedule VS Dispatch</a></li>
                            
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
   


<?php 
// print_r($getScheduleQty);
//  print_r($getInvoiceQty);

?>
                            <?php echo form_open('/SchVSDesPatchR', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                    
                            <!--<input type="hidden" id="formSubmitFlag" value="<?=$formSubmitFlag;?>" >-->


                                 <!--      <div class="col-md-3" style="margin-bottom: 10px;">-->
                                 <!--           <label class="form-label">Product Family Name <label class="mandatory">*</label></label>-->
                                 <!--           <?php $pf = set_value('prod_family'); ?>-->
                                 <!--           <select id="prod_family" name="prod_family" class="form-select" onchange="getPartsByProdFamily(this.value);">-->
                                 <!--             <option  value="">Choose...</option>-->
                                 <!--             <?php foreach($getProdfamily as $prodf){ ?>-->
                                 <!--             <option  value="<?=$prodf['id'];?>" <?php if($pf==$prodf['id']){echo "selected";} ?> <?php if($getparts['prodfamily_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>-->
                                 <!--             <?php } ?>-->
                                 <!--          </select>-->
                                 <!--           <?php echo form_error('prod_family');?>-->
                                 <!--       </div>-->
                                 <!--<div class="col-md-3">-->
                                 <!--           <label class="form-label">Part Name <label class="mandatory">*</label></label>-->
                                 <!--              <?php set_value('Part_Id'); ?>-->
                                 <!--           <select id="Part_Id" name="Part_Id" class="form-select Part_Id" >-->
                                 <!--               <option selected value="">Choose...</option> -->
												

                                 <!--           </select>-->
                                 <!--                <?php echo form_error('Part_Id');?>-->
                                 <!--           <div id="partExit1" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Part Name Already Exists.</div>-->
                                 <!--       </div>-->
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
                                       <label class="form-label">Schedule From Date<label class="mandatory">*</label></label>
                                         <?php  $schedule_from_date = set_value('schedule_from_date');
                                           $selfromdate=($schedule_from_date)?$schedule_from_date:date('Y-m');
                                         ?>
                                       <input id="schedule_from_date" name="schedule_from_date" type="month" class="form-control" value="<?php echo set_value('schedule_from_date',$selfromdate); ?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('schedule_from_date');?>
                                    </div>

                                    <div class="col-md-2">
                                       <label class="form-label">Schedule To Date<label class="mandatory">*</label></label>
                                          <?php $schedule_to_date = set_value('schedule_to_date');
                                              $seltodate=($schedule_to_date)?$schedule_to_date:date('Y-m'); ?>
                                       <input id="schedule_to_date" name="schedule_to_date" type="month" class="form-control" value="<?php echo set_value('schedule_to_date',$seltodate); ?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('schedule_to_date');?>
                                    </div>
                                        <div class="col-2" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                                 <?php 
                                 //echo '<pre>';
                                 //print_r($getScheduleQtyInvoiceQtyAll);
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
                                        <th>From Date</th>
                                        <th>To Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;
                                    
                                    foreach($getScheduleQtyInvoiceQtyAll as $row){
                                        $count++;
                                        $style = '';
                                        $cD = $this->getQueryModel->getCustomersbyid($row['customer_id']);
                                        $pD = $this->getQueryModel->getPartsById($row['part_id']);
                                        $per=round((($row['inv_qty']*100)/$row['scheduled_qty']),2);
                                        if($row['inv_qty']==0){ $style = "style='background-color:yellow'";}
                                    ?>
                                    <tr <?= $style; ?>>
                                        <td><?=$count;?></td>
                                        <td><?=$cD['name'];?></td>
                                        <td><?= $row['part_id'].' - '.$pD['partno'].' - '.$pD['name'];?></td>
                                        <td><?=round($row['scheduled_qty'],2);?></td>
                                        <td><?=round($row['inv_qty'],2);?></td>
                                        <td style='color:<?=($per>=100)?"green":"red";?>'><?=$per."%";?></td>
                                        <td><?=($schedule_from_date)?date('M Y',strtotime($schedule_from_date)):"";?></td>
                                        <td><?=($schedule_to_date)?date('M Y',strtotime($schedule_to_date)):"";?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <?php } ?>
<br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Bar Chart -->
                                        <canvas id="ScheduleVSDispatch"></canvas>
                                        <!-- END : Bar Chart -->
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
    var scheduleData =<?php echo ($getScheduleQty)?$getScheduleQty:0;?>;
    var InvData =<?php echo ($getInvoiceQty)?$getInvoiceQty:0;?>;
           
           <?php 
           $montharray=[];
          foreach($getScheduleQty as $sidata){
                  if(!in_array($montharray,$sidata['to_date'])){
                   array_push($montharray,$sidata['to_date']);
                   }
          }
           ?>
        /*const barData = [ { y: "1", a: 100, b: 90 }, { y: "2", a: 75,  b: 65 },];*/
        const barChart = new Chart(
        document.getElementById("ScheduleVSDispatch"), {
            type: "bar",
            data: {
                labels:[<?php   for ($m=0; $m<count($montharray); $m++) {
                                             $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                                             if($m==(count($montharray)-1)){
                                             echo "'".$month."'";
                                             }else{
                                               echo "'".$month."'".",";
                                             }}?>],
                datasets: [
                    {
                        label: "Schedule Qty",
                        data: scheduleData,
                        borderWidth: 2,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        parsing: {
                            xAxisKey: "to_date",
                            yAxisKey: "scheduled_qty"
                        }
                    },
                    {
                        label: "Invoice Qty",
                        data: InvData,
                        borderColor: infoColor,
                        backgroundColor: infoColor,
                        parsing: {
                            xAxisKey: "to_date",
                            yAxisKey: "invqty"
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
                            color: `rgba( ${ mutedColorRGB }, .07 )`
                        },
                        //suggestedMax: 150,
                        ticks: {
                            font : { size: 11  },
                            color : `rgb( ${ mutedColorRGB })`,
                            beginAtZero: false,
                            stepSize: 2000
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
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 12,
                             barThickness: 6
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


});

function getPartsByProdFamily(Prod_Family_Id)
{
    var pId = '<?=$pf;?>';
    $.ajax({
      url:"<?php echo base_url(); ?>getPartsByProdFamily",
      method:"POST",
      data:{Prod_Family_Id:Prod_Family_Id,pId:pId},
      success:function(result)
      {
         
      $("#Part_Id").html(result);
      }
      }); 
}


</script>
</body>

</html>