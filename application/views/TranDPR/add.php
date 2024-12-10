<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add DPR | Aditya</title>

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
        .totbalqtycl{
            text-align: center;
            margin: 0 auto;
            padding: 1%;
        }
        .toolbalqtySuccess{
           color:green; 
        }
        .toolbalqtyFail{
           color:red; 
        }
        .dprIdClass{
            font-weight: 700;
            font-size: 16px;
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
                           <li class="breadcrumb-item"><a href="<?= base_url(); ?>MangDashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?= base_url(); ?>Tran-DPR">Daily Production Report</a></li>
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->
                    <p class="lead">
                    </p>
                </div>
            </div>
          

            <div class="content__boxed">
                <div class="content__wrap">
                    
                     <?php 
                     if($_GET['Id'] ==''){ ?>
                    <h2 class="mb-3">Add DPR</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Update DPR</h2>
                    <?php } ?>
                    <?php
                       /*  echo "<pre>";  print_r($GetDPRById);   die;*/
                    ?>

                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                       <?php error_reporting(0); if($_SESSION['createS']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createS'];?>
                                        </div>
                                    <?php } ?>
                                        <!-- Block styled form -->
                                        <?php if($GetDPRById[0]['dpr_date']==''){  ?>
                                        <?php echo form_open('/Create-DPR', array('autocomplete' => 'off','class' => 'row g-3'));    ?>
                                    <?php } else {  ?>
                                        <?php echo form_open('/Update-DPR', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } ?>
                                   
                                        <form class="row g-3">
                                         <div class="col-md-3">
                                               <?php   $id = base64_decode($_GET['Id']); if($id != ''){ ?>
                                            Total Entrys - <?= count($GetDPRById); ?>
                                        <?php }  ?>

                                            </div>
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                            <label for="" class="form-label">Select Date : <label class="mandatory">*</label></label>
                                        </div>
                                         <div class="col-md-2"> 
                                         <input type="date" name="txtDate" onchange="datesel(1);"  value="<?=($GetDPRById[0][dpr_date])?$GetDPRById[0][dpr_date]:''; ?>"  class="form-control txtDate" min="<?=getMinDate();?>" max="<?php if(date('Y-m-d')>getMaxDate()){ echo getMaxDate();}else{ echo date('Y-m-d');}?>" <?= (!empty($GetDPRById[0][dpr_date]) ? "readonly" : "" ) ?>  required>
                                         </div>
                                         <div class="col-md-6"></div>
                                         <?php 
                                         if(!empty($GetDPRById)){
                                            $i=1;
                                            $j=90;
                                         foreach ($GetDPRById as $key => $value) {
                                         //print_r($value);
                                         $sum_iss_qty=0;
                                         $SumIssueQty = $this->GetQueryModel->getIssueQtybyDprID($value['id']);
                                         $getProdPlanQty = $this->GetQueryModel->getProdPlanQty($value['prod_plan_id']);
                                         if(!empty($SumIssueQty)){
                                          $sum_iss_qty=$SumIssueQty['issue_qty'];   
                                         }
                                         ?> 
                                          <input type="hidden" name="editId[]" class="editId" value="<?= $value['id']; ?>">
                                         <div style="border: 1px dotted #df5645;margin-top: 15px;"></div>
                                           <div class="col-md-12 dprIdClass dprid<?=$value['id'];?>">
                                             DPR ID -   <?= $value['id']; ?>
                                           </div>
                                        <div class="col-md-3">
                                            <input type="hidden" id="prod_plan_id"  value="<?= $value['prod_plan_id']; ?>"  name="prod_plan_id[]">
                                            <label for="" class="form-label">Select Part<label class="mandatory">*</label></label>
                                           <input type="hidden" class="" name="id[]" value="<?= $value['id']; ?>">
                                           <input type="hidden" class="part_ids<?=$j;?>" name="part_ids[]" value="<?= $value[part_id]."@".$value['prod_plan_id']; ?>">
                                           <?php 
                                                $partid = $this->GetQueryModel->getPartsById($value['part_id']);
                                             
                                           ?>
                                            <select class="form-control parts<?=$j;?>" readonly name="txtpart[]" onchange="editpartsfn()" required>
                                                <option data-partid="<?=$partid['part_id'];?>"  value="<?= $partid['part_id']; ?>"><?=$partid['partno']." - ".$partid['name']." Qty - ".$getProdPlanQty['planning_qty']; ?></option>
                                            </select>
                                        </div>  
                                          <div class="col-md-3">
                                            <label for="" class="form-label">Operations <label class="mandatory">*</label></label>
                                            <?php
                                            
                                            $operationname = $this->GetQueryModel->getOperation($value['operation_id']); 
                                            //echo "<br>Operation ID:".$value['operation_id']."   Operation Name:".$operationname;
                                             ?>
                                          <select class="form-control Operations<?=$j;?>" readonly onchange="operationfn(1)" required name="txtoperations[]">
                                               <option value="<?= $operationname['id']; ?>" <?php if($value['operation_id']==$operationname['id']) echo "selected";?>><?= $operationname['name']; ?></option>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                         <div class="col-md-3">
                                            <label for="" class="form-label">Tools <label class="mandatory">*</label></label>
                                                 <?php $getToolById = $this->GetQueryModel->getToolById($value['tool_id']); 
                                             ?>
                                              <select readonly class="form-control " onchange="txttools2(<?=$j;?>)" required name="txttools[]">
                                                <option value="<?= $getToolById['id']; ?>"><?= $getToolById['name']; ?></option>
                                            </select>
                                            <h6 class="totbalqtycl " id="toolbalqty<?=$j;?>"></h6>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                         <div class="col-md-3">
                                            <label for="" class="form-label">Machine <label class="mandatory">*</label></label>
                                            
                                          <select readonly class="form-control" required name="txtmachines[]">
                                                <option value="">Select Machine</option>
                                                <?php foreach ($Getmachine  as $key => $value5) 
                                                {
                                                     $selected = ($value['machine_id'] == $value5['id']) ? "selected" : "";
                                                    ?>
                                                <option <?= $selected; ?> value="<?= $value5['id']; ?>"><?= $value5['name']; ?></option>
                                                <?php }?>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div> 
                                           <div class="col-md-1">
                                            <label for="" class="form-label">Scrap Used <label class="mandatory">*</label></label>
                                            <input type="hidden" class="form-control" id="txtscrap<?=$j;?>" name="txtscrap[]" value="<?php echo trim($value['scrap_used']);?>">
                                          <select disabled class="form-control" id="txtscrap<?=$j;?>" required name="txtscrap[]">
                                              
                                                <option value="N" <?= ($value[scrap_used] == "N") ? "selected" : "" ?> >NO</option>
                                                <option value="Y" <?= ($value[scrap_used] == "Y") ? "selected" : "" ?>>YES</option>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                          <div class="col-md-2">
                                            <label for="" class="form-label">Operator<label class="mandatory">*</label></label>

                                          <select  readonly class="form-control txtoperator" name="txtoperator[]" required>
                                                <option value="">Select Operator</option>
                                                <?php foreach ($Getusers as $key => $value4) 
                                                {
                                                     $selected = ($value['operator_id'] == $value4['id']) ? "selected" : "";
                                                    ?>
                                                <option <?= $selected; ?> value="<?= $value4['id']; ?>"><?= $value4['fname']; ?></option>
                                                        
                                                <?php } ?>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>                                       
                                        <?php $readonlyqty=($value[qty]>0)?"readonly":"";?>
                                         <div class="col-md-1">
                                            <label for="" class="form-label">Work Hours<label class="mandatory">*</label></label>
                                            <input id="txthours"  name="txthours[]" type="text" maxlength="11" required  style="text-transform: uppercase"   class="form-control" placeholder="Work Hours 00 Hours. 00 minutes" value="<?php if($value['work_hours']!=0) { echo set_value('txthours', $value[work_hours]); } ?>" <?=$readonlyqty;?>>
                                            <?php echo form_error('txthours');?>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">DPR Scrap Qty<label class="mandatory">*</label></label>
                                            <input id="txtScrapQty<?=$j;?>" style="font-size: 14px;" name="txtScrapQty[]" type="number" maxlength="11" readonly  class="form-control" placeholder="Scrap Qty" value="<?php if($value['scrap_dpr_qty']!=0) { echo set_value('txtScrapQty', $value[scrap_dpr_qty]); }?>" <?=$readonlyqty;?>>
                                            <?php echo form_error('txtScrapQty');?>

                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Qty<label class="mandatory">*</label></label>
                                            <input id="txtQty<?=$j;?>" style="font-size: 14px;" name="txtQty[]" onfocus="qtyfn(<?=$j;?>)" onclick="qtyfn(<?=$j;?>)" onkeyup="calculateQty(this.value,'num','<?=$j;?>','<?=base_url('getPartOperationQty')?>')"  type="number" maxlength="11" required  style="text-transform: uppercase"  class="form-control" placeholder="Qty" value="<?php if($value['qty']!=0) { echo set_value('txtQty', $value[qty]); }?>" <?=$readonlyqty;?>>
                                            <?php echo form_error('txtQty');?>

                                        </div>
                                             <div class="col-md-2">
                                            <label for="" class="form-label">Qty in Kgs<label class="mandatory">*</label></label>
                                            <input id="txtQtyInkgs<?=$j;?>" name="txtQtyInkgs[]" style="font-size: 14px;"  type="text" onkeypress="return isDecimalNumber(event)" maxlength="11" onfocus="qtyfn(<?=$j;?>)" onclick="qtyfn(<?=$j;?>)"  onkeyup="calculateQty(this.value,'kgs','<?=$j;?>','<?=base_url('getPartOperationQty')?>')" style="text-transform: uppercase"  class="form-control" placeholder="Qty In kgs" value="<?php echo set_value('txtQtyInkgs', $value['qty_in_kgs']); ?>" <?=$readonlyqty;?>>
                                            <?php echo form_error('txtQtyInkgs');?>
                                        </div>
                                          <div class="col-md-1">
                                            <label class="form-label">Nos/Kg<label class="mandatory">*</label></label>
                                            <input id="part_qty_no<?=$j;?>" type="text" class="form-control" readonly>
                                        </div>

                                         <div class="col-md-1">
                                            <label for="" class="form-label">Max Qty<label class="mandatory">*</label></label>
                                            <input id="txtMaxQty<?=$j;?>"  readonly type="number" maxlength="11"   style="text-transform: uppercase"  class="form-control" placeholder="MaxQty" value="">
                                          
                                        </div>
                                        <?php $j++;?>
                                         <div class="col-md-9">
                                            <label for="" class="form-label">Remark<label class="mandatory"></label></label>
                                            <textarea class="form-control" name="txtremark[]" placeholder="Remark" style="height: 10px;"> <?= (!empty($value)) ? $value[remarks] : "" ?></textarea>
                                        </div>
                                        <?php
                                     
                                        if($value[qty]>0  && $sum_iss_qty==0){ ?>
                                        <div class="col-md-1" align="center" style="margin-top: 39px;">
                                            <a href="javascript:void(0);" onclick="openDelRemModal(<?=$value['id'];?>);">
                                                <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 42px;">
                                            </a>
                                        </div>
                                        
                                        <div class="modal fade" id="delModal<?= $value['id'];?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">DPR ID : <?= $value['id'] ?></h4>
                            
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <div class="col-md-8">
                                                            <label for="" class="form-label">Delete Remark: <label class="mandatory">*</label></label>
                                                            <input id="delete_remark<?= $value['id'] ?>" name="delete_remark<?= $value['id'] ?>" type="text" style="text-transform: uppercase"  class="form-control" placeholder="Delete Remark" value="">
                                                            <input type="hidden" id="prev_remark<?= $value['id'] ?>" name="prev_remark<?= $value['id'] ?>" value="<?= $value['remarks'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" onclick="delRecord(<?= $value['id'] ?>)">Delete</button>
                                                        <button type="button" class="btn btn-info" onclick="clodeDelRemModal(<?= $value['id'] ?>)">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                       <br>
                                        <!-- ---------add-------- -->
                                       

                                    <?php  $i++; } }else{ ?>
                                        <div class="col-md-1">
                                            <label for="" class="form-label">From Schedule</label><br>
                                            <input type="checkbox" class="form-check-input" name="checkboxVal[]" id='fromsched1' value="1" onclick="datesel(1);" checked>
                                        </div>
                                         <div class="col-md-4">
                                            <input type="hidden" id="prod_plan_id"  value="<?= $GetDPRById['prod_plan_id']; ?>"  name="prod_plan_id">
                                            <label for="" class="form-label">Select Part<label class="mandatory">*</label></label>
                                           <input type="hidden" class="part_ids1" name="part_ids[]" value="<?= $GetDPRById[part_id]; ?>">
                                           
                                            <select class="form-control parts1" name="txtpart[]" onchange="partsfn(1)"  required>
                                                <option value=""> Select Part</option>
                                            </select>
                                        </div>  
                                          <div class="col-md-2">
                                            <label for="" class="form-label">Operations <label class="mandatory">*</label></label>
                                            
                                          <select class="form-control Operations1" onfocusout="partsfnss(1)" onchange="operationfn(1)" required name="txtoperations[]">
                                                <option value="">Select Operations</option>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                         <div class="col-md-2">
                                            <label for="" class="form-label">Tools <label class="mandatory">*</label></label>
                 
                                              <select class="form-control txttools1" onchange="txttools2(1)" required name="txttools[]">
                                                <option value="">Select Tools</option>
                                            </select>
                                               <h6 class="totbalqtycl " id="toolbalqty1"></h6>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                         <div class="col-md-3">
                                            <label for="" class="form-label">Machine <label class="mandatory">*</label></label>
                                            
                                          <select class="form-control" required name="txtmachines[]">
                                                <option value="">Select Machine</option>
                                                <?php foreach ($Getmachine  as $key => $value5) 
                                                {
                                                     $selected = ($GetDPRById['machine_id'] == $value5['id']) ? "selected" : "";
                                                    ?>
                                                <option <?= $selected; ?> value="<?= $value5['id']; ?>"><?= $value5['name']; ?></option>
                                                <?php }?>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div> 
                                           <div class="col-md-1">
                                            <label for="" class="form-label">Scrap Used <label class="mandatory">*</label></label>
                                            
                                          <select class="form-control txtscrap1" required name="txtscrap[]" id="txtscrap1">
                                              
                                                <option value="N" <?= ($GetDPRById[scrap_used] == "N") ? "selected" : "" ?> >NO</option>
                                                <option value="Y" <?= ($GetDPRById[scrap_used] == "Y") ? "selected" : "" ?>>YES</option>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>
                                          <div class="col-md-2">
                                            <label for="" class="form-label">Operator<label class="mandatory">*</label></label>

                                          <select class="form-control txtoperator" name="txtoperator[]" required>
                                                <option value="">Select Operator</option>
                                                <?php foreach ($Getusers as $key => $value4) 
                                                {
                                                     $selected = ($GetDPRById['operator_id'] == $value4['id']) ? "selected" : "";
                                                    ?>
                                                <option <?= $selected; ?> value="<?= $value4['id']; ?>"><?= $value4['fname']; ?></option>
                                                        
                                                <?php }?>
                                            </select>
                                             <?php echo form_error('txttype');?>
                                        </div>                                       
                                        
                                         <div class="col-md-1">
                                            <label for="" class="form-label">Work Hours<label class="mandatory">*</label></label>
                                            <input id="txthours"  name="txthours[]" type="text" maxlength="11"   style="text-transform: uppercase"   class="form-control" placeholder="Work Hours 00 Hours. 00 minutes" value="<?php echo set_value('txthours', $GetDPRById[work_hours]); ?>">
                                            <?php echo form_error('txthours');?>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">DPR Scrap Qty<label class="mandatory">*</label></label>
                                            <input id="txtScrapQty" style="font-size: 14px;" name="txtScrapQty[]" type="number" maxlength="11" readonly  class="form-control" placeholder="Scrap Qty" value="<?php if($value['scrap_dpr_qty']!=0) { echo set_value('txtScrapQty', $value[scrap_dpr_qty]); }?>" <?=$readonlyqty;?>>
                                            <?php echo form_error('txtScrapQty');?>
                                            <input type="hidden" id="scrap_ratio" name="scrap_ratio" value="">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Qty<label class="mandatory">*</label></label>
                                            <input id="txtQty1" name="txtQty[]" style="font-size: 14px;"  type="number" maxlength="11" onkeyup="calculateQty(this.value,'num',1,'<?=base_url('getPartOperationQty')?>')"  style="text-transform: uppercase"  class="form-control" placeholder="Qty" value="<?php echo set_value('txtQty', $GetDPRById[qty]); ?>">
                                             <div id="qtyExit1" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Invalid Qty</div>
                                            <?php echo form_error('txtQty');?>
                                        </div>
                                         <div class="col-md-2">
                                            <label for="" class="form-label">Qty in Kgs<label class="mandatory">*</label></label>
                                            <input id="txtQtyInkgs1" name="txtQtyInkgs[]" style="font-size: 14px;"  type="text" maxlength="11" onkeypress="return isDecimalNumber(event)"  onkeyup="calculateQty(this.value,'kgs',1,'<?=base_url('getPartOperationQty')?>')" style="text-transform: uppercase"  class="form-control" placeholder="Qty In kgs" value="<?php echo set_value('txtQtyInkgs', $GetDPRById[qty_in_kgs]); ?>">
                                            <?php echo form_error('txtQtyInkgs');?>
                                        </div>
                                          <div class="col-md-1">
                                            <label class="form-label">Nos/Kg<label class="mandatory">*</label></label>
                                            <input id="part_qty_no1" type="text" class="form-control" readonly>
                                        </div> 
                                         <div class="col-md-1">
                                            <label for="" class="form-label">Max Qty<label class="mandatory">*</label></label>
                                            <input id="txtMaxQty1"  type="text" readonly  class="form-control" placeholder="MaxQty">
                                          
                                        </div>
                                         <div class="col-md-9">
                                            <label for="" class="form-label">Remark<label class="mandatory"></label></label>
                                            <textarea class="form-control" name="txtremark[]" placeholder="Remark" style="height: 10px;"> <?= (!empty($GetDPRById)) ? $GetDPRById[remarks] : "" ?></textarea>
                                        </div>
                                        <!--<div class="col-md-1" align="center" style="margin-top: 39px;">-->
                                        <!--        <a href="javascript:void(0);"  onclick="addDpr(this.form);">-->
                                        <!--        <img src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" style="width: 35px;">-->
                                        <!--        </a>-->
                                        <!--</div>-->
                                    <?php } ?>
                                    <!--<div class="col-md-11" align="center"></div>-->
                                    <div class="col-md-1" align="center" style="margin-top: 39px;">
                                                <a href="javascript:void(0);"  onclick="addDpr(this.form);">
                                                <img src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" style="width: 42px;">
                                                </a>
                                        </div>
                                       
                                                <div id="addDpr1" style="width:99%;"></div>

                                               <div class="col-md-12 modal-footer">
                                            <?php 

                                            $id = base64_decode($_GET['Id']);

                                            if($id == ''){ ?>
                                         
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } else {?>
                                            <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary update_btn">Update</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        <?php } ?>
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
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <!-- <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">

    

    $( document ).ready(function() 
    {
               $('select.parts1').select2();
        var editval = $(".editId").val();
        //datesel(1);
        
          if(editval != 0)
           {
               
                var part_ids1 = $(".part_ids1").val();
                partsfn(part_ids1);
                datesel(1);
       
                partsfnss(1);
              
           }
  // alert(editval);
//   var dprid='<?=$_GET['DPR_ID']?>';
//   if(dprid){
//       document.getElementById('dprid'+dprid).focus()
//   }
  
    });

     function editpartsfn()
    {
      
          var date = new Date($('.txtDate').val());
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var date = [year, month, day].join('-');

                $.ajax({
                    url: "<?= base_url('getProdPart_Id'); ?>",
                    data: {date : date},
                    // dataType: "json",
                    type: "POST",
                    success: function(data)
                    {
                        $(".edit_part").html(data);
                    }
                });
       
    }


 

    function datesel(id)
    {
       $("#toolbalqty"+id).text("");
            $(".txttools"+id).val("");
              $(".Operations"+id).val("");
       var allparts=($('#fromsched'+id).is(':checked'))?"":"getallparts";
     
          var date = new Date($('.txtDate').val());
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var date = [year, month, day].join('-');

                $.ajax({
                    url: "<?= base_url('getProdPart_Id'); ?>",
                    data: {date : date ,allparts : allparts},
                    // dataType: "json",
                    type: "POST",
                    success: function(data)
                    {
                        console.log(data);

                        $(".parts"+id).html(data);
                    }
                });
      
    }


function txttools2(id) 
{
       var date=$(".txtDate").val();
       var toolid=$('.txttools'+id).val();
       if(toolid==25){
           return false;
       }
            console.log("ID-"+id+" Date-"+date+" toolid-"+toolid);
        $.ajax({
                url: "<?= base_url('getToolSucess'); ?>",
                data: {date : date,
                    toolid : toolid
                },
                // dataType: "json",
                type: "POST",
                success: function(data)
                {
                    $("#toolbalqty"+id).text("Tool Bal Qty ( "+data+" )");
                    if(data>0){
                        $("#toolbalqty"+id).removeClass('toolbalqtyFail');
                       $("#toolbalqty"+id).addClass('toolbalqtySuccess');
                    }else{
                         $("#toolbalqty"+id).removeClass('toolbalqtySuccess');
                       $("#toolbalqty"+id).addClass('toolbalqtyFail');
                   }
                }
            });

   // });
}

function editgetMaxQty(varpartid) 
{
    
   
    var op_id =  $(".Operations"+varpartid).val();
    var part_id =  $(".part_ids"+varpartid).val();
    
   
    
    

    $.ajax({
        url: "<?= base_url('getOperbyPartOp'); ?>",
        data: {part_id : part_id,op_id : op_id},
        dataType: "json",
        type: "POST",
        success: function(data)
        {

            $("#txtMaxQty"+varpartid).val(data[0].stock);
        }
    });





}
function partsfnss(varpartid) 
{

    var op_data =  $(".Operations"+varpartid).val();
    var val = op_data.split('@');
      
       var  id = val[0];
       var  stock = parseInt(val[1]);
       var  scrap_normal = val[2];
       var  grossweight = val[3];
       var  scrap_ss = val[4];


       $('#txtMaxQty'+varpartid).val(stock);


}
function partsfn(id) 
{

    var part_id =  $(".parts"+id).val();

    var saa = $(".parts"+id).attr('array');
    
         
    $.ajax({
        url: "<?= base_url('getOperbyPart_Id'); ?>",
        data: {part_id : part_id},
        // dataType: "json",
        type: "POST",
        success: function(data)
        {
            //alert(data);
            console.log(data);
            $(".Operations"+id).html(data);
             $("#toolbalqty"+id).text("");
            $(".txttools"+id).val("");
            $('#txtQty'+id).val(0);
            $('#txtQtyInkgs'+id).val(0);
            $('#part_qty_no'+id).val(0);
             $('#txtMaxQty'+id).val(0);
        }
    });
}
function operationfn(id) 
{
    debugger;
       $("#toolbalqty"+id).text("");
    var part_id      = $(".parts"+id+" option:selected").val();
    var Operations  = $(".Operations"+id+" option:selected").val();
    
    var temp = $(".Operations"+id+" option:selected").val();;
    var count = (temp.match(/@/g) || []).length;
    
    $('#scrap_ratio'+id).val($(".Operations"+id+" option:selected").data('scrap-ratio'));
    if(count > 1)
    {
        $(".txtscrap"+id).prop('disabled', false);
        $(".txtscrap"+id).val("N");
    }else{
        $(".txtscrap"+id).prop('disabled', true);
        $(".txtscrap"+id).val("N");
    }
    
            $.ajax({
                url: "<?= base_url('getToolbyPartOperation'); ?>",
                data: {part_id : part_id,Op_id : Operations},
               
                type: "POST",
                success: function(data)
                {
                    $(".txttools"+id).html(data);
                    txttools2(id);
                }
            });
            $('#txtQty'+id).val(0);
            $('#txtQtyInkgs'+id).val(0);
            $('#part_qty_no'+id).val(0);
             $('#txtMaxQty'+id).val(0);
             
}
/*$('.Operations1').change(function() {
  

     var prod_plan_id = ($('.parts1').find(':selected').data('id'));
     $('#txtQty1').val(0);
     $('#txtMaxQty1').val(0);

     $('#prod_plan_id').val(prod_plan_id);
});*/



var rowCount2 = 2;
    function addDpr(frm) {
        if(rowCount2>=90){
            return false;
        }
       
         var qtybaseurl=" '<?=base_url()?>getPartOperationQty' ";  
        var qtyinkgs=" 'kgs' ";
        var qtyinnum=" 'num' ";
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div style="border: 1px dotted #df5645;margin-top: 15px;"></div><br><div class="row">'+
        '<div class="col-md-1">'+
        '<label for="" class="form-label">From Schedule</label><br>'+
        '<input type="checkbox" class="form-check-input" name="checkboxVal[]" id="fromsched'+rowCount2+'" value="1" onclick="datesel('+rowCount2+');" checked>'+
        '</div>'+
        '<div class="col-md-4"><label for="" class="form-label">Select Part<label class="mandatory">*</label></label><input type="hidden" class="part_ids'+rowCount2+'" name="part_ids[]" value="<?= $GetDPRById[part_id]; ?>"><select class="form-control parts'+rowCount2+'" name="txtpart[]" onchange="partsfn('+rowCount2+')" required><option value=""> Select Part</option></select></div> <div class="col-md-2"><label for="" class="form-label">Operations <label class="mandatory">*</label></label><select class="form-control Operations'+rowCount2+'" onfocusout="partsfnss('+rowCount2+')" onchange="operationfn('+rowCount2+')"  name="txtoperations[]" required><option value="">Select Operations</option></select><?php echo form_error('txttype');?></div>  <div class="col-md-2"><label for="" class="form-label">Tools <label class="mandatory">*</label></label> <select class="form-control txttools'+rowCount2+'" onchange="txttools2('+rowCount2+')" name="txttools[]"> <option value="">Select Tools</option></select><h6 class="totbalqtycl " id="toolbalqty'+rowCount2+'"></h6><?php echo form_error('txttype');?>
</div> <div class="col-md-3"><label for="" class="form-label">Machine <label class="mandatory">*</label></label><select class="form-control" required name="txtmachines[]"> <option value="">Select Machine</option><?php foreach ($Getmachine  as $key => $value5) 
{
$selected = ($GetDPRById['machine_id'] == $value5['id']) ? "selected" : "";
?>
<option <?= $selected; ?> value="<?= $value5['id']; ?>"><?= $value5['name']; ?></option><?php }?>
</select><?php echo form_error('txttype');?>
</div><div class="col-md-1"><label for="" class="form-label">Scrap Used <label class="mandatory">*</label></label><select class="form-control txtscrap'+rowCount2+'" required name="txtscrap[]" id="txtscrap'+rowCount2+'"><option value="N" <?= ($GetDPRById[scrap_used] == "N") ? "selected" : "" ?> >No</option><option value="Y" <?= ($GetDPRById[scrap_used] == "Y") ? "selected" : "" ?>>YES</option></select><?php echo form_error('txttype');?></div><div class="col-md-2"><label for="" class="form-label">Operator<label class="mandatory">*</label></label><select class="form-control txtoperator" name="txtoperator[]" required><option value="">Select Operator</option><?php foreach ($Getusers as $key => $value4) 
{
     $selected = ($GetDPRById['operator_id'] == $value4['id']) ? "selected" : "";
?>
<option <?= $selected; ?> value="<?= $value4['id']; ?>"><?= $value4['fname']; ?></option><?php }?>
</select><?php echo form_error('txttype');?>
</div><div class="col-md-1"><label for="" class="form-label">Work Hours<label class="mandatory">*</label></label><input id="txthours"  name="txthours[]" type="text" maxlength="11"   style="text-transform: uppercase"   class="form-control" placeholder="Work Hours 00 Hours. 00 minutes" value="<?php echo set_value('txthours', $GetDPRById[work_hours]); ?>"><?php echo form_error('txthours');?></div><div class="col-md-2"><label for="" class="form-label">DPR Scrap Qty<label class="mandatory">*</label></label><input id="txtScrapQty'+rowCount2+'" style="font-size: 14px;" readonly name="txtScrapQty[]"  type="number" maxlength="11" style="text-transform: uppercase" class="form-control" placeholder="Scrap Qty" value="<?php echo set_value('txtScrapQty', $GetDPRById[scrap_dpr_qty]); ?>"><input type="hidden"  id="scrap_ratio'+rowCount2+'" name="scrap_ratio'+rowCount2+'"></div><div class="col-md-2"><label for="" class="form-label">Qty<label class="mandatory">*</label></label><input id="txtQty'+rowCount2+'" onkeyup="calculateQty(this.value,'+qtyinnum+','+rowCount2+','+qtybaseurl+')" style="font-size: 14px;"  name="txtQty[]"  type="number" maxlength="11"   style="text-transform: uppercase"   class="form-control" placeholder="Qty" value="<?php echo set_value('txtQty', $GetDPRById[qty]); ?>"><div id="qtyExit'+rowCount2+'" style="display:none;font-size: 13px;text-align: center;color: red;margin-top: 5px;">Invalid Qty</div><?php echo form_error('txtQty');?>
</div><div class="col-md-2"><label for="" class="form-label">Qty in Kgs<label class="mandatory">*</label></label><input id="txtQtyInkgs'+rowCount2+'" name="txtQtyInkgs[]" style="font-size: 14px;"  type="text" maxlength="11" onkeypress="return isDecimalNumber(event)" onkeyup="calculateQty(this.value,'+qtyinkgs+','+rowCount2+','+qtybaseurl+')" style="text-transform: uppercase"  class="form-control" placeholder="Qty In kgs" value="<?php echo set_value('txtQtyInkgs', $GetDPRById[qty_in_kgs]); ?>"><?php echo form_error('txtQtyInkgs');?></div><div class="col-md-1"><label class="form-label">Nos/Kg<label class="mandatory">*</label></label><input id="part_qty_no'+rowCount2+'" type="text" class="form-control" readonly></div><div class="col-md-1"><label for="" class="form-label">Max Qty<label class="mandatory">*</label></label><input id="txtMaxQty'+rowCount2+'"  readonly type="number" maxlength="11"   style="text-transform: uppercase"  class="form-control" placeholder="MaxQty" value=""></div> <div class="col-md-9"><label for="" class="form-label">Remark<label class="mandatory"></label></label><textarea class="form-control" name="txtremark[]" placeholder="Remark" style="height: 10px;"> <?= (!empty($GetDPRById)) ? $GetDPRById[remarks] : "" ?></textarea></div><div class="col-md-1" align="center" style="margin-top: 32px;"><a href="javascript:void(0);" onclick="removeRow1('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove" style="width: 30px;"></a></div> </div>';
        jQuery('#addDpr1').append(recRow);
         datesel(rowCount2);
  $('select.parts'+rowCount2).select2();
        rowCount2 ++;
    }
     function removeRow1(removeNum) {
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }


function CloseCustomer(removeNum) 
{
        location.href = 'Tran-DPR';
} 
    
function calculateQty(current_qty,type,rowid,baseurl){
//var Part_Id=$("select.parts"+rowid).attr('data-partid');
var Part_Id=$("select.parts"+rowid+" option:selected").attr("data-partid");
var Op_Id=$("select.Operations"+rowid).val();

if(Part_Id && Op_Id && Op_Id!=0 && Part_Id!=""){
         
            
    $('#part_qty_no'+rowid).val('');
    if(type == 'num'){
          $("#qty_in_kgs"+rowid).val('');
    }else{
        $("#txtQty"+rowid).val(''); 
    }
       $('#part_qty_no'+rowid).val('');
//alert("Type :: "+type);
    if(current_qty!=''){
         $.ajax({
           url:baseurl,
           method:"POST",
           data:{Part_Id:Part_Id,Op_Id:Op_Id},
           success:function(result)
           {
            console.log("Op_Id:"+Op_Id+" Part_Id:"+Part_Id +"  Part QTY:-"+result);
                   var part_operation_qty=result;  
                      if(part_operation_qty == '' || part_operation_qty == '0'){
                         part_operation_qty=1;   
                        }
                    $('#part_qty_no'+rowid).val(part_operation_qty);
                    if(part_operation_qty){
                       
                      
                        if(type == 'num'){
                           
                            //Show kgs per quantity
                             var kgs = (current_qty/part_operation_qty);
                            $("#txtQtyInkgs"+rowid).val(kgs.toFixed(2)); 
                           checkQty(rowid,current_qty); 
                        }else{ 
                         
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=(part_operation_qty*current_qty);      
                            $("#txtQty"+rowid).val(Math.round(quantity)); 
                              checkQty(rowid,quantity); 
                              qtyfn(rowid);
                           }
                          
                        }
                          
                    }else{
                       $("#txtQtyInkgs"+rowid).val('');$("#txtQty"+rowid).val('');                          
                    }
           

           }
           });
    }
    
    
}else{
       $('#txtQty'+rowid).val(0);
            $('#txtQtyInkgs'+rowid).val(0);
    alert("PLease Select Part/Operation..");
   return false; 
}

  
}    
    
function checkQty(nums,quantity)
{    $("#qtyExit"+nums).hide();
    //alert("quantity"+quantity);
    //var quantity = parseInt($("#quantity"+nums).val());
    var max_qty = parseInt($("#txtMaxQty"+nums).val());
    var scrap_id      = $("#txtscrap"+nums).val();
      if(scrap_id == 'Y')
            {
                return false;
            }
    if(max_qty < quantity)
    {
        alert("Invalid Quantity.");
        $("#qtyExit"+nums).show();
        $("#txtQty"+nums).val(0);
        $("#txtQtyInkgs"+nums).val(0);
        
    }else
    {
        $("#qtyExit"+nums).hide();
    }
       
}
    // $('#txtQty').focusout('change', function()
    function qtyfn(num) 
    { 
  
         var op_id =  $(".Operations"+num).val();
         var part_id =  $(".part_ids"+num).val();
console.log(op_id+"  Part ID"+part_id);
    $.ajax({
        url: "<?= base_url('getOperbyPartOp'); ?>",
        data: {part_id : part_id,op_id : op_id},
        dataType: "json",
        type: "POST",
        success: function(data)
        {
            console.log(data);
            
             $("#txtMaxQty"+num).val(data.stock);
           
        }
    });
    
        var txtQty = parseInt($("#txtQty"+num).val());
        var txtMaxQty = parseInt($("#txtMaxQty"+num).val());
        var scrap_id      = $("#txtscrap"+num).val();


         if(txtQty != "" && txtMaxQty != "")
         {
       console.log("SCRAP:"+scrap_id);
            if(scrap_id == 'N')
            {
                    
                if(txtQty > txtMaxQty)
                {
                    alert("Invalid Qty.");
                    $("#txtQty"+num).val(0);
                    $("#txtQtyInkgs"+num).val(0);
                }    
            }
         }
       

    }
    function openDelRemModal(id){
        $('#delModal'+id).modal('show');
    }
    function clodeDelRemModal(id){
        $('#delModal'+id).modal('hide');
    }
    function delRecord(id){
        var delete_remark = $('#delete_remark'+id).val();
        var prev_remark = $('#prev_remark'+id).val();
        if(delete_remark!=''){
            if (confirm("Are you sure?")) {
               $.ajax({
                url: "<?= base_url('deleteDPR'); ?>",
                method:"POST",
                data: {
                    id : id,
                    delete_remark:delete_remark,
                    prev_remark:prev_remark
                },
                type: "POST",
                success: function(data){
                    alert("Record deleted Successfully");
                    location.reload();
                }
            });
        }
        }else{
           alert("Please provide remark before delete DPR entry");
           $('#delete_remark'+id).focus();
       }
    return false;
     
 }

</script>
</sript>
</body>

</body>

</html>