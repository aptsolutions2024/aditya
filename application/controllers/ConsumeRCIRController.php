<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ConsumeRCIRController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ConsumRCIR/ConsumeRCIRModel');
		$this->load->model('getQuery/GetQueryModel');
	}


	public function ConsumeRCIR()
	{
		$data['getPartRCIR'] = $this->GetQueryModel->getPartRCIR(4);
		$this->load->view('ConsumeRCIR/view',$data);
	}


	public function addConsumablesRCIR()
	{
		$id = base64_decode($_GET['ID']);
		$data['Supplier']   = $this->GetQueryModel->getSupplier(4);
		$data['getConsumpoDetailsBySupl'] = $this->GetQueryModel->getConsumpoDetailsBySupl(14);
		$this->load->view('ConsumeRCIR/add',$data);
	}
	
	public function createConsumRCIR()
	{
		//echo "<pre>";print_r($_POST);die;
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
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d"),
				);
			$mast_conrcir_id  =  $this->ConsumeRCIRModel->AddTranConRcirMast($postDate);
			
			
    			foreach ($_POST['checkboxVal'] as $key => $value) 
    			{
    			    $keys       =  array_search($value,$_POST['part_id'],true);
    			    $tran_conpo_det_id	= $_POST['tran_conpo_det_id'][$keys];
    			    $qty= $_POST['qty'][$keys];
                    
                    
                  /*  `id`, `mast_conrcir_id`, `tran_conpo_det_id`, `year`, `qty`, `qc_checked_by`,
                    `qc_checked_on`, `accepted_qty`, `qc_remarks`, `isdeleted`, `created_by`, `created_on`, `updated_by`, `updated_on`
                  */  
                    $postDetails = array(
        				'mast_conrcir_id' 	    => $mast_conrcir_id,
        				'tran_conpo_det_id' 	=> $tran_conpo_det_id,
        				'year' 				    => $_SESSION['current_year'],
        				'qty' 				    => $rcir_qty,
        				/*'qc_checked_by' 		=> '',
        				'qc_checked_on' 		=> '',
        				'accepted_qty' 			=> '',
        				'qc_remarks' 			=> '',*/
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d"),
        				);

				$this->PRCIRModel->AddTranConRcirDetails($postDetails);
				
    			}
		    
			
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
	

	public function getRCIRQty()
	{
	    if(!empty($_POST))
	    {
	    $supId 	=$this->input->post('supId');
	    $getQty  = $this->GetQueryModel->getRCIRQty($supId);
	    
	    //print_r($getQty);die;
	    
	   echo '<h3>Part RCIR Details Add</h3> (Add New Items)';
    
        	echo '<table id="example" class="display dt-responsive overflow-auto" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th width="5%"></th>
        <th width="10%">Part ID</th>
        <th width="15%">Part No.</th>
        <th width="20%">Part Name</th>
        <th width="10%">Order Qty</th>
        <th width="10%">Rec. Qty till date</th>
        <th width="10%">Bal. Qty</th>
        <th width="20%">Rec. Qty</th>
        </tr>
        </thead><tbody>';
         $total = sizeof($getQty);     
         if($total !=0){
		foreach($getQty as $row)
			{ 
			 $partD  = $this->GetQueryModel->getPartsById($row['part_id']);
			 echo '<input type="hidden" name="supp_schedule_id[]" value="'.$row['id'].'">';
			 echo '<input type="hidden" name="tran_partspo_det_id[]" value="'.$row['tran_partspo_det_id'].'">';
			 echo '<input type="hidden" name="op_id[]" value="'.$row['op_id'].'">';
			 echo '<input type="hidden" name="ordered_qty[]" value="'.$row['ordered_qty'].'">';
			 echo '<input type="hidden" name="rec_qty[]" value="'.$row['rec_qty'].'">';
			 echo '<input type="hidden" name="bal_qty[]" value="'.$row['bal_qty'].'">';
			 echo '<input type="hidden" name="part_id[]" value="'.$row['part_id'].'">';
			echo '<tr>
           <td > 
            <input name="checkboxVal[]" type="checkbox" value="'.$row['part_id'].'">
            </td>
            <td > '.$partD['part_id'].' </td>
            <td > '.$partD['partno'].' </td>
            <td > '.$partD['name'].' </td>
            <td > '.$row['ordered_qty'].' </td>
            <td > '.$row['rec_qty'].' </td>
            <td > '.$row['bal_qty'].' </td>
            
            <td > 
            <input id="rcir_qty'.$row['part_id'].'" name="rcir_qty[]" type="text" class="form-control" placeholder="Quantity" >
            </td>
            </tr>';
			
                                    
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">Not Part RCIR found.</td></tr>';
         }
			 echo '</thead></table>
			 <br><div class="col-12" >
            <button type="submit" class="btn btn-primary" >Add</button>
            <a href="/PartsRCIR"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
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
	


}

?>