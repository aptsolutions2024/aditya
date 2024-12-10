<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Operation | Aditya</title>

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('operations');?>">Operations</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Add Operation</h2>
                    

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       
                                        <!-- Block styled form -->
                                        <?php if($getopts['id']==''){ ?>
                                        <?php echo form_open('/createOperations', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateOperations', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getopts['id'];?>">
                                    <?php } ?>



                                        <div class="col-md-6">
                                            <label class="form-label">Operation Name <label class="mandatory">*</label></label>
                                            <input id="Operation_Name" name="Operation_Name" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event,this);" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event,this);" type="text" class="form-control" placeholder="Operation Name" value="<?php echo set_value('Operation_Name', $getopts[Name]); ?>">
                                            <?php echo form_error('Operation_Name');?>
                                        </div>

                                        <div class="col-md-6">
                                            <label  class="form-label">Group Name<label class="mandatory">*</label></label>
                                            <select id="Group_Id" name="Group_Id" class="form-select">
                                                <option selected value="">Choose...</option> 

                                                <?php foreach($getoptsGrups as $row){ ?>                                              
                                                <option value="<?=$row['id'];?>" <?php if($getopts[op_group_id]==$row['id']){ echo "selected";} ?>><?=$row['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('Group_Id');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Carried Out<label class="mandatory">*</label></label>
                                            <select id="Carried_Out" name="Carried_Out" class="form-select">
                                                <option selected value="">Choose...</option> 
                                                <option value="1" <?php if($getopts[carriedOut]==1){ echo "selected";} ?> >Inhouse</option> 
                                                <option  value="2" <?php if($getopts[carriedOut]==2){ echo "selected";} ?> >Outsourced</option> 
                                                <option  value="3" <?php if($getopts[carriedOut]==3){ echo "selected";} ?> >Both</option> 
                                                <option  value="4" <?php if($getopts[carriedOut]==4){ echo "selected";} ?> >LabourCharges</option> 
                                            </select>
                                            <?php echo form_error('Carried_Out');?>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Raw Material Consumption<label class="mandatory">*</label></label>
                                            <select id="rmConsumption" name="rmConsumption" class="form-select">
                                                <option  value="0" <?php if($getopts[rmConsumption]==0){ echo "selected";} ?> >No</option> 
                                                <option  value="1" <?php if($getopts[rmConsumption]==1){ echo "selected";} ?> >Yes</option> 
                                            </select>
                                            <?php echo form_error('rmConsumption');?>
                                        </div>
                                         <div class="col-md-4">
                                            <label class="form-label">QC Required for DPR<label class="mandatory">*</label></label>
                                            <select id="qc_requiredfor_dpr" name="qc_requiredfor_dpr" class="form-select">
                                                <option  value="1" <?php if($getopts[qc_requiredfor_dpr]==1){ echo "selected";} ?> >Yes</option> 
                                                <option  value="0" <?php if($getopts[qc_requiredfor_dpr]==0){ echo "selected";} ?> >No</option> 
                                            </select>
                                            <?php echo form_error('qc_requiredfor_dpr');?>
                                        </div>

                                         
                                        <?php if($getopts['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="/addOperations"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="/operations"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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