<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
      <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
      <title>Part | Aditya</title>
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
   <style>
      .imageDiv{
   margin-top: 20px;
      }
      .imageDiv img{
       width: 35px;
      }
   </style>
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('parts') ?>">Part</a></li>
                     </ol>
                  </nav>
                  <!-- END : Breadcrumb -->
                  <p class="lead">
                  </p>
               </div>
            </div>
            <div class="content__boxed">
               <div class="content__wrap">
                    <?php if($getparts['part_id']==''){ ?>
                   
                  <h2 class="mb-3">Add Part</h2>
                  <?php  } else { ?>
                  <h2 class="mb-3">Edit  Part</h2>
                  <?php } ?>
                  <section>
                     <div class="row">
                        <div class="col-md-12 mb-6">
                           <div class="card h-100">
                              <div class="card-body">
                                 <?php error_reporting(0); if($_SESSION['createP']!='') {?>
                                 <div class="alert alert-success" role="alert">
                                    <?=$_SESSION['createP'];?>
                                 </div>
                                 <?php } ?>
                                 <!-- Block styled form -->
                                 <?php if($getparts['part_id']==''){ ?>
                                 <?php echo form_open('/createPart', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                 <?php } else { ?>
                                 <?php echo form_open('/updatePart', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                 <div id="deleteRPCid"></div>
                                 <input type="hidden" name="editId" value="<?=$getparts['part_id'];?>">
                                 <input type="hidden" name="cust_name" value="0">
                                 <?php } ?>
                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-6">
                                       <label class="form-label">Product Family Name<label class="mandatory">*</label></label>
                                       <?php $pf= set_value('prod_family'); ?>
                                       <select id="prod_family" name="prod_family" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php foreach($getProdfamily as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($pf==$prodf['id']){echo "selected";} ?> <?php if($getparts['prodfamily_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('prod_family');?>
                                    </div>
                                   <!-- <div class="col-md-6">
                                       <label class="form-label">Customer Name<label class="mandatory">*</label></label>
                                       <?php $cn= set_value('cust_name'); ?>
                                       <select id="cust_name" name="cust_name" class="form-select">
                                          <option  value="">Choose...</option>
                                          <?php foreach($getCustName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($cn==$prodf['id']){echo "selected";} ?> <?php if($getparts['customer_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('cust_name');?>
                                    </div>-->
                                 </div>


                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-2">
                                       <label class="form-label">Part ID</label>
                                       <input  type="text" class="form-control"  value="<?php echo $getparts['part_id'];?>" readonly>
                                    
                                    </div>
                                    <div class="col-md-5">
                                       <label class="form-label">Part No.<label class="mandatory">*</label></label>
                                       <input id="part_no" name="part_no" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event)"  type="text" class="form-control" placeholder="Part No." value="<?php echo set_value('part_no', $getparts[partno]); ?>">
                                       <?php echo form_error('part_no');?>
                                    </div>
                                     <div class="col-md-5">
                                       <label class="form-label">Part Name</label>
                                       <input id="part_name" name="part_name" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Part Name" value="<?php echo set_value('part_name', $getparts[name]); ?>">
                                       <?php echo form_error('part_name');?>
                                    </div>
                                 </div>


                                 <div class="row" style="margin-top: 10px;">
                                    
                                       <div class="col-md-6">
                                       <label class="form-label">Bin Quantity<label class="mandatory">*</label></label>
                                       <input id="bin_qty" name="bin_qty" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Bin Quantity" value="<?php echo set_value('bin_qty', $getparts[bin_qty]); ?>">
                                       <?php echo form_error('bin_qty');?>
                                    </div>
                                    <div class="col-md-6">
                                       <label  class="form-label">Unit<label class="mandatory">*</label></label>
                                       <?php $un= set_value('txtUnit'); 
                                       $uom=$getparts['uom'];
                                       if($uom!='')
                                       {
                                          $selected='';
                                       }else{
                                          $selected='selected';
                                       }
                                       ?>
                                       <select id="txtUnit" name="txtUnit" class="form-select">
                                          <option  value="">Choose...</option>
                                          <option value="GMS" <?php if($getparts[uom]=='GMS') {echo "selected";} ?> <?php if($un=='GMS'){echo "selected";} ?>>GMS</option>
                                          <option value="KGS" <?php if($getparts[uom]=='KGS') {echo "selected";} ?> <?php if($un=='KGS'){echo "selected";} ?>>KGS</option>
                                          <option value="NOS" <?php if($getparts[uom]=='NOS') {echo "selected";} ?>  <?php if($un=='NOS'){echo "selected";} ?> <?=$selected;?> >NOS</option>
                                          <option value="PP" <?php if($getparts[uom]=='PP') {echo "selected";} ?>  <?php if($un=='PP'){echo "selected";} ?> <?=$selected;?> >PER PIECE</option>
                                         
                                       </select>
                                       <?php echo form_error('txtUnit');?>
                                    </div>
                                 </div>


                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-4">
                                       <label class="form-label">Net Weight (Gms)<label class="mandatory">*</label></label>
                                       <input id="net_weight" name="net_weight" onkeypress="return isDecimalNumber(event)" type="text" class="form-control" placeholder="Net Weight" value="<?php echo set_value('net_weight', $getparts[netweight]); ?>" onchange="showScrapAll();">
                                       <?php echo form_error('net_weight');?>
                                    </div>
                                    <div class="col-md-4">
                                       <label class="form-label">HSN Code<label class="mandatory">*</label></label>
                                       <input id="txtHSNCode" name="txtHSNCode" onkeypress="return isDecimalNumber(event)" type="text" class="form-control" placeholder="HSN Code" value="<?php echo set_value('txtHSNCode', $getparts[hsncode]); ?>">
                                       <?php echo form_error('txtHSNCode');?>
                                    </div>
                                    <div class="col-md-4">
                                       <label class="form-label">IS Assembly</label>
                                       <select id="is_assembly" name="is_assembly" class="form-select" onchange="showPartsRawM(this.value);">
                                          <option selected value="0" <?php if($getparts[is_assembly]=='0') {echo "selected";} ?> >No</option>
                                          <option  value="1" <?php if($getparts[is_assembly]=='1') {echo "selected";} ?>>YES</option>
                                          
                                       </select>
                                       
                                    </div>
                                 </div>

                                 <div id="RawMDiv" <?php if($getparts['is_assembly']==1) {echo "style='display:none;'";} ?>>
                                 <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <h3>Required Raw Material</h3>

                        <?php 
                           $rmrow=1;
                              //  print_r($getrawMaterialById); 
                                if(!empty($getrawMaterialById))
                                {
                                 
                                    foreach ($getrawMaterialById as $key => $value) 
                                    {
                                       
                                        $rmid             = $value['rm_id'];
                                        $id              = $value['id'];
                                        $is_tikli_reusable  = $value['is_tikli_reusable'];
                                        $grossweight        = $value['grossweight'];
                                        $assemblyPartId     = $value['assembly_part_id'];
                                        $assemblyPartQty    = $value['assembly_part_qty'];
                                        $scrapNormal        = $value['scrap_normal'];
                                        $scrapss         = $value['scrap_ss'];
                                        $scrapTikli      = $value['scrap_tikli'];

                                       $rmDetails= $this->getQueryModel->getrmById($value['rm_id']);
                                        $rmselectedName = $value['rm_id'].'@'.$rmDetails['name'];
                                          if($rmid!=''){
                        ?>
                        <div class="row" style="margin-top: 10px;">
                             <input type="hidden" name="editRMID[]" value="<?=$id;?>">
                                    <div class="col-md-3">
                                       <label class="form-label">Raw Material<label class="mandatory">*</label></label>
                                        <?php $rm= set_value('raw_material'); ?>
                                       <select id="raw_material<?=$rmrow;?>" name="edit_raw_material[]" class="form-select" onchange="showScrap(<?=$rmrow;?>);">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getrawMaterial as $prodf){
                                             $NameId=$prodf['rm_id'].'@'.$prodf['name'];
                                           ?>
                                          <option <?php if($rmselectedName==$NameId){echo 'selected';} ?>  value="<?=$NameId;?>" ><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       
                                    </div>
                                    
                                    <div class="col-md-3">
                                       <label class="form-label">Gross Wt (Gms)<label class="mandatory">*</label></label>
                                       <input id="gross_weight<?=$rmrow;?>" name="edit_gross_weight[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Gross Weight" value="<?=$grossweight; ?>" onInput="showScrap('<?=$rmrow;?>')">
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Scrap Normal (Gms)</label>
                                       <input id="scrap_normal<?=$rmrow;?>" name="edit_scrap_normal[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap Normal" value="<?=$scrapNormal; ?>" readonly>
                                       
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Scrap SS (Gms)</label>
                                       <input id="scrap_ss<?=$rmrow;?>" name="edit_scrap_ss[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap SS" value="<?=$scrapss; ?>" readonly>
                                       
                                    </div>
                           
                                 </div>
                        <?php $rmrow++;
                           } //if
                          }//foreach
                        } ?>
                     
                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Raw Material<label class="mandatory">*</label></label>
                                        <?php $rm= set_value('raw_material'); ?>
                                       <select id="raw_material<?=$rmrow;?>" name="raw_material[]" class="form-select" onInput="showScrap('<?=$rmrow;?>');">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getrawMaterial as $prodf){ 
                                             $NameId=$prodf['rm_id'].'@'.$prodf['name'];
                                             ?>
                                          <option <?php if($rm==$NameId){echo 'selected';} ?>  value="<?=$NameId;?>" ><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('raw_material');?>
                                    </div>

                                    

                                    <div class="col-md-3">
                                       <label class="form-label">Gross Wt (Gms)<label class="mandatory">*</label></label>
                                       <input id="gross_weight<?=$rmrow;?>" name="gross_weight[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Gross Weight"  onInput="showScrap('<?=$rmrow;?>')">
                                       <?php echo form_error('gross_weight');?>
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Scrap Normal (Gms)</label>
                                       <input id="scrap_normal<?=$rmrow;?>" name="scrap_normal[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap Normal" readonly>
                                       
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Scrap SS (Gms)</label>
                                       <input id="scrap_ss<?=$rmrow;?>" name="scrap_ss[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap SS" readonly>
                                       
                                    </div>
                                    
                                    <!--<div class="col-md-1 imageDiv">-->
                                    <!--   <a href="javascript:void(0);" onclick="addPartRawM(this.form);" >-->
                                    <!--   <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add">-->
                                    <!--   </a>-->
                                    <!--</div>-->
                                 </div>


                                 <div id="addPartRawM1" style="width: 99%;"></div>
                             </div>


                                 <div id="PartDiv" <?php if($getparts[is_assembly]=='0') {echo "style='display:none;'";} ?>>
                                 <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <br>
                                 <h3>Required Parts</h3>
                        <?php 
                                if(!empty($getrawMaterialById))
                                {
                                    foreach ($getrawMaterialById as $key => $value) 
                                    { 
                           $assemblyPartId     = $value['assembly_part_id'];
                                    $assemblyPartQty    = $value['assembly_part_qty'];
                           if($assemblyPartId!=''){
                           ?>
                           <input type="hidden" name="editPatID[]" value="<?=$value['id'];?>">
                           <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Part Name<label class="mandatory">*</label></label>
                                       <?php $pid= set_value('part_id'); ?>
                                       <select id="part_id" name="edit_part_id[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getPartName as $prodf){ ?>
                                          <option  value="<?=$prodf['part_id'];?>" <?php if($assemblyPartId==$prodf['part_id']){echo "selected";} ?>><?=$prodf['partno'].' '.$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Quantity (Nos)<label class="mandatory">*</label></label>
                                       <input id="quantity" name="edit_quantity[]" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Quantity" value="<?=$assemblyPartQty;?>">
                                    </div>
                           
                                 </div>
                         
                           
                        <?php }}} ?>

                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Part Name<label class="mandatory">*</label></label>
                                       <?php $pid= set_value('part_id'); ?>
                                       <select id="part_id" name="part_id[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getPartName as $prodf){ ?>
                                          <option  value="<?=$prodf['part_id'];?>" <?php if($pid==$prodf['part_id']){echo "selected";} ?>><?=$prodf['partno'].' '.$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('part_id');?>
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Quantity (Nos)<label class="mandatory">*</label></label>
                                       <input id="quantity" name="quantity[]" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Quantity" value="<?php echo set_value('quantity', $getparts[quantity]); ?>">
                                       <?php echo form_error('quantity');?>
                                    </div>
                                    
                                    <div class="col-md-1 imageDiv">
                                       <a href="javascript:void(0);" onclick="addOtherParts(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add">
                                       </a>
                                    </div>
                                 </div>


                                 <div id="addOtherParts1" style="width: 99%;"></div>

                                 </div>



                                 <!--

                                 <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <h3>Operations</h3>
                         <?php 
                                if(!empty($getOperationById))
                                {
                                    foreach ($getOperationById as $key => $value) 
                                    { ?>
                           <input type="hidden" name="editOperID[]" value="<?=$value['id'];?>">
                           <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Sequence Nos<label class="mandatory">*</label></label>
                                      
                                       <input id="sequence_nos" name="edit_sequence_nos[]" maxlength="2" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="number" class="form-control" placeholder="Sequence Nos" value="<?=$value['sequence_no'];?>">
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Operation Name<label class="mandatory">*</label></label>
                                        <?php $opn= set_value('operation_name'); ?>
                                       <select id="operation_name" name="edit_operation_name[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getOperationName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($value['op_id']==$prodf['id']){echo "selected";} ?>><?=$prodf['Name'];?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                           
                                 </div>
                           
                        <?php } } ?>



                                 
                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Sequence Nos<label class="mandatory">*</label></label>
                                      
                                       <input id="sequence_nos" name="sequence_nos[]" maxlength="2" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="number" class="form-control" placeholder="Sequence Nos" value="<?php echo set_value('sequence_nos', $getparts[sequence_nos]); ?>">
                                       <?php echo form_error('sequence_nos');?>
                                    </div>
                                    <div class="col-md-3">
                                       <label class="form-label">Operation Name<label class="mandatory">*</label></label>
                                        <?php $opn= set_value('operation_name'); ?>
                                       <select id="operation_name" name="operation_name[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getOperationName as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($opn==$prodf['id']){echo "selected";} ?>><?=$prodf['Name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('operation_name');?>
                                    </div>
                                    
                                    <div class="col-md-1" style="margin-top: 25px;">
                                       <a href="javascript:void(0);" onclick="addOperations(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add" style="width: 35px;">
                                       </a>
                                    </div>
                                 </div>


                                 <div id="addOperations1" style="width: 99%;"></div>

                              -->


                                 <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <h3>Operations </h3>

                                 <div class="row mb-3">
                              
                              <div class="col-sm-4">
                                  <label for="cylinderRetL" class=" col-form-label">Operation Name</label>
                                 <select multiple size="15" class="form-control list" data-target="avaliable" name="operation_id" id="operation_id" style="height: 160px;">
                                 </select>
                              </div>
                              <div class="col-sm-1">
                              <br>  <br>
                                 <button type="button" id="moveall" class="btn btn-outline-info">>></button><br>
                                 <button type="button" id="moveone" class="btn btn-outline-secondary" style="width: 44px;">></button><br>
                              
                                 <button type="button" id="removeone" class="btn btn-outline-secondary" style="width: 44px;"><</button><br>
                                 <button type="button" id="removeall" class="btn btn-outline-danger"><<</button><br>
                              </div>
                              <div class="col-sm-4">
                                  <label for="cylinderRetL" class=" col-form-label">Operation Name</label>
                                 <select multiple size="15" class="form-control list" data-target="avaliable" name="operation_name[]" id="operationName" style="height: 160px;">
                                 </select>



                              </div>
                              <div class="col-md-3 col-sm-3" align="center">

                                 <br><br>
                                 <div style="font-size: 14px;color: #ff0000bd;">For Sequence adjustment use these arrows!</div>

                              <button type="button" id="upone" value="Up" class="btn btn-outline-secondary" style="width: 44px;">⇧</button><br>

                              <button type="button" id="downone" value="Down" class="btn btn-outline-secondary" style="width: 44px;">⇩</button><br>



                              </div>
                           </div>





                                 <div style="border: 1px solid #25476a;" class="col-md-12 "></div>
                                 <h3>PDR Quality Checks</h3>
                         <?php 
                       //echo "<pre>"; print_r($getQCById);echo "</pre>";
                                if(!empty($getQCById))
                                {
                                    foreach ($getQCById as $key => $value) 
                                    { ?>
                           
                           
                          
                           <div class="row qcdiv<?=$value['ID'];?>" style="margin-top: 10px;">
                               <input  type="hidden" name="editCQID[]" value="<?=$value['ID'];?>">
                                    <div class="col-md-3">
                                       <label class="form-label">Quality Checks<label class="mandatory">*</label></label>
                                       <?php $qc= set_value('quality_checks'); ?>
                                       <select id="quality_checks" name="edit_quality_checks[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getQualityChecks as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($value['qualityID']==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Inspection Stage<label class="mandatory">*</label></label>
                                       <?php $IS= set_value('inspection_stage'); ?>
                                       <select id="inspection_stage" name="inspection_stage[]" class="form-select">
                                          <option value="PDR" <?php if($value['inspection_stage']=='PDR'){echo "selected";} ?> >Pre Despatch Report</option>
                                          
                                       </select>
                                       <?php echo form_error('inspection_stage');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Standard Value<label class="mandatory">*</label></label>
                                       <input id="standard_value" name="edit_standard_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Standard Value" value="<?=$value['std_value'];?>">
                                       <?php echo form_error('standard_value');?>
                                    </div>
                                    <div class="col-md-1">
                                       <label class="form-label">Mini</label>
                                       <input id="minimum_value" name="edit_minimum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Minimum Value" value="<?=$value['min_value'];?>">
                                       
                                    </div>
                                    <div class="col-md-1">
                                       <label class="form-label">Maxi</label>
                                       <input id="maximum_value" name="edit_maximum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Maximum Value" value="<?=$value['max_value'];?>">
                                       
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">No of Samples</label>
                                       <input id="no_of_samples" name="edit_no_of_samples[]" maxlength="3" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="No of Samples" value="<?=$value['no_of_samples'];?>">
                                       
                                    </div>
                                    <div class="col-md-1 imageDiv"> 
                                       <a href="javascript:void(0);" onclick="removeQC(<?=$value['ID'];?>);" >
                                        <img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove">
                                       </a>
                                    </div>
                                 </div>
                           
                           <?php }} ?>


                                 <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                       <label class="form-label">Quality Checks<label class="mandatory">*</label></label>
                                       <?php $qc= set_value('quality_checks'); ?>
                                       <select id="quality_checks" name="quality_checks[]" class="form-select">
                                          <option selected value="">Choose...</option>
                                          <?php foreach($getQualityChecks as $prodf){ ?>
                                          <option  value="<?=$prodf['id'];?>" <?php if($qc==$prodf['id']){echo "selected";} ?>><?=$prodf['name'];?></option>
                                          <?php } ?>
                                       </select>
                                       <?php echo form_error('quality_checks');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Inspection Stage<label class="mandatory">*</label></label>
                                       <?php $IS= set_value('inspection_stage'); ?>
                                       <select id="inspection_stage" name="inspection_stage[]" class="form-select">
                                         <option value="PDR" <?php if($IS=='PDR'){echo "selected";} ?> <?php if($getparts['inspection_stage']=='PDR'){echo "selected";} ?> >Pre Despatch Report</option>
                                          
                                       </select>
                                       <?php echo form_error('inspection_stage');?>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">Standard Value<label class="mandatory">*</label></label>
                                       <input id="standard_value" name="standard_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Standard Value" value="<?php echo set_value('standard_value', $getparts[standard_value]); ?>">
                                       <?php echo form_error('standard_value');?>
                                    </div>
                                    <div class="col-md-1">
                                       <label class="form-label">Mini</label>
                                       <input id="minimum_value" name="minimum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Mini" value="<?php echo set_value('minimum_value', $getparts[minimum_value]); ?>">
                                       
                                    </div>
                                    <div class="col-md-1">
                                       <label class="form-label">Maxi</label>
                                       <input id="maximum_value" name="maximum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Maxi" value="<?php echo set_value('maximum_value', $getparts[maximum_value]); ?>">
                                       
                                    </div>
                                    <div class="col-md-2">
                                       <label class="form-label">No of Samples</label>
                                       <input id="no_of_samples" name="no_of_samples[]" maxlength="3" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="No of Samples" value="5">
                                       
                                    </div>
                                    <div class="col-md-1 imageDiv">
                                       <a href="javascript:void(0);" onclick="addQualityChecks(this.form);" >
                                       <img src="<?php echo base_url(); ?>public/assets/img/plus.png" alt="Add">
                                       </a>
                                    </div>
                                 </div>


                                 <div id="addQualityChecks1" style="width: 99%;"></div>


                                 
                                 <?php if($getparts['part_id']==''){ ?>
                                 <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                           <a href="/parts"><button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                 </div>
                                 <?php } else {?>
                                 <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                           <a href="/parts"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
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
      <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js" defer></script>
      
      <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  
      <script>
      $(document).ready(function() {
    
    showPartsRawM($("#is_assembly").val());

      var editpartId = '<?=$getparts[part_id];?>';
      $.ajax({
      url:"<?php echo base_url(); ?>getOperationsList",
      method:"POST",
      data:{editpartId:editpartId},
      success:function(result)
      {
      $("#operation_id").html(result);
      }
      });

      if(editpartId!='')
      {
        $.ajax({
      url:"<?php echo base_url(); ?>getOperationsRList",
      method:"POST",
      data:{editpartId:editpartId},
      success:function(result)
      {
      $("#operationName").html(result);
      console.log(result);
      }
      }); 
      }
      

});

function removeQC(qcid){  
   $('div#deleteRPCid').append('<input  type="hidden" name="deleteID[]" value="'+qcid+'">');
   $('.qcdiv'+qcid).remove();
}

function showScrap(ids)
{
 // alert(ids);
  $("#scrap_normal"+ids).val('0');
    $("#scrap_ss"+ids).val('0');
   var RM=$("#raw_material"+ids).val();
   var GW=$("#gross_weight"+ids).val();
   var SN=$("#scrap_normal"+ids).val();
   var SS=$("#scrap_ss"+ids).val();
   var ST=$("#scrap_tikli"+ids).val();

   var NW=$("#net_weight").val();
   var Scrap = parseFloat(GW) - parseFloat(NW);


   var myArray = RM.split("@");
   var RMName=myArray[1];

   var strFirstTwo = RMName.substring(0,2);


   if(GW!='' && NW!='')
   {
      if(strFirstTwo=='AS' || strFirstTwo=='MS')
         {
            $("#scrap_normal"+ids).val(Scrap);
         }else if(strFirstTwo=='SS')
         {
            $("#scrap_normal"+ids).val('');
            $("#scrap_ss"+ids).val(Scrap);
         }else {
            $("#scrap_ss"+ids).val('');
            $("#scrap_normal"+ids).val(Scrap);
         }

          
   }

   
}


function showScrapAll()
{   
    var RMLen1= document.getElementsByName('edit_raw_material[]');
    var licount1=RMLen1.length;
   if(licount1){
      for (i = 1; i <= licount1; i++) {
        $("#scrap_ss"+i).val(0);
        $("#scrap_normal"+i).val(0);
        $("#scrap_tikli"+i).val('');
       // $("#gross_weight"+i).val('');
       showScrap(i);
      }
   }

    var RMLen= document.getElementsByName('raw_material[]');
    var licount=RMLen.length;
    for (i = 1; i <= licount; i++) {
      var j = licount1+i;
     $("#scrap_ss"+j).val(0);
     $("#scrap_normal"+j).val(0);
     $("#scrap_tikli"+j).val('');
     //$("#gross_weight"+i).val('');
    showScrap(j);
   }
   //alert("Please update Gross Weight.");
}

         function isNumberKey(evt) {
          var charCode = (evt.which) ? evt.which : evt.keyCode
          
          if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
          return true;
         }
         function NumberAlphaBetDashUnderscoreSpace(e) {
          var keyCode = e.keyCode || e.which;    
          //Regex to allow only Alphabets Numbers Dash Underscore and Space
          var pattern = /^[a-z\d\-_\s\.]+$/i;
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


    var rowCount = <?=$rmrow;?>;
    function addPartRawM(frm) {
        rowCount ++;
        var recRow = '<span id="rowCount1'+rowCount+'">' +
        '<div class="row" style="margin-top: 10px;"><div class="col-md-3"><label class="form-label">Raw Material<label class="mandatory">*</label></label>'+ 
        '<select id="raw_material'+rowCount+'" name="raw_material[]" class="form-select" onInput="showScrap('+rowCount+');"><option selected value="">Choose...</option><?php foreach($getrawMaterial as $prodf){ $NameId=$prodf['rm_id'].'@'.$prodf['name']; ?><option  value="<?=$NameId;?>"><?=$prodf['name'];?></option><?php } ?></select></div>'+
         
        '<div class="col-md-3"><label class="form-label">Gross Wt (Gms)<label class="mandatory">*</label></label><input id="gross_weight'+rowCount+'" name="gross_weight[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Gross Weight"  onInput="showScrap('+rowCount+')"></div>'+ 
        '<div class="col-md-3"><label class="form-label">Scrap Normal (Gms)</label><input id="scrap_normal'+rowCount+'" name="scrap_normal[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap Normal" readonly></div>'+ 
        '<div class="col-md-2"><label class="form-label">Scrap SS (Gms)</label><input id="scrap_ss'+rowCount+'" name="scrap_ss[]" onkeypress="return isDecimalNumber(event);" type="text" class="form-control" placeholder="Scrap SS" readonly></div>'+ 
        '<div class="col-md-1 imageDiv"><a href="javascript:void(0);" onclick="removeRow1('+rowCount+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove"></a></div></div>'
        ;
        jQuery('#addPartRawM1').append(recRow);
        
    }
    function removeRow1(removeNum) {
    jQuery('#rowCount1'+removeNum).remove();

    rowCount --;
    }


    var rowCount2 = 1;
    function addOtherParts(frm) {
        rowCount2 ++;
        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div class="row" style="margin-top: 10px;"><div class="col-md-3"><label class="form-label">Part Name<label class="mandatory">*</label></label><select id="part_id'+rowCount2+'" name="part_id[]" class="form-select"><option selected value="">Choose...</option><?php foreach($getPartName as $prodf){ ?><option  value="<?=$prodf['part_id'];?>"><?=$prodf['partno'].' '.$prodf['name'];?></option><?php } ?></select></div>'+ 
        '<div class="col-md-3"><label class="form-label">Quantity (Nos)<label class="mandatory">*</label></label><input id="quantity'+rowCount2+'" name="quantity[]" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="Quantity" value="<?php echo set_value('quantity', $getparts[quantity]); ?>"></div>'+
        '<div class="col-md-1 imageDiv"><a href="javascript:void(0);" onclick="removeRow2('+rowCount2+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove"></a></div></div>'
        ;
        jQuery('#addOtherParts1').append(recRow);
        
    }
    function removeRow2(removeNum) {
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }


    var rowCount3 = 1;
    function addOperations(frm) {
        rowCount3 ++;
        var recRow = '<span id="rowCount3'+rowCount3+'">' +
        '<div class="row" style="margin-top: 10px;"><div class="col-md-3"><label class="form-label">Sequence Nos<label class="mandatory">*</label></label><input id="sequence_nos'+rowCount3+'" name="sequence_nos[]" maxlength="2" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="number" class="form-control" placeholder="Sequence Nos" value="<?php echo set_value('quantity', $getparts[quantity]); ?>"></div>'+
        '<div class="col-md-3"><label class="form-label">Operation Name<label class="mandatory">*</label></label><select id="operation_name'+rowCount3+'" name="operation_name[]" class="form-select"><option selected value="">Choose...</option><?php foreach($getOperationName as $prodf){ ?><option  value="<?=$prodf['id'];?>"><?=$prodf['Name'];?></option><?php } ?></select></div>'+
        
        '<div class="col-md-1 imageDiv"><a href="javascript:void(0);" onclick="removeRow3('+rowCount3+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove"></a></div></div>'
        ;
        jQuery('#addOperations1').append(recRow);
        
    }
    function removeRow3(removeNum) {
    jQuery('#rowCount3'+removeNum).remove();
    rowCount3 --;
    }


    var rowCount4 = 1;
    function addQualityChecks(frm) {
        rowCount4 ++;
        var recRow = '<span id="rowCount4'+rowCount4+'">' +
        '<div class="row" style="margin-top: 10px;"><div class="col-md-3"><label class="form-label">Quality Checks<label class="mandatory">*</label></label><select id="quality_checks'+rowCount4+'" name="quality_checks[]" class="form-select"><option selected value="">Choose...</option><?php foreach($getQualityChecks as $prodf){ ?><option  value="<?=$prodf['id'];?>"><?=$prodf['name'];?></option><?php } ?></select></div>'+
        '<div class="col-md-2"><label class="form-label">Inspection Stage<label class="mandatory">*</label></label><select id="inspection_stage" name="inspection_stage[]" class="form-select"><option value="PDR" >Pre Despatch Report</option></select><?php echo form_error('inspection_stage');?>
                                    </div>'+
        '<div class="col-md-2"><label class="form-label">Standard Value<label class="mandatory">*</label></label><input id="standard_value'+rowCount4+'" name="standard_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Standard Value" value="<?php echo set_value('standard_value', $getparts[standard_value]); ?>"></div>'+
        '<div class="col-md-1"><label class="form-label">Mini</label><input id="minimum_value'+rowCount4+'" name="minimum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Mini" value="<?php echo set_value('minimum_value', $getparts[minimum_value]); ?>"></div>'+
        '<div class="col-md-1"><label class="form-label">Maxi</label><input id="maximum_value'+rowCount4+'" name="maximum_value[]" onkeypress="return isDecimalNumber(event);" maxlength="6" type="text" class="form-control" placeholder="Maxi" value="<?php echo set_value('maximum_value', $getparts[maximum_value]); ?>"></div>'+
        '<div class="col-md-2"><label class="form-label">No of Samples</label><input id="no_of_samples'+rowCount4+'" name="no_of_samples[]" onkeypress="return NumberAlphaBetDashUnderscoreSpace(event);" type="text" class="form-control" placeholder="No of Samples" value="5"></div>'+
        
        '<div class="col-md-1 imageDiv"><a href="javascript:void(0);" onclick="removeRow4('+rowCount4+');"><img src="<?php echo base_url(); ?>public/assets/img/minus.png" alt="Remove"></a></div></div>'
        ;
        jQuery('#addQualityChecks1').append(recRow);
        
    }
    function removeRow4(removeNum) {
    jQuery('#rowCount4'+removeNum).remove();
    rowCount4 --;
    }



function showPartsRawM(type) {
    if(type==1)
    {
        $("#PartDiv").show();
        $("#RawMDiv").hide();
    }if(type==0)
    {
        $("#PartDiv").hide();
        $("#RawMDiv").show();
    }
}



$('#moveone').click(function () {
return !$('#operation_id option:selected').remove().appendTo('#operationName');
});
$('#removeone').click(function () {
return !$('#operationName option:selected').remove().appendTo('#operation_id');
});
$('#moveall').click(function () {
return !$('#operation_id option').remove().appendTo('#operationName');
});
$('#removeall').click(function () {
return !$('#operationName option').remove().appendTo('#operation_id');
});


$("#upone").click(function(){
//$("select").moveSelectedUp();
var opt = $('#operationName option:selected');
if(opt.is(':first-child')) {
opt.insertAfter($('#operationName option:last-child'));
}
else {
opt.insertBefore(opt.prev());
}

});
$("#downone").click(function(){
//$("select").moveSelectedDown();
var opt = $('#operationName option:selected');
if(opt.is(':last-child')) {
opt.insertBefore($('#operationName option:first-child'));
}
else {
opt.insertAfter(opt.next());
}

});

      </script>
   </body>
</html>