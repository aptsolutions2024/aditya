<?php 
//echo "<pre>";print_r($OperatorsDetails);echo "</pre>";


?>
        <table style="width: 100%;">
          <tr>
              <td  colspan="12">
                   <h3> Operator Performance Details Period - <?=($_GET['fromDate'])?date('d-m-Y',strtotime($_GET['fromDate'])):date('d-m-Y',strtotime(getMinDate()));?> To <?=($_GET['toDate'])?date('d-m-Y',strtotime($_GET['toDate'])):date('d-m-Y');?></h3>
            
              </td>
             
              </tr>    
            <tr>
                <th width="3%"> SR.&nbsp;NO. </th>
                <th width="15%"> Emp Name </th>
                <th width="20%"> DATE   </th>
                <th width="10%"> PART NO </th>
                <th width="15%"> Part Name </th>
                <th width="10%"> OP Name </th>
                <th width="15%"> Work Hours   </th>
                <th width="10%"> Prod. Qty    </th>
                <th width="15%"> Qty/Hour   </th>
                <th width="10%"> Ideal_Qty   </th>
                <th width="15%"> Perf.%   </th>
            </tr>

              <?php
                 $sr_no=1;
               foreach($OperatorsDetails as $key => $value){  
                      $tdcolor=(round($value['performance_percentage'],2)>=100)?"#3ce11317":"#c9171726"; 
               ?>
	            <tr style="background-color:<?=$tdcolor;?>">
	                <td> <?=$sr_no;?> </td>
	                  <td> <?php echo $value['fname']." ".$value['lanme'];?></td>
	                <td> <?php $date=date_create($value['dpr_date']); echo date_format($date,"d-m-Y l");?></td>
	                <td> <?php echo $value['partno'];?></td>
	                <td> <?php echo $value['part_name'];?></td>
	                <td> <?php echo $value['operation_name'];?></td>
	                <td> <?php echo $value['work_hours'];?></td>
	                <td> <?php echo $value['qty'];?></td>
	                <td> <?php echo $value['operator_qty_per_hour'];?></td>
	                <td> <?php echo $value['ideal_qty'];?></td>
	                <td>
	                <?php echo round($value['performance_percentage'],2);?></td>	                
	            </tr>                                         
           <?php $sr_no++; } ?>
            
              
              
         
      </table>
          <br> 
         <br> 
         
<!--***********Operator Partwise Summary Table************-->
       <table style="width: 100%;">
          <tr>
              <td  colspan="12">
               <h3>Operator Partwise Summary</h3>
              </td>
             
              </tr>    
            <tr>
                <th width="3%"> SR.&nbsp;NO. </th>
                <th width="15%"> Emp Name </th>
                <th width="20%"> Period   </th>
                <th width="10%"> PART NO </th>
                <th width="15%"> Part Name </th>
                <th width="10%"> OP Name </th>
                <th width="15%"> Work Hours   </th>
                <th width="10%"> Prod. Qty    </th>
                <th width="15%"> Qty/Hour   </th>
                <th width="10%"> Ideal_Qty   </th>
                <th width="15%"> Perf.%   </th>
            </tr>

              <?php
                 $sr_no=1;
               foreach($getPerformDataPartWiseSummary as $key => $value){  
                      $tdcolor=(round($value['performance_percentage'],2)>=100)?"#3ce11317":"#c9171726"; 
               ?>
	            <tr style="background-color:<?=$tdcolor;?>">
	                <td> <?=$sr_no;?> </td>
	                  <td> <?php echo $value['fname']." ".$value['lanme'];?></td>
	                <td><?=($_GET['fromDate'])?date('d-m-Y',strtotime($_GET['fromDate'])):date('d-m-Y',strtotime(getMinDate()));?> To <?=($_GET['toDate'])?date('d-m-Y',strtotime($_GET['toDate'])):date('d-m-Y');?></td>
	                <td> <?php echo $value['partno'];?></td>
	                <td> <?php echo $value['part_name'];?></td>
	                <td> <?php echo $value['operation_name'];?></td>
	                <td> <?php echo $value['work_hours'];?></td>
	                <td> <?php echo $value['qty'];?></td>
	                <td> <?php echo $value['operator_qty_per_hour'];?></td>
	                <td> <?php echo $value['ideal_qty'];?></td>
	                <td>
	                <?php echo round($value['performance_percentage'],2);?></td>	                
	            </tr>                                         
           <?php $sr_no++; } ?>
            
              
              
              
      </table>
      <br><br>
      <!--***********Operator Summary Table************-->
       <table style="width: 100%;">
          <tr>
              <td  colspan="12">
               <h3>Operator Performance Summary</h3>
              </td>
             
              </tr>    
            <tr>
                <th width="3%"> SR.&nbsp;NO. </th>
                <th width="15%"> Emp Name </th>
                <th width="20%"> Period   </th>
                <th width="15%"> Perf.%   </th>
            </tr>

              <?php
                 $sr_no=1;
                 
               foreach($getPerformDataOperatorSummary as $key => $value){  
                      $tdcolor=(round($value['performance'],0)>=100)?"#3ce11317":"#c9171726"; 
               ?>
	            <tr style="background-color:<?=$tdcolor;?>">
	                <td> <?=$sr_no;?> </td>
	                  <td> <?php echo $value['fname']." ".$value['lanme'];?></td>
	                <td><?=($_GET['fromDate'])?date('d-m-Y',strtotime($_GET['fromDate'])):date('d-m-Y',strtotime(getMinDate()));?> To <?=($_GET['toDate'])?date('d-m-Y',strtotime($_GET['toDate'])):date('d-m-Y');?></td>
	              
	                <td>
	                <?php echo round($value['performance'],2);?></td>	                
	            </tr>                                         
           <?php $sr_no++; } ?>
            
              
              
              
      </table>