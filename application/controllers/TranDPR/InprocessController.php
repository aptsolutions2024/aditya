<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class InprocessController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	//	$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
	//	$this->load->model('TranDPR/TranDPRModel');
	}
	public function index()
	{
			//$date = ($_POST['date']);
		//	$data['date'] = ($_POST['date']);
			$pendingval  = $_POST['pendingval'];
			$scheduleDate  = $_POST['date'];
			$toDate 	   = date("Y-m", strtotime($scheduleDate));
			
			$data['date'] 	= $_POST['date'];
			$data['pendingval'] 	= $_POST['pendingval'];

			$data['getDprData'] 	= $this->GetQueryModel->getDprbyDate($toDate,$pendingval);
			$this->load->view('TranDPR/inprocess-dpr',$data);

	}
	public function getQualityCheck()
	{
		$type 				= $_POST['type'];
	//	$dpr_qc_id 	= (!empty($_POST['dpr_qc_id'])) ? $_POST['dpr_qc_id'] : "";

		$getRMBymaterialType = $this->GetQueryModel->getRMBymaterialType('P');

      	$str6 .="<option value=''> Select QC</option>";
		foreach ($getRMBymaterialType as $key => $value) 
		{ 
			// $sele = ($dpr_qc_id == $value['id']) ? "selected" : ""; 

			if($value['qc_type'] == $type)
			{
				//$str6 .= "<option ".$sele." value='".$value['id']."'>". $value['name']."</option>";		
					$str6 .= "<option  value='".$value['id']."'>". $value['name']."</option>";	
			}
        }

		echo $str6;
	}
	public function AddInprocessdpr()
	{	
	  // echo "<pre>"; print_r($_POST);exit;
     	error_reporting(0);
    $this->session->unset_userdata('pendingVal');
	$this->session->unset_userdata('pendingDate');


		$id = base64_decode($_GET['Id']);
	//echo "ID".$id;
		if(!empty($id))
		{
			$data['GetQcDPRById'] = $this->GetQueryModel->GetQcDPRById($id);
			$GetDPRById = $this->GetQueryModel->GetDPRById($id);
			$data['GetQcDprIssueQty'] = $this->GetQueryModel->GetQcDprIssueQty($id);
			
			//print_r($GetDPRById);die;
			 //echo "<br>Hello IF"; die;

			$dpr_date 		= $GetDPRById['dpr_date'];
			$operator_id 	= $GetDPRById['operator_id'];
			$operation_id 	= $GetDPRById['operation_id'];
			$part_id 		= $GetDPRById['part_id'];
			$qty 			= $GetDPRById['qty'];
			$scrap_used 	= $GetDPRById['scrap_used'];
			$tool_id 		= $GetDPRById['tool_id'];
			$dpr_id 		= $GetDPRById['id'];
			$work_hours     = $GetDPRById['work_hours'];

			$partdata = $this->GetQueryModel->getPartBypartid($part_id); 
			$operation = $this->GetQueryModel->getOperation($operation_id); 
			$operator = $this->GetQueryModel->GetuserById($operator_id); 
			$tool = $this->GetQueryModel->getToolById($tool_id); 

			// $getQualityChecksbyId	= $this->GetQueryModel->getQualityChecksbyId($qc_id);

			$data['dpr_data'] = array(
				'date' 			=> date("d-m-Y", strtotime($GetDPRById['dpr_date'])),
				// 'qc_type' 	=> $getQualityChecksbyId['id'],
				'part_name' 	=> $partdata['name'],
				'dpr_id' 		=> $dpr_id,
				'partno' 		=> $partdata['partno'],
				'part_id' 		=> $partdata['part_id'],
				'operation_id' 	=> $operation['id'],
				'Operator' 		=> $operator['fullname'],
				'operation' 	=> $operation['name'],
			//	'work_hours' 	=> (!empty($operation['work_hours'])) ? $operation['work_hours'] : "",
			    'work_hours' 	=> $work_hours,
				'tool' 			=> $tool['name'],
				'qty' 			=> $qty,
				'rejected_qty' 	=> $GetDPRById['rejected_qty'],
				'qc_remark' 	=> $GetDPRById['qc_remark'],
				'scrap_used' 	=> ($scrap_used =='N') ? "NO":"Yes",
				'Accepted_type_det'=>$GetDPRById['Accepted_type_det'],
			);


			$data['getRMBymaterialType'] 	= $this->GetQueryModel->getRMBymaterialType('P');
		        $this->session->set_flashdata('pendingDate',date('Y-m',strtotime($GetDPRById['dpr_date'])));
				$this->session->set_flashdata('pendingVal', 'all');
			$this->load->view('TranDPR/add-inprocessdpr',$data);


		}else{
		
			if(!empty($_POST['type']))
			{

           // echo "<pre>";print_r($_POST);echo "</pre>"; 
				$final_qty 				= $_POST['final_qty'];
				$qc_remark 				= $_POST['qc_remark'];
				$accepted_type_det 		= $_POST['accepted_type_det'];
                $dpr_date               = date('Y-m-d',strtotime($_POST['dpr_date']));
               
                $dprId=$_POST['editId'];
                if($accepted_type_det == 'D')  //D - Rework
				{
				    $q11 = $this->db->query("select id,mast_dpr_id from tran_dpr_stock where received_doc_id='$_POST[editId]' and received_doc_type='qc_rework'");
                    $pData=$q11->row_array();
                    
                    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$_POST[part_id]' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$_POST[part_id]' and op_id='$_POST[operation_id]' and isdeleted=0) and isdeleted = 0");
           	        $resultpIds = $query->row_array();
                    $prevOpId = $resultpIds['op_id'];
                    	  	
                if ($q11->num_rows() == 0) 
                {
                    $postDate = array(
					'prod_plan_id' 		=> 0,
					'dpr_date' 			=> $dpr_date,
					'operation_id' 		=> $prevOpId,
					'operator_id' 		=> '',
					'tool_id' 			=> '',
					'branch_id' 		=> $_SESSION['branch_id'],
					'machine_id' 		=> '',
					'part_id' 			=> $_POST['part_id'],
					'scrap_used' 		=> "NO",
					'qty' 				=> $final_qty,
					'Accepted_type_det' => $accepted_type_det,
					'qty_in_kgs' 		=> 0,
					'work_hours' 		=> 0,
					'remarks' 			=> $qc_remark,
					'created_by' 		=> $_SESSION['id'],
					'created_on' 		=> date("Y-m-d H:i:s"),
					'year' 				=> $_SESSION['current_year'],
    				);
    				
    			    $result = $this->db->insert('tran_dpr',$postDate);
    		 		$mastdprid = $this->db->insert_id();
    		 		
    		 		// dpr_stock insert
					$postDate1 = array(
						'mast_dpr_id' 		=> $mastdprid,
						'year' 				=> $_SESSION['current_year'],
						'doc_year' 			=> $_SESSION['current_year'],
						'tran_date'         => $dpr_date,
						'part_id' 			=> $_POST['part_id'],
						'operation_id' 		=> $prevOpId,
						'received_qty' 		=> $final_qty,
						'received_doc_type' => "qc_rework",
						'received_doc_id'   => $_POST['editId'],
						'move_from'     	=> "B".$_SESSION['branch_id'],
						'move_to'     	    => "B".$_SESSION['branch_id'],
						'branch_id'     	=> $_SESSION['branch_id'],
						'created_by' 	    => $_SESSION['id'],
						'created_on'        =>date("Y-m-d H:i:s"),
					);
					$result = $this->db->insert('tran_dpr_stock',$postDate1);
    		 		
                }else{
                   // tran_dpr update
						$postDate = array(
						'qty' 				        => $final_qty,
						'qc_remark' 				=> $qc_remark,
						'Accepted_type_det' 		=> $accepted_type_det,
						'qc_checked_by'             => $_SESSION['id'],
						'qc_checked_on'             => date("Y-m-d H:i:s"),
					);
					$array = array('id' => $pData['mast_dpr_id']);
					$this->db->where($array); 
					$update = $this->db->update('tran_dpr', $postDate);    
					
					$postDate1 = array(
            							    'tran_date'         => $dpr_date,
            								'received_qty' 		=> $final_qty,
            								'updated_by' 	    => $_SESSION['id'],
            								'updated_on'        => date("Y-m-d H:i:s"),
            							);
					$this->db->where(array('id' => $pData['id'])); 
					$result = $this->db->update('tran_dpr_stock',$postDate1); 
                        
                }
			}
               
               
               
            // tran_dpr update
						$postDate = array(
						'rejected_qty' 				=> $final_qty,
						'qc_remark' 				=> $qc_remark,
						'Accepted_type_det' 		=> $accepted_type_det,
						'qc_checked_by'             =>$_SESSION['id'],
						'qc_checked_on'             =>date("Y-m-d H:i:s"),
					);
					
					$array = array('id' => $_POST['editId']);
					$this->db->where($array); 
					$update = $this->db->update('tran_dpr', $postDate);
                
                if($accepted_type_det == 'D')  //D - Rework
				{
				    $rejected_doc_type='qc_rework';
				    
				}else{
				    
				    $rejected_doc_type='qc_rejection';
				}
				
                $q1 = $this->db->query("select id from tran_dpr_stock where mast_dpr_id='$_POST[editId]' and rejected_doc_type='qc_rejection'");
               // $this->db->result_array();
                   $dData=$q1->row_array();
                if ($q1->num_rows() == 0) 
                {
                                    
                							// dpr_stock insert
                							$postDate1 = array(
                								'mast_dpr_id' 		=> $_POST['editId'],
                								'year' 				=> $_SESSION['current_year'],
                								'doc_year' 			=> $_SESSION['current_year'],
                								'tran_date'         => $dpr_date,
                								'part_id' 			=> $_POST['part_id'],
                								'operation_id' 		=> $_POST['operation_id'],
                								'rejected_qty' 		=> $final_qty,
                								'move_from'     	=> "B".$_SESSION['branch_id'],
                								'move_to'     	    => "B".$_SESSION['branch_id'],
                								'branch_id'     	=> $_SESSION['branch_id'],
                								'rejected_doc_type' => $rejected_doc_type,
                								'rejected_doc_id'   => $_POST['editId'],
                								'created_by' 	    => $_SESSION['id'],
                								'created_on'        =>date("Y-m-d H:i:s"),
                							);
                
                							$result = $this->db->insert('tran_dpr_stock',$postDate1);
                				
                }else{
                   	// dpr_stock upadte
                							$postDate1 = array(
                							    'tran_date'         => $dpr_date,
                								'rejected_qty' 		=> $final_qty,
                								'updated_by' 	    => $_SESSION['id'],
                								'updated_on'        => date("Y-m-d H:i:s"),
                							);
                							$this->db->where(array('id' => $dData['id'])); 
                							$result = $this->db->update('tran_dpr_stock',$postDate1); 
                }


                $q = $this->db->query("select id from scrap_stock where received_doc_id='$_POST[editId]' and received_doc_type='qc_rejection_dpr'");
                $sData=$q->row_array();
                if ($q->num_rows() == 0) 
                {
			     //B-  Rejected
			     
			     	       $getAssemblyPartID= $this->GetQueryModel->getAssemblyPartScrapStock($_POST['part_id']);
					       $part_id=($getAssemblyPartID)?$getAssemblyPartID:$_POST['part_id'];
					        $getrawMaterialById = $this->GetQueryModel->getrawMaterialById($part_id);
				            $getPartsById = $this->GetQueryModel->getPartsById($part_id);
				            $rm_id          = $getrawMaterialById[0]['rm_id'];
				            $netweight      = $getPartsById['netweight'];
				            $scrap_qty      = round($getPartsById['netweight'] * $final_qty/1000,3);
				            $scrap_type   = ($getrawMaterialById[0]['scrap_normal'] > 0 ) ? "NORMAL" : "SS";
				            
				 if($accepted_type_det == 'B')
				 {
				               $UpdateDateg = array(
				                'date'              =>date("Y-m-d", strtotime($dpr_date)),
								'rm_id' 			=> $rm_id,
								'date'              => $dpr_date,
								'year' 				=> $_SESSION['current_year'],
								'branch_id' 		=> $_SESSION['branch_id'],
								'received_qty' 		=> $scrap_qty,
								'received_doc_type' => 'qc_rejection_dpr',
								'received_doc_id' 	=> $_POST['editId'],
								'type' 				=> $scrap_type,
								'created_by' 		=> $_SESSION['id'],
								'created_on'        =>date("Y-m-d H:i:s"),
							);

							 $result16 = $this->db->insert('scrap_stock',$UpdateDateg);
				     }
                }else{
                     $UpdateDateg = array(
								'received_qty' 		=> $scrap_qty,
								'updated_by' 		=> $_SESSION['id'],
								'updated_on'             =>date("Y-m-d H:i:s"),
							);
		             $this->db->where(array('id' => $sData['id']));
					 $result16 = $this->db->update('scrap_stock',$UpdateDateg);
                }
                
				foreach($_POST['type'] as $key => $value)
				{
		             	//Insert Record----------------
					if($_POST['dpr_qc_id'][$key] == "")
					{
					    //echo "<br>Piece_selection".$key."     :::::::::::". $_POST['Piece_selection'.$key];
							$dpr_qc_id = $_POST['dpr_qc_id'][$key];
						//	$keyss = $key+1;
							$postDate = array(
								'dpr_id' 				=> $_POST['editId'],
								'qc_id' 				=> $_POST['qc_id'][$key],
							//	'time' 					=> $_POST['time'][$key],
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
								'year'          	   => $_SESSION['current_year'],
								'created_by' 			=> $_SESSION['id'],
							);

							$result = $this->db->insert('tran_dpr_quality_checks',$postDate);
							$insert_id = $this->db->insert_id();

					}else{
                     	//----Update Record
            
						$keyss = $key;

						$dpr_qc_id = $_POST['dpr_qc_id'][$key];
							
							$postDate = array(
								'dpr_id' 				=> $_POST['editId'],
								'qc_id' 				=> $_POST['qc_id'][$key],
							//	'time' 					=> $_POST['time'][$key],
								'ideal_value' 			=> $_POST['ideaV1'][$key],
								'tolerance' 			=> $_POST['ideaV2'][$key],
								'piece_selection' 		=> $_POST['Piece_selection'.$keyss],
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
								'created_by' 			=> $_SESSION['id'],
							);

							$key++;

							$array = array('id' => $dpr_qc_id);
							$this->db->where($array); 
							$update = $this->db->update('tran_dpr_quality_checks', $postDate);
					}
					
				}

			}
			redirect('Inprocess-dpr');
		}
	}

	function deleteRecord()
	{
			$id=$_POST['id'];
			$postDate1 = array(
				'isdeleted'=> 1,
			);
			$array = array('id' => $id);
			$this->db->where($array); 
			$update = $this->db->update('tran_dpr_quality_checks', $postDate1);
			return true;
    }

	

}
