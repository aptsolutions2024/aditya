<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ManagementModel extends CI_Model
{
	public function getUsers()
	{
	 $query = $this->db->query("SELECT mu.* FROM mast_users mu left join rel_user_role relu on mu.id=relu.user_id where relu.role_id!='7' and mu.isdeleted=0 group by mu.id order by id desc");
	 $data = $query->result_array();
	 return $data;

	}	
	public function getOperators()
	{
	 $query = $this->db->query("SELECT mu.*,relu.branch_id FROM mast_users mu inner join rel_user_role relu on mu.id=relu.user_id where relu.role_id='7' and relu.isdeleted=0 and mu.isdeleted=0 order by mu.id desc");
	 $data = $query->result_array();
	 return $data;
	}
    public function getoperatorsById($id)
	{
	 $query = $this->db->query("SELECT mu.*,relu.branch_id FROM mast_users mu inner join rel_user_role relu on mu.id=relu.user_id where mu.id='$id' and relu.isdeleted=0 and mu.isdeleted=0");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getCompany()
	{
	 $query = $this->db->query("SELECT * FROM mast_company order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getUserRole($user_id)
	{
	 $query = $this->db->query("SELECT branch_id,role_id FROM rel_user_role where user_id='$user_id' and isdeleted=0");
	 $data = $query->result_array();
	 // echo $this->db->last_query(); die;
	 return $data;

	}
	public function getRole()
	{
	 $query = $this->db->query("SELECT * FROM mast_role  where id!=7 order by id ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRoleById($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_role where id='$id'");
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
		$result=$this->db->insert('mast_users',$postDate);
		return $insert_id = $this->db->insert_id();
	}
	function AddUserRole($RBpostDate)
	{
		$result=$this->db->insert('rel_user_role',$RBpostDate);
		return $insert_id = $this->db->insert_id();
	}
	function updateUser($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_users', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function updateUserbyMailid($postDate,$email){
	    	if($postDate && $email) {
			$this->db->where('email_id', $email);
			$update = $this->db->update('mast_users', $postDate);
		    return $this->db->affected_rows() > 0;
		}
	}
	
	function deleteRecord($postDate)
	{
	    $id=$_POST['editId'];
		
		$this->db->where("id",$id);
        $update = $this->db->update('mast_users', $postDate);
        
        $this->db->where("user_id",$id);
        $update = $this->db->update('rel_user_role', $postDate);
     
        return $update;
    }
	public function getBranch()
	{
	 $year=$_SESSION['current_year'];
	 $query = $this->db->query("SELECT id,name FROM mast_branch where current_year = '$year'  order by id ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getBranchbyIdBYName($bname)
	{
	    $bnames=trim($bname);
	 $query = $this->db->query("SELECT id FROM `mast_branch` WHERE `name` LIKE '$bnames'");
	 $data = $query->row_array();
	 return $data;

	}
	public function getBranchbyId($id)
	{
	  
	 $query = $this->db->query("SELECT id,name FROM mast_branch where id = ".$id);
	 $data = $query->row_array();
	 return $data;
	}
	public function getRolebyIdBYName($bname)
	{
	    $bnames=trim($bname);
	 $query = $this->db->query("SELECT id FROM `mast_role` WHERE `name` LIKE '$bnames'");
	 $data = $query->row_array();
	 return $data;

	}
	
	
	public function getUsersRole($userId)
	{
	 $query = $this->db->query("SELECT * FROM `mast_role` WHERE id NOT IN(SELECT `role_id` FROM rel_user_role where user_id='$userId' and isdeleted=0)");
	 $data = $query->result_array();
	 return $data;

	}
	public function getUsersBranch($userId)
	{
	 $query = $this->db->query("SELECT * FROM `mast_branch` WHERE id NOT IN(SELECT `branch_id` FROM rel_user_role where user_id='$userId' and isdeleted=0)");
	 $data = $query->result_array();
	 return $data;

	}
	public function getcountUserRoleBranch($userId,$roleid,$branchid)
	{
	 $query = $this->db->query("SELECT * FROM `rel_user_role` WHERE user_id='$userId' and branch_id='$branchid' and role_id='$roleid' and isdeleted=0");
	 $data = $query->num_rows();
	 return $data;

	}
	function updateUserRole($RBUpostDate,$editId,$roleid,$branchid)
	{
		if($RBUpostDate && $editId) {
			$array = array('user_id' => $editId, 'role_id' => $roleid, 'branch_id' => $branchid);
			$this->db->where($array); 
			$update = $this->db->update('rel_user_role', $RBUpostDate);
			return ($update == true) ? true : false;
		}

	}
	
	function cleardata(){

        // $this->db->truncate('tran_rmrcir_mast');
        // $this->db->truncate('tran_rmrcir_details');
        // $this->db->truncate('tran_rmrcir_stock');
    

    
         return $result;
	           
	}
	public function getLatestYear(){
    $query=$this->db->query("select year from tran_schedule order by year desc limit 1");
    $res = $query->row_array(); 
    return $res;
}
	function updateCompanydetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_company', $postDate);
			return ($update == true) ? true : false;
		}

	}
	
}