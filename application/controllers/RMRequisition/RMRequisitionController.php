<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class RMRequisitionController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('RMRequisition/RMRequisitionModel');
		$this->load->model('getQuery/GetQueryModel');
		$this->load->model('Supplier/SupplierModel');
	}
	
	public function index()
	{
		$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();
		
		
		$this->load->view('RMRequisition/index',$data);
	}
	public function Sendmail()
	{

		if(!empty($_POST['alldata']))
		{	
			
			$subline = $_POST['subline'];
			$emails = $_POST['emails'];
			$alldata[] = $_POST['alldata'];
		
			$to = "katkaraparna@gmail.com,deepakbhosale20@gmail.com,sagarchavan219@gmail.com,adityaew@yahoo.com";
		//	$to = "asharani.madane@gmail.com";
						$subject = $subline;
                        $message='';
						$message .= "Dear Sir/Madam,<br>";
						$message .= "<p>Please give us competitive rates.</p>";
						$message .= "<p>Raw material details are follows.</p>";
						$message .= "<table class='table table-bordered' style='border: 1px solid black;'>
                                  <thead>
                                    <tr style='border: 1px solid black;'>
                                      <th scope='col' style='border: 1px solid black;'>Sr.No</th>
                                      <th scope='col' style='border: 1px solid black;'>Name</th>
                                      <th scope='col' style='border: 1px solid black;'>Type</th>
                                      <th scope='col' style='border: 1px solid black;'>Grade</th>
                                      <th scope='col' style='border: 1px solid black;'>Length</th>
                                      <th scope='col' style='border: 1px solid black;'>Width</th>
                                      <th scope='col' style='border: 1px solid black;'>Thikness</th>
                                      <th scope='col' style='border: 1px solid black;'>Qty</th>
                                    </tr>
                                  </thead>
                                  <tbody class='tbody' style='border: 1px solid black;'>";

//echo $message;exit;
// -------------------------------email body start --------------------------------------
						$count = 1;
						
						    
						foreach ($alldata as $key => $value) 
						{
						  
							$row = explode("@", $value);
							$id   = $row[0];
							$getrmById = $this->GetQueryModel->getrmById($id);

							$length = $getrmById['length'];
							$type = $getrmById['type'];
							$grade = $getrmById['grade'];
							$length = $getrmById['length'];
							$width = $getrmById['width'];
							$thickness = $getrmById['thickness'];
                           $message='';

							$name = $row[1];
							$qty = $row[2];

							$message .= "<tr style='border: 1px solid black;'>
			 				<th scope='row' style='border: 1px solid black;'>".$count."</th>
			                                      <td style='border: 1px solid black;'>".$row[1]."</td>
			                                      <td style='border: 1px solid black;'>".$type."</td>
			                                      <td style='border: 1px solid black;'>".$grade."</td>
			                                      <td style='border: 1px solid black;'>".$length."</td>
			                                      <td style='border: 1px solid black;'>".$width."</td>
			                                      <td style='border: 1px solid black;'>".$thickness."</td>
			                                      <td style='border: 1px solid black;'>".$row[2]."</td>
			                                    </tr>";
			            $count++;

						}
                               
                      	$message .="</tbody></table><br><br>";
                        $message .="<br><br><br><br>";
                        $message .= "<br><br>Regards,<br>";
                        $message .= "Aditya ERP<br>";

					$header = "From:abc@somedomain.com \r\n";
					$header .= "Cc:afgh@somedomain.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";

					$retval = mail ($to,$subject,$message,$header);


					if( $retval == true ) {
					echo "Message sent successfully...";
					}else {
					echo "Message could not be sent...";
					}

				return true;



			// -------------------------------email body end --------------------------------------
			


		}

	}
	public function mailformat()
	{
		if(!empty($_POST['mail_draft']))
		{	
			$count = 1;
			$tablerow="";
			foreach ($_POST['mail_draft'] as $key => $value) 
			{

				$row = explode("@",$value);

				$id   = $row[0];

				$getrmById = $this->GetQueryModel->getrmById($id);

				$length = $getrmById['length'];
				$type = $getrmById['type'];
				$grade = $getrmById['grade'];
				$length = $getrmById['length'];
				$width = $getrmById['width'];
				$thickness = $getrmById['thickness'];


				$name = $row[1];
				$qty = $row[2];

				$tablerow .= "<tr>
				<input type='text' name='rm_id' value='$row[1]'>
 				<th scope='row'>".$count."</th>
                                      <td>".$row[1]."</td>
                                      <td>".$type."</td>
                                      <td>".$grade."</td>
                                      <td>".$length."</td>
                                      <td>".$width."</td>
                                      <td>".$thickness."</td>
                                      <td>".$row[2]."</td>
                                    </tr>";
            $count++;

			}
			echo  $tablerow;

		}

	}
	public function rqemail()
	{
		$data['Supplier'] = $this->SupplierModel->getSuppliers(1);

		$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();
		$this->load->view('RMRequisition/rqemail',$data);
	}
	public function updateEquisitionNew()
	{
	    //echo "<pre>";print_r($_POST);die;

		if(!empty($_POST['checkboxVal']))
		{
			foreach ($_POST['checkboxVal'] as $key => $value) 
			{
				
				$keys =  array_search($value,$_POST['rm_id'],true);
				
				$rmid 			= $_POST['rm_id'][$keys];
				$rm_qty   		= $_POST['manual_qty'][$keys];	
				$plan_req_qty   = $_POST['plan_req_qty'][$keys];	
				$reserve_qty    = $_POST['reserve_qty'][$keys];	
				$date 			= $_POST['selectdate'];
                
				$getTranRequisition = $this->RMRequisitionModel->getTranRequisition($rmid,$date,$rm_qty,$plan_req_qty,$reserve_qty);

				
			}
		redirect(base_url('rm-equisition'));
		}else{
			redirect(base_url('rm-equisition'));
		}

	

	}
	public function updateEquisition()
	{


		if(!empty($_POST['rmid']))
		{
			$rmid 	= $_POST['rmid'];
			$rm_qty = $_POST['rm_qty'];
			$year 	= "2022 - 23";
			
			$getTranRequisition = $this->RMRequisitionModel->getTranRequisition($rmid,$year,$rm_qty);
			
			return true;
		}

		$data['getRawMaterial'] = $this->GetQueryModel->getRawMaterial();
		$this->load->view('RMRequisition/index',$data);

	}
	
}
