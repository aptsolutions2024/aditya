<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PartsController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Parts/PartsModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function parts()
	{
		$data['getParts'] = $this->getQueryModel->getParts();
		$this->load->view('Parts/viewParts',$data);
	}
	public function addParts()
	{
		$id = base64_decode($_GET['ID']);
		$data['getparts'] 			= $this->getQueryModel->getPartsById($id);
		$data['getrawMaterialById'] = $this->getQueryModel->getrawMaterialById($id);
		$data['getOperationById'] 	= $this->getQueryModel->getOperationById($id);
		$data['getQCById'] 			= $this->getQueryModel->getQCById($id);
		$data['getProdfamily'] 		= $this->getQueryModel->getProductfamily();
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$data['getrawMaterial'] 	= $this->getQueryModel->getRawMaterialNameId();
		$data['getPartName'] 		= $this->getQueryModel->getPartName();
		$data['getOperationName'] 	= $this->getQueryModel->getOperationName();
		$data['getQualityChecks'] 	= $this->getQueryModel->getQualityChecksByType('PDR');
		$this->load->view('Parts/addParts',$data);
	}
	public function createPart()
	{
		//echo "<pre>";print_r($_POST);die;
	    //$this->session->unset_userdata('createRM');
	    $this->form_validation->set_rules('prod_family', 'prod family', 'trim|required');
		//$this->form_validation->set_rules('cust_name', 'customer name', 'trim|required');
		$this->form_validation->set_rules('bin_qty', 'bin quantity', 'trim|required');
		$this->form_validation->set_rules('part_no', 'part no', 'trim|required');
		$this->form_validation->set_rules('txtUnit', 'unit', 'trim|required');
		$this->form_validation->set_rules('net_weight', 'net weight', 'trim|required');
		$this->form_validation->set_rules('txtHSNCode', 'HSN code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$isAssembly		=$this->input->post('is_assembly');
			$quantity		=$this->input->post('quantity');
			$grossWeight	=$this->input->post('gross_weight');
			$scrapNormal	=$this->input->post('scrap_normal');
			$scrapSS		=$this->input->post('scrap_ss');
			
			$operationName	=$this->input->post('operation_name');
			//$sequenceNos	=$this->input->post('sequence_nos');

			$qualityChecks	=$this->input->post('quality_checks');
			$inspect_stage	=$this->input->post('inspection_stage');
			$stdValue		=$this->input->post('standard_value');
			$minValue		=$this->input->post('minimum_value');
			$maxValue		=$this->input->post('maximum_value');
			$samplesNo		=$this->input->post('no_of_samples');

 
            /*----------------Add Parts-----------------*/
            
			$postDate = array(
				'company_id' 		=> $_SESSION['id'],
				'prodfamily_id' 	=> $this->input->post('prod_family'),
				'customer_id' 		=> $this->input->post('cust_name'),
				'bin_qty' 			=> $this->input->post('bin_qty'),
				'partno' 			=> $this->input->post('part_no'),
				'name' 				=> $this->input->post('part_name'),
				'uom' 				=> $this->input->post('txtUnit'),
				'netweight' 		=> $this->input->post('net_weight'),
				'hsncode ' 			=> $this->input->post('txtHSNCode'),
				'is_assembly ' 		=> $this->input->post('is_assembly'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				
			 $partId        =$this->PartsModel->AddParts($postDate);
		
			 
			  /*----------------Add isAssembly-----------------*/

			 if($isAssembly==0)
			 {
			 	$rawMaterials=$this->input->post('raw_material');
			 	
			 	
			 	foreach($rawMaterials as $key => $rm_id)
			 	{
			 		$rawMaterialsDate = array(
						'part_id' 			=> $partId,
						'rm_id' 			=> $rm_id,
						'grossweight' 		=> $grossWeight[$key],
						'scrap_normal'	 	=> $scrapNormal[$key],
						'scrap_ss' 			=> $scrapSS[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res1=$this->PartsModel->AddPartsRM($rawMaterialsDate);
			 	}
			 	
			 	
			 }

			 if($isAssembly==1)
			 {
			 	$partIds=$this->input->post('part_id');
			 	
			 	foreach($partIds as $key => $aspartIds)
			 	{
			 		$partDate = array(
						'part_id' 			=> $partId,
						'assembly_part_id' 	=> $aspartIds,
						'assembly_part_qty' => $quantity[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res2=$this->PartsModel->AddPartsRM($partDate);
			 	}
			 	
			 }
            
            /*----------------Add Part operation-----------------*/
            $seqeNos=0;
            $this->PartsModel->updateIsdeletedbyPart($partId);
	 		foreach($operationName as $key =>$optId)
	 		{
	 			$seqeNos++;
	 			/*$relOpt = $this->GetQueryModel->checkPartOperation($optId,$partId);
	 			$relOptId = $relOpt['id'];
	 			
				 	
	 			if($relOptId=='')
	 			{
		 			*/$operationDate = array(
							'part_id' 			=> $partId,
							'op_id' 			=> $optId,
							'sequence_no' 		=> $seqeNos,
							'created_by ' 		=> $_SESSION['id'],
							'created_on ' 		=> date("Y-m-d H:i:s"),
							);
				 	$res3=$this->PartsModel->AddPartsOpts($operationDate);
	 			/*}else
	 			{
	 				$operationDate = array(
						'sequence_no' 		=> $seqeNos,
						'updated_by ' 		=> $_SESSION['id'],
						'updated_on ' 		=> date("Y-m-d"),
						);
			 		$this->PartsModel->updatePartsOpts($operationDate,$relOptId);
	 			}*/
	 			
	 		}
            
             /*----------------Add Part qualityChecks-----------------*/
             
	 		foreach($qualityChecks as $key =>$qualityID)
	 		{
	 		if($qualityID!='')
	 			{
			 $QcDate = array(
						'part_id' 	        => $partId,
						'qualityID' 		=> $qualityID,
						//'inspection_stage' 	=> $inspect_stage[$key],
						'inspection_stage' 	=> 'PDR',
						'std_value' 		=> $stdValue[$key],
						'min_value' 		=> $minValue[$key],
						'max_value' 		=> $maxValue[$key],
						'no_of_samples' 	=> $samplesNo[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);
			 $res4=$this->PartsModel->AddPartsQC($QcDate);
	 		}
	 	   }
			 




			//$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/parts');

		}else
		 {
			$data['getProdfamily'] 		= $this->getQueryModel->getProductfamily();
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			$data['getrawMaterial'] 	= $this->getQueryModel->getRawMaterialNameId();
			$data['getPartName'] 		= $this->getQueryModel->getPartName();
			$data['getOperationName'] 	= $this->getQueryModel->getOperationName();
			$data['getQualityChecks'] 	= $this->getQueryModel->getQualityChecksByType('PDR');
			$this->load->view('Parts/addParts',$data);
		}
		
	}
	public function updatePart()
	{
	    //echo "<pre>";print_r($_POST);die;
	    //$this->session->unset_userdata('createRM');
	    $this->form_validation->set_rules('prod_family', 'prod family', 'trim|required');
		//$this->form_validation->set_rules('cust_name', 'customer name', 'trim|required');
		$this->form_validation->set_rules('bin_qty', 'bin qty', 'trim|required');
		$this->form_validation->set_rules('part_name', 'part name', 'trim|required');
		$this->form_validation->set_rules('part_no', 'part no', 'trim|required');
		$this->form_validation->set_rules('txtUnit', 'unit', 'trim|required');
		$this->form_validation->set_rules('net_weight', 'net weight', 'trim|required');
		$this->form_validation->set_rules('txtHSNCode', 'HSN code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$isAssembly			=$this->input->post('is_assembly');
			$quantity			=$this->input->post('quantity');
			$edit_quantity		=$this->input->post('edit_quantity');
			$grossWeight		=$this->input->post('gross_weight');
			$scrapNormal		=$this->input->post('scrap_normal');
			$scrapSS			=$this->input->post('scrap_ss');
			
			$edit_grossWeight	=$this->input->post('edit_gross_weight');
			$edit_scrapNormal	=$this->input->post('edit_scrap_normal');
			$edit_scrapSS		=$this->input->post('edit_scrap_ss');
			
			$operationName		=$this->input->post('operation_name');
			$sequenceNos		=$this->input->post('sequence_nos');

			//$edit_operationName	=$this->input->post('edit_operation_name');
			//$edit_sequenceNos	=$this->input->post('edit_sequence_nos');

			$qualityChecks		=$this->input->post('quality_checks');
			$stdValue			=$this->input->post('standard_value');
			$minValue			=$this->input->post('minimum_value');
			$maxValue			=$this->input->post('maximum_value');
			$samplesNo			=$this->input->post('no_of_samples');

			$edit_qualityChecks	=$this->input->post('edit_quality_checks');
			$edit_inspect_stage	=$this->input->post('edit_standard_value');
			$edit_stdValue		=$this->input->post('edit_standard_value');
			$edit_minValue		=$this->input->post('edit_minimum_value');
			$edit_maxValue		=$this->input->post('edit_maximum_value');
			$edit_samplesNo		=$this->input->post('edit_no_of_samples');

            /*----------------Add Parts-----------------*/
            
			$postDate = array(
				'company_id' 		=> $_SESSION['id'],
				'prodfamily_id' 	=> $this->input->post('prod_family'),
				'customer_id' 		=> $this->input->post('cust_name'),
				'bin_qty' 			=> $this->input->post('bin_qty'),
				'partno' 			=> $this->input->post('part_no'),
				'name' 				=> $this->input->post('part_name'),
				'uom' 				=> $this->input->post('txtUnit'),
				'netweight' 		=> $this->input->post('net_weight'),
				'hsncode ' 			=> $this->input->post('txtHSNCode'),
				'is_assembly ' 		=> $this->input->post('is_assembly'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				$partId=$this->input->post('editId');
			 	$res=$this->PartsModel->updateParts($postDate,$partId);
			 
			  /*----------------Add isAssembly-----------------*/

			 if($isAssembly==0)
			 {
			    $res1=$this->PartsModel->updateIsdeletedbyPartRM($partId);  //newly added for isassembly 
			    
			 	$rawMaterialsDate		=$this->input->post('raw_material');
			 	$edit_rawMaterials		=$this->input->post('edit_raw_material');
			 	$editRMID				=$this->input->post('editRMID');
			 	//print_r($rawMaterialsDate); 
			 	foreach($rawMaterialsDate as $key => $rm_id)
			 	{
			 		if($rm_id!='')
			 		{
			 		$rawMaterialsDate = array(
						'part_id' 			=> $partId,
						'rm_id' 			=> $rm_id,
						'grossweight' 		=> $grossWeight[$key],
						'scrap_normal'	 	=> $scrapNormal[$key],
						'scrap_ss' 			=> $scrapSS[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res1=$this->PartsModel->AddPartsRM($rawMaterialsDate);
			 		}
			 	}

			 	foreach($edit_rawMaterials as $key => $edit_rm_id)
			 	{
			 		
			 			$rawMaterialsDate = array(
						'rm_id' 			=> $edit_rm_id,
						'grossweight' 		=> $edit_grossWeight[$key],
						'scrap_normal'	 	=> $edit_scrapNormal[$key],
						'scrap_ss' 			=> $edit_scrapSS[$key],
						'updated_by ' 		=> $_SESSION['id'],
						'updated_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res1=$this->PartsModel->updatePartsRM($rawMaterialsDate,$editRMID[$key]);	
			 		
			 		
			 	}
			 
			 	
			 	
			 }

			 if($isAssembly==1)
			 {
			  
			    $res1=$this->PartsModel->updateIsdeletedbyPartAssembly($partId);	 //newly added for isassembly 
			     			
			 	$partIds=$this->input->post('part_id');
			 	$edit_partIds=$this->input->post('edit_part_id');
			 	$editPatID=$this->input->post('editPatID');

			 	foreach($partIds as $key => $aspartIds)
			 	{
			 		if($aspartIds!='')
			 		{
			 			$partDate = array(
						'part_id' 			=> $partId,
						'assembly_part_id' 	=> $aspartIds,
						'assembly_part_qty' => $quantity[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res2=$this->PartsModel->AddPartsRM($partDate);
			 		}
			 	}

			 	foreach($edit_partIds as $key => $edit_aspartIds)
			 	{
			 		
			 			$partDate = array(
						'assembly_part_id' 	=> $edit_aspartIds,
						'assembly_part_qty' => $edit_quantity[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);

			 		$res2=$this->PartsModel->updatePartsRM($partDate,$editPatID[$key]);	
			 		
			 		
			 	}
			 	
			 }


            
            /*----------------Add Part operation-----------------*/

            $seqeNos=0;
            $this->PartsModel->updateIsdeletedbyPart($partId);
            //print_r($operationName);die;
	 		foreach($operationName as $key =>$optId)
	 		{
	 			$relOpt = $this->PartsModel->checkPartOperationnew($optId,$partId);
	 			//print_r($relOpt);die;
	 			$relOptId = $relOpt['id'];
	 			$seqeNos++;
				 	
	 			if($relOptId=='')
	 			{
	 				
		 			$operationDate = array(
							'part_id' 			=> $partId,
							'op_id' 			=> $optId,
							'sequence_no' 		=> $seqeNos,
							'created_by ' 		=> $_SESSION['id'],
							'created_on ' 		=> date("Y-m-d H:i:s"),
							);
				 	$res3=$this->PartsModel->AddPartsOpts($operationDate);
	 			}else
	 			{

	 				$operationDate = array(
						'sequence_no' 		=> $seqeNos,
						'updated_by ' 		=> $_SESSION['id'],
						'updated_on ' 		=> date("Y-m-d H:i:s"),
						'isdeleted ' 		=> 0,
						);
			 		$this->PartsModel->updatePartsOpts($operationDate,$relOptId);

	 			}
	 			
	 		}
            
            /*$editOperID=$this->input->post('editOperID');
            $seqeNos=0;
	 		foreach($operationName as $key =>$optId)
	 		{
	 			$seqeNos++;
	 			if($optId!='')
	 			{
	 				$operationDate = array(
						'part_id' 			=> $partId,
						'op_id' 			=> $optId,
						'sequence_no' 		=> $seqeNos,
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d"),
						);
			 $res3=$this->PartsModel->AddPartsOpts($operationDate);
	 			}
	 			else
	 			{

	 			}
			 
	 		}*/

	 		/*foreach($edit_operationName as $key =>$edit_optId)
	 		{
	 			$operationDate = array(
						'op_id' 			=> $edit_optId,
						'sequence_no' 		=> $edit_sequenceNos[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d"),
						);
			 		$res3=$this->PartsModel->updatePartsOpts($operationDate,$editOperID[$key]);	
	 			
			 
	 		}*/
            
             /*----------------Add Part qualityChecks-----------------*/
            
            $editCQID=$this->input->post('editCQID');

	 		foreach($qualityChecks as $key =>$qualityID)
	 		{
	 			if($qualityID!='')
	 			{
	 				$QcDate = array(
						'part_id' 	        => $partId,
						'qualityID' 		=> $qualityID,
						'inspection_stage' 	=> 'PDR',
						'std_value' 		=> $stdValue[$key],
						'min_value' 		=> $minValue[$key],
						'max_value' 		=> $maxValue[$key],
						'no_of_samples' 	=> $samplesNo[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);
			 $res4=$this->PartsModel->AddPartsQC($QcDate);
	 			}
			 
	 		}

	 		foreach($edit_qualityChecks as $key =>$edit_qualityID)
	 		{
	 			//print_r($key);die;
	 			$QcDate = array(
						'qualityID' 		=> $edit_qualityID,
						//'inspection_stage' 	=> $edit_inspect_stage[$key],
						'inspection_stage' 	=> 'PDR',
						'std_value' 		=> $edit_stdValue[$key],
						'min_value' 		=> $edit_minValue[$key],
						'max_value' 		=> $edit_maxValue[$key],
						'no_of_samples' 	=> $edit_samplesNo[$key],
						'created_by ' 		=> $_SESSION['id'],
						'created_on ' 		=> date("Y-m-d H:i:s"),
						);
			 		$res4=$this->PartsModel->updatePartsQC($QcDate,$editCQID[$key]);
	 			
			 
	 		}
	 		
		    $deleteID=$this->input->post('deleteID');
			foreach($deleteID as $key =>$delID)
	 		{
              $RPQCupdate = array(
						'isdeleted' 		=> 1,
						'updated_by ' 		=> $_SESSION['id'],
						'updated_on ' 		=> date("Y-m-d H:i:s"),
						);
               $res4=$this->PartsModel->updatePartsQC($RPQCupdate,$delID);
	 		} 




			//$this->session->set_flashdata('createRM', 'You have added user successfully.');
			redirect('/parts');

		}else
		 {
			$data['getProdfamily'] 		= $this->getQueryModel->getProductfamily();
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			$data['getrawMaterial'] 	= $this->getQueryModel->getRawMaterialNameId();
			$data['getPartName'] 		= $this->getQueryModel->getPartName();
			$data['getOperationName'] 	= $this->getQueryModel->getOperationName();
			$data['getQualityChecks'] 	= $this->getQueryModel->getQualityChecksByType('PDR');
			$this->load->view('Parts/addParts',$data);
		}
		
	}
	public function deleteRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->RawMaterialModel->deleteRMRecord($postDate);
	}



}

?>