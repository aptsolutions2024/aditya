<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Part Operations | Aditya</title>

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
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-settings.min.css">

    <!-- Tabulator Style [ OPTIONAL ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/newCss/buttons.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    
</head>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('partOperations');?>">Part Operations</a></li>
                            
                        </ol>
                    </nav>
                    <!-- END : Breadcrumb -->

                    

                    <p class="lead">
                       
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card mb-3">
                        <div class="card-body">



                             <?php echo form_open('/createRelParts', array('autocomplete' => 'off','class' => 'row g-3')); ?>                 


                                     <div class="col-md-4" id="targetDropdown">
                                       <label class="form-label">Parts<label class="mandatory">*</label></label>
                                       <?php $pId= set_value('part_id');  $pname= set_value('part_search');?>
                                       <input type="hidden" id="part_id" name="part_id" class="form-control" value="<?=$pId;?>">
                                       <div class='autocomplete'>
                                          <input type="search" id="part_search" name="part_search" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value)">   
                                          <ul id="searchResult"></ul>   
                                        </div>                                 
                                       <?php echo form_error('part_id');?>
                                    </div>


                                        <div class="col-md-2" style="margin-top: auto;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div>
                                          <div class="col-md-6" style="margin-top: auto;text-align:center;">
                                        <h3>Branch : <?=$_SESSION['branch_name']; ?></h3>
                                        </div>
                                        </form>

                                        <br><br>
<div style='overflow-x:auto'>
                            <table id="example" class="display" style="width:100%;overflow-x:scroll;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Sr.No.</th>
                                        <th>Operation Name</th>
                                        <th width="15%">Nos Per kg</th>
                                        <th width="15%">Nos Per hour</th>
                                        <th>Tool Id 1</th>
                                        <th>Tool Id 2</th>
                                        <th>O.B. QTY (Nos)</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count=0;
                                        foreach ($getRelPartsById as $key => $value) { 
                                            $count++;
                                        
                                     ?>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input" name="checkboxVal[]" value="<?=$value['id'];?>">
                                        </td>
                                        <td><?=$count;?></td>
                                        <td style="text-transform: uppercase">
                                            <input type="hidden" class="form-control" value="<?php echo $value['op_id'];?>" name="opid[]" id="opid<?php echo $value['id'];?>">
                                            <?=$value['Name'];?>                                                
                                            </td>
                                        <td >
                                            <input type="text" class="form-control" value="<?=$value['nosperkg'];?>" name="nosperkg[]" id="nosperkg<?=$value['id'];?>" pattern="[0-9]*[.,]?[0-9]*">
                                        </td>
                                        <td >
                                            <input type="text" class="form-control" name="nosperhour[]" value="<?=$value['nosperhour'];?>" id="nosperhour<?=$value['id'];?>">
                                        </td>
                                        <td >
                                            <select class="form-control" name="tool_id1[]"  id="tool_id1<?=$value['id'];?>">
                                               <option  value="">Choose...</option>
                                          <?php foreach($getTools as $tool){ ?> 
                                           <option  value="<?=$tool['id'];?>" <?php if($value['tool_id1']==$tool['id']){ echo "selected";} ?>><?=$tool['name'];?></option>
                                          <?php } ?>
                                            </select>
                                        </td>
                                        <td >
                                            <select class="form-control" name="tool_id2[]"  id="tool_id2<?=$value['id'];?>">
                                               <option  value="">Choose...</option>
                                          <?php foreach($getTools as $tool){ ?> 
                                           <option  value="<?=$tool['id'];?>" <?php if($value['tool_id2']==$tool['id']){ echo "selected";} ?> ><?=$tool['name'];?></option>
                                          <?php } ?>
                                            </select>
                                        </td>
                                        <td > 
                                            <input type="number" class="form-control" value="<?php echo $value['ob'];?>" name="obqty[]" id="obqty<?php echo $value['id'];?>">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
</div>
                            <div class="col-12" align="center">
                                                <button type="button" class="btn btn-primary Update" onclick="updateReOpts();">Update</button>
                                                 <!--<a href="<?php echo base_url('partOperations')?>"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>-->
                                            </div>

                        </div>
                    </div>


                    

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

   
    <!-- Initialize [ SAMPLE ] -->
   

    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/newJs/buttons.print.min.js"></script>

  <style>
 .autocomplete{
    width: 100%;
    position: relative;
}
.autocomplete #searchResult{
    list-style: none;
    padding: 0px;
    width: 100%;
    position: absolute;
    margin: 0;
    background: white;
    z-index: 1;
}

.autocomplete #searchResult li{
    background: #F2F3F4;
    padding: 4px;
    margin-bottom: 1px;
}

.autocomplete #searchResult li:nth-child(even){
    background: #E5E7E9;
    color: black;
}

.autocomplete #searchResult li:hover{
    cursor: pointer;
    background: #CACFD2;
}



    </style>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    var partId = "<?=$pf;?>";
    var pId = "<?=$pId;?>";
    //getParts(partId,pId);

} );


function searchPart(searchval){   
  var search=searchval;
        if(search != ""){
            // alert("Search val:"+search);

            $.ajax({
                url: '<?php echo base_url(); ?>getPartsBySearch',
                type: 'post',
                data: {search:search},
                success:function(response){ 
                
                   $("#searchResult").empty();
                   $("#searchResult").append(response);                   

                    // binding click event to li
                    $("#searchResult li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }
}
function setText(element){
    var value = $(element).text();
    var partid = $(element).val();

    $("#part_search").val(value);
     $("#part_id").val(partid);
    $("#searchResult").empty();
}

function deleteRecord(editId)
{
if (confirm("Are you sure delete this record?")) {
   $.ajax({
   url:"<?php echo base_url(); ?>/deleteOptsRecord",
   method:"POST",
   data:{editId:editId},
   success:function(result)
   {
   location.reload();
   }
   });
}
}


function getParts(Prod_Family_Id,pId)
{
    $.ajax({
         url:"<?php echo base_url(); ?>getPartsByProdFamily",
         method:"POST",
         data:{Prod_Family_Id:Prod_Family_Id,pId:pId},
         success:function(result)
         {
          $("#part_id").html(result);
         }
         });
}

function updateReOpts()
{
    var checkboxes = document.getElementsByName('checkboxVal[]');
    var checkedvals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
        checkedvals += ","+checkboxes[i].value+"#"+$("#nosperkg"+checkboxes[i].value).val()+"#"+$("#nosperhour"+checkboxes[i].value).val()+"#"+$("#tool_id1"+checkboxes[i].value).val()+"#"+$("#tool_id2"+checkboxes[i].value).val()+"#"+$("#obqty"+checkboxes[i].value).val()+"#"+$("#opid"+checkboxes[i].value).val();
        }
    }
    if (checkedvals) checkedvals = checkedvals.substring(1);
    if(checkedvals=='')
    {
        alert("Please select operation.");
        return false;
    } else 
    {
        var partid=$("#part_id").val();

        $.ajax({
         url:"<?php echo base_url(); ?>updateReOpts",
         method:"POST",
         data:{checkedvals:checkedvals,
         part_id:partid
     },
         success:function(result)
         {
            console.log(result);
          alert("Record Updated!");
        //location.reload();
         }
         }); 
    }
}
</script>
</body>

</html>