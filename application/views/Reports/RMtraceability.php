<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Interactive Tables and Data Grids for JavaScript.">
    <title>View Part Stock Details | Aditya</title>

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
                            
                            <div style="">
                             <table class="table" style="width:100%" id="example1">
                             <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Stage</th>
                                        <th>Process</th>
                                        <th>Document Type</th>
                                        <th>Document ID</th>
                                         <!--<th>Qty.</th>-->
                                        <th>Record Date</th>
                                        <th>Record Creater ID</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                             
                                
             <?php 
             $srno=0;
             $mindate=getMinDate();
            $stkAdjflag=0;
            $rmflag=0;
            $opflag=0;
            $op_id_array=array();
             foreach($report as $row){ 
              $seq_no='';
              $seq_no=$this->getQueryModel->getSequenceNo($pId,'48');
              $op_id_array[]=array(
                 'op_id'=>'48',
                 'sequence_no'=>$seq_no,
                 'doc_id'=>$row[id],
                 'doc_type'=>'Invoice',
                 'tran_date'=>date('d-m-Y',strtotime($row['date'])),
                 'created_by'=>''
                 );
                 
             ?>
                 
                     
                       <!--  <tr>       
                          <td><?= $srno++;$srno;?></td>
                          <td>-</td>
                          <td><?php
                          echo "Invoice";
                          ?></td>
                          <td><?php echo "Invoice";?></td>
                          <td><?=$row[id];?></td>
                          <td><?=date('d-m-Y',strtotime($row['date']));?></td>
                          <td>-</td>
                          <tr>-->
                 
                <?php   //Packing 2 records
                
                echo      $query=$this->db->query("SELECT `year`, `doc_year`, `tran_date`, `branch_id`, mast_dpr_id as doc_id, `part_id`, `operation_id`,received_qty,received_doc_type,issue_doc_type,issue_doc_id,created_by ,issue_qty FROM  tran_dpr_stock where received_qty>0 and mast_dpr_id in(select mast_dpr_id from tran_dpr_stock where issue_doc_id ='$row[id]' and issue_doc_type = 'invoice')");   
                     $report1 = $query->result_array();
                      echo "<br><b>Report 1 - ************************</b><br>". $this->db->last_query(); 
                    //   echo "<pre>"; print_r($report1); echo "</pre>";
                       $mast_dpr_ids=[];
                      foreach($report1 as $r1){
                            $stkAdjflag=0;
                            $rmflag=0;
                            $opflag=0;   
                            if($r1['received_qty']>0){  
                              $seq_no='';
                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r1['operation_id']);
                                  $op_id_array[]=array(
                                     'op_id'=>$r1['operation_id'],
                                     'sequence_no'=>$seq_no,
                                     'doc_id'=>$r1['doc_id'],
                                     'doc_type'=>$r1['issue_doc_type'],
                                     'tran_date'=>date('d-m-Y',strtotime($r1['tran_date'])),
                                     'created_by'=>$r1['created_by']
                                     );
                            ?>
                               <!-- <tr>       
                                  <td><?= $srno++;$srno;?></td>
                                  <td><?php echo "  Loop-1";?></td>
                                  <td><?php
                                  $operD=$this->getQueryModel->getOperation($r1['operation_id']);
                                  echo "|&nbsp;&nbsp;&nbsp;  ".$operD['name']; 
                                  ?></td>
                                  <td><?=$r1['issue_doc_type'];?></td>
                                  <td><?=$r1['doc_id'];?></td>
                                  <td><?=date('d-m-Y',strtotime($r1['tran_date']));?></td>
                                  <td><?=$r1['created_by'];?></td>
                                <tr>  -->
                                
                                
                          <?php 
                                                          if($r1['received_doc_type']=='stock_adj' || $r1['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r1['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r1['op_id']=='5' || $r1['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    $report2=$this->getQueryModel->printRMStockTracebility($r1[doc_id],$r1[received_doc_type],$mindate);
                                                                    echo "<br><b>RM Flag-2 **********</b><br>". $this->db->last_query(); 
                                                                }else{
                                                                  $report2=$this->getQueryModel->printRMTracebility($r1[doc_id],$r1[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -2 **********</b><br>". $this->db->last_query(); 
                                                                }
                          
                            
                            foreach ($report2 as $r2)
                            { 
                            $stkAdjflag=0;
                            $rmflag=0;
                            $opflag=0; 
                             $doc_issue_qty='';
                            if($r2['received_qty']>0){  
                            // $doc_issue_qty=$this->getQueryModel->getDocumentIssueQty($r2[doc_id],$r2[received_doc_type],$mindate);
                                  $seq_no='';
                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r2['op_id']);
                                  $op_id_array[]=array(
                                     'op_id'=>$r2['op_id'],
                                     'sequence_no'=>$seq_no,
                                     'doc_id'=>$r2['doc_id'],
                                     'doc_type'=>$r2['received_doc_type'],
                                     'tran_date'=>date('d-m-Y',strtotime($r2['tran_date'])),
                                     'created_by'=>$r2['created_by']
                                     );
                            ?>
                            
                               <!-- <tr>       
                                  <td><?= $srno++;$srno;?></td>
                                  <td><?php echo "  Loop-2";?></td>
                                  <td><?php
                                  //$operD=$this->getQueryModel->getOperation($r2['op_id']);
                                   echo "&nbsp;&nbsp;&nbsp   "."|&nbsp;&nbsp;&nbsp;   ";
                                  echo $operD['name']; 
                                  ?></td>
                                  <td><?=$r2['received_doc_type'];?></td>
                                  <td><?=$r2['doc_id'];?></td>
                                  <td><?=date('d-m-Y',strtotime($r2['tran_date']));?></td>
                                  <td><?=$r2['created_by'];?></td>
                                <tr>  -->
                                
                            <?php  
                                                         if($r2['received_doc_type']=='stock_adj' || $r2['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r2['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r2['op_id']=='5' || $r2['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    $report3=$this->getQueryModel->printRMStockTracebility($r2[doc_id],$r2[received_doc_type],$mindate);
                                                                }else{
                                                                  $report3=$this->getQueryModel->printRMTracebility($r2[doc_id],$r2[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -3 **********</b><br>". $this->db->last_query(); 
                                                                }
                           
                                    foreach ($report3 as $r3)
                                    { 
                                    $stkAdjflag=0;
                                    $rmflag=0;
                                    $opflag=0; 
                                     $doc_issue_qty='';
                                    if($r3['received_qty']>0){   
                                    // $doc_issue_qty=$this->getQueryModel->getDocumentIssueQty($r3[doc_id],$r3[received_doc_type],$mindate);
                                      $seq_no='';
                                      $seq_no=$this->getQueryModel->getSequenceNo($pId,$r3['op_id']);
                                      $op_id_array[]=array(
                                         'op_id'=>$r3['op_id'],
                                         'sequence_no'=>$seq_no,
                                         'doc_id'=>$r3['doc_id'],
                                         'doc_type'=>$r3['received_doc_type'],
                                         'tran_date'=>date('d-m-Y',strtotime($r3['tran_date'])),
                                         'created_by'=>$r3['created_by']
                                         );
                                    ?>
                                    
                                       <!--<tr>       
                                          <td><?= $srno++;$srno;?></td>
                                           <td><?php echo "  Loop-3";?></td>
                                          <td><?php
                                          $operD=$this->getQueryModel->getOperation($r3['op_id']);
                                           echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                           echo $operD['name'];
                                          ?></td>
                                          <td><?=$r3['received_doc_type'];?></td>
                                          <td><?=$r3['doc_id'];?></td>
                                          <td><?=date('d-m-Y',strtotime($r3['tran_date']));?></td>
                                          <td><?=$r3['created_by'];?></td>
                                        <tr>  -->
                                         
                                            <?php 
                                              if($r3['received_doc_type']=='stock_adj' || $r3['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r3['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r3['op_id']=='5' || $r3['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                        $report4=$this->getQueryModel->printRMStockTracebility($r3[doc_id],$r3[received_doc_type],$mindate);
                                                                }else{
                                                                  $report4=$this->getQueryModel->printRMTracebility($r3[doc_id],$r3[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -4 **********</b><br>". $this->db->last_query(); 
                                                                }
                                          
                                            foreach ($report4 as $r4)
                                            { 
                                                $stkAdjflag=0;
                                                $rmflag=0;
                                                $opflag=0; 
                                            if($r4['received_qty']>0){     
                                              $seq_no='';
                                              $seq_no=$this->getQueryModel->getSequenceNo($pId,$r4['op_id']);
                                              $op_id_array[]=array(
                                                 'op_id'=>$r4['op_id'],
                                                 'sequence_no'=>$seq_no,
                                                 'doc_id'=>$r4['doc_id'],
                                                 'doc_type'=>$r4['received_doc_type'],
                                                 'tran_date'=>date('d-m-Y',strtotime($r4['tran_date'])),
                                                 'created_by'=>$r4['created_by']
                                                 );
                                            ?>
                                            
                                               <!-- <tr>       
                                                  <td><?= $srno++;$srno;?></td>
                                                   <td><?php echo "  Loop-4";?></td>
                                                  <td><?php
                                                  $operD=$this->getQueryModel->getOperation($r4['op_id']);
                                                   echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                  echo $operD['name'];
                                                  ?></td>
                                                  <td><?=$r4['received_doc_type'];?></td>
                                                  <td><?=$r4['doc_id'];?></td>
                                                  <td><?=date('d-m-Y',strtotime($r4['tran_date']));?></td>
                                                  <td><?=$r4['created_by'];?></td>
                                                <tr>  -->
                                                 
                                            <?php 
                                                           if($r4['received_doc_type']=='stock_adj' || $r4['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r4['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r4['op_id']=='5' || $r4['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                        $report5=$this->getQueryModel->printRMStockTracebility($r4[doc_id],$r4[received_doc_type],$mindate);
                                                                }else{
                                                                  $report5=$this->getQueryModel->printRMTracebility($r4[doc_id],$r4[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -5 **********</b><br>". $this->db->last_query(); 
                                                                }
                                           
                                                foreach ($report5 as $r5)
                                                { 
                                                $stkAdjflag=0;
                                                $rmflag=0;
                                                $opflag=0;
                                                if($r5['received_qty']>0){  
                                                  $seq_no='';
                                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r5['op_id']);
                                                  $op_id_array[]=array(
                                                     'op_id'=>$r5['op_id'],
                                                     'sequence_no'=>$seq_no,
                                                     'doc_id'=>$r5['doc_id'],
                                                     'doc_type'=>$r5['received_doc_type'],
                                                     'tran_date'=>date('d-m-Y',strtotime($r5['tran_date'])),
                                                     'created_by'=>$r5['created_by']
                                                     );
                                                ?>
                                                
                                                  <!--  <tr>       
                                                      <td><?= $srno++;$srno;?></td>
                                                       <td><?php echo "  Loop-5";?></td>
                                                      <td><?php
                                                      $operD=$this->getQueryModel->getOperation($r5['op_id']);
                                                       echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                      echo $operD['name'];
                                                      ?></td>
                                                      <td><?=$r5['received_doc_type'];?></td>
                                                      <td><?=$r5['doc_id'];?></td>
                                                      <td><?=date('d-m-Y',strtotime($r5['tran_date']));?></td>
                                                      <td><?=$r5['created_by'];?></td>
                                                    <tr>  -->
                                                     
                                                <?php 
                                                               if($r5['received_doc_type']=='stock_adj' || $r5['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r5['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r5['op_id']=='5' || $r5['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                        $report6=$this->getQueryModel->printRMStockTracebility($r5[doc_id],$r5[received_doc_type],$mindate);
                                                                }else{
                                                                  $report6=$this->getQueryModel->printRMTracebility($r5[doc_id],$r5[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -6 **********</b><br>". $this->db->last_query(); 
                                                                }
                                                
                                                foreach ($report6 as $r6)
                                                { 
                                                $stkAdjflag=0;
                                                $rmflag=0;
                                                $opflag=0;
                                                if($r6['received_qty']>0){     
                                                 $seq_no='';
                                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r6['op_id']);
                                                  $op_id_array[]=array(
                                                     'op_id'=>$r6['op_id'],
                                                     'sequence_no'=>$seq_no,
                                                     'doc_id'=>$r6['doc_id'],
                                                     'doc_type'=>$r6['received_doc_type'],
                                                     'tran_date'=>date('d-m-Y',strtotime($r6['tran_date'])),
                                                     'created_by'=>$r6['created_by']
                                                     );
                                                ?>
                                                
                                                   <!-- <tr>       
                                                      <td><?= $srno++;$srno;?></td>
                                                      <td><?php
                                                      $operD=$this->getQueryModel->getOperation($r6['op_id']);
                                                       echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                      echo $operD['name']; echo "  Loop-6";
                                                      ?></td>
                                                      <td><?=$r6['received_doc_type'];?></td>
                                                      <td><?=$r6['doc_id'];?></td>
                                                      <td><?=date('d-m-Y',strtotime($r6['tran_date']));?></td>
                                                      <td><?=$r6['created_by'];?></td>
                                                    <tr>-->  
                                                     
                                                <?php 
                                                         if($r6['received_doc_type']=='stock_adj' || $r6['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r6['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r6['op_id']=='5' || $r6['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                        $report7=$this->getQueryModel->printRMStockTracebility($r6[doc_id],$r6[received_doc_type],$mindate);
                                                                }else{
                                                                  $report7=$this->getQueryModel->printRMTracebility($r6[doc_id],$r6[received_doc_type],$mindate);
                                                                   //	echo "<br><b>REPORT -7 **********</b><br>". $this->db->last_query(); 
                                                                }
                                             
                                                foreach ($report7 as $r7)
                                                { 
                                                $stkAdjflag=0;
                                                $rmflag=0;
                                                $opflag=0;
                                                if($r7['received_qty']>0){    
                                                  $seq_no='';
                                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r7['op_id']);
                                                  $op_id_array[]=array(
                                                     'op_id'=>$r7['op_id'],
                                                     'sequence_no'=>$seq_no,
                                                     'doc_id'=>$r7['doc_id'],
                                                     'doc_type'=>$r7['received_doc_type'],
                                                     'tran_date'=>date('d-m-Y',strtotime($r7['tran_date'])),
                                                     'created_by'=>$r7['created_by']
                                                     );
                                                ?>
                                                
                                                   <!-- <tr>       
                                                      <td><?= $srno++;$srno;?></td>
                                                      <td><?php
                                                      $operD=$this->getQueryModel->getOperation($r7['op_id']);
                                                       echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                      echo $operD['name']; echo "  Loop-7";
                                                      ?></td>
                                                      <td><?=$r7['received_doc_type'];?></td>
                                                      <td><?=$r7['doc_id'];?></td>
                                                      <td><?=date('d-m-Y',strtotime($r7['tran_date']));?></td>
                                                      <td><?=$r7['created_by'];?></td>
                                                    <tr>  -->
                                                     
                                                <?php 
                                                               if($r7['received_doc_type']=='stock_adj' || $r7['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r7['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r7['op_id']=='5' || $r7['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                        $report8=$this->getQueryModel->printRMStockTracebility($r7[doc_id],$r7[received_doc_type],$mindate);
                                                                }else{
                                                                  $report8=$this->getQueryModel->printRMTracebility($r7[doc_id],$r7[received_doc_type],$mindate);
                                                                   	//echo "<br><b>REPORT -8 **********</b><br>". $this->db->last_query(); 
                                                                }
                                                               
                                                              
                                                                foreach ($report8 as $r8)
                                                                { 
                                                                    $stkAdjflag=0;
                                                                    $rmflag=0;
                                                                    $opflag=0;
                                                                if($r8['received_qty']>0){    
                                                                  $seq_no='';
                                                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r8['op_id']);
                                                                  $op_id_array[]=array(
                                                                     'op_id'=>$r8['op_id'],
                                                                     'sequence_no'=>$seq_no,
                                                                     'doc_id'=>$r8['doc_id'],
                                                                     'doc_type'=>$r8['received_doc_type'],
                                                                     'tran_date'=>date('d-m-Y',strtotime($r8['tran_date'])),
                                                                     'created_by'=>$r8['created_by']
                                                                     );
                                                                ?>
                                                                   <!-- <tr>       
                                                                      <td><?= $srno++;$srno;?></td>
                                                                      <td><?php
                                                                      $operD=$this->getQueryModel->getOperation($r8['op_id']);
                                                                       echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                                      echo $operD['name']; echo "  Loop-8";
                                                                      ?></td>
                                                                      <td><?=$r8['received_doc_type'];?></td>
                                                                      <td><?=$r8['doc_id'];?></td>
                                                                      <td><?=date('d-m-Y',strtotime($r8['tran_date']));?></td>
                                                                      <td><?=$r8['created_by'];?></td>
                                                                    <tr>  -->
                                                                     
                                                                <?php 
                                                                if($r8['received_doc_type']=='stock_adj' || $r8['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r8['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r8['op_id']=='5' || $r8['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                 echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                     echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                      $report9=$this->getQueryModel->printRMStockTracebility($r8[doc_id],$r8[received_doc_type],$mindate);
                                                                }else{
                                                                    $report9=$this->getQueryModel->printRMTracebility($r8[doc_id],$r8[received_doc_type],$mindate);
                                                                 //	echo "<br>REPORT -9 **********<br>". $this->db->last_query(); 
                                                                }
                                                               
                                                                foreach ($report9 as $r9)
                                                                { 
                                                                    $stkAdjflag=0;
                                                                    $rmflag=0;
                                                                    $opflag=0;
                                                                if($r9['received_qty']>0){   
                                                                 $seq_no='';
                                                                  $seq_no=$this->getQueryModel->getSequenceNo($pId,$r9['op_id']);
                                                                  $op_id_array[]=array(
                                                                     'op_id'=>$r9['op_id'],
                                                                     'sequence_no'=>$seq_no,
                                                                     'doc_id'=>$r9['doc_id'],
                                                                     'doc_type'=>$r9['received_doc_type'],
                                                                     'tran_date'=>date('d-m-Y',strtotime($r9['tran_date'])),
                                                                     'created_by'=>$r9['created_by']
                                                                     );
                                                                
                                                                ?>
                                                                 <!--   <tr>       
                                                                      <td><?= $srno++;$srno;?></td>
                                                                      <td><?php
                                                                      $operD=$this->getQueryModel->getOperation($r9['op_id']);
                                                                            echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                                      echo $operD['name']; echo "  Loop-9";
                                                                      ?></td>
                                                                      <td><?=$r9['received_doc_type'];?></td>
                                                                      <td><?=$r9['doc_id'];?></td>
                                                                      <td><?=date('d-m-Y',strtotime($r9['tran_date']));?></td>
                                                                      <td><?=$r9['created_by'];?></td>
                                                                    <tr>  -->
                                                                     
                                                                <?php 
                                                                if($r9['received_doc_type']=='stock_adj' || $r9['received_doc_type']=='O.B.'){
                                                                    $stkAdjflag=1;
                                                                }
                                                                if($r9['op_id']=='3'){
                                                                      $opflag=1; 
                                                                }
                                                                if($r9['op_id']=='5' || $r9['op_id']=='7'){
                                                                      $rmflag=1; 
                                                                }
                                                                if($opflag==1 || $stkAdjflag==1){
                                                                      echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                    continue;
                                                                }
                                                                if($rmflag==1){
                                                                    echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                     $report10=$this->getQueryModel->printRMStockTracebility($r9[doc_id],$r9[received_doc_type],$mindate);
                                                                }else{
                                                                     $report10=$this->getQueryModel->printRMTracebility($r9[doc_id],$r9[received_doc_type],$mindate);
                                                            	   // echo "<br>REPORT -10 **********<br>". $this->db->last_query(); 
                                                                }
                                                               
                                                                        foreach ($report10 as $r10)
                                                                        { 
                                                                            $stkAdjflag=0;
                                                                            $rmflag=0;
                                                                            $opflag=0;
                                                                        if($r10['received_qty']>0){    
                                                                          $seq_no='';
                                                                          $seq_no=$this->getQueryModel->getSequenceNo($pId,$r10['op_id']);
                                                                          $op_id_array[]=array(
                                                                             'op_id'=>$r10['op_id'],
                                                                             'sequence_no'=>$seq_no,
                                                                             'doc_id'=>$r10['doc_id'],
                                                                             'doc_type'=>$r10['received_doc_type'],
                                                                             'tran_date'=>date('d-m-Y',strtotime($r10['tran_date'])),
                                                                             'created_by'=>$r10['created_by']
                                                                             );
                                                                        ?>
                                                                          <!--  <tr>       
                                                                              <td><?= $srno++;$srno;?></td>
                                                                              <td><?php
                                                                              $operD=$this->getQueryModel->getOperation($r10['op_id']);
                                                                            echo "&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   "."|&nbsp;&nbsp;&nbsp;   ";
                                                                              echo $operD['name']; echo "  Loop-10";
                                                                              ?></td>
                                                                              <td><?=$r10['received_doc_type'];?></td>
                                                                              <td><?=$r10['doc_id'];?></td>
                                                                              <td><?=date('d-m-Y',strtotime($r10['tran_date']));?></td>
                                                                              <td><?=$r10['created_by'];?></td>
                                                                            <tr>  -->
                                                                             
                                                                           <?php 
                                                                                   if($r10['received_doc_type']=='stock_adj' || $r10['received_doc_type']=='O.B.'){
                                                                                        $stkAdjflag=1;
                                                                                    }
                                                                                    if($r10['op_id']=='3'){
                                                                                          $opflag=1; 
                                                                                    }
                                                                                    if($r10['op_id']=='5' || $r10['op_id']=='7'){
                                                                                        
                                                                                          $rmflag=1; 
                                                                                    }
                                                                                    if($opflag==1 || $stkAdjflag==1){
                                                                                          echo "<tr class='pinkTr'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                                        continue;
                                                                                    }
                                                                                    if($rmflag==1){
                                                                                         echo "<tr style='background-color:lightblue;'> <td></td><td></td><td></td><td></td><td></td><td></td>  </tr>"; 
                                                                                         $report11=$this->getQueryModel->printRMStockTracebility($r10[doc_id],$r10[received_doc_type],$mindate);
                                                                                    }else{
                                                                                         $report11=$this->getQueryModel->printRMTracebility($r10[doc_id],$r10[received_doc_type],$mindate);
                                                                                	    //echo "<br>REPORT -11 **********<br>". $this->db->last_query(); 
                                                                                    }
                                                                               }
                                                                 
                                                                            }     //tenth for loop
                                                                          }
                                                                 
                                                                       }     //ninth for loop
                                                                
                                                                    }
                                                                 
                                                                }     //eightth for loop
                                                
                                                          }
                                                 
                                                       }     //seventh for loop
                                                    
                                                     }
                                                
                                                    }     //sixth for loop
                                                    
                                                   }
                                                
                                                  }     //fifth for loop
                                               }
                                            
                                            }     //fourt for loop
                                        
                                        }
                                     
                                    
                                    }     //third for loop
                                
                                
                                }
                                
                          
                             
                            
                          }     //second for loop
                                
                                
                    }
                         
                            
                    }   //first for loop
                    
        }  //foreach loop
        
        // echo "<div class='col-md-12'><div class='col-md-6'>BEFORE SORT-<pre>";print_r($op_id_array);echo "</pre></div>";
        
        
        
        usort($op_id_array, function($a, $b) {
    return $a['sequence_no'] <=> $b['sequence_no'];
});
        echo "<div class='col-md-6'>AFTER SORT-<pre>";print_r($op_id_array);echo "</pre></div></div>";
        $srno=0;
        $prev_doc_type='';
        $prev_doc_id = '';
        foreach($op_id_array as $key=>$value){   
   
            echo "<br>   <br>prev   - ". $prev_doc_type,"  val_doc_type   - ". $value['doc_type'] ."   prev_doc_id   - ". $prev_doc_id."   val_doc_id  ".$value['doc_id'];
   
            if ($prev_doc_type='') {$prev_doc_type=$value['doc_type'];$prev_doc_id=$value['doc_id']; }
          //  else if ($prev_doc_type=="$value[doc_type]" &&  $prev_doc_id==$value['doc_id']) {continue;}
              else if (  $prev_doc_id==$value['doc_id']) {continue;}
            
            else echo "<br>   %%%%%%%%%%%";
            if ($value['doc_type']=='tran_dpr' || $value['doc_type']=='dc_rcir' || $value['doc_type']=='O.B.' || $value['doc_type']=='stock_adj' || $value['doc_type']=='rm_rcir'  ||  $value['doc_type']==' ' ||  $value['doc_type']=='Invoice'   ){
        if($value['op_id']==$op_id){ ?>
             <tr>  
             <td>  </td>
             <td> </td>
       <?php   }else{  $srno++; ?>
            <tr>   
            <td><?=$srno;?>  </td>
              <td><?php
                 $operD=$this->getQueryModel->getOperation($value['op_id']);
                 echo $operD['name'];?>
             </td>
       <?php   }
            
         $op_id=$value['op_id'];
        ?>
       
         
          <td> <?php  echo $value['doc_type'];  $prev_doc_type=$value['doc_type'];$prev_doc_id=$value['doc_id'];?> </td>
          <td> <?php  echo $value['doc_id']; ?> </td>
          <td> <?php  echo $value['tran_date']; ?></td>
          <td> <?php  echo $value['created_by']; ?></td>
        <tr>
            
       <?php }  
       }
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