<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="General form-control live preview. You can copy our examples and paste them into your project!">
    <title>Add Incoming | Aditya</title>

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

   <style> 
   .minusPlusImg{
       width: 35px; margin-top: 25px;
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
                            <li class="breadcrumb-item active"><a href="<?php echo base_url('RMQC');?>">RM-QC</a></li>
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
                           

                     if($_GET['id'] ==''){ ?>
                    <h2 class="mb-3"> Add RMQC</h2>
                    <?php } else { ?>
                    <h2 class="mb-3">Add RMQC</h2>
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
                                        <?php echo form_open_multipart('/addRMQC', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } else {  ?>
                                        <?php echo form_open_multipart('/addRMQC', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                    <?php } ?>
                                    <input type="hidden" name="editId" class="editId" value="<?= base64_decode($_GET['id']); ?>">
                                        <form class="row g-3">
                                         <div class="col-md-3">
                                            </div>
                                        <div class="col-md-1" align="center" style="margin-top:27px;">
                                           
                                           
                                        </div>
                                         <div class="col-md-3"> </div>
                                         <div class="col-md-5"></div>
                                         
                                         <div class="col-md-3">

                                            <input type="hidden" name="mast_RMrcir_id" value="<?= $rmqc['mast_RMrcir_id']; ?>">
                                            <label for="" class="form-label">Date<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="dpr_date" value="<?= $rmqc['date']; ?>">
                                        </div>
                                        <div class="col-md-3">

                                            <label for="" class="form-label">RM Name<label class="mandatory">*</label></label>
                                            <input type="hidden" name="rm_id" value="<?= $rmqc['rm_id']; ?>">
                                            
                                           <input type="text" readonly class="form-control" name="rm_name" value="<?= $rmqc['rm_name']; ?>">
                                        </div>  
                                        
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Supplier<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="form-control" name="supplier_name" value="<?= $rmqc['supplier_name']; ?>">
                                        </div>  
                                        
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Qty.<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="Qty1 form-control" name="qty" value="<?= $rmqc['qty']; ?>">
                                        </div> 
                                        <!-- <div class="col-md-3">
                                             <label for="" class="form-label">Scrap Used.<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="scrap" value="<?= $dpr_data['scrap_used']; ?>">
                                        </div> --> 
                                       <!--  <div class="col-md-3">
                                             <label for="" class="form-label">Work Hours<label class="mandatory">*</label></label>
                                           <input type="text" readonly class="part_ids1 form-control" name="work_hours" value="<?= $dpr_data['work_hours']; ?>">

                                           
                                        </div>  -->
<hr>

                                <div class="col-md-3">
                                <label for="" class="form-label">Final Rejected Qty.<label class="mandatory">*</label></label>
                                <input type="text" class="final_qty form-control" name="final_qty" value="<?= $rmqc['final_qty']; ?>">
                                </div> 
                                 <div class="col-md-9">
                                     <label for="" class="form-label">Quality check Remark<label class="mandatory">*</label></label>
                                     <textarea class="qc_remark form-control" name="qc_remark"><?= $rmqc['qc_remarks']; ?></textarea>
                                 </div>
<hr>
<!-- ----------------------dynamic start--------------------------->
    
                                <?php 
                           if(empty($GetRmQccheck)){
                        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                                 ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Time1<label class="mandatory">*</label></label>
                           <input type="time" class="part_ids1 form-control" name="time[]" value="<?php echo date('H:i');?>">
                        </div>  
                        <div class="col-md-4">
                            <label for="" class="form-label">Select Type<label class="mandatory">*</label></label>
                           <select class="form-control type_1" required  onchange="getQc(1)"   name="type[]">
                            <option value="">Select Type</option>
                            <option value="V">Visual</option>
                            <option value="D">Dimentional</option>
                            <option value="C">Certificate</option>
                           </select>
                        </div> 
                         <div class="col-md-4">
                            <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>
                           <select class="form-control qc_id1" required name="qc_id[]">
                           
                           </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label for="" class="form-label">Ideal Value<label class="mandatory">*</label></label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="ideaV1[]">
                                </div>
                                <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>
                                <div class="col-md-5"><input type="text" class="form-control" name="ideaV2[]"></div>
                            </div>
                        
                        </div>
                      
                       <div class="col-md-7 CommonReading1">
                           
                        </div>
                        
                        <div class="col-md-1" align="right"><br>
                            <a href="javascript:void(0);"  onclick="addDpr(this.form);">
                                <img src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" style="width: 35px; margin-top: 25px;">
                                </a>
                        </div>

<!-- -----------------dynamic end-------------------------------- -->
                    <?php 
                        
                           }else{

                       

                       $i=0;
                       $j=99;
                   // print_r($GetRmQccheck);
                        foreach ($GetRmQccheck as $key => $value) 
                        {

                        $Qc_type   = $this->GetQueryModel->getQualityChecksbyId($value['qc_id']);
                            ?>
                            <input type="hidden" class="dpr_qc_id" name="rm_qc_id[]" value="<?= $value['id']; ?>">
                            <!-- ------------------------------------- -->
                            <div class="row">
                                <div style="border: 1px dotted #df5645;margin-top: 15px;"></div>
                                <div class="col-md-4"><br>
                                    <label for="" class="form-label">Time<label class="mandatory">*</label></label>
                                    <input type="time" readonly class="part_ids1 form-control" name="time[]" value="<?php echo $value['time'];?>">
                                </div>  


                        <div class="col-md-4"><br>

                            <label for="" class="form-label" >Select Type1<label class="mandatory">*</label></label>
                           <select readonly class="form-control type_<?=$j;?>" data-id="<?= $value['qc_id']; ?>" required     name="type[]">
                            <option value="">Select Type</option> 
                            <option <?= ($Qc_type['qc_type'] == "V") ? "selected" : "" ?>  value="V">Visual</option>
                            <option <?= ($Qc_type['qc_type'] == "D") ? "selected" : "" ?>  value="D">Dimentional</option>
                            <option <?= ($Qc_type['qc_type'] == "C") ? "selected" : "" ?>  value="C">Certificate</option>
                           </select>
                        </div> 
                         <div class="col-md-4"><br>
                            <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>
                           <select readonly class="form-control qc_id<?=$j;?>" required name="qc_id[]">
                          <option value="<?= $Qc_type['id']; ?>"><?= $Qc_type['name']; ?></option>
                           
                           </select>
                        </div>
                        <div class="col-md-3"><br>
                            <label for="" class="form-label">Ideal Value<label class="mandatory">*</label></label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="ideaV1[]" value="<?= $value['ideal_value'];?>">
                                </div>
                                <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>
                                <div class="col-md-5"><input type="text" class="form-control" value=<?= $value['tolerance']; ?> name="ideaV2[]"></div>
                            </div>
                        
                        </div>
                        <?php 

                         if($Qc_type['qc_type'] == "D") {?> 
                        <div class="col-md-7">
                            <br>
                            <label for="" class="form-label"> Reading<label class="mandatory">*</label></label>
                            <div class="row">
                                <div class="col-md-2" >
                                   <input type="text"  class="form-control" name="R1[]"  id="html" value=<?=$value['reading1']; ?>  >
                                </div>
                                <div class="col-md-2" >
                                   <input type="text"  class="form-control" name="R2[]"  id="html" value=<?= $value['reading2']; ?>  >
                                </div>
                                 <div class="col-md-2" >
                                   <input type="text"  class="form-control" name="R3[]"  id="html" value=<?= $value['reading3']; ?>  >
                                </div>
                                 <div class="col-md-2" >
                                   <input type="text"  class="form-control" name="R4[]" id="html" value=<?= $value['reading4']; ?> >
                                </div>
                                 <div class="col-md-2">
                                   <input type="text" class="form-control"  id="html" name="R5[]" value=<?= $value['reading5']; ?> >
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                        <?php  if($Qc_type['qc_type'] == "V") {?> 
                        <div class="col-md-7">
                            <br>
                            <label for="" class="form-label"> Reading<label class="mandatory">*</label></label>
                            <div class="row">
                                <div class="col-md-2" >
                                    <select class="form-control" name="R1[]">
                                        <option <?= ($value['reading1'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading1'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                <div class="col-md-2" >
                                  <select class="form-control" name="R2[]">
                                       <option <?= ($value['reading2'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading2'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-2" >
                                   <select class="form-control" name="R3[]">
                                       <option <?= ($value['reading3'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading3'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-2" >
                                   <select class="form-control" name="R4[]">
                                       <option <?= ($value['reading4'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading4'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                                 <div class="col-md-2">
                                   <select class="form-control" name="R5[]">
                                        <option <?= ($value['reading5'] == "ok") ? "selected": ""; ?> value="ok">Ok</option>
                                        <option <?= ($value['reading5'] == "notok") ? "selected": ""; ?> value="notok">Not Ok</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         
                    <?php } ?>
                     <?php  if($Qc_type['qc_type'] == "C") { ?> 
                        <div class="col-md-7">
                            <br>
                            <input type="hidden" name="R1[]" value='0'> 
                            <input type="hidden" name="R2[]" value='0'> 
                            <input type="hidden" name="R3[]" value='0'> 
                            <input type="hidden" name="R4[]" value='0'>
                            <input type="hidden" name="R5[]" value='0'>
                            
                            <label for="" class="form-label"> Certificate <label class="mandatory">*</label></label>
                            <!--<input type="file" name="Certificate[]" class="form-control" id="Certificate" accept="application/pdf">-->
                                <br>
                                     <a class="btn btn-success certid<?=$value['id'];?>" target="_blank" alt="RM QC Certificate" title="RM QC Certificate"
                                     href="<?=base_url('public/assets/rm_certificate/'.$value['certi_path']);?>" data-attr="<?=$value['certi_path'];?>" >Click Here to View File</a>
                               
                             <!--<input type="hidden" name="Certificate[]" class="form-control" id="Certificate" accept="application/pdf">-->

                            
                         </div>

                         </div>

                     <?php } ?>
                       
                                        <div class="col-md-1" align="right"><br>
                                            <a href="javascript:void(0);"  onclick="removeRec(<?= $value['id']; ?>);">
                                                <img class="minusPlusImg" src="<?= base_url(); ?>/public/assets/img/minus.png" alt="Add">
                                                </a>
                                        </div>
                                        
                                            <!-- ------------------------------------- -->
<?php $i++; $j++;?>

                                    <?php  } ?>  
                                            <div class="col-md-1" align="left"><br>
                                                <a href="javascript:void(0);"  onclick="addDpr(this.form);">
                                                <img class="minusPlusImg" src="<?= base_url(); ?>/public/assets/img/plus.png" alt="Add" >
                                                </a> 
                                                <?php } ?>
                                            </div>

                                            <div id="addDpr1"></div><br>
                                  
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


function getQc(id) 
{
    var  type      = $(".type_"+id+" option:selected").val();

     if(type == "D")
     {
        
        var dimensional='<br><label for="" class="form-label"> Reading<label class="mandatory">*</label></label>'+
                            '<div class="row">'+
                                '<div class="col-md-2" >'+
                                   '<input type="text"  class="form-control"  id="html" name="R1[]" >'+
                                '</div>'+
                                '<div class="col-md-2" >'+
                                   '<input type="text"  class="form-control"  id="html"  name="R2[]" >'+
                                '</div>'+
                                 '<div class="col-md-2" >'+
                                   '<input type="text"  class="form-control"  id="html"  name="R3[]" >'+
                                '</div>'+
                                 '<div class="col-md-2" >'+
                                   '<input type="text"  class="form-control"  id="html" name="R4[]" >'+
                                '</div>'+
                                 '<div class="col-md-2">'+
                                   '<input type="text" class="form-control"   id="html" name="R5[]" >'+
                                '</div>'+
                            '</div>';
                            $('.CommonReading'+id).html(dimensional);
        
     }
     if(type == "V"){
        
         var visual='<br><label for="" class="form-label"> Reading<label class="mandatory">*</label></label>'+
                            '<div class="row">'+
                                '<div class="col-md-2" >'+
                                    '<select class="form-control" name="R1[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-md-2" >'+
                                  '<select class="form-control" name="R2[]">'+
                                       '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-2" >'+
                                   '<select class="form-control" name="R3[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-2" >'+
                                   '<select class="form-control" name="R4[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                                 '<div class="col-md-2">'+
                                   '<select class="form-control" name="R5[]">'+
                                        '<option value="ok">Ok</option>'+
                                        '<option value="notok">Not Ok</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>';
         $('.CommonReading'+id).html(visual);
      
     }
     if(type == "C"){
       // alert("IN C");
        var certificate='<br> <input type="hidden" name="R1[]" value="0"><input type="hidden" name="R2[]" value="0"><input type="hidden" name="R3[]" value="0"><input type="hidden" name="R4[]" value="0"><input type="hidden" name="R5[]" value="0">'+
                          '<label for="" class="form-label"> Certificate <label class="mandatory">*</label></label>'+
                            '<input type="file" name="Certificate[]" class="form-control" id="Certificate" accept="image/*,.pdf">';
        $('.CommonReading'+id).html(certificate);
            
     }

           $.ajax({
            url: "<?= base_url('getRMQualityCheck'); ?>",
            data: {type : type},
            // dataType: "json",
            type: "POST",
            success: function(data)
            {
                $(".qc_id"+id).html(data);
            }
        });
      
}

   var rowCount2 = 22;
    function addDpr(frm) {
        //getQc(rowCount2);

        var recRow = '<span id="rowCount2'+rowCount2+'">' +
        '<div class="row"><div style="border: 1px dotted #df5645;margin-top: 15px;"></div><br><div class="row"><br><div class="col-md-4">    <label for="" class="form-label">Time<label class="mandatory">*</label></label>   <input type="time" class="part_ids1 form-control" name="time[]" value="<?php echo date('H:i');?>"></div><div class="col-md-4">    <label for="" class="form-label">Select Type<label class="mandatory">*</label></label>   <select class="form-control type_'+rowCount2+'" required  onchange="getQc('+rowCount2+')"   name="type[]">    <option value="">Select Type</option>    <option value="V">Visual</option>    <option value="D">Dimentional</option>    <option value="C">Certificate</option>   </select></div> <div class="col-md-4">    <label for="" class="form-label">Select QC<label class="mandatory">*</label></label>   <select class="form-control qc_id'+rowCount2+'" required name="qc_id[]">   </select></div><div class="col-md-3">    <br>    <label for="" class="form-label">Ideal Value<label class="mandatory">*</label></label>    <div class="row" style="margin-bottom: 10px;">        <div class="col-md-5">            <input type="text" class="form-control" name="ideaV1[]">        </div>        <div class="col-md-2" style="text-align:center; font-size: 23px;"><?php echo "±"; ?></div>        <div class="col-md-5"><input type="text" class="form-control" name="ideaV2[]"></div>    </div></div>'+
        '<div class="col-md-7 CommonReading'+rowCount2+'"></div>'+
        '<div class="col-md-1" align="right"><a href="javascript:void(0);"  onclick="removeRow1('+rowCount2+');"><img src="<?= base_url(); ?>/public/assets/img/minus.png" alt="Add" class="minusPlusImg"></a></div></div><br>';
        jQuery('#addDpr1').append(recRow);

        rowCount2 ++;
    }

     function removeRow1(removeNum) {
       
    jQuery('#rowCount2'+removeNum).remove();
    rowCount2 --;
    }
    function removeRec(removeNum) {
 
        if (confirm("Are you sure - delete this RM-QC?")) {
           var filename=$(".certid"+removeNum).attr('data-attr');
             //alert(fiename); return false;
           $.ajax({
           url:"<?php echo base_url(); ?>deleteRecordRMQC",
           method:"POST",
           data:{id:removeNum,filename:filename},
           success:function(result)
           {
              // console.log(result);
            location.reload();
           }
           });
}
    
    }

function CloseCustomer(removeNum) 
{
    location.href = 'Incoming';
} 
</script>



</body>

</html>