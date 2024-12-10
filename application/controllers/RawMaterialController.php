<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class RawMaterialController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('RawMaterial/RawMaterialModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function rawMaterial()
	{
		$data['getRawMaterial'] = $this->getQueryModel->getRawMaterial();
		$this->load->view('RawMaterial/viewRawMaterial',$data);
	}
	public function addrawMaterial()
	{
		$id = base64_decode($_GET['ID']);
		$data['getrm'] = $this->getQueryModel->getrmById($id);
		$data['getrmId'] = $this->getQueryModel->getrmId();
		$this->load->view('RawMaterial/addrawMaterial',$data);
	}
	public function createRawMaterial()
	{
	    $this->session->unset_userdata('createRM');
	    $this->form_validation->set_rules('Material_Name', 'material name', 'trim|required');
		$this->form_validation->set_rules('txtLength', 'length', 'trim|required');
		$this->form_validation->set_rules('txtWidth', 'width', 'trim|required');
		$this->form_validation->set_rules('txtThickness', 'thickness', 'trim|required');
		$this->form_validation->set_rules('txtUnit', 'unit', 'trim|required');
		$this->form_validation->set_rules('txtReOrderQuantity', 'order quantity', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('grade', 'grade', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'type' => $this->input->post('type'),
				'grade' => $this->input->post('grade'),
				'name' => $this->input->post('Material_Name'),
				'length' => $this->input->post('txtLength'),
				'width' => $this->input->post('txtWidth'),
				'thickness' => $this->input->post('txtThickness'),
				'hardness' => $this->input->post('Hardness'),
				'uom ' => $this->input->post('txtUnit'),
				'hsnCode ' => $this->input->post('txtHSNCode'),
				'reorderQty ' => $this->input->post('txtReOrderQuantity'),
				'remarks ' => $this->input->post('remarks'),
				'created_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				);
			$res=$this->RawMaterialModel->AddRawMaterial($postDate);
			$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/rawMaterial');

		}else
		 {
			$data['getrmId'] = $this->getQueryModel->getrmId();
		   $this->load->view('RawMaterial/addrawMaterial',$data);
		}
		
	}
	public function updateRawMaterial()
	{
	    $this->session->unset_userdata('createRM');
	    $this->form_validation->set_rules('Material_Name', 'material name', 'trim|required');
		$this->form_validation->set_rules('txtLength', 'length', 'trim|required');
		$this->form_validation->set_rules('txtWidth', 'width', 'trim|required');
		$this->form_validation->set_rules('txtThickness', 'thickness', 'trim|required');
		$this->form_validation->set_rules('txtUnit', 'unit', 'trim|required');
		$this->form_validation->set_rules('txtReOrderQuantity', 'order quantity', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('grade', 'grade', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'type' => $this->input->post('type'),
				'grade' => $this->input->post('grade'),
				'name' => $this->input->post('Material_Name'),
				'length' => $this->input->post('txtLength'),
				'width' => $this->input->post('txtWidth'),
				'thickness' => $this->input->post('txtThickness'),
				'hardness' => $this->input->post('Hardness'),
				'uom ' => $this->input->post('txtUnit'),
				'hsnCode ' => $this->input->post('txtHSNCode'),
				'reorderQty ' => $this->input->post('txtReOrderQuantity'),
				'remarks ' => $this->input->post('remarks'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
			$editId=$this->input->post('editId');
			$res=$this->RawMaterialModel->updateRawMaterial($postDate,$editId);
			//$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/rawMaterial');

		}else
		 {
			$data['getrmId'] = $this->getQueryModel->getrmId();
		    $this->load->view('RawMaterial/addrawMaterial',$data);
		}
		
	}
	public function deleteRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->RawMaterialModel->deleteRMRecord($postDate);
	}



}

?>