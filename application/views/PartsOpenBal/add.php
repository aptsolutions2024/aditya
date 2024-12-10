<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Parts Opening Balance | Aditya</title>

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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('PartsOpeningBal');?>">Parts Opening Balance</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                        
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    
                   
                    <?php $disableselect=""; 
                    if($getPartOpenBal['id']==''){ ?>
                   
                              <h2 class="mb-3">Add Parts Opening Balance</h2>
                    <?php  } else {  
                                $disableselect="disabled"; ?>
                                <h2 class="mb-3">Edit Parts Opening Balance</h2>
                    <?php } ?>


                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php 

                                    // echo "<pre>";print_r($getPartOpenBal); echo "</pre>";

                                if(!empty($_SESSION['dcmsg']))
                                { ?>
                                <div class="col-md-12" style="font-size: 15px;color: #ff0000;margin-bottom: 10px;"><?=$_SESSION['dcmsg'];?></div>

                                 <?php 
                                }
                                ?> 
                               <?php if($getPartOpenBal['id']==''){ ?>
                                      
                                       <?php echo form_open('/createPartsOpenBal', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                               <?php  } else { ?>
                                   
                                       <?php echo form_open('/updatePartsOpenBal', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                        <input type="hidden" name="editId" value="<?=$getPartOpenBal['id'];?>">
                                <?php } ?>
                                     

                                    <div class="col-md-3">

                                       <label class="form-label">Product Family Name <label class="mandatory">*</label></label>
                                                                       
                                        <select id="prod_family" name="prod_family" class="form-select" onchange="getPartsByProdFamily(this.value,1);" <?=$disableselect;?> >
                                        <option  value="">Choose...</option>
                                        <?php
                                         foreach($getProdfamily as $prodf){ ?>
                                        <option  value="<?=$prodf['id'];?>" <?php if($getPartOpenBal['prodfamily_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                        <?php } ?>
                                        </select>
                                        <?php echo form_error('prod_family');?>
                                    </div>
                                    
                                    <div class="col-md-3">
                                       <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                        <select id="Part_Id" name="Part_Id" class="form-select Part_Id" onchange="getOpByPartId(this.value,1);" <?=$disableselect;?>>
                                        <option  value="">Choose...</option> 
                                         <?php if($getPartOpenBal['id']!=''){ ?>
                                         <option  value="<?=$getPartOpenBal['part_id'];?>" selected><?=$getPartOpenBal['partno']." - ".$getPartOpenBal['part_name'];?></option>
                                         <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                       <label class="form-label">Operation <label class="mandatory">*</label></label>
                                        <select id="Op_Id" name="Op_Id" class="form-select Op_Id" onChange="" <?=$disableselect;?>>
                                        <option value="">Choose...</option> 
                                         <?php if($getPartOpenBal['id']!=''){ ?>
                                         <option  value="<?=$getPartOpenBal['op_id'];?>" selected><?=$getPartOpenBal['operation_name'];?></option>
                                         <?php } ?>
                                        </select>
                                    </div>                                   
                                       <div class="col-md-3">
                                       <label class="form-label">Year</label>                                      
                                        <select id="doc_year" name="doc_year" class="form-select" onChange="" <?=$disableselect;?>>
                                          <option value="">Choose...</option>
                                     <?php  $year_array=array('2022 - 23'=>'2022 - 23','2023 - 24'=>'2023 - 24','2024 - 25'=>'2024 - 25','2025 - 26'=>'2025 - 26');
                                     foreach( $year_array as $key => $val ){?>
                                       <option value='<?=$key;?>'<?php if($getPartOpenBal['doc_year']==$key){echo "selected";} ?>><?=$val;?></option>
                                     <?php  }   ?>
                                        </select>
                                         <?php echo form_error('doc_year');?>
                                    </div>                                     
                                    <div class="col-md-4">
                                       <label class="form-label">Opening Balance Qty (Nos)</label>
                                       <?php 
                                        $obqty="";
                                         if($getPartOpenBal['id']!=''){ 
                                            $obqty = $getPartOpenBal['received_qty'];
                                         } else {
                                            $obqty = set_value('obqty');
                                         } ?>
                                       <input id="obqty" name="obqty" type="text" class="form-control" placeholder="Qty in Nos" value="<?php echo $obqty; ?>" onInput="">                                     
                                        <?php echo form_error('obqty');?>
                                    </div>                                  
                                  
                                    
                                   <div class="col-12">
                                     <?php if($getPartOpenBal['id']==''){ ?>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    <?php }else{?>
                                          <button type="submit" class="btn btn-primary">Update</button>
                                     <?php } ?>
                                        <a href="<?=base_url(PartsOpeningBal);?>"><button type="button" id="" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                         
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

          $("#Op_Id").html(result);
      }
      }); 
}


 </script>   

</body>

</html>