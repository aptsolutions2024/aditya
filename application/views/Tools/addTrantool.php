<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add/Update Tool | Aditya</title>

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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container .select2-selection--single{
    display: block;
    width: 100%;
   padding: 1.1rem 1rem;
    font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.07);
    appearance: none;
    border-radius: 0.4375rem;
    box-shadow: inset 0 1px 2px rgb(55 60 67 / 8%);
    transition: border-color .35s ease-in-out,box-shadow .35s ease-in-out;
        border: 1px solid rgb(55 60 67 / 25%);
 }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: .75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #75868f;
    line-height: 11px !important;
    text-transform:uppercase !important;
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
            <div class="content__header content__boxed rounded-0">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('Trantool');?>">Tran tool</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">

                    <h2 class="mb-3"><?php if(!empty($getToollife['id'])){ echo "Update Tran Tool ";}else{ echo "Add Tran Tool";} ?></h2>
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
                                        <!-- Block styled form -->
                                        <?php 
                                        if($getToollife['id']==''){ ?>
                                        <?php echo form_open('/createTrantool', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else { ?>
                                        <?php echo form_open('/updateTrantool', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getToollife['id'];?>">
                                    <?php } ?>


                                   <div class="row" >
                                        <div class="col-md-4" >
                                            <label class="form-label">Tool Name <label class="mandatory">*</label></label>
                                               <select class="form-select" name="Tool_Name" id="Tool_Name">
                                                    <option value="">Select Tools</option>
                                                  <?php //print_r($getTools);
                                                  foreach($getTools as $tool){ ?>
                                                       <option value="<?=$tool['id'];?>" <?php if($getToollife['tool_id']==$tool['id']){ echo "selected"; }?>><?=$tool['name'];?></option>
                                                  <?php  }?> 
                                               </select>
                                                <?php echo form_error('Tool_Name');?>
                                        </div>
                                  <div class="col-md-4" >
                                            <label class="form-label">Type<label class="mandatory">*</label></label>
                                               <select class="form-control" name="type" id="type" onChange="changeDateTitle(this.value);">
                                                    <option value="">Select Type</option>
                                                    <option value="G" <?php if($getToollife['type']=='G'){ echo "selected"; }?>>Grinding</option>
                                                    <option value="M" <?php if($getToollife['type']=='M'){ echo "selected"; }?>>Maintenance</option>
                                                    <option value="I" <?php if($getToollife['type']=='I'){ echo "selected"; }?>>Inspection</option>
                                               </select>
                                                 <?php echo form_error('type');?>
                                        </div>

                                        <div class="col-md-2">
                                            <label  class="form-label"><span id="typetxt">Date</span> </label>
                                            <?php 
                                          
                                            $gdate=($getToollife['id']=='')?date('Y-m-d'):$getToollife['grinded_on'];?>
                                            <input name="grinded_on" type="date" class="form-control" value="<?php echo set_value('grinded_on',$gdate) ?>" min="<?php echo getMinDate();?>" max="<?php echo getMaxDate();?>">
                                            <?php echo form_error('grinded_on');?>
                                        </div>
        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="form-label">Remark </label>
                                            <textarea name="remark" class="form-control" placeholder="Remark"><?php echo set_value('remark', $getToollife['remark']); ?></textarea>
                                           
                                        </div>

                                        
                                         
                                        <?php if($getToollife['id']==''){ ?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <a href="<?php echo base_url('Trantool');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

                                            </div>
                                        <?php } else {?>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                                <a href="<?php echo base_url('Trantool');?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>

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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $( document ).ready(function() 
    {
               $('select#Tool_Name').select2();
      
    });
        function changeDateTitle(type){
          if(type=='G'){
              $("span#typetxt").text("Grinded On");
          }else if(type=='M'){
               $("span#typetxt").text("Maintenance Date");
          }else{
               $("span#typetxt").text("Date");
          }
        }
    </script>
</body>

</html>