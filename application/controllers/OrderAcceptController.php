<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class OrderAcceptController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('OrderAccept/OrderAcceptModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function orderAcceptance()
	{
		$data['getOrderAccept'] = $this->getQueryModel->getOrderAcceptance();
		$this->load->view('OrderAccept/viewOrderAcceptance',$data);
	}
	public function addOrderAcceptance()
	{
		$id = base64_decode($_GET['ID']);
		$data['getOrdAccept'] 		= $this->getQueryModel->getOrdAcceptById($id);
		$data['getOADetailsById'] 	= $this->getQueryModel->getOADetailsById($id);
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$data['getPartName']   		= $this->getQueryModel->getPartName();
		$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$this->load->view('OrderAccept/addOrderAcceptance',$data);
	}
	public function getConsignee()
	{
		$custId 	=$this->input->post('custId');
		$custSelId 	=$this->input->post('custSelId');
		$getConsData  = $this->getQueryModel->getConsignee($custId);
		//print_r($getConsData);die;
		echo '<select class="form-control" id="consignee_id" name="consignee_id" value="">';
			echo '<option value="">Select Consignee</option>';
			foreach($getConsData as $list){ 
			$ids=$list['id'];
			$name=$list['name'];
			if($custSelId==$ids)
			{
				$selected="selected";
			}
			echo '<option value="'.$ids.'" '.$selected.'>'.$name.'</option>';
			 } 
		 echo '</select>';
	}
	public function createOrderAcceptance()
	{
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('cust_pono', 'pono', 'trim|required');
		$this->form_validation->set_rules('cust_podate', 'podate', 'trim|required');
		$this->form_validation->set_rules('labour_po', 'labour po', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
        
        $Part_Id			=$this->input->post('Part_Id');
		$quantity			=$this->input->post('quantity');
		$with_effect_from	=$this->input->post('with_effect_from');
		$rate				=$this->input->post('rate');
		$igst				=$this->input->post('igst');
		$cgst 				=$this->input->post('cgst');
		$sgst 				=$this->input->post('sgst');
		
		if ($this->form_validation->run() == TRUE) {
		    
		    if(!empty($Part_Id[0] && $quantity[0] && $with_effect_from[0] && $rate[0]))
		    {
		       $postDate = array(
    				'company_id' 		=> $_SESSION['id'],
    				'customer_id' 		=> $this->input->post('Customer_Id'),
    				'consignee_id' 		=> $this->input->post('Consignee_Id'),
    				'year'				=> $_SESSION['current_year'],
    				'cust_pono' 		=> $this->input->post('cust_pono'),
    				'cust_podate' 		=> $this->input->post('cust_podate'),
    				'labour_po' 		=> $this->input->post('labour_po'),
    				'amendment_details' => $this->input->post('amendment_details'),
    				'payment_terms' 	=> $this->input->post('payment_terms'),
    				'created_by ' 		=> $_SESSION['id'],
    				'created_on ' 		=> date("Y-m-d H:i:s"),
    				);
    			$mast_oa_id=$this->OrderAcceptModel->AddOAMast($postDate);
    
    			
    
    			foreach($Part_Id as $key => $part_id)
    			{
    			    if($part_id != '' && $quantity[$key] != '' && $rate[$key] != '' && $with_effect_from[$key] != '')
    			    {
        				$postDetails = array(
        				'mast_oa_id' 		=> $mast_oa_id,
        				'part_id' 			=> $part_id,
        				'qty' 				=> $quantity[$key],
        				'rate' 				=> $rate[$key],
        				'with_effect_from' 	=> $with_effect_from[$key],
        				'igst' 				=> $igst[$key],
        				'cgst' 				=> $cgst[$key],
        				'sgst' 				=> $sgst[$key],
        				'created_by ' 		=> $_SESSION['id'],
        				'created_on ' 		=> date("Y-m-d H:i:s"),
        				);
        
        				$result = $this->OrderAcceptModel->AddOADetails($postDetails);
        				
    			    }
    				
    			}
    			redirect('/orderAcceptance');
		    }
		    else{
		        $this->session->set_flashdata('oamsg', 'Order Acceptance Details should be mandatory!');
		        $this->addOrderAcceptance();
		    }
		    
		    }
		    else
    		 {
    			$data['getCustName'] 		= $this->getQueryModel->getCustName();
    			$data['getPartName']   		= $this->getQueryModel->getPartName();
    			$this->load->view('OrderAccept/addOrderAcceptance',$data);
    		}
		
	}
	public function updateOrderAcceptance()
	{
	    $this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('cust_pono', 'pono', 'trim|required');
		$this->form_validation->set_rules('cust_podate', 'podate', 'trim|required');
		$this->form_validation->set_rules('labour_po', 'labour po', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'customer_id'   => $this->input->post('Customer_Id'),
				'consignee_id'  => $this->input->post('Consignee_Id'),
				'year'          => $_SESSION['current_year'],
				'cust_pono'     => $this->input->post('cust_pono'),
				'cust_podate'   => $this->input->post('cust_podate'),
				'labour_po'     => $this->input->post('labour_po'),
				'amendment_details' => $this->input->post('amendment_details'),
				'payment_terms' => $this->input->post('payment_terms'),
				'updated_by '   => $_SESSION['id'],
				'updated_on '   => date("Y-m-d H:i:s"),
				);
			$mast_oa_id=$this->input->post('editId');
			$res=$this->OrderAcceptModel->updateOAMast($postDate,$mast_oa_id);

			$Part_Id			=$this->input->post('Part_Id');
			$quantity			=$this->input->post('quantity');
			$with_effect_from	=$this->input->post('with_effect_from');
			$rate				=$this->input->post('rate');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');

			$edit_Part_Id			=$this->input->post('edit_Part_Id');
			$edit_quantity			=$this->input->post('edit_quantity');
			$edit_with_effect_from	=$this->input->post('edit_with_effect_from');
			$edit_rate				=$this->input->post('edit_rate');
			$edit_igst				=$this->input->post('edit_igst');
			$edit_cgst 				=$this->input->post('edit_cgst');
			$edit_sgst 				=$this->input->post('edit_sgst');
			$editOADID				=$this->input->post('editOADID');

			foreach($Part_Id as $key => $part_id)
			{
				if($part_id!='')
			 	{
			 	  
				$postDetails = array(
				'mast_oa_id' 		=> $mast_oa_id,
				'part_id' 			=> $part_id,
				'qty' 				=> $quantity[$key],
				'rate' 				=> $rate[$key],
				'with_effect_from' 	=> $with_effect_from[$key],
				'igst' 				=> $igst[$key],
				'cgst' 				=> $cgst[$key],
				'sgst' 				=> $sgst[$key],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);

                    
                    $this->OrderAcceptModel->AddOADetails($postDetails);
                    
				}
			}

			foreach($edit_Part_Id as $key => $edit_part_id)
			{
				$editpostDetails = array(
				'mast_oa_id' 		=> $mast_oa_id,
				'part_id' 			=> $edit_part_id,
				'qty' 				=> $edit_quantity[$key],
				'rate' 				=> $edit_rate[$key],
				'with_effect_from' 	=> $edit_with_effect_from[$key],
				'igst' 				=> $edit_igst[$key],
				'cgst' 				=> $edit_cgst[$key],
				'sgst' 				=> $edit_sgst[$key],
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);

				$result=$this->OrderAcceptModel->updateOADetails($editpostDetails,$editOADID[$key]);
			}
			

			redirect('/orderAcceptance');

		}else
		 {
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			$data['getPartName']   		= $this->getQueryModel->getPartName();
			$this->load->view('OrderAccept/addOrderAcceptance',$data);
		}
		
	}
	public function deleteOARecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->OrderAcceptModel->deleteOARecord($postDate);
	}
	
	
	public function checkPono()
	{
		 $data = $this->OrderAcceptModel->checkPono();
		echo $id = $data['id'];
	}
	public function checkPartExit()
	{
	    $partId = $_POST['val'];
	    $custId = $_POST['custId'];
		echo $data = $this->getQueryModel->checkOA($partId,$custId);
	}



}

?>