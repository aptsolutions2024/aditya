<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QualityChecksModel extends CI_Model
{
	public function getQualityChecks()
	{
	 $query = $this->db->query("SELECT * FROM mast_quality_checks where isdeleted=0 order by id  desc");
	 $data = $query->result_array();
	 
	 return $data;

	}
	function AddQualityChecks($postDate)
	{
		return $result=$this->db->insert('mast_quality_checks',$postDate);
	}
	public function getQCById($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_quality_checks where id='$id'");
	 $data = $query->row_array();
	 return $data;

	}function updateQualityChecks($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_quality_checks', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function deleteQCRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('mast_quality_checks', $postDate);
        return true;
    }


	
}

?>