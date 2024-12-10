<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ScheduleController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Schedule/ScheduleModel');
		$this->load->model('getQuery/getQueryModel');
		$this->load->model('Supplier/SupplierModel');
	}


	public function schedule()
	{
	    error_reporting(E_ALL);
		//$this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		$data['getSchedule'] 	= $this->getQueryModel->getScheduleByCustIdDate();
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$data['formSubmitFlag'] 		= 1;
		$this->load->view('Schedule/viewSchedule',$data);
		}
		else
		{

		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$this->load->view('Schedule/viewSchedule',$data);
		}
	}
	
	public function addSchedule()
	{
		$id 						= base64_decode($_GET['ID']);
		$data['getSchedule'] 		= $this->getQueryModel->getScheduleById($id);
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$this->load->view('Schedule/addSchedule',$data);
	}
	public function addProdPlanningNew()
	{
	 //error_reporting(E_ALL);
	
		if(!empty($_POST['checkboxVal']))
		{
		   //echo "<pre>"; print_r($_POST);echo "</pre>";
			foreach ($_POST['checkboxVal'] as $key => $value) 
			{   echo "HELLO4<br>";
				$keys =  array_search($value,$_POST['scheduleId'],true);

echo "Keys:-".$keys;

				$usStock 		= $_POST['usStock'][$keys];
				$planning_qty   = $_POST['planning_qty'][$keys];
				$location   	= $_POST['location'][$keys];
				$op_id   		= $_POST['op_id'][$keys];
				$scheduleId   	= $_POST['scheduleId'][$keys];
				$reqQty   		= $_POST['reqQty'][$keys];
				$scheduled_qt   = $_POST['scheduled_qty'][$keys];
				$CurrentStock   = $_POST['CurrentStock'][$keys];
				$ActiveStock   	= $_POST['ActiveStock'][$keys];
				$partId   		= $_POST['partId'][$keys];
				$partno   		= $_POST['partno'][$keys];
				$toDate   		= $_POST['toDate'][$keys];
             
				$booked_qty = ($usStock == 'NO') ? '' : (($ActiveStock>$scheduled_qt)?$scheduled_qt: $ActiveStock);
				
				$branch_id   = ($op_id == 1 || $op_id == 2) ? $_POST['location'][$keys] : "";
				$supplier_id = ($op_id == 3) ? $_POST['location'][$keys] : "";
 // echo "OPeration ID".$op_id."   BranchID".$branch_id."  LOcation-".$_POST['location'][$keys];exit;
				$postDate5 = array(
											'year' => $_SESSION['current_year'],
											'date' => $toDate,
											'op_id' => $op_id,
											'schedule_id' => $scheduleId,
											'supplier_id' => ($planning_qty == 0) ? "" : $supplier_id,
											'branch_id' =>  ($planning_qty == 0) ? $_SESSION['branch_id'] : $branch_id,
											'planning_qty' => $planning_qty,
											'booked_qty' => $booked_qty,
											'part_id' 	=> $partId,
											// 'prod_type' => $totalqty[$keys],
											'created_by ' => $_SESSION['id'],
											'updated_by ' => $_SESSION['id'],
											// 'created_on ' => date("Y-m-d"),
											// 'updated_on ' => date("Y-m-d"),
								);
	            $result1 = $this->db->insert('tran_prod_planning',$postDate5);

				$last_id = $this->db->insert_id();
			//	echo "last_ID  : ".$last_id;die;
				
				if($planning_qty != 0 || ($booked_qty != 0 && $booked_qty !=''))
				{
				    
				    // tran_prod_planning Insert
					//update date,schedule id,partid
				

					if($op_id == 3)
					{
					    
					    

						$postDate6 = array(
											'prod_plan_id'   => $last_id,
											// 'branch_id'  => $branch_id,
											'supplier_id'   => $supplier_id,
											'year'          => $_SESSION['current_year'],
											'part_id'       => $partId,
											'plan_req_qty'  => $planning_qty,
											'branch_id'     => $branch_id,
											'supplier_id'   => $supplier_id,
                                            'date'          => $toDate, 
											'created_by'    => $_SESSION['id'],
											'updated_by'    => $_SESSION['id'] 
											
										);
						//last update id in proudplanid
						$result2 = $this->db->insert('tran_requisition',$postDate6);
					}

					//tran_partsgrr_details iadd
					if($booked_qty > 0)
					{
					    
                        //for final stock booking
						$updatePartOpStock = $this->getQueryModel->getPartOperationStockNoBranch($partId,47); 
                        $dpr_qty=$booked_qty;
            
						if(!empty($updatePartOpStock))
						{
                    echo "HELLO5";
							foreach ($updatePartOpStock as $key => $value) 
							{
								
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id1 	                = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$det_id 	           = $value['det_id'];
                            	$available_qty   	    = $value['max_qty'];
						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
								if($doc == "dpr")
								{   
							    	$UpdateDate67 = array(
        									'part_id' 			=> $partId,
        									'operation_id' 		=> $op_id1,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=>  $_SESSION['current_year'],
        						            'doc_year' 			=>  $_SESSION['current_year'],
        									'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        							    	//'issue_qty' 		=> ($dpr_qty != "") ? $dpr_qty : 0,
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $_SESSION['branch_id'],
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
        									'booked_doc_id' 		=> $last_id,
        									'booked_doc_type' 	=> 'prod_plan',
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
                                            'created_on' 		=> date("Y-m-d H:i:s")
								    );
								   
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									
								}else{
								    
								    $UpdateDate67 = array(
        									'part_id' 			    => $partId,
        									'op_id' 		        => $op_id1,
        									'mast_partsrcir_id' 	=> $mast_id,
        									'det_partsrcir_id' 	    => $det_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        									'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'booked_doc_id' 		    => $last_id,
        									'booked_doc_type' 	    => 'prod_plan',
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

						 } //updatePartOpStock id
					
					if($dpr_qty>0){
					
					    //for Inprocess stock booking
						$updatePartOpStock = $this->getQueryModel->getPartOperationStockNoBranch($partId,1);
                        
						if(!empty($updatePartOpStock))
						{
                          echo "HELLO6<br><pre>";print_r($updatePartOpStock);echo "</pre>";
							foreach ($updatePartOpStock as $key => $value) 
							{
							    echo "<br>DPR QTY:".$dpr_qty;
							
								$date 	                = $value['date'];
								$doc 	                = $value['doc'];
								$op_id_booked 	        = $value['op_id'];
								$mast_id 	            = $value['mast_id'];
								$det_id 	            = $value['det_id'];
							
                            	$available_qty   	    = $value['max_qty'];
						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
								if($doc == "dpr")
								{   
							    	$UpdateDate67 = array(
        									'part_id' 			=> $partId,
        									'operation_id' 		=> $op_id_booked,
        									'mast_dpr_id' 	    => $mast_id,
        						            'year' 				=>  $_SESSION['current_year'],
        						            'doc_year' 			=>  $_SESSION['current_year'],
        									'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        							    	//'issue_qty' 		=> ($dpr_qty != "") ? $dpr_qty : 0,
        									'year' 				=> $_SESSION['current_year'],
        									'branch_id' 		=> $_SESSION['branch_id'],
        									'created_by' 		=> $_SESSION['id'],
        									'updated_by' 		=> $_SESSION['id'],
        									'booked_doc_id' 	=> $last_id,
        									'booked_doc_type' 	=> 'prod_plan',
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
                                            'created_on' 		=> date("Y-m-d H:i:s")
								    );
								
									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
									
									
								}else{
								    
								    $UpdateDate67 = array(
        									'part_id' 			    => $partId,
        									'op_id' 		        => $op_id_booked,
        									'mast_partsrcir_id' 	=> $mast_id,
        									'det_partsrcir_id' 	    => $det_id,
        						            'year' 				    =>  $_SESSION['current_year'],
        						            'doc_year' 			    =>  $_SESSION['current_year'],
        									'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
        									'year' 				    => $_SESSION['current_year'],
        									'branch_id' 	    	=> $_SESSION['branch_id'],
        									'created_by' 		    => $_SESSION['id'],
        									'updated_by' 		    => $_SESSION['id'],
        									'booked_doc_id' 		    => $last_id,
        									'booked_doc_type' 	    => 'prod_plan',
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

						 } //updatePartOpStock id
					}//if(inprocess_qty>0)
				
			} //end of if($booked_qty > 0)
					

					if(($op_id == 1 || $op_id == 2 ) && $planning_qty > 0)
					{
					echo "hello1";
					
						$getrawMaterialById = $this->getQueryModel->getrawMaterialById($partId);
						if(!empty($getrawMaterialById) && !empty($getrawMaterialById[0]['rm_id'])){
						foreach ($getrawMaterialById as $key => $value) 
						{
							$req_rmqty = (($planning_qty * $value['grossweight']) / 1000); 
							echo "<br>req_rmqty  = ".$req_rmqty;
                       
							// ---------------------------------------------

							$getTranRmgrrAvailQty  = $this->getQueryModel->getTranRmgrrAvailQty($value['rm_id'],$_SESSION['current_year']);

                            echo "<pre>";print_r($getTranRmgrrAvailQty);echo "</pre>";
                            
                            
									if(!empty($getTranRmgrrAvailQty))
									{
									   echo "Hello2";
										$bal_qty_rm = $req_rmqty;
										
										foreach ($getTranRmgrrAvailQty as $key => $value7) 
										{
											if($bal_qty_rm >= $value7['available_qty'])
											{
											    
                                                $TranRmrcirDate = array(
                                                    'booked_qty'      => $value7['available_qty'],
                                                    'booked_doc_type' => 'prod_plan',
                                                    'booked_doc_id'   => $last_id,
                                                    'mast_rmrcir_id'  => $value7['mast_rmrcir_id'],
                                                    'det_rmrcir_id'   => $value7['det_rmrcir_id'],
                                                    'branch_id'       => $_SESSION['branch_id'],
                                                    'year'            => $_SESSION['current_year'],
                                                    'doc_year'        => $_SESSION['current_year'],
                                                    'created_on'      => date("Y-m-d H:i:s"),
                                                    'created_by'      => $_SESSION['id'],
                                                    'rm_id'        => $value['rm_id'],
                                                    );
										 $this->ScheduleModel->insertTranRmrcirStock($TranRmrcirDate);
										 //$sql = "Update tran_rmrcir_stock set booked_qty =  ".$value7['available_qty']." ,booked_doc_type='prod_plan',booked_doc_id = '$last_id'  where id = ".$value7['id'];    
											
											//$query = $this->db->query($sql);

											$bal_qty_rm = ($bal_qty_rm - $value7['available_qty']);

											}
											else if($bal_qty_rm < $value7['available_qty'])
											{
												$TranRmrcirDate = array(
                                                    'booked_qty'      => $bal_qty_rm,
                                                    'booked_doc_type' => 'prod_plan',
                                                    'booked_doc_id'   => $last_id,
                                                    'mast_rmrcir_id'  => $value7['mast_rmrcir_id'],
                                                    'det_rmrcir_id'   => $value7['det_rmrcir_id'],
                                                    'branch_id'       => $_SESSION['branch_id'],
                                                    'year'            => $_SESSION['current_year'],
                                                    'doc_year'        => $_SESSION['current_year'],
                                                    'created_on'      => date("Y-m-d H:i:s"),
                                                    'created_by'      => $_SESSION['id'],
                                                    'rm_id'        => $value['rm_id'],
                                                    );
										 $this->ScheduleModel->insertTranRmrcirStock($TranRmrcirDate);
										 //$sql2 = "Update tran_rmrcir_stock set booked_qty ='$bal_qty_rm' ,booked_doc_type='prod_plan',booked_doc_id = '$last_id'  where id = ".$value7['id'];    
											
												//$query = $this->db->query($sql2);

												$bal_qty_rm = 0;
											}

											if($bal_qty_rm == 0) break;
										}

										if($bal_qty_rm > 0 )
										{
										    
											$reqDate = array(
												'prod_plan_id' 	=> $last_id,
												'year' 			=> $_SESSION['current_year'],
												'date'          => $toDate,
												'rm_id' 		=> $value['rm_id'],
												'plan_req_qty' 	=> $bal_qty_rm,
												'branch_id'=>   $branch_id,
											    'supplier_id' => $supplier_id,
											    'created_by ' => $_SESSION['id'],
											    'updated_by ' => $_SESSION['id'],
										
											);

   
											$result=$this->db->insert('tran_requisition',$reqDate);
											$insert_id = $this->db->insert_id();
										}

									}else{
									      echo "Hello3";
									    $bal_qty_rm = $req_rmqty;
									    
								    	if($bal_qty_rm > 0 )
										{
											$reqDate = array(
												'prod_plan_id' 	=> $last_id,
												'year' 			=> $_SESSION['current_year'],
												'rm_id' 		=> $value['rm_id'],
												'plan_req_qty' 	=> $bal_qty_rm,
												'date'          => $toDate,
												'branch_id'=>   $branch_id,
											    'supplier_id' => $supplier_id,
											    'created_by ' => $_SESSION['id'],
											    'updated_by ' => $_SESSION['id']
											);


											$result=$this->db->insert('tran_requisition',$reqDate);
											$insert_id = $this->db->insert_id();
										}
									}
								
									
							// ---------------------------------------------

						}
					}

					}

				}

			} //end foreach
             
		} // post end
	

		
		redirect(base_url('schedulePlanning'));	
	}

	public function createSchedule()
	{
	    
	     $this->session->unset_userdata('createS');
		//print_r($_SESSION);die;
	    //$this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'month', 'trim|required');
		if (empty($_FILES['schedule_file']['name']))
        {
		$this->form_validation->set_rules('schedule_file', 'file', 'trim|required');
	    }
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			//print_r($_SESSION);die;

			$ScreenCustomerId 	=$this->input->post('Customer_Id');
			$scheduleDate 		=$this->input->post('schedule_date');
			$Sdate 				= date("m-Y",strtotime($scheduleDate));

			$fromDate 			=date("Y-m-01", strtotime($scheduleDate));
			$toDate 			=date("Y-m-t", strtotime($scheduleDate)); 

			 $ext = strtolower(end(explode('.', $_FILES['schedule_file']['name'])));
			 $tmpName = $_FILES['schedule_file']['tmp_name'];

			 if($ext === 'csv')
			 {
        		if(($handle = fopen($tmpName, 'r')) !== FALSE) 
    			{
        				set_time_limit(0);
        				$row = 0;
        				$msg1='';
        				while(($data = fgetcsv($handle, 1000, ',')) !== FALSE)
        				 {
        				 	if($row==0)
        				 	{
        				 		$row++;
        				 		continue;
        				 	}
        				 	
        					$col_count = count($data);
        					//echo "<pre>";print_r($res1);die;
        					 $date 			= date("m-Y",strtotime($toDate));
        					$Partno		=trim($data[0]);
        					$scheduled_qty	=trim($data[1]);

        					$res1 			= $this->getQueryModel->getPartBypartno($Partno);
        					//echo "<pre>";print_r($res1);die;
        					$excPartId 		=$res1['part_id'];
        					

        					 if($Sdate!=$date)
        					 {
        					 	$msg1=$msg1.'Invalid date - '.$date.'<br>';

        					 	
        					 }
        					 if($excPartId=='')
        					 {
        					 	$msg1=$msg1.'Invalid Part No./ Part no not found - '.$Partno.'<br>';

        					 	
        					 }
        					 $checkSchqty=$this->getQueryModel->getSchAvailableQty($excPartId,$ScreenCustomerId);
        					 // print_r($checkSchqty);die;
        					 if(!empty($checkSchqty['available_qty'])){
        					    if($scheduled_qty > $checkSchqty['available_qty']){
        					       $msg1=$msg1.'Schedule Qty('.$scheduled_qty.') is more than Available Quantity('.$checkSchqty["available_qty"].') for Part No - '.$Partno.'<br>'; 
        					    }
        					 }
        					 $res2 	= $this->getQueryModel->getCustomersbyid($ScreenCustomerId);
        					 
        					 $res3 	= $this->getQueryModel->getOAbypartNoCust($ScreenCustomerId,$excPartId,$_SESSION['current_year']);
        					 $oaResult=sizeof($res3);
        					 //print_r($res3);die;
        					 //$mast_oa_id=$res3['mast_oa_id'];
        					  $oa2_id=$res3[0]['id'];

        					 if($oaResult==0)
        					 {
        					 	$msg1=$msg1.'OA record not found.'.$res2['name'].'- '.$Partno.'<br>';
        					 }
                              $sch_plan_flag=0;
                              $schedule_msg		= $this->getQueryModel->getSchedulePartMonth($excPartId,$toDate);
        					  if (strlen($schedule_msg) >10)
                                 {
        					 	//$msg1=$msg1.$schedule_msg.'<br>';
        					 	$sch_plan_flag =1;
        					 }

        					if($msg1=='')
        					{
        					    
        					    $data		= $this->getQueryModel->getSchedulePartMonth($excPartId,$toDate);
        					   //if ($schedule_msg >0 and is_numeric($schedule_msg) )
        					   /*if ($sch_plan_flag==0)
        					    {
        					                					    
        						$updateDate = array(
									'scheduled_qty' 	=> $scheduled_qty,
									'updated_by ' 		=> $_SESSION['id'],
									'updated_on ' 		=> date("Y-m-d h:i:s"),
									);
						        	$result=$this->ScheduleModel->UpdateTranSchedule($updateDate,$schedule_msg);	

        					    }
        					    else
        					    {*/
        					    
                					    
                						$postDate = array(
        									'company_id' 		=> $_SESSION['id'],
        									'year' 				=> $_SESSION['current_year'],
        									'oa2_id' 			=> $oa2_id,
        									'part_id'			=> $excPartId,
        									'customer_id' 		=> $ScreenCustomerId,
        									'from_date' 		=> $fromDate,
        									'to_date' 		    => $toDate,
        									'scheduled_qty' 	=> $scheduled_qty,
        									'created_by ' 		=> $_SESSION['id'],
        									'created_on ' 		=> date("Y-m-d H:i:s"),
        									);
        							$result=$this->ScheduleModel->AddTranSchedule($postDate);	
                                //}
                            }
        					


        				}

        				if($msg1!='')
        				{
        					$this->session->set_flashdata('errorMsg', $msg1);
        					 redirect('/addSchedule');

        				}
        			}


        			


        	 }
        	 $this->session->set_flashdata('createS', 'You have added schedule successfully.');
        	redirect('/schedule'); 
		    
		}else
		 {
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			$this->load->view('Schedule/addSchedule',$data);
		}
		
	}


   /*--------------------schedule Planning------------------------*/

	public function schedulePlanning()
	{
		//$data['getSchedulePlanning'] 	= $this->getQueryModel->getSchedulePlanning();
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$this->load->view('Schedule/viewSchedulePlanning',$data);
	}
	public function createSchedulePlanning()
	{
	 
	 	$this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) 
		{   //error_reporting(E_ALL);
		   // echo "if";
			$ScreenCustomerId 	=$this->input->post('Customer_Id');

			$data['getCustName'] 			= $this->getQueryModel->getCustName();
			$getSchedulePlanning 	= $this->getQueryModel->getSchedulePlanning();
		
	     	//	print_r($getSchedulePlanning);
	     	//	exit;
	        $data1 = [];	
	        
			foreach($getSchedulePlanning as $value)
			{
			    //echo "****Part ID:".$value['part_id'];
			 /*   $getInprocessQty        = $this->getQueryModel->getAllstageQty($value['part_id']);
			    
			    $getFinalStageQty       = $this->getQueryModel->getAllstageQty($value['part_id'],47);
			    */
			   
			    //getPartOperationStockNoBranch
			    //echo "   Inprocess ";
			  
			    $getInprocessQty        = $this->getQueryModel->getPartOperationStockNoBranch($value['part_id'],1);
			   // echo " Final  ";
			   $getFinalStageQty       = $this->getQueryModel->getPartOperationStockNoBranch($value['part_id'],47);
			  //echo "   1111";
			    $data1[] = array(

    			        "id"            =>$value['id'],
    			        "part_id"       => $value['part_id'],
    			        "to_date"       =>$value['to_date'],
    			        "scheduled_qty" =>$value['scheduled_qty'],
    			        "customer_id"   =>$value['customer_id'],
    			        "FinalStock"    => $getFinalStageQty,
    			        "InprocessQty"  =>$getInprocessQty

			        );
               
			}

		    
    			$data['getSchedulePlanning'] = $data1;
			
			$data['formSubmitFlag'] 	    = 1;
		
			$this->load->view('Schedule/viewSchedulePlanning',$data);
			
		}else
		 {
	
		    
			$data['getCustName'] 			= $this->getQueryModel->getCustName();
		//	$data['getSchedulePlanning'] 	= $this->getQueryModel->getSchedulePlanning();
			$this->load->view('Schedule/viewSchedulePlanning',$data);
		}
		
	}

	public function schedulePlanning1()
	{
		//echo "<pre>";print_r($_POST);
		$partId 	=$_POST['partId'];
		$scheduleId =$_POST['scheduleId'];
		$toDate 	=$_POST['toDate'];
		$data['getBranch'] 		= $this->getQueryModel->getBranch();
		$data['getBS'] 			= $this->getQueryModel->getBS($scheduleId,'RS',$_SESSION['branch_id'],$toDate);
		$data['getIP']			= $this->getQueryModel->getIP($scheduleId,'IP');
		$this->load->view('Schedule/addschedulePlanning',$data);
	}

	public function getRMForPlanning()
	{
		
		$partId 	 			=$_POST['partId'];
		$branch_id   			=$_POST['branch_id'];
		$PlanningQty 			=$_POST['PlanningQty'];
		$scheduleId 			=$_POST['scheduleId'];
		$toDate 				=$_POST['toDate'];
		$type 					=$_POST['type'];
		$getrawMaterialById 	= $this->getQueryModel->getrawMaterialByPartId($partId);
		$data['getBranch'] 		= $this->getQueryModel->getBranch();
		$getIP			= $this->getQueryModel->getBS($scheduleId,'IP',$branch_id,$toDate);
		
		if($type==1)
		{

			echo $PlanningQty=$getIP['planning_qty'];
		}else
		{
			echo $PlanningQty=$PlanningQty;
		}
				
		echo '<table  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>RM Id</th>
                                        <th>RM Name</th>
                                        <th>Required Qty (KGS)</th>
                                        <th>Current Stock (KGS)</th>
                                        <th>Reorder Quantity (KGS)</th>
                                        <th>Active Stock (KGS)</th>
                                        <th>Requisition Qty (KGS)</th>
                                       
                                    </tr>
                                </thead>';
                                //echo "<pre>";print_r($_POST);
                                 foreach($getrawMaterialById as $row){ 
                                 	
									$RMdata	= $this->getQueryModel->getrmById($row['rm_id']);
									$ob=0;
									$receipt=0;
									$issue=0;
									$reserve_qty=0;
									if($branch_id!='')
									{
										$RMStock= $this->getQueryModel->getRMStock($branch_id,$row['rm_id']);

										$ob          =$RMStock['ob'];
	                                    $receipt     =$RMStock['receipt'];
	                                    $issue       =$RMStock['issue'];
	                                    $reserve_qty =$RMStock['reserve_qty'];

									}
									$CurrentStock =($ob+$receipt)-($issue+$reserve_qty);
                                    //echo $PlanningQty;
                                    if($PlanningQty=='')
                                    {
                                    	//$RequiredQty=$row['grossweight'];
                                    	$RequiredQty=0;
                                    }else
                                    {
                                    	$RequiredQty=($row['grossweight']*$PlanningQty)/1000;
                                    }
                                    //echo $row['grossweight'].'<br>'.$PlanningQty;die;
                                    $ActiveStock =($CurrentStock)-($RMdata['reorderQty']);
                                    $Requisition =($RequiredQty)-($ActiveStock);
                                    if($Requisition < 0)
                                    {
                                    	$Requisition =0;
                                    }
                                    
                                   echo "<input type='hidden' name='rmId' value='$row[rm_id]'>";
                                   echo "<input type='hidden' name='RequiredQty' value='$RequiredQty'>";
                                   echo "<input type='hidden' name='CurrentStock' value='$CurrentStock'>";
                                   echo "<input type='hidden' name='reorderQty' value='$RMdata[reorderQty]'>";
                                   echo "<input type='hidden' name='ActiveStock' value='$ActiveStock'>";
                                   echo "<input type='hidden' name='Requisition' value='$Requisition'>";
                               echo "<tr> 

                                <td>".$row['rm_id']."</td>
                                <td>".$RMdata['name']."</td>
                                <td>".$RequiredQty.' ('.$row['grossweight'].' - GMS)'."</td>
                                <td>".$CurrentStock."</td>
                                <td>".$RMdata['reorderQty']."</td>
                                <td>".$ActiveStock."</td>
                                <td>".$Requisition."</td>

                               </tr>";
                               }
                                echo "</table> ";
				//$this->load->view('Schedule/addschedulePlanning',$data);

	}

	public function createInhouseProduction()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_rules('IP_planning_qty', 'planning qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$planningQty 	=$this->input->post('IP_planning_qty');
			$branchId 		=$this->input->post('branch_id');
			$rm_id 			=$this->input->post('rmId');
			$ActiveStock 	=$this->input->post('ActiveStock');
			$Requisition 	=$this->input->post('Requisition');
			$toDate 		=$this->input->post('toDate');
			$schedule_id 	=$this->input->post('scheduleId');


			$RMStock 			=$this->getQueryModel->getRMStock($branchId,$rm_id);
			$reserve_qtys 	=$RMStock['reserve_qty'];
			$reserve_qty 	=$ActiveStock+$reserve_qtys;


			 $countPPs=$this->ScheduleModel->countProdPlanning($toDate,$schedule_id,$_SESSION['current_year'],'IP',$branchId);
			 $countPP=sizeof($countPPs);

			if($countPP==0)
			{
				$postDate = array(
					'year' 				=> $_SESSION['current_year'],
					'date' 				=> $toDate,
					'schedule_id' 		=> $schedule_id,
					'branch_id' 		=> $branchId,
					'planning_qty' 		=> $planningQty,
					'reserve_qty' 		=> $reserve_qty,
					'prod_type' 		=> 'IP',
					);
				$prod_plan_id 	=$this->ScheduleModel->AddTranProdPlanning($postDate);
				

				$updateDate = array(
						'reserve_qty' 		=> $reserve_qty,
						'prod_plan_id' 		=> $prod_plan_id,
						);

				$res1 =$this->ScheduleModel->updateRMStock($updateDate,$rm_id);

				if($Requisition > 0)
				{
					$reqDate = array(
						'prod_plan_id' 	=> $prod_plan_id,
						'year' 			=> $_SESSION['current_year'],
						'rm_id' 		=> $rm_id,
						'plan_req_qty' 	=> $Requisition,
						);

				$res2 =$this->ScheduleModel->AddtranRequisition($reqDate);
				}
			}else
			{
				$reserveQtys 	=$RMStock['reserve_qty'];
				$oldPlanningQty =$this->input->post('oldPlanningQty');
				$reserveQty	=$reserveQtys-$oldPlanningQty;
				$planningQtys=$planningQty+$reserveQty;
				$updatepostDate = array(
				'planning_qty' 		=> $planningQty,
				);
				//$tppId 			=$this->input->post('tppId');
				 $tppId 			=$countPPs[0]['id'];
				$res2 	=$this->ScheduleModel->updateTranProdPlanning($updatepostDate,$tppId);
				
				$updateDate = array(
					'reserve_qty' 		=> $planningQtys,
					);
			  $res1 =$this->ScheduleModel->updatePartStock($updateDate,$partId,$_SESSION['branch_id']);
			}
			

			$data['getBranch'] 	= $this->getQueryModel->getBranch();
			$this->load->view('Schedule/addschedulePlanning',$data);
			
		}else
		 {
			$data['getBranch'] 	= $this->getQueryModel->getBranch();
			$this->load->view('Schedule/addschedulePlanning',$data);
		}
	}

	public function createReserveStock()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->form_validation->set_rules('RS_planning_qty', 'planning qty', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$planningQty 	=$this->input->post('RS_planning_qty');
			$toDate 		=$this->input->post('toDate');
			$schedule_id 	=$this->input->post('schedule_id');
			$year 			= $_SESSION['current_year'];

			
			$ActiveStock 		=$this->input->post('ActiveStock');
			$partId 			=$this->input->post('partId');

			$res 		  =$this->getQueryModel->getPartStock($_SESSION['branch_id'],$partId);
			$countPP=$this->ScheduleModel->countProdPlanning($toDate,$schedule_id,$year,'RS');
			if($countPP==0)
			{
				$postDate = array(
					'year' 				=> $year,
					'date' 				=> $toDate,
					'schedule_id' 		=> $schedule_id,
					'branch_id' 		=> 1,
					'planning_qty' 		=> $planningQty,
					'prod_type' 		=> 'RS',
					);

				$prod_plan_id =$this->ScheduleModel->AddTranProdPlanning($postDate);
				$reserve_qtys 	=$res['reserve_qty'];
				$stockProdPlanId=$res['prod_plan_id'];
				$reserve_qty 	=$planningQty+$reserve_qtys;

				$prod_planId=$stockProdPlanId.','.$prod_plan_id;

				$updateDate = array(
						'reserve_qty' 		=> $reserve_qty,
						'prod_plan_id' 		=> $prod_planId,
						);
				  $res1 =$this->ScheduleModel->updatePartStock($updateDate,$partId,$_SESSION['branch_id']);
				}else
				{
					$reserveQtys 	=$res['reserve_qty'];
					$oldPlanningQty =$this->input->post('oldPlanningQty');
					$reserveQty	=$reserveQtys-$oldPlanningQty;
					$planningQtys=$planningQty+$reserveQty;
					$updatepostDate = array(
					'planning_qty' 		=> $planningQty,
					);
					$tppId 			=$this->input->post('tppId');
					$res2 	=$this->ScheduleModel->updateTranProdPlanning($updatepostDate,$tppId);
					
					$updateDate = array(
						'reserve_qty' 		=> $planningQtys,
						);
				  $res1 =$this->ScheduleModel->updatePartStock($updateDate,$partId,$_SESSION['branch_id']);
					

				}
			
			
			

			$data['getBranch'] 	= $this->getQueryModel->getBranch();
		    $this->load->view('Schedule/addschedulePlanning',$data);
			
		}else
		 {
			$data['getBranch'] = $this->getQueryModel->getBranch();
			$this->load->view('Schedule/addschedulePlanning',$data);
		}
	}


	public function addProdPlanning()
	{
		//echo "<pre>";print_r($_POST);
		$planningId  = base64_decode($_GET['ID']);
		$data['getBranch'] = $this->getQueryModel->getBranch();
		if($planningId!='')
		{
		$data['getPP'] 	= $this->getQueryModel->getProdPlanningById($planningId);
		}
		$this->load->view('Schedule/addProdPlanning',$data);
	}
	
	
	



}

?>