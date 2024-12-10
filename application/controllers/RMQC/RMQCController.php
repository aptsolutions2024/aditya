<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
date_default_timezone_set("Asia/Calcutta");

class RMQCController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	//	$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
		$this->load->model('RMQC/RmqcModel');
	}
	public function index()
	{

		
	//	$this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('pendingval', 'pendingval', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) 
		{

			$pendingval  	= $_POST['pendingval'];
			$scheduleDate  	= $_POST['date'];
			$toDate 	   	= date("Y-m", strtotime($scheduleDate));

			$data['date'] 	= $_POST['date'];
			$data['pendingval'] 	= $_POST['pendingval'];
			//$data['getPartsrcirMast'] 	= $this->GetQueryModel->getPartsrcirMast($toDate,$pendingval);
				$data['getPartsrcirMast']  	= $this->RmqcModel->getRMrcirMast($toDate,$pendingval);
			$this->load->view('RMQC/view-rmqc',$data);
		}else{
			
			$this->load->view('RMQC/view-rmqc'); 
		}
		
	}

	public function GetRMQCData()
	{

		$flag 				= $_POST['flag'];
		$date 				= $_POST['date'];
		
	//	echo $flag." DAte:".$date;
		$getPartsrcirMast 	= $this->RmqcModel->getRMrcirMast($date,$flag);
//print_r($getPartsrcirMast);
		$array = [];
		foreach ($getPartsrcirMast as $key => $value) 
		{
		    	$getRmById 	= $this->GetQueryModel->getRmById($value['rm_id']);
			if($flag != "pending")
			{
				$supplier  = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
				$array[] = array(
						"id" 			=> $value['id']." - ".$value['det_id'],
						"supplier_id" 	=> $supplier['name'],
						"date" 			=> date('d-m-Y',strtotime($value['date'])),
						"challan_no" 	=> $value['challan_no'],
						"challan_date" 	=> date('d-m-Y',strtotime($value['challan_date'])),
						"id_encode" 	=> base64_encode($value['det_id']),
						"rm_name" 	    => $getRmById['name'],
						"qc_remarks" 	=> $value['qc_remarks'],
						"qty" 			=> $value['qty'],
						"rejected_qty" 	=> $value['rejected_qty'],
				);
			}else{
				
					$supplier_id 	= $this->GetQueryModel->getSupplierById($value['supplier_id']);
					

					$array[] = array(
						"id" 				=> $value['id'],
						"id_encode" 		=> base64_encode($value['id']),
						"challan_no" 		=> $value['challan_no'],
						"challan_date" 		=> date('d-m-Y',strtotime($value['challan_date'])),
						"rm_name" 			=> $getRmById['name'],
						"qty" 				=> $value['qty'],
						"supplier_name" 	=> $supplier_id['name']
					);
			}


		}

		echo json_encode($array);
	}
	public function getRmrcirDetail()
	{
	    
		$id 				= $_GET['id'];

		$getPartsrcirMast 	= $this->RmqcModel->getRmrcirDetail($id);

		$array = [];
	//	print_r($getPartsrcirMast);
		foreach ($getPartsrcirMast as $key => $value) 
		{
		   //echo "<pre>";print_r($value); echo "</pre>";
			$getRmById 	= $this->GetQueryModel->getrmById($value['rm_id']);
		//	$supplier_id 	= $this->GetQueryModel->getSupplierById($value['supplier_id']);

			// $array[] = array(
			// 		"rm_id" 			=> $getRmById['rm_id'],
			// 		"rm_name" 			=> $getRmById['name'],
			// 		"qty" 				=> $value['qty']
			// );

			$array[] = array(
						"rm_id" 			=> $getRmById['rm_id'],
						"id" 				=> $value['id'],
						"id_encode" 		=> base64_encode($value['id']),
						"challan_no" 		=> $value['challan_no'],
						"challan_date" 		=> $value['challan_date'],
						"rm_name" 			=> $getRmById['name'],
						"rejected_qty" 	    => $value['rejected_qty'],
						"qty" 				=> $value['qty'],
					
					);
		}

		echo json_encode($array);

	}

	public function addRMQC()
	{	
			$id = base64_decode($_GET['id']);
              $this->session->unset_userdata('pendingVal');
			  $this->session->unset_userdata('pendingDate');
			  
			if(!empty($id))
			{
			    //echo "IN IF";

				$data['GetRmQccheck'] = $this->RmqcModel->GetRmQccheck($id);

				$getRMrcirDetailbyId 	= $this->RmqcModel->getRMrcirDetailbyId($id);
				$mast_Rmrcir_id 		= $getRMrcirDetailbyId['mast_rmrcir_id'];
				$rm_id 					= $getRMrcirDetailbyId['rm_id'];
				$getRmById 				= $this->GetQueryModel->getRmById($rm_id);


				if(!empty($mast_Rmrcir_id)){
				$getRMrcirMastbyId 	= $this->RmqcModel->getRMrcirMastbyId($mast_Rmrcir_id);
				}else{
					$getRMrcirMastbyId = "";
				}


				$supplier_id = $getRMrcirMastbyId['supplier_id'];
				$getSupplierById 	= $this->GetQueryModel->getSupplierById($supplier_id);
				$date = $getRMrcirMastbyId['date'];

				$data['rmqc'] = array(
					'date' 					=> date("d-m-Y", strtotime($date)),
					'supplier_name' 		=> $getSupplierById['name'],
					'rm_name' 				=> $getRmById['name'],
					'rm_id' 				=> $getRmById['rm_id'],
					'qty' 					=> $getRMrcirDetailbyId['qty'],
					'mast_RMrcir_id' 	    => $getRMrcirMastbyId['id'],
					'final_qty' 			=>$getRMrcirDetailbyId['rejected_qty'],
					'qc_remarks' 			=>$getRMrcirDetailbyId['qc_remarks']
				);


				// $data['getRMBymaterialType'] 	= $this->GetQueryModel->getRMBymaterialType('P');
				$this->session->set_flashdata('pendingDate',date('Y-m',strtotime($date)));
				$this->session->set_flashdata('pendingVal', 'all');
				$this->load->view('RMQC/add-rmqc',$data);
			}else{
             //echo "In ELSE <pre>";print_r($_POST);print_r($_FILES);echo "</pre>";exit;
				$final_qty 				= $_POST['final_qty'];
				$qc_remark 				= $_POST['qc_remark'];
				$i=0;
				foreach($_POST['time'] as $key => $value)
				{
				    $cer_index=0;
					if($_POST['rm_qc_id'][$key] == "")
					{
					    echo "<br>KEY*****$key";

					/*	if(empty($RidingArr))
						{
						 	$RidingArr  = $this->RmqcModel->getRidingArr($_POST['type']);
						}*/

						$rm_qc_id = $_POST['rm_qc_id'][$key];

						$keyss = $key+1;

						
				     
				    $Certificate = "";
				     if($_POST['type'][$key]=="C"){
				         
				         $path = base_url('public/assets/rm_certificate/');
						 $documents = "RMcerti_".rand();
						
				            if(!empty($_FILES['Certificate']['name'][$cer_index]))
				        {

				            $extension = pathinfo($_FILES['Certificate']['name'][$cer_index], PATHINFO_EXTENSION);    
				            $filename = $_FILES['Certificate']['name'][$cer_index];
				            $upload_path="public/assets/rm_certificate/";
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
									'det_rmrcir_id' 		=> $_POST['editId'],
									'qc_id' 				=> $_POST['qc_id'][$key],
									'time' 					=> $_POST['time'][$key],
									'ideal_value' 			=> $_POST['ideaV1'][$key],
									'tolerance' 			=> $_POST['ideaV2'][$key],
									'reading1' 				=> ($_POST['R1'][$key])?$_POST['R1'][$key]:"",
									'reading2' 				=> ($_POST['R2'][$key])?$_POST['R2'][$key]:"",
									'reading3' 				=> ($_POST['R3'][$key])?$_POST['R3'][$key]:"",
									'reading4' 				=> ($_POST['R4'][$key])?$_POST['R4'][$key]:"",
									'reading5' 				=> ($_POST['R5'][$key])?$_POST['R5'][$key]:"",
									'reading' 				=> $_POST['type'][$key],
									'certi_path' 			=> $Certificate,
							);

						$result = $this->db->insert('tran_rmrcir_quality_checks',$postDatew);

						// tran_rmrcir_stock insert
							$postDate1 = array(
								'det_rmrcir_id' 		=> $_POST['editId'],
								'mast_rmrcir_id' 		=> $_POST['mast_RMrcir_id'],
								'year' 					=> $_SESSION['current_year'],
								'doc_year' 				=> $_SESSION['current_year'],
								'rm_id' 				=> $_POST['rm_id'],
								'rejected_qty' 			=> $final_qty,
								'rejected_doc_type' 	=> "rejection",
								'rejected_doc_id' 	    => $_POST['editId'],
								'branch_id'            =>$_SESSION['branch_id'],
								'created_by' 			=> $_SESSION['id'],
							);

							$result = $this->db->insert('tran_rmrcir_stock',$postDate1);

			// tran_rmrcir_details update
						$postDate = array(
						'rejected_qty' 				=> $final_qty,
						'qc_remarks' 				=> $qc_remark,
						'qc_checked_by'             =>$_SESSION['id'],
						'qc_checked_on'             =>date("Y-m-d H:i:s"),
						// 2
					);
						$array = array('id' => $_POST['editId']);
						$this->db->where($array); 
						$update = $this->db->update('tran_rmrcir_details', $postDate);
                        //die;

					}else{

						
                           // echo "IN Update";
				// 		if(empty($RidingArr))
				// 		{
				// 		 	$RidingArr  = $this->RmqcModel->getRidingArr($_POST['type']);
				// 		}

						$rm_qc_id = $_POST['rm_qc_id'][$key];
								
							$postDate = array(
								'det_rmrcir_id' 		=> $_POST['editId'],
								'qc_id' 				=> $_POST['qc_id'][$key],
								'time' 					=> $_POST['time'][$key],
								'ideal_value' 			=> $_POST['ideaV1'][$key],
								'tolerance' 			=> $_POST['ideaV2'][$key],
								'reading1' 				=> ($_POST['R1'][$key])?$_POST['R1'][$key]:"",
								'reading2' 				=> ($_POST['R2'][$key])?$_POST['R2'][$key]:"",
								'reading3' 				=> ($_POST['R3'][$key])?$_POST['R3'][$key]:"",
								'reading4' 				=> ($_POST['R4'][$key])?$_POST['R4'][$key]:"",
								'reading5' 				=> ($_POST['R5'][$key])?$_POST['R5'][$key]:"",
								'reading' 				=> $_POST['type'][$key],
								'created_by' 			=> $_SESSION['id'],
							);


						$array = array('id' => $rm_qc_id);
						$this->db->where($array); 
						$update = $this->db->update('tran_rmrcir_quality_checks', $postDate);
						// ----------------------------------------

						$path = base_url('public/assets/rm_certificate/');
						$documents = "RMcerti_".rand();
				       /* if(!empty($_FILES['Certificate']['name'][$key]))
				        {

				            $extension = pathinfo($_FILES['Certificate']['name'][$key], PATHINFO_EXTENSION);    
				            $filename = $_FILES['Certificate']['name'][$key];
				            $upload_path="public/assets/rm_certificate/";
				            $Certificate = $documents.".".$extension;
				            $file_size =$_FILES['Certificate']['size'][$key];
				            $file_tmp =$_FILES['Certificate']['tmp_name'][$key];
				            $file_type=$_FILES['Certificate']['type'][$key];
				            $file_ext=strtolower(end(explode('.',$filename))); 
				            $reg = move_uploaded_file($file_tmp,$upload_path.$Certificate);

				            $postDate11 = array(
								'certi_path' 			=> $Certificate,
							);

							$arrayd = array('id' => $rm_qc_id);
							$this->db->where($arrayd); 
							$update = $this->db->update('tran_rmrcir_quality_checks', $postDate11);

				        }*/

						// ----------------------------------------

						// tran_rmrcir_stock update
							$postDate1 = array(
								'rejected_qty' 			=> $final_qty,
								'rejected_doc_type' 	=> "rejection",
							);

							$arrayd = array('det_rmrcir_id' => $_POST['editId']);
							$this->db->where($arrayd); 
							$update = $this->db->update('tran_rmrcir_stock', $postDate1);
							// echo $this->db->last_query();
						// ---------------------------------------
								// tran_rmrcir_details update
								$postDate = array(
									'rejected_qty' 				=> $final_qty,
									'qc_remarks' 				=> $qc_remark,
            						'qc_checked_by'             =>$_SESSION['id'],
            						'qc_checked_on'             =>date("Y-m-d H:i:s"),
							
								);
									$array = array('id' => $_POST['editId']);
									$this->db->where($array); 
									$update = $this->db->update('tran_rmrcir_details', $postDate);
						// ---------------------------------------

						$i++;
					}
				}
				      $this->session->set_flashdata('pendingDate',date('Y-m',strtotime($_POST['dpr_date'])));
				     $this->session->set_flashdata('pendingVal', 'all');
			redirect('RMQC');	
					
			}


	}

	public function ViewAddRMQC()
	{
		echo json_encode(base64_encode($_POST['id']));
	}
	public function getRMQualityCheck()
	{
		$type 				= $_POST['type'];
		$getRMBymaterialType = $this->GetQueryModel->getRMBymaterialType('R');

      	$str6 .="<option value=''> Select QC</option>";
		foreach ($getRMBymaterialType as $key => $value) 
		{ 
			$sele = ($dpr_qc_id == $value['id']) ? "selected" : ""; 

			if($value['qc_type'] == $type)
			{
				$str6 .= "<option ".$sele." value='".$value['id']."'>". $value['name']."</option>";			
			}
        }

		echo $str6;
	}

	function deleteRecordRMQC()
	{

			$id=$_POST['id'];
			if($_POST['filename']){
			    $filename=$_POST['filename']; 
			    $delete_path="public/assets/rm_certificate/".$filename;
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
			$update = $this->db->update('tran_rmrcir_quality_checks', $postDate1);
			//echo $this->db->last_query();	die;

			return true;
    }

	

	

}
