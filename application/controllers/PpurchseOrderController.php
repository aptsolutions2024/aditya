<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PpurchseOrderController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('PpurchseOrder/PpurchseOrderModel');
		$this->load->model('getQuery/GetQueryModel');
	}


	public function partsPurchseOrder()
	{
		$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();
		$this->load->view('PpurchseOrder/viewPurchseOrder',$data);
	}
	public function addPpurchesorder()
	{
		$id = base64_decode($_GET['ID']);
		$data['getSupplier']   = $this->GetQueryModel->getSupplier();
		$this->load->view('PpurchseOrder/addPpurchesorder',$data);
	}
	
	public function showSupplierSch()
	{
	    $this->form_validation->set_rules('supplierId', 'Supplier', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		    $supplierId = $_POST['supplierId'];
		    $data['getPartsPO'] = $this->GetQueryModel->GetTranScheduleParts($supplierId);
		    $this->load->view('PpurchseOrder/addPpurchesorder',$data);
		}else
		 {
			$this->addPpurchesorder();
		}
	}
	
	public function createLabourPo()
	{
		//echo "<pre>";print_r($_POST);die;
	    $this->form_validation->set_rules('Supplier_Id', 'Supplier', 'trim|required');
		$this->form_validation->set_rules('labour_date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('labour_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_labourPO_id=$this->LabourPoModel->AddLOMast($postDate);

			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$part_remark			=$this->input->post('part_remark');
			$quantity			=$this->input->post('quantity');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');

			foreach($Part_Id as $key => $part_id)
			{
				$postDetails = array(
				'mast_labourPO_id' 	=> $mast_labourPO_id,
				'part_id' 			=> $part_id,
				'op_id' 			=> $op_id[$key],
				'part_remark' 		=> $part_remark[$key],
				'qty' 				=> $quantity[$key],
				'rate' 				=> $rate[$key],
				'uom' 				=> $unit[$key],
				'igst' 				=> $igst[$key],
				'cgst' 				=> $cgst[$key],
				'sgst' 				=> $sgst[$key],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);

				$result=$this->LabourPoModel->AddOPDetails($postDetails);
			}
			redirect('/labourPo');

		}else
		 {
			$data['getSupplier']   = $this->getQueryModel->getSupplier();
			$data['getPartName']   		= $this->getQueryModel->getPartName();
			$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
			$this->load->view('LabourPo/addLabourPo',$data);
		}
		
	}
	public function updateLabourPo()
	{
			$editId			=$this->input->post('editId');
			$labourPOId		=$this->input->post('labourPOId');
			$edit_part_remark=$this->input->post('edit_part_remark');
			$edit_quantity	=$this->input->post('edit_quantity');
			$edit_rate 		=$this->input->post('edit_rate');
			$edit_unit		=$this->input->post('edit_unit');
			$edit_igst		=$this->input->post('edit_igst');
			$edit_cgst		=$this->input->post('edit_cgst');
			$edit_sgst 		=$this->input->post('edit_sgst');

			foreach($labourPOId as $key => $mast_labourPO_id)
			{
				$updatepostDate = array(
				'part_remark' 	=> $edit_part_remark[$key],
				'qty' 	=> $edit_quantity[$key],
				'rate' => $edit_rate[$key],
				'uom' => $edit_unit[$key],
				'igst' => $edit_igst[$key],
				'cgst' => $edit_cgst[$key],
				'sgst' => $edit_sgst[$key],
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);

			$res=$this->LabourPoModel->UpdateLPODetails($updatepostDate,$mast_labourPO_id);
			}

			/*-------------Update labourpo_mast and insert labourpo_details-------------*/

			$postDate = array(
				'date' 				=> $this->input->post('labour_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->LabourPoModel->updateLOMast($postDate,$editId);

			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$quantity			=$this->input->post('quantity');
			$rate				=$this->input->post('rate');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');

			foreach($Part_Id as $key => $part_id)
			{
				if($part_id!='')
				{
					$postDetails = array(
					'mast_labourPO_id' 	=> $editId,
					'part_id' 			=> $part_id,
					'op_id' 			=> $op_id[$key],
					'qty' 				=> $quantity[$key],
					'rate' 				=> $rate[$key],
					'igst' 				=> $igst[$key],
					'cgst' 				=> $cgst[$key],
					'sgst' 				=> $sgst[$key],
					'created_by ' 		=> $_SESSION['id'],
					'created_on ' 		=> date("Y-m-d H:i:s"),
					);

					$result=$this->LabourPoModel->AddOPDetails($postDetails);
				}
			}



			
			
			
			redirect('/labourPo');
		
	}

	public function updateLabourPoDetails()
	{
		echo "<pre> - updateLabourPoDetails";print_r($_POST);die;
	}

	public function getOpByPartId()
	{
	    if(!empty($_POST))
	    {
	    $Part_Id 	=$this->input->post('Part_Id');
	    $Supplier_Id =$this->input->post('Supplier_Id');
		$getOpData  = $this->getQueryModel->getOperationByPart($Part_Id,$Supplier_Id);
		echo '<select class="form-control Part_Id" id="Part_Id" name="Part_Id[]" value="">';
			echo '<option value="">Select Operation</option>';
			foreach($getOpData as $list)
			{ 
			$ids=$list['id'];
			$name=$list['Name'];
			echo '<option value="'.$ids.'">'.$name.'</option>';
			 } 
		 echo '</select>';
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