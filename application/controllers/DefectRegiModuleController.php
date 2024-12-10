<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DefectRegiModuleController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('getQuery/getQueryModel');
	}
    public function view(){
      
	
		   $data['getDefectregistration'] = $this->getQueryModel->getDefectregistration();
	
		$this->load->view('DefectRegiModule/view',$data);
    }
      public function add(){
      	$id = base64_decode($_GET['ID']);
        $data['companyDetails']   = $this->getQueryModel->companyDetails();
        if($data['companyDetails']['defect_reg']=='1'){
            
        	$data['getSupplier']      = $this->getQueryModel->getSupplier(2);
        	$data['getCustName']      = $this->getQueryModel->getCustName();
        	$data['getBranch']        = $this->getQueryModel->getBranch();
			$data['getPartName']   	  = $this->getQueryModel->getPartName();
        }
	
	 		$data['getDefregMastById'] 	    = $this->getQueryModel->getDefregMastById($id);
	
		$this->load->view('DefectRegiModule/add',$data);
    }
    
   public function getLocationType(){
       
      $type=$_POST['type'];
     // echo "---TYPE:::".$type;
       if($type=='C'){
        	$getdata      = $this->getQueryModel->getCustName();
       }elseif($type=='S'){
           $getdata      = $this->getQueryModel->getSupplier(2);
       }elseif($type=='I'){
           $getdata        = $this->getQueryModel->getBranch();
       }
       $option='<option value="">Choose...</option>';
       //print_r($getdata);
       foreach($getdata as $val){
            $option.="<option value=".$val['id'].">".$val['name']."</option>"; 
       }
      echo $option; 
   }
   
 /*  	public function getDCOpByPartId()
	{
	    if(!empty($_POST))
	    {
    	    $Part_Id 	=$this->input->post('Part_Id');
    	    $Location_Id =$this->input->post('Location_Id');
    	     $type =$this->input->post('type');
    	    if($type=='S'){
    		    $getOpData  = $this->getQueryModel->getDCOperationByPart($Part_Id,$Location_Id);
    			echo '<option value="">Operation</option>';
    			foreach($getOpData as $list)
    			{ 
    			$opDetails  = $this->getQueryModel->getOperationsById($list['op_id']);
    			$ids=$opDetails['id'];
    			$name=$opDetails['Name'];
    			echo '<option value="'.$ids.'" >'.$name.'</option>';
    			 } 
    	    }else{
    	        
    	        $getOpData  = $this->getQueryModel->getOperationById($Part_Id);
    			echo '<option value="">Operation</option>';
    			foreach($getOpData as $list)
    			{ 
        			$opDetails  = $this->getQueryModel->getOperationsById($list['op_id']);
        			$ids=$opDetails['id'];
        			$name=$opDetails['Name'];
        			echo '<option value="'.$ids.'" >'.$name.'</option>';
    			 } 
    	    }
	    }
	}*/
   
   public function createDefectReg(){
           //echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('dcmsg');
		$data['companyDetails']   = $this->getQueryModel->companyDetails();
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('reporting_date', 'Reporting date', 'trim|required');
		$this->form_validation->set_rules('loc_type', 'Location Type', 'trim|required');
		if($data['companyDetails']['defect_reg']=='1'){
	            	$this->form_validation->set_rules('loc_id', 'Location Name', 'trim|required');
	                $this->form_validation->set_rules('Part_Id', 'Part Name', 'trim|required');
		 }else{
                    $this->form_validation->set_rules('loc_name', 'Location Name', 'trim|required'); 
                    $this->form_validation->set_rules('Part_No', 'Part No', 'trim|required'); 
                    $this->form_validation->set_rules('Part_Name', 'Part Name', 'trim|required'); 
		 }
		 
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
         
            $status	                = $this->input->post('status');
			$reporting_date			= $this->input->post('reporting_date');
			$loc_type				= $this->input->post('loc_type');
			$loc_id		            = $this->input->post('loc_id');
			$Part_Id		        = $this->input->post('Part_Id');
			$loc_name               = $this->input->post('loc_name');
			$partno                 = $this->input->post('Part_No');
			$partnm                 = $this->input->post('Part_Name');
		
			
		
            if($data['companyDetails']['defect_reg']=='1'){
                
                if($loc_type=='C'){
                    $locName     = $this->getQueryModel->getCustomersbyid($loc_id);
                }elseif($loc_type=='S'){
                    $locName      = $this->getQueryModel->getSupplierById($loc_id);
                }elseif($loc_type=='I'){
                    $locName      = $this->getQueryModel->getBranchbyId($loc_id);
                }
                 $loc_name=$locName['name'];
                
                  $pData       = $this->getQueryModel->getPartsById($Part_Id);
                  $partno      = $pData['partno'];
    			  $partnm      = $pData['name'];
    		
    			  
            }else{
               $loc_id=0; 
               $Part_Id=0;
            }
           
//`id`, `date`, `status`, `part_id`, `part_no`, `part_name`, `loc_type`, `loc_name`, `loc_id`, `root_cause_det`, `action_started_date`, `completed_date`-->
   //`team_formation`, `defect_desc`, `containment_actions`, `root_cause_det`, `develop_perm_corr_actions`, `implement_perm_corr_actions`, `prevention`, `congratulate_team`,       
			$postDate = array(
				'status' 		      => $status,
				'date' 				  => $reporting_date,
				'loc_type' 			  => $loc_type,
				'loc_name'	          => $loc_name,
				'loc_id' 		       => $loc_id,
				'part_id' 	           => $Part_Id,
				'part_no'     	       => $partno,
				'part_name'	           => $partnm,
				'team_formation'       =>$this->input->post('team_formation'),
				'defect_desc'          =>$this->input->post('defect_desc'),
				'containment_actions'  =>$this->input->post('containment_actions'),
				'root_cause_det'       => $this->input->post('root_cause_det'),
				'develop_perm_corr_actions'  =>$this->input->post('develop_perm_corr_actions'),
				'implement_perm_corr_actions'=>$this->input->post('implement_perm_corr_actions'),
				'prevention'            =>$this->input->post('prevention'),	
				'congratulate_team'     =>$this->input->post('congratulate_team'),
				'created_by ' 	    	=> $_SESSION['id'],
				'created_on ' 		    => date("Y-m-d H:i:s"),
				);
				
					$result1 = $this->db->insert('defect_registation',$postDate);
        			$mast_dr_id= $this->db->insert_id();
		
            redirect('/viewDefectRegiModule');

		}else
		 {
		     
		  $this->session->set_flashdata('dcmsg', 'Defect registration details should be mandatory!');
		        $this->add();
		}
       
   }
   	public function updateDefectReg()
	{
	    $this->session->unset_userdata('dcmsg');
		$data['companyDetails']   = $this->getQueryModel->companyDetails();
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('reporting_date', 'Reporting date', 'trim|required');
		$this->form_validation->set_rules('loc_type', 'Location Type', 'trim|required');
		if($data['companyDetails']['defect_reg']=='1'){
	            	$this->form_validation->set_rules('loc_id', 'Location Name', 'trim|required');
	                $this->form_validation->set_rules('Part_Id', 'Part Name', 'trim|required');
		 }else{
                    $this->form_validation->set_rules('loc_name', 'Location Name', 'trim|required'); 
                    $this->form_validation->set_rules('Part_No', 'Part No', 'trim|required'); 
                    $this->form_validation->set_rules('Part_Name', 'Part Name', 'trim|required'); 
		 }
		 
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
	    $editId			        = $this->input->post('editId');
		if ($this->form_validation->run() == TRUE) {
		
            $status	                = $this->input->post('status');
			$reporting_date			= $this->input->post('reporting_date');
			$loc_type				= $this->input->post('loc_type');
			$loc_id		            = $this->input->post('loc_id');
			$Part_Id		        = $this->input->post('Part_Id');
			$loc_name               = $this->input->post('loc_name');
			$partno                 = $this->input->post('Part_No');
			$partnm                 = $this->input->post('Part_Name');
			$action_started_date	= $this->input->post('action_started_date');
			$completed_date			= $this->input->post('completed_date');
			
		
            if($data['companyDetails']['defect_reg']=='1'){
                
                if($loc_type=='C'){
                    $locName     = $this->getQueryModel->getCustomersbyid($loc_id);
                }elseif($loc_type=='S'){
                    $locName      = $this->getQueryModel->getSupplierById($loc_id);
                }elseif($loc_type=='I'){
                    $locName      = $this->getQueryModel->getBranchbyId($loc_id);
                }
                 $loc_name=$locName['name'];
                
                  $pData       = $this->getQueryModel->getPartsById($Part_Id);
                  $partno      = $pData['partno'];
    			  $partnm      = $pData['name'];
    		
    			  
            }else{
               $loc_id=0; 
               $Part_Id=0;
            }
	    
	   // echo "<pre>";print_r($_POST);die;
			$postDate = array(
				'status' 		    => $status,
				'date' 				=> $reporting_date,
				'loc_type' 			=> $loc_type,
				'loc_name'	        => $loc_name,
				'loc_id' 		    => $loc_id,
				'part_id' 	        => $Part_Id,
				'part_no'     	    => $partno,
				'part_name'	        => $partnm,
				'action_started_date' => $action_started_date,
				'completed_date'	  => $completed_date,
				'team_formation'       =>$this->input->post('team_formation'),
				'defect_desc'          =>$this->input->post('defect_desc'),
				'containment_actions'  =>$this->input->post('containment_actions'),
				'root_cause_det'       => $this->input->post('root_cause_det'),
				'develop_perm_corr_actions'  =>$this->input->post('develop_perm_corr_actions'),
				'implement_perm_corr_actions'=>$this->input->post('implement_perm_corr_actions'),
				'prevention'            =>$this->input->post('prevention'),	
				'congratulate_team'     =>$this->input->post('congratulate_team'),
				'updated_by ' 		  => $_SESSION['id'],
				'updated_on ' 		  => date("Y-m-d H:i:s"),
				);
				
			if($editId) {
    			$this->db->where('id', $editId);
    			$update = $this->db->update('defect_registation', $postDate);
    			if($update){
    			     $this->session->set_flashdata('dcmsg', 'Record Updated Successfully.');
    			}else{
    			      $this->session->set_flashdata('dcmsg', 'Record Not Updated.');
    			}
			}
			
 
    	    redirect('/viewDefectRegiModule');
		}else
		{
		     
		  $this->session->set_flashdata('dcmsg', 'Defect registration details should be mandatory!');
		       // redirect('/viewDefectRegiModule');
		        redirect('/addDefectRegiModule?ID='.base64_encode($editId)); 
		}     
           
   
    }
    
    public function defregPrint()
	{
    	$id = base64_decode($_GET['ID']);
    	$data['companyDetails']     = $this->getQueryModel->companyDetails();
    	$data['getDRMastById'] 	    = $this->getQueryModel->getDefregMastById($id);
		$this->load->view('DefectRegiModule/defregPrint',$data);
	}
    
      public function deleteDefregDetails(){
		   $postDate = array(
				'isdeleted' => 1,
				);
    		$this->db->where("id",$_POST['editId']);
            $update = $this->db->update('defect_registation', $postDate);
        	echo ($update == true) ? "Record deleted." : "Something wrong happened while deleting record.";
    	}
    	

}
?>