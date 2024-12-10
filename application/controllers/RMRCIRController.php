<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class RMRCIRController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('RMRCIR/RMRCIRModel');
		$this->load->model('getQuery/GetQueryModel');
	}


	public function RMRCIR()
	{
	        
		    $data['getRMRCIR'] = $this->GetQueryModel->getRMRCIR();
		    
	    	$this->load->view('RMRCIR/view',$data);
	
	}
	public function RMRCIRDetailsStock(){
	    $id = base64_decode($_GET['ID']);
	    $data['getRMRCIRDetailsStock'] = $this->GetQueryModel->getRMRCIRDetailsStock($id);
	    $data['rmstockAdjustDet']= $this->GetQueryModel->rmstockAdjustDet($id);
		$this->load->view('RMRCIR/rmrcirDetailStock',$data);
	}
	
public function RMStockAdjustment(){
	    //error_reporting(0);
	    if(empty($_POST['editid'])){
	    $mast_rmrcir_id=$_POST['mast_rmrcir_id'];
	    $det_rmrcir_id=$_POST['det_rmrcir_id'];
	    $tran_rmpo_det_id=$_POST['tran_rmpo_det_id'];
	    $rm_id=$_POST['rm_id'];
	    $issue_qty=($_POST['issue_qty'])?$_POST['issue_qty']:0;
	   // $received_qty=($_POST['received_qty'])?$_POST['received_qty']:0;
	    $rejected_qty=($_POST['rejected_qty'])?$_POST['rejected_qty']:0;
	    $doc_type="stock_adj";
	    
			$postStockDetails = array(
        				'mast_rmrcir_id' 	    => $mast_rmrcir_id,
        				'det_rmrcir_id' 	    => $det_rmrcir_id,
        				'tran_rmpo_det_id' 	    => $tran_rmpo_det_id,
        		    	'rm_id' 			    => $rm_id,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date'             => $_POST['date'],
        				// 'issue_qty' 			=> $issue_qty,
        				// 'issue_doc_type' 	    => $doc_type,
        				// 'issue_doc_id' 	        => $det_rmrcir_id,
        				'received_qty' 		    => $issue_qty,
        				'received_doc_type' 	=> $doc_type,
        				'received_doc_id' 	    => $det_rmrcir_id,
        				'rejected_qty' 			=> $rejected_qty,
        				'rejected_doc_type' 	=> $doc_type,
        				'rejected_doc_id' 	    => $det_rmrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);
        				
        	$insertid=	$this->RMRCIRModel->AddRMTranRcirStock($postStockDetails);
        	
                	if($insertid){
                	    if($rejected_qty>0){
                	    	$UpdateDate2f = array(
						    	    'prod_plan_id'     =>0,
									'year' 		        => $_SESSION['current_year'],
									'date'              => $_POST['date'],
									'rm_id' 		    => $rm_id,
									'received_qty' 	    => $rejected_qty,
									'received_doc_type' => $doc_type,
									'received_doc_id' 	=> $det_rmrcir_id,
									'branch_id' 		=> $_SESSION['branch_id'],
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
                                    'created_on' 		=> date("Y-m-d H:i:s"),
									'created_by' 		=> $_SESSION['id']
								);
									$result16s = $this->db->insert('scrap_stock',$UpdateDate2f);
    					     	$result16sId=$this->db->insert_id();
                	    }
                            echo '<script language="javascript">';
                            echo 'alert("Record Inserted Successfully.");';
                            echo 'window.location.replace("'.base_url().'RMRCIRDetailsStock?ID='.base64_encode($det_rmrcir_id).'");';
                            echo '</script>';
                	}else{
                	 
                            echo '<script language="javascript">';
                            echo 'alert("Something wrong happened when inserting record");';
                            echo 'window.location.replace("'.base_url().'RMRCIRDetailsStock?ID='.base64_encode($det_rmrcir_id).'");';
                            echo '</script>';
                	}
	    }else{
	       
	         $editid=$_POST['editid'];
	         $det_rmrcir_id=$_POST['det_rmrcir_id'];
	         $issue_qty=($_POST['issue_qty'])?$_POST['issue_qty']:0;
	        // $received_qty=($_POST['received_qty'])?$_POST['received_qty']:0;
	         $rejected_qty=($_POST['rejected_qty'])?$_POST['rejected_qty']:0;
	         
	        $updateStock=array(
                    	       //   'issue_qty'       =>$issue_qty,
                    	          'received_qty'    =>$issue_qty,
                    	          'rejected_qty'    =>$rejected_qty,
                    	          'updated_by ' 	=> $_SESSION['id'],
                            	  'updated_on ' 	=> date("Y-m-d H:i:s"),
	                          );
        					         $where=array('id'=>$editid);
        					         $res = $this->db->update('tran_rmrcir_stock',$updateStock,$where);
        					         
        					  //update scrap stock
        					
        					  	$data  = $this->GetQueryModel->getScrapStockbyID('stock_adj',$det_rmrcir_id);
        					  	
        				if(isset($data['id'])){
                        	    	$UpdateDate2f = array(
        									'received_qty' 	    => $rejected_qty,
                                            'updated_on' 		=> date("Y-m-d H:i:s"),
        									'updated_by' 		=> $_SESSION['id']
        								);
								          $where=array('id'=>$data['id']);
									      $res = $this->db->update('scrap_stock',$UpdateDate2f,$where);
                	    }else{
                	        	$UpdateDate2f2 = array(
						    	    'prod_plan_id'      => 0,
									'year' 		        => $_SESSION['current_year'],
									'date'              => $_POST['date'],
									'rm_id' 		    => $_POST['rm_id'],
									'received_qty' 	    => $rejected_qty,
									'received_doc_type' => 'stock_adj',
									'received_doc_id' 	=> $det_rmrcir_id,
									'branch_id' 		=> $_SESSION['branch_id'],
                                    'created_on' 		=> date("Y-m-d H:i:s"),
									'created_by' 		=> $_SESSION['id']
								);
									$result16s = $this->db->insert('scrap_stock',$UpdateDate2f2);
                	     }
        					         
        				
        					         if($res){
        					            echo '<script language="javascript">';
                                        echo 'alert("Record Updated Successfully.");';
                                        echo 'window.location.replace("'.base_url().'RMRCIRDetailsStock?ID='.base64_encode($det_rmrcir_id).'");';
                                        echo '</script>';
        					           // redirect(base_url().'RMRCIRDetailsStock?ID='.base64_encode($det_rmrcir_id));
        					                   
        					                    
        					         }else{
        	                            echo '<script language="javascript">';
                                        echo 'alert("Something wrong happened when updating record..");';
                                        echo 'window.location.replace("'.base_url().'RMRCIRDetailsStock?ID='.base64_encode($det_rmrcir_id).'");';
                                        echo '</script>';
        					         }
	    }
        	
	    
	}
	public function addRMRCIR()
	{
	    
		$id = base64_decode($_GET['ID']);
		$data['Supplier']   = $this->GetQueryModel->getSupplier(1);
		$data['getRMRCIRMast']   = $this->GetQueryModel->getRMRCIRMastByID($id);
		$data['getRMRCIRDetails']   = $this->GetQueryModel->getRMRCIRDetailsByID($id);
		
		$this->load->view('RMRCIR/add',$data);
	}
	
	public function createRMRCIR()
	{
		//echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
            if(!empty($_POST['checkboxVal']))
		    {
			$postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
			    $mast_rmrcir_id  =  $this->RMRCIRModel->AddRMTranRcirMast($postDate);
			
			   
			    $this->addRmRcirDetails($mast_rmrcir_id);

        		redirect(base_url('RMRCIR'));	

		}else
		 {
		    $this->session->set_flashdata('oamsg', 'RM RCIR Details should be mandatory!');
			$this->addRMRCIR();
		}
		    
		}else
		 {
			$this->addRMRCIR();
		}
		
	}
	
	
	public function addRmRcirDetails ($mast_rmrcir_id)
	{
	    
			
			
    			foreach ($_POST['checkboxVal'] as $key => $value) 
    			{
    			   // print_r($value);die;
    			    $keys       =  array_search($value,$_POST['tran_rmpo_det_id'],true);
    			    $tran_rmpo_det_id	= $_POST['tran_rmpo_det_id'][$keys];
    			    $rm_id          	= $_POST['rm_id'][$keys];
    			    $ordered_qty        = $_POST['ordered_qty'][$keys];
                    $rec_qty        	= $_POST['rec_qty'][$keys];
                    $bal_qty        	= $_POST['bal_qty'][$keys];
                    $rcir_qty           = $_POST['rcir_qty'][$keys];
                    $open_status        = $_POST['open'][$keys];
                    $postDetails = array(
        				'mast_rmrcir_id' 	    => $mast_rmrcir_id,
        				'tran_rmpo_det_id' 	    => $tran_rmpo_det_id,
        				'rm_id' 			    => $rm_id,
        				'year' 				    => $_SESSION['current_year'],
        				'qty' 				    => $rcir_qty,
        				'open_status'           =>  $open_status,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);
           //print_r($postDetails);die;
			$det_rmrcir_id = $this->RMRCIRModel->AddRMTranRcirDetails($postDetails);
			


                    $postDate = array(
        				'open_status' 	    => ($open_status)?'1':'0',
        				);

			$det_rmrcir_id1 = $this->RMRCIRModel->updatetranPODetails($postDate,$tran_rmpo_det_id);


			$postStockDetails = array(
        				'mast_rmrcir_id' 	    => $mast_rmrcir_id,
        				'det_rmrcir_id' 	    => $det_rmrcir_id,
        				'tran_rmpo_det_id' 	    => $tran_rmpo_det_id,
        		    	'rm_id' 			    => $rm_id,
        				'branch_id'			    => $_SESSION['branch_id'],
        				'move_from'             => "S".$this->input->post('supplierId'),
        				'move_to'               => "B".$_SESSION['branch_id'],
        				'year' 				    => $_SESSION['current_year'],
        				'doc_year' 				=> $_SESSION['current_year'],
        				'tran_date'			    => $this->input->post('date'),
        				'received_qty' 			=> $rcir_qty,
        				'received_doc_type' 	=> 'rm_rcir',
        				'received_doc_id' 	    => $det_rmrcir_id,
        				'created_by ' 		    => $_SESSION['id'],
        				'created_on ' 		    => date("Y-m-d H:i:s"),
        				);
        				
        		$this->RMRCIRModel->AddRMTranRcirStock($postStockDetails);
			  
                $query = $this->db->query("SELECT prod_plan_id,plan_req_qty from tran_requisition WHERE tran_po_id='$tran_rmpo_det_id'");
                $data = $query->result_array();
                   $rcir_qty= $_POST['rcir_qty'][$keys];
                 
                    foreach($data as $rows)
                    {
                          
			           $query1="select sum(booked_qty) as already_booked_qty from tran_rmrcir_stock where booked_doc_type='prod_plan' and booked_doc_id=".$rows['prod_plan_id'];
                       $Sumofbooked = $this->db->query($query1);
                       $data1 = $Sumofbooked->row_array();
                       $newQty=($data1['already_booked_qty'])?($rows['plan_req_qty']-$data1['already_booked_qty']):$rows['plan_req_qty'];
                
                        $bookedQty = ($newQty > $rcir_qty) ? $rcir_qty : $newQty;
                          //echo "Already Booked:".$data1['already_booked_qty']." NewQTY".$newQty." B QTY".$bookedQty;
                        $rcir_qty = $rcir_qty-$bookedQty;
                       
                        if($bookedQty>0){
        			    $postStockDetails = array(
                				'mast_rmrcir_id' 	    => $mast_rmrcir_id,
                				'det_rmrcir_id' 	    => $det_rmrcir_id,
                				'tran_rmpo_det_id' 	    => $tran_rmpo_det_id,
        		            	'branch_id'			    => $_SESSION['branch_id'],
        		            	'move_from'             => "S".$this->input->post('supplierId'),
        			         	'move_to'               => "B".$_SESSION['branch_id'],
        			 			'rm_id' 			    => $rm_id,
                				'year' 				    => $_SESSION['current_year'],
                				'doc_year' 				=> $_SESSION['current_year'],
                				'tran_date'			    => $this->input->post('date'),
                				'booked_qty' 			=> $bookedQty,
                				'booked_doc_type' 	    => 'prod_plan',
                				'booked_doc_id' 	    => $rows['prod_plan_id'],
                				'created_by ' 		    => $_SESSION['id'],
                				'created_on ' 		    => date("Y-m-d H:i:s"),
                				);
                				
                		$this->RMRCIRModel->AddRMTranRcirStock($postStockDetails);	
                        }
                		
                		if($rcir_qty <=0 )
                		{
                		    break;
                		}
                    }
    			}
		    
			
	}
	
	
	public function updateRMRCIR()
	{
	//	echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('oamsg');
	    $this->form_validation->set_rules('supplier_challan_no', 'challan no', 'trim|required');
		$this->form_validation->set_rules('supplier_challan_date', 'challan date', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		    
		    $postDate = array(
				'supplier_id' 		=> $this->input->post('supplierId'),
				'branch_id'			=> $_SESSION['branch_id'],
				'date'			    => $this->input->post('date'),
				'year'				=> $_SESSION['current_year'],
				'challan_date' 		=> $this->input->post('supplier_challan_date'),
				'challan_no' 	    => $this->input->post('supplier_challan_no'),
				'created_by ' 		=> $_SESSION['id'],
				'created_on ' 		=> date("Y-m-d H:i:s"),
				);
				$mast_rmrcir_id = $_POST['editMast_id'];
			    $this->RMRCIRModel->updateRMTranRcirMast($postDate,$mast_rmrcir_id);
			    
			   
			    $this->addRmRcirDetails($mast_rmrcir_id);
    		
		redirect(base_url('RMRCIR'));
		    
		}else
		 {
			$this->addRMRCIR();
		}
		
	}

	public function getRMRCIRQty()
	{
	    if(!empty($_POST))
	    {
	    $supId 	=$this->input->post('supId');
	    $MastId 	=$this->input->post('MastId');
	    $getQty  = $this->GetQueryModel->getRMRCIRQty($supId);
	    
	   // print_r($getQty);die;
	    
	   echo '<h3>RM RCIR Details Add</h3> (Add New Items)';
    
        	echo '<table id="example" class="display dt-responsive overflow-auto" style="width:100%;border: 1px solid #ebebeb;">
        <thead>
        <tr>
        <th width="5%"></th>
        <th width="5%">PO ID</th>
        <th>Part No.</th>
        <th width="17%">RM Name</th>
        <th width="10%">Order Qty</th>
        <th width="10%">Tot Rec. Till Date</th>
        <th width="10%">Tot Rej. Till Date</th>
        <th width="10%">Rec. Qty</th>
        <th width="7%">Open</th>
        </tr>
        </thead><tbody>';
         $total = sizeof($getQty);     
         if($total !=0){
		foreach($getQty as $row)
			{ 
			    
			 $RMD  = $this->GetQueryModel->getrmById($row['rm_id']);
			  
                                          
             $partData= $this->GetQueryModel->getPartRmbyid($row['rm_id']);
             $partlist='';
             foreach($partData as $part){
                 $pdata= $this->GetQueryModel->getPartsById($part['part_id']);
                
                 $partlist.=$pdata['partno']." </br>";
                 // echo "RM_ID-".$value['rm_id'];
             }
                  
                                    
                                  
			 
			 echo '<input type="hidden" name="tran_rmpo_det_id[]" value="'.$row['id'].'">';
			 echo '<input type="hidden" name="mast_po_id[]" value="'.$row['mast_po_id'].'">';
			 echo '<input type="hidden" name="ordered_qty[]" value="'.$row['ordered_qty'].'">';
			 echo '<input type="hidden" name="rec_qty[]" value="'.$row['rec_qty'].'">';
			 echo '<input type="hidden" name="bal_qty[]" value="'.$row['rej_qty'].'">';
			 echo '<input type="hidden" name="rm_id[]" value="'.$row['rm_id'].'">';
			echo '<tr>
           <td > 
            <input name="checkboxVal[]" type="checkbox" value="'.$row['id'].'">
            </td>
            <td > '.$row['mast_po_id'].' - '.$row['id'].' </td>
             <td > '.$partlist.' </td>
            <td > '.$row['rm_id'].' - '.$RMD['name'].' </td>
            <td > '.$row['ordered_qty'].' </td>
            <td > '.$row['rec_qty'].' </td>
            <td > '.$row['rej_qty'].' </td>
            
            <td > 
            <input id="rcir_qty'.$row['rm_id'].'" name="rcir_qty[]" type="text" class="form-control" placeholder="Quantity" >
            </td>
            <td > 
            <select id="open'.$row['rm_id'].'" name="open[]" class="form-control" ><option value="0">Closed</option><option value="1">Open</option></select>
            </td>
            </tr>';
			
                                    
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">No Purchase Order is Pending.</td></tr>';
         }
			 echo '</thead></table>
			 <br><div class="col-12" >';
			 if($MastId=='')
			 {
            echo '<button type="submit" class="btn btn-primary" >Add</button>&nbsp;&nbsp;';
			 }else
			 {
            echo '<button type="submit" class="btn btn-primary" >Update</button>&nbsp;&nbsp;';
			 }
            echo '<a href="/RMRCIR"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
            </div>
			 ';
	    }
	}
	
	public function deleteRMQty()
	{
	    
	    $id = $_POST['id'];
	    $tran_rmpo_det_id = $_POST['po_det_id'];
	    //echo "ID:".$id."   Tran_rmpo_det_id:".$tran_rmpo_det_id;exit;
		$postDate = array(
				'qty' => '0',
				'open_status'=> 'Y',
				'isdeleted'=>'1'
				);
		$postStockDate = array(
				'booked_qty' => '0',
				'received_qty' => '0',
				'isdeleted'=>'1'
				);
	    $poDetails = array(
        				'open_status' 	    =>'1',
        				);

		$det_rmrcir_id1 = $this->RMRCIRModel->updatetranPODetails($poDetails,$tran_rmpo_det_id);
		$this->RMRCIRModel->UpdateRMTranRcirDetails($postDate,$id);
		$rec = $this->RMRCIRModel->UpdateTranRMRcirStock($id);
		return true;
		
	}

	public function deleteLabourDetails()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->LabourPoModel->deleteLabourDetails($postDate);
	}
	


}

?>