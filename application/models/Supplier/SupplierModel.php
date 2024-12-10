<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SupplierModel extends CI_Model
{
	public function getSuppliers($type=null)
	{
		if($type == 0)
		{
	 		$query = $this->db->query("SELECT * FROM mast_supplier where isdeleted=0 order by id desc");
		}else{
				$query = $this->db->query("SELECT * FROM mast_supplier where supl_type = $type and isdeleted=0 order by id desc");
		}
	 $data = $query->result_array();
	 return $data;

	}
	function deletesupRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('mast_supplier', $postDate);
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
	public function getsupplierByid($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_supplier where id='$id'");
	 $data = $query->row_array();
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