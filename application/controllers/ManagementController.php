<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ManagementController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	  	$this->load->model('Management/ManagementModel');
		$this->load->model('getQuery/getQueryModel');
	}

	public function MangDashboard()
	{
	   $data['getLatestYear'] = $this->ManagementModel->getLatestYear();
		$this->load->view('Management/dashboard',$data);
	}
	
	public function users()
	{
		$data['getUsers'] = $this->ManagementModel->getUsers();
		$this->load->view('Management/users',$data);
	}
	
	public function addUser()
	{
		$id = base64_decode($_GET['ID']);
		$data['getuser'] 	= $this->ManagementModel->getuserById($id);
		$data['getRole'] 	= $this->ManagementModel->getRole();
		$data['getBranch'] 	= $this->ManagementModel->getBranch();
		$this->load->view('Management/addUser',$data);
	}

	public function createUser()
	{
	   
	    $this->session->unset_userdata('createU');
	    $this->form_validation->set_rules('txtFirstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('txtLastName', 'last name', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'address', 'trim');
		$this->form_validation->set_rules('txtContactNumber', 'contact number', 'trim|min_length[10]');
		//$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_rules('txtEmailID', 'email id', 'trim');
		//$this->form_validation->set_rules('ddlRole', 'role', 'trim|required');
		$this->form_validation->set_rules('txtUserID', 'username', 'trim|required|is_unique[mast_users.username]');
		$this->form_validation->set_rules('txtPassword', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$fullname = $this->input->post('txtFirstname').' '.$this->input->post('txtMiddleName').' '.$this->input->post('txtLastName');
			
			$branchName=$this->input->post('branch_id');
			
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'fullname' => $fullname,
				'fname' => $this->input->post('txtFirstname'),
				'mname' => $this->input->post('txtMiddleName'),
				'lanme' => $this->input->post('txtLastName'),
				'address' => $this->input->post('txtAddress'),
				'contact_no' => $this->input->post('txtContactNumber'),
				'email_id ' => $this->input->post('txtEmailID'),
				'username ' => $this->input->post('txtUserID'),
				'psw ' => $this->input->post('txtPassword'),
				'created_by ' => $_SESSION['id'],
				'add_date ' => date("Y-m-d H:i:s"),
				//'update_date ' => date("Y-m-d"),
				);
			$user_id=$this->ManagementModel->AddUser($postDate);
			
			if(empty($this->input->post('txtEmailID')) && $user_id){
			    	$array111 = array('id' => $user_id);
			    	$emailid=$user_id."@gm.com";
			        $this->db->where($array111); 
			        $update111 = $this->db->update('mast_users', array('email_id' => $emailid));
			}
			foreach($branchName as $bn)
			{
			   $roleBranch= explode(" / ",$bn);
			   $roleIds = $roleBranch[0];
			   $branchIds = $roleBranch[1];
			   
			   $roleD=$this->ManagementModel->getRolebyIdBYName($roleIds);
			   $branchD=$this->ManagementModel->getBranchbyIdBYName($branchIds);
			   
			   $RBpostDate = array(
				'user_id' => $user_id,
				'branch_id' => $branchD['id'],
				'role_id' => $roleD['id'],
				);
				
			   $this->ManagementModel->AddUserRole($RBpostDate);
			   
			}
			
			$this->session->set_flashdata('createU', 'You have added user successfully.');
			redirect('/addUser');

		}else
		 {
			$data['getRole'] = $this->ManagementModel->getRole();
			$data['getBranch'] 	= $this->ManagementModel->getBranch();
			$this->load->view('Management/addUser',$data);
		}
		
	}

	public function updateUser()
	{
	    //print_r($_POST);die;
	    $this->session->unset_userdata('createU');
	    $this->form_validation->set_rules('txtFirstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('txtLastName', 'last name', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'address', 'trim');
		$this->form_validation->set_rules('txtContactNumber', 'contact number', 'trim|min_length[10]');
		//$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_rules('txtEmailID', 'email id', 'trim');
		//$this->form_validation->set_rules('ddlRole', 'role', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$fullname=$this->input->post('txtFirstname').' '.$this->input->post('txtMiddleName').' '.$this->input->post('txtLastName');
			
			$postDate = array(
				'fullname' => $fullname,
				'fname' => $this->input->post('txtFirstname'),
				'mname' => $this->input->post('txtMiddleName'),
				'lanme' => $this->input->post('txtLastName'),
				'address' => $this->input->post('txtAddress'),
				'contact_no' => $this->input->post('txtContactNumber'),
				'email_id ' => $this->input->post('txtEmailID'),
				'username ' => $this->input->post('txtUserID'),
				'psw ' => $this->input->post('txtPassword'),
				'updated_by ' => $_SESSION['id'],
				'update_date ' => date("Y-m-d H:i:s"),
				);
			$editId=$this->input->post('editId');
			$res=$this->ManagementModel->updateUser($postDate,$editId);
			
		   if(empty($this->input->post('txtEmailID')) && $editId){
			    	$array111 = array('id' => $editId);
			    	$emailid=$editId."@gm.com";
			        $this->db->where($array111); 
			        $update111 = $this->db->update('mast_users', array('email_id' => $emailid));
			}
			
			$branchName=$this->input->post('branch_id');
			if(!empty($branchName))
			{
			 //update isdeleted=1 before adding role/branch to user_id
			$array111 = array('user_id' => $editId);
			$this->db->where($array111); 
			$update111 = $this->db->update('rel_user_role', array('isdeleted' => 1));
			
			foreach($branchName as $bn)
			{
			   $roleBranch= explode(" / ",$bn);
			   $roleIds = $roleBranch[0];
			   $branchIds = $roleBranch[1];
			   
			   $roleD=$this->ManagementModel->getRolebyIdBYName($roleIds);
			   $branchD=$this->ManagementModel->getBranchbyIdBYName($branchIds);
			   
			   $RBpostDate = array(
				'user_id' => $editId,
				'branch_id' => $branchD['id'],
				'role_id' => $roleD['id'],
				);
			   $resCount = $this->ManagementModel->getcountUserRoleBranch($editId,$roleD['id'],$branchD['id']);
			   if($resCount==0)
			   {
			   $this->ManagementModel->AddUserRole($RBpostDate);
			   }else 
			   {
			    /* $RBUpostDate = array(
				'isdeleted' => 1,
				);
			     $this->ManagementModel->updateUserRole($RBUpostDate,$editId,$roleD['id'],$branchD['id']); */ 
			   }
			}
		}
			
			
			redirect('/users');

		}else
		 {
			$data['getRole'] = $this->ManagementModel->getRole();
			$data['getBranch'] 	= $this->ManagementModel->getBranch();
			$this->load->view('Management/addUser',$data);
		}
		
	}


//Operators
	public function Operators()
	{
		$data['getOperators'] = $this->ManagementModel->getOperators();
		$this->load->view('Management/operators',$data);
	}
	public function addOperators()
	{
		$id = base64_decode($_GET['ID']);
		$data['getuser'] 	= $this->ManagementModel->getoperatorsById($id);
		//$data['getRole'] 	= $this->ManagementModel->getRole();
		$data['getBranch'] 	= $this->ManagementModel->getBranch();
		$this->load->view('Management/addOperators',$data);
	}
	public function createOperators()
	{
	    $this->session->unset_userdata('createU');
	    $this->form_validation->set_rules('txtFirstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('txtLastName', 'last name', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {
			$fullname = $this->input->post('txtFirstname').' '.$this->input->post('txtMiddleName').' '.$this->input->post('txtLastName');
			$postDate = array(
				'company_id' => $_SESSION['id'],
				'fullname'   => $fullname,
				'fname'      => $this->input->post('txtFirstname'),
				'mname'      => $this->input->post('txtMiddleName'),
				'lanme'      => $this->input->post('txtLastName'),
				'address'    => $this->input->post('txtAddress'),
				'contact_no' => $this->input->post('txtContactNumber'),
				'email_id '  => $this->input->post('txtEmailID'),
				'created_by' => $_SESSION['id'],
				'add_date'   => date("Y-m-d"),
				);
			$user_id=$this->ManagementModel->AddUser($postDate);
		
			   $RBpostDate = array(
				'user_id'   => $user_id,
				'branch_id' => $this->input->post('branch_id'),
				'role_id'   => 7,
				);
				
			$this->ManagementModel->AddUserRole($RBpostDate);
			$this->session->set_flashdata('createU', 'You have added user successfully.');
			redirect('/addOperators');

		}else
		 {
		//	$data['getRole'] = $this->ManagementModel->getRole();
			$data['getBranch'] 	= $this->ManagementModel->getBranch();
			$this->load->view('Management/addOperators',$data);
		}
		
	}
	public function updateOperators()
	{
	    $this->session->unset_userdata('createU');
	    $this->form_validation->set_rules('txtFirstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('txtLastName', 'last name', 'trim|required');
		$this->form_validation->set_rules('branch_id', 'branch', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {
			$fullname = $this->input->post('txtFirstname').' '.$this->input->post('txtMiddleName').' '.$this->input->post('txtLastName');
			$postDate = array(
				'company_id'  => $_SESSION['id'],
				'fullname'    => $fullname,
				'fname'       => $this->input->post('txtFirstname'),
				'mname'       => $this->input->post('txtMiddleName'),
				'lanme'       => $this->input->post('txtLastName'),
				'address'     => $this->input->post('txtAddress'),
				'contact_no'  => $this->input->post('txtContactNumber'),
				'email_id '   => $this->input->post('txtEmailID'),
				'updated_by'  => $_SESSION['id'],
				'update_date' => date("Y-m-d"),
				);
		
			$editId=$this->input->post('editId');
			$res=$this->ManagementModel->updateUser($postDate,$editId);
			 //update isdeleted=1 before adding role/branch to user_id
			$array111 = array('user_id' => $editId);
			$this->db->where($array111); 
			$update111 = $this->db->update('rel_user_role', array('isdeleted' => 1));
			
			   $RBpostDate = array(
				'user_id'   => $editId,
				'branch_id' => $this->input->post('branch_id'),
				'role_id'   => 7,
				);
				
			$this->ManagementModel->AddUserRole($RBpostDate);
			$this->session->set_flashdata('createU', 'You have updated user successfully.');
			redirect('/addOperators');

		}else
		 {
		//	$data['getRole'] = $this->ManagementModel->getRole();
			$data['getBranch'] 	= $this->ManagementModel->getBranch();
			$this->load->view('Management/addOperators',$data);
		}
		
	}
	public function deleteRecord()
	{
		$postDate = array(
				'isdeleted' => '1',
				);
		$data = $this->ManagementModel->deleteRecord($postDate);
		return $data;
	}

	public function getRoleBranchList()
	{
		$userId    =$this->input->post('userId');
		if($userId=='')
		{
			$getRole 	= $this->ManagementModel->getRole();
		    $getBranch 	= $this->ManagementModel->getBranch();
		}else
		{
			$getRole 	= $this->ManagementModel->getRole();
		    $getBranch 	= $this->ManagementModel->getBranch();
		}
	    
		$total=sizeof($getBranch);
		if($total!=0){
		foreach($getBranch as $branch){ 
		foreach($getRole as $role){
		    
		$count = $this->ManagementModel->getcountUserRoleBranch($userId,$role['id'],$branch['id']);  
        $details = $role['name'].' / '.$branch['name'];
        if($count == 0)
        {
        echo '<option value="'.$details.'">'.$details.'</option>';

		} }}} else{ 
		echo '<option>No Branch / Role available.</option>';
			}
		
		 
	}
	
	public function getRoleBranchRList()
	{
		$userId    =$this->input->post('userId');
		$getUserRole = $this->ManagementModel->getUserRole($userId);
		$total=sizeof($getUserRole);
		if($total!=0){
		foreach($getUserRole as $ur)
        {
           $BD = $this->ManagementModel->getBranchbyId($ur['branch_id']);
           $RD = $this->ManagementModel->getRoleById($ur['role_id']);
           $details  = $RD['name'].' / '.$BD['name'];
		echo '<option value="'.$details.'" selected>'.$details.'</option>';

			} } 
		 
	}
	
	public function ClearData()
	{
   	$data = $this->ManagementModel->cleardata();
   	echo "<script>alert('Cleared data Successfully..');</script>";
  		redirect('/MangDashboard');
	}
	
	//12-10-2023 added by asharani
	public function databaseBackup()
	{ 
	    date_default_timezone_set('Asia/Kolkata');
	    
	    // Database configuration
        $host = "localhost";
        $username = "fractmet_user";
        $password = "fractmet_user";
        $database_name = "Fractmet";
        
        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");
        
        
        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        //print_r($tables);exit;
        $sqlScript = "";
        foreach ($tables as $table) {
            
            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            
            $sqlScript .= "\n\n" . $row[1] . ";\n\n";
            
            
            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);
            
            $columnCount = mysqli_num_fields($result);
            
            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];
                        
                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }
            
            $sqlScript .= "\n"; 
}

    if(!empty($sqlScript))
    {
        // Save the SQL script to a backup file
        $backup_file_name = $database_name . '_backup_' . date("d-m-Y") . '.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler); 
    
        // Download the SQL backup file to the browser
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));
        ob_clean();
        flush();
        readfile($backup_file_name);
        exec('rm ' . $backup_file_name); 
    }
}
public function DBExport(){
    date_default_timezone_set('Asia/Kolkata');
    $databasename=$this->db->database;
    $this->load->dbutil();
    $prefs = array(
    'format' => 'zip',
    'filename' => $databasename.date("_backup_Y-m-d_H-i-s").'.sql'
    );
    $backup =& $this->dbutil->backup($prefs);
    $db_name = 'backup-on-'.date("Y-m-d_H-i-s").'.zip';
    $save = 'public/uploads/'.$db_name;
    $this->load->helper('file');
    write_file($save, $backup);
    $this->load->helper('download');
    force_download($db_name, $backup);
}

    
    //-------Created on 01-06-2024
    
    public function changeUserpass()
	{
		$id =$_SESSION['id'];
		$data['getuser'] 	= $this->ManagementModel->getuserById($id);
		$this->load->view('Management/changeUserpass',$data);
	}
	public function updateUserpass()
	{
	   // print_r($_POST);die;
	    $this->session->unset_userdata('createU');
// 		$this->form_validation->set_rules('txtUserID', 'username', 'trim|required|is_unique[mast_users.username]');
		$this->form_validation->set_rules('txtPassword', 'password', 'trim|required');
		$this->form_validation->set_rules('txtCPassword', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
			$postDate = array(
				// 'username ' => $this->input->post('txtUserID'),
				'psw ' => $this->input->post('txtPassword'),
				'updated_by ' => $_SESSION['id'],
				'update_date ' => date("Y-m-d H:i:s"),
				);
			$editId=$this->input->post('editId');
			$res=$this->ManagementModel->updateUser($postDate,$editId);
			if($res){
			    	$this->session->set_flashdata('createU', 'You have updated password successfully.');
			}else{
			      $this->session->set_flashdata('createU', 'Password updation failed.');
			}

		}
		redirect('/changeUserpass');
	}
	
	public function addUpdatecompany(){
	    $data['getCompany']=$this->getQueryModel->companyDetails();
	    $this->load->view('Management/company',$data);
	}
	
	public function createupdateCompany(){
	      $this->session->unset_userdata('createU');
	    $this->form_validation->set_rules('name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id', 'trim|required');
		$this->form_validation->set_rules('gst_no', 'GST No', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');
		if ($this->form_validation->run() == TRUE) {
		    //SELECT `id`, `name`, `address`, `email_id`, `contact_no`, `gst_no`, `state_code`, `tann_no`, `pan_no`, `bank_name`, `IFSCCode`, `short_name`, 
		    //`bank_acno`, `defect_reg`, `tool_repair` FROM `mast_company` WHERE 1
		   $editId=$this->input->post('editId');
		   $postDate = array(
            				'name'         => $this->input->post('name'),
            				'address'      => $this->input->post('address'),
            				'email_id'     => $this->input->post('email_id'),
            				'contact_no'   => $this->input->post('contact_no'),
            				'gst_no'       => $this->input->post('gst_no'),
            				'state_code'   => $this->input->post('state_code'),
            				'tann_no'      => $this->input->post('tann_no'),
            				'pan_no '      => $this->input->post('pan_no'),
            				'bank_name'    => $this->input->post('bank_name'),
            				'IFSCCode'     => $this->input->post('IFSCCode'),
            				'short_name'   => $this->input->post('short_name'),
            				'bank_acno '   => $this->input->post('bank_acno'),
            				'defect_reg '  => $this->input->post('defect_reg'),
            				'tool_repair ' => $this->input->post('tool_repair')
            				);
		    	if(!empty($editId)){	
			          
        			$res=$this->ManagementModel->updateCompanydetails($postDate,$editId);
        			$this->session->set_flashdata('createU', 'You have updated company details successfully.');
        			redirect('/addUpdatecompany');
		    	}else{
		    	    
        			 $result=$this->db->insert('mast_company',$postDate);
		             $insert_id = $this->db->insert_id();
		             if($insert_id){
		                 	$this->session->set_flashdata('createU', 'You have Added company details successfully.');
		             }
		    	}

		}else
		 {
				redirect('/addUpdatecompany');
		}
		
	}

}
