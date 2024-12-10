<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ToolMakerController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{
		$data['getToolMaker'] = $this->getQueryModel->getToolMaker();
		$this->load->view('ToolMaker/viewToolMaker',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['getToolMakerById']  = $this->getQueryModel->getToolMakerById($id);
		$this->load->view('ToolMaker/addToolMaker',$data);
	}
	
	public function createToolMaker()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('msg');
		$this->session->unset_userdata('ermsg');
	    $this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('gstno', 'GST No.', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'name' 		=> $this->input->post('name'),
				'address' 	=> $this->input->post('address'),
				'gstno'				=> $this->input->post('gstno'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				
			$result1 = $this->db->insert('mast_tool_maker',$postDate);
			$tm_id= $this->db->insert_id();

			if($tm_id){
			   
			   $this->session->set_flashdata('msg', 'Record inserted successfully..!');
		      
			}else{
			      $this->session->set_flashdata('msg', 'Record Not Inserted!');
			}
			redirect('/viewToolMaker');

		}else
		 {
		    $this->session->set_flashdata('ermsg', 'Tool Maker details should be mandatory!');
			$this->add();
		}
		
	}
	public function updateToolMaker()
	{
		$editId	= $this->input->post('editId');
		//echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('msg');
		$this->session->unset_userdata('ermsg');
	    $this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('gstno', 'GST No.', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {

			$postDate = array(
				'name' 		        => $this->input->post('name'),
				'address' 	        => $this->input->post('address'),
				'gstno'				=> $this->input->post('gstno'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
				
			    $this->db->where('id', $editId);
    			$update = $this->db->update('mast_tool_maker', $postDate);
    			if($update){
    			     $this->session->set_flashdata('msg', 'Record Updated Successfully.');
    			}else{
    			      $this->session->set_flashdata('msg', 'Record Not Updated.');
    			}
			
			redirect('/viewToolMaker');

		}else
		 {
			  $this->session->set_flashdata('ermsg', 'Tool Maker details should be mandatory!');
		     redirect('/addToolMaker?ID='.base64_encode($editId)); 
		}
		
	}

	   public function delToolMakerRecord(){
		   $postDate = array(
				'isdeleted' => 1,
				);
    		$this->db->where("id",$_POST['editId']);
            $update = $this->db->update('mast_tool_maker', $postDate);
        	echo ($update == true) ? "Record deleted." : "Something wrong happened while deleting record.";
    	}
}

?>