<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class OtherPoController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('OtherPo/OtherPoModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function OtherPo()
	{
		$data['getOtherPo'] = $this->getQueryModel->getOtherPo();
		$this->load->view('OtherPo/viewOtherPo',$data);
	}
	public function addOtherPo()
	{
		$id = base64_decode($_GET['ID']);
		$type="2,3";
		$data['getSupplier']   = $this->getQueryModel->getSupplier($type);
		$data['getPartName']   		= $this->getQueryModel->getPartName();
	//	$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getOtherpo'] 	    = $this->getQueryModel->getOtherpoById($id);
		$data['getOtherpoDetails']  = $this->getQueryModel->getOtherpoDetails($id);
		$this->load->view('OtherPo/addOtherPo',$data);
	}
	public function partPOPrint()
	{
		$id = base64_decode($_GET['ID']);
		 $data['companyDetails']     = $this->getQueryModel->companyDetails();
		$data['getOtherpo'] 	    = $this->getQueryModel->getOtherpoById($id);
		$data['getOtherpoDetails']  = $this->getQueryModel->getOtherpoDetails($id);
		$this->load->view('OtherPo/partPOPrint',$data);
	}
	
	public function createOtherPo()
	{
	    
		//echo "<pre> insert";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('Supplier_Id', 'Supplier_id', 'trim|required');
		$this->form_validation->set_rules('Other_date', 'Other_date', 'trim|required');
        $this->form_validation->set_rules('Op_Id[]', 'Operation', 'trim|required');
        $this->form_validation->set_rules('Part_Search[]', 'Part Name', 'trim|required');
        $this->form_validation->set_rules('Part_Id[]', 'Part_Id', 'trim|required');
        $this->form_validation->set_rules('rate[]', 'Rate', 'trim|required');
        $this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|required');
         $this->form_validation->set_rules('Unit[]', 'Unit', 'trim|required');
        
        
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('Other_date'),
				'wef_date' 			=> $this->input->post('wef_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_partspo_id=$this->OtherPoModel->AddLOMast($postDate);

			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$part_remark			=$this->input->post('part_remark');
			$quantity			=$this->input->post('quantity');
			//$qty_in_kgs         =$this->input->post('qty_in_kgs');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');

			foreach($Part_Id as $key => $part_id)
			{
				$postDetails = array(
				'mast_partspo_id' 	=> $mast_partspo_id,
				'part_id' 			=> $part_id,
				'op_id' 			=> $op_id[$key],
				'part_remark' 		=> $part_remark[$key],
				'qty' 				=> $quantity[$key],
				//'qty_in_kgs' 		=> $qty_in_kgs[$key],
				'rate' 				=> $rate[$key],
				'uom' 				=> $unit[$key],
				'igst' 				=> $igst[$key],
				'cgst' 				=> $cgst[$key],
				'sgst' 				=> $sgst[$key],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);

				$result=$this->OtherPoModel->AddOPDetails($postDetails);
			}
			redirect('/OtherPo');

		}else
		 {
		      $this->session->set_flashdata('oamsg', 'Please Enter All Fields..!');
			$this->addOtherPo();
// 			$data['getSupplier']   = $this->getQueryModel->getSupplier();
// 			$data['getPartName']   		= $this->getQueryModel->getPartName();
// 			$this->load->view('OtherPo/addOtherPo',$data);
		}
		
	}
	public function updateOtherPo()
	{
	     //echo "<pre> update";print_r($_POST);die;
			$editId			=$this->input->post('editId');
			$OtherPOId		=$this->input->post('OtherPOId');
			$edit_part_remark=$this->input->post('edit_part_remark');
			$edit_quantity	=$this->input->post('edit_quantity');
			$edit_qty_in_kgs	=$this->input->post('edit_qty_in_kgs');
			$edit_rate 		=$this->input->post('edit_rate');
			$edit_unit		=$this->input->post('edit_unit');
			$edit_igst		=$this->input->post('edit_igst');
			$edit_cgst		=$this->input->post('edit_cgst');
			$edit_sgst 		=$this->input->post('edit_sgst');
 // print_r($OtherPOId); print_r($edit_unit);die;
			foreach($OtherPOId as $key => $mast_partspo_id)
			{
				$updatepostDate = array(
				'part_remark' 	=> $edit_part_remark[$key],
				'qty' 	=> $edit_quantity[$key],
				'qty_in_kgs'=>$edit_qty_in_kgs[$key],
				'rate' => $edit_rate[$key],
				'uom' => $edit_unit[$key],
				'igst' => $edit_igst[$key],
				'cgst' => $edit_cgst[$key],
				'sgst' => $edit_sgst[$key],
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);

			$res=$this->OtherPoModel->UpdateLPODetails($updatepostDate,$mast_partspo_id);
			}

			/*-------------Update Otherpo_mast and insert Otherpo_details-------------*/

			$postDate = array(
				'date' 				=> $this->input->post('Other_date'),
				'wef_date' 			=> $this->input->post('wef_date'),
				'year'				=> $_SESSION['current_year'],
				'remarks' 			=> $this->input->post('Remark'),
				'payment_terms' 	=> $this->input->post('payment_terms'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->OtherPoModel->updateLOMast($postDate,$editId);

			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$quantity			=$this->input->post('quantity');
		//	$qty_in_kgs         =$this->input->post('qty_in_kgs');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');
			$part_remark        =$this->input->post('part_remark');

			foreach($Part_Id as $key => $part_id)
			{
				if($part_id!='')
				{
					$postDetails = array(
					'mast_partspo_id' 	=> $editId,
					'part_id' 			=> $part_id,
					'op_id' 			=> $op_id[$key],
					'qty' 				=> $quantity[$key],
				//	'qty_in_kgs' 		=> $qty_in_kgs[$key],
			      	'part_remark'      =>$part_remark[$key],
					'rate' 				=> $rate[$key],
					'uom' 				=> $unit[$key],
					'igst' 				=> $igst[$key],
					'cgst' 				=> $cgst[$key],
					'sgst' 				=> $sgst[$key],
					'created_by ' 		=> $_SESSION['id'],
					'created_on ' 		=> date("Y-m-d H:i:s"),
					);

					$result=$this->OtherPoModel->AddOPDetails($postDetails);
				}
			}			
			
			
			redirect('/OtherPo');
	}

	public function updateOtherPoDetails()
	{
		echo "<pre> - updateOtherPoDetails";print_r($_POST);die;
	}

	public function getOpByPartId()
	{
	    if(!empty($_POST))
	    {
	    $Part_Id 	=$this->input->post('Part_Id');
	    $Supplier_Id =$this->input->post('Supplier_Id');
		$getOpData  = $this->getQueryModel->getOperationByPart($Part_Id,$Supplier_Id);
		//echo '<select class="form-control Part_Id" id="Part_Id" name="Part_Id[]" value="">';
			echo '<option value="">Operation</option>';
			foreach($getOpData as $list)
			{ 
			$ids=$list['id'];
			$name=$list['Name'];
			$sequence_no=$list['sequence_no'];
			echo '<option value="'.$ids.'" data-id="'.$sequence_no.'">'.$name.'</option>';
			 } 
		 //echo '</select>';
	    }
	}

	public function deleteOtherDetails()
	{
		$postDate = array(
				'isdeleted' => '1',
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
		$data = $this->OtherPoModel->deleteOtherDetails($postDate);
	}
	public function getPartOpQty(){ 
	
	$data  = $this->getQueryModel->getPartOpQty();
	//print_r($data);die;
   
	if(!empty($data['nosperkg'])){

     $qty = $data['nosperkg'];
     echo $qty;

	}
	
   }

	public function getPrevPartOperationQty(){ 
	
	$data  = $this->getQueryModel->getPrevPartOperationQty();
	//print_r($data);die;
   
	if(!empty($data['nosperkg'])){

     $qty = $data['nosperkg'];
     echo $qty;

	}
	
   }
}

?>