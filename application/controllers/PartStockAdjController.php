<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PartStockAdjController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	//	$this->load->model('PartStockAdjustment/PartStockAdjModel');
		$this->load->model('getQuery/getQueryModel');
	}


	public function view()
	{
	    
          $data['partStockAdj'] 	= $this->getQueryModel->getTranPartStockAdjView(); 
          $this->load->view('PartStockAdj/view',$data);
    
    	
	}
	
public function add()
	{
        
            $this->form_validation->set_rules('Part_Search', 'part name', 'trim|required');
            $this->form_validation->set_rules('to_date', 'date', 'trim|required');
            $this->form_validation->set_rules('bstype', 'Branch/Suuplier', 'trim|required');
	    		
		    $this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		    $data['getBranch']        = $this->getQueryModel->getBranch();
    		if ($this->form_validation->run() == TRUE) {
    		            $bstype = $_POST['bstype']; 
    		            $pid = $_POST['Part_Id'];
    				    $data['getPartOpDet'] 	= $this->getQueryModel->getSupBranchByPart($pid,$bstype); 
                  		$this->load->view('PartStockAdj/addstock',$data);
    
    		}else{
    				$this->load->view('PartStockAdj/addstock',$data);
    		}
	
	}
	
	public function updatePartsStkAdj()
	{
	  // echo "<pre>";print_r($_POST); echo "</pre>";die;
	 	if(!empty($_POST['checkboxVal']))
		{
			foreach ($_POST['checkboxVal'] as $key => $value) 
			{
				$keys = $value;
				if($_POST['qty'][$keys]!="" && $_POST['qty'][$keys]!=0){
				$part_id 		= $_POST['partid'];
				$date           = $_POST['date']; 
				$op_id 			= $_POST['op_id'][$keys];
				$branch_id   	= $_POST['bsid'][$keys];
				$type   	    = $_POST['type'][$keys];
				$qty   		    = $_POST['qty'][$keys];
				$remarks   		= $_POST['remarks'][$keys];
				//$qty_in_kgs   	= $_POST['qty_in_kgs'][$keys];
				 
		       //$isavailable 	= $this->getQueryModel->getTranPartAdjQty($part_id,$op_id,$branch_id,$type,$date);
		      
		      //echo "***COUNT:-".$isavailable;
		      
			 /*if(!empty($isavailable['id'])){	
			     
                   $UpdateDate = array(
                    'qty' 		        => $qty,
                    'remarks'           => $remarks,
                    'qty_in_kgs' 	    => 0,
                    'updated_by' 		=> $_SESSION['id'],
                    'updated_on' 		=> date("Y-m-d"),
                    );
                    $this->db->where(array('part_id'=>$part_id ,'op_id'=>$op_id ,'date'=>$date));
                    if($type=='B'){ 
                                   
                        $result  = $this->db->query("update tran_partsrcir_details set qty='$qty' where id='$isavailable[det_partsrcir_id]'");
                        $result1 = $this->db->query("update tran_partsrcir_stock set received_qty='$qty' where det_partsrcir_id='$isavailable[det_partsrcir_id]' and received_doc_type='stock_adj'");
                     
                        $this->db->where('branch_id',$branch_id);
                    }else{          
                   
                        $result  = $this->db->query("update tran_dc_details set qty='$qty' where id='$isavailable[det_dc_id]'");
                        $result1 = $this->db->query("update tran_dc_stock set issue_qty='$qty' where det_dc_id='$isavailable[det_dc_id]' and issue_doc_type='stock_adj'");
                      
                        $this->db->where('supplier_id',$branch_id);
                    }
                    
                    $this->db->update('tran_part_stockadj',$UpdateDate);
                  
                  
			  }
			  else{*/
			      
			       $UpdateDate = array(
                    'date' 			=> $date,
                    'year'          => $_SESSION['current_year'],
                    'branch_id' 	=> ($type=='B')?$branch_id:"",
                    'supplier_id' 	=> ($type=='S')?$branch_id:"",
                    'part_id' 	    => $part_id,
                    'op_id' 	    => $op_id,
                    'qty' 		    => $qty,
                    'qty_in_kgs' 	=> 0,
                    'remarks'       => $remarks,
                    'created_by' 	=> $_SESSION['id'],
                    'created_on' 	=> date("Y-m-d H:i:s"),
                    );
                    
                    $resid=$this->db->insert('tran_part_stockadj',$UpdateDate);
                    $newStkAdjId=$this->db->insert_id();
                    
                if($newStkAdjId){
                   
                         // Stock adj ID - 8
                    if($type=='B'){
                         //Branch-If quantity!=0 then tran_partsrcir_mast/tran_partsrcir_details/tran_partsrcir_stock
                        if($qty != 0 && $qty != ""){
                              
                                $move_from="B".$branch_id;
                                $move_to = "B".$branch_id;
                                $this->insertIntoPartsRCIR($newStkAdjId,$part_id,$op_id,$date,$qty,$move_from,$move_to,$branch_id);
                                
                        }
                        
                    }elseif($type=='S'){
                             //Supplier-If quantity!=0 then tran_dc_mast/tran_dc_details/tran_dc_stock
                        $supl_id=$branch_id;
                        if($qty != 0  && $qty != ""){
                     
                              $move_from="B8";
                              $move_to = "S".$supl_id;
                             $this->insertIntoDCStock($newStkAdjId,$part_id,$op_id,$date,$qty,$move_from,$move_to,$supl_id);     
                        }
                    }
                  
                   
                    
			  }  // if($newStkAdjId) 
                    
                    
			 //}  //else for new stock adj entry
			

		   }  //if($_POST['qty'][$keys]!="" && $_POST['qty_in_kgs'][$keys]!="")
		   
  	}  //Foreach checkbox value
  	
	    	 redirect('/addPartStkAdjustment');
	    	 
		}else{
		    
		    redirect('/addPartStkAdjustment');
		    
		}
	}
	public function insertIntoDCStock($newStkAdjId,$part_id,$op_id,$date,$qty,$move_from,$move_to,$supl_id){
	    	$postDate = array(
	    	    		        'branch_id ' 		=> $_SESSION['branch_id'],
                				'supplier_id' 		=> $supl_id,
                				'date' 				=> $date,
                				'year'				=> $_SESSION['current_year'],
                				'dc_no' 			=> 'stock_adj',
                				'created_by ' 		=> $_SESSION['id'],
                				'created_on ' 		=> date("Y-m-d H:i:s"),
                				);
                				
                		$resid1=$this->db->insert('tran_dc_mast',$postDate);
                        $mast_dc_id=$this->db->insert_id();
                            
                        $postDetails = array(
            				'mast_dc_id' 	    => $mast_dc_id,
            				'part_id' 			=> $part_id,
            				'op_id' 			=> $op_id,
            				'qty_in_kgs' 		=> 0,
            				'qty' 				=> $qty,
            				'parts_po_det_id' 	=> 0,
            				'created_by ' 		=> $_SESSION['id'],
            				'created_on ' 		=> date("Y-m-d H:i:s"),
            				'remarks'           =>'stock_adj',
            				);
            		
            				$resid2=$this->db->insert('tran_dc_details',$postDetails);
                            $det_dc_id=$this->db->insert_id();
                            
                    // $det_partsrcir_id for issue_doc_id	
        		     $postStockDetails1 = array(
        				'mast_dc_id'  	     => $mast_dc_id,
        				'det_dc_id' 	     => $det_dc_id,
        				'part_id' 		     => $part_id,
        				'op_id' 		     => $op_id,
        				'year' 			     => $_SESSION['current_year'],
        				'doc_year' 		     => $_SESSION['current_year'],
        				'tran_date'          => $date,
        				'issue_qty' 	     => $qty,
        				'issue_doc_type'     => 'stock_adj',
        				'issue_doc_id'       => $newStkAdjId,
        				'branch_id'          => $_SESSION['branch_id'],
        				'move_from'          => $move_from,
        				'move_to'            => $move_to,
        				'created_by ' 	     => $_SESSION['id'],
        				'created_on ' 	     => date("Y-m-d H:i:s"),
        				);
        		     $resid2=$this->db->insert('tran_dc_stock',$postStockDetails1);
        		   	$result = $this->db->query("update tran_part_stockadj set det_dc_id='$det_dc_id' where id='$newStkAdjId'");
	}
	
	public function insertIntoPartsRCIR($newStkAdjId,$part_id,$op_id,$date,$qty,$move_from,$move_to,$branch_id){
	  
                        	$postDate = array(
                            				'branch_id' 	=> $branch_id,
                                            'supplier_id' 	=> 0,
                            				'date'			=> $date,
                            				'year'			=> $_SESSION['current_year'],
                            				'challan_date' 	=> $date,
                            				'challan_no' 	=> 'stock_adj',
                            				'created_by ' 	=> $_SESSION['id'],
                            				'created_on ' 	=> date("Y-m-d H:i:s"),
                            				);
			              $resid1=$this->db->insert('tran_partsrcir_mast',$postDate);
                          $mast_partsrcir_id=$this->db->insert_id();
                          
			              $postDetails = array(
                            				'mast_partsrcir_id' 	=> $mast_partsrcir_id,
                            				'tran_partspo_det_id' 	=> 0,
                            				'dc_det_id' 	        => 0,
                            				'part_id' 			    => $part_id,
                            				'op_id' 		        => $op_id,
                            				'qty' 				    => $qty,
                            				'qty_in_kgs' 		    => 0,
                            				'inprocess_loss_qty' 	=> 0,
                            				'qc_checked_by'         => '999999',
                            				'qc_remarks'            =>'stock_adj',
                            				'qc_checked_on'         => date("Y-m-d H:i:s"),
                            				'year ' 		        => $_SESSION['current_year'],
                            				'created_by ' 		    => $_SESSION['id'],
                            				'created_on ' 		    => date("Y-m-d H:i:s"),
                            				);
				     
				              $resid2=$this->db->insert('tran_partsrcir_details',$postDetails);
                              $det_partsrcir_id=$this->db->insert_id();
                          
						      $UpdateDate68 = array(
        									'part_id' 			    => $part_id,
        									'op_id' 		        => $op_id,
        									'mast_partsrcir_id' 	=> $mast_partsrcir_id,
        									'det_partsrcir_id' 	    => $det_partsrcir_id,
        						            'year' 				    => $_SESSION['current_year'],
        						            'doc_year' 			    => $_SESSION['current_year'],
        						            'tran_date'             => $date,
        									'branch_id' 	    	=> $branch_id,
        									'move_from'             => $move_from,
        				                    'move_to'               => $move_to,
        				                    'received_qty' 		    => $qty,
        									'received_doc_id' 		=> $newStkAdjId,
        									'received_doc_type' 	=> 'stock_adj',
        									'created_by' 		    => $_SESSION['id'],
        									'created_on ' 		    => date("Y-m-d H:i:s"),
								    );
						$result16 = $this->db->insert('tran_partsrcir_stock',$UpdateDate68);
						
						$result = $this->db->query("update tran_part_stockadj set det_partsrcir_id='$det_partsrcir_id' where id='$newStkAdjId'");
						
	}



	
}

?>