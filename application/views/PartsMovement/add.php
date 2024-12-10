<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Parts Movement | Aditya</title>

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
                            <li class="breadcrumb-item active"><a href="<?php echo base_url('PartsMovement');?>">Parts Movement</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                    <h2 class="mb-3"><?=(empty($getPartMovement))?"Add Parts Movement":"Update Parts Movement";?></h2>
                    
                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                          <?php if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success errorMSGtxt" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                       <?php 
                                        if(empty($getPartMovement)){
                                           echo form_open('/createPMovement', array('autocomplete' => 'off','class' => 'row g-3')); 
                                           $readonly="";
                                           $disabled="";
                                        }else{
                                            echo form_open('/updatePMovement', array('autocomplete' => 'off','class' => 'row g-3'));  
                                             $partD =  $this->getQueryModel->getPartsById($getPartMovement['part_id']);
                                             $OPD=  $this->getQueryModel->getOperation($getPartMovement['op_id']);
                                             $readonly="readonly";
                                             $disabled="disabled";
                                             echo '<input type="hidden" name="editID" value="'.$getPartMovement['id'].'">';
                                        }
                                       ?>
                                
                                     <div class="col-md-3">
                                            <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                            <input type="hidden" id="Part_Id1" name="Part_Id" class="form-select Part_Id" value="<?=($getPartMovement['part_id'])?$getPartMovement['part_id']:"";?>">
                                           <div class="autocomplete">
                                              <input type="search" id="Part_Search1" name="Part_Search" class="form-control" value="<?=($partD['name'])?$partD['name']:"";?>" onkeyup="searchPart(this.value,1,'<?=base_url('getPartsBySearch')?>')" <?=$readonly;?>>   
                                              <ul id="searchResult1" class="searchResult"></ul>   
                                           </div>  
                                                
                                        </div>
                                    
                                    <div class="col-md-4">
                                       <label class="form-label">Operation <label class="mandatory">*</label></label>
                                        <select id="Op_Id1" name="Op_Id" class="form-select Op_Id" onChange="getMoveRateDetails(1);" <?=$disabled;?>>
                                        <option selected value="">Choose...</option> 
                                        <?php if($getPartMovement['op_id']){?>
                                             <option selected value="<?=$getPartMovement['op_id'];?>"><?=$OPD['name'];?></option>  
                                       <?php }?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                       <label class="form-label">Max Qty <label class="mandatory">*</label></label>
                                        <input type="text" id="max_qty1" name="max_qty" class="form-control" readonly>
                                    </div>
                                    
                                        <div class="col-md-4">
                                       <label class="form-label">Move To<label class="mandatory">*</label></label>
                                         <?php if(!empty($getPartMovement)){ ?>
                                                        <input type="hidden" name="branch_id" value="<?=$getPartMovement[to_branch_id];?>">
                                                   <?php } ?>
                                            <select id="branch_id" name="branch_id" class="form-select" <?=$disabled;?>>
                                                <option value="">Select Branch</option>
                                                <?php foreach($getBranch as $branch){ ?>                                              
                                                <option value="<?=$branch['id'];?>" <?php if($getPartMovement[to_branch_id]==$branch['id']){ echo "selected";} ?>><?=$branch['name'];?></option>
                                               <?php } ?>

                                            </select>
                                            <?php echo form_error('branch_id');?>
                                    </div>
                                       <div class="col-md-2">
                                       <label class="form-label">Qty in Nos</label>
                                       <?php echo set_value('quantity');?>
                                       <?php if(!empty($getPartMovement)){ ?>
                                            <input id="quantity1" name="quantity" type="text" class="form-control" placeholder="Qty in Nos" value="0" onInput="return checkupdateQty(this.value)">
                                       <?php }else{ ?>
                                           <input id="quantity1" name="quantity" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty in Nos"  value="" onkeyup="calculateQty(this.value,'num',1,'<?=base_url('getPartOperationQty')?>')"  >
                                        <?php } ?>
                                           <div id="qtyExit1" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
                                        <?php echo form_error('quantity');?>
                                    </div>
                                    <div class="col-md-1">
                                           <label class="form-label">Qty In kgs <label class="mandatory">*</label></label>
                                            <?php if(!empty($getPartMovement)){ ?>
                                             <input id="qty_in_kgs1" name="qty_in_kgs" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs" onInput="return checkupdateQty(this.value)" value="0">
                                               <?php }else{ ?>
                                           <input id="qty_in_kgs1" name="qty_in_kgs" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs"  onkeyup="calculateQty(this.value,'kgs',1,'<?=base_url('getPartOperationQty')?>')">
                                       <?php } ?>
                                    </div>
                                 
                                    <?php if(empty($getPartMovement)){ ?>
                                     <div class="col-md-1">
                                        <label class="form-label">Nos/Kg<label class="mandatory">*</label></label>
                                        <input id="part_qty_no1" type="text" class="form-control" readonly>
                                    </div> 
                                      <?php } ?>
                                      
                                    <div class="col-md-3">
                                       <label class="form-label">Date</label>
                                       	  <?php $seldate=(!empty($getPartMovement))?$getPartMovement['date']:date('Y-m-d'); ?>
                                       <input id="date" name="date" type="date" class="form-control" placeholder="Date" value="<?php echo set_value('date',$seldate); ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>" <?=$readonly;?>>
                                       <?php echo form_error('date');?>
                                    </div>
                                    
                                           <div class="col-12">
                                               
                                                <button type="submit" class="btn btn-primary"><?=(empty($getPartMovement))?"Save":"Update";?></button>
                                                <a href="<?php echo base_url('PartsMovement');?>"><button type="button" id="btnCloseCustomer"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        
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
       <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">
 <script>
     function getPartsByProdFamily(Prod_Family_Id)
{
    $.ajax({
      url:"<?php echo base_url(); ?>getPartsByProdFamily",
      method:"POST",
      data:{Prod_Family_Id:Prod_Family_Id},
      success:function(result)
      {
      $("#Part_Id").html(result);
      }
      }); 
}
function getOpByPartId(Part_Id)
{
    $.ajax({
      url:"<?php echo base_url(); ?>getMovementOpByPartId",
      method:"POST",
      data:{Part_Id:Part_Id},
      success:function(result)
      {
          $("#Op_Id1").html(result);
      }
      }); 
}
function getMoveRateDetails(cnt)
{
    //alert("Rateeeeeeeeee");
    var Part_Id     =$("#Part_Id1").val();
    var Op_Id       =$("#Op_Id1").val();
   //alert(Op_Id);
    $.ajax({
      url:"<?php echo base_url(); ?>getMoveRateDetails",
      type:"POST",
      dataType:"json",
      data:{Part_Id:Part_Id,Op_Id:Op_Id},
      success:function(result)
      {
          console.log(result);
          $("#max_qty1").val(result.max_qty);
          }
      }); 
}

function checkupdateQty(qty){
 //alert(qty);
 if(qty>0){
 alert("Quantity greater than 0 not allowed");
 $('#quantity1').val(0);
  $('#qty_in_kgs1').val(0);
 
 }
}
/*function checkQty(nums)
{
	var quantity    = parseInt($("#qty").val());
	var current_stock     = parseInt($("#current_stock").val());
	
	
    if(current_stock < quantity)
    {
        $("#qtyExit1").show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#qtyExit1").hide();
    }
       
}*/
 </script>   

</body>

</html>