<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginModel extends CI_Model
{
	public function login($username,$password)
	{
	 $query = $this->db->query("SELECT * FROM mast_users where username='$username' and psw='$password' and isdeleted=0");
	 $data = $query->row_array();
	 return $data;

	}public function getCurrentYear($branchId)
	{
	 $query = $this->db->query("SELECT current_year FROM mast_branch where id='$branchId'");
	 $data = $query->row_array();
	 return $data;

	}
	public function GetCompanyNmbyId($id)
	{
	 $query = $this->db->query("SELECT `id`, `name` from mast_company where id= '$id' ");
	 
	 $data = $query->row_array();
	 return $data;

	}
	
	
}