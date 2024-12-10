<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DCRCIRController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('DCRCIR/DCRCIRModel');
		$this->load->model('getQuery/GetQueryModel');
    	$this->load->model('DeliveryChallan/DeliveryCModel');
	}


	public function view()
	{
		$data['getPartRCIR'] = $this->GetQueryModel->getPartRCIR(2);
		$this->load->view('DCRCIR/view',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['Supplier']   = $this->GetQueryModel->getSupplier(2);
		if($id){
		$data['getPRCIRMast']   = $this->GetQueryModel->getPartRCIRMastByID($id);
		$data['getPartRCIRDetails']   = $this->GetQueryModel->getPartRCIRDetailsByID($id);
		}
		$this->load->view('DCRCIR/add',$data);
	}
	public function updateRCIRStock($mast_rcir_id)
	{
	   	foreach ($_POST['checkboxVal'] as $key => $value) 
    			{
    			     $keys                   =  array_search($value,$_POST['dc_det_id'],true);
    			     echo "**Keyy".$keys;
    			    $parts_po_det_id	    = $_POST['parts_po_det_id'][$keys];
    			    $dc_det_id	            = $_POST['dc_det_id'][$keys]; 
    			    $dc_mast_id	            = $_POST['dc_mast_id'][$keys];
    			    $part_id	            = $_POST['part_id'][$keys];
    			    $op_id	                = $_POST['op_id'][$keys];
    			    $ordered_qty            = $_POST['ordered_qty'][$keys];
                    $rec_qty	            = $_POST['rec_qty'][$keys];
                    $bal_qty	            = $_POST['bal_qty'][$keys];
                    $qty_in_kgs             = $_POST['qty_in_kgs'][$keys];
                    $inprocess_loss_qty     = $_POST['inproess_loss_qty'][$keys];
                    $rcir_qty               = $_POST['rcir_qty'][$keys];
                    
                    
                    $postDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'tran_partspo_det_id' 	=> $parts_po_det_id,
        				'dc_det_id' 	        => $dc_det_id,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $op_id,
        				'qty' 				    => $rcir_qty,
        				'qty_in_kgs' 		    => $qty_in_kgs,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'year ' 		        => $_SESSION['current_year'],
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$det_partsrcir_id = $this->DCRCIRModel->AddTranPartsrcirDetails($postDetails);
				
				
				$postStockDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'det_partsrcir_id' 	    => $det_partsrcir_id,
        				'part_id' 			    => $part_id,
        				'op_id' 			    => $op_id,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('supplierId'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date'			    => $this->input->post('date'),
        				'received_qty' 			=> $rcir_qty,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'received_doc_type' 	=> 'dc_rcir',
        				'received_doc_id' 	    => $det_partsrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);
        				
        		$this->DCRCIRModel->AddPTranRcirStock($postStockDetails);
        		
        		  $postStockDetails1 = array(
        				'mast_dc_id'  	     => $dc_mast_id,
        				'det_dc_id' 	     => $dc_det_id,
        				'part_id' 		     => $part_id,
        				'op_id' 		     => $op_id,
        				'year' 			     => $_SESSION['current_year'],
        				'doc_year' 		     => $_SESSION['current_year'],
        				'tran_date'			 => $this->input->post('date'),
        				'received_qty' 	     => $rcir_qty,
        				'received_doc_type'  => 'dc_rcir',
        				'inprocess_loss_qty' => $inprocess_loss_qty,
        				'received_doc_id'    => $det_partsrcir_id,
        				'branch_id'          => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('supplierId'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'created_by ' 	     => $_SESSION['id'],
        				'created_on ' 	     => date("Y-m-d H:i:s"),
        				);
        			$this->DeliveryCModel->AddDCTranStock($postStockDetails1);
				
				$query = $this->db->query("select det_rmrcir_id from tran_dc_stock where det_dc_id='$dc_det_id' and issue_qty>0 and issue_doc_id='$dc_det_id'");
	                $result = $query->row_array();
	           if($result['det_rmrcir_id']){
            		$query = $this->db->query("update tran_partsrcir_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$result['det_rmrcir_id']."',concat(det_rmrcir_id,',','".$result['det_rmrcir_id']."')) where det_partsrcir_id='$det_partsrcir_id'");
    	            $data = $this->db->affected_rows();
	           }
				
    	} 
	    
	}
	public function createDCRCIR()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		   // print_r($_POST['checkboxVal']);die;
            if(!empty($_POST['checkboxVal']))
		    {
			$postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		        => $this->input->post('supplier_challan_date'),
				'challan_no' 	        => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d"),
				);
			$mast_rcir_id  =  $this->DCRCIRModel->AddTranPartsrcirMast($postDate);
			
			$this->updateRCIRStock($mast_rcir_id);
			
			redirect(base_url('viewDCOperation'));	

		}else
		 {
		    $this->session->set_flashdata('oamsg', 'Part RCIR Details should be mandatory!');
			$this->add();
		}
		    
		}else
		 {
			$this->add();
		}
		
	}
	
	public function updateDCRCIR()
	{
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		        
		        $mast_rcir_id	= $_POST['mast_edit_id'];
		        
		    	$postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->DCRCIRModel->updateTranPartsrcirMast($postDate,$mast_rcir_id);
			
		 if(!empty($_POST['checkboxVal']))
		    {
				$this->updateRCIRStock($mast_rcir_id);
	       	}
		    
		    $edit_id	= $_POST['edit_id'];
		    
    		foreach($edit_id as $key =>$rows)
    		{
    		   echo $mast_partsrcir_id = $rows;
    		    $postUDetails = array(
        				'qty' 				    => $_POST['edit_Quantity'][$key],
        				'updated_by ' 		    => $_SESSION['id'],
        				'updated_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$this->DCRCIRModel->UpdateTranRcirDetails($postUDetails,$mast_partsrcir_id);
    		}
    		
			
			redirect(base_url('viewDCOperation'));
		    
		}else
		 {
			$this->add();
		}
		
	}
	
	public function getDCRCIRQtyforSupl()
	{
	    if(!empty($_POST))
	    {
	    $supId 	=$this->input->post('supId');
	     $partId 	=$this->input->post('partId');
	      $opId	=$this->input->post('opId');
	    $MastId 	=$this->input->post('MastId');
	    $getQty  = $this->GetQueryModel->getSuplMovemtqty($supId,$partId,$opId);
	     $dcPartID = $this->GetQueryModel->getDCPartId($supId);
	  // print_r($_POST);
	    
	    echo '<h3>DC Operation RCIR Details Add</h3> (Add New Items)';
      
        echo '<table id="example" class="display dt-responsive overflow-auto" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th width="5%"></th>
        <th width="5%">DC No</th>
        <th width="5%">DC Det ID</th>
        <th width="10%">DC Date.</th>
        <th width="20%">Part Details</th>
        <th width="5%">Op. Name</th>
        <th width="10%">Order Qty</th>
        <th width="10%">Rec. Qty/Loss Qty</th>
        <th width="10%">Bal. Qty</th>
        <th width="10%">Qty In Nos</th>
        <th width="10%">Qty In Kgs</th>
        </tr>
        </thead><tbody>';
         $total = sizeof($getQty);     
         if($total !=0){
             	$rc=1;
		foreach($getQty as $row)
			{
			    
			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
			 $operD=$this->GetQueryModel->getOperation($row['op_id']);
			 $RecQtyDetails  = $this->GetQueryModel->getReceivredQtyById($row['id']);
			
			 $calqtyNum="calculateRCIRQty(this.value,'num',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 $calqtyKgs="calculateRCIRQty(this.value,'kgs',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 
			$bal_qty = $row['ordered_qty'] - $RecQtyDetails['rec_qty']-$RecQtyDetails['loss_qty'];
			if($bal_qty==0){ continue;}
			 	echo '<tr>';
			 		 	//$kgs='calculateQty(this.value,'.chr(34).'kgs'.chr(34).,1,"base_url('getPartOperationQty')")';
			 echo '<input type="hidden" name="dc_mast_id[]" value="'.$row['dc_mast_id'].'">';
			 echo '<input type="hidden" name="dc_det_id[]" value="'.$row['id'].'">';
			 echo '<input type="hidden" name="parts_po_det_id[]" value="'.$row['parts_po_det_id'].'">';
			 echo '<input type="hidden" id="op_id'.$row['id'].'" name="op_id[]" value="'.$row['op_id'].'">';
			 echo '<input type="hidden" name="ordered_qty[]" value="'.$row['ordered_qty'].'">';
			 echo '<input type="hidden" name="rec_qty[]" value="'.$RecQtyDetails['rec_qty'].'">';
			 echo '<input type="hidden" id="bal_qty'.$row['id'].'" value="'.$bal_qty.'">';
			 echo '<input type="hidden" id="part_id'.$row['id'].'" name="part_id[]" value="'.$row['part_id'].'">';
		
           echo '<td > 
            <input name="checkboxVal[]" type="checkbox" value="'.$row['id'].'" id="checkbox'.$row['id'].'">
            </td>
            <td > '.$row['dc_mast_id'].' </td>
             <td > '.$row['id'].' </td>
            <td > '.date("d-m-Y",strtotime($row['date'])).' </td>
            <td > '.$partD['part_id']." - ".$partD['partno']." - ".$partD['name'].' </td>
            <td > '.$operD['name'].' </td>
            <td > '.$row['ordered_qty'].' </td>
            <td > '.($RecQtyDetails['rec_qty']+$RecQtyDetails['loss_qty']).' </td>
            <td > '.$bal_qty.' </td>
             <td > 
            <input class="form-control allpart'.$row['part_id'].'" id="rcir_qty'.$row['id'].'" name="rcir_qty[]" type="text" placeholder="Qty In Nos"  onkeyup="'.$calqtyNum.'" onfocusout="showTotal('.$row['part_id'].')">
            <div id="editqtyExit'.$row['id'].'" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
            </td>
            <td > 
            <input id="qty_in_kgs'.$row['id'].'" name="qty_in_kgs[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs" onkeyup="'.$calqtyKgs.'">
            </td>
            </tr>';
			
              $rc++;                      
			 }
			 if($rc==1){
			     echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
         }
			 echo '</thead></table><br>'; 
			 if(!empty($dcPartID) && $total !=0){
			 echo '<table>';
			 echo '<tr><th>Part No</th><th>Total Value</th><tr>';
			 foreach($dcPartID as $pid){ 
			     
			    echo '<tr><td>'.$pid['part_id']." - ".$pid['partno']." - ".$pid['pname'].'<input class="form-control" type="hidden" name="partIDrec[]" value="'.$pid['part_id'].'"></td><td><input class="form-control" type="text" id="partrecQty'.$pid['part_id'].'" name="partrecQty[]" value="" readonly></td></tr>' ;
			 }
			 	echo '</table>';
			 };
	    }
	}
	public function getDCRCIRQty()
	{
	    if(!empty($_POST))
	    {
	    $supId 	=$this->input->post('supId');
	    $MastId 	=$this->input->post('MastId');
	    $getQty  = $this->GetQueryModel->getDCRCIR($supId);
	     $dcPartID = $this->GetQueryModel->getDCPartId($supId);
	    //echo "<pre>";print_r($getQty);die;
	    
	    echo '<h3>DC Operation RCIR Details Add</h3> (Add New Items)';
      
        echo '<table id="example" class="display dt-responsive overflow-auto" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th width="5%"></th>
        <th width="5%">DC No</th>
        <th width="10%">DC Date.</th>
        <th width="20%">Part Details</th>
        <th width="5%">Op. Name</th>
        <th width="10%">Order Qty</th>
        <th width="10%">Rec. Qty/Loss Qty</th>
        <th width="10%">Bal. Qty</th>
         <th width="10%">Qty In Nos</th>
        <th width="10%">Qty In Kgs</th>
        <th width="10%">Inprocess loss qty</th>
        
        </tr>
        </thead><tbody>';
         $total = sizeof($getQty);     
         if($total !=0){
             	$rc=1;
		foreach($getQty as $row)
			{
			    
			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
			 $operD=$this->GetQueryModel->getOperation($row['op_id']);
			 $RecQtyDetails  = $this->GetQueryModel->getReceivredQtyById($row['id']);
			
			 $calqtyNum="calculateRCIRQty(this.value,'num',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 $calqtyKgs="calculateRCIRQty(this.value,'kgs',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 
			$bal_qty = $row['ordered_qty'] - $RecQtyDetails['rec_qty']-$RecQtyDetails['loss_qty'];
			if($bal_qty==0){ continue;}
			 	echo '<tr>';
			 		 	//$kgs='calculateQty(this.value,'.chr(34).'kgs'.chr(34).,1,"base_url('getPartOperationQty')")';
			 echo '<input type="hidden" name="dc_mast_id[]" value="'.$row['dc_mast_id'].'">';
			 echo '<input type="hidden" name="dc_det_id[]" value="'.$row['id'].'">';
			 echo '<input type="hidden" name="parts_po_det_id[]" value="'.$row['parts_po_det_id'].'">';
			 echo '<input type="hidden" id="op_id'.$row['id'].'" name="op_id[]" value="'.$row['op_id'].'">';
			 echo '<input type="hidden" name="ordered_qty[]" value="'.$row['ordered_qty'].'">';
			 echo '<input type="hidden" name="rec_qty[]" value="'.$RecQtyDetails['rec_qty'].'">';
			 echo '<input type="hidden" id="bal_qty'.$row['id'].'" value="'.$bal_qty.'">';
			 echo '<input type="hidden" id="part_id'.$row['id'].'" name="part_id[]" value="'.$row['part_id'].'">';
		
           echo '<td > 
            <input name="checkboxVal[]" type="checkbox" value="'.$row['id'].'" id="checkbox'.$row['id'].'">
            </td>
            <td > '.$row['dc_mast_id']." - ".$row['id'].' </td>
            <td > '.date("d-m-Y",strtotime($row['date'])).' </td>
            <td > '.$partD['part_id']." - ".$partD['partno']." - ".$partD['name'].' </td>
            <td > '.$operD['name'].' </td>
            <td > '.$row['ordered_qty'].' </td>
            <td > '.($RecQtyDetails['rec_qty']+$RecQtyDetails['loss_qty']).' </td>
            <td > '.$bal_qty.' </td>
             <td > 
            <input class="form-control allpart'.$row['part_id'].'" id="rcir_qty'.$row['id'].'" name="rcir_qty[]" type="text" placeholder="Qty In Nos"  onkeyup="'.$calqtyNum.'" onfocusout="showTotal('.$row['part_id'].')">
            <div id="editqtyExit'.$row['id'].'" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
            </td>
            <td > 
            <input id="qty_in_kgs'.$row['id'].'" name="qty_in_kgs[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs" onkeyup="'.$calqtyKgs.'">
            </td>
           
            <td > 
            <input id="inproess_loss_qty'.$row['id'].'" name="inproess_loss_qty[]" type="text" class="form-control allpart'.$row['part_id'].'" placeholder="Loss Qty" onkeyup="editcheckRCIRQty('.$row['id'].')" onfocusout="showTotal('.$row['part_id'].','.$row['id'].')">
            </td>
            </tr>';
			
              $rc++;                      
			 }
			 if($rc==1){
			     echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
         }
			 echo '</thead></table><br>'; 
			 if(!empty($dcPartID)){
			 echo '<table>';
			 echo '<tr><th>Part No</th><th>Total Value</th><tr>';
			 foreach($dcPartID as $pid){ 
			     
			    echo '<tr><td>'.$pid['part_id']." - ".$pid['partno']." - ".$pid['pname'].'<input class="form-control" type="hidden" name="partIDrec[]" value="'.$pid['part_id'].'"></td><td><input class="form-control" type="text" id="partrecQty'.$pid['part_id'].'" name="partrecQty[]" value=""></td></tr>' ;
			 }
			 	echo '</table>';
			 }
			echo '<br><div class="col-12" >';
			 if($MastId=='')
			 {
            echo '<button type="submit" class="btn btn-primary" >Add</button>&nbsp;&nbsp;';
			 }else
			 {
            echo '<button type="submit" class="btn btn-primary" >Update</button>&nbsp;&nbsp;';
			 }
            echo '<a href="/viewDCOperation"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
            </div>
			 ';
	    }
	}

	public function deleteLabourDetails()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->LabourPoModel->deleteLabourDetails($postDate);
	}

	public function getDCListBySuppId()
	{
	    $Supp_Id      =$_POST['Supp_Id'];
		$selectedId   =$_POST['selectedId'];
        $DCList		= $this->GetQueryModel->getDCListBySuppId($Supp_Id);
       
        echo '<option  value="">Choose DC No.</option>';
        foreach($DCList as $pt){ 
        $ids=$pt['id'];
        $dc_no=$pt['dc_no'];
        //$nameNNo=$partno.' - '.$name;
        
        if($selectedId !='')
        {
            $selected = 'selected';
        }else
        {
            $selected = '';
        }
        echo '<option value="'.$ids.'" '.$selected.'>'.$dc_no.'</option>';
        }
	}
	


}

?>