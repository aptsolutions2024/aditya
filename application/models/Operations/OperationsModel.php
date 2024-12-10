<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OperationsModel extends CI_Model
{
	function AddOperations($postDate)
	{
		 $result=$this->db->insert('mast_operation',$postDate);
		 return $insert_id = $this->db->insert_id();
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
	function deleteOptsRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('mast_operation', $postDate);
        return true;
    }
	
/*	function updateReOpts()
	{
		$checkedvals=$_POST['checkedvals'];
		$part1 = explode(",", $checkedvals);

		foreach($part1 as $row)
		{
			$pt2 = explode("#", $row);
			$id 		= $pt2[0];
			$nosperkg 	= $pt2[1];
			$nosperhour = $pt2[2];
			$tool_id1 	= $pt2[3];
			$tool_id2 	= $pt2[4];

			$postDate = array(
				'nosperkg' => $nosperkg,
				'nosperhour' => $nosperhour,
				'tool_id1' => $tool_id1,
				'tool_id2' => $tool_id2,
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d"),
				);

			$this->db->where('id', $id);
			$update = $this->db->update('rel_part_operation', $postDate);
			

		}
		return ($update == true) ? true : false;

	}*/
		function updateReOpts()
	{
		$checkedvals=$_POST['checkedvals'];		
		$part1 = explode(",", $checkedvals);
		print_r($part1);
		foreach($part1 as $row)
		{
			$pt2 = explode("#", $row);
			echo "<br><pre>";	print_r($pt2);	echo "</pre>";
			$id 		= $pt2[0];
			$nosperkg 	= $pt2[1];
			$nosperhour = $pt2[2];
			$tool_id1 	= $pt2[3];
			$tool_id2 	= $pt2[4];


			$postDate = array(
				'nosperkg' => $nosperkg,
				'nosperhour' => $nosperhour,
				'tool_id1' => $tool_id1,
				'tool_id2' => $tool_id2,
				'updated_by ' => $_SESSION['id'],
				'updated_on ' => date("Y-m-d H:i:s"),
				);

			$this->db->where('id', $id);
			$update = $this->db->update('rel_part_operation', $postDate);



        //start of Part Opening Balance insert and update 
			$part_id=$_POST['part_id'];
			$Op_Id = $pt2[6];
			$doc_year = $_SESSION['current_year'];
			$received_qty = $pt2[5];			
			$received_doc_id=0;
			$received_doc_type='O.B.';
			$array = array('part_id' => $part_id, 'op_id' => $Op_Id, 'year' => $doc_year,'received_doc_type'=>$received_doc_type ,'branch_id'=>$_SESSION['branch_id']);
							$this->db->where($array);    
							$q = $this->db->get('tran_partsrcir_stock');
							 echo "<br>". $this->db->last_query(); 
                       echo "<br>NOfRows:".$q->num_rows();
							if ( $q->num_rows() > 0 ) 
							{
							    echo "<br>IN IF";
							    $update_data = array('received_qty' => $received_qty,'updated_by'=> $_SESSION['id'],'updated_on'=> date("Y-m-d H:i:s"));
							    $this->db->where($array);
	                            $update = $this->db->update('tran_partsrcir_stock', $update_data);
	                            $data = $q->row_array();  
	                            echo "<br>". $this->db->last_query(); 
	                            
                                $update_data1 = array('qty' => $received_qty,'updated_by'=> $_SESSION['id'],'updated_on'=> date("Y-m-d H:i:s"));  
	                            $this->db->where(array('id' => $data['det_partsrcir_id']));
	                            $update = $this->db->update('tran_partsrcir_details', $update_data1);
                                 echo "</br>Updated-".$update;
							} else {
							    echo "<br>IN ELSE";
							    	$postDate = array(
                                        				'supplier_id' 		=> '0',
                                        				'branch_id'			=> $_SESSION['branch_id'],
                                        				'date'			    => date("Y-m-d"),
                                        				'year'				=> $_SESSION['current_year'],
                                        				'challan_date' 		=> '-',
                                        				'challan_no' 	    => '-',
                                        				'created_by' 		=> $_SESSION['id'],
                                        				'created_on' 		=> date("Y-m-d H:i:s"),
                                        				);
                                        				
                                    $mast_partsrcir_id  =  $this->PRCIRModel->AddTranRcirMast($postDate);
                                     echo "<br>". $this->db->last_query(); 
                                        echo "<br>MAst ID-".$mast_partsrcir_id;			
                				     $postDetails = array(
                                    				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
                                    				'tran_partspo_det_id' 	=> 0,
                                    				'part_id' 			    => $part_id,
                                    				'op_id' 		        => $Op_Id,
                                    				'year' 				    => $_SESSION['current_year'],
                                    				'qty' 				    => $received_qty,
                                    				'supp_schedule_id' 		=> 0,
                                    				//'dc_det_id' 		    => $dc_det_id,
                                    				'created_by' 		    => $_SESSION['id'],
                                    				'created_on' 		    => date("Y-m-d H:i:s"),
                                    				);
                
                				$det_partsrcir_id = $this->PRCIRModel->AddTranRcirDetails($postDetails);
                				 echo "<br>". $this->db->last_query(); 
	                            echo "<br>Det ID-".$det_partsrcir_id;	
								$add = array(
					                			    	'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        				                                'det_partsrcir_id' 	    => $det_partsrcir_id,
        												'part_id' 			    => $part_id,
														'op_id' 		        => $Op_Id,
										                'year' 				    => $_SESSION['current_year'],
										                'doc_year' 			    => $doc_year,
										                'tran_date'			    => date("Y-m-d"),
														'branch_id' 	    	=> $_SESSION['branch_id'],
														'created_by' 		    => $_SESSION['id'],
														'created_on' 		    => date("Y-m-d H:i:s"),
														'received_doc_id' 	    => $received_doc_id,
														'received_qty' 	        => $received_qty,
														'received_doc_type'     => $received_doc_type
										    );
										    
								$result16 = $this->db->insert('tran_partsrcir_stock',$add);
								 echo "<br>". $this->db->last_query(); 
								  echo "<br>Stock ID-".$result16;

							}	//end of Part Opening Balance 


			

		}
		return ($update == true) ? true : false;

	}
	public function getOperationsGroupsbyId($id)
	{
		 $query = $this->db->query("SELECT `id`,`name` FROM mast_op_group  where id = $id");
		 $data = $query->row_array();
		 return $data;
	}


	
}

?>