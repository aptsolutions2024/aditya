<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Login/LoginModel');
		$this->load->model('getQuery/getQueryModel');
		$this->load->model('Management/ManagementModel');
		date_default_timezone_set("Asia/Kolkata");

	}


	public function index()
	{
	    $data['getBranch'] 		= $this->getQueryModel->getBranch();
		$this->load->view('Login/index',$data);
	}

	public function signIn()
	{
    $this->session->unset_userdata('unmsg');
    $this->session->unset_userdata('accountmsg');
		$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('current_year', 'Current Year', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		     $branch_Role   = $this->input->post('branch_id');
		     $username      = $this->input->post('username');
		     $password      = $this->input->post('password');
		     $current_year  = $this->input->post('current_year');
           
           
           $roleBranch= explode(" / ",$branch_Role);
		   $roleIds = $roleBranch[0];
		   $branchIds = $roleBranch[1];
		   
		   $role_id     =$this->ManagementModel->getRolebyIdBYName($roleIds);
		   $branch_id   = $this->ManagementModel->getBranchbyIdBYName($branchIds);
		   
            $login 			= $this->LoginModel->login($username,$password);
            //$currYear 		= $this->LoginModel->getCurrentYear($branch_id['id']);
            $compDetails 		= $this->LoginModel->GetCompanyNmbyId($login['company_id']);
            $role               =$role_id['id'];
		    //print_r($login);exit;
           		if($login) {
           		

           			$logged_in_sess = array(
           				'id' 			=> $login['id'],
				        'name'  		=> $login['fullname'],
				        'username'  	=> $login['username'],
				        'email_id'  	=> $login['email_id'],
				        'role'  		=> $role,
				        'role_name'  	=> $roleIds,
				        'branch_id'     => $branch_id['id'],
				        'branch_name'   => $roleBranch[1],
				        'company_id'  	=> $compDetails['id'],
				        'company_name'  => $compDetails['name'],
				        'current_year'  => $current_year,
				        'dashboard'     => 0,
				        'logged_in' 	=> TRUE
					);
                
				//$role=$login['role'];
				 
				$this->session->set_userdata($logged_in_sess);
				redirect('/MangDashboard', 'refresh');
				/*if($role==1)
				{
				redirect('/MangDashboard', 'refresh');
				}else if($role==2)
				{
				redirect('/UserDashboard', 'refresh');
				}*/
				}
           		else {
           			$this->session->set_flashdata('unmsg', 'Incorrect username/password combination');
                redirect(base_url());
           		}
           	}else {
           			//$this->session->set_flashdata('unmsg', 'Incorrect username/password combination');
           			$this->index();
           		}
		
	}
	
	public function checkUserDetails()
	{
	    $result 	= $this->getQueryModel->checkUserDetails();
		$user_id = $result['id'];
		
		if(!empty($user_id))
		{
		   $res 	= $this->ManagementModel->getUserRole($user_id); 
		   //print_r($res);die;
		    $total=sizeof($res);
            if($total!=0){
                echo '<option value="">Select Role / Branch</option>';
                foreach($res as $ur)
                {
                    $BD = $this->ManagementModel->getBranchbyId($ur['branch_id']);
                    $RD = $this->ManagementModel->getRoleById($ur['role_id']);
                    
                    $details  = $RD['name'].' / '.$BD['name'];
                    echo '<option value="'.$details.'" >'.$details.'</option>';
                    
                }
            }
			
		}else
            {
               echo '<option value="">Incorrect username/password combination</option>'; 
            }
		
	}
	public function getCurrentYear()
	{
	    $branchId = $_POST['branchId'];
	    $roleBranch= explode(" / ",$branchId);
		  $roleIds = $roleBranch[0];
		 $branchName = $roleBranch[1];
	    $res 	= $this->getQueryModel->getYearByBranchBy($branchName); 
	   // print_r($res);die;
		  $total=sizeof($res);
            if($total!=0){
                //echo '<option value="">Select Year</option>';
                foreach($res as $cy)
                {
                    $current_year = $cy['current_year'];
                   echo '<option value="'.$current_year.'" >'.$current_year.'</option>';
                    
                }
            }else
            {
               echo '<option value="">Incorrect username/password combination</option>'; 
            }
		
	}
	public function logout()
    {
    	$this->session->unset_userdata('id');
  		$this->session->unset_userdata('name');
  		$this->session->unset_userdata('username');
  		$this->session->unset_userdata('user_type');
  		$this->session->unset_userdata('role');
  		$this->session->unset_userdata('logged_in');
  		$this->session->unset_userdata('dashboard');
  		
  		redirect(base_url());
	}
	
	//New code for branch change by Asharani - 26-05-2023
 
	  public function changeBranch(){
	  	
	      $this->load->view('Login/changeBranch');
	  }

	  public function getUserRoleBranchbyID(){

		   $user_id=$_SESSION['id'];
		   $res 	= $this->ManagementModel->getUserRole($user_id); 
		   //print_r($res);die;
		    $total=sizeof($res);
            if($total!=0){
                echo '<option value="">Select Role / Branch</option>';
                foreach($res as $ur)
                {
                    $BD = $this->ManagementModel->getBranchbyId($ur['branch_id']);
                    $RD = $this->ManagementModel->getRoleById($ur['role_id']);
                    
                    $details  = $RD['name'].' / '.$BD['name'];
                    echo '<option value="'.$details.'" >'.$details.'</option>';
                    
                }
            }			
	   }
	   
	 public function signInwithBrRole()	{
        $this->session->unset_userdata('unmsg');
        $this->session->unset_userdata('accountmsg');
      
		$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required');	
		$this->form_validation->set_rules('current_year', 'Current Year', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		     $branch_Role   = $this->input->post('branch_id');
		     $current_year  = $this->input->post('current_year');
           
           
           $roleBranch= explode(" / ",$branch_Role);
		   $roleIds = $roleBranch[0];
		   $branchIds = $roleBranch[1];
		   
		   $role_id     =$this->ManagementModel->getRolebyIdBYName($roleIds);
		   $branch_id   = $this->ManagementModel->getBranchbyIdBYName($branchIds);
		   
            $login 			= $_SESSION['id'];   //as user id
            //$currYear 		= $this->LoginModel->getCurrentYear($branch_id['id']);
            $compDetails 		= $this->LoginModel->GetCompanyNmbyId($_SESSION['company_id']);
            $role               =$role_id['id'];
		    //print_r($login);exit;
           		if($login) {
           			$logged_in_sess1 = array(
           				'role'  		=> '',
           				'role_name'  	=> '',
				        'branch_id'     => '',
				        'branch_name'   => '',
				        'current_year'  => '',
				        'dashboard'     => '', 
					);
           			$this->session->unset_userdata($logged_in_sess1);		

           			$logged_in_sess = array(           				
				        'role'  		=> $role,
				        'role_name'  	=> $roleIds,
				        'branch_id'     => $branch_id['id'],
				        'branch_name'     => $roleBranch[1],
				        'current_year'  => $current_year,
				        'dashboard'     => 0, 
					);
                
				//$role=$login['role'];
				 
				$this->session->set_userdata($logged_in_sess);
				redirect('/MangDashboard');
				/*if($role==1)
				{
				redirect('/MangDashboard', 'refresh');
				}else if($role==2)
				{
				redirect('/UserDashboard', 'refresh');
				}*/
				}
           		else {
           			$this->session->set_flashdata('unmsg', 'Incorrect Role & Branch/Year combination');
                redirect(base_url('changeBranch'));
           		}
           	}else {
           			//$this->session->set_flashdata('unmsg', 'Incorrect username/password combination');
           			$this->changeBranch();
           		}
	}
	


	public function forgot_password(){
	 //   print_r($_POST);exit;
	    error_reporting(E_ALL);
	    $this->session->unset_userdata('createU');
		$this->form_validation->set_rules('email_id', 'email id', 'trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		    
		    $email_id  = $this->input->post('email_id');
		    $result 	= $this->getQueryModel->userDetailsbyEmailid($email_id);
		  //  print_r($result);
		  $msg='';
		  if(!empty($result)){
            $fullname=$result['fname']." ".$result['lanme'];
            //print_r($result);exit;
            /* Mail To User */
            $to = $email_id;
            $subject  = "Welcome to Fractmet Enginnering Pvt Ltd.";
            $headers  = "MIME-Version: 1.0;\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1;\n";
            $headers .= "From:  info@fractmet.com \r\n";
            $headers .= "Reply-To:  info@fractmet.com \r\n";
            
            $message = "<br><br><p style='color:#000000;'>Hi  ".$fullname.",<br /><br /></p>
            				<p style='color:#000000;'><b>We received a request to reset your password for Fractmet Enginnering:<br />
            <a href='mailto: info@fractmet.com' style='cursor:pointer;text-decoration:none;'> info@fractmet.com </a> we're here to help!</b><br /></p>
            				<p style='color:#000000;'>Simply Click on the button to set a new password: <br><br>
            				<a href='".base_url()."reset-password?id=".base64_encode($result['email_id'])."' style='cursor:pointer;text-decoration:none;'><button style='outline:none;border:1px solid #8FCC30;background-color:#8FCC30;color:#ffffff;padding:10px;cursor:pointer;text-decoration:none;'>Set a new Password</button></a>
            				</p>
            				<p style='color:#000000;'>if you didn't ask to change you password, don't worry!<br/> Your password is still safe and you can delete this email.<br><br>
             Regards,<br>
            Customer Care Team,<br>
             info@fractmet.com
            				
            
            				<br />
            				<!--<img src/images/footer_external.jpg'/>-->
                            <br><br><br>
            				</p>";
            /* and now mail it user */
           $msg =   mail($to, $subject, $message, $headers);
		  }
        if ($msg) 
        { 
            $mailres = '<p>Your mail has been sent!</p>';
        } 
        else 
        { 
            $mailres= '<p>Something went wrong / Mail does not exist..!</p>'; 
        }
           
            //echo "**********************************<br>Mail Sent.".$msg;exit;
            echo "<script>window.top.location='/forgot-password?msg=$mailres'</script>";     exit();
		    
		   // $this->session->set_flashdata('unmsg', 'Incorrect username/password combination');
		    	
		}

		$this->load->view('Login/forgot-password');
		
	}
	public function	reset_password(){
	    
	    	$this->load->view('Login/reset-password');
	}
	
	public function updateResetUserpass()
	{
	   // print_r($_POST);die;
	    $this->session->unset_userdata('createU');
		$this->form_validation->set_rules('txtPassword', 'password', 'trim|required');
		$this->form_validation->set_rules('txtCPassword', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" style="text-align: left;margin-left: 5px;">', '</div>');

		if ($this->form_validation->run() == TRUE) {
		    
		    $editId=$this->input->post('editId');
			$postDate = array(
				'psw ' => $this->input->post('txtPassword'),
				'update_date ' => date("Y-m-d H:i:s"),
				);
		
		    $res=$this->ManagementModel->updateUserbyMailid($postDate,$editId);
			if($res){
			    	$this->session->set_flashdata('createU', 'You have changed password successfully.');
			        redirect(base_url());
			}else{
			    
			      $this->session->set_flashdata('createU', 'Password updation failed.');
			       redirect(base_url('reset-password'));
			}

		}
			$this->load->view('Login/reset-password');
		
	}
}
