<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class RMOBController extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{
		$data['getRawMaterial'] = $this->getQueryModel->getRMOB();
		$this->load->view('RMOB/index',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['getRMOBById']      = $this->getQueryModel->getRMOBById($id);
		$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		$this->load->view('RMOB/add',$data);
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
	public function createRMOB()
	{
	    //echo "<pre>";print_r($_POST);
	 	if(!empty($_POST['checkboxVal']))
		{
			foreach ($_POST['checkboxVal'] as $key => $value) 
			{
				
				$keys =  array_search($value,$_POST['rm_id'],true);
				
				$rmid 			= $_POST['rm_id'][$keys];
				$ob_qty   		= $_POST['rmob_qty'][$keys];
				$obid   		= $_POST['ob_id'][$keys];
			  if($obid){	
			  
                   $UpdateDate = array(
                    'received_qty' 		=> $ob_qty,
                    'year' 	            => $_SESSION['current_year'],
                    'doc_year' 	        => $_SESSION['current_year'],
                    'branch_id' 		=> $_SESSION['branch_id'],
                    'updated_by' 		=> $_SESSION['id'],
                    'updated_on' 		=> date("Y-m-d H:i:s"),
                    );
                    $this->db->where('id', $obid);
                    $this->db->update('tran_rmrcir_stock',$UpdateDate);
			  }else{
			    
			       $UpdateDate = array(
                    'rm_id' 			=> $rmid,
                    'received_qty' 		=> $ob_qty,
                    'mast_rmrcir_id' 	=> 0,
                    'year' 	            => $_SESSION['current_year'],
                    'doc_year' 	        => $_SESSION['current_year'],
                    'branch_id' 		=> $_SESSION['branch_id'],
                    'det_rmrcir_id' 	=> 0,
                    'created_by' 		=> $_SESSION['id'],
                    'created_on' 		=> date("Y-m-d H:i:s"),
                    'received_doc_id' 	=> 0,
                    'received_doc_type' => 'O.B.',
                    );
                    
                    $this->db->insert('tran_rmrcir_stock',$UpdateDate); 
			  }

				
			}
	    	 redirect('/rmob');
		}else{
		    redirect('/rmob');
		}
		   
            
           

	
	}
	public function update()
	{
	    
	   $this->form_validation->set_rules('qty', 'Qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
        $rm_id = $this->input->post('rm_id');
		if ($this->form_validation->run() == TRUE) {
		    
           $UpdateDate = array(
            'received_qty' 		=> $_POST['qty']
            );
            
            $array = array('id' => $_POST['editId']);
			$this->db->where($array);
            $this->db->update('tran_rmrcir_stock',$UpdateDate);
            
            redirect('/rmob');

		}else
		 {
		    
			$this->add();
		}
	}
	
	public function checkRMInStock()
	{
	    $rm_id = $_POST['rmId'];
	    $year = $_POST['year'];
	    echo $res   = $this->getQueryModel->checkRMYearInStock($rm_id,$year);
	   
	}
	
	
	
}

?>