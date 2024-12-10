<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PartsModel extends CI_Model
{
	function AddParts($postDate)
	{
		 $result=$this->db->insert('mast_part',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddPartsStock($PartsStockDate)
	{
		 $result=$this->db->insert('part_stock',$PartsStockDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddPartsRM($postDate)
	{
		 $result=$this->db->insert('rel_part_rm',$postDate);
		 //echo $this->db->last_query(); die;
		 return $insert_id = $this->db->insert_id();
	}
	function AddPartsOpts($postDate)
	{
		 $result=$this->db->insert('rel_part_operation',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddPartsQC($postDate)
	{
		 $result=$this->db->insert('rel_part_qc',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	/*public function getrmById($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_rm where rm_id='$id'");
	 $data = $query->row_array();
	 return $data;

	}*/
	function updateParts($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('part_id', $editId);
			$update = $this->db->update('mast_part', $postDate);
			return ($update == true) ? true : false;
		}
	}
	
	function updatePartsRM($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('rel_part_rm', $postDate);
			//echo $this->db->last_query(); 
			return ($update == true) ? true : false;
		}

	}
	function updatePartsOpts($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('rel_part_operation', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function updatePartsQC($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('ID', $editId);
			$update = $this->db->update('rel_part_qc', $postDate);
			//echo $this->db->last_query(); die;
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





    function updateIsdeletedbyPart($partId)
	{
		$postDate = array('isdeleted'=> 1);
		if($partId) {
			$this->db->where('part_id', $partId);
			$update = $this->db->update('rel_part_operation', $postDate);
			return ($update == true) ? true : false;
		}
	}

	public function checkPartOperationnew($optId,$partId)
	{

	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `sequence_no` FROM `rel_part_operation` WHERE part_id='$partId' and op_id='$optId' ");
	 $data = $query->row_array();
	 return $data;

	}

  function updateIsdeletedbyPartRM($partId)
	{
	    //	update rel_part_rm set isdeleted=1 where part_id=193 and assembly_part_id>0
		$postDate = array('isdeleted'=> 1,'updated_by'=>$_SESSION['id'],'updated_on'=>date("Y-m-d H:i:s"));
		if($partId) {
			$this->db->where('part_id', $partId);
			$this->db->where('assembly_part_id >' , 0);
			$update = $this->db->update('rel_part_rm', $postDate);
			return ($update == true) ? true : false;
		}
	}
	 function updateIsdeletedbyPartAssembly($partId)
	{
	    //update rel_part_rm set isdeleted=1 where part_id=193 and rm_id>0
		$postDate = array('isdeleted'=> 1,'updated_by'=>$_SESSION['id'],'updated_on'=>date("Y-m-d H:i:s"));
		if($partId) {
			$this->db->where('part_id', $partId);
			$this->db->where('rm_id >' , 0);
			$update = $this->db->update('rel_part_rm', $postDate);
			return ($update == true) ? true : false;
		}
	}
}

?>