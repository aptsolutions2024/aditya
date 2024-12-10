<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ScrapController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('Scrap/scrapModel');
		$this->load->model('getQuery/getQueryModel');
	}
	
	public function scrapInvoice(){
	      
	        $data['getScrapdata']= $this->getQueryModel->getScrapfromTranscrapInv();
	        
	    	$this->load->view('Scrap/scrapInvoice',$data);
	}
	public function addScrapInvoice(){
	      
	     	$id = base64_decode($_GET['ID']);
		    $data['getTranScrapInvoice'] = $this->getQueryModel->getTranScrapInv($id);
	    	$this->load->view('Scrap/addScrapInvoice',$data);
	}
	
	public function createScrapInvoice(){
	    error_reporting(E_ALL);
	       //echo "<pre>";print_r($_POST);die;
		$this->session->unset_userdata('createS');
	    $this->form_validation->set_rules('invoice_date', 'invoice_date', 'trim|required');
		$this->form_validation->set_rules('invoice_no', 'invoice_no', 'trim|required');
		$this->form_validation->set_rules('invoice_qty', 'invoice_qty', 'trim|required');
		$this->form_validation->set_rules('type', 'Select type', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'Select Branch', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			
        
            //SELECT `id`, `invoice_date`, `invoice_no`, `scrap_type`, `invoice_qty`, `stock_adj_qty`, `branch_id`, `created_by`, `created_on`, `updated_on`, `updated_by` FROM `tran_scrap_invoice` WHERE 1
            if(!empty($this->input->post('invoice_date') && $this->input->post('invoice_no')))
		    {
		        if($this->input->post('editId')==''){
		      	$postDate = array(
            				'invoice_date' 		=> $this->input->post('invoice_date'),
            				'invoice_no' 	    => $this->input->post('invoice_no'),
            				'year'				=> $_SESSION['current_year'],
            				'invoice_qty' 		=> $this->input->post('invoice_qty'),
            				'stock_adj_qty' 	=> $this->input->post('stock_adj_qty'),
            				'scrap_type' 		=> $this->input->post('type'),
            				'branch_id ' 		=> $this->input->post('branch_id'),
            				'created_by ' 		=> $_SESSION['id'],
            				'created_on ' 		=> date("Y-m-d H:i:s"),
			         	);
				
			       $res = $this->db->insert('tran_scrap_invoice',$postDate);
			       $tranId=$this->db->insert_id();
			       	
			       	$UpdateDate2f = array(
						    	    'prod_plan_id'      => 0,
									'year' 		        => $_SESSION['current_year'],
									'date'              => $this->input->post('invoice_date'),
									'rm_id' 		    => 0,
								    'type' 		        => $this->input->post('type'),
									'issue_qty' 	    => $this->input->post('invoice_qty'),
									'issue_doc_type' 	=> "scrap_invoice",
									'issue_doc_id' 		=> $tranId,
									'received_qty' 	    => $this->input->post('stock_adj_qty'),
									'received_doc_type' => "stock_adj",
									'received_doc_id' 	=> $tranId,
									'branch_id' 		=> $this->input->post('branch_id'),
                                    'created_on' 		=> date("Y-m-d H:i:s"),
									'created_by' 		=> $_SESSION['id']
								);
                          
		     	$result16s = $this->db->insert('scrap_stock',$UpdateDate2f);
		     	$result16sId=$this->db->insert_id();
			       
		        }else{
		            
		            	$postDate1 = array(
            				'invoice_qty' 			=> $this->input->post('invoice_qty'),
            				'stock_adj_qty' 		=> $this->input->post('stock_adj_qty'),
            				'updated_by ' 		=> $_SESSION['id'],
            				'updated_on ' 		=> date("Y-m-d H:i:s"),
			         	);
				          $this->db->where(array('id'=>$this->input->post('editId')));
			            $res = $this->db->update('tran_scrap_invoice',$postDate1);
			            
			              	$UpdateDate2f = array(
									'issue_qty' 	    => $this->input->post('invoice_qty'),
									'received_qty' 	    => $this->input->post('stock_adj_qty'),
                                    'updated_on' 		=> date("Y-m-d H:i:s"),
									'updated_by' 		=> $_SESSION['id']
								);
                      
                $this->db->where(array('issue_doc_id'=>$this->input->post('editId'),'issue_doc_type'=>'scrap_invoice'));    
		     	$result16s = $this->db->update('scrap_stock',$UpdateDate2f);
			            
		        }
		    
            redirect('/scrapInvoice');
		    }
		    else{
		        $this->session->set_flashdata('createS', 'Scrap Invoice Details should be mandatory!');
		        $this->addScrapInvoice();
		    }

		}else
		 {
			$this->addScrapInvoice();
		}
	}
	 public function getScrapbyvalue(){
	       $getScrapInvMaxqty= $this->getQueryModel->getScrapDataforInvoice();
	       echo ($getScrapInvMaxqty)?$getScrapInvMaxqty:0;
	       //return $getScrapInvMaxqty;
	 }
    public function getScrapbyvalue_Old(){
        //	print_r($_POST);
             $getScrapdata= $this->getQueryModel->getScrapData();
               echo '<h3>Scrap Details</h3>';
      
        echo '<table id="example" class="display table" style="margin: 1%;width: 95%;">
        <thead>
        <tr>
        
        <th width="5%"><input name="togglecheckbx" type="checkbox"  id="togglecheckbx" onclick="SelectAll()">&nbsp;&nbsp;SELECT ALL </th>
         <th width="3%">DPR ID</th>
        <th width="8%">Received DOC Details</th>
        <th width="10%">RM ID</th>
        <th width="10%">Date</th>
        <th width="5%">Type</th>
        <th width="8%">Scrap Qty</th>
        </tr>
        </thead><tbody>';
         $total = sizeof($getScrapdata);     
         if($total !=0){
             	$rc=1;
		foreach($getScrapdata as $row)
			{
			      $RMname = $this->getQueryModel->getRawMaterialbyrmid($row['rm_id']);
			       $DPR = $this->getQueryModel->GetDPRById($row['received_doc_id']);
			     $partid = $this->getQueryModel->getPartsById($DPR['part_id']);
			 echo '<tr>';
			 echo '<input type="hidden" name="scrap_id[]" value="'.$row['id'].'">';
             echo '<td > 
            <input name="checkboxVal[]" type="checkbox"  value="'.$row['id'].'" id="checkbox'.$row['id'].'" onclick="calTotal()">
            </td>
            <td > '.$row['received_doc_id'].' </td>
            <td > '.$partid['partno']." - ".$DPR['qty'].' </td>
            <td > '.$row['rm_id']." - ".$RMname['name'].'</td>
            <td > '.date("d-m-Y",strtotime($row['date'])).' </td>
            <td > '.$row['type'].' </td>
            <td >
            <input type="hidden" id="scrapVal'.$row['id'].'" value="'.number_format($row['scrap_qty'],3,'.',',').'" >
            <input type="text" class="form-control " value="'.number_format($row['scrap_qty'],3,'.',',').'" readonly></td>
            </tr>';
			
              $rc++;                      
			 }
			 
			 if($rc==1){
			     echo '<tr><td colspan="8" style="color: #ff0000;">No scrap Data found..</td></tr>';
			 }else{
			    echo '<tr>';
			    echo '<th>Total Value</th>
			    <td><input type="text" class="form-control" id="totscrapVal" value="" readonly></td>';
			    echo '</tr>';
			 }
         }else
         {
             echo '<tr><td colspan="8" style="color: #ff0000;">No scrap Data found.</td></tr>';
         }
			 echo '</thead></table>';
			
			echo '<br><div class="col-12" >';
		
            echo '<button type="submit" class="btn btn-primary" >Update</button>&nbsp;&nbsp;';
		
            echo '<a href="/scrapInvoice"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
            </div>
			 ';
        
    }	
	
}