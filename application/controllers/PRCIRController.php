<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PRCIRController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('PRCIR/PRCIRModel');
		$this->load->model('getQuery/GetQueryModel');
	}


	public function PartsRCIR()
	{
		$data['getPartRCIR'] = $this->GetQueryModel->getPartRCIR(3);
		$this->load->view('PartsRCIR/viewRCIR',$data);
	}
	public function addPartRCIR()
	{
	  
		$id = base64_decode($_GET['ID']);
		$data['Supplier']   = $this->GetQueryModel->getSupplier(3);
		$data['getPRCIRMast']   = $this->GetQueryModel->getPartRCIRMastByID($id);
		$data['getPartRCIRDetails']   = $this->GetQueryModel->getPartRCIRDetailsByID($id);
	
		$this->load->view('PartsRCIR/addPartRCIR',$data);
	}
	
	public function createPartRCIR()
	{
		// echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
            if(!empty($_POST['checkboxVal']))
		    {
		     
		        
			$postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_partsrcir_id  =  $this->PRCIRModel->AddTranRcirMast($postDate);
			
		    $this->updatePartRCIRStock($mast_partsrcir_id);
			
			redirect(base_url('PartsRCIR'));	

		}else
		 {
		    $this->session->set_flashdata('oamsg', 'Part RCIR Details should be mandatory!');
			$this->addPartRCIR();
		}
		    
		}else
		 {
			$this->addPartRCIR();
		}
		
	}
    public function updatePartRCIRStock($mast_partsrcir_id){
        
    			foreach ($_POST['checkboxVal'] as $key => $value) 
    			{
    			    $keys                   =  array_search($value,$_POST['supp_schedule_id'],true);
    			    $tran_partspo_det_id	= $_POST['tran_partspo_det_id'][$keys];
    			    $part_id	            = $_POST['part_id'][$keys];
    			    $supp_schedule_id	    = $_POST['supp_schedule_id'][$keys];
    			    $ordered_qty            = $_POST['ordered_qty'][$keys];
                    $rec_qty	            = $_POST['rec_qty'][$keys];
                    $bal_qty	            = $_POST['bal_qty'][$keys];
                    $qty_in_kgs             = $_POST['qty_in_kgs'][$keys];
                    $rcir_qty               = $_POST['rcir_qty'][$keys];
                   
                    $partPoDetails = $this->GetQueryModel->getpartPodetById($tran_partspo_det_id);
                  
                    $postDetails = array(
        				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        				'tran_partspo_det_id' 	=> $tran_partspo_det_id,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $partPoDetails['op_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'qty' 				    => $rcir_qty,
        				'qty_in_kgs' 		    => $qty_in_kgs,
        				'supp_schedule_id' 		=> $supp_schedule_id,
        				//'dc_det_id' 		    => $dc_det_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$det_partsrcir_id = $this->PRCIRModel->AddTranRcirDetails($postDetails);
				
				$postStockDetails = array(
        				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        				'det_partsrcir_id' 	    => $det_partsrcir_id,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $partPoDetails['op_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date'             => $this->input->post('date'),
        				'received_qty' 			=> $rcir_qty,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('supplierId'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'received_doc_type' 	=> 'p_rcir',
        				'received_doc_id' 	    => $det_partsrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);
        				
        		$x = $this->PRCIRModel->AddPTranRcirStock($postStockDetails);
        		//echo $x;
        			/*	$data = $this->GetQueryModel->GetScheduleProdPlanIdById($supp_schedule_id);
		
        		//echo $this->db->last_query(); 
				if($data['prod_plan_id'] > 0)
				{
				    	$postStockDetails = array(
        				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        				'det_partsrcir_id' 	    => $det_partsrcir_id,
        				'part_id' 			    => $part_id,
    					'op_id' 		        => $partPoDetails['op_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date'             => $this->input->post('date'),
        				'booked_qty' 			=> ($data['qty'] > $rcir_qty) ? $rcir_qty : $data['qty'],
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('supplierId'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'booked_doc_type' 	    => 'prod_plan',
        				'booked_doc_id' 	    => $data['prod_plan_id'],
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d")
        				);
        				
        	    	$this->PRCIRModel->AddPTranRcirStock($postStockDetails);
				    
				}*/
			
    			}
    }	
	public function updatePartRCIR()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
        
        $mast_edit_id	= $_POST['mast_edit_id'];
        
		if ($this->form_validation->run() == TRUE) {
		    
			$postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_partsrcir_id  =  $this->PRCIRModel->UpdateTranRcirMast($postDate,$mast_edit_id);
			
            if(!empty($_POST['checkboxVal']))
		    {
    		  $this->updatePartRCIRStock($mast_edit_id);
    		}
    		
    		$edit_id	= $_POST['edit_id'];
        
    		foreach($edit_id as $key =>$rows)
    		{
    		    $mast_partsrcir_id = $rows;
    		    $postUDetails = array(
        				'qty' 				    => $_POST['edit_Quantity'][$key],
        				'updated_by ' 		    => $_SESSION['id'],
        				'updated_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$this->PRCIRModel->UpdateTranRcirDetails($postUDetails,$mast_partsrcir_id);
    		}
    		
		redirect(base_url('PartsRCIR'));
		    
		}else
		 {
			$this->addPartRCIR();
		}
		
	}
	

	public function getRCIRQty()
	{
	      error_reporting(0);
	    if(!empty($_POST))
	    {
	    $supId 	=$this->input->post('supId');
	    $MastId 	=$this->input->post('MastId');
	    $getQty  = $this->GetQueryModel->getRCIRQty($supId);
	    
	  // print_r($getQty);
	    
	   echo '<h3>Part RCIR Details Add</h3> (Add New Items)';
    
        	echo '<table id="example" class="display dt-responsive overflow-auto" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th width="5%"></th>
        <th width="10%">Supp Sch. ID</th>
        <th width="10%">Sup Sch. Date</th>
        <th width="5%">Rec Branch</th>
        <th width="15%">Part Details</th>
        <th width="5%">Op Name</th>
        <th width="10%">Order Qty</th>
        <th width="10%">Rec. Qty till date</th>
        <th width="10%">Bal. Qty</th>
         <th width="10%">Qty in Nos</th>
        <th width="10%">Qty in Kgs</th>
       
        </tr>
        </thead><tbody>';
         $total = sizeof($getQty);     
         if($total !=0 && !empty($getQty)){
		foreach($getQty as $row)
			{ 
			   $rec_qty=0; 
			   $bal_qty=0;
		 	 $rec_qty  = $this->GetQueryModel->getPartsRecivedQty($row['id']);
		 	 $Bdata  = $this->GetQueryModel->getBranchbyId($row['branch_id']);
			 $bal_qty = $row['ordered_qty']-$rec_qty;
			   
			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
			 $operD  = $this->GetQueryModel->getOperation($row['op_id']);
			 
			 $calqtyNum="calculatePartRCIRQty(this.value,'num',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 $calqtyKgs="calculatePartRCIRQty(this.value,'kgs',".$row['id'].",'".base_url('getPartOperationQty')."')";
			 
			 echo '<input type="hidden" name="supp_schedule_id[]" value="'.$row['id'].'">';
			 echo '<input type="hidden" name="tran_partspo_det_id[]" value="'.$row['tran_partspo_det_id'].'">';
			 echo '<input type="hidden" id="op_id'.$row['id'].'" name="op_id[]" value="'.$row['op_id'].'">';
			 echo '<input type="hidden" name="ordered_qty[]" value="'.$row['ordered_qty'].'">';
		//	 echo '<input type="hidden" name="rec_qty[]" value="'.$row['rec_qty'].'">';
		//	 echo '<input type="hidden" name="bal_qty[]" id="bal_qty'.$row['id'].'" value="'.$row['bal_qty'].'">';
			 echo '<input type="hidden" name="rec_qty[]" value="'.$rec_qty.'">';
			 echo '<input type="hidden" name="bal_qty[]" id="bal_qty'.$row['id'].'" value="'.$bal_qty.'">';
		
			 echo '<input type="hidden" id="part_id'.$row['id'].'" name="part_id[]" value="'.$row['part_id'].'">';
			echo '<tr>
           <td > 
            <input name="checkboxVal[]" type="checkbox" value="'.$row['id'].'"  id="checkbox'.$row['id'].'">
            </td>
            <td > '.$row['id'].' </td>
            <td > '.$row['to_date'].' </td>
             <td > '.$Bdata['name'].' </td>
            <td > '.$partD['part_id']." - ".$partD['partno']." - ".$partD['name'].' </td>
            <td > '.$operD['name'].' </td>
            <td > '.$row['ordered_qty'].' </td>
            <td > '.$rec_qty.' </td>
            <td > '.($row['ordered_qty']-$rec_qty).' </td>
             <td > 
            <input id="rcir_qty'.$row['id'].'" name="rcir_qty[]" type="text" class="form-control" placeholder="Quantity"  onkeyup="'.$calqtyNum.'"  value="" onkeypress="return isDecimalNumber(event)">
            <div id="editqtyExit'.$row['id'].'" style="display:none;font-size: 13px;color: red;margin-top: 5px;">Invalid Qty</div>
            </td>
             <td > 
            <input id="qty_in_kgs'.$row['id'].'" name="qty_in_kgs[]" onkeypress="return isDecimalNumber(event)"  type="text" class="form-control" placeholder="Qty In kgs" onkeyup="'.$calqtyKgs.'">
            </td>
           
            </tr>';
			
                                    
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
         }
			 echo '</thead></table>
			 <br><div class="col-12" >';
			 if($MastId=='')
			 {
            echo '<button type="submit" class="btn btn-primary" >Add</button>&nbsp;&nbsp;';
			 }else
			 {
            echo '<button type="submit" class="btn btn-primary" >Update</button>&nbsp;&nbsp;';
			 }
            echo '<a href="/PartsRCIR"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
            </div>
			 ';
	    }
	}

	public function deleteBookedQty()
	{
	    $id = $_POST['id'];
	    $type = $_POST['type'];
		$postDate = array(
				'qty' => '0',
				'inprocess_loss_qty'=>'0',
				'isdeleted' => '1',
				);
		$postStockDate = array(
				'booked_qty' => '0',
				'received_qty' => '0',
				);
		$this->PRCIRModel->UpdateTranRcirDetails($postDate,$id);
		if($type =='DCOperation')
		{
		  $rec = $this->PRCIRModel->UpdateTranRcirStockDC($id);  
		}else
		{
		$rec = $this->PRCIRModel->UpdateTranRcirStock($id);
		}
		return true;
		
	}
	public function deleteLabourDetails()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->LabourPoModel->deleteLabourDetails($postDate);
	}

	


}

?>