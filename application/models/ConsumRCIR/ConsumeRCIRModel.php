<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ConsumeRCIRModel extends CI_Model
{
	function AddCPOMast($postDate)
	{
		 $result=$this->db->insert('tran_consumpo_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddCPODetails($postDate)
	{
		 $result=$this->db->insert('tran_consumpo_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateCPODetails($updatepostDate,$mast_otherpo_id)
	{
		if($updatepostDate && $mast_otherpo_id) {
			$this->db->where('id', $mast_otherpo_id);
			$update = $this->db->update('tran_consumpo_details', $updatepostDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	function updateCOMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_consumpo_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}

	function deleteConsumDetails($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_consumpo_details', $postDate);
        return true;
    }


	
}

?>