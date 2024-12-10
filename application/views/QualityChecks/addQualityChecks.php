<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Quality Checks | Aditya</title>

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('qualityChecks');?>">Quality Checks</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Quality Checks</h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php error_reporting(0); if($_SESSION['createRM']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createRM'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($getQC['id']==''){ ?>
                                        <?php echo form_open('/createQualityChecks', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateQualityChecks', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getQC['id'];?>">
                                    <?php } ?>
                                        
                                        
                                            <div class="row" style="margin-top: 10px;">                                             
                                            <div class="col-md-12">
                                                <label class="form-label">Quality Checks Name<label class="mandatory">*</label></label>
                                                <input id="Quality_Name" name="Quality_Name" style="text-transform: uppercase"  onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Quality Checks Name" value="<?php echo set_value('Quality_Name', $getQC[name]); ?>">
                                            <?php echo form_error('Quality_Name');?>
                                            </div>                                           
                                            </div> 
                                            
                                            <div class="row" style="margin-top: 10px;">
                                           
                                            <div class="col-md-4">
                                                <label  class="form-label">Material<label class="mandatory">*</label></label>
                                                <select id="material" name="material" class="form-select">
                                                    <option selected value="">Choose...</option> 
                                                    <option value="R" <?php if($getQC[material]=='R') {echo "selected";} ?>>Raw Material</option>
                                                    <option value="P" <?php if($getQC[material]=='P') {echo "selected";} ?>>Parts</option>
                                                        </select>
                                                <?php echo form_error('material');?>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <label  class="form-label">Quality Checks Type<label class="mandatory">*</label></label>
                                                <select id="Quality_Type" name="Quality_Type" class="form-select">
                                                    <option selected value="">Choose...</option> 
                                                    <option value="V" <?php if($getQC[qc_type]=='V') {echo "selected";} ?>>Visual</option>
                                                    <option value="D" <?php if($getQC[qc_type]=='D') {echo "selected";} ?>>Dimentional</option>
                                                    <option value="C" <?php if($getQC[qc_type]=='C') {echo "selected";} ?>>Certificate</option>
                                                        </select>
                                                <?php echo form_error('Quality_Type');?>
                                            </div>
                                <div class="col-md-4">
                                <label  class="form-label">Inspection Stage<label class="mandatory">*</label></label>
                                <?php $IS= set_value('inspection_stage'); ?>
                                <select id="inspection_stage" name="inspection_stage" class="form-select">
                                <option selected value="">Choose...</option> 
                                <option value="INC" <?php if($IS=='INC'){echo "selected";} ?> <?php if($getQC['inspection_stage']=='INC'){echo "selected";} ?> >Incoming</option>
                                <option value="INP" <?php if($IS=='INP'){echo "selected";} ?> <?php if($getQC['inspection_stage']=='INP'){echo "selected";} ?> >In Process</option>
                                <option value="PDR" <?php if($IS=='PDR'){echo "selected";} ?> <?php if($getQC['inspection_stage']=='PDR'){echo "selected";} ?> >Pre Despatch Report</option>
                                </select>
                                <?php echo form_error('inspection_stage');?>
                                </div>
                                                                                     
                                        </div>
                                       
                                        
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-8">
                                                <label class="form-label">Inspection Method<label class="mandatory">*</label></label>
                                                <textarea id="inspection_method" name="inspection_method" type="text" class="form-control" style="text-transform: uppercase" placeholder="Inspection Method"><?=$getQC[inspection_method];?></textarea>
                                                <?php echo form_error('inspection_method');?>
                                            </div>  
                                             <div class="col-md-4">
                                                <label class="form-label">Number of decimal digits<label class="mandatory">*</label></label>
                                                  <input id="numof_decimal" name="numof_decimal" onkeypress="" type="number" class="form-control" placeholder="Enter Number of decimal digits" value="<?php echo set_value('numof_decimal', $getQC[numof_decimal]); ?>">
                                            </div>
                                        </div>  
                                        <?php if($getQC['id']==''){ ?>
                                          
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
    var pattern = /^[a-z\d\-_\s\.]+$/i;
    //Validating the textBox value against our regex pattern.
    var isValid = pattern.test(String.fromCharCode(keyCode));   
    return isValid;
}

</script>
</body>

</html>