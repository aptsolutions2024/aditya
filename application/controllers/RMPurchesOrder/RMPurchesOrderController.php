<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class RMPurchesOrderController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('RMRequisition/RMRequisitionModel');
		$this->load->model('getQuery/GetQueryModel');
		$this->load->model('Supplier/SupplierModel');
		
	}
	
	public function index()
	{
	   		$data['getTranPoMast'] = $this->GetQueryModel->getTranPoMast();

		$this->load->view('RMPurchesOrder/index',$data);
	}
	public function getOrdermast()
	{
		$getTranPoMast = $this->GetQueryModel->getTranPoMast();
		echo json_encode($getTranPoMast);
	}
	public function getOrderDetails()
	{
		$id = ( !empty($_GET['id'])) ? $_GET['id'] : "";
		
		$getTranPoMasts = $this->GetQueryModel->getTranPoDetailsbyId($id);
		echo json_encode($getTranPoMasts);
	}
	//new
	public function deleteRmOrder()
	{

		$postDate = array(
				'isdeleted' => 1,
				);

				echo $id =$this->input->post('id');
				
				$v=$this->db->where('id',$id);
				$query=$this->db->update('tran_po_details',$postDate,$v);
				
			$postDate = array(
				'tran_po_id' => 0,
				);

				echo $tran_po_id =$this->input->post('id');
				
				$v=$this->db->where('tran_po_id',$tran_po_id);
				$query=$this->db->update('tran_requisition',$postDate,$v);		
				
				return true;

	}
	public function rmpurchesorder()
	{
		if(!empty($_GET['ID']))
		{

			$id = ($_GET['ID']);

			$data['getTranPoMast'] 		= $this->GetQueryModel->getTranPoMastbyId($id);
			$data['getTranPoDetail'] = $this->GetQueryModel->getTranPoDetailsbyId($id);
			$data['getBranch'] 	= $this->GetQueryModel->getBranch();


			$sup_type = 1;
			$data['Supplier'] = $this->SupplierModel->getSuppliers($sup_type);
			// $getRawMaterial = $this->GetQueryModel->getRawMaterial();
			$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();

			if(!empty($data['getRawMaterial']))
			{
				$data1 = array();
					foreach ($data['getTranPoDetail'] as $key => $value) 
					{

						$data1 = $this->GetQueryModel->getRawMaterialbyrmid($value['rm_id']);
						
						if($data1['rm_id']==$value['rm_id'])
						{
							$datass[] = array_merge($value , $data1);
						}
					}


					$data['getRawMaterialbyid'] = $datass;
			}

		}else{


			$sup_type = 1;
			$data['Supplier'] = $this->SupplierModel->getSuppliers($sup_type);
			$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();
			$data['getBranch'] 	= $this->GetQueryModel->getBranch();
	
		}
		
		$this->load->view('RMPurchesOrder/rmpurchesorder',$data);
	}

	public function UpdateRmPurchesOrder()
	{
		if(!empty($_POST))
		{

			$mast_po_id 		= $_POST['editId'];
			$rm_idupdate 	= $_POST['rm_idupdate'];
			$confirm  	= $_POST['confirm'];

			$Update_po_mast = array(
				'supplier_id'  	=> $_POST['supplierId'],
				'date' 			=> $_POST['date'],
				'year'          => $_SESSION['current_year'],
				'is_open_po' 	=> $_POST['is_openpo'],
				'payment_terms'  => $_POST['payment_term'],
				'Remarks' 		=> $_POST['remark'],
				'created_by ' => $_SESSION['id'],
				'updated_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				'updated_on ' => date("Y-m-d H:i:s")
			);

			$where = array('id ' => $_POST['editId']);
			$this->db->where($where);
			$this->db->update('tran_po_mast ', $Update_po_mast);

			// ------------------------------update---------------

						foreach ($rm_idupdate as $key => $value) 
						{
							
							$rmid = $value;
							$RowMatterialNameupdate = $_POST['RowMatterialNameupdate'];
							$totalqtyupdate = $_POST['totalqtyupdate'];

							$rateupdate = $_POST['rateupdate'];
				// 			$igstupdate = $_POST['igstupdate'];
				// 			$cgstupdate = $_POST['cgstupdate'];
				// 			$sgstupdate = $_POST['sgstupdate'];
							$branchupdate = $_POST['branchupdate'];
							$open      = $_POST['open'];
							$podetail_id = $_POST['podetail_id'];

							$newDate = date('d-m-Y',strtotime($_POST['date'])); 

							

								$postDateUP = array(
											'rate' 				=> $rateupdate[$key],
								// 			'igst' 				=> $igstupdate[$key],
								// 			'cgst' 				=> $cgstupdate[$key],
								// 			'sgst' 				=> $sgstupdate[$key],
											'branch_id' 		=> $branchupdate[$key],
											'open_status' 		        => $open[$key],
											'ordered_qty' => $totalqtyupdate[$key],
											'created_by ' => $_SESSION['id'],
											'updated_by ' => $_SESSION['id'],
											'created_on ' => date("Y-m-d H:i:s"),
											'updated_on ' => date("Y-m-d H:i:s"),
								);

								$v123=$this->db->where('id',$podetail_id[$key]);

								$query=$this->db->update('tran_po_details',$postDateUP,$v123);
								

								// $data = array(
								// 'tran_po_id' => $mast_po_id,
								// );

								// $where = array('rm_id ' => $rm_id[$keys], 'tran_po_id ' => NULL);
								// $this->db->where($where);
								// $this->db->update('tran_requisition ', $data);

						}

						$rm_id 			= $_POST['rm_id'];
						$checkboxVal 	= $_POST['checkboxVal'];

						$RowMatterialName 	= $_POST['RowMatterialName'];
						$rate 				= $_POST['rate'];
				// 		$igst 				= $_POST['igst'];
				// 		$cgst 				= $_POST['cgst'];
				// 		$sgst 				= $_POST['sgst'];
						$branch_id 			= $_POST['branch_id'];
						$totalqty 			= $_POST['totalqty'];

						foreach ($checkboxVal as $key => $value) 
						{
							
							$data =  explode('@', $value);
							
							$keys =  array_search($data[0],$rm_id,true);




								$postDate5 = array(
											'mast_po_id' => $mast_po_id,
											'rm_id' => $data[0],
											'rate' => $rate[$keys],
								// 			'igst' => $igst[$keys],
								// 			'cgst' => $cgst[$keys],
								// 			'sgst' => $sgst[$keys],
											'branch_id' => $branch_id[$keys],
											'ordered_qty' => $totalqty[$keys],
                                            'year'  => $_SESSION['current_year'],
											'created_by ' => $_SESSION['id'],
											'updated_by ' => $_SESSION['id'],
											'created_on ' => date("Y-m-d H:i:s"),
											'updated_on ' => date("Y-m-d H:i:s"),
								);
								
								$result1 = $this->db->insert('tran_po_details',$postDate5);
								$det_po_id = $this->db->insert_id();

								// $postDate3 = array(
								// 'tran_po_id' => $mast_po_id,
								// );

								// $where = array('rm_id ' => $rm_id[$keys] , 'tran_po_id ' => isnull);
								// $v=$this->db->where($where);


								// // $v=$this->db->where('rm_id'=> $rm_id[$keys],'tran_po_id' => isnull);

								// $query=$this->db->update('tran_requisition',$postDate3,$v);


								$data = array(
								'tran_po_id' => $det_po_id,
								);

								$where = array('rm_id ' => $rm_id[$keys], 'tran_po_id ' => NULL);
								$this->db->where($where);
								$this->db->update('tran_requisition ', $data);
								 

						}

						if($confirm == "yes")
						{
									$rm_id = $_POST['editId'];

									$getGetRMPOMailData 	= $this->GetQueryModel->GetRMPOMailData($rm_id);

									if(!empty($getGetRMPOMailData))
									{
										foreach ($getGetRMPOMailData as $key => $value) 
										{
												$MailData[] = array(
													'rm_id' => 				$value['rm_id'],
													'rate' => 				$value['rate'],
												// 	'igst' => 				$value['igst'],
												// 	'cgst' => 				$value['cgst'],
												// 	'sgst' => 				$value['sgst'],
													'date' 	=> 				date("d-m-Y", strtotime($value['date'])),
													'po_id'=> 				$value['mast_po_id'],
													'ordered_qty' => 	$value['ordered_qty'],
													'Remarks' => 			$value['Remarks'],
													'supplier_id' => 	$value['supplier_id'],
												);
										}
									}
									$this->send_mail($MailData);
									redirect(base_url('rm-Purchase-order-data'));
							}
		}
			redirect(base_url('rm-Purchase-order-data'));
	}

	public function AddRmPurchesOrder()
	{
      //echo "<pre>";print_r($_POST);
     
     	$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
	    $this->form_validation->set_rules('supplierId', 'supplierId', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

     	if ($this->form_validation->run() == TRUE) {
     	    
 	    $rm_id = $_POST['rm_id'];
        $rate 	= $_POST['rate'];
        $totalqty 	= $_POST['totalqty'];
        // $igst 				= $_POST['igst'];
        // $cgst 				= $_POST['cgst'];
        // $sgst 				= $_POST['sgst'];
        $branch_id 			= $_POST['branch_id'];
        $rec_cnt = 0;
            foreach ($_POST['checkboxVal'] as $key => $value) 
            {
                $rec_cnt++;
                //	echo "!!!!!!!";die;	
                //print_r($value);
                $data =  explode('@', $value);
                $keys =  array_search($data[0],$rm_id,true);
                $newDate = date('d-m-Y',strtotime($date)); 
                $errormsg = '';
                //echo "rate.$keys : ".$rate[0];die;
                if ($rate[$keys]==null || $rate[$keys]==0){$errormsg=$errormsg." <br> Invalid Rate. ";}
                
                $cnt = 0;
              
                    if(!($branch_id[$keys]>0))  
                    {$errormsg=$errormsg." <br> Invalid Branch. ";}
                    
                    if (!($totalqty[$keys]>0))
                    {$errormsg=$errormsg." <br> Invalid QTY. ";}
                    
                /*      if($igst[$keys]>0) {$cnt++;}
                if($sgst[$keys]>0) {$cnt++;}
                if($cgst[$keys]>0) {$cnt++;}
                    if ($cnt!=2)
                    {$errormsg=$errormsg." <br> Invalid GST Rates. ";}*/
                    
                //if(!empty($rate[$keys] && $igst[$keys] && $cgst[$keys] && $sgst[$keys] && $branch_id[$keys] && $cnt!=2))
                if ($errormsg != '')
                {
                    //$errormsg.='<br>For RM ID - '.$data[0];
                    //echo "ifPart";die;
                    $this->session->set_flashdata('oamsg', '<br>For RM ID - '.$data[0].$errormsg);
        	         
        	          	redirect('/rm-Purchase-order');
        			//$this->rmpurchesorder();
                
                }
        }
      	if($rec_cnt==0)
      	{
      	   // echo "rec cont 0";
                  $this->session->set_flashdata('oamsg', 'RM Purchse Order Details are Mandatory!');
        	  	redirect('/rm-Purchase-order');
      	}
    
		
	//	echo "inside1111";die;
            //end of validation
            
            $rm_id = $_POST['rm_id'];
            $checkboxVal = $_POST['checkboxVal'];
            
            
            $supplierId = $_POST['supplierId'];
            $date = $_POST['date'];
            $is_openpo = $_POST['is_openpo'];
            $payment_terms = $_POST['payment_term'];
            $Remarks 		= $_POST['remark'];
            $totalqty 	= $_POST['totalqty'];
            $confirm  	= $_POST['confirm'];
            
            
            //Insert code
            $postDataInsert = array(
            'year'       => $_SESSION['current_year'],
            'is_open_po' => $is_openpo,
            'type'      => 'RM',
            'date' => $date,
            'supplier_id' => $supplierId,
            'payment_terms' => $payment_terms,
            'Remarks' => $Remarks,
            'created_by ' => $_SESSION['id'],
            'updated_by ' => $_SESSION['id'],
            'created_on ' => date("Y-m-d H:i:s"),
            'updated_on ' => date("Y-m-d H:i:s"),
            );
            if ($rate[$keys]!=null || $rate[$keys]!=0){
            $result = $this->db->insert('tran_po_mast',$postDataInsert);
            }
            
            if($result)
            {
            
            $mast_po_id =  $this->db->insert_id();
            
            $RowMatterialName 	= $_POST['RowMatterialName'];
            $rate 				= $_POST['rate'];
            // $igst 				= $_POST['igst'];
            // $cgst 				= $_POST['cgst'];
            // $sgst 				= $_POST['sgst'];
            $branch_id 			= $_POST['branch_id'];
            
            $postDate = [];
            
            
            foreach ($checkboxVal as $key => $value) 
            {
            
            $data =  explode('@', $value);
            $keys =  array_search($data[0],$rm_id,true);
            $newDate = date('d-m-Y',strtotime($date)); 
            
            $MailData[] = array(
            'rm_id' => $rm_id[$keys],
            'rate' => $rate[$keys],
            // 'igst' => $igst[$keys],
            // 'cgst' => $cgst[$keys],
            // 'sgst' => $sgst[$keys],
            'branch_id' => $branch_id[$keys],
            'po_id' => $mast_po_id,
            'date' => $newDate,
            'ordered_qty' => $totalqty[$keys],
            'Remarks' => $Remarks,
            'supplier_id' => $supplierId,
            );
            
            $postDate = array(
            'mast_po_id' => $mast_po_id,
            'rm_id' => $rm_id[$keys],
            'rate' => $rate[$keys],
            // 'igst' => $igst[$keys],
            // 'cgst' => $cgst[$keys],
            // 'sgst' => $sgst[$keys],
            'branch_id' => $branch_id[$keys],
            'ordered_qty' => $totalqty[$keys],
            'year' => $_SESSION['current_year'],
            'created_by ' => $_SESSION['id'],
            'updated_by ' => $_SESSION['id'],
            'created_on ' => date("Y-m-d H:i:s"),
            'updated_on ' => date("Y-m-d H:i:s"),
            );
            if ($rate[$keys]!=null || $rate[$keys]!=0){
            $result1 = $this->db->insert('tran_po_details',$postDate);
            $tran_po_id = $this->db->insert_id();
            }
            // $postDate3 = array(
            // 'tran_po_id' => $mast_po_id,
            // );
            
            // $where = array('rm_id ' => $rm_id[$keys] , 'tran_po_id ' => isnull);
            // $v=$this->db->where($where);
            
            
            // // $v=$this->db->where('rm_id'=> $rm_id[$keys],'tran_po_id' => isnull);
            
            // $query=$this->db->update('tran_requisition',$postDate3,$v);
            
            
            $data = array(
            'tran_po_id' => $tran_po_id,
            );
            
            $where = array('rm_id ' => $rm_id[$keys], 'tran_po_id ' => NULL);
            $this->db->where($where);
            $this->db->update('tran_requisition ', $data);           
                
            }
            
            
            if($confirm == "yes")
            {
            $this->send_mail($MailData);
            }
          //  redirect('/rm-Purchase-order-data');
            }
        
     	}
     redirect('/rm-Purchase-order');
     
	}

	public function send_mail($MailData)
	{
	   
					$po_id = $MailData[0]['po_id'];
					$date = $MailData[0]['date'];

						$subject = "Confirmed order - ".$po_id;

						$message = "Dear Sir/Madam,<br>";
						$message .= "<p>Following is OUR CONFIRMED REQUIRMENT.</p>";
						$message .= "<p>PO No - $po_id , Date - $date.</p>";
						$message .= "<table class='table table-bordered' style='border: 1px solid black; border-collapse: collapse;'>
                                  <thead>
                                    <tr style='border: 1px solid black; padding: 5px;'>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>Sr.</th>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>Type</th>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>Thikness</th>
                                      <th scope='col' style='border: 1px solid black; padding: 15px;'>Length X Width</th>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>Qty</th>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>RATES</th>
                                      <th scope='col' style='border: 1px solid black; padding: 5px;'>UOM</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody class='tbody' style='border: 1px solid black;'>";

						$count = 1;
						
						   

						    $Remarks = $MailData[0]['Remarks'];
							$supplier_id = $MailData[0]['supplier_id'];
							// $getrmById = $this->SupplierModel->getrmById($rm_id);

							$Supplier = $this->SupplierModel->getsupplierByid($supplier_id);
							// $to = $Supplier['email_id'];
							$to = "deepakbhosale20@gmail.com,katkaraparna@gmail.com";

						foreach ($MailData as $key => $valmail) 
						{
						 
							$rm_id = $valmail['rm_id'];
							$rate = $valmail['rate'];
				// 			$igst = $valmail['igst'];
				// 			$cgst = $valmail['cgst'];
				// 			$sgst = $valmail['sgst'];
							$ordered_qty = $valmail['ordered_qty'];
							
							$getrmById 	= $this->GetQueryModel->getrmById($rm_id);
    
							$length 	= $getrmById['length'];
							$type 		= $getrmById['type'];
							$grade 		= $getrmById['grade'];
							$length 	= $getrmById['length'];
							$width 		= $getrmById['width'];
							$thickness 	= $getrmById['thickness'];
							$uom 		= $getrmById['uom'];

							$message .= "<tr style='border: 1px solid black;text-align:center;'>
						
			 				<th scope='row' style='border: 1px solid black;padding: 5px;'>".$count."</th>
			                                      <td style='border: 1px solid black;'>".$type."</td>
			                                      <td style='border: 1px solid black;'>".$thickness."</td>
			                                      <td style='border: 1px solid black;'>".($length ." X ". $width)."</td>
			                                      <td style='border: 1px solid black;'>".$ordered_qty ."</td>
			                                      <td style='border: 1px solid black;'>".$rate ."</td>
			                                      <td style='border: 1px solid black;'>".$uom ."</td>
			                                    </tr>";
			            		$count++;

						}
					 
                      	$message .="</tbody></table><br>";
                        // $message .="<br><br><br><br>";
                        $message .= "$Remarks<br>";
                        $message .= "<br>Regards,<br>";
                        $message .= (!empty($_SESSION['company_name'])) ? $_SESSION['company_name'] : "-";
                    

					$header = "From:aparnakatkar@aptsolutions.in \r\n";
					// $header .= "Cc:afgh@somedomain.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";

					 $retval = mail($to,$subject,$message,$header);
				

					if( $retval == true ) {
					echo "Message sent successfully...";
					redirect('/rm-Purchase-order-data');
					}else {
					echo "Message could not be sent...";
					redirect('/rm-Purchase-order-data');
					}
				// ----------------------mail End---------------------
							
						
	}
	
	public function rmPOPrint(){
	    
	    $id = base64_decode(urldecode($_GET['ID']));
		 $data['companyDetails']     = $this->GetQueryModel->companyDetails();
		$data['getOtherpo'] 	    = $this->GetQueryModel->getTranPoMastbyId($id);
		$data['getOtherpoDetails']  = $this->GetQueryModel->getTranPoDetailsbyId($id);
		$this->load->view('RMPurchesOrder/rmPOPrint',$data);
	}
	
}
