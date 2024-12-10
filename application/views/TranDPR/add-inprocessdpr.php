<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Inprocess DPR | Aditya</title>

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
                            <li class="breadcrumb-item active"><a href="<?php echo base_url('Inprocess-dpr');?>">Inprocess DPR</a></li>
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
                    <h2 class="mb-3">In-ProcessDPR</h2>
                    <?php } ?>

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
                                        <?php echo form_open('/Add-Inprocessdpr', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {  ?>
                                        <?php echo form_open('/Add-Inprocessdpr', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } ?>
                                    <input type="hidden" name="editId" class="editId" value="<?= base64_decode($_GET['Id']); ?>">
                                        <form class="row g-3">
                                         <div class="col-md-3">
                                          

                                            </div>
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                           
                                           
                                        </div>
                                         <div class="col-md-3"> </div>
                                         <div class="col-md-5"></div>
                                         
                                         <div class="col-md-3">
                                            <label for="" class="form-label">DPR Date<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="dpr_date" value="<?= $dpr_data['date']; ?>">
                                        </div>
                                        <div class="col-md-3">
<?php //print_r($dpr_data);?>
                                            <label for="" class="form-label">Part Name<label class="mandatory">*</label></label>
                                            <input type="hidden" name="part_id" value="<?= $dpr_data['part_id']; ?>">
                                            <input type="hidden" name="operation_id" value="<?= $dpr_data['operation_id']; ?>">
                                           <input type="text" readonly class="part_ids1 form-control" name="part_name" value="<?= $dpr_data['part_name']; ?>">
                                        </div>  
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Part No<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="part_no" value="<?= $dpr_data['partno']; ?>">
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Operator<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="operator" value="<?= $dpr_data['Operator']; ?>">
                                        </div>  
                                           <div class="col-md-3">
                                            <label for="" class="form-label">Operation<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="operation" value="<?= $dpr_data['operation']; ?>">
                                        </div> 
                                        <!-- <div class="col-md-3">
                                            <label for="" class="form-label">Tool<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="part_ids[]" value="<?= $dpr_data['tool']; ?>">
                                        </div> --> 
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Qty.<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="Qty1 form-control" name="qty" value="<?= $dpr_data['qty']; ?>">
                                        </div> 
                                        <div class="col-md-3">
                                             <label for="" class="form-label">Scrap Used.<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="scrap" value="<?= $dpr_data['scrap_used']; ?>">
                                        </div> 
                                        <div class="col-md-3">
                                             <label for="" class="form-label">Work Hours<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="work_hours" value="<?= $dpr_data['work_hours']; ?>">

                                           
                                        </div> 
<hr>

  <?php 
     //print_r($GetQcDprIssueQty);
     $disabled="";
     if($GetQcDprIssueQty['issue_qty']>0){  
       //  $disabled="disabled";
        $disabled="style='background-color:lightpink;'";
     }?>
                        <div class="col-md-3">
                                            <label for="" class="form-label"> Accepted Qty Type<label class="mandatory">*</label></label>
                                           <select class="form-control" name="accepted_type_det" <?=$disabled;?>>
                                                <option <?= ($dpr_data['Accepted_type_det']== "A") ? "selected" : ""; ?> value="A">Accepted</option>
                                                <option <?= ($dpr_data['Accepted_type_det']== "B") ? "selected" : ""; ?> value="B">Rejected</option>
                                                <option <?= ($dpr_data['Accepted_type_det']== "C") ? "selected" : ""; ?> value="C">Tolerate</option>
                                                <option <?= ($dpr_data['Accepted_type_det']== "D") ? "selected" : ""; ?> value="D">Rework</option>
                                            </select>
                                            </select>
                                        
                                        </div>
                                <div class="col-md-3">
                                <label for="" class="form-label">Final Rejected Qty.<label class="mandatory">*</label></label>
                                <input type="text" class="final_qty form-control" name="final_qty" id="final_qty" value="<?=(!empty($dpr_data['rejected_qty']))?$dpr_data['rejected_qty']:0; ?>" <?=$disabled;?> onkeyup="checkformaxQty('<?=$dpr_data['qty'];?>','<?=$dpr_data['rejected_qty'];?>',this.value);">
                                </div> 
                                 <div class="col-md-6">
                                     <label for="" class="form-label">Quality check Remark<label class="mandatory">*</label></label>
                                     <textarea class="qc_remark form-control" name="qc_remark"><?=trim($dpr_data['qc_remark']); ?></textarea>
                                 </div>
<hr>
<!-- ----------------------dynamic start--------------------------->
<?php $idcount=0;?>
<?php if(empty($GetQcDPRById)){
   
 ?>

                                       <!-- <div class="col-md-2">
                                            <label for="" class="form-label">Time<label class="mandatory">*</label></label>
                                             <select class="form-select part_ids" name="time[]" required>
                                                   <option>Select Time</option>
                                                        <option  value="9:30">9:30</option>
                                                        <option  value="10:30">10:30</option>
                                                        <option  value="11:30">11:30</option>
                                                        <option  value="12:30">12:30</option>
                                                        <option  value="1:30">1:30</option>
                                                        <option  value="2:30">2:30</option>
                                                        <option   value="3:30">3:30</option>
                                                        <option   value="4:30">4:30</option>
                                                        <option   value="5:30">5:30</option>
                                                        <option   value="6:30">6:30</option>
                                            </select>
                                        </div> --> 
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Select Type<label class="mandatory">*</label></label>
                                           <select class="form-control type_<?=$idcount;?>" required  onchange="getQc(<?=$idcount;?>)"   name="type[]">
                                            <option value="">Select Type</option>
                                            <option value="V">Visual</option>
                                            <option value="D">Dimentional</option>
                                           </select>
                                        </div> 
                                         <div class="col-md-3">
                                            <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>
                                           <select class="form-control qc_id<?=$idcount;?>" required name="qc_id[]">
                                           
                                           </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Ideal Value</label>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="ideaV1[]">
                                                </div>
                                                <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>
                                                <div class="col-md-5"><input type="text" class="form-control" name="ideaV2[]"></div>
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label"> Piece Selection<label class="mandatory">*</label></label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                   <input type="radio"  name="Piece_selection<?=$idcount;?>" value="First">
                                                   First Piece
                                                </div>
                                                <div class="col-md-4" >
                                                     <input type="radio" name="Piece_selection<?=$idcount;?>" value="Last">
                                                   Last Piece
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio"  name="Piece_selection<?=$idcount;?>" value="Random" checked="checked">
                                                   Random Piece
                                                </div>
                                            </div>
                                        
                                        </div>
                                          <div class="col-md-11 CommonReading<?=$idcount;?>">                 </div>

                                      
                                        <div class="col-md-1">
                                            <a href="javascript:void(0);"  onclick="addDpr(this.form);">
                                                <img src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" style="width: 35px; margin-top: 25px;">
                                                </a>
                                        </div>
                                    <?php 
    
                                            $idcount++;
                            }else{
                                       
                                      // $i=0;
                                      // $j=99;
                                       //echo "<pre>";print_r($GetQcDPRById);echo "</pre>";
                                        foreach ($GetQcDPRById as $key => $value) 
                                        {

                                            $Qc_type   = $this->GetQueryModel->getQualityChecksbyId($value['qc_id']);

                                         

                                            ?>
                                            <input type="hidden" class="dpr_qc_id" name="dpr_qc_id[]" value="<?= $value['id']; ?>">
                                            <!-- ------------------------------------- -->
                                            <div class="row">
                                                <div style="border: 1px dotted #df5645;margin:15px 0px;"></div>
                                              <!--  <div class="col-md-2"><br>
                                                    <label for="" class="form-label">Time<label class="mandatory">*</label></label>
                                                    <select class="form-select part_ids1" name="time[]" required>
                                                        <option>Select Time</option>
                                                        <option <?= ($value['time'] == "09:30:00") ? "selected" : "" ?>  value="9:30">9:30</option>
                                                        <option <?= ($value['time'] == "10:30:00") ? "selected" : "" ?>  value="10:30">10:30</option>
                                                        <option <?= ($value['time'] == "11:30:00") ? "selected" : "" ?>  value="11:30">11:30</option>
                                                        <option <?= ($value['time'] == "12:30:00") ? "selected" : "" ?>  value="12:30">12:30</option>
                                                        <option <?= ($value['time'] == "01:30:00") ? "selected" : "" ?>  value="1:30">1:30</option>
                                                        <option <?= ($value['time'] == "02:30:00") ? "selected" : "" ?>  value="2:30">2:30</option>
                                                        <option <?= ($value['time'] == "03:30:00") ? "selected" : "" ?>  value="3:30">3:30</option>
                                                        <option <?= ($value['time'] == "04:30:00") ? "selected" : "" ?>  value="4:30">4:30</option>
                                                        <option <?= ($value['time'] == "05:30:00") ? "selected" : "" ?>  value="5:30">5:30</option>
                                                        <option <?= ($value['time'] == "06:30:00") ? "selected" : "" ?>  value="6:30">6:30</option>
                                            </select>
                                                </div>--> 

                                        <div class="col-md-2"><br>
                                            <label for="" class="form-label">Select Type<label class="mandatory">*</label></label>
                                           <select readonly class="form-control type_<?=$idcount;?>" data-id="<?= $value['qc_id']; ?>" required  onchange="getQc(<?=$idcount;?>)"   name="type[]">
                                            <option value="">Select Type</option> 
                                            <option <?= ($Qc_type['qc_type'] == "V") ? "selected" : "" ?>  value="V">Visual</option>
                                            <option <?= ($Qc_type['qc_type'] == "D") ? "selected" : "" ?>  value="D">Dimentional</option>
                                           </select>
                                        </div> 
                                         <div class="col-md-3"><br>
                                            <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>
                                           <select readonly class="form-control qc_id<?=$idcount;?>"  required name="qc_id[]">
                                           <option value="<?=$Qc_type['id'];?>"> <?= $Qc_type['name']; ?></option>
                                           </select>
                                        </div>
                                        <div class="col-md-3"><br>
                                            <label for="" class="form-label">Ideal Value<label class="mandatory">*</label></label>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="ideaV1[]" value="<?= $value['ideal_value'];?>">
                                                </div>
                                                <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>
                                                <div class="col-md-5"><input type="text" class="form-control" value="<?= $value['tolerance']; ?>" name="ideaV2[]"></div>
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-3">
                                            <br>
                                            <label for="" class="form-label"> Piece Selection<label class="mandatory">*</label></label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                  
                                                   <input type="radio" <?= ($value['piece_selection'] == 'First') ? "checked=checked" : "";?>  name="Piece_selection<?=$idcount;?>" value="First">
                                                   First Piece
                                                </div>
                                                <div class="col-md-4" >
                                                     <input type="radio" <?= ($value['piece_selection'] == 'Last') ? "checked=checked" : "";?>  name="Piece_selection<?=$idcount;?>" value="Last">
                                                   Last Piece
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" <?= ($value['piece_selection'] == 'Random') ? "checked=checked" : "";?>  name="Piece_selection<?=$idcount;?>" value="Random">
                                                   Random Piece
                                                </div>
                                            </div>
                                        
                                        </div>
                                          <?php 

                         if($Qc_type['qc_type'] == "D") {?> 
                        <div class="col-md-11">
                            <br>
                            <label for="" class="form-label"> Reading</label>
                            <div class="row">
                                <div class="col-md-1" >
                                    Reading1<br>(9:30 am)
                                   <input type="text"  class="form-control" name="R1[]"  id="html" value=<?=$value['reading1']; ?>  >
                                </div>
                                <div class="col-md-1" >
                                      Reading2<br>(10:30 am)
                                   <input type="text"  class="form-control" name="R2[]"  id="html" value=<?= $value['reading2']; ?>  >
                                </div>
                                 <div class="col-md-1" >
                                       Reading3<br>(11:30 am)
                                   <input type="text"  class="form-control" name="R3[]"  id="html" value=<?= $value['reading3']; ?>  >
                                </div>
                                 <div class="col-md-1" >
                                       Reading4<br>(12:30 pm)
                                   <input type="text"  class="form-control" name="R4[]" id="html" value=<?= $value['reading4']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading5<br>(1:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R5[]" value=<?= $value['reading5']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading6<br>(2:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R6[]" value=<?= $value['reading6']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading7<br>(3:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R7[]" value=<?= $value['reading7']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading8<br>(4:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R8[]" value=<?= $value['reading8']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading9<br>(5:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R9[]" value=<?= $value['reading9']; ?> >
                                </div>
                                 <div class="col-md-1">
                                       Reading10<br>(6:30 pm)
                                   <input type="text" class="form-control"  id="html" name="R10[]" value=<?= $value['reading10']; ?> >
                                </div>
                            </div>
                        </div>

                    <?php }elseif($Qc_type['qc_type'] == "V") { ?> 
                        <div class="col-md-11">
                            <br>
                            <label for="" class="form-label"> Reading</label>
                            <div class="row">
                                <div class="col-md-1" >
                                    Reading1<br>(9:30 am)
                                    <select class="form-control" name="R1[]">
                                        <option <?= ($value['reading1'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading1'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                <div class="col-md-1" >
                                       Reading2<br>(10:30 am)
                                  <select class="form-control" name="R2[]">
                                       <option <?= ($value['reading2'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading2'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-1" >
                                       Reading3<br>(11:30 am)
                                   <select class="form-control" name="R3[]">
                                       <option <?= ($value['reading3'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading3'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-1" >
                                               Reading4<br>(12:30 pm)
                                   <select class="form-control" name="R4[]">
                                       <option <?= ($value['reading4'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading4'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-1">
                                            Reading5<br>(1:30 pm)
                                   <select class="form-control" name="R5[]">
                                        <option <?= ($value['reading5'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading5'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-1">
                                            Reading6<br>(2:30 pm)
                                    <select class="form-control" name="R6[]">
                                        <option <?= ($value['reading6'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading6'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                            Reading7<br>(3:30 pm)
                                     <select class="form-control" name="R7[]">
                                        <option <?= ($value['reading7'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading7'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                            Reading8<br>(4:30 pm)
                                   <select class="form-control" name="R8[]">
                                        <option <?= ($value['reading8'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading8'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                            Reading9<br>(5:30 pm)
                                   <select class="form-control" name="R9[]">
                                        <option <?= ($value['reading9'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading9'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                  <div class="col-md-1">
                                            Reading10<br>(6:30 pm)
                                   <select class="form-control" name="R10[]">
                                        <option <?= ($value['reading10'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading10'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    <?php } ?>
                              
                                       
                                        <div class="col-md-1" align="right">
                                            <a href="javascript:void(0);"  onclick="removeRec(<?= $value['id']; ?>);">
                                                <img src="<?= base_url(); ?>/public/assets/img/minus.png" alt="Add" style="width: 35px; margin-top: 44px;">
                                                </a>
                                        </div>
                                            <!-- ------------------------------------- -->
<?php                                        $idcount++;   ?>

                                    <?php  } ?>  
                                    <div class="col-md-1" align="left">
                                    <a href="javascript:void(0);"  onclick="addDpr(this.form);">
                                                <img src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" style="width: 35px; margin-top: 43px;">
                                                </a> 
                                            </div>

                                    <?php } ?>
                                 

                                        <div id="addDpr1"></div>
                                  
<!-- ---------------------dynamic end---------------------------->

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
                                                <button type="submit" class="btn btn-primary update_btn">Save</button>
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

<script type="text/javascript">

function checkformaxQty(prevqty,prevfinalqty,currentqty){
    //   alert('tets');
    var prevqty=parseInt(prevqty);
    var currentqty=parseInt(currentqty);
    if(currentqty>prevqty){
     alert("Entered value more than received qty.");
     $("input#final_qty").val(prevfinalqty);
    }
}
function getQc(id) 
{
    
        var type      = $(".type_"+id+" option:selected").val();
        //alert("Type:"+type+"   QC"+id);
   
     if(type == "D")
     {
        
        var dimensional='<br><label for="" class="form-label"> Reading</label>'+
                            '<div class="row">'+
                                '<div class="col-md-1" >   Reading1<br>(9:30 am)'+
                                   '<input type="text"  class="form-control"  id="html" name="R1[]" >'+
                                '</div>'+
                                '<div class="col-md-1" >   Reading2<br>(10:30 am)'+
                                   '<input type="text"  class="form-control"  id="html"  name="R2[]" >'+
                                '</div>'+
                                 '<div class="col-md-1" >   Reading3<br>(11:30 am)'+
                                   '<input type="text"  class="form-control"  id="html"  name="R3[]" >'+
                                '</div>'+
                                 '<div class="col-md-1" >   Reading4<br>(12:30 pm)'+
                                   '<input type="text"  class="form-control"  id="html" name="R4[]" >'+
                                '</div>'+
                                 '<div class="col-md-1">   Reading5<br>(1:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R5[]" >'+
                                '</div>'+
                                '<div class="col-md-1">   Reading6<br>(2:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R6[]" >'+
                                '</div>'+
                                '<div class="col-md-1">   Reading7<br>(3:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R7[]" >'+
                                '</div>'+
                                '<div class="col-md-1">   Reading8<br>(4:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R8[]" >'+
                                '</div>'+
                                '<div class="col-md-1">   Reading9<br>(5:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R9[]" >'+
                                '</div>'+
                                '<div class="col-md-1">   Reading10<br>(6:30 pm)'+
                                   '<input type="text" class="form-control"   id="html" name="R10[]" >'+
                                '</div>'+
                            '</div>';
                            $('.CommonReading'+id).html(dimensional);
        
     }
     if(type == "V"){
        
         var visual='<br><label for="" class="form-label"> Reading</label>'+
                            '<div class="row">'+
                                '<div class="col-md-1" >   Reading1<br>(9:30 am)'+
                                    '<select class="form-control" name="R1[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-md-1" >   Reading2<br>(10:30 am)'+
                                  '<select class="form-control" name="R2[]">'+
                                       '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading3<br>(11:30 am)'+
                                   '<select class="form-control" name="R3[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading4<br>(12:30 pm)'+
                                   '<select class="form-control" name="R4[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading5<br>(1:30 pm)'+
                                   '<select class="form-control" name="R5[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1">Reading6<br>(2:30 pm)'+
                                   '<select class="form-control" name="R6[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1">Reading7<br>(3:30 pm)'+
                                   '<select class="form-control" name="R7[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading8<br>(4:30 pm)'+
                                   '<select class="form-control" name="R8[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading9<br>(5:30 pm)'+
                                   '<select class="form-control" name="R9[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-1"> Reading10<br>(6:30 pm)'+
                                   '<select class="form-control" name="R10[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>';
         $('.CommonReading'+id).html(visual);
      
     }
         var dpr_qc_id  = $(".dpr_qc_id").val();

           $.ajax({
            url: "<?= base_url('getQualityCheck'); ?>",
            data: {type : type,dpr_qc_id:dpr_qc_id},
            // dataType: "json",
            type: "POST",
            success: function(data)
            {
                $(".qc_id"+id).html(data);
            }
        });
      
}

   var rowCount2 =<?=$idcount;?>;
  // var rowCount2 =22;
    
    function addDpr(frm) {
       
        var recRow = '<br><span id="rowCount2'+rowCount2+'">' +
        '<div class="row" style="margin-bottom:10px"><div style="border: 1px dotted #df5645;margin:15px 0px;"></div><br><div class="row"><br>'+
        '<div class="col-md-2">    <label for="" class="form-label">Select Type<label class="mandatory">*</label></label>   <select class="form-control type_'+rowCount2+'" required  onchange="getQc('+rowCount2+')"   name="type[]">    <option value="">Select Type</option>    <option value="V">Visual</option>    <option value="D">Dimentional</option> </select></div> <div class="col-md-3">    <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>   <select class="form-control qc_id'+rowCount2+'" required name="qc_id[]">   </select></div><div class="col-md-3">        <label for="" class="form-label">Ideal Value</label>    <div class="row">        <div class="col-md-5">            <input type="text" class="form-control" name="ideaV1[]">        </div>        <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>        <div class="col-md-5"><input type="text" class="form-control" name="ideaV2[]"></div>    </div></div> <div class="col-md-3"> <label for="" class="form-label"> Piece Selection<label class="mandatory">*</label></label><div class="row"> <div class="col-md-4"> <input type="radio"  name="Piece_selection'+rowCount2+'" value="First"> First Piece</div><div class="col-md-4" ><input type="radio" name="Piece_selection'+rowCount2+'" value="Last">Last Piece </div><div class="col-md-4"><input type="radio"  name="Piece_selection'+rowCount2+'" value="Random" checked="checked">Random Piece </div></div> </div>'+
        '<div class="col-md-11 CommonReading'+rowCount2+'"></div>'+
        '<div class="col-md-1" align="right"><a href="javascript:void(0);"  onclick="removeRow1('+rowCount2+');"><img src="<?= base_url(); ?>/public/assets/img/minus.png" alt="Add" style="width: 32px; margin-top: 45px;"></a></div>'+
        '</div>';
        jQuery('#addDpr1').append(recRow);
             // getQc(rowCount2);
        rowCount2 ++;
    }

     function removeRow1(removeNum) {
       
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }
    function removeRec(removeNum) {
        
        if (confirm("Are you sure - delete this DPR-QC?")) {
           $.ajax({
           url:"<?php echo base_url(); ?>deleteRecord",
           method:"POST",
           data:{id:removeNum},
           success:function(result)
           {
                location.reload();
           }
           });
}
    
    }

function CloseCustomer(removeNum) 
{
    location.href = 'Inprocess-dpr';
} 
</script>
</sript>
</body>

</body>

</html>