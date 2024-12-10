<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class CustomerController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Customer/CustomerModel');
	}


	
	public function customers()
	{
		$data['customers'] = $this->CustomerModel->getCustomers();
		$this->load->view('Customer/customers',$data);
	}
	public function addCustomers()
	{

		$id = base64_decode($_GET['ID']);

		$data = [];

		if(!empty($id))
		{

			$data['customers'] = $this->CustomerModel->getCustomersbyid($id);
			$data['consignee'] = $this->CustomerModel->getconsigneebyid($id);

		}
		
		$this->load->view('Customer/add',$data);
	}
	public function createCustomer()
	{

	    $this->session->unset_userdata('createC');
	    $this->form_validation->set_rules('txtcustName', 'Customer Name', 'required');
		$this->form_validation->set_rules('txtGSTNo', 'GST No', 'trim|required');
		$this->form_validation->set_rules('txtCreditPeriod', 'Credit Period', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('txtStateCode', 'State Code', 'trim|required');
		$this->form_validation->set_rules('txtVendorCode', 'Vendor Code', 'trim|required');
		//$this->form_validation->set_rules('txtBankName', 'Bank Name', 'trim|required|is_unique[mast_users.username]');
		//$this->form_validation->set_rules('txtAccountNo', 'Account No', 'trim|required');
		// $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('txtemtxtEmailIDail', 'Email', 'trim|valid_email');
		// $this->form_validation->set_rules('txtIFSCCode', 'IFSC Code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if($this->form_validation->run() == TRUE) 
		{
		//echo "<pre>";print_r($_POST);die;
			$txtContactPerson	 = $this->input->post('txtContactPerson');
			$txtContactNo 		 = $this->input->post('txtContactNo');
			$txtEmailID 		 = $this->input->post('txtEmailID');

			$txtCName 			= $this->input->post('txtCName');
			$txtCAddress 		= $this->input->post('txtCAddress');
			$txtCgstno 			= $this->input->post('txtCgstno');
			$txtCstatecode 		= $this->input->post('txtCstatecode');
			
			//print_r($txtContactPerson);

					$countContact = count($txtContactPerson);
					$ccount = count($txtCName);

					//if(array_key_exists($txtContactPerson))
					if(!empty($txtContactPerson))
					{
					    for ($i = 0; $i < $countContact; $i++) 
						{
							$ContactPersons .= $txtContactPerson[$i].",".$txtContactNo[$i].",".$txtEmailID[$i]."-";
						}
					}else{
						$ContactPersons = "";
					}
					$ContactPersonsf = ($ContactPersons != " ") ? rtrim($ContactPersons,"-") : "";

				$postDate = array(
					'company_id' => $_SESSION['id'],
					'name' => $this->input->post('txtcustName'),
					'gst_no' => $this->input->post('txtGSTNo'),
					'credit_period' => $this->input->post('txtCreditPeriod'),
					'address' => $this->input->post('txtAddress'),
					'email_id' => $this->input->post('txtemail'),
					'stateCode' => $this->input->post('txtStateCode'),
					'vendor_code' => $this->input->post('txtVendorCode'),
					'bankName' => $this->input->post('txtBankName'),
					'bank_acno' => $this->input->post('txtAccountNo'),
					'IFSCCode' => $this->input->post('txtIFSCCode'),
					'contact_person_details' => $ContactPersonsf,
					'created_by ' => $_SESSION['id'],
					'created_on ' => date("Y-m-d H:i:s"),
					'updated_on ' => date("Y-m-d H:i:s"),
				
				);


				 $result = $this->db->insert('mast_customer',$postDate);
				 $insert_id = $this->db->insert_id();

				 if(trim($txtCName[0]) != "")
				 {
						for ($i = 0; $i < $ccount; $i++) 
						{
							$postDate1 = array(
									'cust_id' => $insert_id,
									'name' => $txtCName[$i],
									'address' => $txtCAddress[$i],
									'gst_no' => $txtCgstno[$i],
									'statecode' => $txtCstatecode[$i],
									'created_by ' => $_SESSION['id'],
									'created_on ' => date("Y-m-d"),
									'updated_on ' => date("Y-m-d"),
							);
						
						$result1 = $this->db->insert('mast_consignee',$postDate1);
						
						}
					}


				$this->session->set_flashdata('createC', 'You have added Customer successfully.');
				redirect( base_url('Customers'));

		}else
		 {
			$this->load->view('Customer/add');
		}
		
	}

	public function updateCustomer()
	{
	    $this->session->unset_userdata('createC');
	    $this->form_validation->set_rules('txtcustName', 'Customer Name', 'required');
		$this->form_validation->set_rules('txtGSTNo', 'GST No', 'trim|required');
		$this->form_validation->set_rules('txtCreditPeriod', 'Credit Period', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('txtStateCode', 'State Code', 'trim|required');
		$this->form_validation->set_rules('txtVendorCode', 'Vendor Code', 'trim|required');
	//	$this->form_validation->set_rules('txtBankName', 'Bank Name', 'trim|required|is_unique[mast_users.username]');
	//	$this->form_validation->set_rules('txtAccountNo', 'Account No', 'trim|required');
		//$this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
	//	$this->form_validation->set_rules('txtemtxtEmailIDail', 'Email', 'trim|valid_email');
		//$this->form_validation->set_rules('txtIFSCCode', 'IFSC Code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) 
		{
			$txtContactPerson	 = $this->input->post('txtContactPerson');
			$txtContactNo 		 = $this->input->post('txtContactNo');
			$txtEmailID 		 = $this->input->post('txtEmailID');

			$txtCName 			= $this->input->post('txtCName');
			$txtCAddress 		= $this->input->post('txtCAddress');
			$txtCgstno 			= $this->input->post('txtCgstno');
			$txtCstatecode 		= $this->input->post('txtCstatecode');

			$countContact = count($txtContactPerson);
			$ccount = count($txtCName);

			if(sizeof($this->input->post('txtContactPerson')))
			{

				for ($i = 0; $i < $countContact; $i++) 
				{
					if(!empty($txtContactPerson[$i]))
					{
						$ContactPersons .= $txtContactPerson[$i].",".$txtContactNo[$i].",".$txtEmailID[$i]."-";

					}
				}
			}else{
				$ContactPersons = "";
			}

			$ContactPersonsf = ($ContactPersons != "") ? rtrim($ContactPersons,"-") : "";

			$postDate = array(
					'company_id' => $_SESSION['id'],
					'name' => $this->input->post('txtcustName'),
					'gst_no' => $this->input->post('txtGSTNo'),
					'credit_period' => $this->input->post('txtCreditPeriod'),
					'address' => $this->input->post('txtAddress'),
					'email_id' => $this->input->post('txtemail'),
					'stateCode' => $this->input->post('txtStateCode'),
					'vendor_code' => $this->input->post('txtVendorCode'),
					'bankName' => $this->input->post('txtBankName'),
					'bank_acno' => $this->input->post('txtAccountNo'),
					'IFSCCode' => $this->input->post('txtIFSCCode'),
					'contact_person_details' =>  $ContactPersonsf
					
				);

				$editId =$this->input->post('editId');
				
				$v=$this->db->where('id',$editId);
				$query=$this->db->update('mast_customer',$postDate,$v);

				$postDate1 =[];

				//delete mast_consignee before update
				
			

				 if(sizeof($this->input->post('txtCName')))
				 {

						for ($i = 0; $i < $ccount; $i++) 
						{
							$txtconId = $_POST['txtconId'][$i];

							if($txtCName[$i] != "")
							{
								$postDate1 = array(
										'cust_id' =>$editId,
										'name' => $txtCName[$i],
										'address' => $txtCAddress[$i],
										'gst_no' => $txtCgstno[$i],
										'statecode' => $txtCstatecode[$i],
										'created_by ' => $_SESSION['id'],
										'updated_by ' => $_SESSION['id'],
										'created_on ' => date("Y-m-d"),
										'updated_on ' => date("Y-m-d"),
								);

								echo "<pre>";
								print_r($postDate1);
							
								if(!empty($txtconId))
								{
									$v=$this->db->where('id',$txtconId);
									$query=$this->db->update('mast_consignee',$postDate1,$v);

								}else{
									$result1 = $this->db->insert('mast_consignee',$postDate1);
								}

							}

						}
						
					}

				redirect('/Customers');

		}else
		 {
			$editId=$this->input->post('editId');
			
			$data['customers'] = $this->CustomerModel->getCustomersbyid($editId);
			$data['consignee'] = $this->CustomerModel->getconsigneebyid($editId);

			$this->load->view('Customer/add',$data);
		}
		
	}

	public function deleteCustRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->CustomerModel->deleteCustRecord($postDate);
	}
	

}
