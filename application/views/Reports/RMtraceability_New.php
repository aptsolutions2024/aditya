<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>RM Traceability| Aditya</title>

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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/common_style.css">
    <style>
    tr.pinkTr{
        display:none;
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
                              <?php $this->load->view('Reports/Reportslinks'); ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('PartMvmtDatewiseDetails');?>">Datewise Documents</a></li>
                            
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
  

                            <div class="row">
                            <h2 style="width: 82%;">RM Traceability</h2>
                            
                            </div>

                            <?php echo form_open('/RMtraceability', array('autocomplete' => 'off','class' => 'row g-3','id' => 'formSch')); ?>
                                   
                                   <div class="col-md-4">
                                        <label class="form-label">Part Name <label class="mandatory">*</label></label>
                                         <?php $pId= set_value('Part_Id');  $pname= set_value('Part_Search');?>
                                        <input type="hidden" id="Part_IdOnly" name="Part_Id" class="form-select Part_Id" value="<?=$pId;?>">
                                           <div class="autocomplete">
                                              <input type="search" id="Part_SearchOnly" name="Part_Search" class="form-control" value="<?=$pname;?>" onkeyup="searchPart(this.value,'Only','<?=base_url('getPartsBySearch')?>')">   
                                              <ul id="searchResultOnly" class="searchResult"></ul>   
                                           </div>  
                                            <?php echo form_error('Part_Search');?>  
                                          <?php echo form_error('Part_Id');?>  
                                    </div>
                                     <div class="col-md-3">
                                       <label class="form-label">Invoice No<label class="mandatory">*</label></label>
                                       <?php $invoice_no=(set_value('invoice_no'))?set_value('invoice_no'):"";?>
                                       <input id="invoice_no" name="invoice_no" type="text" class="form-control" value="<?=$invoice_no;?>">
                                       <?php echo form_error('invoice_no');?>
                                    </div>
                                    <div class="col-2" style="margin-top: auto;">
                                        <button type="submit" class="btn btn-primary" >Show</button>
                                    </div>
                            </form>
                                        <br><br>
                            
                            <div style="verflow-x: auto;">
                             <table class="table" style="width:100%" id="example1">
                             <thead>
                                    <tr>
                                     
                                        <th>Stage</th>
                                        <th>Process</th>
                                        <th>Operator/Supplier</th>
                                        <th>Branch Name</th>
                                        <th>Document Type</th>
                                        <th>Document ID</th>
                                        <th>Record Date</th>
                                        <th>Entry By</th>
                                        <th>QC By</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                     <?php 
                     
                       //Step 1 - Getting Invoice det_id    from invoice_no  for that part_id
                        $query1= "SELECT td.id as doc_id,CONCAT('''invoice''' ) as doc_type,td.`id`, td.`mast_inv_id`, td.`schedule_id`, td.`prod_plan_id`, td.`oa_det_id`, td.`branch_id`, td.`part_id`, td.`qty`,tm.date,tm.invoice_no,tm.customer_id FROM `tran_invoice_mast` tm inner join tran_invoice_details td on tm.id=td.mast_inv_id where tm.invoice_no = '$invoice_no' and td.part_id='$pId'";
                        $query=$this->db->query($query1);   
                        $res = $query->row_array();
                       // echo "<br><b>Report  - ***********************999999999999*</b><br>". $this->db->last_query(); 
                       
                         $outputArray=[];
                              $array1=[];
                             
                         
                         
                         $doc_id_list =$res[doc_id];
                         $doc_type_list =$res[doc_type];
                         
                    if($doc_type_list!="" || $doc_id_list!=""){
                       
                          $operations=$this->getQueryModel->getOperationByPartId($pId);
                         //echo "<pre>"; print_r($operations); echo "</pre>";
                         
                         foreach($operations as $op){
                              
                            // echo "<br>***   ".$op['op_id']."   8888<br>";
                             
                              if($op['op_id']==48){
                                  continue;
                              }
                              if($doc_type_list!="" || $doc_id_list!=""){
                              if($op['op_id']==1){//Raw Material
                                  //echo "<br> Rm Query";
                                    $sql= "SELECT DISTINCTROW 'rm_rcir' as doc_type, trs.`year`, trs.`doc_year`, trs.`tran_date`, trs.`branch_id`,CONCAT(trs.mast_rmrcir_id,'/',trs.det_rmrcir_id) as doc_id, trs.`rm_id`, trs.issue_doc_type,trs.issue_doc_id,trs.created_by,trs.issue_qty, '1'  as op_id,trm.date FROM tran_rmrcir_stock trs INNER join tran_rmrcir_mast trm on trs.mast_rmrcir_id  = trm.id where trs.received_qty>0 and trs.det_rmrcir_id in(select det_rmrcir_id from tran_rmrcir_stock where issue_doc_id in($doc_id_list) and issue_doc_type in($doc_type_list))";
                              }
                              else
                              {
                             // echo "<br> Main part  Query";
                                   
                                $sql = "SELECT 'dpr'as document, mast_dpr_id as doc_id,received_doc_type as doc_type,tran_date,created_by,received_doc_id from tran_dpr_stock where  received_qty > 0 and  mast_dpr_id in (select mast_dpr_id FROM tran_dpr_stock where issue_qty>0 and issue_doc_id in($doc_id_list) and issue_doc_type in($doc_type_list) and part_id='$pId' and operation_id = '$op[op_id]')
                                        union 
                                        SELECT 'rcir' as document, det_partsrcir_id as doc_id,received_doc_type as doc_type,tran_date,created_by,received_doc_id from tran_partsrcir_stock where  received_qty > 0 and det_partsrcir_id in (select det_partsrcir_id FROM tran_partsrcir_stock where issue_qty>0 and issue_doc_id in($doc_id_list) and issue_doc_type in($doc_type_list) and part_id='$pId'  and op_id = '$op[op_id]')
                                        union 
                                        SELECT 'dc' as document,det_dc_id as doc_id,issue_doc_type as doc_type,tran_date,created_by,received_doc_id from tran_dc_stock where   received_qty > 0 and det_dc_id in (select det_dc_id FROM tran_dc_stock where issue_qty>0 and issue_doc_id in($doc_id_list) and received_doc_type in($doc_type_list) and part_id='$pId'  and op_id = '$op[op_id]')";
                              }      
                                $sql=$this->db->query($sql);   
                                $resmain = $sql->result_array();
                              /*  if ($op['op_id']==1)  {
                                    echo "<br><br>". $this->db->last_query();     echo "<br>";   echo "<pre>"; print_r($resmain);   echo "</pre>";
                                    
                                }*/
                                 foreach($resmain as $res1){
                                      if ($res1['doc_type']=='rm_rcir')
                                     {      
                                         
                                // echo "<br>tran_dpr  ------------ <br>"; 
                                 //echo "<br>";
             
                                                $outputArray[]=array(
                                                    'op_id'=>"1",
                                                    'sequence_no'=>'1',
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                     }
                               else if ($res1['doc_type']=='tran_dpr')
                                     {      
                                         
                                 //echo "<br>tran_dpr  ------------ <br>"; 
                                 //echo "<br>";
             
                                                $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                     }
                                 else if (($res1['doc_type']=='dc_rcir' || $res1['doc_type']=='supl_pmovement'  ) && $res1[document]=='rcir')
                                     {
                                 //echo "<br>dc_rcir   rcir original------------ <br>"; 
                                 //echo "<br>";
                                                $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>'dc_rcir',
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                );
                                         
                                         $sql2 = "select det_dc_id,issue_doc_type as doc_type, tran_date,created_by from tran_dc_stock where det_dc_id in (select det_dc_id from tran_dc_stock where received_doc_type = '$res1[doc_type]'  and received_doc_id = $res1[doc_id]  and part_id='$pId'  and op_id = '$op[op_id]')";  
                                         $sql2=$this->db->query($sql2);   
                                         $res2 = $sql2->row_array();
                                            
                                 //echo "<br>dcRcir  - Rcir ------------ <br>". $this->db->last_query(); 
                                 //echo "<br>";
                                         
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res2['det_dc_id'],
                                                    'doc_type'=>$res2['doc_type'],
                                                    'tran_date'=>$res2['tran_date'],
                                                    'created_by'=>$res2['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                     }
                                  else if($res1['doc_type']=='p_movement' && $res1[document]=='rcir')
                                     {   
                                 // echo "<br>p_movement   rcir original------------ <br>"; 
                                 //echo "<br>";
                                        
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['received_doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                );
                                         
                                         
                                         
                                    
                                         $sql2 = "select mast_dpr_id as doc_id,received_doc_type as doc_type,tran_date,created_by from tran_dpr_stock where received_qty >0 and mast_dpr_id in (select mast_dpr_id from tran_dpr_stock where issue_doc_type = 'p_movement' and issue_doc_id = $res1[received_doc_id]  and part_id='$pId'  and operation_id = '$op[op_id]')
                                                   union all
                                                   select det_partsrcir_id as doc_id,received_doc_type as doc_type,tran_date,created_by from tran_partsrcir_stock where received_qty >0 and det_partsrcir_id in (select det_partsrcir_id from tran_partsrcir_stock where issue_doc_type = 'p_movement' and issue_doc_id = $res1[received_doc_id]  and part_id='$pId'  and op_id = '$op[op_id]')";
                                                    
                                         $sql2=$this->db->query($sql2);   
                                         $res3 = $sql2->result_array();

                                 //echo "<br>p_movement  - Rcir ------------ <br>". $this->db->last_query(); 
                                 //echo "<br>";
                                 //print_r($res3);
                                         foreach($res3 as $res33)
                                         {
                                             //echo "ARRAY (((((((((((((((";print_r($res33);
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res33['doc_id'],
                                                    'doc_type'=>$res33['doc_type'],
                                                    'tran_date'=>$res33['tran_date'],
                                                    'created_by'=>$res33['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                         }
                                     }
                                  else if($res1['doc_type']=='p_rcir' && $res1[document]=='rcir')
                                     {   //**********************************     
                              //echo "<br>p_rcir   rcir original------------ <br>"; 
                                // echo "<br>";

                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                );
                                     }
                                 /* else if($res1['doc_type']=='supl_pmovement' && $res1[document]=='rcir')
                                     {   
                                         
                                 echo "<br>supl_pmovement   rcir original------------ <br>"; 
                                 echo "<br>";
                                         
                                         
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                 );
                                     
                                     
                                        $sql2= "select det_dc_id as doc_id,issue_doc_type as doc_type,tran_date,created_by from tran_dc_stock where issue_qty >0 and det_dc_id in( SELECT det_dc_id FROM `tran_dc_stock` WHERE received_doc_type = 'supl_pmovement' and received_doc_id = '$res1[doc_id]'";    
                                        $sql2=$this->db->query($sql2);   
                                         $res2 = $sql2->row_array();
                                 echo "<br>supl_pmovement  - Rcir ------------ <br>". $this->db->last_query(); 
                                 echo "<br>";

                                         
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res2['doc_id'],
                                                    'doc_type'=>"tran_dc",
                                                    'tran_date'=>$res2['tran_date'],
                                                    'created_by'=>$res2['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                    
                                     }*/
                                  else if($res1['doc_type']=='stock_adj' && $res1[document]=='rcir')
                                     {   //**********************************     
                               // echo "<br>stock_sdj   rcir original------------ <br>"; 
                                // echo "<br>";

                                     
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                );
                                     }
                                else if($res1['doc_type']=='O.B.' && $res1[document]=='rcir')
                                     {   //**********************************     
                                     
                                 //echo "<br>O.B.   rcir original------------ <br>"; 
                                 //echo "<br>";
                                     
                                     
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                                );
                                     }

                                     
                                  else if($res1['doc_type']=='qc_rework' && $res1[document]=='rcir')
                                     {   //**********************************     
                                 //echo "<br>qc_rework   rcir original------------ <br>"; 
                                 //echo "<br>";
                                         
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                );
                                                
                                                
                                         $sql2 = "select det_dc_id,issue_doc_type as doc_type, tran_date,created_by,op_id from tran_dc_stock where det_dc_id in (select det_dc_id from tran_dc_stock where received_doc_type = 'dc_rcir' and received_doc_id = $res1[doc_id]  and part_id='$pId'  )";  
                                        $sql2=$this->db->query($sql2);   
                                         $res2 = $sql2->row_array();
                                //echo "<br>qc_rework  - Rcir ------------ <br>". $this->db->last_query(); 
                                 //echo "<br>";

                                           
                                         $outputArray[]=array(
                                                    'op_id'=>$res2['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res2['det_dc_id'],
                                                    'doc_type'=>"tran_dc",
                                                    'tran_date'=>$res2['tran_date'],
                                                    'created_by'=>$res2['created_by'],
                                                    'nextloop'=>'Y'
                                                );
                                   
                                                
                                     }
                                     
                                     
                                     
                                  else if ($res1['doc_type']=='dc_rcir' && $res1[document]=='dc')
                                     {   //**********************************     
                                     
                                     
                                     /*    $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                );*/
                                     }
                                  else if ($res1['doc_type']=='supl_pmovement' && $res1[document]=='dc')
                                     {   //**********************************     
                                 //echo "<br>supl_pmovement   Delivery challan original------------ <br>"; 
                                 //echo "<br>";

                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                               );
                                     }
                                  else  if ($res1['doc_type']=='stock_adj' && $res1[document]=='dc')
                                     {   //**********************************     
                                 //echo "<br>stock_Adjr   Delivery challan original------------ <br>"; 
                                 //echo "<br>";
                                     
                                         $outputArray[]=array(
                                                    'op_id'=>$op['op_id'],
                                                    'sequence_no'=>$op['sequence_no'],
                                                    'doc_id'=>$res1['doc_id'],
                                                    'doc_type'=>$res1['doc_type'],
                                                    'tran_date'=>$res1['tran_date'],
                                                    'created_by'=>$res1['created_by'],
                                                    'nextloop'=>'N'
                                              );
                                     }
                                       
                                    $doc_id_list='';
                                   $doc_type_list='';
                             
                               foreach ($outputArray as $opArray)
                                 {  if ($opArray['nextloop']=='Y')
                                        {
                                            if ($doc_id_list!='' && $opArray['doc_id']!='')
                                               {$doc_id_list .=',';
                                               
                                               }
                                               
                                            if ($doc_type_list!='' && $opArray['doc_type']!='' )
                                               {$doc_type_list .=',';
                                                
                                               }    
                                            if ($opArray['doc_id']!=''){    $doc_id_list .= $opArray['doc_id'];}
                                            if ($opArray['doc_type']!='') {$doc_type_list.="'".$opArray['doc_type']."'";}
                                        }
                                 }
                                 
                       //echo "<br><u>Document List for  - ". $res1['doc_type']."   ".$res1['doc_id']."    ".$res1['document']."</u><br>".$doc_id_list."<br><br>";
                       //echo "<br><u>Document type for  - ". $res1['doc_type']."   ".$res1['doc_id']."    ".$res1['document']."</u><br>".$doc_type_list."<br><br>";
                                 
                                 }
                              
                         }
                    }
                         }
                      
                          // echo "*******************************************";
                          // print_r($outputArray);
                            $arr_rev = array();
                            $sr=0;
                            for($i = sizeof($outputArray) - 1; $i >= 0; $i--) {?>
                               <tr>
                                 
                                   <td><?=$outputArray[$i]['sequence_no'];?></td>
                                     <td><?php
                                     if($outputArray[$i]['op_id']==1){
                                         echo "RM Received";
                                     }else{
                                      $operD=$this->getQueryModel->getOperation($outputArray[$i]['op_id']);
                                       echo $operD['name']; 
                                     }
                                     ;?></td>
                                   <?php
                                     $opSupName=$this->getQueryModel->getOperatorSupplierQC($outputArray[$i]['doc_type'],$outputArray[$i]['doc_id']);
                                     //echo $opSupName['name'];
                                     
                                      if(!empty($opSupName)){
                                        if($outputArray[$i]['doc_type']=='rm_rcir'){
                                               $supName=$this->getQueryModel->getSupplierById($opSupName['supplier_id']);
                                                echo "<td>".$supName['name']."</td>";
                                                $branchD=  $this->getQueryModel->getBranchbyId($opSupName['branch_id']);
                                                echo "<td>".$branchD['name']."</td>";
                                         }
                                         elseif($outputArray[$i]['doc_type']=='tran_dpr'){
                                               $operatorName=$this->getQueryModel->GetuserById($opSupName['operator_id']);
                                                echo "<td>".$operatorName['fullname']."</td>";
                                                $branchD=  $this->getQueryModel->getBranchbyId($opSupName['branch_id']);
                                                echo "<td>".$branchD['name']."</td>";
                                         }elseif($outputArray[$i]['doc_type']=='dc_rcir' || $outputArray[$i]['doc_type']=='tran_dc' || $outputArray[$i]['doc_type']=='supl_pmovement'){
                                                $supName=$this->getQueryModel->getSupplierById($opSupName['supplier_id']);
                                                echo "<td>".$supName['name']."</td>";
                                                $branchD=  $this->getQueryModel->getBranchbyId($opSupName['branch_id']);
                                                echo "<td>".$branchD['name']."</td>"; 
                                         }
                                      
                                     }else{
                                        echo "<td></td>";
                                        echo "<td></td>";
                                     }
                                     ?>
                                         <td><?=$outputArray[$i]['doc_type'];?></td>
                                         <td><?php   if($outputArray[$i]['doc_type']=='rm_rcir'){?>
                                              <a target='_blank' href=' <?php echo base_url();?>addRMRCIR?ID=<?php echo base64_encode($opSupName['id']); ?>'><?=$outputArray[$i]['doc_id']?></a>
                                         <?php  }
                                          elseif($outputArray[$i]['doc_type']=='tran_dpr'){?>
                                          
                                            <a target='_blank' href='<?= base_url();?>Update-DPR?Id=<?php echo base64_encode($opSupName['dpr_date']); ?>&DPR_ID=<?=$opSupName['id']?>'><?=$outputArray[$i]['doc_id']?></a>
                                            
                                           <?php  }elseif($outputArray[$i]['doc_type']=='tran_dc' || $outputArray[$i]['doc_type']=='supl_pmovement'){?>
                                           
                                              <a target='_blank' href="<?php echo base_url('addDeliveryC');?>?ID=<?php echo base64_encode($opSupName['dc_mast_id']); ?>"><?=$opSupName['dc_mast_id']."/".$outputArray[$i]['doc_id']?></a>
                                              
                                           <?php  } elseif($outputArray[$i]['doc_type']=='dc_rcir'){?>
                                          
                                              <a target='_blank' href="<?php echo base_url('addDCOperation');?>?ID=<?php echo base64_encode($opSupName['rcir_mast_id']); ?>"><?=$opSupName['rcir_mast_id']."/".$outputArray[$i]['doc_id']?></a>
                                              
                                           <?php   }   ?>
                                         </td>
                                         <td><?=date('d-m-Y',strtotime($outputArray[$i]['tran_date']));?></td>
                                         <td><?php
                                            $userDetail=$this->getQueryModel->getUserNameById($outputArray[$i]['created_by']);
                                            echo $userDetail['name'];
                                            ?>
                                         </td>
                                         <td><?php
                                              if($outputArray[$i]['doc_type']=='tran_dpr' || $outputArray[$i]['doc_type']=='dc_rcir' || $outputArray[$i]['doc_type']=='rm_rcir'){
                                                
                                                  
                                                  $QCCreatedBy=$this->getQueryModel->getQCCreatedBy($outputArray[$i]['doc_type'],$outputArray[$i]['doc_id']);
                                                  if(!empty($QCCreatedBy)){
                                                    $userDetail=$this->getQueryModel->getUserNameById($QCCreatedBy['created_by']);
                                                    echo $userDetail['name'];
                                                  }
                                              }
                                            
                                            ?>
                                        </td>
                              </tr>
                              
                             <?php }

                             ?>
              
        
        
        
        
        
                 </tbody>
            </table>  
           
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
    <script src="<?php echo base_url() ?>public/assets/js/common_script.js"></script> 
   

<script>
$(document).ready(function() {
 
      $('#example1').DataTable( {
        dom: 'Bfrtip',
       "bPaginate": false,
    } );
    
} );



</script>
</body>

</html>