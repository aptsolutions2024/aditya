<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PartsMovementController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('PartsMovement/PartsMovementModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{
	//	$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getPartsMovement'] 	= $this->getQueryModel->getPartsMovement();
		$this->load->view('PartsMovement/view',$data);
	}
	public function getMovementOpByPartId()
	{
	    if(!empty($_POST))
	    {
	    $Part_Id 	=$this->input->post('Part_Id');
	    $getOpData  = $this->getQueryModel->getMoveOperationByPart($Part_Id);
		echo '<select class="form-control Part_Id" id="Part_Id" name="Part_Id[]" value="">';
			echo '<option value="">Operation</option>';
			foreach($getOpData as $list)
			{ 
			$ids=$list['id'];
			$name=$list['Name'];
			$sequence_no=$list['sequence_no'];
			echo '<option value="'.$ids.'" data-id="'.$sequence_no.'">'.$name.'</option>';
			 } 
		 echo '</select>';
	    }
	}
	public function getMoveRateDetails()
	{
	   // print_r($_POST);die;
	   // $res     = $this->getQueryModel->getMoveRateDetails();
	   $partId = $_POST['Part_Id'];
	   $opId = $_POST['Op_Id'];

	   if(!empty($partId))
	   {
	   $maxQ   = $this->getQueryModel->getCurrentOpQty($partId,$opId);
	    $array = array('max_qty'=>$maxQ);
	      echo json_encode($array);
	   }else
	   {
	       echo "0";
	   }
	    
	}
	
	public function add()
	{
		$id = base64_decode($_GET['ID']);
	//	$data['getProdfamily'] 	    = $this->getQueryModel->getProductfamily();
		$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		$data['getBranch']        = $this->getQueryModel->getBranch();
		$data['getPartMovement']        = $this->getQueryModel->getPartMovement($id);
		$this->load->view('PartsMovement/add',$data);
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
	    
	   $this->form_validation->set_rules('Part_Id', 'part', 'trim|required');
		$this->form_validation->set_rules('Op_Id', 'Operation', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
        $part_id = $this->input->post('Part_Id');
        $Op_Id = $this->input->post('Op_Id');
		if ($this->form_validation->run() == TRUE) {
		    $postDate = array(
				'part_id' => $this->input->post('Part_Id'),
				'op_id' => $this->input->post('Op_Id'),
				'qty' => $this->input->post('quantity'),
				'from_branch_id' => $_SESSION['branch_id'],
				'to_branch_id' => $this->input->post('branch_id'),
				'date' => $this->input->post('date'),
				'year' 	=> $_SESSION['current_year'],
				'created_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				);
			$partMovementId=$this->PartsMovementModel->addtranPMovement($postDate);
			
            $getPartOperationStock = $this->getQueryModel->getPartOperationStock($part_id,$Op_Id); 

                        
						if(!empty($getPartOperationStock))
						{
                            $dpr_qty= $this->input->post('quantity');
                            $det_rmrcir_id='';
							foreach ($getPartOperationStock as $key => $value) 
							{
								$id 	                = $value['id'];
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id 	                = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$mast_partsrcir_id 	    = $value['mast_partsrcir_id'];
                            	$available_qty   	    = $value['max_qty'];
                            	$det_rmrcir_id          = $det_rmrcir_id.",".$value['det_rmrcir_id'];
						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
								if($doc == "dpr")
								{   
							    	$UpdateDate67 = array(
        									'part_id' 			=> $part_id,
        									'operation_id' 		=> $op_id,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=>  $_SESSION['current_year'],
        						            'doc_year' 			=>  $_SESSION['current_year'],
        						            'tran_date'         => $this->input->post('date'),
        									'issue_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        							    	//'issue_qty' 		=> ($dpr_qty != "") ? $dpr_qty : 0,
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $_SESSION['branch_id'],
        									'move_from'             => "B".$_SESSION['branch_id'],
        				                    'move_to'               => "B".$this->input->post('branch_id'),
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
        									'issue_doc_id' 		=> $partMovementId,
        									'issue_doc_type' 	=> 'p_movement'
								    );
								
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									
									
								}else{
								    
								    $UpdateDate67 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'det_partsrcir_id' 	    => $mast_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        						            'tran_date'             => $this->input->post('date'),
        									'issue_qty' 		    => ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
        									'move_from'             => "B".$_SESSION['branch_id'],
        				                    'move_to'               => "B".$this->input->post('branch_id'),
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'issue_doc_id' 		    => $partMovementId,
        									'issue_doc_type' 	    => 'p_movement'
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
								}

					echo		 $used_qty =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
					echo "   111  ";
                                 $dpr_qty =$dpr_qty - $used_qty;
                                if ($dpr_qty<=0)
                                {break;}
							
							} //$getPartOperationStock foreach End
						
							
			$postDate = array(
				'supplier_id' 		=> 0 ,
				'branch_id'			=> $this->input->post('branch_id'),
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 	    => $this->input->post('date'),
				'challan_no' 	     => 'p_movement',
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				
			$mast_partsrcir_id  =  $this->PartsMovementModel->AddTranPartsrcirMast($postDate);
			  $postDetails = array(
        				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        				'tran_partspo_det_id' 	=> 0,
        				'dc_det_id' 	        => 0,
        				'part_id' 			    => $part_id,
        				'op_id' 		        => $op_id,
        				'qty' 				    => $this->input->post('quantity'),
        				'qty_in_kgs' 		    => 0,
        				'inprocess_loss_qty' 	=> 0,
        				'qc_checked_by'         => '999999',
        				'qc_remarks'            =>'p_movement',
        				'qc_checked_on'         => date("Y-m-d H:i:s"),
        				'year ' 		        => $_SESSION['current_year'],
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);

				$det_partsrcir_id = $this->PartsMovementModel->AddTranPartsrcirDetails($postDetails);
			
							 $UpdateDate68 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'det_partsrcir_id' 	    => $det_partsrcir_id,
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date'             => $this->input->post('date'),
        									'received_qty' 		    => $this->input->post('quantity'),
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $this->input->post('branch_id'),
        									'move_from'             => "B".$_SESSION['branch_id'],
        				                    'move_to'               => "B".$this->input->post('branch_id'),
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'received_doc_id' 		    => $partMovementId,
        									'received_doc_type' 	    => 'p_movement'
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate68);
									 $this->invoiceAdj($part_id);
	            $query = $this->db->query("update tran_partsrcir_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$det_rmrcir_id."',concat(det_rmrcir_id,',','".$det_rmrcir_id."')) where det_partsrcir_id='$det_partsrcir_id'");
	           $data = $this->db->affected_rows();
						 } //if				
							
		//	print_r($_POST);
		//	die;
			redirect('/PartsMovement');

		}else
		 {
		    
			$this->add();
		}
	}
		public function invoiceAdj($part_id){
    //*******************************************************************************************************
    $branch_id=$this->input->post('branch_id');
	    $query=$this->db->query("select issue_qty,issue_doc_id,doc_year,tran_date from tran_dpr_stock where part_id='$part_id' and mast_dpr_id='9999999' and issue_qty>0 and branch_id='$branch_id' and year='$_SESSION[current_year]'");
	    $stockAdjqty=$query->result_array();
	    
	    //print_r($stockAdjqty);
	    	foreach ($stockAdjqty as $key => $stkqty) 
			{
	    	          $updatePartOpStock1 = $this->getQueryModel->updateInvoiceAdjPMovement($part_id,'47',$branch_id); 
	    	          
	    	          	    //print_r($updatePartOpStock1);
                        $dpr_qty=$stkqty['issue_qty'];
                        
						if(!empty($updatePartOpStock1))
						{
						       $det_rmrcir_id='';
						  $updated_qty=0;
							foreach ($updatePartOpStock1 as $key => $value) 
							{
								$id 	                = $value['id'];
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id 	                = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$mast_partsrcir_id 	    = $value['mast_partsrcir_id'];
                            	$available_qty   	    = $value['max_qty'];
                            	if($value['det_rmrcir_id']){
                            	$det_rmrcir_id          = $det_rmrcir_id.",".$value['det_rmrcir_id'];
                            	}
						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
								if($doc == "dpr")
								{  
								    $tempqty=($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
							    	$UpdateDate67 = array(
        									'part_id' 			=> $part_id,
        									'operation_id' 		=> $op_id,
        									'prod_plan_id'       =>$prod_plan_id,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=> $_SESSION['current_year'],
        						            'doc_year' 			=> $stkqty['doc_year'],
        						            'tran_date'         => $stkqty['tran_date'],
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $branch_id,
                    	           //         'move_from'         => "B".$_SESSION['branch_id'],
                            				// 'move_to'           => "B".$_SESSION['branch_id'],
                            				'issue_qty' 		=> $tempqty,
        									'issue_doc_id' 		=> $stkqty['issue_doc_id'],
        									'issue_doc_type' 	=> 'invoice',
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
                                            'created_on' 		=> date("Y-m-d H:i:s")
								    );
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									$updated_qty=$updated_qty+$tempqty;
									
								}else{
								    
								    $tempqty=($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
								    $UpdateDate67 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'prod_plan_id'          => $prod_plan_id,
        									'det_partsrcir_id' 	    => $mast_id,
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 		    	=> $stkqty['doc_year'],
        						            'tran_date'             => $stkqty['tran_date'],
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $branch_id,
                    	           //         'move_from'             => "B".$_SESSION['branch_id'],
                            				// 'move_to'               => "B".$_SESSION['branch_id'],    									
        									'issue_qty' 		    => $tempqty,
        									'issue_doc_id' 		    => $stkqty['issue_doc_id'],
        									'issue_doc_type' 	    => 'invoice',
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
                                            'updated_on' 		    => date("Y-m-d H:i:s"),
                                            'created_on' 		    => date("Y-m-d H:i:s")
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
									$updated_qty=$updated_qty+$tempqty;
								}

							 $used_qty =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
                                 $dpr_qty =$dpr_qty - $used_qty;
                                if ($dpr_qty<=0)
                                {break;}
							
							} //updatePartOpStock foreach End
                           
                                $query = $this->db->query("update tran_dpr_stock set issue_qty=issue_qty-'$updated_qty' where mast_dpr_id='9999999' and part_id='$part_id' and operation_id='47' and issue_qty>0 and issue_doc_id='$stkqty[issue_doc_id]'");
	                            $data = $this->db->affected_rows();
	                            
                                $query = $this->db->query("update tran_dpr_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$det_rmrcir_id."',concat(det_rmrcir_id,',','".$det_rmrcir_id."')) where mast_dpr_id='$issue_doc_id'");
	                            $data = $this->db->affected_rows();
                           
						 } //updatePartOpStock id
						 
			}  //stockAdjqty foreach
			
		
	                      
	//******************************************************************************************************
}
	public function update(){
	 $this->session->unset_userdata('createS');
		$this->form_validation->set_rules('quantity', 'Qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
     
		if ($this->form_validation->run() == TRUE) {
		    $postDate = array(
				'qty' => $this->input->post('quantity'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);
			$editid=$_POST['editID'];
			$branch_id=$_POST['branch_id'];
		
			 $partMovementId=$this->PartsMovementModel->updatedtranPMovement($postDate,$editid);
			
             $dataarray=array('issue_qty' => '0');
	         $where=array('issue_doc_id' => $editid,'issue_doc_type' => 'p_movement');
	         $res1 = $this->db->update('tran_dpr_stock',$dataarray,$where);

	         $res2 = $this->db->update('tran_partsrcir_stock',$dataarray,$where);

             $dataarray1=array('received_qty' =>'0');
	         $where1=array('received_doc_id'=>$editid,'received_doc_type'=>'p_movement','branch_id'=>$branch_id);
	         $res3 = $this->db->update('tran_partsrcir_stock',$dataarray1,$where1);
			
			if($partMovementId){
			 	 $this->session->set_flashdata('createS', 'Quantity Updated successfully.');
			}else{
			     $this->session->set_flashdata('createS', 'Error While Updating record.');
			}
		   
		}else{ 
		    $this->session->set_flashdata('createS', 'Enter Quantity...');
		}
		redirect('/addPartsMovement?ID='. base64_encode($editid)); 
	}
	
// 	public function deleteRMMovement()
// 	{
// 	   $rm_id = $_POST['rmId'];
// 	   $getRmAvailStock = $this->getQueryModel->getRmAvailStock($rm_id );
// 	   foreach ($getRmAvailStock as $key => $value) 
//             {
//           echo $mast_rmrcir_id = $value['mast_id'];
//           echo "<br>";
//           echo  $det_rmrcir_id  = $value['det_id'];
//             }
// 	}
	//created by Asharani for Parts Movement Print- 28/06/2023
	public function partMvmtPrint(){
	    $id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
         $data['getPartMovement']        = $this->getQueryModel->getPartMovement($id);
    	
		$this->load->view('PartsMovement/partMvmtPrint',$data);
	}
	
}

?>