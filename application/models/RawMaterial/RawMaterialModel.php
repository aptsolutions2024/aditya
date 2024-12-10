<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RawMaterialModel extends CI_Model
{
	
	function AddRawMaterial($postDate)
	{
		return $result=$this->db->insert('mast_rm',$postDate);
	}
	function updateRawMaterial($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('rm_id', $editId);
			$update = $this->db->update('mast_rm', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function deleteRMRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("rm_id",$id);
        $update = $this->db->update('mast_rm', $postDate);
        return true;
    }


	
}

?>