<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MachineModel extends CI_Model
{
	function AddMachine($postDate)
	{
		 $result=$this->db->insert('mast_machines',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function updateMachine($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_machines', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	
}

?>