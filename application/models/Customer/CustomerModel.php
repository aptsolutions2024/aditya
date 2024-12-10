<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerModel extends CI_Model
{
	public function getCustomers()
	{
	 $query = $this->db->query("SELECT * FROM mast_customer where isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getCustomersbyid($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_customer where id=".$id);
	 $data = $query->row_array();
	 return $data;

	}
	public function getconsigneebyid($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_consignee where cust_id=".$id);
	 $data = $query->result_array();
	 return $data;

	}
	function deleteCustRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('mast_customer', $postDate);
        return true;
    }



	public function getCompany()
	{
	 $query = $this->db->query("SELECT * FROM mast_company order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRole()
	{
	 $query = $this->db->query("SELECT * FROM mast_role  order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getuserById($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_users where id='$id'");
	 $data = $query->row_array();
	 return $data;

	}
	function AddUser($postDate)
	{
		return $result=$this->db->insert('mast_users',$postDate);
	}
	function updateUser($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_users', $postDate);
			return ($update == true) ? true : false;
		}

	}
	
	
}