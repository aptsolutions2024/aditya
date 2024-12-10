<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ReportsController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Reports/ReportsModel');
		$this->load->model('getQuery/getQueryModel');
	}
    public function SchVSDisPatchByCust(){
         // print_r($_POST);
         
	   // $this->form_validation->set_rules('Customer_Id', 'Customer Name', 'trim|required');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
		if ($this->form_validation->run() == TRUE) {
	    $Customer_Id    = $_POST['Customer_Id'];
	    $date      = $_POST['date'];
	    $fromDate 	= date("Y-m", strtotime($date)); 
	
		   $data['getScheduleQtyInvoiceQtyAll'] = $this->getQueryModel->getScheduleQtyInvoiceQtyAll_ByCust($Customer_Id,$fromDate);
		   
	
		}
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$this->load->view('Reports/SchVSDisPatchByCust',$data);
    }
    public function getCSchVSDischart(){
          $getCSchVSDischart = $this->getQueryModel->getCSchVSDischart();
          
       	if(!empty($getCSchVSDischart)){
	   	  echo json_encode($getCSchVSDischart);  
	   	}else{
	   	    echo 0;
	   	}
    }
     public function totalSchCompletion(){
          $totalSchCompletion = $this->getQueryModel->totalSchCompletion();
          
       	if(!empty($totalSchCompletion)){
	   	  echo json_encode($totalSchCompletion);  
	   	}else{
	   	    echo 0;
	   	}
    }
    public function totalDispatch(){
         $totalDispatch = $this->getQueryModel->totalDispatch();
          
       	if(!empty($totalDispatch)){
	   	  echo json_encode($totalDispatch);  
	   	}else{
	   	    echo 0;
	   	}  
    }
     public function totalDispatchInRS(){
         $totalDispatchInRS = $this->getQueryModel->totalDispatchInRS();
          
       	if(!empty($totalDispatchInRS)){
	   	  echo json_encode($totalDispatchInRS);  
	   	}else{
	   	    echo 0;
	   	}  
    }
    public function SchVSDesPatchR()
	{
	   // print_r($_POST);
	    $this->form_validation->set_rules('schedule_from_date', 'schedule_from_date', 'trim|required');
		$this->form_validation->set_rules('schedule_to_date', 'schedule_from_date', 'trim|required');
		//$this->form_validation->set_rules('Part_Id', 'Part_Id name', 'trim|required');
	   //$this->form_validation->set_rules('Part_Search', 'Part Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {
		    
    	    $Part_Id    = $_POST['Part_Id'];
    	    $fromd      = $_POST['schedule_from_date'];
    	    $fromDate 	= date("Y-m-d", strtotime($fromd)); 
    	    $tod        = $_POST['schedule_to_date'];
    	    $toDate 	= date("Y-m-t", strtotime($tod)); 
             
    		if(!empty($Part_Id))
    		{
    		   $r1 = $this->ReportsModel->getScheduleQty($Part_Id,$fromDate,$toDate);
    		   $data['getScheduleQty'] = (!empty($r1)) ? json_encode($r1) : 0;
    		
    		   	
    		   $r2 = $this->ReportsModel->getInvoiceQty($Part_Id,$fromDate,$toDate);
    		   $data['getInvoiceQty'] = (!empty($r2)) ? json_encode($r2) : 0;
    		
    		}else
    		{
    		   
    		   $data['getScheduleQtyInvoiceQtyAll'] = $this->ReportsModel->getScheduleQtyInvoiceQtyAll($fromDate,$toDate);
    		}
		}
		$this->load->view('Reports/ScheduleVSDesPatchR',$data);
	} 
	public function OperPerformanceR(){
        $data['Getoperators'] = $this->getQueryModel->GetusersOperator();
		$this->load->view('Reports/operatorPerReport',$data);
	}

	public function showOPereport(){
		$Id=base64_decode($_GET['id']);
		$frm_date=$_GET['fromDate'];
		$to_date=$_GET['toDate'];
       
        $data['OperatorsDetails'] = $this->getQueryModel->getPerformData($Id,$frm_date,$to_date);
        $data['getPerformDataPartWiseSummary'] = $this->getQueryModel->getPerformDataPartWiseSummary($Id,$frm_date,$to_date);
         $data['getPerformDataOperatorSummary'] = $this->getQueryModel->getPerformDataOperatorSummary($Id,$frm_date,$to_date);
        
		$this->load->view('Reports/showOPereport',$data);
	}
   public function operatorPersummDashboard(){
          $getOperPerSummDashboard = $this->getQueryModel->getOperPerSummDashboard();
          
       	if(!empty($getOperPerSummDashboard)){
	   	  echo json_encode($getOperPerSummDashboard);  
	   	}else{
	   	    echo 0;
	   	}
   }
	public function predispatchIR(){
          $Id=base64_decode($_GET['ID']);
          $data['getPartNameById'] = $this->getQueryModel->getPartsById($Id);
          $data['companyDetails']     = $this->getQueryModel->companyDetails();
          $data['getQCById'] 			= $this->getQueryModel->getQCById($Id);
          	$this->load->view('Reports/preDispatchIReport',$data);
	}
	public function RMStockDetails(){
	    $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'branch name', 'trim|required');
				// $this->form_validation->set_rules('rm_id', 'RM name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		 	$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		 	$data['getBranch']        = $this->getQueryModel->getBranch();
		if ($this->form_validation->run() == TRUE) {
           $data['RMStockDetails'] = $this->getQueryModel->getRMStockDetails();
		}
         $this->load->view('Reports/RMStockDetails',$data); 
	}
	
	
	public function RMStockSummary(){
	//error_reporting(E_ALL);
	
        	$data['to_date']=$to_date=($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
          $this->load->view('Reports/rmStockSummary',$data);
	}
	public function PartStockDetails(){
	 
	//	$this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
		$this->form_validation->set_rules('Part_Search', 'Part Name', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
       
        $data=[];
		if ($this->form_validation->run() == TRUE) {
		    $data['partStockSummary']  = $this->getQueryModel->partStockSummary('Single');
		}
          $this->load->view('Reports/PartStockDetails',$data);
	}
	
	
	
	public function PartStockDetailsRevision(){
	 
	//	$this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
		$this->form_validation->set_rules('Part_Search', 'Part Name', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
       
        $data=[];
		if ($this->form_validation->run() == TRUE) {
		    $data['partStockSummary']  = $this->getQueryModel->PartStockDetailsRevision('Single');
		    $data['dcStockSummary']  = $this->getQueryModel->PartStockDetailsRevisionDc('Single');
		    $data['partStockSummary03_04_24']  = $this->getQueryModel->partStockSummary03_04_24();
		}
          $this->load->view('Reports/PartStockDetailsRevision',$data);
	}
	
	public function tranToolDetails(){

          $this->load->view('Reports/tranToolDetails');
	}
		public function tranToolDetailReport(){
	 
		$this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
		$this->form_validation->set_rules('Tool_Name', 'Tool Name', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
        $data['getallTools'] =  $this->getQueryModel->getTools();
           $data['companyDetails']       = $this->getQueryModel->companyDetails();
		if ($this->form_validation->run() == TRUE) {
		  $tool_id = $_POST['Tool_Name'];
		   $data['tData'] =  $this->getQueryModel->getToolById($tool_id);
           $data['getToolDetails'] =  $this->getQueryModel->getToolDetails();
          // $data['getConToolParts'] =  $this->getQueryModel->getConToolParts();
		}
		 $this->load->view('Reports/tranToolDetailReport',$data);
	}
	public function AllPartStockDetails(){

		$this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
       		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
      		if ($this->form_validation->run() == TRUE) {
          
      		}
      		      $this->load->view('Reports/AllPartStockDetails');
	}
	public function SchedulePlanningR(){ 
		
		$data['SSDetails'] = $this->getQueryModel->getSupplierProdPlanning();	  
		$this->load->view('Reports/SchedulePlanningR',$data);
	}
	public function getScrapStkChart(){
	   	$getScrapStock= $this->getQueryModel->getScrapStkForBChart(); 
	   //	print_r($getScrapStock);
	   	if(!empty($getScrapStock)){
	   	  echo json_encode($getScrapStock);  
	   	}else{
	   	    echo 0;
	   	}
	   	
	
	}
  //created on 23-05-2023 by Asharani
  public function ScrapStockR()
	{ 
	    $data=[];
	    $this->form_validation->set_rules('schedule_from_date', 'From Date', 'trim|required');
		$this->form_validation->set_rules('schedule_to_date', 'To Date', 'trim|required');
       		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
      	if ($this->form_validation->run() == TRUE) {
	   if(isset($_POST["export_data"])) {	
		$data['getScrapStockDet'] = $this->getQueryModel->getScrapStockDet();
	    /*	$Scrapdata=[];
        	if(!empty($data['getScrapStockDet'])){ 
                        $count=0; // print_r($getScrapStockDet);
                        foreach($data['getScrapStockDet'] as $res1){
                            $count++;
                            $rmdet = $this->getQueryModel->getRawMaterialbyrmid($res1['rm_id']);
                      
                            $branchD = $this->getQueryModel->getBranchbyId($res1['branch_id']);
                            
                            $Scrapdata[] = array(
        						'Sr_No' 			=> $count, 
        						'Date' 	            => $res1['date'], 
        						'Branch_Name' 		=> $branchD['name'], 
        						'RM_ID' 			=> $res1['rm_id'], 
        						'RM_Name' 			=> $rmdet['name'], 
        						'Type' 				=> $res1['type'], 
        						'Issue_Qty' 		=> $res1['issue_qty'], 
        						'Issue_Doc_Type' 	=> $res1['issue_doc_type'], 
        						'Issue_Doc_ID' 		=> $res1['issue_doc_id'], 
        						'Received_Qty' 		=> $res1['received_qty'], 
        						'Received_Doc_Type' => $res1['received_doc_type'],
        						'Received_Doc_ID'   => $res1['received_doc_id']
        						);
                        }
        	}
       //for download/export file to .xls format 
             $filename = "ScrapStockDetails_export_".date('Ymd') . ".xls";			
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");	
        $show_coloumn = false;
        if(!empty($Scrapdata)) {
          foreach($Scrapdata as $record) {
        	if(!$show_coloumn) {
        	  // display field/column names in first row
        	  echo implode("\t", array_keys($record)) . "\n";
        	  $show_coloumn = true;
        	}
        	echo implode("\t", array_values($record)) . "\n";
          }
        }
        	exit;  */
        }
	}
		$this->load->view('Reports/ScrapStockR',$data);
	}
	
	  //created on 03-06-2024 by Asharani
  public function ScrapStockSummary()
	{ 
	    $data=[];
	    //$this->form_validation->set_rules('schedule_from_date', 'From Date', 'trim|required');
		$this->form_validation->set_rules('schedule_to_date', 'To Date', 'trim|required');
       		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
      if ($this->form_validation->run() == TRUE) {
	   if(isset($_POST["export_data"])) {	
	      
		$data['getScrapStockDet'] = $this->getQueryModel->getScrapStockDetSummary();
		$Scrapdata=[];
        /*	if(!empty($data['getScrapStockDet'])){ 
                        $count=0; // print_r($getScrapStockDet);
                        foreach($data['getScrapStockDet'] as $res1){
                            $count++;
                           // $rmdet = $this->getQueryModel->getRawMaterialbyrmid($res1['rm_id']);
                      
                            $branchD = $this->getQueryModel->getBranchbyId($res1['branch_id']);
                           $Scrapdata[] = array(
        						'Sr_No' 			=> $count, 
        						//'Date' 	            => $res1['date'], 
        						'Branch_Name' 		=> $branchD['name'], 
        					//	'RM_ID' 			=> $res1['rm_id'], 
        					//	'RM_Name' 			=> $rmdet['name'], 
        						'Type' 				=> $res1['type'], 
        						'Issue_Qty' 		=> $res1['issue_qty'], 
        						//'Issue_Doc_Type' 	=> $res1['issue_doc_type'], 
        						//'Issue_Doc_ID' 		=> $res1['issue_doc_id'], 
        						'Received_Qty' 		=> $res1['received_qty'], 
        					//	'Received_Doc_Type' => $res1['received_doc_type'],
        					//	'Received_Doc_ID'   => $res1['received_doc_id']
        						);
                        }
        	}
       //for download/export file to .xls format 
        //$filename = "ScrapStockSummary_export_".date('Ymd') . ".xls";			
       // header("Content-Type: application/vnd.ms-excel");
       // header("Content-Disposition: attachment; filename=\"$filename\"");	
        $show_coloumn = false;
        if(!empty($Scrapdata)) {
          foreach($Scrapdata as $record) {
        	if(!$show_coloumn) {
        	  // display field/column names in first row
        	  echo implode("\t", array_keys($record)) . "\n";
        	  $show_coloumn = true;
        	}
        	echo implode("\t", array_values($record)) . "\n";
          }
        }
        	exit;  */
        }
     }
		$this->load->view('Reports/ScrapStockSummary',$data);
	}
 //Added by Asharani for invoice print : 27-06-2023
  public function printInvDispatchR(){
          $Id=base64_decode($_GET['ID']);
          $PartId=base64_decode($_GET['PartId']);
          $data['getPartNameById'] = $this->getQueryModel->getPartsById($PartId);
          $data['companyDetails']       = $this->getQueryModel->companyDetails();
          $data['getInvDetailsforR']=$this->getQueryModel->getInvDetailsforReport($Id);
          $data['getQCById'] 			= $this->getQueryModel->getQCPDRByInvDetId($Id);
          $this->load->view('Reports/printInvDispatchR',$data);
  }
  
   //Added by Asharani for Inprocess Dpr QC  Report : 27-06-2023
   
  public function InprocessDprQCR(){
      $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('branch_id', 'branch name', 'trim|required');
		   // $this->form_validation->set_rules('rm_id', 'RM name', 'trim|required');
	  	$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		 	//$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		 	$data['getBranch']        = $this->getQueryModel->getBranch();
		 	 $data['companyDetails']       = $this->getQueryModel->companyDetails();
		if ($this->form_validation->run() == TRUE) {
           $data['getDPRdate'] = $this->getQueryModel->getDPRByDatefrto();
		}
         $this->load->view('Reports/InprocessDprQCR',$data); 
  }  
  
  
  //Added by Asharani for Incoming Part QC Report : 02-11-2023
  
  public function IncomingPartQCR(){
           $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('branch_id', 'branch name', 'trim|required');
		   // $this->form_validation->set_rules('rm_id', 'RM name', 'trim|required');
	      $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		 	//$data['getRawMaterial']   = $this->getQueryModel->getRawMaterial();
		 	$data['getBranch']        = $this->getQueryModel->getBranch();
		    $data['companyDetails']       = $this->getQueryModel->companyDetails();
		if ($this->form_validation->run() == TRUE) {
           $data['getPartQC'] = $this->getQueryModel->getIncomingQCDatefrto();
		}
         $this->load->view('Reports/IncomingPartQCR',$data); 
  }
  
   //Added by Asharani for Inprocess Dpr QC  Report : 13-07-2023
	public function RMConsumptionR(){
	    
	    $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		//$this->form_validation->set_rules('branch_id', 'branch name', 'trim|required');
		//$this->form_validation->set_rules('rm_id', 'RM name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {
		   $data=array();
           $result = $this->getQueryModel->RMConsumpDetails();
            	if(!empty($result)){
	   	             $data['RMConsumpDetails'] = json_encode($result);  
        	   	}else{
        	   	    echo 0;
        	   	}
		}
         $this->load->view('Reports/RMConsumptionR',$data); 
	}
   public function getConsumablePieChart(){
	   
	
           $result = $this->getQueryModel->RMConsumpDetailsforPie();
          
            	if(!empty($result)){
	   	            echo  json_encode($result);  
        	   	}else{
        	   	    echo 0;
        	   	}
	      
	} 
	public function totalConsumedMaterial(){
	   
	
           $result = $this->getQueryModel->totalConsumedMaterial();
          
            	if(!empty($result)){
	   	            echo  json_encode($result);  
        	   	}else{
        	   	    echo 0;
        	   	}
	      
	}
	
	
	
	//Added by Asharani for Rejection Summary Report : 14-07-2023
	public function RejectionSummaryR(){
	    $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		$this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
	    $this->form_validation->set_rules('Part_Id', 'Part name', 'trim|required');
	    $this->form_validation->set_rules('Part_Search', 'Part name', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		if ($this->form_validation->run() == TRUE) {
            $data['getRejDPRSummary'] = $this->getQueryModel->getRejDPRSummary();
            $data['getRejRCIRSummary'] = $this->getQueryModel->getRejRCIRSummaryDetails();
		}
         $this->load->view('Reports/RejectionSummaryR',$data); 
	}
	public function RejSummaryDashboardR(){
	        $result = $this->getQueryModel->rejSummaryDashboardR();
            	if(!empty($result)){
	   	            echo  json_encode($result);  
        	   	}else{
        	   	    echo 0;
        	   	}
	}
   public function TranToolsDashboardR(){
       $result = $this->getQueryModel->tranToolsDashboardR();
         // print_r($result);
            	if(!empty($result)){
	   	            echo  json_encode($result);  
        	   	}else{
        	   	    echo 0;
        	   	}
   }
   
   	public function PartMvmtDatewiseDetails(){
	 

		$this->form_validation->set_rules('Part_Search', 'Part Name', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
       
        $data=[];
		if ($this->form_validation->run() == TRUE) {
		    $data['partStockDatewiseDetails']  = $this->getQueryModel->partStockDatewiseDetails();
		}
          $this->load->view('Reports/PartMvmtDatewiseDetails',$data);
	}
	 
	 	public function invoiceDetailsReport(){
    	 
    		$this->form_validation->set_rules('branch_id', 'Branch Name', 'trim|required');
    		
    		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
    		
           	$data['getBranch']        = $this->getQueryModel->getBranch();
           
    		if ($this->form_validation->run() == TRUE) {
    		    $data['invoiceStockSummary']  = $this->getQueryModel->invoiceDetailsReport();
    		}
              $this->load->view('Reports/invoiceDetailsReport',$data);
	}
	
	public function getDCDetailsReport(){
	       $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('Supplier_Id', 'Supplier name', 'trim|required');
	       $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
	
		   	$data['getSupplier']   = $this->getQueryModel->getSupplier(2);
    		if ($this->form_validation->run() == TRUE) {
           
    	     $data['getQty']  = $this->getQueryModel->getDCDetailsRCIR();
    	     $data['post_op_id']=$_POST['Op_Id'];
    		}
    		
         $this->load->view('Reports/DCdetailsReport',$data); 
	}
	
		public function saveStockAdjDCdetails(){
         // print_r($_POST);exit;
    	    
    	    error_reporting(0);
    	   if($_POST['mast_id'] && $_POST['det_id'] && $_POST['part_id'] && $_POST['op_id'] && $_POST['branch_id'] && $_POST['adjqty'] && $_POST['supId']){
    	        
    	            $UpdateDate = array(
                    'date' 			  => date("Y-m-d"),
                    'year'            => $_SESSION['current_year'],
                   // 'branch_id' 	  => $_POST['branch_id'],
                    'supplier_id'     => $_POST['supId'],
                    'part_id' 	      => $_POST['part_id'],
                    'op_id' 	      => $_POST['op_id'],
                    'qty' 		      => $_POST['adjqty'],
                    'det_dc_id'        =>$_POST['det_id'],
                    'created_by' 	  => $_SESSION['id'],
                    'created_on ' 	  => date("Y-m-d H:i:s")
                    );
                    
                    $resid=$this->db->insert('tran_part_stockadj',$UpdateDate);
                    $newStkAdjId=$this->db->insert_id();
    	        //if($_POST['adjqty']<0){
    	            $stockData= array(
        									'part_id' 			    => $_POST['part_id'],
        									'op_id' 		        => $_POST['op_id'],
        									'mast_dc_id' 	        => $_POST['mast_id'],
        									'det_dc_id' 	        => $_POST['det_id'],
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date'             => date("Y-m-d"),
        									'branch_id' 	    	=> $_POST['branch_id'],
        				                    'received_qty' 		    => $_POST['adjqty'],
        									'received_doc_id' 		=> $newStkAdjId,
        									'received_doc_type' 	=> 'stock_adj',
        									'move_from'             => "S".$_POST['supId'],
        				                    'move_to'               => "B".$_POST['branch_id'],
        									'created_by' 		    => $_SESSION['id'],
        									'created_on ' 		    => date("Y-m-d H:i:s")
								    );
    	    
        		        $result16=$this->db->insert('tran_dc_stock',$stockData);
						if($result16){
						   echo "Record Inserted Successfully...!"; 
						}else{
						  echo "Error while inserting record...!"; 
						}
        			    //$insert_id = $this->db->insert_id();
        			    
    	    }else{
    	        echo "Need All Fields..";
    	    }
    	
	}
	public function getDCRCIRDetailsReport(){
	       $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('Supplier_Id', 'Supplier name', 'trim|required');
	       $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
	
		   	   $data['getSupplier']   = $this->getQueryModel->getSupplier(2);
    		if ($this->form_validation->run() == TRUE) {
           
    	     $data['getQty']  = $this->getQueryModel->getRCIRDetails();
    	     $data['post_op_id']=$_POST['Op_Id'];
    		}
    		
         $this->load->view('Reports/DCRCIRdetailsReport',$data); 
	}
		
	public function saveStockAdjDCrcir(){
         // print_r($_POST);exit;
    	    error_reporting(0);
    	   if($_POST['mast_id'] && $_POST['det_id'] && $_POST['part_id'] && $_POST['op_id'] && $_POST['branch_id'] && $_POST['adjqty'] && $_POST['supId']){
    	        
    	            $UpdateDate = array(
                    'date' 			  => date("Y-m-d"),
                    'year'            => $_SESSION['current_year'],
                    'branch_id' 	  => $_POST['branch_id'],
                   // 'supplier_id'   => $_POST['supId'],
                    'part_id' 	      => $_POST['part_id'],
                    'op_id' 	      => $_POST['op_id'],
                    'qty' 		      => $_POST['adjqty'],
                    'det_partsrcir_id'=>$_POST['det_id'],
                    'created_by' 	  => $_SESSION['id'],
                    'created_on ' 	  => date("Y-m-d H:i:s")
                    );
                    
                    $resid=$this->db->insert('tran_part_stockadj',$UpdateDate);
                    $newStkAdjId=$this->db->insert_id();
    	        //if($_POST['adjqty']<0){
    	            $stockData= array(
        									'part_id' 			    => $_POST['part_id'],
        									'op_id' 		        => $_POST['op_id'],
        									'mast_partsrcir_id' 	=> $_POST['mast_id'],
        									'det_partsrcir_id' 	    => $_POST['det_id'],
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date'             => date("Y-m-d"),
        									'branch_id' 	    	=> $_POST['branch_id'],
        				                    'issue_qty' 		    => $_POST['adjqty'],
        									'issue_doc_id' 		=> $newStkAdjId,
        									'issue_doc_type' 	=> 'stock_adj',
        									'move_from'             => "B".$_POST['branch_id'],
        				                    'move_to'               => "B".$_POST['branch_id'],
        									'created_by' 		    => $_SESSION['id'],
        									'created_on ' 		    => date("Y-m-d H:i:s")
								    );
    	  
						$result16 = $this->db->insert('tran_partsrcir_stock',$stockData);
						if($result16){
						   echo "Record Inserted Successfully...!"; 
						}else{
						  echo "Error while inserting record...!"; 
						}
        			    //$insert_id = $this->db->insert_id();
        			    
    	    }else{
    	        echo "Need All Fields..";
    	    }
    	
	}
	public function saveStockAdjDPRdetails(){
          //print_r($_POST);exit;
    	    //error_reporting(E_ALL);
    	   if($_POST['mast_id']  && $_POST['part_id'] && $_POST['op_id'] && $_POST['branch_id'] && $_POST['adjqty']){
    	        
    	            $UpdateDate = array(
                    'date' 			  => date("Y-m-d"),
                    'year'            => $_SESSION['current_year'],
                    'branch_id' 	  => $_POST['branch_id'],
                    'part_id' 	      => $_POST['part_id'],
                    'op_id' 	      => $_POST['op_id'],
                    'qty' 		      => $_POST['adjqty'],
                    'det_dpr_id'      =>$_POST['mast_id'],
                    'created_by' 	  => $_SESSION['id'],
                    'created_on ' 	  => date("Y-m-d H:i:s")
                    );
                    
                    $resid=$this->db->insert('tran_part_stockadj',$UpdateDate);
                    $newStkAdjId=$this->db->insert_id();
                 
				    $stockData = array(
						'mast_dpr_id'   	=> $_POST['mast_id'],
						'year' 				=> $_SESSION['current_year'],
						'doc_year' 			=> $_SESSION['current_year'],
						'tran_date'         => date("Y-m-d"),
						'part_id' 			=> $_POST['part_id'],
						'operation_id' 		=> $_POST['op_id'],
						'issue_qty' 		=> $_POST['adjqty'],
						'issue_doc_id' 		=> $newStkAdjId,
						'issue_doc_type' 	=> 'stock_adj',
						'branch_id' 		=> $_POST['branch_id'],
						'move_from'         => "B".$_POST['branch_id'],
        				'move_to'           => "B".$_POST['branch_id'],
        				'created_by' 	    => $_SESSION['id'],
                        'created_on' 		=> date("Y-m-d H:i:s"),
					);
				     $result16 = $this->db->insert('tran_dpr_stock',$stockData);
						if($result16){
						   echo "Record Inserted Successfully...!"; 
						}else{
						  echo "Error while inserting record...!"; 
						}
        			    //$insert_id = $this->db->insert_id();
        			    
    	    }else{
    	        echo "Need All Fields..";
    	    }
    	
	}
	
	//created on 19 March 2024
		public function getDPRDetailsReport(){
	       $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('branch_id', 'Branch name', 'trim|required');
	       $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		   $data['getBranch']        = $this->getQueryModel->getBranch();
    		if ($this->form_validation->run() == TRUE) {
           
    	     $data['getQty']  = $this->getQueryModel->getDPRDetails();
    	      	$data['post_op_id']=$_POST['Op_Id'];
    		}
    		
         $this->load->view('Reports/DPRDetailsReport',$data); 
	}
	
	//created on 29-03-2024
		public function toolRepairDetailsReport(){
	      $this->session->unset_userdata('dcmsg');
		   	$data['getSupplier']      = $this->getQueryModel->getToolMaker();
		   	$data['getTools']      = $this->getQueryModel->getTools();
	
	    $this->form_validation->set_rules('status', 'Select Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		   	
		   	$data['getToolRepair'] = $this->getQueryModel->getToolRepairDetails();
		  
		}
    		
         $this->load->view('Reports/toolRepairDetailsReport',$data); 
	}
	
		//created on 24-05-2024 by asharani
		public function Reports(){
    		
         $this->load->view('Reports/Reports',$data); 
	}
	
		//created on 29-03-2024
		public function RMtraceability(){
           $data=array();
           $this->form_validation->set_rules('Part_Id', 'Part No', 'trim|required');
		   $this->form_validation->set_rules('invoice_no', 'Invoice No', 'trim|required');
	       $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		   $data['getSupplier']   = $this->getQueryModel->getSupplier(2);
    		if ($this->form_validation->run() == TRUE) {
    		    $partno=$_POST['Part_Id'];
    		    $invoice_no=$_POST['invoice_no'];
    		    
    	        $data['report']  = $this->getQueryModel->getRMtraceability($partno,$invoice_no);
    		}
    	//	if (!empty($data['report'] )){
          //$this->load->view('Reports/RMtraceability',$data); 
           $this->load->view('Reports/RMtraceability_New',$data); 
    	//	}
	}
		//added on 3 july 2024
		public function PMovementRCIRdetailsReport(){
	       $data=array();
           $this->form_validation->set_rules('from_date', 'From date', 'trim|required');
		   $this->form_validation->set_rules('to_date', 'To date', 'trim|required');
		   $this->form_validation->set_rules('branch_id', 'Branch Name', 'trim|required');
	       $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
	
		   	$data['getBranch']        = $this->getQueryModel->getBranch();
    		if ($this->form_validation->run() == TRUE) {
           
    	     $data['getQty']  = $this->getQueryModel->getPmovementRCIRDetails();
    		}
    		
         $this->load->view('Reports/PMovementRCIRdetailsReport',$data); 
	}
	
		public function saveStockAdjPmovercir(){
         // print_r($_POST);exit;
    	    error_reporting(0);
    	   if($_POST['mast_id'] && $_POST['det_id'] && $_POST['part_id'] && $_POST['op_id'] && $_POST['branch_id'] && $_POST['adjqty']){
    	        
    	            $UpdateDate = array(
                    'date' 			  => date("Y-m-d"),
                    'year'            => $_SESSION['current_year'],
                    'branch_id' 	  => $_POST['branch_id'],
                   // 'supplier_id'   => $_POST['supId'],
                    'part_id' 	      => $_POST['part_id'],
                    'op_id' 	      => $_POST['op_id'],
                    'qty' 		      => $_POST['adjqty'],
                    'det_partsrcir_id'=>$_POST['det_id'],
                    'created_by' 	  => $_SESSION['id'],
                    'created_on ' 	  => date("Y-m-d H:i:s")
                    );
                    
                    $resid=$this->db->insert('tran_part_stockadj',$UpdateDate);
                    $newStkAdjId=$this->db->insert_id();
    	        //if($_POST['adjqty']<0){
    	            $stockData= array(
        									'part_id' 			    => $_POST['part_id'],
        									'op_id' 		        => $_POST['op_id'],
        									'mast_partsrcir_id' 	=> $_POST['mast_id'],
        									'det_partsrcir_id' 	    => $_POST['det_id'],
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date'             => date("Y-m-d"),
        									'branch_id' 	    	=> $_POST['branch_id'],
        				                    'issue_qty' 		    => $_POST['adjqty'],
        									'issue_doc_id' 		=> $newStkAdjId,
        									'issue_doc_type' 	=> 'stock_adj',
        									'move_from'             => "B".$_POST['branch_id'],
        				                    'move_to'               => "B".$_POST['branch_id'],
        									'created_by' 		    => $_SESSION['id'],
        									'created_on ' 		    => date("Y-m-d H:i:s")
								    );
    	  
						$result16 = $this->db->insert('tran_partsrcir_stock',$stockData);
						if($result16){
						   echo "Record Inserted Successfully...!"; 
						}else{
						  echo "Error while inserting record...!"; 
						}
        			    //$insert_id = $this->db->insert_id();
        			    
    	    }else{
    	        echo "Need All Fields..";
    	    }
    	
	}
	
	public function RMPODetailsReport(){
	    
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		
		if ($this->form_validation->run() == TRUE) {
	    $date      = $_POST['date'];
	    $fromDate 	= date("Y-m", strtotime($date)); 
	       $data['RMPODetailsReport'] = $this->getQueryModel->RMPODetailsReport($fromDate);
		}
		 $this->load->view('Reports/RMPODetailsReport',$data);
	}
	
	public function DPRDeletedEntries()
	{
	    $data=[];
	    $this->form_validation->set_rules('schedule_from_date', 'From Date', 'trim|required');
		$this->form_validation->set_rules('schedule_to_date', 'To Date', 'trim|required');
       	$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
      	if ($this->form_validation->run() == TRUE) {
	        if(isset($_POST["export_data"])) {	
		        $data['getDprDeletedEntries'] = $this->getQueryModel->getDprDeletedEntries();
            }
	    }
		$this->load->view('Reports/DPRDeletedEntries',$data);
	}
		
}

?>