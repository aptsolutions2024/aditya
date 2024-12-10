<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class QualityChecksController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('QualityChecks/QualityChecksModel');
	}


	public function qualityChecks()
	{
		$data['getQualityChecks'] = $this->QualityChecksModel->getQualityChecks();
		$this->load->view('QualityChecks/viewQualityChecks',$data);
	}
	public function addQualityChecks()
	{
		$id = base64_decode($_GET['ID']);
		$data['getQC'] = $this->QualityChecksModel->getQCById($id);
		$this->load->view('QualityChecks/addQualityChecks',$data);
	}
	public function createQualityChecks()
	{
	    //$this->session->unset_userdata('createRM');
	    $this->form_validation->set_rules('Quality_Name', 'quality name', 'trim|required');
		$this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('Quality_Type', 'quality type', 'trim|required');
		$this->form_validation->set_rules('inspection_stage', 'inspection stage', 'trim|required');
		$this->form_validation->set_rules('inspection_method', 'inspection method', 'trim|required');
		$this->form_validation->set_rules('numof_decimal', 'number of decimals', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'material' => $this->input->post('material'),
				'qc_type' => $this->input->post('Quality_Type'),
				'name' => $this->input->post('Quality_Name'),
				'inspection_stage' => $this->input->post('inspection_stage'),
				'inspection_method' => $this->input->post('inspection_method'),
				'numof_decimal' => $this->input->post('numof_decimal'),
				'created_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				);
			$res=$this->QualityChecksModel->AddQualityChecks($postDate);
			//$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/qualityChecks');

		}else
		 {
			$this->load->view('QualityChecks/addQualityChecks');
		}
		
	}
	public function updateQualityChecks()
	{
	    $this->form_validation->set_rules('Quality_Name', 'quality name', 'trim|required');
		$this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('inspection_stage', 'inspection stage', 'trim|required');
		$this->form_validation->set_rules('Quality_Type', 'quality type', 'trim|required');
		$this->form_validation->set_rules('inspection_stage', 'inspection stage', 'trim|required');
		$this->form_validation->set_rules('inspection_method', 'inspection method', 'trim|required');
		$this->form_validation->set_rules('numof_decimal', 'number of decimals', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'material' => $this->input->post('material'),
				'qc_type' => $this->input->post('Quality_Type'),
				'name' => $this->input->post('Quality_Name'),
				'inspection_stage' => $this->input->post('inspection_stage'),
				'inspection_method' => $this->input->post('inspection_method'),
				'numof_decimal' => $this->input->post('numof_decimal'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
			$editId=$this->input->post('editId');
			$res=$this->QualityChecksModel->updateQualityChecks($postDate,$editId);
			//$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/qualityChecks');

		}else
		 {
			$this->load->view('QualityChecks/addQualityChecks');
		}
		
	}
	public function deleteRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->QualityChecksModel->deleteQCRecord($postDate);
	}



}

?>