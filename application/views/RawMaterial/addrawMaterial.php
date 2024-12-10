<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Raw Material | Aditya</title>

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
                          <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('rawMaterial') ?>">Raw Material</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3">Raw Material</h2>
                    

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
                                        <?php if($getrm['rm_id']==''){
                                            $getrmIds=$getrmId['rm_id']+1;;
                                         ?>
                                        <?php echo form_open('/createRawMaterial', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {
                                        $getrmIds=$getrm['rm_id'];
                                     ?>
                                        <?php echo form_open('/updateRawMaterial', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getrm['rm_id'];?>">
                                    <?php } ?>
                                        
                                        
                                            
                                            <div class="row" style="margin-top: 10px;">                                          
                                            
                                            <div class="col-md-4"  id="rwLength">
                                                <label  class="form-label">Raw Material ID</label>
                                                <input type="text" class="form-control" placeholder="Raw Material ID" value="<?=$getrmIds;?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label  class="form-label">Type<label class="mandatory">*</label></label>
                                                <select id="type" name="type" class="form-select" onchange="generateRWN();">
                                                    <option selected value="">Choose...</option> 
                                                    <option value="MS" <?php if($getrm[type]=='MS') {echo "selected";} ?>>Mild Steel</option>
                                                    <option value="AS" <?php if($getrm[type]=='AS') {echo "selected";} ?>>Alloy Steel</option>
                                                    <option value="SS" <?php if($getrm[type]=='SS') {echo "selected";} ?>>Stainless Steel</option>
                                                        </select>
                                                <?php echo form_error('type');?>
                                            </div>    
                                            <div class="col-md-4">
                                                <label class="form-label">Grade<label class="mandatory">*</label></label>
                                                <input id="grade" name="grade" style="text-transform: uppercase"  type="text" class="form-control" placeholder="Grade" onchange="generateRWN();" value="<?php echo set_value('grade', $getrm[grade]); ?>">
                                            <?php echo form_error('grade');?>
                                            </div> 
                                            </div>
                                            
                                            <div class="row" style="margin-top: 10px;">                                          
                                            
                                            <div class="col-md-4"  id="rwLength">
                                                <label  class="form-label">Length(mm) <label class="mandatory">*</label></label>
                                                <input id="txtLength" name="txtLength" maxlength="6" onkeypress="return isDecimalNumber(event)" onchange="generateRWN();" type="text" class="form-control" placeholder="Length" value="<?php echo set_value('txtLength', $getrm[length]); ?>">
                                            <?php echo form_error('txtLength');?>
                                            </div>

                                            <div class="col-md-4" >
                                                <label class="form-label">Width(mm) <label class="mandatory">*</label></label>
                                                <input id="txtWidth" name="txtWidth" maxlength="6" onkeypress="return isDecimalNumber(event)" onchange="generateRWN();" type="text" class="form-control" placeholder="Width" value="<?php echo set_value('txtWidth', $getrm[width]); ?>">
                                            <?php echo form_error('txtWidth');?>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Thickness(mm)<label class="mandatory">*</label></label>
                                                <input id="txtThickness" name="txtThickness" maxlength="6" onkeypress="return isDecimalNumber(event)" onchange="generateRWN();" type="text" class="form-control" placeholder="Thickness" value="<?php echo set_value('txtThickness', $getrm[thickness]); ?>">
                                            <?php echo form_error('txtThickness');?>
                                            </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                             
                                            <div class="col-md-4">
                                                <label class="form-label">Hardness</label>
                                                <input id="Hardness" name="Hardness" type="text" class="form-control" placeholder="Hardness" value="<?php echo set_value('Hardness', $getrm[hardness]); ?>">
                                            <?php echo form_error('Hardness');?>
                                            </div>   
                                            <div class="col-md-4">
                                                <label  class="form-label">Unit<label class="mandatory">*</label></label>
                                                <select id="txtUnit" name="txtUnit" class="form-select">
                                                    <option selected value="">Choose...</option> 
                                                    <option value="GMS" <?php if($getrm[uom]=='GMS') {echo "selected";} ?>>GMS</option>
                                                    <option value="KGS" <?php if($getrm[uom]=='KGS') {echo "selected";} ?>>KGS</option>
                                                    <option value="NOS" <?php if($getrm[uom]=='NOS') {echo "selected";} ?>>NOS</option>
                                                    <option value="PP" <?php if($getrm[uom]=='PP') {echo "selected";} ?>>PER PIECE</option>
                                                        </select>
                                                <?php echo form_error('txtUnit');?>
                                            </div>
                                              <div class="col-md-4">
                                                <label class="form-label">Bin Quantity<label class="mandatory">*</label></label>
                                                <input id="txtReOrderQuantity" name="txtReOrderQuantity" onkeypress="return isNumberKey(event)" maxlength="6" type="text" class="form-control" placeholder="Re-Order Quantity" value="<?php echo set_value('txtReOrderQuantity', $getrm[reorderQty]); ?>">
                                            <?php echo form_error('txtReOrderQuantity');?>
                                            </div>                                       
                                        </div>
                                       
                                        <div class="row" style="margin-top: 10px;">
                                            
                                            <div class="col-md-4">
                                                <label class="form-label">HSN Code</label>
                                                <input id="txtHSNCode" name="txtHSNCode" maxlength="8" onkeypress="return isNumberKey(event)"  style="text-transform: uppercase"  type="text" class="form-control" placeholder="HSN Code" value="<?php echo set_value('txtHSNCode', $getrm[hsnCode]); ?>">
                                            <?php echo form_error('txtHSNCode');?>
                                            </div>  
                                                                               
                                        </div> 

                                        <div class="row" style="margin-top: 10px;">                                             
                                            <div class="col-md-12">
                                                <label class="form-label">Raw Material Name<label class="mandatory">*</label></label>
                                                <input id="Material_Name" name="Material_Name" style="text-transform: uppercase"  onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Raw material name" value="<?php echo set_value('Material_Name', $getrm[name]); ?>" >
                                            <?php echo form_error('Material_Name');?>
                                            </div>                                           
                                            </div> 
                                       
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-12">
                                                <label class="form-label">Remarks</label>
                                                <textarea id="remarks" name="remarks" type="text" class="form-control" placeholder="Remarks"><?=$getrm[remarks];?></textarea>
                                                
                                            </div>                                       
                                        </div>  
                                        <?php if($getrm['rm_id']==''){ ?>
                                          
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="/rawMaterial"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="/rawMaterial"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 
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

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function NumberAlphaBetDashUnderscoreSpace(e) {
    var keyCode = e.keyCode || e.which;    
    //Regex to allow only Alphabets Numbers Dash Underscore and Space
    var pattern = /^[a-z\d\-_\s]+$/i;
    //Validating the textBox value against our regex pattern.
    var isValid = pattern.test(String.fromCharCode(keyCode));   
    return isValid;
}
function isDecimalNumber(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 46) {
        return true;
    }
    else if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function generateRWN()
{
    var types       =$("#type").val();
    var grades      =$("#grade").val();
    var lengths      =$("#txtLength").val();
    var widths      =$("#txtWidth").val();
    var thicknesss      =$("#txtThickness").val();
    if(types!='')
    {
     var type        =$("#type").val();   
    }else
    {
        var type      ='<?=$getrm[type];?>';
    }if(grades!='')
    {
     var grade       =$("#grade").val();
    }else
    {
        var grade      ='<?=$getrm[grade];?>';
    }
    
    
    if(lengths!='')
    {
     var length      =$("#txtLength").val();
    }else
    {
        var length      ='<?=$getrm[length];?>';
    }
    
    
    if(widths!='')
    {
     var width       =$("#txtWidth").val();
    }else
    {
        var width      ='<?=$getrm[width];?>';
    }
    
    if(thicknesss!='')
    {
     var thickness   =$("#txtThickness").val();
    }else
    {
        var thickness      ='<?=$getrm[thickness];?>';
    }
    
    
    
    
    
    var RName       =type+'-'+grade+'-'+length+' X '+width+' X '+thickness;
    $("#Material_Name").val(RName);
    //alert(RName);
}
</script>
</body>

</html>