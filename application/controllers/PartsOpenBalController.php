<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

//created by Asharani
class PartsOpenBalController extends CI_Controller{	

	public function __construct(){
		parent::__construct();
		$this->load->model('PartsOpenBal/PartsOpenBalModel');
		$this->load->model('getQuery/getQueryModel');
	}

	public function PartsOpeningBal(){   //created by Asharani
          $data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
          $data['getPartopenbalList']   = $this->PartsOpenBalModel->getPartopenbalList();
		  $this->load->view('PartsOpenBal/view',$data);
	}

	public function add(){   //created by Asharani

		$id = base64_decode($_GET['ID']);
		$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getPartOpenBal'] 			= $this->PartsOpenBalModel->getpartsOBbyid($id);
     // print_r($data['getPartOpenBal'] );die;
		$this->load->view('PartsOpenBal/add',$data);
	}

   public function create(){     //created by Asharani

		$this->form_validation->set_rules('doc_year', 'doc_year', 'trim|required');
		$this->form_validation->set_rules('Part_Id', 'Part_Id', 'trim|required');
		$this->form_validation->set_rules('Op_Id', 'Op_Id', 'trim|required');
		$this->form_validation->set_rules('obqty', 'obqty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

        $part_id = $this->input->post('Part_Id');
        $Op_Id = $this->input->post('Op_Id');
        
        $doc_year = $this->input->post('doc_year');
        $received_qty = $this->input->post('obqty');
        $received_doc_id=0;
        $received_doc_type='O.B.';
			if ($this->form_validation->run() == TRUE) {

	                  $array = array('part_id' => $part_id, 'op_id' => $Op_Id, 'doc_year' => $doc_year);
							$this->db->where($array);    
							$q = $this->db->get('tran_partsrcir_stock');

							if ( $q->num_rows() > 0 ) 
							{		
							   $this->session->set_flashdata('dcmsg', 'Adding Duplicate Record..!');					
								$this->add();

							} else {							 
	                  
								$add = array(
														'part_id' 			    => $part_id,
														'op_id' 		          => $Op_Id,
										            'year' 				    =>  $_SESSION['current_year'],
										            'doc_year' 			    =>  $doc_year,
														'branch_id' 	    	 => $_SESSION['branch_id'],
														'created_by' 		    => $_SESSION['id'],
														'updated_by' 		    => $_SESSION['id'],
														'received_doc_id' 	 => $received_doc_id,
														'received_qty' 	    => $received_qty,
														'received_doc_type'   => $received_doc_type
										    );
										    
								$result16 = $this->db->insert('tran_partsrcir_stock',$add);
								$insert_id = $this->db->insert_id();
								if($insert_id){
								  redirect('/PartsOpeningBal');
								}

							}				 	

			}else{
                 $this->session->set_flashdata('dcmsg', 'Error While Updating Record..!');					
					  $this->add();
			}
   }


  public function update(){

        //echo "<pre>";print_r($_POST); echo "</pre>";    
        $ob_id = $this->input->post('editId');
        $received_qty = $this->input->post('obqty');
        $update_data = array('received_qty' => $received_qty);

	        $this->db->where('id', $ob_id);
	        $update = $this->db->update('tran_partsrcir_stock', $update_data);

          if($update){
                redirect('/PartsOpeningBal');  
          }else{
             $this->add();
          }
	       // return ($update == true) ? true : false;	        
  }
  

   public function deletepartOB(){

      $rm_id = $_POST['rmId'];

   }
}
?>