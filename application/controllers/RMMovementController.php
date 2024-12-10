<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class RMMovementController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('RMMovement/RMMovementModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{
		$data['getRMMovement'] = $this->getQueryModel->getRMMovement();
		$this->load->view('RMMovement/view',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['getRMMovement'] = $this->getQueryModel->getRMMovementbyID($id);
		$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		$data['getBranch']        = $this->getQueryModel->getBranch();
		$this->load->view('RMMovement/add',$data);
	}
	public function getStock()
	{
	    $rm_id = $_POST['rmId'];
	   $res   = $this->getQueryModel->getMovementRMStock($rm_id);
	   if($res['stock'] !='')
	   {
	   echo $res['stock'];
	   }else { echo '0';}
	}
	public function create()
	{
	    
	   $this->form_validation->set_rules('rm_id', 'raw material', 'trim|required');
		$this->form_validation->set_rules('current_stock', 'current stock', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
        $rm_id = $this->input->post('rm_id');
		if ($this->form_validation->run() == TRUE) {
		    $postDate = array(
				'rm_id' => $this->input->post('rm_id'),
				'qty' => $this->input->post('qty'),
				'from_branch_id' => $_SESSION['branch_id'],
				'to_branch_id' => $this->input->post('branch_id'),
				'date' => $this->input->post('date'),
				'created_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				);
			$rmMovementId=$this->RMMovementModel->addtranMovement($postDate);
			
			
            $getRmAvailStock = $this->getQueryModel->getRmAvailStock($rm_id);
            
            $issue_qty = $this->input->post('qty');
            
            foreach ($getRmAvailStock as $key => $value) 
            {
            $mast_rmrcir_id = $value['mast_id'];
            $det_rmrcir_id  = $value['det_id'];
            
            $qty = ($issue_qty  > $value['max_qty']) ? $value['max_qty'] : $issue_qty;
            
            $UpdateDate = array(
            'rm_id' 			=> $rm_id,
            'issue_qty' 		=> $qty,
            'mast_rmrcir_id' 	=> $mast_rmrcir_id,
            'year' 	            => $_SESSION['current_year'],
            'doc_year' 	        => $_SESSION['current_year'],
            'tran_date'         => $this->input->post('date'),
            'det_rmrcir_id' 	=> $det_rmrcir_id,
            'branch_id' 		=> $_SESSION['branch_id'],
            'move_from'             => "B".$_SESSION['branch_id'],
        	'move_to'               => "B".$this->input->post('branch_id'),
            'created_by' 		=> $_SESSION['id'],
            'updated_by' 		=> $_SESSION['id'],
            'updated_on' 		=> date("Y-m-d H:i:s"),
            'issue_doc_id' 		=> $rmMovementId,
            'issue_doc_type' 	=> 'rm_movement',
            );
            
            $this->db->insert('tran_rmrcir_stock',$UpdateDate);
            
            
            
             $UpdateDate = array(
            'rm_id' 			=> $rm_id,
            'received_qty' 		=> $qty,
            'mast_rmrcir_id' 	=> $mast_rmrcir_id,
            'year' 	            => $_SESSION['current_year'],
            'doc_year' 	        => $_SESSION['current_year'],
            'tran_date'         => $this->input->post('date'),
            'det_rmrcir_id' 	=> $det_rmrcir_id,
            'branch_id' 		=> $this->input->post('branch_id'),
            'move_from'         => "B".$_SESSION['branch_id'],
        	'move_to'           => "B".$this->input->post('branch_id'),
            'created_by' 		=> $_SESSION['id'],
            'updated_by' 		=> $_SESSION['id'],
            'updated_on' 		=> date("Y-m-d H:i:s"),
            'received_doc_id' 	=> $rmMovementId,
            'received_doc_type' => 'rm_movement',
            );
            $this->db->insert('tran_rmrcir_stock',$UpdateDate);
            
            
            
            $issue_qty = $issue_qty - $qty;
            
            if($issue_qty <= 0) break;
            
            }
							
							
			redirect('/RMMovement');

		}else
		 {
		    
			$this->add();
		}
	}
	public function update(){
	 $this->session->unset_userdata('createS');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
     	$editid=$_POST['editId'];
		if ($this->form_validation->run() == TRUE) {
		    $postDate = array(
				'qty' => $this->input->post('qty'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
		
			$branch_id=$_POST['branch_id'];
		
			 $RMMovementId=$this->RMMovementModel->updatetranMovement($postDate,$editid);
			//$query = $this->db->query("UPDATE `tran_rmrcir_stock` SET `issue_qty`=0,`received_qty`=0 WHERE issue_doc_id='$id' and received_doc_id='$id' and (issue_doc_type='rm_movement' or received_doc_type='rm_movement')");
        
             $dataarray=array('issue_qty' => '0');
	         $where=array('issue_doc_id'=>$editid,'issue_doc_type'=>'rm_movement');
	         $res1 = $this->db->update('tran_rmrcir_stock',$dataarray,$where);
	         
	          $dataarray1=array('received_qty' =>'0');
	         $where1=array('received_doc_id'=>$editid,'received_doc_type'=>'rm_movement','branch_id'=>$branch_id);
	         $res3 = $this->db->update('tran_rmrcir_stock',$dataarray1,$where1);

			
			if($RMMovementId){
			 	 $this->session->set_flashdata('createS', 'Quantity Updated successfully.');
			}else{
			     $this->session->set_flashdata('createS', 'Error While Updating record.');
			}
		   
		}else{ 
		    $this->session->set_flashdata('createS', 'Enter Quantity...');
		}
		redirect('/addRMMovement?ID='. base64_encode($editid)); 
	}
	
	public function deleteRMMovement()
	{
	    $Id = $_POST['Id'];
	    $postDate = array('qty' => 0);
	    $rmMovementId=$this->RMMovementModel->UpdatetranMovement($postDate,$Id);
	   
	}
	
	//created by Asharani for RM Movement Print- 16/12/2023
	public function rmMvmtPrint(){
	    $id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
        $data['getrmMovement']        = $this->getQueryModel->getRMMovementbyID($id);
		$this->load->view('RMMovement/rmMvmtPrint',$data);
	}
	
}

?>