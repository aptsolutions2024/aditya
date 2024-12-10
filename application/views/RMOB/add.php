<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add RM OB | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>rmob">RM OB</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php if($getRMOBById['id']==''){ ?>
                    <h2 class="mb-3">Add RM OB</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update RM OB</h2>
                    <?php } ?>

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php  error_reporting(0); if($_SESSION['createU']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createU'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($getRMOBById['id']==''){ ?>
                                        <?php echo form_open('/createRMOB', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { $disabled = 'disabled'; ?>
                                        <?php echo form_open('/updateRMOB', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getRMOBById['id'];?>">
                                        
                                    <?php } ?>
                                    
                                    
                                        <div class="col-md-4">
                                       <label class="form-label">Raw Material<label class="mandatory">*</label></label>
                                        <?php $RMID = set_value('rm_id'); ?>
                                            <select id="rm_id" name="rm_id" class="form-select" <?=$disabled;?> >
                                                <option value="">Select RM</option>
                                                <?php foreach($getRawMaterial as $rm){ ?>                                              
                                                <option value="<?=$rm['rm_id'];?>" <?php if($RMID == $rm['rm_id']){ echo "selected";} ?> <?php if($getRMOBById['rm_id'] == $rm['rm_id']){ echo "selected";} ?> ><?=$rm['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('rm_id');?>
                                    </div>
                                    
                                        <div class="col-md-4">
                                       <label class="form-label">Year<label class="mandatory">*</label></label>
                                       <?php $obY = set_value('ob_year'); ?>
                                            <select id="ob_year" name="ob_year" class="form-select" <?=$disabled;?> onChange="checkRMInStock(this.value);">
                                                <option value="">Select Year</option>
                                                <option value="2022 - 23" <?php if($obY == '2022 - 23'){ echo "selected";} ?> <?php if($getRMOBById['doc_year'] == '2022 - 23'){ echo "selected";} ?> >2022 - 23</option>
                                                <option value="2023 - 24" <?php if($obY == '2023 - 24'){ echo "selected";} ?> <?php if($getRMOBById['doc_year'] == '2023 - 24'){ echo "selected";} ?> >2023 - 24</option>
                                                <option value="2024 - 25" <?php if($obY == '2024 - 25'){ echo "selected";} ?> <?php if($getRMOBById['doc_year'] == '2024 - 25'){ echo "selected";} ?> >2024 - 25</option>
                                                </select>
                                            <?php echo form_error('ob_year');?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                       <label class="form-label">Qty in kgs</label>
                                       <input id="qty" name="qty" type="text" class="form-control" placeholder="Qty in kgs" value="<?php echo set_value('qty',$getRMOBById['received_qty']); ?>">
                                        <?php echo form_error('qty');?>
                                    </div>
                                    
                                    
                                        <?php if($getRMOBById['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="/rmob"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="/rmob"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
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
    
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
 <script>
 function checkRMInStock(year)
 {
     var rmId = $("#rm_id").val();
     
     $.ajax({
      url:"<?php echo base_url(); ?>checkRMInStock",
      method:"POST",
      data:{rmId:rmId,year:year},
      success:function(result)
      {
      if(result == 1)
      {
        $("#rm_id").val('');
        $("#ob_year").val('');
        $("#qty").val('');
        alert("Raw Material Opening Balance record already exists.");
      }
      }
      }); 
      
 }

 </script>   

</body>

</html>