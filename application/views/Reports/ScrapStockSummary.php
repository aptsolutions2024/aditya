<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Scrap Stock Summary | Period From Date: <?php echo date('d-m-Y',strtotime(set_value('schedule_from_date')));?> To  <?php echo date('d-m-Y',strtotime(set_value('schedule_to_date')));?></title>

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
    <style>
        .Notetitle{
          margin: 5% 0% 0%;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('ScrapStockSummary');?>">Scrap Stock Summary</a></li>
                            
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
                            <?php echo form_open('/ScrapStockSummary', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                
                                   
                                                        <div class="col-md-3" style="display:none;">
                                                           <label class="form-label">From Date<label class="mandatory">*</label></label>
                                                           <input id="schedule_from_date" name="schedule_from_date" type="date" class="form-control" value="<?php echo set_value('schedule_from_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                                           <?php echo form_error('schedule_from_date');?>
                                                        </div>
                        
                                                        <div class="col-md-3">
                                                           <label class="form-label">Date<label class="mandatory">*</label></label>
                                                           <input id="schedule_to_date" name="schedule_to_date" type="date" class="form-control" value="<?php echo set_value('schedule_to_date'); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                                           <?php echo form_error('schedule_to_date');?>
                                                        </div>
                        
                        
                                                        <div class="col-md-2" style="margin-top: 43px;">
                                                        <button type="submit" class="btn btn-primary" name='export_data' value="export_data" >Show</button>
                                                        </div>
                                  
                                   
                                    
                            </form>
                            <br><br>
                                <div style="overflow: auto;">
                                 <table class="table" style="width:100%" id="example1">
                                 <thead>
                                    <tr>
                                    <th>Sr No</th>
                                    <th>Branch Name</th>
                                    <th>Type</th>
                                    <!-- <th>Received Qty</th>-->
                                    <!--<th>Issue Qty</th>-->
                                    <!--<th>Balance Qty</th>-->
                                    <th>Opening Balance</th>
                                    <th>Scrap Generated</th>
                                    <th>Scrap Sold</th>
                                    <th>Current Balance</th>
                                   </tr>
                                  </thead>
                                <tbody>
                                <?php 
                                $count=0;
                                   foreach($getScrapStockDet as $res1){
                                     $count++;
                                    $branchD = $this->getQueryModel->getBranchbyId($res1['branch_id']);
                                ?>
                                    
                                <tr>
                                    <td><?=$count;?></td>
                                    <td><?=$branchD['name'];?></td> 
                                    <td><?=$res1['type'];?></td>
                                    <td></td>
                                    <td><?=number_format($res1['received_qty'],2);?></td>
                                    <td><?=number_format($res1['issue_qty'],2);?></td> 
                                    <td><?=number_format(($res1['received_qty']-$res1['issue_qty']),2);?></td> 
                                </tr>
                        
                         <?php   }      ?>
                      </tbody>
                      </table>
                      </div>
                            <div class="Notetitle">
                               <label class="form-label">Note<label class="mandatory">*</label></label>
                                <label class="form-label">No Date selection will Export/Download current day-date  Scrap Data file</label>
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
    

<script>

$(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        pageLength: 25,
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
   
   
} );




</script>
</body>

</html>