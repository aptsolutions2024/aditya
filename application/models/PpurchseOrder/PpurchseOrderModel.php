<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PpurchseOrderModel extends CI_Model
{
	function AddLOMast($postDate)
	{
		 $result=$this->db->insert('tran_labourPO_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddOPDetails($postDate)
	{
		 $result=$this->db->insert('tran_labourPO_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateLPODetails($updatepostDate,$mast_labourPO_id)
	{
		if($updatepostDate && $mast_labourPO_id) {
			$this->db->where('id', $mast_labourPO_id);
			$update = $this->db->update('tran_labourPO_details', $updatepostDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	function updateLOMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_labourPO_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}

	function deleteLabourDetails($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_labourPO_details', $postDate);
        return true;
    }


	
}

?>