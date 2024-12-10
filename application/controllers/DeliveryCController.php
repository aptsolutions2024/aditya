<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DeliveryCController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('DeliveryChallan/DeliveryCModel');
		$this->load->model('getQuery/getQueryModel');
		$this->load->model('DCRCIR/DCRCIRModel');
	}
	public function view()
	{
		$data['getTrandcmast'] = $this->getQueryModel->getTrandcmast();
		$this->load->view('DeliveryChallan/view',$data);
	}
	public function dcPrint()
	{
    	$id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
    	$data['getDCMastById'] 	    = $this->getQueryModel->getDCMastById($id);
		$data['getDCDetails']       = $this->getQueryModel->getDCDetails($id);
		$this->load->view('DeliveryChallan/dcPrint',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['getSupplier']        = $this->getQueryModel->getSupplier(2);
		$data['getPartName']   		= $this->getQueryModel->getPartName();
		//$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getDCMastById'] 	    = $this->getQueryModel->getDCMastById($id);
		$data['getDCDetails']       = $this->getQueryModel->getDCDetails($id);
		$this->load->view('DeliveryChallan/add',$data);
	}
	public function viewPartsMovementSupl(){
	       
	       $data['getPartsSuplMovement'] = $this->getQueryModel->getPartsSuplMovement();
	    	$this->load->view('DeliveryChallan/viewPartsMovementSupl',$data); 
	}
	public function AddPartsMovementSupl(){
	    $data['getSupplier']        = $this->getQueryModel->getSupplier(2);
	   	$this->load->view('DeliveryChallan/AddPartsMovementSupl',$data); 
	}
	
    public function updateRCIRStocksupl($mast_rcir_id)
	{
	   	foreach ($_POST['checkboxVal'] as $key => $value){
    			     $keys                   =  array_search($value,$_POST['dc_det_id'],true);
    			    // echo "**Keyy".$keys;
    			    $parts_po_det_id	    = $_POST['parts_po_det_id'][$keys];
    			    $dc_det_id	            = $_POST['dc_det_id'][$keys]; 
    			    $dc_mast_id	            = $_POST['dc_mast_id'][$keys];
    			    $part_id	            = $_POST['part_id'][$keys];
    			    $op_id	                = $_POST['op_id'][$keys];
    			    $ordered_qty            = $_POST['ordered_qty'][$keys];
                    $rec_qty	            = $_POST['rec_qty'][$keys];
                    $bal_qty	            = $_POST['bal_qty'][$keys];
                    $qty_in_kgs             = $_POST['qty_in_kgs'][$keys];
                    $inprocess_loss_qty     = 0;
                    $rcir_qty               = $_POST['rcir_qty'][$keys];
                    
                    
                    $postDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'tran_partspo_det_id' 	=> $parts_po_det_id,
        				'dc_det_id' 	        => $dc_det_id,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $op_id,
        				'qty' 				    => $rcir_qty,
        				'qty_in_kgs' 		    => $qty_in_kgs,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'qc_checked_by'         => '999999',
        				'qc_remarks'            =>'supl_pmovement',
        				'qc_checked_on'         => date("Y-m-d H:i:s"),
        				'year ' 		        => $_SESSION['current_year'],
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$det_partsrcir_id = $this->DCRCIRModel->AddTranPartsrcirDetails($postDetails);
				
				
				$postStockDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'det_partsrcir_id' 	    => $det_partsrcir_id,
        				'part_id' 			    => $part_id,
        				'op_id' 			    => $op_id,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('from_Supplier_Id'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date' 	        => $this->input->post('date'),
        				'received_qty' 			=> $rcir_qty,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'received_doc_type' 	=> 'supl_pmovement',
        				'received_doc_id' 	    => $det_partsrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d"),
        				);
        				
        		$this->DCRCIRModel->AddPTranRcirStock($postStockDetails);
        		
        		  $postStockDetails1 = array(
        				'mast_dc_id'  	     => $dc_mast_id,
        				'det_dc_id' 	     => $dc_det_id,
        				'part_id' 		     => $part_id,
        				'op_id' 		     => $op_id,
        				'year' 			     => $_SESSION['current_year'],
        				'doc_year' 		     => $_SESSION['current_year'],
        				'tran_date' 	        => $this->input->post('date'),
        				'received_qty' 	     => $rcir_qty,
        				'received_doc_type'  => 'supl_pmovement',
        				'inprocess_loss_qty' => $inprocess_loss_qty,
        				'received_doc_id'    => $det_partsrcir_id,
        				'branch_id'          => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('from_Supplier_Id'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'created_by ' 	     => $_SESSION['id'],
        				'created_on ' 	     => date("Y-m-d H:i:s"),
        				);
        			$this->DeliveryCModel->AddDCTranStock($postStockDetails1);
        			$query = $this->db->query("select det_rmrcir_id from tran_dc_stock where det_dc_id='$dc_det_id' and issue_qty>0 and issue_doc_id='$dc_det_id'");
	                $result = $query->row_array();
	           if($result['det_rmrcir_id']){
            		$query = $this->db->query("update tran_partsrcir_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$result['det_rmrcir_id']."',concat(det_rmrcir_id,',','".$result['det_rmrcir_id']."')) where det_partsrcir_id='$det_partsrcir_id'");
    	            $data = $this->db->affected_rows();
	           }
        			
				return $det_partsrcir_id;
    			} 
	    
	}
	public function createPMovementsupl(){
	    //echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('dcmsg');
		 $this->form_validation->set_rules('Supplier_Id', 'To Supplier', 'trim|required');  //TO SUPPLIER ID
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
	//	$this->form_validation->set_rules('vehicle_no', 'vehicle no.', 'trim|required');
	//	$this->form_validation->set_rules('transporter_name', 'transporter name', 'trim|required');
	    $this->form_validation->set_rules('Part_Id', 'Part Name', 'trim|required');
	     $this->form_validation->set_rules('Part_Search', 'Part Name', 'trim|required');
	     $this->form_validation->set_rules('Op_Id', 'Operation', 'trim|required');  //NEW OP ID
	   $this->form_validation->set_rules('from_Supplier_Id', 'From Supplier', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		 //  echo "<pre>"; print_r($_POST);echo "</pre>";die;
          if(!empty($_POST['checkboxVal'])){
            foreach ($_POST['checkboxVal'] as $key => $value) 
		    {
			$postDate = array(
				'supplier_id' 		=> $this->input->post('from_Supplier_Id'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 	    => $this->input->post('date'),
				'challan_no' 	     => 'supl_pmovement',
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d"),
				);
				
			$mast_rcir_id  =  $this->DCRCIRModel->AddTranPartsrcirMast($postDate);
			
		//	$det_partsrcir_id=$this->updateRCIRStocksupl($mast_rcir_id);
			
				     $keys                   =  array_search($value,$_POST['dc_det_id'],true);
    			    // echo "**Keyy".$keys;
    			    $parts_po_det_id	    = $_POST['parts_po_det_id'][$keys];
    			    $dc_det_id	            = $_POST['dc_det_id'][$keys]; 
    			    $dc_mast_id	            = $_POST['dc_mast_id'][$keys];
    			    $part_id	            = $_POST['part_id'][$keys];
    			    $op_id	                = $_POST['op_id'][$keys];
    			 $prev_op_id	                = $_POST['op_id'][$keys];
    			    $ordered_qty            = $_POST['ordered_qty'][$keys];
                    $rec_qty	            = $_POST['rec_qty'][$keys];
                    $bal_qty	            = $_POST['bal_qty'][$keys];
                    $qty_in_kgs             = $_POST['qty_in_kgs'][$keys];
                    $inprocess_loss_qty     = 0;
                    $rcir_qty               = $_POST['rcir_qty'][$keys];
                    
                    
                    $postDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'tran_partspo_det_id' 	=> $parts_po_det_id,
        				'dc_det_id' 	        => $dc_det_id,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $op_id,
        				'qty' 				    => $rcir_qty,
        				'qty_in_kgs' 		    => $qty_in_kgs,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'qc_checked_by'         => '999999',
        				'qc_remarks'            =>'supl_pmovement',
        				'qc_checked_on'         => date("Y-m-d H:i:s"),
        				'year ' 		        => $_SESSION['current_year'],
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$det_partsrcir_id = $this->DCRCIRModel->AddTranPartsrcirDetails($postDetails);
				
				
				$postStockDetails = array(
        				'mast_partsrcir_id' 	=> $mast_rcir_id,
        				'det_partsrcir_id' 	    => $det_partsrcir_id,
        				'part_id' 			    => $part_id,
        				'op_id' 			    => $op_id,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('from_Supplier_Id'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date' 	        => $this->input->post('date'),
        				'received_qty' 			=> $rcir_qty,
        				'inprocess_loss_qty' 	=> $inprocess_loss_qty,
        				'received_doc_type' 	=> 'supl_pmovement',
        				'received_doc_id' 	    => $det_partsrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d"),
        				);
        				
        		$this->DCRCIRModel->AddPTranRcirStock($postStockDetails);
        		
        		  $postStockDetails1 = array(
        				'mast_dc_id'  	     => $dc_mast_id,
        				'det_dc_id' 	     => $dc_det_id,
        				'part_id' 		     => $part_id,
        				'op_id' 		     => $op_id,
        				'year' 			     => $_SESSION['current_year'],
        				'doc_year' 		     => $_SESSION['current_year'],
        				'tran_date' 	        => $this->input->post('date'),
        				'received_qty' 	     => $rcir_qty,
        				'received_doc_type'  => 'supl_pmovement',
        				'inprocess_loss_qty' => $inprocess_loss_qty,
        				'received_doc_id'    => $det_partsrcir_id,
        				'branch_id'          => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('from_Supplier_Id'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'created_by ' 	     => $_SESSION['id'],
        				'created_on ' 	     => date("Y-m-d H:i:s"),
        				);
        			$this->DeliveryCModel->AddDCTranStock($postStockDetails1);
        			$query = $this->db->query("select det_rmrcir_id from tran_dc_stock where det_dc_id='$dc_det_id' and issue_qty>0 and issue_doc_id='$dc_det_id'");
	                $result = $query->row_array();
	           if($result['det_rmrcir_id']){
            		$query = $this->db->query("update tran_partsrcir_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$result['det_rmrcir_id']."',concat(det_rmrcir_id,',','".$result['det_rmrcir_id']."')) where det_partsrcir_id='$det_partsrcir_id'");
    	            $data = $this->db->affected_rows();
	           }
			
			//---------------------------------end of rcir details--------------------------------------------------
			//---------------------------------new DC records with new op_id and new supplier--------------------------------------------------
	
            $parts_po_det_id_dc	=$this->input->post('parts_po_det_id_dc');
			$Part_Id			=$this->input->post('Part_Id');
			$Op_Id				=$this->input->post('Op_Id');
			$part_remark		=$this->input->post('part_remark');
			$fromsupl = $this->input->post('from_Supplier_Id');
			
           // if(!empty($Part_Id && $Op_Id && $parts_po_det_id_dc && $fromsupl))	    {
		        
			$postDate1 = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'dc_no' 			=> 'supl_pmovement',
				'remarks' 			=> $this->input->post('Remark'),
				'branch_id ' 		=> $_SESSION['branch_id'],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			$mast_dc_id = $this->DeliveryCModel->AddTrandcMast($postDate1);
    			   
    			    $dc_det_id	            = $_POST['dc_det_id'][$keys]; 
    			    $dc_mast_id	            = $_POST['dc_mast_id'][$keys];
    			    $ordered_qty            = $_POST['ordered_qty'][$keys];
                    $rec_qty	            = $_POST['rec_qty'][$keys];
                    $bal_qty	            = $_POST['bal_qty'][$keys];
                    $qty_in_kgs             = $_POST['qty_in_kgs'][$keys];
                    $inprocess_loss_qty     = 0;
                    $rcir_qty               = $_POST['rcir_qty'][$keys];
    			     
    				$postDetails1 = array(
    				'mast_dc_id' 	    => $mast_dc_id,
    				'part_id' 			=> $Part_Id,
    				'op_id' 			=> $Op_Id,
    				'qty_in_kgs' 		=> $qty_in_kgs,
    				'qty' 				=> $rcir_qty,
    				'parts_po_det_id' 	=> $parts_po_det_id_dc,
    				'created_by ' 		=> $_SESSION['id'],
    				'created_on ' 		=> date("Y-m-d H:i:s"),
    				'remarks'           =>'supl_pmovement',
    				'supl_movement_id'  => $det_partsrcir_id,
    				);
    
    				$det_dc_id = $this->DeliveryCModel->AddTrandcDetails($postDetails1);
    			//	$issue_doc_id = $det_dc_id;
    					//$this->updateTranDCSupplMvmtStock($Part_Id,$Op_Id,$det_dc_id,$mast_dc_id,$rcir_qty,$det_partsrcir_id,$mast_rcir_id);
	    	           $postStockDetails1 = array(
                            				'mast_dc_id' 	=> $mast_dc_id,
                            				'det_dc_id' 	=> $det_dc_id,
                            				'part_id' 		=> $Part_Id,
                            				'op_id' 		=> $Op_Id,
                            				'year' 			=> $_SESSION['current_year'],
                            				'doc_year' 		=> $_SESSION['current_year'],
                            				'tran_date' 	 => $this->input->post('date'),
                            				'issue_qty' 	=> $rcir_qty,
                            				'issue_doc_type'=> 'supl_pmovement',
                            				'issue_doc_id' 	=> $det_dc_id,
                            				'branch_id'     => $_SESSION['branch_id'],
                            				'move_from'     =>"B".$_SESSION['branch_id'],
                            				'move_to'       =>"S".$this->input->post('Supplier_Id'),
                            				'created_by ' 	=> $_SESSION['id'],
                            				'created_on ' 	=> date("Y-m-d H:i:s"),
        			                	);
        				
        		$this->DeliveryCModel->AddDCTranStock($postStockDetails1);
			    
			           //$op_id_prev=$this->getQueryModel->getPrevOperRCIR($mast_rcir_id,$det_partsrcir_id);	  
								    $UpdateDate67 = array(
        									'part_id' 			    => $Part_Id,
        									'op_id' 		        => $prev_op_id,
        									'mast_partsrcir_id' 	=> $mast_rcir_id,
        									'det_partsrcir_id' 	    => $det_partsrcir_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        						            'tran_date' 	        => $this->input->post('date'),
        									'issue_qty' 		    => $rcir_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
                            				'move_from'             =>"B".$_SESSION['branch_id'],
                				            'move_to'               =>"S".$this->input->post('Supplier_Id'),        									
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'issue_doc_id' 		    => $det_dc_id,
        									'issue_doc_type' 	    => 'supl_pmovement'
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
    					
    				//New Changes for det_rmrcir_id -: 22-12-2023	
                    $query = $this->db->query("select det_rmrcir_id from tran_partsrcir_stock where det_partsrcir_id='$det_partsrcir_id' and received_qty>0 and received_doc_id='$det_partsrcir_id'");
                    $result = $query->row_array();
                    if($result['det_rmrcir_id']){
                     $query = $this->db->query("update tran_dc_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$result['det_rmrcir_id']."',concat(det_rmrcir_id,',','".$result['det_rmrcir_id']."')) where det_dc_id='$det_dc_id'");
                     $data = $this->db->affected_rows();
                    }
                    
             //`id`, `part_id`, `tran_date`, `rcir_op_id`, `dc_op_id`, `rcir_id`, `dc_id`, `rcir_supl_id`, `dc_supl_id`, `rcir_qty`, `dc_qty`, `branch_id`, `year`, `created_by`, `created_on`
    		    $postStockDetails11 = array(
                    		          	'part_id' 	 	=> $Part_Id,
                    		          	'tran_date' 	=> $this->input->post('date'),
                    		          	'rcir_op_id'    => $prev_op_id,
                    		          	'dc_op_id'	    => $Op_Id,
                    		          	'rcir_id'       => $det_partsrcir_id,
                    		          	'dc_id'         => $det_dc_id,
                    		          	'rcir_supl_id'  => $this->input->post('from_Supplier_Id'),
                    		          	'dc_supl_id'    => $this->input->post('Supplier_Id'),
                    		          	'rcir_qty'      => $rcir_qty,
                    		          	'dc_qty'        => $rcir_qty,
                    		          	'prev_dc_id'    => $dc_det_id,
                    		          	'branch_id'     => $_SESSION['branch_id'],
                    		          	'year' 				    => $_SESSION['current_year'],
                    		          	'created_by ' 	=> $_SESSION['id'],
                                        'created_on ' 	=> date("Y-m-d H:i:s")
        			                	);
        				
        			$result16 = $this->db->insert('tran_supplier_movement',$postStockDetails11);
        			$insert_id = $this->db->insert_id();
        			
        		    $query = $this->db->query("update tran_dc_stock set booked_doc_id='$insert_id' where det_dc_id='$det_dc_id' and issue_qty>0");
                    $data = $this->db->affected_rows();
                    
    		        $query = $this->db->query("update tran_partsrcir_stock set booked_doc_id='$insert_id' where det_partsrcir_id='$det_partsrcir_id'");
                    $data = $this->db->affected_rows();
                    
		  //  }else{
		  //      $this->session->set_flashdata('dcmsg', 'Part Delivery Challan Details should be mandatory!');
		  //      redirect('/AddPartsMovementSupl');
		  //  }
                
		    }
		    redirect('/AddPartsMovementSupl');
		}else
		 {
		    $this->session->set_flashdata('dcmsg', 'Part RCIR Details should be mandatory!');
	         	 redirect('/AddPartsMovementSupl');
		}
		    
		}else
		 {
		   $this->session->set_flashdata('dcmsg', 'Please selects mandatory fields!');
		 redirect('/AddPartsMovementSupl');
		}
	}
	public function createDC()
	{
	   //  echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('dcmsg');
	    $this->form_validation->set_rules('Supplier_Id', 'supplier', 'trim|required');
		$this->form_validation->set_rules('Other_date', 'date', 'trim|required');
		//$this->form_validation->set_rules('dc_no', 'DC no.', 'trim|required');
		$this->form_validation->set_rules('vehicle_no', 'vehicle no.', 'trim|required');
		$this->form_validation->set_rules('transporter_name', 'transporter name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
            //$DCTYPE = $this->input->post('dc_type');
            
            
            $parts_po_det_id	=$this->input->post('parts_po_det_id');
			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$part_remark		=$this->input->post('part_remark');
			$qty_in_kgs			=$this->input->post('qty_in_kgs');
			$quantity			=$this->input->post('quantity');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');
			$max_qty 			=$this->input->post('max_qty');
			
			
            //echo $Part_Id[0] .' - ' . $op_id[0] .' - ' . $quantity[0] .' - ' . $rate[0];die;
           
            if(!empty($Part_Id[0] && $op_id[0] && $quantity[0] && $rate[0]>=0))
		    {
		        
			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('Other_date'),
				'year'				=> $_SESSION['current_year'],
				'dc_no' 			=> $this->input->post('dc_no'),
				'vehicle_no' 		=> $this->input->post('vehicle_no'),
				'transporter_name' 	=> $this->input->post('transporter_name'),
				//'dc_type' 			=> $this->input->post('dc_type'),
				'remarks' 			=> $this->input->post('Remark'),
				'branch_id ' 		=> $_SESSION['branch_id'],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d"),
				);
				
			
			$mast_dc_id = $this->DeliveryCModel->AddTrandcMast($postDate);


            $postDate1=array('dc_no'=>$mast_dc_id);
			$this->DeliveryCModel->UpdateTrandcMast($postDate1,$mast_dc_id);
			
    			foreach($Part_Id as $key => $part_id)
    			{
    				$postDetails = array(
    				'mast_dc_id' 	    => $mast_dc_id,
    				'part_id' 			=> $part_id,
    				'op_id' 			=> $op_id[$key],
    				'qty_in_kgs' 		=> $qty_in_kgs[$key],
    				'qty' 				=> $quantity[$key],
    				'parts_po_det_id' 	=> $parts_po_det_id[$key],
    				'max_qty' 	        => $max_qty[$key],
    				'rate' 	            => $rate[$key],
    				'unit' 	            => $unit[$key],
    				'igst' 	            => $igst[$key],
    				'cgst' 	            => $cgst[$key],
    				'sgst' 	            => $sgst[$key],
    				'created_by ' 		=> $_SESSION['id'],
    				'created_on ' 		=> date("Y-m-d"),
    				);
    
    				$det_dc_id = $this->DeliveryCModel->AddTrandcDetails($postDetails);
    					$issue_doc_id = $det_dc_id;
    					$this->updateTranDCStockRegular($part_id,$op_id[$key],$det_dc_id,$mast_dc_id,$quantity[$key]);
        		
    			}
		    
            redirect('/viewDeliveryC');
		    }
		    else{
		        $this->session->set_flashdata('dcmsg', 'Part Delivery Challan Details should be mandatory!');
		        $this->add();
		    }

		}else
		 {
			$this->add();
		}
		
	}
	
	public function updateTranDCStockRegular($part_id,$op_id,$det_dc_id,$mast_dc_id,$quantity){
	    error_reporting(0);
	    $issue_doc_id=$det_dc_id;
	    	$postStockDetails = array(
        				'mast_dc_id' 	=> $mast_dc_id,
        				'det_dc_id' 	=> $det_dc_id,
        				'part_id' 		=> $part_id,
        				'op_id' 		=> $op_id,
        				'year' 			=> $_SESSION['current_year'],
        				'doc_year' 		=> $_SESSION['current_year'],
        				'tran_date' 	=> $this->input->post('Other_date'),
        				'issue_qty' 	=> $quantity,
        				'issue_doc_type'=> 'tran_dc',
        				'issue_doc_id' 	=> $det_dc_id,
        				'branch_id'     => $_SESSION['branch_id'],
        				'move_from'     => "B".$_SESSION['branch_id'],
        				'move_to'       => "S".$this->input->post('Supplier_Id'),
        				'created_by ' 	=> $_SESSION['id'],
        				'created_on ' 	=> date("Y-m-d"),
        				);
        				
        		$this->DeliveryCModel->AddDCTranStock($postStockDetails);
    			$dc_qty = $quantity;
        				  
			       
			       //end of booked qty new addition*/
			       
			       if ($dc_qty>0 && ($quantity>0))
			       {
        	
        	       	$updatePartOpStock = $this->getQueryModel->updatePartOpStock($part_id,$op_id); 
        
						if(!empty($updatePartOpStock))
						{
                              $det_rmrcir_id='';
							foreach ($updatePartOpStock as $key => $value) 
							{
								$id 	                = $value['id'];
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id 	                = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$mast_partsrcir_id 	    = $value['mast_partsrcir_id'];
						     	$available_qty   	    = $value['max_qty'];
						     	$det_rmrcir_id          = $det_rmrcir_id.",".$value['det_rmrcir_id'];
							    $dc_Qty1                 = ($dc_qty != "") ? $dc_qty : 0;
                                
								if($doc == "dpr")
								{   
							    	$UpdateDate67 = array(
        									'part_id' 			=> $value['part_id'],
        									'operation_id' 		=> $op_id,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=>  $_SESSION['current_year'],
        						            'doc_year' 			=>  $_SESSION['current_year'],
        						            'tran_date' 	    => $this->input->post('Other_date'),
        									'issue_qty' 		=> ($available_qty>$dc_Qty1)?$dc_Qty1:$available_qty,
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $_SESSION['branch_id'],
        									'move_from'         => "B".$_SESSION['branch_id'],
        			                    	'move_to'           => "S".$this->input->post('Supplier_Id'),
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
        									'issue_doc_id' 		=> $issue_doc_id,
        									'issue_doc_type' 	=> 'tran_dc'
								    );
								
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									
									
								}else{
								    if($value['booked_qty']){}
								    $UpdateDate67 = array(
        									'part_id' 			    => $value['part_id'],
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'det_partsrcir_id' 	    => $mast_id,
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date' 	        => $this->input->post('Other_date'),
        									'issue_qty' 		    => ($available_qty>$dc_Qty1)?$dc_Qty1:$available_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
        									'move_from'             => "B".$_SESSION['branch_id'],
        			                    	'move_to'               => "S".$this->input->post('Supplier_Id'),
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'issue_doc_id' 		    => $issue_doc_id,
        									'issue_doc_type' 	    => 'tran_dc'
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
								}
                                
                                //$dc_qty = $quantity[$key];
                                $used_qty =($available_qty>$dc_Qty1)?$dc_Qty1:$available_qty;
                                 $dc_qty =$dc_qty - $used_qty;
                                if ($dc_qty<=0)
                                {break;}
							
							} //updatePartOpStock foreach End
							
                     $query = $this->db->query("update tran_dc_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$det_rmrcir_id."',concat(det_rmrcir_id,',','".$det_rmrcir_id."')) where det_dc_id='$issue_doc_id' and issue_qty>0 and issue_doc_id='$issue_doc_id'");
                     $data = $this->db->affected_rows();

						 } //updatePartOpStock id
						 
			       }  //end  if quantity remains even after booked_qty is processed.
    				
	}
	
	//For Supplier Movement
		public function updateTranDCSupplMvmtStock($part_id,$op_id,$det_dc_id,$mast_dc_id,$quantity,$det_partsrcir_id,$mast_rcir_id){
	    error_reporting(0);
	    $issue_doc_id=$det_dc_id;
	    	$postStockDetails = array(
        				'mast_dc_id' 	=> $mast_dc_id,
        				'det_dc_id' 	=> $det_dc_id,
        				'part_id' 		=> $part_id,
        				'op_id' 		=> $op_id,
        				'year' 			=> $_SESSION['current_year'],
        				'doc_year' 		=> $_SESSION['current_year'],
        				'tran_date' 	 => $this->input->post('date'),
        				'issue_qty' 	=> $quantity,
        				'issue_doc_type'=> 'supl_pmovement',
        				'issue_doc_id' 	=> $det_dc_id,
        				'branch_id'     => $_SESSION['branch_id'],
        				'move_from'     =>"B".$_SESSION['branch_id'],
        				'move_to'       =>"S".$this->input->post('Supplier_Id'),
        				'created_by ' 	=> $_SESSION['id'],
        				'created_on ' 	=> date("Y-m-d"),
        				);
        				
        		$this->DeliveryCModel->AddDCTranStock($postStockDetails);
    			$dc_qty = $quantity;
        	
			    
			       if ($quantity>0)
			       {
			           $op_id_prev=$this->getQueryModel->getPrevOperRCIR($mast_rcir_id,$det_partsrcir_id);
						//	$part_id,$op_id,$det_dc_id,$mast_dc_id,$quantity,$det_partsrcir_id,$mast_rcir_id	  
								    $UpdateDate67 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id_prev,
        									'mast_partsrcir_id' 	=> $mast_rcir_id,
        									'det_partsrcir_id' 	    => $det_partsrcir_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        						            'tran_date' 	        => $this->input->post('date'),
        									'issue_qty' 		    => $quantity,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
                            				'move_from'             =>"B".$_SESSION['branch_id'],
                				            'move_to'               =>"S".$this->input->post('Supplier_Id'),        									
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'issue_doc_id' 		    => $issue_doc_id,
        									'issue_doc_type' 	    => 'supl_pmovement'
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
								
        	     //===================================================================================================================
        	      
						 
			       }  
    				
	    
	}

	
	public function updateDC()
	{
	    //echo "<pre>";print_r($_POST);die;
			$editId			=$this->input->post('editId');
			$DCDId		    =$this->input->post('DCDId');
			$edit_quantity		=$this->input->post('edit_quantity');
		

			foreach($DCDId as $key => $mast_dc_id)
			{
				$updatepostDate = array(
				'qty_in_kgs' 		=> $qty_in_kgs[$key],
				'qty' 	=> $edit_quantity[$key],
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);

			$res=$this->DeliveryCModel->UpdateTrandcDetails($updatepostDate,$mast_dc_id);
			}

			/*-------------Update Otherpo_mast and insert Otherpo_details-------------*/

			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('Other_date'),
				'year'				=> $_SESSION['current_year'],
				'dc_no' 			=> $this->input->post('dc_no'),
				'vehicle_no' 		=> $this->input->post('vehicle_no'),
				'transporter_name' 	=> $this->input->post('transporter_name'),
				//'dc_type' 			=> $this->input->post('dc_type'),
				'remarks' 			=> $this->input->post('Remark'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->DeliveryCModel->UpdateTrandcMast($postDate,$editId);

			$parts_po_det_id	=$this->input->post('parts_po_det_id');
			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$part_remark		=$this->input->post('part_remark');
			$qty_in_kgs			=$this->input->post('qty_in_kgs');
			$quantity			=$this->input->post('quantity');
			$rate				=$this->input->post('rate');
			$unit				=$this->input->post('Unit');
			$igst				=$this->input->post('igst');
			$cgst 				=$this->input->post('cgst');
			$sgst 				=$this->input->post('sgst');
			$max_qty 			=$this->input->post('max_qty');
            
        
            if($Part_Id[0] !='')
            {
    			foreach($Part_Id as $key => $part_id)
    			{
    				$postDetails = array(
    				'mast_dc_id' 	    => $editId,
    				'part_id' 			=> $part_id,
    				'op_id' 			=> $op_id[$key],
    				'qty_in_kgs' 		=> $qty_in_kgs[$key],
    				'qty' 				=> $quantity[$key],
    				'parts_po_det_id' 	=> $parts_po_det_id[$key],
    				'max_qty' 	        => $max_qty[$key],
    				'rate' 	            => $rate[$key],
    				'unit' 	            => $unit[$key],
    				'igst' 	            => $igst[$key],
    				'cgst' 	            => $cgst[$key],
    				'sgst' 	            => $sgst[$key],
    				'created_by ' 		=> $_SESSION['id'],
    				'created_on ' 		=> date("Y-m-d"),
    				);
    
    				$det_dc_id=$this->DeliveryCModel->AddTrandcDetails($postDetails);
    				
    			     $this->updateTranDCStockRegular($part_id,$op_id[$key],$det_dc_id,$editId,$quantity[$key]);
    				
    			
    			}
    		
            }
			redirect('/viewDeliveryC');
		
	}
	

	public function getPoRateDetails()
	{
	   $res     = $this->getQueryModel->getPoRateDetails();
	   $partId = $res['part_id'];
	   if(!empty($partId))
	   {
	   $opId = $res['op_id'];
	   if($_POST['Rework']=='YES'){
	        $maxQ   = $this->getQueryModel->getReworkOpQty($partId,$opId);
	          $array = array('id'=>0,'rate'=>0,'uom'=>$res['uom'],'part_remark'=>$res['part_remark'],'igst'=>0,'cgst'=>0,'sgst'=>0,'max_qty'=>$maxQ,'pobalqty'=>9999999);
	   
	   }else{
	     $maxQ   = $this->getQueryModel->getPrevOpQty($partId,$opId);
	     $poBalQty   = $this->getQueryModel->getPoBalQty($res['id']);
	     
	     $array = array('id'=>$res['id'],'rate'=>$res['rate'],'uom'=>$res['uom'],'part_remark'=>$res['part_remark'],'igst'=>$res['igst'],'cgst'=>$res['cgst'],'sgst'=>$res['sgst'],'max_qty'=>$maxQ,'pobalqty'=>$poBalQty);
	 
	   }
	   //$maxQ   = $this->getQueryModel->getSumOfQty($partId,$OPres['op_id']);
	   echo json_encode($array);
	    
	   }else
	   {
	       echo "PO not found for this operation.";
	   }
	    
	}
	
	public function getDCOpByPartId()
	{
	    if(!empty($_POST))
	    {
    	    $Part_Id 	=$this->input->post('Part_Id');
    	    $Supplier_Id =$this->input->post('Supplier_Id');
    		$getOpData  = $this->getQueryModel->getDCOperationByPart($Part_Id,$Supplier_Id);
    		//echo '<select class="form-control Part_Id" id="Part_Id" name="Part_Id[]" value="">';
    			echo '<option value="">Operation</option>';
    			foreach($getOpData as $list)
    			{ 
    			$opDetails  = $this->getQueryModel->getOperationsById($list['op_id']);
    			$ids=$opDetails['id'];
    			$name=$opDetails['Name'];
    			echo '<option value="'.$ids.'" >'.$name.'</option>';
    			 } 
    		// echo '</select>';
	    }
	}
	
	public function getQtyByKG()
	{
	    if(!empty($_POST))
	    {
    	    $Part_Id 	=$this->input->post('Part_Id');
    	    $qty_in_kgs 	=$this->input->post('qty_in_kgs');
    	    $NWeight = $this->getQueryModel->getNetWeightByPartId($Part_Id);
    		echo $qtyinkgs = $qty_in_kgs*1000/$NWeight['netweight'];
    	    
	    }
	}

	public function deleteDCDetails(){
		$postDate = array(
		        'qty' => 0,
		        'qty_in_kgs'=> 0,
				'isdeleted' => 1,
				);
		$data = $this->DeliveryCModel->deleteDcDetails($postDate);

		    $det_dc_id=$_POST['editId'];		
				$postStockDetails = array(
        				'issue_qty' 	=> 0,
        				'updated_by' 	=> $_SESSION['id'],
        				'updated_on' 	=> date("Y-m-d H:i:s"),
        				);
			$res=$this->DeliveryCModel->UpdateDCStock($postStockDetails,$det_dc_id);
	}


}

?>