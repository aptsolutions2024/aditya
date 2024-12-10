<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add RM Movement | Aditya</title>

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
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>RMMovement">RM Movement</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php if($getRMMovement['id']==''){ ?>
                    <h2 class="mb-3">Add RM Movement</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update RM Movement</h2>
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
                                      <?php if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success errorMSGtxt" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                    <?php if($_GET['ID']==''){ 
                                            echo form_open('/createMovement', array('autocomplete' => 'off','class' => 'row g-3')); 
                                             $readonly="";
                                            $disabled="";
                                           } else {                                    
                                             echo form_open('/updateMovement', array('autocomplete' => 'off','class' => 'row g-3'));
                                             $readonly="readonly";
                                             $disabled="disabled"; ?>
                                            <input type="hidden" name="editId" value="<?=$getRMMovement['id'];?>">
                                    <?php } ?>
                                    
                                    
                                        <div class="col-md-6">
                                       <label class="form-label">Raw Material<label class="mandatory">*</label></label>
                                        <?php if(!empty($getRMMovement)){ ?>
                                                        <input type="hidden" name="rm_id" value="<?=$getRMMovement[rm_id];?>">
                                                   <?php } ?>
                                            <select id="rm_id" name="rm_id" class="form-select" onchange="getMovementRMStock(this.value);" <?=$disabled;?>>
                                                <option value="">Select RM</option>
                                                <?php foreach($getRawMaterial as $rm){ ?>                                              
                                                <option value="<?=$rm['rm_id'];?>" <?php if($getRMMovement[rm_id]==$rm['rm_id']){ echo "selected";} ?>><?=$rm['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('rm_id');?>
                                    </div>
                                    
                                    <div class="col-md-6">
                                       <label class="form-label">Max Qty</label>
                                       <input id="current_stock" name="current_stock" type="text" class="form-control" placeholder="Current Stock" readonly >
                                       <?php echo form_error('current_stock');?>
                                    </div>
                                    
                                        <div class="col-md-4">
                                       <label class="form-label">Move To<label class="mandatory">*</label></label>
                                        <?php if(!empty($getRMMovement)){ ?>
                                                        <input type="hidden" name="branch_id" value="<?=$getRMMovement[to_branch_id];?>">
                                                   <?php } ?>
                                            <select id="branch_id" name="branch_id" class="form-select" <?=$disabled;?>>
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getRMMovement[to_branch_id]==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                       <label class="form-label">Qty In Kgs</label>
                                        <?php if(!empty($getRMMovement)){ ?>
                                          <input id="qty" name="qty" type="text" class="form-control" placeholder="Qty in kgs" value="0" onInput="return checkupdateQty(this.value)">
                                           <div id="qtyExit" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty - Qty > 0 Not Allowed.</div>
                                        <?php }else{ ?>
                                           <input id="qty" name="qty" type="text" class="form-control" placeholder="Qty in kgs" value="<?php echo set_value('qty'); ?>" onInput="checkQty()">
                                         <div id="qtyExit" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
                                        <?php } ?>
                                    
                                        <?php echo form_error('qty');?>
                                    </div>
                                    
                                    <div class="col-md-4">
                                       <label class="form-label">Date</label>
                                       	  <?php $seldate=(!empty($getRMMovement))?$getRMMovement['date']:date('Y-m-d'); ?>
                                       <input id="date" name="date" type="date" class="form-control" placeholder="Date" value="<?php echo set_value('date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>" <?=$readonly;?>>
                                       <?php echo form_error('date');?>
                                    </div>
                                    
                                        <?php if($getRMMovement['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="<?=base_url();?>RMMovement"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?=base_url();?>RMMovement"><button type="button" id="btnCloseCustomer"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
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
     function getMovementRMStock(rmId)
     {
        
        $.ajax({
        url:"<?php echo base_url(); ?>/getMovementRMStock",
        method:"POST",
        data:{rmId:rmId},
        success:function(result)
        {
            console.log(result);
        $("#current_stock").val(Math.round(result,1));
        }
        });
     }
function checkQty(nums)
{
	var quantity    = parseInt($("#qty").val());
	var current_stock     = parseInt($("#current_stock").val());
	
	
    if(current_stock < quantity)
    {
        $("#qtyExit").show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#qtyExit").hide();
    }
       
}
function checkupdateQty(qty){
 //alert(qty);
 if(qty>0){
 //alert("Quantity greater than 0 not allowed");
 $('#qty').val(0);
 $("#qtyExit").show();
 
 }else{
      $("#qtyExit").hide(); 
 }
}
 </script>   

</body>

</html>