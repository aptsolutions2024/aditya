<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class InvoiceController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Invoice/InvoiceModel');
		$this->load->model('getQuery/getQueryModel');
		//$this->load->model('Supplier/SupplierModel');
	}


	public function viewInvoice()
	{
		//$this->form_validation->set_rules('Customer_Id', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

	$data['getCustName'] 		= $this->getQueryModel->getCustName();
		if ($this->form_validation->run() == TRUE) {
	//	$data['getInvDetails'] 	= $this->InvoiceModel->getInvDetails();
    	$data['getInvMast'] 	= $this->getQueryModel->getInvoiceDetailsWithMast();
		}
		$this->load->view('Invoice/viewInvoice',$data);
	}
	
	public function addInvoice()
	{
		$id 						= base64_decode($_GET['ID']);
		$data['getSchedule'] 		= $this->getQueryModel->getScheduleById($id);
		$data['getCustName'] 		= $this->getQueryModel->getCustName();
		$this->load->view('Invoice/addInvoice',$data);
	}
	
	

  public function editInvDetails(){
      
       if(!empty($_GET['ID']))
		{
			$id 						= base64_decode($_GET['ID']);
			$data['getTranInvMast'] 		= $this->getQueryModel->getTranInvMastbyId($id);
			$data['getTranInvDetail'] = $this->getQueryModel->getTranInvDetailsbyId($id);
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			//echo "<pre>";print_r($data);die;
		}

      	$this->load->view('Invoice/editInvDetails',$data);
  }	
  
  public function addInvQCdetails(){
     $this->session->unset_userdata('createS');
	        $mast_inv_id		= $this->input->post('mast_inv_id');
			$invDetIdArr		    = $this->input->post('inv_det_id');
          
        
               //  echo "<pre>";  print_r($_POST);echo "</pre>";die;
             if(!empty($_POST['checkboxValupdate'])) {

                foreach ($_POST['checkboxValupdate'] as $chkey => $chvalue) 
    			{
    			   
    			     $invkey =  array_search($chvalue,$invDetIdArr,true);
    			     $inv_det_id=$invDetIdArr[$invkey];
        			 $qndex ="qualid".$invkey;
        			 $qid = $_POST[$qndex];
        			 $stdval = $this->input->post('stdval'.$invkey);
        			 $minval = $this->input->post('minval'.$invkey);
        			 $maxval = $this->input->post('maxval'.$invkey);
        			 $R1 = $this->input->post('R1'.$invkey);
        			 $R2 = $this->input->post('R2'.$invkey);
        			 $R3 = $this->input->post('R3'.$invkey);
        			 $R4 = $this->input->post('R4'.$invkey);
        			 $R5 = $this->input->post('R5'.$invkey);
        			 $FR = $this->input->post('FR'.$invkey);
        			 $Remark = $this->input->post('Rem'.$invkey);
        			 
    			   
    			 if(!in_array($inv_det_id,$_POST['editID'])){    //Insert New Record 
    			    echo "<br>Insert Record:".$inv_det_id;
			      
        		    foreach($qid as $key => $value){
        		        //echo "<pre>";  print_r($R1[$key]);echo "</pre>";die; 
        			 $data = array(  
        	          'mast_inv_id'=>$mast_inv_id,
        	          'det_inv_id'=>$inv_det_id,
        	          'quality_id'=>$value,
        	          'std_value'=>$stdval[$key],
                      'min_value'=>$minval[$key],
                      'max_value'=>$maxval[$key],
                      'reading1'=>$R1[$key],
                      'reading2'=>$R2[$key],
                      'reading3'=>$R3[$key],
                      'reading4'=>$R4[$key],
                      'reading5'=>$R5[$key],
                      'final_reading'=>$FR[$key],
                      'remark'      =>$Remark[$key]
                      );
                      
                 	$result16 = $this->db->insert('tran_invoice_pdr',$data);
             		$last_inserid = $this->db->insert_id();
                     	
        		    } //end of quality for-loop
		  
    			    }
    			   /* else{
    			         //Update Record tran_invoice_pdr
    			          echo "<br>Update Record".$inv_det_id;
            			     
            			    $editpdr ="editQCPDR".$invkey;
        			        $editQCPDR = $_POST[$editpdr];
                         foreach($qid as $key => $value){
                		       
                			 $Updatedata = array(
                              'reading1'=>$R1[$key],
                              'reading2'=>$R2[$key],
                              'reading3'=>$R3[$key],
                              'reading4'=>$R4[$key],
                              'reading5'=>$R5[$key],
                              'final_reading'=>$FR[$key],
                              'remark'      =>$Remark[$key]
                              );
                             // echo "<br>Update Pdr ID:";
                     		$v = $this->db->where('id',$editQCPDR[$key]);
        					$query = $this->db->update('tran_invoice_pdr',$Updatedata,$v);
                             	
                		    } //end of quality for-loop update
                		    
                		    
    			   }  //end of else for update
    			   */
                    
                }  //end of checkbox foreach
                //die;
     	    $this->session->set_flashdata('createS', 'You have added Invoice QC successfully.');
            redirect('/editInvDetails?ID='. base64_encode($mast_inv_id)); 
            }else{
     	    $this->session->set_flashdata('createS', 'You have not selected any record.');
        	redirect('/viewInvoice');   
            }
              
           
	
  }
  
 
	
public function createInvoice()
	{
	    
	     $this->session->unset_userdata('createS');
	     $this->session->unset_userdata('insuffstock');
	     $this->session->unset_userdata('errorMsg');
	     
	     $this->form_validation->set_rules('Customer_Id', 'Customer_Id', 'trim|required');
	     
		if (empty($_FILES['invoice_file']['name']))
        {
		$this->form_validation->set_rules('invoice_file', 'file', 'trim|required');
	    }
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			//print_r($_SESSION);die;

			$ScreenCustomerId 	=$this->input->post('Customer_Id');
		

			 $ext = strtolower(end(explode('.',$_FILES['invoice_file']['name'])));
			 $tmpName = $_FILES['invoice_file']['tmp_name'];
             $errorMsg='';
             $insuffstock='';

			 if($ext === 'csv')
			 {
        		if(($handle = fopen($tmpName, 'r')) !== FALSE) 
    			{
        				set_time_limit(0);
        				$row = 0;
        				$msg1='';
        				$oaResult='';        		
        				//$excelDataArray=array();
        				
        			    $this->db->query("DROP TEMPORARY TABLE IF EXISTS tab_inv");
        			    
        				$this->db->query("create temporary table tab_inv (date date,invoice_no varchar(20),customer_id int(11),schedule_id int(11),oa_det_id int(11),part_id int(11),qty int(11),prod_plan_id int(11))"); 
        				
        				while(($data = fgetcsv($handle, 1000, ',')) !== FALSE)
        				 {
        				 	if($row==0)
        				 	{
        				 		$row++;
        				 		continue;
        				 	}
        				 	 $col_count = count($data);
        					 $invoice_no	= $data[0];
        					 $customer_id	= $ScreenCustomerId;
        					 $part_no	    = $data[2];
        					 $qty	        = $data[3];
        					 
        					 $Date =	isset($data[1]) ? $data[1] : '';
        					 $originalDate=$data[1];
    			         if($Date !="")
    			    	 {
    			    	     $d=strtotime($Date);
                             $Date = date("Y-m-d", $d);
                             
    			    	 }else{
    			    	    $errorMsg.="<br>".$row.". Date Should be there : ".$originalDate; 
    			    	 }
        			          
								
								$mindate=getMinDate(); //Ex. 2023-04-01
								$maxdate=getMaxDate();  //Ex. 2024-03-31
							
	                             if($Date>=$mindate && $Date<=$maxdate){
	 
	                             }else{
	                                $errorMsg.="<br>".$row.". Date Not Within The Financial Year : ".$originalDate;
	                             }
	                             
        					  $res2 	= $this->getQueryModel->getCustomersbyid($customer_id);
        					  //echo "*********Part No - ". $part_no."******";
        					  $partInfo 	= $this->getQueryModel->getPartBypartno($part_no);
        					  $part_id='';
        					  if($partInfo){
                                 $part_id=$partInfo['part_id'];
        					  }else{
        					  	 $errorMsg.="<br>".$row.". Invalid Part No : ".$part_no;
        					  }
                            //  echo "PART ID - ".$part_id;
        					  $res3 	= $this->getQueryModel->getOAbypartNoCust($customer_id,$part_id,$_SESSION['current_year']);
        					  
        					// echo "OA DETAILS<pre>";print_r($res3);
        					  $oaResult=sizeof($res3);
        					  $oaId=$res3[0]['id'];  

	                            if(empty($oaId)){
	    					  	 	$errorMsg.='<br>'.$row.'. OA record not found. '.$res2['name'].'- Part No '.$part_no;  
	    					    }

        					  if(empty($qty)){
                               $errorMsg.="<br>".$row.". Invalid Quantity : ".$qty;   
        					  }
 
                             
        					  $schDetails 	= $this->getQueryModel->getSchudaleIdByDate($oaId,$Date);
        					  $scResult=sizeof($schDetails);
                                 // echo "SChedule DETAILS<pre>";print_r($schDetails);
        					
        					  if($scResult==0)
        					 {   
        					     
        					 	 	$errorMsg.='<br>'.$row.'. Schedule not found. '.$res2['name'].'- Part No '.$part_no.' - For the Date '.$originalDate.'<br>'; 
        					 	 
        					 
        					 }
        					 $availableQty=0;
        					//$updateBookedQty = $this->getQueryModel->getBookedPartforInvoice($schDetails['prod_plan_id']);
                          // foreach($updateBookedQty as $bookedqty){
                        //      $availableQty=$availableQty+$bookedqty['max_qty'];
                          // }
        					 $updatePartOpStock = $this->getQueryModel->getPackingQty($part_id,$_SESSION['branch_id']);
        					 
        					foreach($updatePartOpStock as $nobranchqty){
                              $availableQty=$availableQty+$nobranchqty['max_qty'];
                             }
                           
        					  if($availableQty<$qty){
        					      //	$errorMsg.='<br>'.$row.'. Insufficient Stock. '.'- Part No '.$part_no.' - For the Date '.$originalDate.'<br>';
        					     $insuffstock.='<br>'.$row.'. Insufficient Stock. '.'- Part No '.$part_no.' - For the Date '.$originalDate;
        					  }
        					  
        					  if( $qty == 0 || $qty <= 0 || $qty == ''){
        					      	$errorMsg.='<br>'.$row.'. Invoice Quantity Should be Greater than 0. '.'- Part No '.$part_no.' - For the Date '.$originalDate.'<br>';
        					  }
        		

                              $excelData = array(
                                'date' 		    => $Date,
                                'invoice_no' 	=> $invoice_no,
                                'customer_id' 	=> $customer_id,
                                'schedule_id' => $schDetails['id'],
                                'oa_det_id'   => $oaId,
                                'part_id' 	  => $part_id,
                                'qty' 	      => $qty,
                                'prod_plan_id'=>$schDetails['prod_plan_id'],
                                );
                          
                           // $excelDataArray[]=$excelData;
                        $this->db->insert('tab_inv',$excelData);
                        $row++;
        				}
                        //echo 	"</br>".$errorMsg;
        				if($errorMsg!='' || $errorMsg)
        				{
        					$this->session->set_flashdata('errorMsg',$errorMsg);
        					 redirect('/addInvoice');
        				}
        				
        			/*	$errorMsg='';
        				$errorMsg = $this->getQueryModel->getInvAvailableQty();
        				if($errorMsg!='')
        				{
        					$this->session->set_flashdata('errorMsg', $errorMsg);
        					 redirect('/addInvoice');
        				
        				}*/
        		
                        $invno = '0';
                        $query = $this->db->query("select * from tab_inv");
                        $excelDataArray=$query->result_array();
                       //echo "<pre>"; print_r($excelDataArray);echo "<pre>";
                if (!empty($excelDataArray)){
                   // echo "\n In IF:::";
                        foreach ($excelDataArray as $mastrec){
                               /*
                               if ($invno != $mastrec['invoice_no'])
                                    {
                                        $invno =$mastrec['invoice_no'];
                                         $postDate = array(
                                                'date' 		    => $mastrec['date'],
                                                'year' 			=>  $_SESSION['current_year'],
                                                'invoice_no' 	=> $mastrec['invoice_no'],
                                                'customer_id' 	=> $mastrec['customer_id'],
                                            );
                                $mast_inv_id = $this->InvoiceModel->AddTranInvoiceMast($postDate);  
                                	}

                                    $postDetailsDate = array(
                                    'mast_inv_id' => $mast_inv_id,
                                    'schedule_id' => $mastrec['schedule_id'],
                                    'oa_det_id'   => $mastrec['oa_det_id'],
                                    'part_id' 	  => $mastrec['part_id'],
                                    'qty' 	      => $mastrec['qty'],
                                    'prod_plan_id'=>$mastrec['prod_plan_id'],
                                    );
                                    if ($mast_inv_id>0) {
                                $det_inv_id = $this->InvoiceModel->AddTranInvoiceDetails($postDetailsDate);}
                                
                                $dpr_qty=$mastrec['qty'];
                                */
                          
                         /*   $updateBookedQty = $this->getQueryModel->getBookedPartforInvoice($mastrec['prod_plan_id']);
                            //For already booked stock while production planning
                            if(!empty($updateBookedQty)){
			    				foreach ($updateBookedQty as $key => $value) {
							            $available_qty   	    = $value['max_qty'];
        							    $invQTY =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
        							    
        								if($doc == "dpr")
        								{   
        						        
        						        $UpdateBooked = array(
                            					    //'id' 	            => $value['id'],
                            						'mast_dpr_id'   	=> $value['mast_id'],
                            						'year' 				=>  $_SESSION['current_year'],
        					                    	'doc_year' 			=>  $_SESSION['current_year'],
        			                                'part_id'           => $mastrec['part_id'],
                    								'operation_id' 	    => '47',
                    								'issue_qty' 		=> $invQTY,
                									'issue_doc_id' 		=> $det_inv_id,
                									'issue_doc_type' 	=> 'invoice',
                									'branch_id'         => $_SESSION['branch_id'],
                									'created_by' 		=> $_SESSION['id'],
                									'updated_by' 		=> $_SESSION['id'],
                                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                                    'created_on' 		=> date("Y-m-d H:i:s")
        								    );
                		   		          $result1 = $this->db->insert('tran_dpr_stock',$UpdateBooked);
        								}    
                                        else{
                                             	$postDate34['mast_partsrcir_id']=$value['mast_partsrcir_id'];
                                          
        								    
        						        $UpdateBooked = array(
                            					  	'mast_partsrcir_id' => $value['mast_partsrcir_id'],
                            						'det_partsrcir_id'  => $value['id'],
                            						'year' 				=>  $_SESSION['current_year'],
        					                    	'doc_year' 			=>  $_SESSION['current_year'],
        			                                'part_id'           => $mastrec['part_id'],
                    								'op_id' 	        => '47',
                    								'issue_qty' 		=> $invQTY,
                									'issue_doc_id' 		=> $det_inv_id,
                									'issue_doc_type' 	=> 'invoice',
                									'branch_id'         => $_SESSION['branch_id'],
                									'created_by' 		=> $_SESSION['id'],
                									'updated_by' 		=> $_SESSION['id'],
                                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                                    'created_on' 		=> date("Y-m-d H:i:s")
        								    );
                		   		          $result1 = $this->db->insert('tran_partsrcir_stock',$UpdateBooked);
        								
        					        }
                                    $dpr_qty =$dpr_qty - $invQTY;
                                    if ($dpr_qty<=0)
                                        {break;}
							
							    } //updatePartOpStock foreach End
						 
					    	}*/
                        
                            //For despatch against available qty which is not booked from any branch
            
    					
    						 //Operation id - 47(Packing)
    						 $partId = $mastrec['part_id'];
    						 $plan_last_id = $mastrec['prod_plan_id'];
    						 
    					//	if(!empty($updatePartOpStock)){
    						    //echo "---updatePartOpStock---";
    						    
    						      if ($invno != $mastrec['invoice_no'])
                                    {
                                        
                                         $invno =$mastrec['invoice_no'];
                                         $postDate = array(
                                                'date' 		    => $mastrec['date'],
                                                'year' 			=> $_SESSION['current_year'],
                                                'invoice_no' 	=> $mastrec['invoice_no'],
                                                'customer_id' 	=> $mastrec['customer_id'],
                                            );
                                      $mast_inv_id = $this->InvoiceModel->AddTranInvoiceMast($postDate);  
                                	}
                                //	echo "<br>Invoice_no".$invno." MAST_INV_NO:".$mast_inv_id;

                            if ($mast_inv_id){
                                    $postDetailsDate = array(
                                    'mast_inv_id' => $mast_inv_id,
                                    'schedule_id' => $mastrec['schedule_id'],
                                    'oa_det_id'   => $mastrec['oa_det_id'],
                                    'part_id' 	  => $mastrec['part_id'],
                                    'branch_id'   => $_SESSION['branch_id'],
                                    'qty' 	      => $mastrec['qty'],
                                    'prod_plan_id'=>$mastrec['prod_plan_id'],
                                    );
                                    
                                $det_inv_id = $this->InvoiceModel->AddTranInvoiceDetails($postDetailsDate);
                                
                                $dpr_qty=$mastrec['qty'];
                                
                                $updatePartOpStock = $this->getQueryModel->getPackingQty($mastrec['part_id'],$_SESSION['branch_id']);
    	                       if(!empty($updatePartOpStock)){
    	                           
    							foreach ($updatePartOpStock as $key => $value) 
    							{
    								$det_id 	            = $value['det_id'];
    								$date 	                = $value['date'];
    								$doc 	                = $value['doc'];
    								$op_id 	                = $value['op_id'];
    								$mast_id 	            = $value['mast_id'];
                                	$available_qty   	    = $value['max_qty'];
    						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
    						        $invQTY =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
    						        
    								if($doc == "dpr")
    								{   
    							    	$UpdateDate67 = array(
            									'part_id' 			=> $partId,
            									'operation_id' 		=> '47',
            									'mast_dpr_id' 	    => $mast_id,
            						            'year' 				=>  $_SESSION['current_year'],
            						            'tran_date' 		    => $mastrec['date'],
            						            'doc_year' 			=>  $_SESSION['current_year'],
            							    	'issue_qty' 		=> $invQTY,
        										'issue_doc_id' 		=> $det_inv_id,
            									'issue_doc_type' 	=> 'invoice',
            									'branch_id' 		=> $_SESSION['branch_id'],
            								// 	'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
            								// 	'booked_doc_id' 	=> $plan_last_id,
            								// 	'booked_doc_type' 	=> 'prod_plan',
            									'created_by' 		=> $_SESSION['id'],
            									'updated_by' 		=> $_SESSION['id'],
                                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
    								    );
    								   
    									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
    									
    								}else{
    								    
    								    $UpdateDate67 = array(
            									'part_id' 			    => $partId,
            									'op_id' 		        => '47',
            									'mast_partsrcir_id' 	=> $mast_id,
            									'det_partsrcir_id' 	    => $det_id,
            						            'year' 				    =>  $_SESSION['current_year'],
            						            'tran_date' 		    => $mastrec['date'],
            						            'doc_year' 			    =>  $_SESSION['current_year'],
            							    	'issue_qty' 		=> $invQTY,
        										'issue_doc_id' 		=> $det_inv_id,
            									'issue_doc_type' 	=> 'invoice',
            								// 	'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
            									'branch_id' 	    	=> $_SESSION['branch_id'],
            									'created_by' 		    => $_SESSION['id'],
            									'updated_by' 		    => $_SESSION['id'],
            								// 	'booked_doc_id' 		=> $plan_last_id,
            								// 	'booked_doc_type' 	    => 'prod_plan',
                                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
    								    );
    								  
    									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
    								
    								}
                                    $q1 = $this->db->query("update tran_invoice_details set updated_qty=(updated_qty+'$invQTY') where id = '$det_inv_id'");
                                    
    							    $dpr_qty =$dpr_qty - $invQTY;
                                    if ($dpr_qty<=0)
                                        {break;}
    							
    							} //updatePartOpStock foreach End
						 
						}//updatePartOpStock if End
							if($dpr_qty > 0)
    						{   
    							    	$UpdateDate67 = array(
            									'part_id' 			=> $partId,
            									'operation_id' 		=> '47',
            									'mast_dpr_id' 	    => 9999999,
            						            'year' 				=>  $_SESSION['current_year'],
            						            'tran_date' 		=> $mastrec['date'],
            						            'doc_year' 			=>  $_SESSION['current_year'],
            							    	'issue_qty' 		=> $dpr_qty,
        										'issue_doc_id' 		=> $det_inv_id,
            									'issue_doc_type' 	=> 'invoice',
            									'branch_id' 		=> $_SESSION['branch_id'],
            								// 	'booked_qty' 		=> ($available_qty>$dpr_qty)?$dpr_qty:$available_qty,
            								// 	'booked_doc_id' 	=> $plan_last_id,
            								// 	'booked_doc_type' 	=> 'prod_plan',
            									'created_by' 		=> $_SESSION['id'],
            									'updated_by' 		=> $_SESSION['id'],
                                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
    								    );
    								   
    									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
    								    
    								}
                        }   //  end of if ($mast_inv_id)
                    }//end of excel records
    			}
        				 
           } //end of fopen      		


    } //end of ext==csv
    
    	 $this->session->set_flashdata('insuffstock', $insuffstock);
        	 $this->session->set_flashdata('createS', 'You have added Invoice successfully.');
        //	redirect('/viewInvoice'); 
        	redirect('/addInvoice');
		    
		}else
		 {
			$data['getCustName'] 		= $this->getQueryModel->getCustName();
			$this->load->view('Invoice/addInvoice',$data);
		}
		
	}

  //*********************************************** *****
  	public function correctInvoice()
	{
	    error_reporting(E_ALL);
			print_r($_SESSION);
				$getInvDetailsforCorrection = $this->getQueryModel->getInvDetailsforCorrection();
				foreach($getInvDetailsforCorrection as $invdet)
				{ //echo "<pre>";print_r($invdet);
			                $updatePartOpStock = $this->getQueryModel->getPackingQty($invdet['part_id'],$invdet['branch_id']);
    						 //Operation id - 47(Packing)
    						 $partId = $invdet['part_id'];
    						 $plan_last_id = $invdet['prod_plan_id'];
    						 $dpr_qty=$invdet['qty'];
    						if(!empty($updatePartOpStock) && $dpr_qty>0){
    						    
                             
    							foreach ($updatePartOpStock as $key => $value) 
    							{   $invQTY=0;
    								$det_id 	            = $value['det_id'];
    								$date 	                = $value['date'];
    								$doc 	                = $value['doc'];
    								$op_id 	                = $value['op_id'];
    								$mast_id 	            = $value['mast_id'];
                                	$available_qty   	    = $value['max_qty'];
    						        $dpr_qty                = ($dpr_qty != "") ? $dpr_qty : 0;
    						        $invQTY =($available_qty>$dpr_qty)?$dpr_qty:$available_qty;
    						        
    						        
    								if($doc == "dpr")
    								{   
    							    	$UpdateDate67 = array(
            									'part_id' 			=> $partId,
            									'operation_id' 		=> '47',
            									'mast_dpr_id' 	    => $mast_id,
            						            'year' 				=>  $_SESSION['current_year'],
            						            'tran_date' 	    => $invdet['date'],
            						            'doc_year' 			=>  $_SESSION['current_year'],
            							    	'issue_qty' 		=> $invQTY,
        										'issue_doc_id' 		=> $invdet['id'],
            									'issue_doc_type' 	=> 'invoice',
            									'branch_id' 		=> $invdet['branch_id'],
            									'created_by' 		=> $_SESSION['id'],
            									'updated_by' 		=> $_SESSION['id'],
                                                'updated_on' 		=> date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
    								    );
    								   
    									$result16 = $this->db->insert('tran_dpr_stock',$UpdateDate67);
    								//	echo "22222";
    									
    								}else{
    								    
    								    $UpdateDate67 = array(
            									'part_id' 			    => $partId,
            									'op_id' 		        => '47',
            									'mast_partsrcir_id' 	=> $mast_id,
            									'det_partsrcir_id' 	    => $det_id,
            						            'year' 				    =>  $_SESSION['current_year'],
            						            'tran_date' 		    => $invdet['date'],
            						            'doc_year' 			    =>  $_SESSION['current_year'],
            							    	'issue_qty' 	        => $invQTY,
        										'issue_doc_id' 		    => $invdet['id'],
            									'issue_doc_type' 	    => 'invoice',
            									'branch_id' 	    	=> $invdet['branch_id'],
            									'created_by' 		    => $_SESSION['id'],
            									'updated_by' 		    => $_SESSION['id'],
            							        'updated_on' 		=> date("Y-m-d H:i:s"),
                                                'created_on' 		=> date("Y-m-d H:i:s")
    								    );
    								  
    									$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate67);
    								  //  echo "1111";
    								}
    								echo "************\nINVOICE QTY:".$invQTY." INV DET ID:".$invdet['id'];
                	   $q1 = $this->db->query("update tran_invoice_details set updated_qty=(updated_qty+'$invQTY') where id = '$invdet[id]'");
			 		
    							         $dpr_qty =$dpr_qty - $invQTY;
                                    if ($dpr_qty<=0)
                                        {break;}
						
    							
    	            			} //updatePartOpStock foreach End

						 
						}
			
			    
			    
				}
        	 $this->session->set_flashdata('createS', 'You have added Invoice successfully.');
        //	redirect('/viewInvoice'); 
		    
		
	}

public function deleteInvoiceRecord(){
     $mastid   = $_POST['mastid'];
     $invdetId = $_POST['invdetId'];

			    $query1="Update tran_invoice_details set updated_qty = 0,qty = 0,isdeleted = 1 where id='$invdetId' and mast_inv_id='$mastid'";
			    $this->db->query($query1);
			    $affectedrows = $this->db->affected_rows();
			    if($affectedrows){
			      //tran_partrcir_stock
			     $query4="Update tran_partsrcir_stock set issue_qty = 0 where issue_doc_id='$invdetId' and issue_doc_type='invoice'";
			     $this->db->query($query4);
			    
			    //tran_dpr_stock
			     $query5="Update tran_dpr_stock set issue_qty = 0 where issue_doc_id='$invdetId' and issue_doc_type='invoice'";
			      $this->db->query($query5);
			    }
			    echo $affectedrows;
}

}

?>