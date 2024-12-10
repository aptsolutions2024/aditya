
function searchPart(searchval,rowid,baseurl){  
    if($('select#Supplier_Id').val()==""){
       alert("Select supplier first"); 
       $('select#Supplier_Id').focus()
        $("#Part_Search"+rowid).val('');
       return false;
    }
 
 $("#Part_Id"+rowid).val(''); 
  $("#part_qty_no"+rowid).val(''); 
     $("#qty_in_kgs"+rowid).val('');$("#quantity"+rowid).val('');  
 
          var search=searchval;
        if(search != ""){

            $.ajax({
                url: baseurl,
                type: 'post',
                data: {search:search},
                success:function(response){ 
                //console.log(response);
                   $("#searchResult"+rowid).empty();
                   $("#searchResult"+rowid).append(response);                   

                    // binding click event to li
                    $("#searchResult"+rowid+" li").bind("click",function(){
                        setText(this,rowid);
                    });

                }
            });
        }
}
function setText(element,rowid){
    var value = $(element).text();
    var partid = $(element).val();
    if(partid==0){
    $("#Part_Id"+rowid).val("");
    }else if(partid>0){     
           $("#Part_Id"+rowid).val(partid);
    }

    $("#Part_Search"+rowid).val(value);
   
    $("#searchResult"+rowid).empty();
    if(rowid!="Only"){
        getOpByPartId( partid , rowid );
    }else{
        getDCOpBySupPartId(partid);
        getDPROpByPartId(partid);
    };
}



function searchPartOA(searchval,rowid,baseurl,add){  
  
    if($('select#Customer_Id').val()==""){
       alert("Select Customer first"); 
       $('select#Customer_Id').focus();
       $("#Part_Search"+rowid).val('');
       return false;
    }
        $("#Part_Id"+rowid).val(''); 
        var search=searchval;
        if(search != ""){
            $.ajax({
                url: baseurl,
                type: 'post',
                data: {search:search},
                success:function(response){ 
                //console.log(response);
                //if(add=="add"){
                   $("#searchResult"+rowid).empty();
                   $("#searchResult"+rowid).append(response);                   

                    // binding click event to li
                    $("#searchResult"+rowid+" li").bind("click",function(){
                        setTextOA(this,rowid);
                    });
               

                }
            });
        }
}
function setTextOA(element,rowid,add){
    var value = $(element).text();
    var partid = $(element).val();
 
            if(partid==0){
            $("#Part_Id"+rowid).val("");
            }else if(partid>0){     
                   $("#Part_Id"+rowid).val(partid);
            }
            
            $("#Part_Search"+rowid).val(value);
            
            $("#searchResult"+rowid).empty();
             checkPartExit(partid,rowid);

}


function searchPartOAEdit(searchval,rowid,baseurl){  
  
    if($('select#Customer_Id').val()==""){
       alert("Select Customer first"); 
       $('select#Customer_Id').focus();
        $("#edit_Part_Search"+rowid).val('');
       return false;
    }
        $("#edit_Part_Id"+rowid).val(''); 
        var search=searchval;
        if(search != ""){
            $.ajax({
                url: baseurl,
                type: 'post',
                data: {search:search},
                success:function(response){
                    $("#edit_searchResult"+rowid).empty();
                    $("#edit_searchResult"+rowid).append(response);                   

                    // binding click event to li
                    $("#edit_searchResult"+rowid+" li").bind("click",function(){
                        setTextOAEdit(this,rowid);
                    }); 
                

                }
            });
        }
}
function setTextOAEdit(element,rowid){
    var value = $(element).text();
    var partid = $(element).val();
          if(partid==0){
            $("#edit_Part_Id"+rowid).val("");
            }else if(partid>0){     
                   $("#edit_Part_Id"+rowid).val(partid);
            }
            
            $("#edit_Part_Search"+rowid).val(value);
            
            $("#edit_searchResult"+rowid).empty();
            checkPartExitEdit(partid,rowid);
  

}


function calculateQty(current_qty,type,rowid,baseurl){
var Part_Id=$("#Part_Id"+rowid).val();
var Op_Id=$("#Op_Id"+rowid).val();
  $('#part_qty_no'+rowid).val('');
    if(type == 'num'){
          $("#qty_in_kgs"+rowid).val('');
    }else{
        $("#quantity"+rowid).val(''); 
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
                            $("#qty_in_kgs"+rowid).val(kgs.toFixed(2)); 
                           checkQty(rowid,current_qty); 
                        }else{ 
                         
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=(part_operation_qty*current_qty);      
                            $("#quantity"+rowid).val(Math.round(quantity)); 
                              checkQty(rowid,quantity); 
                           }
                          
                        }
                          
                    }else{
                       $("#qty_in_kgs"+rowid).val('');$("#quantity"+rowid).val('');                          
                    }
           

           }
           });
    }
}

function checkQty(nums,quantity)
{
    var quantity=parseInt(quantity);
    //var quantity = parseInt($("#quantity"+nums).val());
    var max_qty = parseInt($("#max_qty"+nums).val());
    
    
    if(max_qty < quantity)
    {
        $("#qtyExit"+nums).show();
        alert("Invalid Quantity: "+quantity);
        $("#quantity"+nums).val('');
        $("#qty_in_kgs"+nums).val('');
    }else
    {
        $("#qtyExit"+nums).hide();
    }
       
}


function calculateEditQty(current_qty,type,rowid,baseurl){
var Part_Id=$("#edit_Part_Id"+rowid).val();
var Op_Id=$("#edit_Op_Id"+rowid).val();
//alert("Type :: "+type);
    if(current_qty!=''){
         $.ajax({
           url:baseurl,
           method:"POST",
           data:{Part_Id:Part_Id,Op_Id:Op_Id},
           success:function(result)
           {
            console.log("Op_Id:"+Op_Id+" Part_Id:"+Part_Id +"  Part QTY:-"+result);
                    if(result){
                        //var part_operation_qty=result;     
                        var part_operation_qty=result;               
                        if(type == 'num'){
                            //Show kgs per quantity
                             var kgs = (current_qty/part_operation_qty);
                            $("#edit_qty_in_kgs"+rowid).val(kgs.toFixed(2)); 
                        }else{    
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=part_operation_qty*current_qty ;      
                            $("#edit_quantity"+rowid).val(Math.round(quantity));
                          
                           }
                          
                        }
                    }else{
                       $("#edit_qty_in_kgs"+rowid).val(0);$("#edit_quantity"+rowid).val(0);                          
                    }
           

           }
           });
    }
}


function editcheckQty(nums)
{

    var quantity    = parseInt($("#edit_quantity"+nums).val());
    var max_qty     = parseInt($("#edit_max_qty"+nums).val());
    
    
    if(max_qty < quantity)
    {
        $("#editqtyExit"+nums).show();
        //$("#quantity"+nums).val('');
    }else
    {
        $("#editqtyExit"+nums).hide();
    }
       
}



function calculateRCIRQty(current_qty,type,rowid,baseurl){  //for DC RCIR ADD/Update
var Part_Id=$("#part_id"+rowid).val();
var Op_Id=$("#op_id"+rowid).val();
 $('#checkbox'+rowid).prop('checked', false);
     if(type == 'num'){
          $("table input#qty_in_kgs"+rowid).val(0);
    }else{
        $("table input#rcir_qty"+rowid).val(0); 
    }
    if(current_qty!='' && current_qty!=0){
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
                    if(part_operation_qty){
                                    
                        if(type == 'num'){
                            //Show kgs per quantity
                             var kgs = (current_qty/part_operation_qty);  //input qty/partoperation qty=qty_in_kgs
                            $("table input#qty_in_kgs"+rowid).val(kgs.toFixed(2));
                           editcheckRCIRQty(rowid);
                            //editcheckRCIRQty(rowid,current_qty);
                        }else{    
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=part_operation_qty*current_qty ;      
                            $("table input#rcir_qty"+rowid).val(Math.round(quantity));
                            editcheckRCIRQty(rowid);
                             // editcheckRCIRQty(rowid,quantity);
                           }
                          
                        }
                          
                    }else{
                       $("table input#qty_in_kgs"+rowid).val(0);
                       $("table input#rcir_qty"+rowid).val(0); 
                       
                    }
           

           }
           });
    }
}


function editcheckRCIRQty(nums)
{
    var inproess_loss_qty = 0;
    var quantity=0;
    var  max_qty=0;
    var  totval=0;
  
      inproess_loss_qty = parseInt($('#inproess_loss_qty'+nums).val());  
      quantity    = parseInt($("#rcir_qty"+nums).val());
      max_qty     = parseInt($("#bal_qty"+nums).val());
       
      inproess_loss_qty=(inproess_loss_qty)?inproess_loss_qty:0;
      quantity=(quantity)?quantity:0;
        max_qty=(max_qty)?max_qty:0;
      
      totval = parseInt(quantity+inproess_loss_qty);
 
      //console.log("RCIR QTY:"+quantity+"   Max QTY:"+ max_qty+"  In QTY:"+inproess_loss_qty+"    KGS:"+$("#qty_in_kgs"+nums).val());
      
    if(max_qty < totval)
    {
         alert("Invalid Quantity");
       
        $("#editqtyExit"+nums).show();
      
        $("table input#rcir_qty"+nums).val(0);
        $("table input#qty_in_kgs"+nums).val(0);  
      
        //alert($("#qty_in_kgs"+nums).val());
        $("table input#inproess_loss_qty"+nums).val(0);
        $('table #checkbox'+nums).prop('checked', false);
    }else
    {
        $("#editqtyExit"+nums).hide();
         //$('#checkbox'+nums).prop('checked', true);
    }
    if(totval<=0){
         $('table #checkbox'+nums).prop('checked', false);
    }else{
         $('table #checkbox'+nums).prop('checked', true);
    }
       
}
function calculatePartRCIRQty(current_qty,type,rowid,baseurl){  //for Part RCIR ADD/Update
var Part_Id=$("#part_id"+rowid).val();
var Op_Id=$("#op_id"+rowid).val();
 $('#checkbox'+rowid).prop('checked', false);
     if(type == 'num'){
          $("table input#qty_in_kgs"+rowid).val(0);
    }else{
        $("table input#rcir_qty"+rowid).val(0); 
    }
    if(current_qty!='' && current_qty!=0){
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
                    if(part_operation_qty){
                                    
                        if(type == 'num'){
                            //Show kgs per quantity
                             var kgs = (current_qty/part_operation_qty);  //input qty/partoperation qty=qty_in_kgs
                            $("table input#qty_in_kgs"+rowid).val(kgs.toFixed(2));
                           editcheckRCIRQty(rowid);
                            //editcheckRCIRQty(rowid,current_qty);
                        }else{    
                           ////Show quantity per kgs
                           if(current_qty){
                            var quantity=part_operation_qty*current_qty ;      
                            $("table input#rcir_qty"+rowid).val(Math.round(quantity));
                            editcheckRCIRQty(rowid);
                             // editcheckRCIRQty(rowid,quantity);
                           }
                          
                        }
                          
                    }else{
                       $("table input#qty_in_kgs"+rowid).val(0);
                       $("table input#rcir_qty"+rowid).val(0); 
                       
                    }
           

           }
           });
    }
}


function editcheckPartRCIRQty(nums)
{
    var inproess_loss_qty = 0;
    var quantity=0;
    var  max_qty=0;
    var  totval=0;
  
      inproess_loss_qty = parseInt($('#inproess_loss_qty'+nums).val());  
      quantity    = parseInt($("#rcir_qty"+nums).val());
      max_qty     = parseInt($("#bal_qty"+nums).val());
       
      inproess_loss_qty=(inproess_loss_qty)?inproess_loss_qty:0;
      quantity=(quantity)?quantity:0;
        max_qty=(max_qty)?max_qty:0;
      
      totval = parseInt(quantity+inproess_loss_qty);
 
      //console.log("RCIR QTY:"+quantity+"   Max QTY:"+ max_qty+"  In QTY:"+inproess_loss_qty+"    KGS:"+$("#qty_in_kgs"+nums).val());
      
   /* if(max_qty < totval)
    {
         alert("Invalid Quantity");
       
        $("#editqtyExit"+nums).show();
      
        $("table input#rcir_qty"+nums).val(0);
        $("table input#qty_in_kgs"+nums).val(0);  
      
        //alert($("#qty_in_kgs"+nums).val());
        $("table input#inproess_loss_qty"+nums).val(0);
        $('table #checkbox'+nums).prop('checked', false);
    }else
    {
        $("#editqtyExit"+nums).hide();
         //$('#checkbox'+nums).prop('checked', true);
    }*/
    if(totval<=0){
         $('table #checkbox'+nums).prop('checked', false);
    }else{
         $('table #checkbox'+nums).prop('checked', true);
    }
       
}
function showTotal(partid,rowid){
    var total=0;
    $(".allpart"+partid).each(function(){
        // Test if the div element is empty
        if($(this).val()){
        total+=parseInt($(this).val());
        }
    });
     $("#partrecQty"+partid).val(total);
   //  alert("test");
     editcheckRCIRQty(rowid);

}

//Common Functions
function isDecimalNumber(evt) {

          var charCode = (evt.which) ? evt.which : evt.keyCode
          if (charCode == 46) {
          return true;
          }
          else if (charCode > 31 && (charCode < 48 || charCode > 57))
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
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}