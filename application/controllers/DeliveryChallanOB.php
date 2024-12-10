<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DeliveryChallanOB extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->model('DeliveryChallan/DeliveryCModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{	
    	$data['getTrandcmast'] = $this->getQueryModel->getTrandcmastOB();
		$this->load->view('DeliveryChallanOB/view',$data);
	}
	public function dcPrint()
	{
    	$id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
    	$data['getDCMastById'] 	    = $this->getQueryModel->getDCMastById($id);
		$data['getDCDetails']       = $this->getQueryModel->getDCDetails($id);
		$this->load->view('DeliveryChallanOB/dcPrint',$data);
	}
	public function add()
	{
		$id = base64_decode($_GET['ID']);
		$data['getSupplier']        = $this->getQueryModel->getSupplier(2);
		$data['getPartName']   		= $this->getQueryModel->getPartName();
		//$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getDCMastById'] 	    = $this->getQueryModel->getDCMastById($id);
		$data['getDCDetails']       = $this->getQueryModel->getDCDetails($id);
		$this->load->view('DeliveryChallanOB/add',$data);
	}

	public function createDCOB()
	{
	    
		$this->session->unset_userdata('dcmsg');
	    $this->form_validation->set_rules('Supplier_Id', 'supplier', 'trim|required');
		$this->form_validation->set_rules('Other_date', 'date', 'trim|required');
		//$this->form_validation->set_rules('vehicle_no', 'vehicle no.', 'trim|required');
		//$this->form_validation->set_rules('transporter_name', 'transporter name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		     //echo "<pre>";print_r($_POST);die;
            //$DCTYPE = $this->input->post('dc_type');
            
            
            $parts_po_det_id	=$this->input->post('parts_po_det_id');
			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$qty_in_kgs			=$this->input->post('qty_in_kgs');
			$quantity			=$this->input->post('quantity');
			
            if(!empty($Part_Id[0] && $op_id[0] && $quantity[0]))
		    {
		        
			$postDate = array(
				'supplier_id' 		=> $this->input->post('Supplier_Id'),
				'date' 				=> $this->input->post('Other_date'),
				'remarks' 			=> $this->input->post('Remark'),
				'year'				=> $_SESSION['current_year'],
				'branch_id ' 		=> $_SESSION['branch_id'],
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d"),
				);
				
			
			$mast_dc_id = $this->DeliveryCModel->AddTrandcMast($postDate);

			
    			foreach($Part_Id as $key => $part_id)
    			{
    			    if($part_id){
        				$postDetails = array(
        				'mast_dc_id' 	    => $mast_dc_id,
        				'part_id' 			=> $part_id,
        				'op_id' 			=> $op_id[$key],
        				'qty_in_kgs' 		=> $qty_in_kgs[$key],
        				'qty' 				=> $quantity[$key],
        				'parts_po_det_id' 	=> $parts_po_det_id[$key],
        				'created_by ' 		=> $_SESSION['id'],
        				'created_on ' 		=> date("Y-m-d"),
        				);
    
    				    $det_dc_id = $this->DeliveryCModel->AddTrandcDetails($postDetails);
    			
    					$this->updateTranDCStockRegular($part_id,$op_id[$key],$det_dc_id,$mast_dc_id,$quantity[$key]);
    			    }
    			}
		    
            redirect('/viewOBDeliveryC');
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
    				
	}
	
	public function updateDCOB()
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
			//	'vehicle_no' 		=> $this->input->post('vehicle_no'),
			//	'transporter_name' 	=> $this->input->post('transporter_name	'),
				//'dc_type' 			=> $this->input->post('dc_type'),
			//	'remarks' 			=> $this->input->post('Remark'),
				'updated_by ' 		=> $_SESSION['id'],
				'updated_on ' 		=> date("Y-m-d H:i:s"),
				);
			$this->DeliveryCModel->UpdateTrandcMast($postDate,$editId);

			$parts_po_det_id	=$this->input->post('parts_po_det_id');
			$Part_Id			=$this->input->post('Part_Id');
			$op_id				=$this->input->post('Op_Id');
			$qty_in_kgs			=$this->input->post('qty_in_kgs');
			$quantity			=$this->input->post('quantity');
            
        
            if($Part_Id[0] !='')
            {
    			foreach($Part_Id as $key => $part_id)
    			{
    			    if($part_id){
    				$postDetails = array(
    				'mast_dc_id' 	    => $editId,
    				'part_id' 			=> $part_id,
    				'op_id' 			=> $op_id[$key],
    				'qty_in_kgs' 		=> $qty_in_kgs[$key],
    				'qty' 				=> $quantity[$key],
    				'parts_po_det_id' 	=> $parts_po_det_id[$key],
    				'created_by ' 		=> $_SESSION['id'],
    				'created_on ' 		=> date("Y-m-d"),
    				);
    
    				$det_dc_id=$this->DeliveryCModel->AddTrandcDetails($postDetails);
    				
    			     $this->updateTranDCStockRegular($part_id,$op_id[$key],$det_dc_id,$editId,$quantity[$key]);
    			    }	
    			
    			}
    		
            }
			redirect('/viewOBDeliveryC');
		
	}
	

	public function getPoRateDetails()
	{
	   $res     = $this->getQueryModel->getPoRateDetails();
	   $partId = $res['part_id'];
	   if(!empty($partId))
	   {
	   $opId = $res['op_id'];
	   $maxQ   = $this->getQueryModel->getPrevOpQty($partId,$opId);
	   //$maxQ   = $this->getQueryModel->getSumOfQty($partId,$OPres['op_id']);
	   
	   $array = array('id'=>$res['id'],'rate'=>$res['rate'],'uom'=>$res['uom'],'part_remark'=>$res['part_remark'],'igst'=>$res['igst'],'cgst'=>$res['cgst'],'sgst'=>$res['sgst'],'max_qty'=>$maxQ);
	   echo json_encode($array);
	   }else
	   {
	       echo "PO not found for this operation.";
	   }
	    
	}
	

	



}

?>