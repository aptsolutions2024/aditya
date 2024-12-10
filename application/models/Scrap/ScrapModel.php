<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ScrapModel extends CI_Model
{
    
    function AddScrap($postDate)
	{
		 $result=$this->db->insert('scrap_stock',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
}