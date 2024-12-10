<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SscheduleController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Supschedule/SupscheduleModel');
		$this->load->model('getQuery/GetQueryModel');
	}


	public function supplierSchedule()
	{
	    
		$data['getSupplierSchedule'] = $this->GetQueryModel->getTranSupplierSchedule();
		$data['getSupplier']    = $this->GetQueryModel->getSupplier();
		$this->load->view('supplierSchedule/viewSupplierSchedule',$data);
	}
	/*public function addSupplierSchedule()
	{
		$this->form_validation->set_rules('SupId', 'supplier', 'trim|required');
		$this->form_validation->set_rules('SchDate', 'schedule', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
            $data['addSupplierSchedule'] = $this->GetQueryModel->addSupplierSchedule();
			$data['getBranch'] 			= $this->GetQueryModel->getBranch();
			$this->load->view('supplierSchedule/addSupplierSchedule',$data);

		}else
		{
		    
			$this->supplierSchedule();
		}

	}*/
	public function addSupplierSchedule()
	{
		$data['getSupplier']    = $this->GetQueryModel->getSupplier();
		$data['getBranch'] 			= $this->GetQueryModel->getBranch();
		$this->load->view('supplierSchedule/addSupplierSchedule',$data);


	}
	public function showSchBySupplierBranch()
	{
		//$this->form_validation->set_rules('Supplier_Id', 'supplier', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'schedule', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$data['getPartsSupplier'] = $this->GetQueryModel->getPartsSupplierSchedule();
			$data['getSupplier']    = $this->GetQueryModel->getSupplier();
			$data['formSubmitFlag'] 		= 1;
			$this->load->view('supplierSchedule/viewSupplierSchedule',$data);

		}else
		{
			$this->supplierSchedule();
		}
	}
	public function addSuppliersProccess()
	{
	   
		 $this->form_validation->set_rules('Supplier_Id', 'supplier', 'trim|required');
		$this->form_validation->set_rules('schedule_date', 'schedule', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

		$data['addSupplierSchedule'] = $this->GetQueryModel->addSupplierSchedule();
		$data['getSupplier']    = $this->GetQueryModel->getSupplier();
		$data['getBranch'] 			= $this->GetQueryModel->getBranch();
		$this->load->view('supplierSchedule/addSupScheduleByBranch',$data);

		}else
		{
			$this->addSupplierSchedule();
		}
	}
	
	function updateSupplierSchedule()
	{
		$this->SupscheduleModel->updateSupplierSchedule();
	}
	public function getMailPartsSchedule()
	{
		if(!empty($_POST['schedule_date']))
		{	
			$count = 1;
		    $res =	$this->GetQueryModel->getPartsSupplierSchedule();
		
		
			foreach ($res as $key => $value) 
			{
			    
			    $partDetails = $this->GetQueryModel->getPartsById($value['part_id']); 
               $bDetails    = $this->GetQueryModel->getBranchbyId($value['receiving_branch_id']); 
               $supplierD   = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
               $partsrcirId = $value['tran_partsrcir_id'];
               
                       

				$tablerow .= "<tr>
				<th scope='row'>".$count."</th>
                                      <td>".$partDetails['partno']."</td>
                                      <td>".$value['qty']."</td>
                                      <td>".$bDetails['name']."</td>
                                    </tr>";
            $count++;

			}
			echo  $tablerow;

		}

	}
	
	public function PartsSendmail()
	{
	       error_reporting(0);
          // print_r($_POST);die;
			$subject        = $_POST['subline'];
			$schedule_date  = $_POST['schedule_date'];
	 	//	$to             = $_POST['emails'];
			$to             = "aparnakatkar2024@gmail.com";
			$remarks        = $_POST['remarks'];
			//$to = "katkaraparna@gmail.com,deepakbhosale20@gmail.com,sagarchavan219@gmail.com";

						$message = "Dear Sir/Madam,<br>";
						$message .= "<p>Please see the below schedule $schedule_date </p>";
						$message .= "<table class='table table-bordered' style='border: 1px solid black;border-collapse: collapse;'>
                                  <thead>
                                    <tr style='border: 1px solid black;'>
                                      <th scope='col' style='border: 1px solid black;'>Sr.</th>
                                      <th scope='col' style='border: 1px solid black;'>Part No.</th>
                                      <th scope='col' style='border: 1px solid black;'>Schedule Qty</th>
                                      <th scope='col' style='border: 1px solid black;'>Mat. Rec. Branch</th>
                                    </tr>
                                  </thead>
                                  <tbody class='tbody' style='border: 1px solid black;'>";


// -------------------------------email body start --------------------------------------
						$count = 1;
						
						    
						$res =	$this->GetQueryModel->getPartsSupplierSchedule();
		
		
			foreach ($res as $key => $value) 
			{
			    
			    $partDetails = $this->GetQueryModel->getPartsById($value['part_id']); 
               $bDetails    = $this->GetQueryModel->getBranchbyId($value['receiving_branch_id']); 
               $supplierD   = $this->GetQueryModel->getSupplierById($value['supplier_id']); 
               $partsrcirId = $value['tran_partsrcir_id'];
               
                 
            
            $message .= "<tr style='border: 1px solid black;'>
						
                        <th scope='row' style='border: 1px solid black;'>".$count."</th>
                        <td style='border: 1px solid black;'>".$partDetails['partno']."</td>
                        <td style='border: 1px solid black;'>".$value['qty']."</td>
                        <td style='border: 1px solid black;'>".$bDetails['name']."</td>
                        </tr>";
			            $count++;
			            

			}
			
    			    $message .="</tbody></table><br><br>";
                    $message .="<br><br>";
                    $message .= 'Note - '.$remarks;	
                    $message .="<br><br><br><br>";
                    $message .= "<br><br>Regards,<br>";
                    $message .= "Aditya ERP<br>";

					$header = "From:PartsSchedule@somedomain.com \r\n";
					$header .= "Cc:katkaraparna@gmail.com,deepakbhosale20@gmail.com,aparnakatkar2024@gmail.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";

					//OLD One
					require_once("public/send-email/PHPMailer/class.phpmailer.php");
					$mail = new PHPMailer();
                    $mail-> isSMTP();
            		$mail->SMTPDebug  = 3;
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = '587';
                   // $mail->SMTPSecure = 'ssl';
                   // $mail->Port = 465;
                    $mail->Host = 'smtp.gmail.com';   
                    $mail->IsHTML(true);
                    $mail->Username = 'info@aptsolutions.in';          // SMTP username
                    $mail->Password = 'AptSolutions@2024'; // SMTP password
                    $mail->setFrom('info@aptsolutions.in', 'Supplier Schedule');
                    $mail->addAddress($to);   // Add a recipient
                    $mail->AddCC("katkaraparna@gmail.com");
                    $mail->Subject = $subject;
                    $mail->Body    = "Testing MAil";   
                    
                    if($mail->send()){
                            echo '   **Message has been sent**  ';
                          
                    }else{
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                            echo "<br>";
                    }
                    $mail->SmtpClose();
                    clearstatcache();
				/*	
				    $retval = mail ($to,$subject,$message,$header);
                    $msg='';
 					if( $retval == true ) {
					$msg= "Message sent successfully...";
					}else {
					$msg= "Message could not be sent...";
					}
			 	    echo $msg;
			   */
				   
				   //New one - 29-05-2024
			
          /*          
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.aptsolutions.in',
            'smtp_port' => 465,
            'smtp_user' => 'info@aptsolutions.in', // First user authenticate
            'smtp_pass' => 'AptSolutions@2024',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
           // $this->email->initialize($config);
            
            $this->email->from('aparnakatkar2024@gmail.com', 'Fractmet');
            $this->email->to('asharani.madane@gmail.com'); 
            $this->email->subject('Email Test');
            $this->email->message("test");  
            $this->email->send();
            echo $this->email->print_debugger(array('headers'));
            */
			// -------------------------------email body end --------------------------------------
		}

	
	
	function getSupplierDetails()
	{
	    $id = $_POST['id'];
		$res = $this->GetQueryModel->getSupplierById($id);
		echo $res['email_id'].'^'.$res['name'];
	}
	
	


}

?>