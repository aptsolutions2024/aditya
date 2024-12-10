<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class SupplierController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Supplier/SupplierModel');
		$this->load->model('getQuery/GetQueryModel');
	}

	
	public function Supplier()
	{

		$data['Supplier'] = $this->SupplierModel->getSuppliers();
		$this->load->view('Supplier/suppliers',$data);
	}
	public function getoperationname()
	{
		// print_r($_POST['id']);
		// die;

		// foreach ($_POST['id'] as $key => $value) 
		// {
		// 	$ids .= "'".$value."',";
		// }
		// echo $id = trim($ids,",");
		$id = trim($_POST['id']);
		


		$query = $this->db->query("SELECT id,Name FROM mast_operation where op_group_id = $id");
		$data = $query->result_array();

		$data1 .="<ul>";
		
		foreach ($data as $key => $value1) 
		{ 
			$data1 .="<li>";
		
			$data1 .= "<input type='checkbox' value=".$value1['id']." name='month[]' />&nbsp;&nbsp;".$value1['Name']."</li>";
			// $data1 .= "<option value=".$value1['id'].">".$value1['Name']."</option>";
			$data1 .="</li>";
		}
		$data1 .="</ul>";

		echo json_encode($data1);
	}
	public function addSupplier()
	{

		$data['OperationGrp'] = $this->GetQueryModel->getOperationsGroups();
		$data['GetOperationsGroup'] = $this->GetQueryModel->GetOperationsGroup();

		if(!empty($_GET['ID']))
		{
		$id = base64_decode($_GET['ID']);
		$data['getsupplier'] = $this->SupplierModel->getsupplierByid($id);
		$SupRelation = $this->GetQueryModel->getSupRelation($id);
			
		}

		$data['SupRelation'] = $SupRelation;

		$data['getOperation'] = $getOperation;


		$this->load->view('Supplier/add',$data);
	}
	public function createSupplier()
	{

		$operationname 		 = $this->input->post('operationname');

	    $this->session->unset_userdata('createS');
	    //$this->form_validation->set_rules('txtEmail', 'Email Id', 'required|valid_email');
	    $this->form_validation->set_rules('txtName', 'Supplier Name*', 'required');
		//$this->form_validation->set_rules('txtGSTNo', 'GST No', 'trim|required');
		$this->form_validation->set_rules('txttype', 'suppliers type', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
// 		$this->form_validation->set_rules('txtBankName', 'Bank Name', 'trim|required');
// 		$this->form_validation->set_rules('txtAccountNo', 'Account No', 'trim|required');
// 		$this->form_validation->set_rules('txtIFSCCode', 'IFSC Code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$txtContactPerson	 = $this->input->post('txtContactPerson');
			$txtContactNo 		 = $this->input->post('txtContactNo');
			$txtEmailID 		 = $this->input->post('txtEmailID');
			$operationgrp 		 = $this->input->post('operationgrp');
			$operationname 		 = $this->input->post('operationname');
			
			$countContact = count($txtContactPerson);

					if(trim($txtContactPerson[0]) != "")
					{
						for ($i = 0; $i < $countContact; $i++) 
						{
							$ContactPersons .= $txtContactPerson[$i].",".$txtContactNo[$i].",".$txtEmailID[$i]."-";
						}
					}else{
						$ContactPersons = "";
					}

			$postDate = array(
				'company_id' => $_SESSION['id'],
				'contact_person_details' => $ContactPersons,
				'name' => $this->input->post('txtName'),
				'gst_no' => $this->input->post('txtGSTNo'),
				'address' => $this->input->post('txtAddress'),
				'email_id' => $this->input->post('txtEmail'),
				'bankName' => $this->input->post('txtBankName'),
				'bank_acno' => $this->input->post('txtAccountNo'),
				'IFSCCode' => $this->input->post('txtIFSCCode'),
				'supl_type' => $this->input->post('txttype'),
				'supl_type' => $this->input->post('txttype'),

				'created_by ' => $_SESSION['id'],
				//'updated_by ' => $_SESSION['id'],
				//'updated_on ' => date("Y-m-d"),
				//'update_date ' => date("Y-m-d"),
				);

			$result = $this->db->insert('mast_supplier',$postDate);

			$supInsertId = $this->db->insert_id();
			$operationname 		 = $this->input->post('operation_name');

			foreach ($operationname as $key => $values) 
			{
				$postDate = array(
				
				'supplier_id' => $supInsertId,
				'op_id' => trim($values),
				'created_by ' => $_SESSION['id'],
				'updated_by ' => $_SESSION['id'],
				'created_on ' => date("Y-m-d H:i:s"),
				'updated_on ' => date("Y-m-d H:i:s"),
				//'update_date ' => date("Y-m-d"),
				);

				$result1 = $this->db->insert('rel_supplier_operation',$postDate);
			}
			

			$this->session->set_flashdata('createU', 'You have added supplier successfully.');
			redirect('/Supplier');

		}else
		 {
		 	$data['GetOperationsGroup'] = $this->GetQueryModel->GetOperationsGroup();

		 	$data['OperationGrp'] = $this->GetQueryModel->getOperationsGroups();
			$this->load->view('Supplier/add',$data);
		}
		
	}

	public function updateSupplier()
	{
	    $this->session->unset_userdata('createS');
	    // $this->form_validation->set_rules('txtEmail', 'Email Id', 'required|valid_email');
	    $this->form_validation->set_rules('txtName', 'Supplier Name*', 'required');
	//	$this->form_validation->set_rules('txtGSTNo', 'GST No', 'trim|required');
		$this->form_validation->set_rules('txttype', 'suppliers type', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
// 		$this->form_validation->set_rules('txtBankName', 'Bank Name', 'trim|required');
// 		$this->form_validation->set_rules('txtAccountNo', 'Account No', 'trim|required');
// 		$this->form_validation->set_rules('txtIFSCCode', 'IFSC Code', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {

			$txtContactPerson	 = $this->input->post('txtContactPerson');

			$txtContactNo 		 = $this->input->post('txtContactNo');
			$txtEmailID 		 = $this->input->post('txtEmailID');
			
			$countContact = count($txtContactPerson);

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
				'contact_person_details' => $ContactPersonsf,
				'name' => $this->input->post('txtName'),
				'gst_no' => $this->input->post('txtGSTNo'),
				'address' => $this->input->post('txtAddress'),
				'email_id' => $this->input->post('txtEmail'),
				'bankName' => $this->input->post('txtBankName'),
				'bank_acno' => $this->input->post('txtAccountNo'),
				'IFSCCode' => $this->input->post('txtIFSCCode'),
				'supl_type' => $this->input->post('txttype'),
				'supl_type' => $this->input->post('txttype'),
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d"),
				//'update_date ' => date("Y-m-d"),
				);

				$editId =$this->input->post('editId');
				
				$v=$this->db->where('id',$editId);
				$query=$this->db->update('mast_supplier',$postDate,$v);


				//delete supp rel operation

				$operationname 		 = $this->input->post('operation_name');

				if(!empty($operationname))
				{
								
					$this->db->where('supplier_id', $editId);
					$this->db-> delete('rel_supplier_operation');

					foreach ($operationname as $key => $values) 
					{
						$postDate = array(
							'supplier_id' => $editId,
							'op_id' => $values,
							'created_by ' => $_SESSION['id'],
							'updated_by ' => $_SESSION['id'],
							'created_on ' => date("Y-m-d"),
							'updated_on ' => date("Y-m-d"),
							//'update_date ' => date("Y-m-d"),
						);
						$result1 = $this->db->insert('rel_supplier_operation',$postDate);
					}
				}	

			redirect('/Supplier');

		}else
		 {
			$this->load->view('Supplier/add');
		}
	}

	public function deletesupRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->SupplierModel->deletesupRecord($postDate);
	}
	

}
