<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class OperationsController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Operations/OperationsModel');
		$this->load->model('getQuery/getQueryModel');
		$this->load->model('PRCIR/PRCIRModel');
	}


	public function operations()
	{
		$data['getOperations'] = $this->getQueryModel->getOperations();
		$this->load->view('Operations/viewOperations',$data);
	}
	public function addOperations()
	{
		$id = base64_decode($_GET['ID']);
		$data['getopts'] 		= $this->getQueryModel->getOperationsById($id);
		$data['getoptsGrups']   = $this->getQueryModel->getOperationsGroups();
		$this->load->view('Operations/addOperations',$data);
	}
	
	public function createOperations()
	{
	    $this->form_validation->set_rules('Operation_Name', 'operation name', 'trim|required');
		$this->form_validation->set_rules('Group_Id', 'group Id', 'trim|required');
		$this->form_validation->set_rules('Carried_Out', 'carried out', 'trim|required');
		$this->form_validation->set_rules('rmConsumption', 'rm Consumption', 'trim|required');
		$this->form_validation->set_rules('qc_requiredfor_dpr', 'qc required for dpr', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'op_group_id' => $this->input->post('Group_Id'),
				'Name' => $this->input->post('Operation_Name'),
				'carriedOut' => $this->input->post('Carried_Out'),
				'rmConsumption' => $this->input->post('rmConsumption'),
				'qc_requiredfor_dpr' => $this->input->post('qc_requiredfor_dpr'),
				'created_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				);
			$res=$this->OperationsModel->AddOperations($postDate);
			redirect('/operations');

		}else
		 {
			$data['getoptsGrups']   = $this->getQueryModel->getOperationsGroups();
			$this->load->view('Operations/addOperations',$data);
		}
		
	}
	public function updateOperations()
	{
	    $this->form_validation->set_rules('Operation_Name', 'operation name', 'trim|required');
		$this->form_validation->set_rules('Group_Id', 'group Id', 'trim|required');
		$this->form_validation->set_rules('Carried_Out', 'carried out', 'trim|required');
		$this->form_validation->set_rules('rmConsumption', 'rmConsumption', 'trim|required');
		$this->form_validation->set_rules('qc_requiredfor_dpr', 'qc required for dpr', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				'op_group_id' => $this->input->post('Group_Id'),
				'Name' => $this->input->post('Operation_Name'),
				'carriedOut' => $this->input->post('Carried_Out'),
				'rmConsumption' => $this->input->post('rmConsumption'),
				'qc_requiredfor_dpr' => $this->input->post('qc_requiredfor_dpr'),
				'created_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
			$editId=$this->input->post('editId');
			$res=$this->OperationsModel->UpdateOperations($postDate,$editId);
			redirect('/operations');

		}else
		 {
			$data['getoptsGrups']   = $this->getQueryModel->getOperationsGroups();
			$this->load->view('Operations/addOperations',$data);
		}
		
	}
	public function deleteOptsRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->OperationsModel->deleteOptsRecord($postDate);
	}
	public function getOperationsList()
	{
		$editpartId    =$this->input->post('editpartId');
		if($editpartId=='')
		{
			$getOperations = $this->getQueryModel->getOperations();
		}else
		{
			$getOperations = $this->getQueryModel->getOperationsNotforPart($editpartId);
		}
	    //echo "<pre>";print_r($getOperations);echo "</pre>";die;
		$total=sizeof($getOperations);
		if($total!=0){
		foreach($getOperations as $oprtation){ 
		 

		echo '<option value="'.$oprtation[id].'">'.$oprtation[groName]." - ".$oprtation[Name].'</option>';

		} } else{ 
		echo '<option>No Oprtation available.</option>';
			}
		
		 
	}
	public function getOperationsRList()
	{
		$editpartId    =$this->input->post('editpartId');
		$getOpeById = $this->getQueryModel->getOperationById($editpartId);
		
		
			$total=sizeof($getOpeById);
			if($total!=0){
			foreach($getOpeById as $oprtation){ 
			   
			    
			$getOpe 	= $this->getQueryModel->getOperationsById($oprtation['op_id']);
			
			    $op_group_id = $getOpe['op_group_id'];
			    
			    	$getOpGrp 	= $this->OperationsModel->getOperationsGroupsbyId($op_group_id); 
			    	
			    
			echo '<option value="'.$getOpe[id].'" selected>'.$getOpGrp[name]." - ".$getOpe[Name].'</option>';

			} } 
		 
	}


	//Updated code for Part Opening balance qty field and part search functionality
	public function partOperations()
	{
		$data['getParts'] 	= $this->getQueryModel->getParts();		
		$this->load->view('Operations/partOperations',$data);
	}

	public function createRelParts()
	{
		$this->form_validation->set_rules('part_id', 'part', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$data['getTools'] 	= $this->getQueryModel->getTools();
			$data['getRelPartsById'] 	= $this->getQueryModel->getRelPartsbyIdOBal();
			//$data['getParts'] 	= $this->getQueryModel->getPartslist();
			$this->load->view('Operations/partOperations',$data);
			
		}else
		 {
			$data['getTools'] 		= $this->getQueryModel->getTools();
			$data['getRelPartsById'] = $this->getQueryModel->getRelPartsbyIdOBal();
			//$data['getParts'] 	= $this->getQueryModel->getPartslist();
			$this->load->view('Operations/partOperations',$data);
		}
		
	}

	function updateReOpts()
	{
		$this->OperationsModel->updateReOpts();
	}



}

?>