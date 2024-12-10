<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
class TranDPRController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	//	$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
		//$this->load->model('TranDPR/TranDPRModel');
	}
	public function index()
	{
			$data['getDprData'] 	= $this->GetQueryModel->getDprData();
		
		if(!empty($data['getDprData']))
		{
			$this->load->view('TranDPR/index',$data);
		}
		else{
			$this->load->view('TranDPR/index');
		}
		
	}

	public function getProdPart_Id()
	{
		$date = $_POST['date'];
        $allparts=$_POST['allparts'];
       // echo "***POST[allparts]**".$allparts;
        if($allparts == '' || $allparts != 'getallparts'){
		$getProdPart_Id = $this->GetQueryModel->getProdPart_Id($date);
		$datas = [];
	      if(!empty($getProdPart_Id))
		   {
    			foreach ($getProdPart_Id as $key => $value) 
    			{
    				$res1 = $this->GetQueryModel->getPartsById($value['part_id']);
    				$prodIid = ($value['id']);
    			//	$planQty =($value['planning_qty']+$value['booked_qty']);
    					$planQty =$value['planning_qty'];
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
    						'prod_plan_id' 		=> trim($prodIid),
    						'plan_qty'   		=> trim($planQty)
    						
    					);
    			}
		 }
        }else{
          $getProdPart_Id = $this->GetQueryModel->getParts();
		   $datas = [];
	      if(!empty($getProdPart_Id))
		   {
    			foreach ($getProdPart_Id as $key => $value) 
    			{
    			
    					$datas[] = array(
    						'part_id' 			=> $value['part_id'], 
    						'prodfamily_id' 	=> $value['prodfamily_id'], 
    						'customer_id' 		=> $value['customer_id'], 
    						'partno' 			=> $value['partno'], 
    						'name' 				=> $value['name'], 
    						'uom' 				=> $value['uom'], 
    						'netweight' 		=> $value['netweight'], 
    						'hsncode' 			=> $value['hsncode'], 
    						'bin_qty' 			=> $value['bin_qty'], 
    						'is_assembly' 		=> $value['is_assembly'], 
    						'prod_plan_id' 		=> 0,
    						'plan_qty'   		=> 0
    						
    					);
    			}
		 }
        }
		$id = base64_decode($_GET['ID']);
	
        $str .="<option value='0'> Select Part</option>";
		foreach ($datas as $key => $value) 
		{
		 
			 $str .= "<option data-id='".$value['prod_plan_id']."' data-partid='".$value['part_id']."' value='".$value['part_id'].'@'.$value['prod_plan_id']."'>". $value['partno']." - ".$value['name']." Qty - ".$value['plan_qty']."</option>";			
	 }

		echo $str;
	}
	
	public function getToolbyPartOperation()
	{

		$part_id 	= explode("@", $_POST['part_id']);
		$Op_id 		= explode("@",$_POST['Op_id']);

		$getToolbyPartOperation = $this->GetQueryModel->getToolbyPartOperation($part_id[0],$Op_id[0]);
	
       // $str6 .="<option> Select Tool</option>";
       $sizeoftool=sizeof($getToolbyPartOperation);
		foreach ($getToolbyPartOperation as $key => $value) 
		{
		    if($sizeoftool>1 && $value['name']=='NOT APPLICABLE' && $value['id']==25){
		        	
		    }else{
		        	$str6 .= "<option value='".$value['id']."'>". $value['name']."</option>";	
		    }
				
        }

		echo $str6;
	}
	
	public function getToolSucess()
	{
		$date = $_POST['date'];
		$toolid = $_POST['toolid'];
		$getToolSucess = $this->GetQueryModel->getToolSucess($date,$toolid);

		echo $getToolSucess;
	}
	public function getOperbyPartOp()
	{
        error_reporting(E_ALL);
		$partId = explode("@", $_POST['part_id']);
		$op_id = $_POST['op_id'];
	//	$partId 		= $partId[0];
		
		$user_id = $_SESSION['id'];
		$GetuserById = $this->GetQueryModel->GetuserById($user_id);
		
		$role 	= $_SESSION['role'];
	//	print_r($_SESSION);
		//$branch_id 	= (!empty($GetuserById)) ? $GetuserById['branch_id'] : "";

		$getProdPart_Id = $this->GetQueryModel->getOperbyPart_Id($partId[0],$role,$_SESSION['branch_id']);
		
		$datas1 = [];
		if(!empty($getProdPart_Id))
		{
			foreach ($getProdPart_Id as $key => $value1) 
			{
				$datas1[] = $this->GetQueryModel->getOperation($value1['op_id']);
				
			}
		}
       	$datas2 = [];
       
		foreach ($datas1 as $key => $value) 
		{

			if($value['id'] === $op_id)
			{
				
       		$MaxQty = "";

			$op_id 	= $value['id'];
			$partId 		= explode("@", $_POST['part_id']);
			$booked_doc_id 	= $partId[1];

			if($value['rmConsumption'] == 1)
			{
			   // echo "************************************************";
			  
				$datas2 		= $this->GetQueryModel->getPossibleQty($op_id,$partId[0],$booked_doc_id);
			
			    $MaxQtynos = (($datas2['stock'] * 1000) / $datas2['grossweight']);
			
				$stock 			= $datas2['stock'];
				$scrap_normal 	= $datas2['scrap_normal'];
				$grossweight 	= $datas2['grossweight'];
				$scrap_ss 		= $datas2['scrap_ss'];

				$MaxQty = round($MaxQtynos,3);
			}else{
				$getPrevOpQty = $this->GetQueryModel->getPrevOpQtyQCDPR($partId[0],$op_id);
				$MaxQty = round($getPrevOpQty,3);
			}
            $strq1 ="";
			if(($value['carriedOut'] == 1 || $value['carriedOut'] ==3) AND ($value['id'] > 3))
			{
			 	$strq1 .= "<option value='".$value['id']."@".$MaxQty."'>". $value['name']."</option>";
			}
	 	}
	 }
	 	$arrayName = array('stock' => $MaxQty );
	 	echo json_encode($arrayName);
	}
	
		
	//for getting max quantity
	public function getOperbyPart_Id()
	{

		$user_id = $_SESSION['id'];
		$GetuserById = $this->GetQueryModel->GetuserById($user_id);
		
		$partId = explode("@", $_POST['part_id']);

		$role 	= $_SESSION['role'];
		$branch_id 	= (!empty($GetuserById)) ? $GetuserById['branch_id'] : "";

		$getProdPart_Id = $this->GetQueryModel->getOperbyPart_Id($partId[0],$role,$branch_id);
		
		$datas1 = [];
		$Sequence_no= [];
		if(!empty($getProdPart_Id))
		{
			foreach ($getProdPart_Id as $key => $value1) 
			{
				$datas1[] = $this->GetQueryModel->getOperation($value1['op_id']);
					$Sequence_no[] = $value1['sequence_no'] ;
					$nosperkg[] = $value1['nosperkg'] ;
				
			}
		}

       	$strq1 ="<option value=''>Select Operation</option>";
       	$datas2 = [];
       	
       
		foreach ($datas1 as $key => $value) 
		{
       		$MaxQty = "";

			$op_id 	= $value['id'];
			$partId 		= explode("@", $_POST['part_id']);
			$booked_doc_id 	= $partId[1];
			//added by shraddha
			$nos = $nosperkg[$key];
			$scrapRatio = 0;
			if($nos!='' && $nos>0){
		    	$scrapRatio = round(1000/$nos,3);
			}

			if($value['rmConsumption'] == 1)
			{
			  
				$datas2 		= $this->GetQueryModel->getPossibleQty($op_id,$partId[0],$booked_doc_id);
			
			    $MaxQtynos = (($datas2['stock'] * 1000) / $datas2['grossweight']);
			
				$stock 			= $datas2['stock'];
				$scrap_normal 	= $datas2['scrap_normal'];
				$grossweight 	= $datas2['grossweight'];
				$scrap_ss 		= $datas2['scrap_ss'];

				$MaxQty = round($MaxQtynos,3)."@".$scrap_normal."@".$grossweight."@".$scrap_ss;
			}else{
				$getPrevOpQty = $this->GetQueryModel->getPrevOpQtyQCDPR($partId[0],$op_id);
				$MaxQty = round($getPrevOpQty,3);
			}

			if(($value['carriedOut'] == 1 || $value['carriedOut'] ==3) AND ($value['id'] > 3))
			{
			 	$strq1 .= "<option value='".$value['id']."@".$MaxQty."' data-scrap-ratio='".$scrapRatio."'>".$Sequence_no[$key]." - ". $value['name']."</option>";
			}
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
	public function AddDPR()
	{  

		$branch_id 	= $_SESSION['branch_id'];
		$role_id 	= 7; //Only operators are selected

		if(empty($_POST))
		{
			$data['Getusers'] 		=   $this->GetQueryModel->Getusers($branch_id,$role_id);
			$data['Getmachine'] 	=   $this->GetQueryModel->Getmachine($branch_id);
			$data['GetMastTools'] 	=   $this->GetQueryModel->GetMastTools();

			$this->load->view('TranDPR/add',$data);
		}else{ 
				//add dpr start

			$date = $this->input->post('txtDate');
	        
			$postDate=[];
			$op_id = "";
			foreach ($_POST['txtpart'] as $key => $value) 
			{
			
			     $partId 			= explode("@", $_POST['txtpart'][$key]);
		
	             $txtoperations 	= explode("@", $_POST['txtoperations'][$key]);
				 $part_id 			= $partId[0];
				 $prod_plan_id      = $partId[1] ;
				 $op_id 			= $txtoperations[0];
				 $dpr_qty 			= $_POST['txtQty'][$key];
				 $scrap_ratio       = $_POST['scrap_ratio'][$key];
				 $scrap_qty         =$_POST['txtScrapQty'][$key];
                 $scrap_used=(!empty($_POST['txtscrap'][$key])) ? $_POST['txtscrap'][$key] : "N";
                if($part_id && $op_id){
				$postDate = array(
					'prod_plan_id' 		=> $prod_plan_id,
					'dpr_date' 			=> $date,
					'operation_id' 		=> $op_id,
					'operator_id' 		=> $_POST['txtoperator'][$key],
					'tool_id' 			=> $_POST['txttools'][$key],
					'branch_id' 		=> $_SESSION['branch_id'],
					'machine_id' 		=> $_POST['txtmachines'][$key],
					'part_id' 			=> $partId[0],
					'scrap_used' 		=> $scrap_used,
					'qty' 				=> $_POST['txtQty'][$key],
					'qty_in_kgs' 		=> $_POST['txtQtyInkgs'][$key],
					'work_hours' 		=> $_POST['txthours'][$key],
					'scrap_dpr_qty'     => $_POST['txtScrapQty'][$key],
					'remarks' 			=> $_POST['txtremark'][$key],
					'created_by' 		=> $_SESSION['id'],
					'updated_by' 		=> $_SESSION['id'],
					'updated_on' 		=> date("Y-m-d H:i:s"),
					'created_on' 		=> date("Y-m-d H:i:s"),
					'year' 				=> $_SESSION['current_year']
				);
				
			
			   $result = $this->db->insert('tran_dpr',$postDate);
		 		$issue_doc_id = $this->db->insert_id();
			   if($result)
			   {   

			   		$postDate34 = array(
			   		    'prod_plan_id' 		=> $prod_plan_id,
						'mast_dpr_id'   	=> $issue_doc_id,
						'year' 				=>  $_SESSION['current_year'],
						'doc_year' 			=>  $_SESSION['current_year'],
						'tran_date'         =>  $this->input->post('txtDate'),
						'part_id' 			=>  $partId[0],
						'operation_id' 		=>  $op_id,
						'received_qty' 		=>  $_POST['txtQty'][$key],
						'received_doc_type' =>  "tran_dpr",
						'received_doc_id' 	=>  $issue_doc_id,
						'created_by' 		=>  $_SESSION['id'],
						'branch_id' 		=>  $_SESSION['branch_id'],
						'move_from'             => "B".$_SESSION['branch_id'],
        				'move_to'               => "B".$_SESSION['branch_id'],
                        'updated_on' 		=> date("Y-m-d H:i:s"),
                        'created_on' 		=> date("Y-m-d H:i:s")
					);
				  $result1 = $this->db->insert('tran_dpr_stock',$postDate34);
		   		   $tot_booked_qty = 0;
//start booked_qty
     /*             $bookedres=$this->GetQueryModel->updatePartOpBookedStock($part_id,$op_id);
                  $tot_booked_qty = 0;
			       if(!empty($bookedres) && ($_POST['txtQty'][$key]>0))
			       { $dpr_booked_qty = $dpr_qty;
			        
			           foreach($bookedres as $key=>$value)
			           { $available_qty =($value['max_qty']>=$dpr_booked_qty) ?$dpr_booked_qty:$value['max_qty'];
			               
		                    	$postDate34 = array(
                                    'part_id' 			=> $part_id,
                                    'year' 				=>  $_SESSION['current_year'],
                                    'doc_year' 			=>  $_SESSION['current_year'],
                                    'tran_date'         =>  $this->input->post('txtDate'),
                                    'branch_id' 		=> $_SESSION['branch_id'],
            						'issue_qty' 		=>  $available_qty,
            						'issue_doc_type' =>  "tran_dpr",
            						'issue_doc_id' 	    =>  $issue_doc_id,
            						'booked_doc_id' 	    => $value['booked_doc_id'],
            						'booked_doc_type' 	    => $value['booked_doc_type'],
            						'updated_by' 		=>  $_SESSION['id'],
            						'branch_id' 		=>  $_SESSION['branch_id'],
            						'move_from'             => "B".$_SESSION['branch_id'],
        				            'move_to'               => "B".$_SESSION['branch_id'],
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
            					);
            				
            					//$where = array('id'=>$value['id'],"booked_qty>"=>'0');
            					 //$this->db->where($where);
            					if ($value['doc'] =='dpr')
            					{
        					         $postDate34['operation_id'] =$value['op_id'];
        					         $postDate34['mast_dpr_id'] = $value['det_id'];
        					         echo "@@@@ 4";
        					         $result1 = $this->db->insert('tran_dpr_stock',$postDate34);
        					         
        					          
        					         $updateooked=array('booked_qty' =>($value['max_qty']-$available_qty));
        					         $where=array('mast_dpr_id'=>$value['det_id'],'booked_qty>'=>0);
        					         $res = $this->db->update('tran_dpr_stock',$updateooked,$where);
            					}
            					else
            					{
            					    $postDate34['op_id'] = $value['op_id'];
            					   	$postDate34['mast_partsrcir_id']=$value['mast_partsrcir_id'];
                                    $postDate34['det_partsrcir_id']= $value['det_id'];
            					    $result1 = $this->db->insert('tran_partsrcir_stock',$postDate34);
            					  
            					    $updateooked=array('booked_qty' =>($value['max_qty']-$available_qty));
        					         $where=array('det_partsrcir_id'=>$value['det_id'],'booked_qty>'=>0);
        					         $res = $this->db->update('tran_partsrcir_stock',$updateooked,$where);
            					    
            					}
                             
                                //entry in tran_dpr_stock  for booked qty
            			   		$postDate34 = array(
            						'mast_dpr_id'   	=> $issue_doc_id,
            						'year' 				=> $_SESSION['current_year'],
            						'doc_year' 			=> $_SESSION['current_year'],
            						'tran_date'         =>  $this->input->post('txtDate'),
            						'part_id' 			=> $partId[0],
            						'operation_id' 		=> $op_id,
            						'booked_doc_type'   => $value['booked_doc_type'],
            						'booked_doc_id'     => $value['booked_doc_id'],
            						'booked_qty'        => $available_qty,
            						'created_by' 		=> $_SESSION['id'],
            						'branch_id' 		=> $_SESSION['branch_id'],
            						'move_from'             => "B".$_SESSION['branch_id'],
        				            'move_to'               => "B".$_SESSION['branch_id'],
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                    'created_on' 		=> date("Y-m-d H:i:s")
            					);
            				
                        	  $result1 = $this->db->insert('tran_dpr_stock',$postDate34);
                             $dpr_booked_qty=$dpr_booked_qty-$available_qty;
                             $tot_booked_qty=$tot_booked_qty+$available_qty;
                            if ($dpr_booked_qty<=0)
                                {break;}
			           }
			       }//end of booked qty updation
			       
			       */
			       $dpr_qty = $dpr_qty-$tot_booked_qty;
			       if ($dpr_qty>0 && ($_POST['txtQty'][$key]>0))
			       {
    		  		  	$this->updatestcok($partId[0],$op_id,$issue_doc_id,$dpr_qty,$prod_plan_id,$scrap_used,$scrap_qty,$scrap_ratio);
	           	      $this->invoiceAdj($part_id);
			       }

	   			  
	   			}
			}
			
			}
				redirect('/Tran-DPR');
		}
	}
	public function invoiceAdj($part_id){
    //*******************************************************************************************************
	    $query=$this->db->query("select issue_qty,issue_doc_id,doc_year,tran_date from tran_dpr_stock where part_id='$part_id' and mast_dpr_id='9999999' and issue_qty>0 and branch_id='$_SESSION[branch_id]' and year='$_SESSION[current_year]'");
	    $stockAdjqty=$query->result_array();
	    
	    //print_r($stockAdjqty);
	    	foreach ($stockAdjqty as $key => $stkqty) 
			{
	    	          $updatePartOpStock1 = $this->GetQueryModel->updateInvoiceAdj($part_id,'47'); 
	    	          
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
        									'branch_id' 		=> $_SESSION['branch_id'],
                    	                    'move_from'         => "B".$_SESSION['branch_id'],
                            				'move_to'           => "B".$_SESSION['branch_id'],
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
        									'branch_id' 	    	=> $_SESSION['branch_id'],
                    	                    'move_from'             => "B".$_SESSION['branch_id'],
                            				'move_to'               => "B".$_SESSION['branch_id'],    									
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
	public function UpdateDPR()
	{
	   
   
		if(!empty($_POST))
		{
		    // print_r($_POST);die;
		    foreach ($_POST['txtpart'] as $key => $value) 
			{
           
				$editId = $_POST['id'][$key];
		    	$prod_plan_id =$_POST['prod_plan_id'][$key];
		    	$scrap_qty = $_POST['txtScrapQty'][$key];
		    	$scrap_ratio = round(1000/$_POST['txtQtyInkgs'][$key],3);
                $scrap_used=(!empty($_POST['txtscrap'][$key])) ? $_POST['txtscrap'][$key] : "N";
            	if(empty($editId))
				{ 
				  if($_POST['txtpart'][$key]  && $_POST['txtoperations'][$key]){
				    echo "<br>IF ADD";
					$date = $this->input->post('txtDate');
    				 $partIdExplode 			= explode("@", $_POST['txtpart'][$key]);
    				 $prod_plan_id      = $partIdExplode[1] ;
                  
                    
					$postDate = array(
					'prod_plan_id' 		=> $prod_plan_id,
					'dpr_date' 			=> $date,
					'operation_id' 		=> $_POST['txtoperations'][$key],
					'operator_id' 		=> $_POST['txtoperator'][$key],
					'tool_id' 			=> $_POST['txttools'][$key],
					'branch_id' 		=> $_SESSION['branch_id'],
					'machine_id' 		=> $_POST['txtmachines'][$key],
					'part_id' 			=> $_POST['txtpart'][$key],
					'scrap_used' 		=> $scrap_used,
					'qty' 				=> $_POST['txtQty'][$key],
					'qty_in_kgs' 		=> $_POST['txtQtyInkgs'][$key],
					'work_hours' 		=> $_POST['txthours'][$key],
					'scrap_dpr_qty'     => $_POST['txtScrapQty'][$key],
					'remarks' 			=> $_POST['txtremark'][$key],
					'created_by' 		=> $_SESSION['id'],
					'updated_by' 		=> $_SESSION['id'],
					'updated_on' 		=> date("Y-m-d H:i:s"),
                    'created_on' 		=> date("Y-m-d H:i:s"),
					'year' 				=> $_SESSION['current_year']
				);

			   $result = $this->db->insert('tran_dpr',$postDate);

	    		if($result)
			   	{
			   		$issue_doc_id = $this->db->insert_id();

			   		$postDate34 = array(
			   		    'prod_plan_id' 		=> $prod_plan_id,
						'mast_dpr_id' 	=> $issue_doc_id,
						'year' 				=>  $_SESSION['current_year'],
						'doc_year' 			=>  $_SESSION['current_year'],
						'tran_date'         =>  $this->input->post('txtDate'),
						'part_id' 			=>  $_POST['txtpart'][$key],
						'operation_id' 		=>  $_POST['txtoperations'][$key],
						'received_qty' 		=>  $_POST['txtQty'][$key],
						'received_doc_type' =>  "tran_dpr",
						'received_doc_id' 	=>  $issue_doc_id,
						'created_by' 		=>  $_SESSION['id'],
						'branch_id' 		=>  $_SESSION['branch_id'],
	                    'move_from'             => "B".$_SESSION['branch_id'],
        				'move_to'               => "B".$_SESSION['branch_id'],						
						'updated_on' 		=> date("Y-m-d H:i:s"),
                        'created_on' 		=> date("Y-m-d H:i:s")
					);
					
                    echo "@@@@ 1";
		   		  $result1 = $this->db->insert('tran_dpr_stock',$postDate34);
                  
		   		  if($result1 && ($_POST['txtQty'][$key]>0))
		   		  {
		   		    
		   		  	//$this->updatestcok($partId[0],$txtoperations[0],$issue_doc_id,$_POST['txtQty'][$key],$prod_plan_id,$scrap_used);
		   		  	$this->updatestcok($_POST['txtpart'][$key],$_POST['txtoperations'][$key],$issue_doc_id,$_POST['txtQty'][$key],$prod_plan_id,$scrap_used,$scrap_qty,$scrap_ratio);
	                 $this->invoiceAdj($_POST['txtpart'][$key]);
		   		   }
	   			  
	   		      }
				 }	
				}else{ 
				    //update records
            			$postDatee = array(
							'qty' 				=> $_POST['txtQty'][$key],
							'qty_in_kgs' 		=> $_POST['txtQtyInkgs'][$key],
							'work_hours' 		=> $_POST['txthours'][$key],
							'remarks' 			=> $_POST['txtremark'][$key],
							'updated_by' 		=> $_SESSION['id'],
							'updated_on' 		=> date("Y-m-d H:i:s")
                        
						);

					$v = $this->db->where('id',$editId);
					$query = $this->db->update('tran_dpr',$postDatee,$v);


					$postDate34 = array(
						'received_qty' 		=>  $_POST['txtQty'][$key],
					);
					
								$where = array('mast_dpr_id'=>$editId,"received_doc_type"=>'tran_dpr',"received_qty"=>'0');
            					 $v1=$this->db->where($where);
            	
					
				//	$v1 = $this->db->where('mast_dpr_id',$editId);
					echo "@@@@ 2";
					$query=$this->db->update('tran_dpr_stock',$postDate34,$v1);
					$afftectedRows = $this->db->affected_rows();
                    echo "***  ". $afftectedRows."   ****";
                    if ($afftectedRows >0){
					$this->updatestcok($_POST['txtpart'][$key],$_POST['txtoperations'][$key],$editId,$_POST['txtQty'][$key],$prod_plan_id,$scrap_used,$scrap_qty,$scrap_ratio);
					$this->invoiceAdj($_POST['txtpart'][$key]);
                    }
				}
			}

			redirect('/Tran-DPR');
		
		}
		
		$dpr_date = base64_decode($_GET['Id']);
		if(!empty($dpr_date))
		{ 



			$data['GetDPRById'] = $this->GetQueryModel->getDprRecByDate($dpr_date);

			$branch_id 			= $_SESSION['branch_id'];
			$role_id 			= 7;

				$data['Getusers'] 		=   $this->GetQueryModel->Getusers($branch_id,$role_id);
				$data['Getmachine'] 	=   $this->GetQueryModel->Getmachine($branch_id);
				$data['GetMastTools'] 	=   $this->GetQueryModel->GetMastTools();
		}	
		
				$this->load->view('TranDPR/add',$data);

	}


	public function updatestcok($part_id,$opId,$issue_doc_id,$totalqty,$prod_plan_id,$scrap_used,$scrap_qty,$scrap_ratio)
	{
        echo $totalqty;
		if ($totalqty == 0){return;}
			$getOperation = $this->GetQueryModel->getOperation($opId);
             echo "****   ".$opId." *****  " ;
             print_r($getOperation);
             echo "<br>";

			   if(!empty($getOperation))
			   {
   			  		
   			  		$rmConsumption = $getOperation['rmConsumption'];
     	            
     	            if($rmConsumption == 1)
					{
					    echo "***In IF RmConsumption**";
				
					   
				
				
						$getrawMaterialById  = $this->GetQueryModel->getrawMaterialById($part_id);
					
					       $resnew=$this->GetQueryModel->getPartOpQty_new($part_id,$opId);
					     //  print_r($resnew);
                           $nosperkg='';
                           $scrap_normal=0;
                           $scrap_ss=0;
                           if($resnew['nosperkg']){
                             $nosperkg=round(1000/$resnew['nosperkg'],3);
                           }
                           if($getrawMaterialById[0]['scrap_normal']>0 && $nosperkg!=''){
                               $scrap_normal=$getrawMaterialById[0]['grossweight']-$nosperkg;
                           }elseif($getrawMaterialById[0]['scrap_ss']>0 && $nosperkg!=''){
                               $scrap_ss=$getrawMaterialById[0]['grossweight']-$nosperkg;
                           }else{
                               $scrap_normal=$getrawMaterialById[0]['scrap_normal'];
                               $scrap_ss=$getrawMaterialById[0]['scrap_ss'];
                           }
                          // echo "<br>scrap_normal-".$scrap_normal."  scrap_ss".$scrap_ss;
                           //exit;
					
						$rm_id  			 = $getrawMaterialById[0]['rm_id'];
					    $totQty 	 	     = $totalqty;
					    $grossweight 	     = $getrawMaterialById[0]['grossweight'];
						$issue_qty 		 	 = round($grossweight * $totQty/1000,3);
						$scrap_qty_normal 	 = round($scrap_normal * $totQty/1000,3);
						$scrap_qty_ss 	 	 = round($scrap_ss * $totQty/1000,3);
						$txtscrap 	 	     = $scrap_used;
						
	                   $sum_booked_qty=0;
				
						    	$date = $this->input->post('txtDate');
                                $rm_id  			 = $getrawMaterialById[0]['rm_id'];
                                $totQty 	 	     = $totalqty;
                                $grossweight 	     = $getrawMaterialById[0]['grossweight'];
                                $issue_qty 		 	 = round($grossweight * $totQty/1000,3);

						    
						    	$UpdateDate2f = array(
						    	    'prod_plan_id'       =>$prod_plan_id,
									'year' 		        => $_SESSION['current_year'],
									'date'              =>$date,
									'rm_id' 		    => $rm_id,
									'issue_qty' 	    => $issue_qty,
									'issue_doc_type' 	=> "tran_dpr",
									'issue_doc_id' 		=> $issue_doc_id,
									'branch_id' 		=> $_SESSION['branch_id'],
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                    'created_on' 		=> date("Y-m-d H:i:s"),
									'created_by' 		=> $_SESSION['id']
								);
                            if($txtscrap == 'Y')
    						{
    						      echo "IF---txtscrap == 'Y'";
    					     	$result16s = $this->db->insert('scrap_stock',$UpdateDate2f);
    					     	$result16sId=$this->db->insert_id();
    					     	
    						}
						  
						if(!empty($getrawMaterialById[0]) && $issue_qty > 0 && $txtscrap == 'N')
						{

							$getRmAvailStock = $this->GetQueryModel->getRmAvailStock($rm_id);
                          
							foreach ($getRmAvailStock as $key => $value) 
							{
								 $mast_rmrcir_id = $value['mast_id'];
								 $det_rmrcir_id  = $value['det_id'];

							 	$qty = ($issue_qty  > $value['max_qty']) ? $value['max_qty'] : $issue_qty;
								
								$UpdateDate = array(
									'rm_id' 			=> $rm_id,
									'issue_qty' 		=> $qty,
									'mast_rmrcir_id' 	=> $mast_rmrcir_id,
									'prod_plan_id'      => $prod_plan_id,
									'year' 	            => $_SESSION['current_year'],
									'doc_year' 	        => $value['doc_year'],
									'tran_date'         =>  $this->input->post('txtDate'),
									'det_rmrcir_id' 	=> $det_rmrcir_id,
									'branch_id' 		=> $_SESSION['branch_id'],
            	                    'move_from'             => "B".$_SESSION['branch_id'],
                    				'move_to'               => "B".$_SESSION['branch_id'],									
									'created_by' 		=> $_SESSION['id'],
									'updated_by' 		=> $_SESSION['id'],
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                    'created_on' 		=> date("Y-m-d H:i:s"),
									'issue_doc_id' 		=> $issue_doc_id,
									'issue_doc_type' 	=> 'tran_dpr',
								);

							   $result16 = $this->db->insert('tran_rmrcir_stock',$UpdateDate);
							    $query = $this->db->query("update tran_dpr_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$det_rmrcir_id."',concat(det_rmrcir_id,',','".$det_rmrcir_id."')) where mast_dpr_id='$issue_doc_id'");
	                            $data = $this->db->affected_rows();

								$issue_qty = $issue_qty - $qty;

								if($issue_qty <= 0) break;

							}
						
						}
					//}

						// ----------------------------------------
							// Scrap insert
                            $date = $this->input->post('txtDate');
							$UpdateDateg = array(
							    'prod_plan_id'       =>$prod_plan_id,
								'rm_id' 			=> $rm_id,
								'date'              =>$date,
								'year' 				=> $_SESSION['current_year'],
								'branch_id' 		=> $_SESSION['branch_id'],
								'received_qty' 		=> ($scrap_qty_normal > 0) ? $scrap_qty_normal : $scrap_qty_ss,
								'received_doc_type' => 'tran_dpr',
								'received_doc_id' 	=> $issue_doc_id,
								'type' 				=> ($scrap_qty_normal > 0) ? 'NORMAL' : "SS",
								'created_by' 		=> $_SESSION['id'],
                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                'created_on' 		=> date("Y-m-d H:i:s")
							);
							 $result16 = $this->db->insert('scrap_stock',$UpdateDateg);
							 
							 
							 /****added by shraddha on 03-12-2024******/
							 $received_qty 	 = round($scrap_qty * $scrap_ratio,3);
							 $Updatescrapqty = array(
							    'prod_plan_id'       => 0,
								'rm_id' 			=> $rm_id,
								'date'              =>$date,
								'year' 				=> $_SESSION['current_year'],
								'branch_id' 		=> $_SESSION['branch_id'],
								'received_qty' 		=> $received_qty ,
								'received_doc_type' => 'tran_dpr',
								'received_doc_id' 	=> $issue_doc_id,
								'type' 				=> ($scrap_qty_normal > 0) ? 'NORMAL' : "SS",
								'created_by' 		=> $_SESSION['id'],
                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                'created_on' 		=> date("Y-m-d H:i:s")
							);
							//echo '((((((((((((';
							//print_r($Updatescrapqty);
							 $result16 = $this->db->insert('scrap_stock',$Updatescrapqty);
    			

						}else{ //rmConsumption No
						echo "rmConsumption No";
						//$getAssemblyPartID= $this->GetQueryModel->getAssemblyPart($part_id,$opId);
					     //$part_id=($getAssemblyPartID)?$getAssemblyPartID:$part_id;
					     
				    	$updatePartOpStock = $this->GetQueryModel->updatePartOpStock($part_id,$opId); 
                        $dpr_qty=$totalqty;
                        echo "11111";
                         $getAssemblyPartID= $this->GetQueryModel->getAssemblyPart($part_id,$opId);
					     $part_id=($getAssemblyPartID)?$getAssemblyPartID:$part_id;
						if(!empty($updatePartOpStock))
						{
						       echo "22222";
						       $det_rmrcir_id='';
							foreach ($updatePartOpStock as $key => $value) 
							{
							       echo "33333";
								$id 	                = $value['id'];
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id 	                = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$mast_partsrcir_id 	    = $value['mast_partsrcir_id'];
                            	$available_qty   	    = $value['max_qty'];
                            	$det_rmrcir_id          = $det_rmrcir_id.",".$value['det_rmrcir_id'];
                            	echo "--Available--".$available_qty;
						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
								if($doc == "dpr")
								{  
								       echo "44444";
							    	$UpdateDate67 = array(
        									'part_id' 			=> $part_id,
        									'operation_id' 		=> $op_id,
        									'prod_plan_id'       =>$prod_plan_id,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=>  $_SESSION['current_year'],
        						            'doc_year' 			=>  $_SESSION['current_year'],
        						            'tran_date'         =>  $this->input->post('txtDate'),
        									'issue_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $_SESSION['branch_id'],
                    	                    'move_from'         => "B".$_SESSION['branch_id'],
                            				'move_to'           => "B".$_SESSION['branch_id'],        									
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
        									'issue_doc_id' 		=> $issue_doc_id,
        									'issue_doc_type' 	=> 'tran_dpr',
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
                                            'created_on' 		=> date("Y-m-d H:i:s")
								    );
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									
									
								}else{
								       echo "55555";
								       
								    $UpdateDate67 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'prod_plan_id'          => $prod_plan_id,
        									'det_partsrcir_id' 	    => $mast_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        						            'tran_date'         =>  $this->input->post('txtDate'),
        									'issue_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
                    	                    'move_from'             => "B".$_SESSION['branch_id'],
                            				'move_to'               => "B".$_SESSION['branch_id'],        									
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'issue_doc_id' 		    => $issue_doc_id,
        									'issue_doc_type' 	    => 'tran_dpr',
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
                                            'created_on' 		=> date("Y-m-d H:i:s")
								    );
								    
									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
								}

							 $used_qty =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
                                 $dpr_qty =$dpr_qty - $used_qty;
                                if ($dpr_qty<=0)
                                {break;}
							
							} //updatePartOpStock foreach End
                           
                                $query = $this->db->query("update tran_dpr_stock set det_rmrcir_id=if(isnull(det_rmrcir_id),'".$det_rmrcir_id."',concat(det_rmrcir_id,',','".$det_rmrcir_id."')) where mast_dpr_id='$issue_doc_id'");
	                            $data = $this->db->affected_rows();
                           
						 } //updatePartOpStock id

					} //rmConsumption No else end
   			  	}
			   		
			   }
			   
			   
			public function deleteDPR(){
			    $id = $_POST['id'];
			    $query1="Update scrap_stock set issue_qty = 0 where issue_doc_id=$id and issue_doc_type='tran_dpr'";
			    $this->db->query($query1);
			    
			    $query2="Update scrap_stock set received_qty = 0 where received_doc_id=$id and received_doc_type='tran_dpr'";
			    $this->db->query($query2);
			    //tran_rmrcir_stock
			    $query3="Update tran_rmrcir_stock set issue_qty = 0 where issue_doc_id=$id and issue_doc_type='tran_dpr'";
			    $this->db->query($query3);
			    
			    //tran_partrcir_stock
			    $query4="Update tran_partsrcir_stock set issue_qty = 0 where issue_doc_id=$id and issue_doc_type='tran_dpr'";
			     $this->db->query($query4);
			    
			    //tran_dpr_stock
			     $query5="Update tran_dpr_stock set issue_qty = 0 where issue_doc_id=$id and issue_doc_type='tran_dpr'";
			      $this->db->query($query5);
			      
			     $query6="Update tran_dpr_stock set received_qty = 0 where received_doc_id=$id and received_doc_type='tran_dpr'";
			       $this->db->query($query6);
			     
			    //tran_dpr
			     $query7="Update tran_dpr set qty = 0, isdeleted = 1 where id=$id ";
			     $this->db->query($query7);
			     $delete_remark = $_POST['delete_remark'];
			     $prev_remark = $_POST['prev_remark'];
    			 if($delete_remark!=''){
    			     $remark = '';
    			    if($prev_remark!=''){ $remark = $prev_remark.' - '; }
        			   $remark = $remark.'DELREM - '.$delete_remark;
        			   $query8="Update tran_dpr set remarks ='".$remark."' where id=$id ";
    			       $this->db->query($query8);
    			    }
			    }   
			}