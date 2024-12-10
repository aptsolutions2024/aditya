<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class MachineController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Machines/MachineModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function viewMachine()
	{
		$data['getMachinesData'] = $this->getQueryModel->getMachinesData();
		$this->load->view('Machines/viewMachine',$data);
	}
	public function addMachine()
	{
		$id = base64_decode($_GET['ID']);
		$data['getMachineById']  = $this->getQueryModel->getMachineById($id);
		$data['getBranch'] 		= $this->getQueryModel->getBranch();
		$this->load->view('Machines/addMachine',$data);
	}
	
	public function createMachine()
	{
		//echo "<pre>";print_r($_POST);die;
	    $this->form_validation->set_rules('machine_name', 'machine name', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'name' 		=> $this->input->post('machine_name'),
				'branch_id' 	=> $this->input->post('branch_id'),
				'type'				=> $this->input->post('type'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->MachineModel->AddMachine($postDate);

			
			redirect('/viewMachine');

		}else
		 {
			$this->addMachine();
		}
		
	}
	public function updateMachine()
	{
		$editId			=$this->input->post('editId');
		$this->form_validation->set_rules('machine_name', 'machine name', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'name' 		=> $this->input->post('machine_name'),
				'branch_id' 	=> $this->input->post('branch_id'),
				'type'				=> $this->input->post('type'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->MachineModel->updateMachine($postDate,$editId);

			
			redirect('/viewMachine');

		}else
		 {
			$this->addMachine();
		}
		
	}

	
}

?>