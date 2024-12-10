<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>Parts Purchase Order | Aditya</title>

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

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}



.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('OtherPo');?>">Parts Purchase-order</a></li>
                            
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
                            <?php error_reporting(0); if($_SESSION['createC']!='') {?>
                                        <div class="alert alert-success" role="alert">
                                            <?=$_SESSION['createC'];?>
                                        </div>
                                    <?php } ?>
                                    
                           
                             <div class="row">
                                   <h2 style="width: 80%;">Parts Purchase order</h2>
                            <div class="mb-3" style="float: right;width: 20%;">
                                 <a href="<?php echo base_url('addPpurchesorder');?>"><button type="button" class="btn btn-secondary mail_draft" style="float: right;">Add Purchase Order</button></a>
                             </div>
                            
                               
                            </div>

                        <?php echo form_open('/updateEquisition', array('autocomplete' => 'off','class' => 'row g-3')); ?>
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
                             <!-- <div class="col-12" align="center">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                 <button type="button" id="btnCloseCustomer" onclick="CloseCustomer();"  class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div> -->
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
$(document).ready(function() 
{
    

    function getStatus() 
    {
        alert("");

    } 

        function getChildRow(data)
        {
            
            function getResponse(receipts)
            {
                var dataType = [];
                var value = '<table cellpadding="5" cellspacing="0" border="0" style="margin-left: 62px;width: 95%;">'+
                '<tr style="background-color: #c4ebf6;">'+
                    '<th>Sr.</th>' +
                    '<th>RM Id</th>' +
                    '<th>Ordered Qty</th>' +
                    '<th>Received Qty</th>' +
                    '<th>Accepted Qty</th>' +
                    '<th>Rate</th>' +
                    '<th>Status</th>' +
                '</tr>';
                //dataType.push(value);
                $i=1;
                for (var i = 0; i < data.length; i++)
                {
                    if(data[i].rm_id != "")
                    {
                        var value2 = '<tr>'+
                        '<td tyle="background-color: #c4ebf6;">' + $i + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].rm_id + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].ordered_qty + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].received_qty + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].accepted_qty + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + data[i].rate + '</td>' +
                        '<td tyle="background-color: #c4ebf6;">' + "<input type='checkbox' onclick=+ getStatus(); +  checked>" + '</td>' +
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


    $.ajax({
              type:"POST",
              async:false,
              url:"<?php echo base_url();?>getOrdermast",
              dataType:"json",
              success:function(result){
              var example = $('#example').DataTable({
                            "paging" : true,
                            "searching": true,
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            // "pageLength": -1,
                            //"info": false,
                            "ordering": false,
                            data: result,
                            //"bDestroy": true,
                            //orderFixed: [[ 4, 'asc' ]],
                            "columns" :[


                                        {"class":"details-control", data:null, defaultContent:"+"},
                                        // { data: "UID","title" :"UID", "visible":false},
                                        {data: null, "title" : "Action" ,defaultContent: '<a style="border:none;background-color: transparent;" class="demo-pli-pen-5 fs-5 dt-center fa-hover"></a>'},
                                        { data: "id","title" :"PO Id"},
                                        { data: "supplier_id","title" :"Supplier"},
                                        { data: "date","title" :"Date"},
                                        { data: "payment_terms","title" :"Payment Terms"},
                                        { data: "Remarks","title" :"Remarks"},
                                       

                                      
                                      
                                        // { data: "IP_Address" , "title" :"IP Address"},
                                        // { data: "User","title" :"User"},
                                        // { data: "Site","title" :"Site"},
                                        // { data: "Activites","title" :"Activites"},
                                        // { data: "Start_Date_Time","title" :"Start Date Time"},
                                        // { data: "End_Date_Time","title" :"End Date Time"},
                                    ],
                        });
              }
            });

    var dtTable = $('#example').DataTable();

    var dtTable = $('#example').DataTable();

    $("body").on('click', '.demo-pli-pen-5', function (e){  
      var tr1 = $(this).closest('tr');
      var dtTable = $('#example').DataTable();
      var id = dtTable.row(tr1).data().id;
      var host = dtTable.row(tr1).data().host;  
       var url = "<?= base_url('rm-purches-order'); ?>";
     window.location = url+"?ID="+id;
  });


     $('#example tbody').on('click',
            'td.details-control', function () {

                var tr = $(this).closest('tr');
                var row = dtTable.row(tr);

                if (row.child.isShown()) {

                    // Closing the already opened row       
                    row.child.hide();

                    // Removing class to hide
                    tr.removeClass('shown');
                }
                else {


                    var id=(row.data().id);
                      $.ajax({
                                url:"<?php echo base_url();?>getOrderDetails",
                                type: "GET",
                                dataType : "json",
                                 data : {id:id},
                                success: function (receipts) {
                                 row.child(getChildRow(receipts)).show();
                                  tr.addClass('shown');
                                }
                      });


                    // Show the child row for detail
                    // information
                    // row.child(getChildRow(row.data())).show();

                    // To show details,add the below class
                    // tr.addClass('shown');
                }
            });


    // $('#example').DataTable( {
    //     // dom: 'Bfrtip',
    //     // buttons: [
    //     //     'csv', 'excel', 'pdf', 'print'
    //     // ]
    // } );
} );
function deleteRec($id)
{

    if(confirm("Are you sure - delete this RM-Purches-order.?")) 
    {
       $.ajax({
       url:"<?php echo base_url(); ?>deleteRmOrder",
       method:"POST",
       data:{id:$id},
       success:function(result)
       {
            location.reload();
       }
       });
    }
}

// manual_qty
$('.manual_qty').on('keyup', function() 
{
        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();

        var mqty = (manualval1 == "-") ? 0 : manualval1;
       
        var totl = (parseInt(mqty) + parseInt(qty) );

        $(this).closest('td').next('td').html(totl);
      


});





$('.manual_qty').on('focusout', function() 
{
        var qty = $(this).val();
        var manualval = $(this).closest('td').prev('.plan_req_qty').text();
        var manualval1 = manualval.trim();

        var mqty = (manualval1 == "-") ? 0 : manualval1;
       
        var totl = (parseInt(mqty) + parseInt(qty) );

        var tds = $(this).closest('td').next('td').html(totl);

        var rm_id =  this.id;

         $.ajax({
                   url:"<?php echo base_url(); ?>updateEquisition",
                   method:"POST",
                   data:{rmid:rm_id,rm_qty:qty},
                   success:function(result)
                   {
                      tds.css("background-color", "#5fb35f");
                      tds.css("color", "white");
                   }
   });


        

});




    function CloseCustomer(removeNum) 
    {
        location.href = 'rm-equisition';

    } 
</script>
</body>

</html>