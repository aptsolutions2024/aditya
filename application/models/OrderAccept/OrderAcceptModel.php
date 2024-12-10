<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderAcceptModel extends CI_Model
{
	function AddOAMast($postDate)
	{
		 $result=$this->db->insert('tran_oa_mast',$postDate);
		 //echo $this->db->last_query(); die;
		 return $insert_id = $this->db->insert_id();
	}
	function AddOADetails($postDate)
	{
		 $result=$this->db->insert('tran_oa_details',$postDate);
		 //echo $this->db->last_query(); die;
		 return $insert_id = $this->db->insert_id();
	}

	
	function updateOAMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_oa_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	function updateOADetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_oa_details', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	function UpdateOperations($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_operation', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	function deleteOARecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_oa_mast', $postDate);
        //echo $this->db->last_query(); die;
        return true;
    }
    
	public function checkPono()
	{
        $pnno = $_POST['val'];
        $query = $this->db->query("SELECT id FROM `tran_oa_mast` where cust_pono='$pnno' ");
        $data = $query->row_array();
        return $data;

	}


	
}

?>