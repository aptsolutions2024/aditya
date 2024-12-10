<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Schedule | Aditya</title>

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
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css"> -->

    
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                   <li class="breadcrumb-item"><a href="<?php echo base_url('schedule');?>">Schedule</a></li>
                                 </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Add Schedule</h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                      
                                    
                                        <!-- Block styled form -->
                                        <?php if($getopts['id']==''){ ?>
                                        <?php echo form_open_multipart('/createSchedule', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open_multipart('/updateSchedule', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getopts['id'];?>">
                                    <?php } ?>



                                        <div class="col-md-12" style="text-align: right;">
                                            <label class="form-label"></label>
                                            <a href="<?php echo base_url(); ?>public/assets/Sample-CSV-Template.csv" download="Sample-CSV-Template.csv" style="font-size: 19px;overflow: hidden;outline: none;">Download Sample CSV Template</a>
                                        </div>
                                        <div style="font-size: 14px;color: #ff0000;"> <?php error_reporting(0); echo $_SESSION['errorMsg'];?></div>

                                        <div class="col-md-4">
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
                                       <label class="form-label">Schedule Month<label class="mandatory">*</label></label>
                                       <input id="schedule_date" name="schedule_date" type="month" class="form-control" value="<?php echo set_value('schedule_date', $getparts[schedule_date]); ?>" min="<?php echo $mindate=minDate();?>" max="<?php echo $maxdate=maxDate();?>">
                                       <?php echo form_error('schedule_date');?>
                                    </div>

                                        <div class="col-md-4">
                                       <label class="form-label">Upload File<label class="mandatory">*</label></label>
                                       <input id="schedule_file" name="schedule_file" type="file" class="form-control" value="<?php echo set_value('schedule_file', $getparts[schedule_file]); ?>" accept=".csv, text/csv" />
                                       <?php echo form_error('schedule_file');?>
                                    </div>

                                         
                                        <?php if($getopts['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="/schedule"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="/schedule"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } ?>
                                        </form>
                                        <!-- END : Block styled form -->

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
<script>
    function NumberAlphaBetDashUnderscoreSpace(e) {
    var keyCode = e.keyCode || e.which;    
    //Regex to allow only Alphabets Numbers Dash Underscore and Space
    var pattern = /^[a-z\d\-_\s]+$/i;
    //Validating the textBox value against our regex pattern.
    var isValid = pattern.test(String.fromCharCode(keyCode));   
    return isValid;
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
</body>

</html>