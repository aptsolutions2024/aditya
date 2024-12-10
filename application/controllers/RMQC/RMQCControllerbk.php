<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class RMQCController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
		$this->load->model('TranDPR/TranDPRModel');
	}
	public function index()
	{
			$data['getSupplier'] 	= $this->GetQueryModel->getSupplier();
			$data['getDprData'] 	= $this->GetQueryModel->getDprData();
		
		
		if(!empty($data['getSupplier']))
		{
			$this->load->view('RMQC/index',$data);
		}
		else{
			$this->load->view('RMQC/index');
		}
		
	}
	public function getRmDatatable()
	{ 

		$rm_qty = $_POST['rm_qty'];

		$getRMBymaterialType		    = $this->GetQueryModel->getRMBymaterialType('R');
		?>
     <div><table id='example' class='display dataTable no-footer' style='width: 100%;' aria-describedby='example_info'><thead><tr><th></th> <th>Sr.No.</th><th>Speci. for <br>ceritical dimm</th><th>Dim's</th><th style='text-align: center;'>Manufacture Observation.</th><th style='text-align: center;'>Remark</th></tr></thead><tbody><?php
                                        $i=1;
										$PostArr = [];                                      
                                            foreach ($getRMBymaterialType as $key => $value) 
                                            {
            	
				$PostArr = array (
				array(
						'qc_id'=>$value['id'] , 'qc_type'=>$value['qc_type'],
						'remark'=> "",'ideal1'=> 0,'ideal2'=> 0,'read1'=> "",'read1'=> ""
					),
				
				);
				 ?><tr>
				 	<td style='width:40px'><input type='checkbox' class='form-check-input' name='checkboxVal[]' value='9'></td>
				 	<td style='width:60px'><?= $i; $i ++;?></td>
				 	<td  style='width:155px'><?= $value['name']; ?>
                            <input type='hidden' name='qc_id' value='<?= $value['id']; ?>'></td><td  style='width:80px'><?php
                            if($value['qc_type'] == 'D')
                            { ?>
                            <div class='row'>
                            	<input type='text' style='width:60px' class='form-control' name='dim1'>
                            	<input type='text' style='width:60px' class='form-control' name='dim2'> <?php }else{ ?>
                             <div class='col-md-8 mb-1'>-</div><?php } ?>
                            </td><td align='center'><?php
                            if($value['qc_type'] == 'C')
                            { ?>
     						<div class='col-md-10 mb-1'><input type='file' class='form-control'></div><div class='col-md-1 mb-1'></div><?php 
                            }elseif($value['qc_type'] == 'V'){?>
                            	<div class='row' text-align='center'>
                            		<?php 
                                if($rm_qty > 1501) { for ($i=1; $i < 21 ; $i++) { ?>
                                	  <div class='col-md-1 mb-1'><select class='form-control' name=<?= $value['id']."_".$i; ?> style='width: 55px;' ><option value="1">OK</option><option value="0">NOT Ok</option></select></div> 
                               <?php  } ?></div> <?php
     					}
                            }else{
                            ?>
							<div class='row' text-align='center'>
								 <?php if($rm_qty > 1501) { for ($i=0; $i < 20 ; $i++) { ?>
							<div class='col-md-1 mb-1'>
							<input style='width: 55px;' type='text' name="txtrmth[]" class='form-control'>
							</div> 
						<?php } } ?>

							</div>

                            <?php } ?>
                        </td> <td style='width: 100px;height: 5px;'><textarea class='form-control'></textarea></td><?php } ?>
                </tbody> </table><div class='row' text-align='center'><div class='col-4' align='right'></div><div class='col-2' align='right' style=' margin-top: 10px;'>Accepted Qty.</div><div class='col-2' align='right'><input type='text' class='form-control'></div></div></div>";
             
               <?php
                                   
	}
	public function getProdPart_Id()
	{
		$date = $_POST['date'];

		$getProdPart_Id = $this->GetQueryModel->getProdPart_Id($date);
		$datas = [];
		if(!empty($getProdPart_Id))
		{
			foreach ($getProdPart_Id as $key => $value) 
			{
				$res1 = $this->GetQueryModel->getPartsById($value['part_id']);
				$prodIid = ($value['id']);
					
					$datas[] = array(
						'part_id' 			=> $res1['part_id'], 
						'prodfamily_id' 	=> $res1['prodfamily_id'], 
						'customer_id' 		=> $res1['customer_id'], 
						'partno' 			=> $res1['partno'], 
						'name' 				=> $res1['name'], 
						'uom' 				=> $res1['uom'], 
						'netweight' 		=> $res1['netweight'], 
						'hsncode' 			=> $res1['hsncode'], 
						'bin_qty' 			=> $res1['bin_qty'], 
						'is_assembly' 		=> $res1['is_assembly'], 
						'prod_plan_id' 		=> trim($prodIid) 
					);
			}
		}
		$id = base64_decode($_GET['ID']);
	
$str .="<option> Select Part</option>";
		foreach ($datas as $key => $value) 
		{
		
			 $str .= "<option data-id='".$value['prod_plan_id']."'value='".$value['part_id']."'>". $value['name']."</option>";			
	 }

		echo $str;
	}
	
	public function getToolbyPartOperation()
	{

		$part_id = $_POST['part_id'];
		$Op_id = $_POST['Op_id'];

		$getToolbyPartOperation = $this->GetQueryModel->getToolbyPartOperation($part_id,$Op_id);
		
	
	
       // $str6 .="<option> Select Tool</option>";
		foreach ($getToolbyPartOperation as $key => $value) 
		{
		
			 $str6 .= "<option value='".$value['id']."'>". $value['name']."</option>";			
        }

		echo $str6;
	}
	public function getToolSucess()
	{
		$date = $_POST['date'];
		$getToolSucess = $this->GetQueryModel->getToolSucess($date);

		echo $getToolSucess;
	}
	public function getOperbyPart_Id()
	{
	    
	   
		$user_id = $_SESSION['id'];
		$GetuserById = $this->GetQueryModel->GetuserById($user_id);

		$partId = $_POST['part_id'];
		$role 	= $_SESSION['role'];
		$branch_id 	= (!empty($GetuserById)) ? $GetuserById['branch_id'] : "";

		$getProdPart_Id = $this->GetQueryModel->getOperbyPart_Id($partId,$role,$branch_id);


		$datas1 = [];
		if(!empty($getProdPart_Id))
		{
			foreach ($getProdPart_Id as $key => $value1) 
			{
				$datas1[] = $this->GetQueryModel->getOperation($value1['op_id']);
			}
		}
       $strq1 ="<option value='0'>Select Operation</option>";
		foreach ($datas1 as $key => $value2) 
		{
			
				
				$strq1 .= "<option value=7>".$value2['name']."</option>";
				
			 // $strq1 .= "<option value='".$value2['id']."'>". $value2['name']."</option>";
	 }
	

		echo $strq1;
	}
	public function getRMByPartId()
	{
		
		$txtqty = $_POST['qty'];
		$partid = $_POST['partid'];
		$data  =   $this->GetQueryModel->getrawMaterialByPartId($partid);
		
		$reqQty = 0;
		$AvaiQty = 0;
		if(!empty($data))
		{
			$rm_id 			= ($data[0]['rm_id']);
			$grossweight 	= $data[0]['grossweight'];
			$reqQty 		= round($grossweight * $txtqty/1000,3);
			
			$branch_id 	= $_SESSION['branch_id'];
			$year 		= $_SESSION['current_year'];
			
			 $RmData  =   $this->GetQueryModel->getTranRmgrrTotAvailQty($rm_id,$year,$branch_id);
			
			$AvaiQty = $RmData['available_qty'];
			if($AvaiQty < $reqQty)
			{
				$mess = "Insufficiant Stock.Available stock - ".$AvaiQty." Required Qty - ".$reqQty;
			}else
			{
				$mess=0;			
			}
		}
		return $mess;	
	}
	public function getRMBySupplId()
	{
		$supp_id  = $_POST['supplier_id'];
		$datas = $this->GetQueryModel->getRMBySupplId($supp_id);
		

		if(!empty($datas)){
			$str .="<option> Select Row Material</option>";
			foreach ($datas as $key => $value) 
			{
				$rmName = $this->GetQueryModel->getRawMaterialbyrmid($value['rm_id']);

			
				 $str .= "<option data-id='".$value['qty']."'value='".$value['rm_id']."'>". $rmName['name']."</option>";			
		 	}
		 }else{
		 	$str .="<option> No Row Material Available</option>";
		 }

		echo $str;



	}
	public function CreateRMQC()
	{
		echo "<pre>";
		print_r($_POST);
		die;


	}
	public function AddRMQC()
	{

		

		$branch_id 	= $_SESSION['branch_id'];
		$role_id 	= 7;

		if(empty($_POST))
		{
			$data['getSupplier'] 					= $this->GetQueryModel->getSupplier();
			$getRmrcirDetails 						= $this->GetQueryModel->getRmrcirDetails();
			$data['getRMBymaterialType'] 		    = $this->GetQueryModel->getRMBymaterialType('R');
		
		
			$data1 = [];
			foreach ($getRmrcirDetails as $key => $value) 
			{
				$rm_id = $value['rm_id'];
				$qty   = $value['qty'];

				$getRawMaterialbyrmid = $this->GetQueryModel->getRawMaterialbyrmid($rm_id);
				
				if(!empty($getRawMaterialbyrmid)){
					$data1[] = [
						'rm_id' 	=> 	$getRawMaterialbyrmid['id'],
						'rm_name'	=> $getRawMaterialbyrmid['name'],
						'rm_qty'	=> $qty,
					];
				}
			}

			$data['getRmrcirDetails'] = $data1;

			$this->load->view('RMQC/add',$data);
		}else{

			$date = $this->input->post('txtDate');
			$prod_plan_id = $this->input->post('prod_plan_id');

			$postDate=[];
			foreach ($_POST['txtpart'] as $key => $value) 
			{


				// $txtpart 		= $value[$key]['txtpart'];
				// $txtoperations 	= $value[$key]['txtoperations'];
				// $txttools 		= $value[$key]['txttools'];
				// $txtmachines 	= $value[$key]['txtmachines'];
				// $txtscrap 		= $value[$key]['txtscrap'];
				// $txtoperator 	= $value[$key]['txtoperator'];
				// $txthours 		= $value[$key]['txthours'];
				// $txtQty 		= $value[$key]['txtQty'];
				// $txtremark 		= $value[$key]['txtremark'];

				$postDate = array(
					'prod_plan_id' 		=> $prod_plan_id,
					'dpr_date' 			=> $date,
					'operation_id' 		=> $_POST['txtoperations'][$key],
					'operator_id' 		=> $_POST['txtoperator'][$key],
					'tool_id' 			=> $_POST['txttools'][$key],
					'branch_id' 		=> $_SESSION['branch_id'][$key],
					'machine_id' 		=> $_POST['txtmachines'][$key],
					'part_id' 			=> $_POST['txtpart'][$key],
					'scrap_used' 		=> $_POST['txtscrap'][$key],
					'qty' 				=> $_POST['txtQty'][$key],
					'work_hours' 		=> $_POST['txthours'][$key],
					'remarks' 			=> $_POST['txtremark'][$key],
					'created_by' 		=> $_SESSION['id'],
					'updated_by' 		=> $_SESSION['id'],
					'updated_on' 		=> date("Y-m-d H:i:s"),
					'year' 				=> $_SESSION['current_year']
				);

			   $result = $this->db->insert('tran_dpr',$postDate);

			   if($result)
			   {
			   		$issue_doc_id = $this->db->insert_id();
			   		
			   		$part_id 			= $_POST[$key]['txtpart'];
			   		$getrawMaterialById = $this->GetQueryModel->getrawMaterialById($part_id);

			   		if(!empty($getrawMaterialById[0]))
			   		{
						$rm_id  = $getrawMaterialById[0]['rm_id'];

			   			$totQty 	 	 = $_POST[$key]['txtQty'];
			   			$grossweight 	 = $getrawMaterialById[0]['grossweight'];
		   				$issue_qty 		 = ($grossweight * $totQty);
		   				$scrap_qty_gen 	 = $getrawMaterialById[0]['scrap_normal'];

		   				// if($this->input->post('txtscrap') == "")

		   				$UpdateDate = array(
							'rm_id' 			=> $rm_id,
							'issue_qty' 		=> $issue_qty,
							'year' 				=> $_SESSION['current_year'],
							'scrap_qty_gen' 	=> $scrap_qty_gen,
							'branch_id' 		=> $_SESSION['branch_id'],
							'created_by' 		=> $_SESSION['id'],
							'updated_by' 		=> $_SESSION['id'],
							'updated_on' 		=> date("Y-m-d"),
							'issue_doc_id' 		=> $issue_doc_id,
							'issue_doc_type' 	=> 'DPR',
						);

		   				$getrawMaterialById = $this->TranDPRModel->updateTranRmrcirStock($UpdateDate);

		   				// update tran_rmrcir_stock
			   		}
			   }
			}

			redirect('/Tran-DPR');
		}
	}
	public function UpdateDPR()
	{

		if(!empty($_POST))
		{

			foreach ($_POST['txtpart'] as $key => $value) 
			{
				$editId = $_POST['id'][$key];

				if(empty($editId))
				{ 
					$date = $this->input->post('txtDate');
					$prod_plan_id = $this->input->post('prod_plan_id');

					$postDate = array(
					'prod_plan_id' 		=> $prod_plan_id,
					'dpr_date' 			=> $date,
					'operation_id' 		=> $_POST['txtoperations'][$key],
					'operator_id' 		=> $_POST['txtoperator'][$key],
					'tool_id' 			=> $_POST['txttools'][$key],
					'branch_id' 		=> $_SESSION['branch_id'],
					'machine_id' 		=> $_POST['txtmachines'][$key],
					'part_id' 			=> $_POST['txtpart'][$key],
					'scrap_used' 		=> $_POST['txtscrap'][$key],
					'qty' 				=> $_POST['txtQty'][$key],
					'work_hours' 		=> $_POST['txthours'][$key],
					'remarks' 			=> $_POST['txtremark'][$key],
					'created_by' 		=> $_SESSION['id'],
					'updated_by' 		=> $_SESSION['id'],
					'updated_on' 		=> date("Y-m-d"),
					'year' 				=> $_SESSION['current_year']
				);

			   $result = $this->db->insert('tran_dpr',$postDate);

			   if($result)
			   {
			   		$issue_doc_id = $this->db->insert_id();
			   		
			   		$part_id 			= $_POST[$key]['txtpart'];
			   		$getrawMaterialById = $this->GetQueryModel->getrawMaterialById($part_id);


				   		if(!empty($getrawMaterialById[0]))
				   		{
							$rm_id  = $getrawMaterialById[0]['rm_id'];

				   			$totQty 	 	 = $_POST[$key]['txtQty'];
				   			$grossweight 	 = $getrawMaterialById[0]['grossweight'];
			   				$issue_qty 		 = ($grossweight * $totQty);
			   				$scrap_qty_gen 	 = $getrawMaterialById[0]['scrap_normal'];

			   				// if($this->input->post('txtscrap') == "")

			   				$UpdateDate = array(
								'rm_id' 			=> $rm_id,
								'issue_qty' 		=> $issue_qty,
								'year' 				=> $_SESSION['current_year'],
								'scrap_qty_gen' 	=> $scrap_qty_gen,
								'branch_id' 		=> $_SESSION['branch_id'],
								'created_by' 		=> $_SESSION['id'],
								'updated_by' 		=> $_SESSION['id'],
								'updated_on' 		=> date("Y-m-d"),
								'issue_doc_id' 		=> $issue_doc_id,
								'issue_doc_type' 	=> 'DPR',
							);

			   				$getrawMaterialById = $this->TranDPRModel->updateTranRmrcirStock($UpdateDate);

			   				// update tran_rmrcir_stock
				   		}
			   }
					
				}else{

						$postDatee = array(
							'scrap_used' 		=> $_POST['txtscrap'][$key],
							'qty' 				=> $_POST['txtQty'][$key],
							'work_hours' 		=> $_POST['txthours'][$key],
							'remarks' 			=> $_POST['txtremark'][$key],
							'updated_by' 		=> $_SESSION['id']
						);


					$v=$this->db->where('id',$editId);
					$query=$this->db->update('tran_dpr',$postDatee,$v);
				}

				
			}
			

				redirect('/Tran-DPR');
		}
		
		$dpr_date = base64_decode($_GET['Id']);
		if(!empty($dpr_date))
		{ 



			$data['GetDPRById'] = $this->GetQueryModel->GetDPRById($dpr_date);

			$branch_id 			= $_SESSION['branch_id'];
			$role_id 			= 7;

				$data['Getusers'] 		=   $this->GetQueryModel->Getusers($branch_id,$role_id);
				$data['Getmachine'] 	=   $this->GetQueryModel->Getmachine($branch_id);
				$data['GetMastTools'] 	=   $this->GetQueryModel->GetMastTools();
		}		
				$this->load->view('TranDPR/add',$data);

	}


}
