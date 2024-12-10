<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ToolsModel extends CI_Model
{
	function addTool($postDate)
	{
		 $result=$this->db->insert('mast_tools',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function updateTool($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('mast_tools', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	
	function deleteToolRec($id){
	  
        $query = $this->db->query("SELECT `tool_id1`,part_id FROM `rel_part_operation` where `tool_id1` = '$id' and isdeleted = 0;");
        $data = $query->row_array(); 
        
        $query1 = $this->db->query("SELECT `tool_id2`,part_id FROM `rel_part_operation` where `tool_id2` = '$id' and isdeleted = 0;");
        $data1 = $query1->row_array(); 
        
        $query2 = $this->db->query("SELECT `tool_id`,part_id,dpr_date FROM `tran_dpr` where `tool_id` = '$id' and isdeleted = 0;");
        $data2 = $query1->row_array();  
	 
	  if(!empty($data['tool_id1'])){
	      
	     echo "Tool is already used as Tool_Id1 for Part-Id : ".$data['part_id'];
	     
	  }elseif(!empty($data1['tool_id2']))
	  {
	       echo "Tool is already used as Tool_Id2 for Part-Id : ".$data1['part_id'];
	      
	  }elseif(!empty($data2['tool_id'])){
	      
	       echo "Tool is already used in DPR for Part-Id : ".$data2['part_id']."  On This Date : ".$data2['dpr_date'];
	       
	  }else{
	        $this->db->where('id', $id);
             $res=$this-> db->delete('mast_tools');
            if($res){
                 echo "Record deleted successfully.."; 
            }else{
                 echo "Error while deleting the record..";   
            }
	  }
	   
     
      
	}
	
	function addTrantool($postDate)
	{
		 $result=$this->db->insert('tran_tools',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function updateTrantool($postDate,$editId){
    	$this->db->where('id', $editId);
		return $update = $this->db->update('tran_tools', $postDate);
	}
	function deleteTrantoolRec($id){
      $this->db->where('id', $id);
      return $res=$this-> db->delete('tran_tools');
	}
	
   }