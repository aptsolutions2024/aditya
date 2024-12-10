<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OtherPoModel extends CI_Model
{
	function AddLOMast($postDate)
	{
		 $result=$this->db->insert('tran_partspo_mast',$postDate);
		 //	echo $this->db->last_query(); die;
		 return $insert_id = $this->db->insert_id();
	}
	function AddOPDetails($postDate)
	{
		 $result=$this->db->insert('tran_partspo_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateLPODetails($updatepostDate,$mast_partspo_id)
	{
		if($updatepostDate && $mast_partspo_id) {
			$this->db->where('id', $mast_partspo_id);
			$update = $this->db->update('tran_partspo_details', $updatepostDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	function updateLOMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_partspo_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}

	function deleteOtherDetails($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_partspo_details', $postDate);
        return true;
    }


	
}

?>