<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Incoming | Aditya</title>

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
 <style>
    td.details-control {
    background: url('<?php echo base_url() ?>public/assets/img/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url() ?>public/assets/img/details_close.png') no-repeat center center;
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
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('MangDashboard');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('Incoming');?>">Incoming QC</a></li>
                            
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

                             <?php echo form_open('/Incoming', array('autocomplete' => 'off','class' => 'row g-3')); ?>
                                   
                            <h3 style="width: 87%;">Incoming QC</h3>
                                   
                                    <div class="col-md-2" style="text-align: right;margin-top: 26px;">
                                        <label class="form-label">Select Date<label class="mandatory"> : </label></label>
                                    </div>
                                    <div class="col-md-3">
                                          <?php $date=(set_value('date'))?set_value('date'):$_SESSION['pendingDate'];?>
                                       <input id="date" name="date" type="month" class="form-control" value="<?php echo $date;?>" min="<?php echo minDate();?>" max="<?php echo maxDate();?>">
                                       <?php echo form_error('date');?>
                                    </div>

                                       <!--  <div class="col-1" style="margin-top: 17px;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                        </div> -->
                                        <div class="col-md-3">
                                            <?php 
                                           // print_r($_SESSION);
                                            $pendingval=(set_value('pendingval'))?set_value('pendingval'):$_SESSION['pendingVal'];?>
                                            <select class="form-control" name="pendingval" id="pendingval" onchange="changeDateVal(this.value);">
                                             <option <?= ($pendingval == "pending") ? "selected" : ""; ?> value="pending"> Pending </option>
                                                <option <?= ($pendingval == "all") ? "selected" : ""; ?> value="all"> All Records</option>
                                       
                                            </select>
                                      
                                        </div>

                                        <div class="col-2" style="margin-top: 17px;">
                                        <button type="submit" class="btn btn-primary submit" >Show</button>
                                        </div>
                                        
                                        </form>

                                        <br><br>
                            <div style="overflow: auto;">
                             <table id="example" class="display dt-responsive overflow-auto" style="width:100%">
                                <thead>
                                 <!--    <tr>
                                        <th  align="center">Sr.No.</th>
                                        <th>PO Id</th>
                                        <th>PO Date</th>
                                        <th>Supplier</th>
                                        <th>Details</th> 
                                        <th>Payment Terms</th>
                                        <th>Action</th>
                                       
                                    </tr> -->
                                </thead>
                               
                                <tbody>

                                  
                                </tbody>
                          
                            </table>
</div>
                         
                            <hr>
                             </form>

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

<script>
function changeDateVal(val){
   
    if(val=='pending'){
          date="";
          $("#date").val(""); 
    }
}
$(document).ready(function() 
{
    
    function getChildRow(data)
        {
            
            function getResponse(receipts)
            {
                var dataType = [];
                var value = '<table cellpadding="5" cellspacing="0" border="0" style="margin-left: 62px;width: 95%;">'+
                '<tr style="background-color: #c4ebf6;">'+
                    '<th>Sr.</th>' +
                    '<th>Id.</th>' +
                    '<th>Part Name</th>' +
                    '<th>Operation</th>' +
                    '<th>Qty</th>' +
                    '<th>Inpro. Loss Qty</th>' +
                    '<th>Rejected Qty</th>' +
                    '<th>Rejected Reason</th>' +
                    '<th>Action</th>' +
                '</tr>';
                //dataType.push(value);
                $i=1;
                for (var i = 0; i < data.length; i++)
                {
                    if(data[i].rm_id != "")
                    {
                        var value2 = '<tr>'+
                        '<td tyle="background-color: #c4ebf6;">' + $i + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].id + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].part_id + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].op_id + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].qty + '</td>' +
                         '<td tyle="background-color: #c4ebf6;">' + data[i].inprocess_loss_qty + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].rejected_qty + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].qc_remarks + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + "<a data-id='"+data[i].id+"' style='border:none;background-color: transparent;' class='demo-pli-pen-5 fs-5 dt-center fa-hover'></a>" + '</td>' +
                        '</tr>';
                         dataType.push(value2);
                         $i++;
                    }else
                    {
                         '<td> No Data Available </td>' + '</tr>';
                    }
                }
                var value3 = '</table>';
                //dataType.push(value3);
                var myStr=value+dataType+value3;
                myStr = myStr.replace(/,/g, "");
                return myStr;
            }
                return getResponse(data);
       }

        $("body").on('click', '.demo-pli-pen-5', function (e)
        {  
            var id = ($(this).attr('data-id'));
            
            $.ajax({
                      type:"POST",
                      async:false,
                      // dataType : "POST",
                      data:{id:id},
                      url:"<?php echo base_url();?>ViewAddIncoming",
                      dataType:"json",
                      success:function(result){
                        
                        window.location = ('addIncoming?id='+result);
                    }
              });

            
        });

var date = $("#date").val();

var pending = $("#pendingval option:selected").val();
if(pending=="pending")
{
     date="";$("#date").val(""); 
    ajaxcall2('pending');
}else{
    ajaxcall('all');

}

    function ajaxcall2(all)
    {
         $.ajax({
              type:"POST",
              async:false,
              data:{date:date,flag:all},
              url:"<?php echo base_url();?>GetIncomingData",
              dataType:"json",
              success:function(result){
                    var example = $('#example').DataTable({
                            //dom: 'Bfrtip',
                            pageLength: 25,
                            data: result,
                            //"bDestroy": true,
                            //orderFixed: [[ 4, 'asc' ]],
                            "columns" :[

                                       // {"class":"details-control", data:null, defaultContent:""},
                                       
                                     
                                        { data: "id","title" :"id"},
                                        { data: "id_encode","title" :"id_encode", "visible":false},
                                        { data: "part_id","title" :"Part Name"},
                                        { data: "partno","title" :"Part No"},
                                        { data: "op_id","title" :"Operation"},
                                        { data: "qty","title" :"Qty."},
                                       {data: null, "title" : "Action" ,defaultContent: '<a style="border:none;background-color: transparent;" class="demo-pli-pen-5 fs-5 dt-center fa-hover"></a>'},

                                    ],
                        });
              }
            });

    }

    $("body").on('click', '.demo-pli-pen-5', function (e)
    {  
          var tr1 = $(this).closest('tr');
          var dtTable = $('#example').DataTable();
          var id = dtTable.row(tr1).data().id_encode;
          var host = dtTable.row(tr1).data().host;  

        var url = "<?= base_url('addIncoming'); ?>";
        window.location = url+"?id="+id;
    });


    function ajaxcall(all)
    {
       // alert("ajaxcall");
       if(date){
        $.ajax({
              type:"POST",
              async:false,
              data:{date:date,flag:all},
              url:"<?php echo base_url();?>GetIncomingData",
              dataType:"json",
              success:function(result){
                 // alert(result);
                 console.log(result);
              var example = $('#example').DataTable({
                            "paging" : true,
                            "searching": true,
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            // "pageLength": -1,
                            //"info": false,
                           // "ordering": true,
                            data: result,
                            //"bDestroy": true,
                            //orderFixed: [[ 4, 'asc' ]],
                            "columns" :[

                                        { data: "mast_id","title" :"Mast_Id"},
                                        { data: "id","title" :"Det_id"},
                                        { data: "supplier_id","title" :"Supplier"},
                                        { data: "challan_no","title" :"Challan No"},
                                        { data: "challan_date","title" :"Challan Date"},
                                        { data: "id_encode","title" :"id_encode", "visible":false},
                                        { data: "part_id","title" :"Part Name"},
                                        { data: "partno","title" :"Part No"},
                                        { data: "op_id","title" :"Operation"},
                                        { data: "qc_remarks","title" :"Remark"},
                                        { data: "qty","title" :"Qty."},
                                        {data: null, "title" : "Action" ,defaultContent: '<a style="border:none;background-color: transparent;" class="demo-pli-pen-5 fs-5 dt-center fa-hover"></a>'},
                                        // {data: null, "title" : "Action" ,defaultContent: '<a style="border:none;background-color: transparent;" class="demo-pli-pen-5 fs-5 dt-center fa-hover"></a>'},

                                    ],
                        });
              }
            });
    }else{
      alert("Please Select Date");  
    }
        }

    var dtTable = $('#example').DataTable();

    //   $('#example tbody').on('click',
    //         'td.details-control', function () {

    //             var tr = $(this).closest('tr');
    //             var row = dtTable.row(tr);

    //             if (row.child.isShown()) {

    //                 // Closing the already opened row       
    //                 row.child.hide();

    //                 // Removing class to hide
    //                 tr.removeClass('shown');
    //             }
    //             else {
    //                 var id=(row.data().id);
    //                   $.ajax({
    //                             url:"<?php echo base_url();?>getPartsrcirDetail",
    //                             type: "GET",
    //                             dataType : "json",
    //                              data : {id:id},
    //                             success: function (receipts) {
    //                                 console.log(receipts);
    //                              row.child(getChildRow(receipts)).show();
    //                               tr.addClass('shown');
    //                             }
    //                   });

    //             }
    //         });


});


 

</script>
</body>

</html>