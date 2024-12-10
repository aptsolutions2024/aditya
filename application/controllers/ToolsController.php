<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ToolsController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tools/ToolsModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function viewTools()
	{
		$data['getTools'] = $this->getQueryModel->getTools();
		$this->load->view('Tools/viewTools',$data);
	}
	public function addTools()
	{
		$id = base64_decode($_GET['ID']);
		$data['getTool'] = $this->getQueryModel->getToolById($id);
		$data['getBranch'] 	= $this->getQueryModel->getBranch();
		$this->load->view('Tools/addTools',$data);
	}
	
    public function deleteToolRecord(){
	     $id=$this->input->post('editId');
	     $res=$this->ToolsModel->deleteToolRec($id); 
    	return $res;
	}
	
	public function createTool()
	{
	    $this->form_validation->set_rules('Tool_Name', 'name', 'trim|required');
		$this->form_validation->set_rules('ideal_qty', 'ideal qty', 'trim|required');
		$this->form_validation->set_rules('grinding_freq', 'grinding_freq qty', 'trim|required');
		//$this->form_validation->set_rules('grinded_on', 'grind', 'trim|required');
		$this->form_validation->set_rules('owner_branch_id', 'owner branch', 'trim|required');
		$this->form_validation->set_rules('location_branch_id', 'location branch', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			 //$grinded_on=implode(",",$this->input->post('grinded_on'));
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'name' => $this->input->post('Tool_Name'),
				'ideal_qty' => $this->input->post('ideal_qty'),
				'grinding_frequency' => $this->input->post('grinding_freq'),
				//'grinded_on' => $grinded_on,
				'owner_branch_id' => $this->input->post('owner_branch_id'),
				'location_branch_id' => $this->input->post('location_branch_id'),
				'remarks' => $this->input->post('remark'),
				'ob' => $this->input->post('ob'),
				'created_by ' => $_SESSION['id'],
				'created_on'  => date("Y-m-d H:i:s"),
				);
			$res=$this->ToolsModel->addTool($postDate);
			redirect('/tools');

		}else
		 {
			$data['getBranch'] 	= $this->getQueryModel->getBranch();
			$this->load->view('Tools/addTools',$data);
		}
		
	}
	public function updateTool()
	{
	       $this->session->unset_userdata('createS');
	    $this->form_validation->set_rules('Tool_Name', 'name', 'trim|required');
		$this->form_validation->set_rules('ideal_qty', 'ideal qty', 'trim|required');
		$this->form_validation->set_rules('grinding_freq', 'grinding_freq qty', 'trim|required');
		//$this->form_validation->set_rules('grinded_on', 'grind', 'trim|required');
		$this->form_validation->set_rules('owner_branch_id', 'owner branch', 'trim|required');
		$this->form_validation->set_rules('location_branch_id', 'location branch', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
      	$editId=$this->input->post('editId');
		if ($this->form_validation->run() == TRUE) {
			// $grinded_on=implode(",",$this->input->post('grinded_on'));
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'name' => $this->input->post('Tool_Name'),
				'ideal_qty' => $this->input->post('ideal_qty'),
				//'grinded_on' => $grinded_on,
				'grinding_frequency' => $this->input->post('grinding_freq'),
				'owner_branch_id' => $this->input->post('owner_branch_id'),
				'location_branch_id' => $this->input->post('location_branch_id'),
				'remarks' => $this->input->post('remark'),
				'ob' => $this->input->post('ob'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
		
			$res=$this->ToolsModel->updateTool($postDate,$editId);
			//redirect('/tools');
				if($res){
		         	$this->session->set_flashdata('createS', 'You have updated tool successfully.');
    			}else{
    			     $this->session->set_flashdata('createS', 'Something wrong happened while updating record.'); 
    			}

		}else
		 {
	       $this->session->set_flashdata('createS', 'Please fill all mandatory field first.'); 
			//$data['getBranch'] 	= $this->getQueryModel->getBranch();
			//$this->load->view('Tools/addTools',$data);
		}
	   redirect('/addTools?ID='. base64_encode($editId)); 	
	}
	public function viewTrantool(){
	    	$data['getToollife'] 	= $this->getQueryModel->getTrantool();
        	$data['getTools'] 	= $this->getQueryModel->getTools();
			$this->load->view('Tools/viewTrantool',$data);
	}
    public function addTrantool(){
            $id = base64_decode($_GET['ID']);
        	$data['getToollife'] 	= $this->getQueryModel->getTrantoolbyID($id);
            $data['getTools'] = $this->getQueryModel->getTools();
			$this->load->view('Tools/addTrantool',$data);
    }
    
    public function createTrantool()
	{
	    	//print_r($_POST);exit;
	    $this->session->unset_userdata('createS');
	    $this->form_validation->set_rules('Tool_Name', 'Tool_Name', 'trim|required');
		//$this->form_validation->set_rules('grinded_on', 'grinded_on', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
			    'tool_id'            =>$this->input->post('Tool_Name'),
				'grinded_on'         => $this->input->post('grinded_on'),
			  	'type'               => $this->input->post('type'),
				'remark'             => $this->input->post('remark'),
				'created_by '        => $_SESSION['id'],
				'created_on'         => date("Y-m-d H:i:s"),
				);
			$res=$this->ToolsModel->addTrantool($postDate);
			$this->session->set_flashdata('createS', 'You have added Tran Tools successfully.'); 
			redirect('/Trantool');

		}else
		 {
		    $data['getTools'] = $this->getQueryModel->getTools();
			$this->load->view('Tools/addTrantool',$data);
		}
		
	}
 public function updateTrantool()
	{
	    $this->session->unset_userdata('createS');
	    $this->form_validation->set_rules('Tool_Name', 'Tool_Name', 'trim|required');
		//$this->form_validation->set_rules('grinded_on', 'grinded_on', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
  	      $editId=$this->input->post('editId');
		if ($this->form_validation->run() == TRUE) {
				$postDate = array(
			   // 'tool_id'            =>$this->input->post('Tool_Name'),
				'grinded_on'         => $this->input->post('grinded_on'),
				'type'               => $this->input->post('type'),
				'remark'            => $this->input->post('remark'),
				'created_by '        => $_SESSION['id'],
				'created_on'         => date("Y-m-d H:i:s"),
				);
		 
			$res=$this->ToolsModel->updateTrantool($postDate,$editId);
			//echo $res;
			if($res){
		         	$this->session->set_flashdata('createS', 'You have updated tran tool successfully.');
			}else{
			     $this->session->set_flashdata('createS', 'Something wrong happened while updating record.'); 
			}
         

		}else{
		     $this->session->set_flashdata('createS', 'Please fill value first.'); 
		}
		   redirect('/addTrantool?ID='. base64_encode($editId)); 
		
	}
	public function deleteTrantoolRec(){
	    
	     $id=$this->input->post('editId');
	     $res=$this->ToolsModel->deleteTrantoolRec($id); 
    	  if($res){
    	       echo "record deleted successfully";  
    	  }else{
    	       echo "Something wrong happened while deleting record";  
    	  }
	  
	}
	
}