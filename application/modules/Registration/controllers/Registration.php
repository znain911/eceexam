<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('registration_m');
		$this->load->library('forminput');	
		$this->load->library('form_validation');
		$this->load->library('form_engine');
		$this->load->library('Querylib');
		$this->load->library('datatables');
		$this->load->library('upload');
		//$this->load->module("users");
		
		//if(!$this->users->_is_admin()){
			//show_404();
		//}
		
	}
	
	function index(){
		
    	
			$session_data = $this->session->userdata('sht_ssndata');			
			$metadata = array(
				'title' => 'Dashboard',
				'description' => 'Admin Home',
				'keywords' => 'Admin Home',
				'imageurl' => base_url('user/images/logo.png'),
				'siteurl' => base_url(''),
				'imageuploadurl' => base_url('a_imageupload'),				
				'id' => $session_data['id'],
				'user_login' => $session_data['user_login'],
				'display_name' => $session_data['display_name'],
				'user_type' => $session_data['user_type'],
				'page' => 'index',				
				);
			$data["metadata"] = $metadata;			
			$data["page"] = 1;
		    $data["sdl_data"] = $this->registration_m->get_registration_control(1);
			$this->load->view('registration',$data);
						
    	
	}

	public function registration_data(){		
		//$this->is_ajax();
		$session_data = $this->session->userdata('sht_ssndata');	
		//This method will have the credentials validation
		$validation_rules = array(
               	array('field'   => 'name', 'label'   => 'Name', 'rules'   => 'trim|xss_clean|required'),
				array('field'   => 'email', 'label'   => 'Email Address', 'rules'   => 'valid_email|is_unique[sht_student.st_email]', 'errors' => array(
                        'is_unique' => 'This %s already exists.',
                )),
				array('field'   => 'studentid', 'label'   => 'Student Id', 'rules'   => 'trim|xss_clean|required|is_unique[sht_student.student_id]|greater_than[1900000]', 'errors' => array(
                        'is_unique' => 'This %s already exists.',
                        'greater_than' => 'This %s should be greater than 1900000.',
                )),
				array('field'   => 'phone', 'label'   => 'Mobile Number', 'rules'   => 'trim|xss_clean|required|is_unique[sht_student.phone]', 'errors' => array(
                        'is_unique' => 'This %s already exists.',
                )),
				/* array('field'   => 'rtc', 'label'   => 'RTC Number', 'rules'   => 'trim|xss_clean|required'), */
				array('field'   => 'terms', 'label'   => 'Terms and Conditions', 'rules'   => 'trim|xss_clean|required'),
				array('field'   => 'batch', 'label'   => 'Batch Number', 'rules'   => 'trim|xss_clean|required'),
				array('field'   => 'password', 'label'   => 'Password', 'rules'   => 'trim|xss_clean|required'),
				array('field'   => 'passconf', 'label'   => 'Password Confirmation', 'rules'   => 'required|matches[password]'));
		$errors_array = $this->form_validation->validation($validation_rules);
		if($errors_array)
            echo $errors_array;
        else{
				//Setting values for tabel columns
				$data = array(
					'st_name'=>$this->input->post('name'),
					'st_email'=>$this->input->post('email'),
					'student_id'=>$this->input->post('studentid'),
					'phone'=>'88'.$this->input->post('phone'),
					'rtc_number'=>$this->input->post('rtc'),
					'batch'=>$this->input->post('batch'),
					'password'=>sha1($this->input->post('password')),
				);
				
				$config['upload_path']          = 'uploads/students/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|xlsx';
				$config['detect_mime']          = TRUE;
				$config['remove_spaces']        = TRUE;
				$config['encrypt_name']         = TRUE;
				$config['max_size']             = '0';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('admission_slip')){
				  $upload_error = $this->upload->display_errors();
				}else{
					$fileData = $this->upload->data();					
					$full_path = $fileData['full_path'];					
					$data['admission_slip'] = $fileData['file_name'];
				}

				if (!$this->upload->do_upload('previous_admit_card')){
				  $upload_error = $this->upload->display_errors();
				}else{
					$fileData2 = $this->upload->data();					
					$full_path = $fileData2['full_path'];					
					$data['previous_admit_card'] = $fileData2['file_name'];
				}			
				
				//Transfering data to Model
				$id = $this->registration_m->regi_insert($data);
				$stcode = date("y").sprintf("%05d", $id);
				$data2 = array(
					'st_code'=>$stcode,
				);
				$this->registration_m->regi_update($id,$data2);
				/* $path=getcwd().'/uploads/files/';
				if(!empty($_FILES["admission_slip"]["name"])){										
					$userfile_name = $_FILES['admission_slip']['name'];
					$extension = substr($userfile_name, strrpos($userfile_name, '.')+1);
					$image_name = 'admission_slip_'.$id.'.'.$extension;
					$file = $path.$image_name;
					if (move_uploaded_file($_FILES['admission_slip']['tmp_name'], $file)) {
						$data3 = array(	
							'admission_slip' => $image_name,
						);
						$this->registration_m->regi_update($id,$data3);								
					}		
				} */
				/* if(!empty($_FILES["previous_admit_card"]["name"])){										
					$userfile_name = $_FILES['previous_admit_card']['name'];
					$extension = substr($userfile_name, strrpos($userfile_name, '.')+1);
					$image_name = 'pre_admitcard_'.$id.'.'.$extension;
					$file = $path.$image_name;
					if (move_uploaded_file($_FILES['previous_admit_card']['tmp_name'], $file)) {
						$data3 = array(	
							'previous_admit_card' => $image_name,
						);
						$this->registration_m->regi_update($id,$data3);								
					}		
				} */

				$sms = 'Dear '.$this->input->post('name').', Your Registration for CCD ECE Exam is successfully Submitted. Please wait for coordinator confirmation of your CCD ECE Exam eligibility before making payment for CCD ECE Exam Fee.';
        $phoeno = $this->input->post('phone');
        sendsms($phoeno,$sms);

				echo $errors_array.'Successfully';
						
			
		}
	}
	
	function send_sms() {
      $url = "http://sms.digibangla.tech/smsapi";
      $data = [
        "api_key" => "C20070275f66f94e214d64.69540581",
        "type" => "text",
        "contacts" => "01943794123",
        "senderid" => "8809601000127",
        "msg" => "Test SMS",
      ];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      curl_close($ch);
      return $response;
    }

	
	
	function login(){  
     	$this->load->view('auth-login');		
	}//end function
	
	public function verifylogin(){  
    	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
				
		//This method will have the credentials validation
		$validation_rules = array(
               	array('field'   => 'username', 		'label'   => 'User Name',				'rules'   => 'trim|xss_clean|required'),
				array('field'   => 'password', 		'label'   => 'Password',				'rules'   => 'trim|xss_clean|required'),
								  
        );
				
		$errors_array = $this->form_validation->validation($validation_rules);
		if($errors_array)
            echo $errors_array;
        else{			
			
			$password= md5($password);
			$result = $this->registration_m->login($username, $password);
			
			if($result){		
				$sess_array = array();
				foreach($result as $row){
					$sess_array = array(
						'id' => $row->Admin_Id,
						'user_login' => $row->User_Login,
						'display_name' => $row->Display_Name,
						'user_image' => $row->User_Image,
						'user_type' => $row->Usergroup_Id
						);
					$this->session->set_userdata('sht_ssndata', $sess_array);
				}
				echo $errors_array.'Login Successfully';
				//for user login log
				$user_note_date = $this->config->item('CUR_D_T');
				$user_note = 'In '.$user_note_date;
				$user_log_data = array(
					'User_Login' => $username,
					'Login_Note' => $user_note
				);
				$this->registration_m->user_log($user_log_data);
				//end user login log
			}else{
				echo $errors_array.'Invalid username or password';
			}
												
		}
			
	}//end function
	
	
	function check_database($password){
  
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
		$password= md5($password);
		
		// $type = $this->input->post('type');
		//query the database
		$result = $this->registration_m->login($username, $password);
		
		if($result){		
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->user_id,
					'user_login' => $row->user_login,
					'display_name' => $row->display_name,
					'user_image' => $row->User_Image,
					'user_type' => $row->user_type
					);
				$this->session->set_userdata('sht_ssndata', $sess_array);
			}
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username, password or Type');
			return false;
		}
		
  	}//end function
		
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		$session_data = $this->session->userdata('sht_ssndata');
		$username = $session_data['user_login'];
		$user_note_date = $this->config->item('CUR_D_T');
		$user_note = 'Out '.$user_note_date;
		$user_log_data = array(
			'User_Login' => $username,
			'Login_Note' => $user_note
		);
		$this->registration_m->user_log($user_log_data);
		
		redirect( base_url('admin/login') , 'refresh');
	}

	function clearcache(){    	
		$this->output->clear_all_cache();
		redirect('admin', 'refresh');		
  	} //End of function

	
	
	function profile(){
		//print_r($this->session->userdata('sht_ssndata'));exit;
		if($this->session->userdata('sht_ssndata')){
    	
			$session_data = $this->session->userdata('sht_ssndata');			
			$metadata = array(
				'title' => 'Profile',
				'description' => 'Admin Home',
				'keywords' => 'Admin Home',
				'imageurl' => base_url('user/images/logo.png'),
				'siteurl' => base_url(''),
				'imageuploadurl' => base_url('a_imageupload'),				
				'id' => $session_data['id'],
				'user_login' => $session_data['user_login'],
				'display_name' => $session_data['display_name'],
				'user_type' => $session_data['user_type'],
				'page' => 'index',				
				);
			$data["metadata"] = $metadata;			
			$data["page"] = 1;
			
			$userid=$session_data['id'];
			$data["profile_data"] = $this->registration_m->get_userprofile($userid);			
			$this->load->view('profile',$data);
						
    	}else{
      		//If no session, redirect to login page
      		redirect('admin/login', 'refresh');
		}
		
	}
	
	
	
	
		
}

?>