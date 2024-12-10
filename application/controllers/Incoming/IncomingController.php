<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

class IncomingController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	//	$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
	//	$this->load->model('TranDPR/TranDPRModel');
	}
	public function getPartsrcirDetail()
	{
		$id 				= $_GET['id'];
		$getPartsrcirMast 	= $this->GetQueryModel->getPartsrcirDetail($id);
		//$getPartsrcirMast 	= $this->GetQueryModel->getPartsrcirDetailForPendingQC($id);

		$array = [];
		foreach ($getPartsrcirMast as $key => $value) 
		{
			$getPartsById 	= $this->GetQueryModel->getPartsById($value['part_id']);
			$getOperation 	= $this->GetQueryModel->getOperation($value['op_id']);

			$array[] = array(
					"id" 				=> $value['id'],
					"part_id" 			=> $getPartsById['name'],
					"op_id" 			=> $getOperation['name'],
					"qty" 				=> $value['qty'],
					"inprocess_loss_qty" => (!empty($value['inprocess_loss_qty'])) ? $value['inprocess_loss_qty'] : "0",
					"rejected_qty" 	    => (!empty($value['rejected_qty'])) ? $value['rejected_qty'] : "0",
					"qc_remarks"        => (!empty($value['qc_remarks'])) ? $value['qc_remarks'] : "-",
			);
		}

		echo json_encode($array);


	}
	public function GetIncomingData()
	{

		$flag 				= $_POST['flag'];
		$date 				= $_POST['date'];
		$getPartsrcirMast 	= $this->GetQueryModel->getPartsrcirMast($date,$flag);

		$array = [];
		foreach ($getPartsrcirMast as $key => $value) 
		{
			if($flag != "pending")
			{
				$supplier  = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
					$getPartsById 	= $this->GetQueryModel->getPartsById($value['part_id']);
					$getOperation 	= $this->GetQueryModel->getOperation($value['op_id']);
				$array[] = array(
						"mast_id" 			=> $value['mast_id'],
						"supplier_id" 	    => $supplier['name'],
						"date" 			    => $value['date'],
						"challan_no" 	    => $value['challan_no'],
						"challan_date" 	    => date('d-m-Y',strtotime($value['challan_date'])),
						"id" 				=> $value['id'],
						"id_encode" 		=> base64_encode($value['id']),
						"part_id" 			=> $getPartsById['name'],
						"partno" 			=> $getPartsById['partno'],
						"op_id" 			=> $getOperation['name'],
						"qc_remarks" 		=> $value['qc_remarks'],
						"qty" 				=> $value['qty']
				);
			}else{
					$getPartsById 	= $this->GetQueryModel->getPartsById($value['part_id']);
					$getOperation 	= $this->GetQueryModel->getOperation($value['op_id']);

					$array[] = array(
						"id" 				=> $value['id'],
						"id_encode" 		=> base64_encode($value['id']),
						"part_id" 			=> $getPartsById['name'],
						"partno" 			=> $getPartsById['partno'],
						"op_id" 			=> $getOperation['name'],
						"qty" 				=> $value['qty']
					);
			}
		}

		echo json_encode($array);
	}
	public function Incoming()
	{


		date_default_timezone_set("Asia/Calcutta");
		//$this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('pendingval', 'pendingval', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) 
		{

			$pendingval  = $_POST['pendingval'];
			$scheduleDate  = $_POST['date'];
			$toDate 	   = date("Y-m", strtotime($scheduleDate));

			$data['date'] 	= $_POST['date'];
			$data['pendingval'] 	= $_POST['pendingval'];
			$data['getPartsrcirMast'] 	= $this->GetQueryModel->getPartsrcirMast($toDate,$pendingval);
			$this->load->view('Incoming/viewIncoming',$data);
		}else{
			
			$this->load->view('Incoming/viewIncoming'); 
		}
	}
	public function getQualityCheck()
	{
		$type 				= $_POST['type'];
		$dpr_qc_id 	= (!empty($_POST['dpr_qc_id'])) ? $_POST['dpr_qc_id'] : "";

		$getRMBymaterialType = $this->GetQueryModel->getRMBymaterialType('P');

      	$str6 .="<option value=''> Select QC</option>";
		foreach ($getRMBymaterialType as $key => $value) 
		{ 
			echo $sele = ($dpr_qc_id == $value['id']) ? "selected" : ""; 

			if($value['qc_type'] == $type)
			{
				$str6 .= "<option ".$sele." value='".$value['id']."'>". $value['name']."</option>";			
			}
        }

		echo $str6;
	}
	public function addIncoming()
	{
	    //date_default_timezone_set("Asia/Calcutta"); 
          error_reporting(0);
			$id = base64_decode($_GET['id']);
			  $this->session->unset_userdata('pendingVal');
			  $this->session->unset_userdata('pendingDate');
			
			if(!empty($id))
			{
				// $data['GetQcDPRById'] = $this->GetQueryModel->GetQcDPRById($id);
				$data['GetQcPartsrcirById'] = $this->GetQueryModel->GetQcPartsrcirById($id);
				$getPartsrcirDetailbyId 	= $this->GetQueryModel->getPartsrcirDetailbyId($id);
				$data['GetQcPartsrcirIssueQty'] 	= $this->GetQueryModel->GetQcPartsrcirIssueQty($id);
				
				$mast_partsrcir_id = $getPartsrcirDetailbyId['mast_partsrcir_id'];

				$part_id = $getPartsrcirDetailbyId['part_id'];
				$getPartsById 	= $this->GetQueryModel->getPartsById($part_id);

				$op_id = $getPartsrcirDetailbyId['op_id'];
				$getOperation 	= $this->GetQueryModel->getOperation($op_id);

				$getPartsrcirMastbyId 	= $this->GetQueryModel->getPartsrcirMastbyId($mast_partsrcir_id);
				
				$supplier_id = $getPartsrcirMastbyId['supplier_id'];
				$getSupplierById 	= $this->GetQueryModel->getSupplierById($supplier_id);
				
				$date = $getPartsrcirMastbyId['date'];


				$data['incoming'] = array(
					'date' 					=> date("d-m-Y", strtotime($date)),
					'supplier_name' 		=> $getSupplierById['name'],
					'part_name' 			=> $getPartsById['name'],
					'partno' 				=> $getPartsById['partno'],
					'part_id' 				=> $getPartsById['part_id'],
					'op_name' 				=> $getOperation['name'],
					'op_id' 				=> $getOperation['id'],
					'qty' 					=> $getPartsrcirDetailbyId['qty'],
					'mast_partsrcir_id' 	=> $getPartsrcirMastbyId['id'],
					'final_qty' 			=>$getPartsrcirDetailbyId['rejected_qty'],
					'qc_remarks' 			=>$getPartsrcirDetailbyId['qc_remarks'],
					'Accepted_type_det' 	=>$getPartsrcirDetailbyId['Accepted_type_det'],
					'tran_partspo_det_id' 	=>$getPartsrcirDetailbyId['tran_partspo_det_id']
				);

				// $data['getRMBymaterialType'] 	= $this->GetQueryModel->getRMBymaterialType('P');
				$this->session->set_flashdata('pendingDate',date('Y-m',strtotime($date)));
				$this->session->set_flashdata('pendingVal', 'all');
				$this->load->view('Incoming/add-incoming',$data);
			}else{
          // echo "<pre>";	print_r($_POST);  echo "</pre>";
				$final_qty 				=(is_null($_POST['final_qty']))?0:$_POST['final_qty'];
				$qc_remark 				= $_POST['qc_remark'];
				$accepted_type_det 		= $_POST['accepted_type_det'];
				$tran_partspo_det_id 	= $_POST['tran_partspo_det_id'];
                $prcir_date = date('Y-m-d',strtotime($_POST['dpr_date']));
       
                
         //-----------------------------Begin of rework-------------------------------
                  $rcirDetId=$_POST['editId'];
                if($accepted_type_det == 'D')  //D - Rework
				{
				       
                $q11 = $this->db->query("select id,mast_partsrcir_id,det_partsrcir_id from tran_partsrcir_stock where received_doc_id='$_POST[editId]' and received_doc_type='qc_rework'");
                $pData=$q11->row_array();
                if ($q11->num_rows() == 0) 
                {
				          $postDate = array(
                				'supplier_id' 		=> 0,
                				'branch_id'			=> $_SESSION['branch_id'],
                				'date'			    => $prcir_date,
                				'year'				=> $_SESSION['current_year'],
                				'challan_date' 		=> date("Y-m-d"),
                				'challan_no' 	    => 'qc_rework-'.$rcirDetId,
                				'created_by ' 		=> $_SESSION['id'],
                				'created_on ' 		=> date("Y-m-d H:i:s"),
                				);
                			 $result=$this->db->insert('tran_partsrcir_mast',$postDate);
                		     $mast_rcir_id = $this->db->insert_id();
                		     
                		     
                		    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$_POST[part_id]' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$_POST[part_id]' and op_id='$_POST[operation_id]' and isdeleted=0) and isdeleted = 0");
           	                $resultpIds = $query->row_array();
                    	  	$prevOpId = $resultpIds['op_id'];
                    	  	
            		        $postDetails = array(
                				'mast_partsrcir_id' 	=> $mast_rcir_id,
                				'tran_partspo_det_id' 	=> 0,
                				'dc_det_id' 	        => 0,
                				'part_id' 			    => $_POST['part_id'],
                				'op_id' 		        => $prevOpId,
                				'qty' 				    => $final_qty,
                				'qty_in_kgs' 		    => 0,
                				'inprocess_loss_qty' 	=> 0,
                				'year' 		            => $_SESSION['current_year'],
                				'created_by' 		    => $_SESSION['id'],
                				'created_on' 		    => date("Y-m-d H:i:s"),
                				);
				           
				             $result=$this->db->insert('tran_partsrcir_details',$postDetails);
                		     $det_partsrcir_id = $this->db->insert_id();
                		     
                		     // tran_partsrcir_stock insert
							$postDate1 = array(
								'det_partsrcir_id' 		=> $det_partsrcir_id,
								'mast_partsrcir_id' 	=> $mast_rcir_id,
								'year' 					=> $_SESSION['current_year'],
								'doc_year' 				=> $_SESSION['current_year'],
								'tran_date'             => $prcir_date,
								'part_id' 				=> $_POST['part_id'],
								'op_id' 				=> $prevOpId,
								'received_qty' 			=> $final_qty,
								'received_doc_type' 	=> "qc_rework",
								'received_doc_id' 	    => $_POST['editId'],
								'move_from'     	    => "B".$_SESSION['branch_id'],
                				'move_to'     	        => "B".$_SESSION['branch_id'],
								'branch_id' 	        => $_SESSION['branch_id'],
								'created_by' 			=> $_SESSION['id'],
								'created_on'            => date("Y-m-d H:i:s"),
							);

							$result = $this->db->insert('tran_partsrcir_stock',$postDate1);
                }else{
                    	// tran_partsrcir_details update
						$postDate = array(
						'qty' 				        => $final_qty,
						'qc_remarks' 				=> $qc_remark,
						'Accepted_type_det' 		=> $accepted_type_det,
						'qc_checked_by'             => $_SESSION['id'],
						'qc_checked_on' 			=> date("Y-m-d H:i:s"),
				    	);
						$array = array('id' => $pData['det_partsrcir_id']);
						$this->db->where($array); 
						$update = $this->db->update('tran_partsrcir_details', $postDate);
						
						 // rcir_stock upadte
							$postDate1 = array(
							    'tran_date'         => $prcir_date,
								'received_qty' 		=> $final_qty,
								'updated_by' 	    => $_SESSION['id'],
								'updated_on'        =>date("Y-m-d H:i:s"),
							);
							
							$this->db->where(array('id' => $pData['id'])); 
							$result = $this->db->update('tran_partsrcir_stock',$postDate1); 
							
                } //end of else for update rework
				         
		    }
    //-----------------------------end of rework-------------------------------

	              // tran_partsrcir_details update
						$postDate = array(
						'rejected_qty' 				=> $final_qty,
						'qc_remarks' 				=> $qc_remark,
						'Accepted_type_det' 		=> $accepted_type_det,
						'qc_checked_by'             => $_SESSION['id'],
						'qc_checked_on' 			=> date("Y-m-d H:i:s"),
					);
						$array = array('id' => $_POST['editId']);
						$this->db->where($array); 
						$update = $this->db->update('tran_partsrcir_details', $postDate);
              
                if($accepted_type_det == 'D')  //D - Rework
				{
				    $rejected_doc_type='qc_rework';
				    
				}else{
				    
				    $rejected_doc_type='qc_rejection';
				}
                $q1 = $this->db->query("select id from tran_partsrcir_stock where det_partsrcir_id='$_POST[editId]' and rejected_doc_type='qc_rejection'");
                $pData=$q1->row_array();
                if ($q1->num_rows() == 0) 
                {
                                    
                		// tran_partsrcir_stock insert
							$postDate1 = array(
								'det_partsrcir_id' 		=> $_POST['editId'],
								'mast_partsrcir_id' 	=> $_POST['mast_partsrcir_id'],
								'year' 					=> $_SESSION['current_year'],
								'doc_year' 				=> $_SESSION['current_year'],
								'tran_date'             => $prcir_date,
								'part_id' 				=> $_POST['part_id'],
								'op_id' 				=> $_POST['operation_id'],
								'rejected_qty' 			=> $final_qty,
								'rejected_doc_type' 	=> $rejected_doc_type,
								'rejected_doc_id' 	    => $_POST['editId'],
								'move_from'     	    => "B".$_SESSION['branch_id'],
                				'move_to'     	        => "B".$_SESSION['branch_id'],
								'branch_id' 	        => $_SESSION['branch_id'],
								'created_by' 			=> $_SESSION['id'],
								'created_on'            => date("Y-m-d H:i:s"),
							);

							$result = $this->db->insert('tran_partsrcir_stock',$postDate1);
                				
                }else{
                   	       // rcir_stock upadte
							$postDate1 = array(
							    'tran_date'         => $prcir_date,
								'rejected_qty' 		=> $final_qty,
								'updated_by' 	    => $_SESSION['id'],
								'updated_on'        =>date("Y-m-d H:i:s"),
							);
							$this->db->where(array('id' => $pData['id'])); 
							$result = $this->db->update('tran_partsrcir_stock',$postDate1); 
                }

                           $getrawMaterialById = $this->GetQueryModel->getrawMaterialById($_POST['part_id']);
				            $getPartsById = $this->GetQueryModel->getPartsById($_POST['part_id']);
				            $rm_id          = $getrawMaterialById[0]['rm_id'];
				            $netweight      = $getPartsById['netweight'];
				            $scrap_qty      = round($getPartsById['netweight'] * $final_qty/1000,3);
				            $scrap_type   = ($getrawMaterialById[0]['scrap_normal'] > 0 ) ? "NORMAL" : "SS";
				            
                $q = $this->db->query("select id from scrap_stock where received_doc_id='$_POST[editId]' and received_doc_type='qc_rejection_inc'");
                $sData=$q->row_array();
                if ($q->num_rows() == 0) 
                {
				            if($accepted_type_det == 'B')
				            {
				               $UpdateDateg = array(
				                'date'              =>$prcir_date,
								'rm_id' 			=> $rm_id,
								'year' 				=> $_SESSION['current_year'],
								'branch_id' 		=> $_SESSION['branch_id'],
								'received_qty' 		=> $scrap_qty,
								'received_doc_type' => 'qc_rejection_inc',
								'received_doc_id' 	=> $_POST['editId'],
								'type' 				=> $scrap_type,
								'created_by' 		=> $_SESSION['id'],
								'created_on'        => date("Y-m-d H:i:s"),
							);

							 $result16 = $this->db->insert('scrap_stock',$UpdateDateg);
				            }
				            
                }else{
                    
                     $UpdateDateg = array(
								'received_qty' 		=> $scrap_qty,
								'updated_by' 		=> $_SESSION['id'],
								'updated_on'        => date("Y-m-d H:i:s"),
							);
		             $this->db->where(array('id' => $sData['id']));
					 $result16 = $this->db->update('scrap_stock',$UpdateDateg);
                }

                    

				foreach($_POST['type'] as $key => $value)
				{
				       $cer_index=0;
					if($_POST['dpr_qc_id'][$key] == "")
					{
						$dpr_qc_id = $_POST['dpr_qc_id'][$key];

						$keyss = $key+1;
						
					$Certificate = "";
					// added certificate on 23-02-2024 
			
				     if($_POST['type'][$key]=="C"){
				       
				         $path = base_url('public/assets/parts_certificate/');
						 $documents = "Partscerti_".rand();
					
				            if(!empty($_FILES['Certificate']['name'][$cer_index]))
				        {
                           
				            $extension = pathinfo($_FILES['Certificate']['name'][$cer_index], PATHINFO_EXTENSION);    
				            $filename = $_FILES['Certificate']['name'][$cer_index];
				            $upload_path="public/assets/parts_certificate/";
				            $Certificate = $documents.".".$extension;
				            $file_size =$_FILES['Certificate']['size'][$cer_index];
				            $file_tmp =$_FILES['Certificate']['tmp_name'][$cer_index];
				            $file_type=$_FILES['Certificate']['type'][$cer_index];
				            $file_ext=strtolower(end(explode('.',$filename))); 
				            //$reg = move_uploaded_file($file_tmp,$upload_path.$Certificate);
                                if (move_uploaded_file($file_tmp,$upload_path.$Certificate)) {
                                    echo "Uploaded";
                                   
                                } else {
                                   echo "File was not uploaded";
                                }
                                 
				        }
				        $cer_index++;
				     }
				 
						$postDatew = array(
									'det_partsrcir_id' 				=> $_POST['editId'],
									'qc_id' 				=> $_POST['qc_id'][$key],
									//'time' 					=> $_POST['time'][$key],
									'ideal_value' 			=> $_POST['ideaV1'][$key],
									'tolerance' 			=> $_POST['ideaV2'][$key],
									'piece_selection' 		=> $_POST['Piece_selection'.$key],
									'reading1' 				=> $_POST['R1'][$key],
									'reading2' 				=> $_POST['R2'][$key],
									'reading3' 				=> $_POST['R3'][$key],
									'reading4' 				=> $_POST['R4'][$key],
									'reading5' 				=> $_POST['R5'][$key],
    								'reading6' 				=> $_POST['R6'][$key],
    								'reading7' 				=> $_POST['R7'][$key],
    								'reading8' 				=> $_POST['R8'][$key],
    								'reading9' 				=> $_POST['R9'][$key],
    								'reading10' 			=> $_POST['R10'][$key],
    								'certi_path' 			=> $Certificate,
									'reading' 				=> $_POST['type'][$key],
									'year'          	   => $_SESSION['current_year'],
									'created_by' 	     	=> $_SESSION['id'],
									'created_on' 			=> date("Y-m-d H:i:s"),
									// 'Remarks' 				=> $_POST['Remarks'][$key],
							);
					
				//	print_r($postDatew);exit;

						$result = $this->db->insert('tran_partsrcir_quality_checks',$postDatew);
						$insert_id = $this->db->insert_id();
					 	
					}else{
				
					  
						$dpr_qc_id = $_POST['dpr_qc_id'][$key];
								
							$postDate = array(
								'ideal_value' 			=> $_POST['ideaV1'][$key],
								'tolerance' 			=> $_POST['ideaV2'][$key],
								'piece_selection' 		=> $_POST['Piece_selection'.$key],
								'reading1' 				=> $_POST['R1'][$key],
								'reading2' 				=> $_POST['R2'][$key],
								'reading3' 				=> $_POST['R3'][$key],
								'reading4' 				=> $_POST['R4'][$key],
								'reading5' 				=> $_POST['R5'][$key],
                                'reading6' 				=> $_POST['R6'][$key],
                                'reading7' 				=> $_POST['R7'][$key],
                                'reading8' 				=> $_POST['R8'][$key],
                                'reading9' 				=> $_POST['R9'][$key],
                                'reading10' 			=> $_POST['R10'][$key],
								'reading' 				=> $_POST['type'][$key],
								'updated_by' 			=> $_SESSION['id'],
								'updated_on' 		    => date("Y-m-d H:i:s"),
							);

						$array = array('det_partsrcir_id' => $_POST['editId']);
						$this->db->where(array('id' => $dpr_qc_id)); 
						$update = $this->db->update('tran_partsrcir_quality_checks', $postDate);

					}
				}	
				
				             $this->session->set_flashdata('pendingDate',date('Y-m',strtotime($_POST['dpr_date'])));
				     	    $this->session->set_flashdata('pendingVal', 'all');
				           redirect('Incoming');
			}
                          
				     	    //	redirect('Incoming');

	}
	public function ViewAddIncoming()
	{
		echo json_encode(base64_encode($_POST['id']));
	}
	

	function deleteRecord1()
	{
			$id=$_POST['id'];
				if($_POST['filename']){
			    $filename=$_POST['filename']; 
			    $delete_path="public/assets/parts_certificate/".$filename;
			  // delete_files($path);
    			   if (unlink($delete_path)) {
                        echo "The file has been deleted";
                    } else {
                        echo "The file was not found";
                    }
			}
			$postDate1 = array(
				'isdeleted'=> 1,
			);
			$array = array('id' => $id);
			$this->db->where($array); 
			$update = $this->db->update('tran_partsrcir_quality_checks', $postDate1);
			return true;
    }

	

}
