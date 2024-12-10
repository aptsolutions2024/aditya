<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ConsumableController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('Schedule/ScheduleModel');
		$this->load->model('getQuery/getQueryModel');
		$this->load->model('Consumable/ConsumableModel');
	}


	public function ConsumablesPO()
	{
		$data['getConsumpoPo'] = $this->getQueryModel->getConsumpoPo();
		$this->load->view('ConsumablesPo/view',$data);
	}
	public function addConsumablesPo()
	{
		$id = base64_decode($_GET['ID']);
		$data['getSupplier']   = $this->getQueryModel->getSupplier(4);
		$data['getPartName']   		= $this->getQueryModel->getPartName();
		$data['getConsumpo'] 	    = $this->getQueryModel->getConsumpoById($id);
		$data['getConsumpoDetails']  = $this->getQueryModel->getConsumpoDetails($id);
		$this->load->view('ConsumablesPo/add',$data);
	}
	
    public function consPOPrint()
	{
		$id = base64_decode($_GET['ID']);
		 $data['companyDetails']     = $this->getQueryModel->companyDetails();
		$data['getOtherpo'] 	    = $this->getQueryModel->getConsumablepoById($id);
		$data['getOtherpoDetails']  = $this->getQueryModel->getConsumablepoDetails($id);
		$this->load->view('ConsumablesPo/consPOPrint',$data);
	}
	public function createConsumablesPo()
	{
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('Supplier_Id', 'Supplier', 'trim|required');
		$this->form_validation->set_rules('Other_date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
		$Description		=$this->input->post('Description');
		$part_remark		=$this->input->post('part_remark');
		$quantity			=$this->input->post('quantity');
		$rate				=$this->input->post('rate');
		$unit				=$this->input->post('Unit');
		$igst				=$this->input->post('igst');
		$cgst 				=$this->input->post('cgst');
		$sgst 				=$this->input->post('sgst');

		if ($this->form_validation->run() == TRUE) {
		    
		    if(!empty($Description[0] && $part_remark[0] && $quantity[0] && $rate[0] && $unit[0]))
		    {

			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('Other_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_consumpo_id = $this->ConsumableModel->AddCPOMast($postDate);

			

			foreach($Description as $key => $desc)
			{
				$postDetails = array(
				'mast_consumpo_id' 	=> $mast_consumpo_id,
				'description' 		=> $desc,
				'remarks' 		    => $part_remark[$key],
				'qty' 				=> $quantity[$key],
				'rate' 				=> $rate[$key],
				'uom' 				=> $unit[$key],
				'igst' 				=> $igst[$key],
				'cgst' 				=> $cgst[$key],
				'sgst' 				=> $sgst[$key],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);

				$result=$this->ConsumableModel->AddCPODetails($postDetails);
			}
			redirect('/ConsumablesPO');

		}
		
        else{
            $this->session->set_flashdata('oamsg', 'Consumables Purchase Order should be mandatory!');
            $this->addConsumablesPo();
            }
        }
        else
        {
            $this->addConsumablesPo();
        }
		  
		
	}
	public function updateConsumablesPo()
	{
	    //echo "<pre>";print_r($_POST);die;
			$editId			=$this->input->post('editId');
			$ConsumPOId		=$this->input->post('ConsumPOId');
			$edit_Description=$this->input->post('edit_Description');
			$edit_part_remark=$this->input->post('edit_part_remark');
			$edit_quantity	=$this->input->post('edit_quantity');
			$edit_rate 		=$this->input->post('edit_rate');
			$edit_unit		=$this->input->post('edit_unit');
			$edit_igst		=$this->input->post('edit_igst');
			$edit_cgst		=$this->input->post('edit_cgst');
			$edit_sgst 		=$this->input->post('edit_sgst');

			foreach($ConsumPOId as $key => $mast_consumpo_id)
			{
				$updatepostDate = array(
				'description' 	=> $edit_Description[$key],
				'remarks' 	=> $edit_part_remark[$key],
				'qty' 	=> $edit_quantity[$key],
				'rate' => $edit_rate[$key],
				'uom' => $edit_unit[$key],
				'igst' => $edit_igst[$key],
				'cgst' => $edit_cgst[$key],
				'sgst' => $edit_sgst[$key],
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d"),
				);

			$res=$this->ConsumableModel->UpdateCPODetails($updatepostDate,$mast_consumpo_id);
			}

			/*-------------Update Otherpo_mast and insert Otherpo_details-------------*/

			$postDate = array(
				'date' 				=> $this->input->post('Other_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d"),
				);
			$this->ConsumableModel->updateCOMast($postDate,$editId);

			$Description		=$this->input->post('Description');
		    $part_remark		=$this->input->post('part_remark');
			$quantity			=$this->input->post('quantity');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');

			foreach($Description as $key => $desc)
			{
			    if($desc !='' )
			    {
				$postDetails = array(
				'mast_consumpo_id' 	=> $editId,
				'description' 		=> $desc,
				'remarks' 		    => $part_remark[$key],
				'qty' 				=> $quantity[$key],
				'rate' 				=> $rate[$key],
				'uom' 				=> $unit[$key],
				'igst' 				=> $igst[$key],
				'cgst' 				=> $cgst[$key],
				'sgst' 				=> $sgst[$key],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);

				$result=$this->ConsumableModel->AddCPODetails($postDetails);
			}
			}
			
			redirect('/ConsumablesPO');
		
	}



	public function deleteConsumDetails()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->ConsumableModel->deleteConsumDetails($postDate);
	}
	

}

?>