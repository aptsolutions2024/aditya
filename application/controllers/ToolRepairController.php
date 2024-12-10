<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ToolRepairController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('getQuery/getQueryModel');
	}
    public function view(){
      
	
		   	$this->session->unset_userdata('dcmsg');
		   	$data['getSupplier']      = $this->getQueryModel->getToolMaker();
		   	$data['getTools']      = $this->getQueryModel->getTools();
	
	   // $this->form_validation->set_rules('status', 'Select Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		//if ($this->form_validation->run() == TRUE) {
		   	
		   	$data['getToolRepair'] = $this->getQueryModel->getToolRepairDetails();
		//}
	
		$this->load->view('ToolRepair/view',$data);
    }
    
    public function add(){
      	$id = base64_decode($_GET['ID']);
        $data['companyDetails']   = $this->getQueryModel->companyDetails();
        if($data['companyDetails']['tool_repair']=='1'){
        	$data['getTools']      = $this->getQueryModel->getTools();
        	$data['getSupplier']      = $this->getQueryModel->getToolMaker();
        }
	 	$data['getoolRepairDetailsById'] 	    = $this->getQueryModel->getToolRepairDetailsById($id);
	
		$this->load->view('ToolRepair/add',$data);
    }
    
 
   
   public function createToolRepair(){
           //echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('dcmsg');
		$data['companyDetails']   = $this->getQueryModel->companyDetails();
	    $this->form_validation->set_rules('tool_name', 'Tool name', 'trim|required');
	    $this->form_validation->set_rules('identified_on', 'Identified on', 'trim|required');
	    $this->form_validation->set_rules('new_development', 'Select New Development', 'trim|required');
	    
// 		$this->form_validation->set_rules('tool_maker', 'Tool maker', 'trim|required');
// 		$this->form_validation->set_rules('issue_date', 'Issue date', 'trim|required');
// 		$this->form_validation->set_rules('estimated_amt', 'Estimated amt', 'trim|required');
// 		$this->form_validation->set_rules('advance_amt', 'Advance amt', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
         
            if($data['companyDetails']['tool_repair']=='1'){
                  
                $tool_id	         = $this->input->post('tool_name');
                $toolD               = $this->getQueryModel->getToolById($tool_id);
                $tool_name           = $toolD[name];
                $supplier_id         = $this->input->post('tool_maker');
                $tm                  = $this->getQueryModel->getSupplierById($supplier_id);
                $tool_maker          =$tm['name'];
            }else{
               $tool_id=0; 
               $supplier_id=0;
               $tool_name	        = $this->input->post('tool_name');
               $tool_maker          = $this->input->post('tool_maker');
            }
		    $identified_on          = $this->input->post('identified_on');
			$issue_date				= $this->input->post('issue_date');
			$estimated_amt		    = $this->input->post('estimated_amt');
			$advance_amt		    = $this->input->post('advance_amt');
			$new_development		= $this->input->post('new_development');
			$remarks		        = $this->input->post('remarks');
          
           //`id`, `tool_id`, `tool_name`, `remarks`,identified_on, `issue_date`, `estimated_amt`, `advance_amt`, `supplier_id`, `tool_maker`, `received_date`, `tot_amt_paid`, `created_on`, `created_by`,
       
			$postDate = array(
				'tool_id' 		    => $tool_id,
				'tool_name' 		=> $tool_name,
                'supplier_id' 	    => $supplier_id,
                'tool_maker'     	=> $tool_maker,
                'identified_on'     => $identified_on,
				'issue_date'	    => $issue_date,
				'advance_amt'       =>$advance_amt,
				'estimated_amt' 	=> $estimated_amt,
				'new_development' 	=> $new_development,
				'remarks' 			=> $remarks,
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				
			$result1 = $this->db->insert('tool_repair',$postDate);
			$mast_dr_id= $this->db->insert_id();
		
            redirect('/viewToolRepair');

		}else
		 {
		     
		  $this->session->set_flashdata('dcmsg', 'Tool Repair details should be mandatory!');
		        $this->add();
		}
       
   }
   	public function updateToolRepair()
	{
	    
	  //  echo "<pre>";print_r($_POST);die;
	    	$this->session->unset_userdata('dcmsg');
	    $data['companyDetails']   = $this->getQueryModel->companyDetails();
	    $this->form_validation->set_rules('tool_name', 'Tool name', 'trim|required');
		$this->form_validation->set_rules('tool_maker', 'Tool maker', 'trim|required');
		$this->form_validation->set_rules('issue_date', 'Issue date', 'trim|required');
		$this->form_validation->set_rules('estimated_amt', 'Estimated amt', 'trim|required');
		$this->form_validation->set_rules('advance_amt', 'Advance amt', 'trim|required');
		$this->form_validation->set_rules('new_development', 'Select New Development', 'trim|required');
		 $this->form_validation->set_rules('identified_on', 'Identified on', 'trim|required');
	   // $this->form_validation->set_rules('received_date', 'Received date', 'trim|required');
		$this->form_validation->set_rules('tot_amt_paid', 'Tot amt paid', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
	$editId			        = $this->input->post('editId');
 
		if ($this->form_validation->run() == TRUE) {
	    	$data['companyDetails']   = $this->getQueryModel->companyDetails();
		
	       if($data['companyDetails']['tool_repair']=='1'){
                $tool_id	         = $this->input->post('tool_name');
                $toolD               = $this->getQueryModel->getToolById($tool_id);
                $tool_name           = $toolD[name];
                $supplier_id         = $this->input->post('tool_maker');
                $tm                  = $this->getQueryModel->getToolMakerById($supplier_id);
                $tool_maker          =$tm['name'];
            }else{
               $tool_id=0; 
               $supplier_id=0;
               $tool_name	        = $this->input->post('tool_name');
               $tool_maker          = $this->input->post('tool_maker');
            }
		    $identified_on          = $this->input->post('identified_on');
		 	$issue_date				= $this->input->post('issue_date');
			$estimated_amt		    = $this->input->post('estimated_amt');
			$advance_amt		    = $this->input->post('advance_amt');
			$new_development		= $this->input->post('new_development');
			$remarks		        = $this->input->post('remarks');
			
			$received_date		    = $this->input->post('received_date');
			$tot_amt_paid		    = $this->input->post('tot_amt_paid');
		//`id`, `tool_id`, `tool_name`, `remarks`, `issue_date`, `estimated_amt`, `advance_amt`, `supplier_id`, `tool_maker`, `received_date`, `tot_amt_paid`, `created_on`, `created_by`,
       
			$postDate = array(
				'tool_id' 		    => $tool_id,
				'tool_name' 		=> $tool_name,
                'supplier_id' 	    => $supplier_id,
                'tool_maker'     	=> $tool_maker,
                'identified_on'     => $identified_on,
				'issue_date'	    => $issue_date,
				'estimated_amt' 	=> $estimated_amt,
				'advance_amt'       =>$advance_amt,
				'received_date'	    => $received_date,
				'tot_amt_paid' 	    => $tot_amt_paid,
				'new_development' 	=> $new_development,
				'remarks' 			=> $remarks,
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
					
			if($editId) {
    			$this->db->where('id', $editId);
    			$update = $this->db->update('tool_repair', $postDate);
    			if($update){
    			     $this->session->set_flashdata('dcmsg', 'Record Updated Successfully.');
    			}else{
    			      $this->session->set_flashdata('dcmsg', 'Record Not Updated.');
    			}
			}
		            redirect('/viewToolRepair');
		}else
		 {
		  $this->session->set_flashdata('dcmsg', 'Tool Repair details should be mandatory!');
		  redirect('/addToolRepair?ID='.base64_encode($editId)); 
		}
    
   
    }
    
    public function toolRepairPrint()
	{
    	$id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
    //	$data['getDRMastById'] 	    = $this->getQueryModel->getDefregMastById($id);
		$data['getoolRepairDetailsById'] 	    = $this->getQueryModel->getToolRepairDetailsById($id);
		$this->load->view('ToolRepair/toolRepairPrint',$data);
	}
    
      public function deleteDefregDetails(){
		   $postDate = array(
				'isdeleted' => 1,
				);
    		$this->db->where("id",$_POST['editId']);
            $update = $this->db->update('defect_reg_details', $postDate);
        	echo ($update == true) ? "Record deleted." : "Something wrong happened while deleting record.";
    	}
    	

}
?>