<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Ci_Controller {
	function __construct(){  	
		parent::__construct();
		
		if($this->session->userdata('sht_ssndata')){			
			
			$this->load->model('a_settings_m');
			
			$this->load->library('tags');
			$this->load->library('imagecrop');
			
			$this->load->library('forminput');			
			$this->load->library('form_validation');
			
			$this->load->library('datatables');
        	//$this->load->library('table');
			$this->load->library('Querylib');
			$this->load->library('form_engine');
					
		}else{
			//If no session, redirect to login page
			redirect('admin/login', 'refresh');
		}		
  	}

  	

	public function registration_control(){
		
		$session_data = $this->session->userdata('sht_ssndata');			
		$metadata = array(
			'title' => 'User Group List',
			'description' => '',
			'keywords' => '',
			'heading' => 'User Group',
			'imageurl' => base_url('user/images/logo.png'),
			'siteurl' => base_url(''),
			'imageuploadurl' => base_url('a_imageupload'),				
			'id' => $session_data['id'],
			'user_login' => $session_data['user_login'],
			'display_name' => $session_data['display_name'],
			'user_type' => $session_data['user_type'],			
			'page' => 'postlist',				
			);
		$data["metadata"] = $metadata;	
		$data["sdl_data"] = $this->a_settings_m->get_registration_control(1);
							
		$this->load->view('registration_control', $data);
		
	}


	public function ediregi_control_data(){		
		
		$session_data = $this->session->userdata('sht_ssndata');

		$id = 1;	

		//This method will have the credentials validation
		$validation_rules = array(
               	array('field'   => 'publish', 'label'   => 'Status', 'rules'   => 'trim|xss_clean|required'),
				);
		$errors_array = $this->form_validation->validation($validation_rules);
		if($errors_array)
            echo $errors_array;
        else{
				$data = array(
					'status'=>$this->input->post('publish'),
				);
				/*print_r($data);exit;*/
				//Transfering data to Model
				$this->a_settings_m->registration_control_update($id,$data);

				
				echo $errors_array.'Update Successfully';
		}
	}
	
	public function payment_list(){
		
		$session_data = $this->session->userdata('sht_ssndata');			
		$metadata = array(
			'title' => 'User Group List',
			'description' => '',
			'keywords' => '',
			'heading' => 'User Group',
			'imageurl' => base_url('user/images/logo.png'),
			'siteurl' => base_url(''),
			'imageuploadurl' => base_url('a_imageupload'),				
			'id' => $session_data['id'],
			'user_login' => $session_data['user_login'],
			'display_name' => $session_data['display_name'],
			'user_type' => $session_data['user_type'],			
			'page' => 'postlist',				
			);
		$data["metadata"] = $metadata;	
		$data["sdl_data"] = $this->a_settings_m->get_registration_control(1);
		$data["get_paymnt"] = $this->a_settings_m->get_paymentList();
							
		$this->load->view('payment_list', $data);
		
	}
	
	public function studentotp(){
		
		$session_data = $this->session->userdata('sht_ssndata');			
		$metadata = array(
			'title' => 'User Group List',
			'description' => '',
			'keywords' => '',
			'heading' => 'User Group',
			'imageurl' => base_url('user/images/logo.png'),
			'siteurl' => base_url(''),
			'imageuploadurl' => base_url('a_imageupload'),				
			'id' => $session_data['id'],
			'user_login' => $session_data['user_login'],
			'display_name' => $session_data['display_name'],
			'user_type' => $session_data['user_type'],			
			'page' => 'postlist',				
			);
		$data["metadata"] = $metadata;	
		
		/*$data["sid"] = $id;	*/
		$data["otp_list"] = $this->a_settings_m->getotp();
							
		$this->load->view('stotp', $data);
		
	}
	
	public function sms_list(){
		
		$session_data = $this->session->userdata('sht_ssndata');			
		$metadata = array(
			'title' => 'SMS List',
			'description' => '',
			'keywords' => '',
			'heading' => 'SMS Group',
			'imageurl' => base_url('user/images/logo.png'),
			'siteurl' => base_url(''),
			'imageuploadurl' => base_url('a_imageupload'),				
			'id' => $session_data['id'],
			'user_login' => $session_data['user_login'],
			'display_name' => $session_data['display_name'],
			'user_type' => $session_data['user_type'],			
			'page' => 'postlist',				
			);
		$data["metadata"] = $metadata;	
		$data["get_sms"] = $this->a_settings_m->get_smslist();
							
		$this->load->view('sms_list', $data);
		
	}

	function editsms($id){
		if($this->session->userdata('sht_ssndata')){
    	
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
			$data["stid"] = $id;	
			$data["st_data"] = $this->a_settings_m->get_smsdata($id);
			$this->load->view('smsedit',$data);
						
    	}else{
      		//If no session, redirect to login page
      		redirect('admin/login', 'refresh');
		}
		
	}

	public function edit_smsdata($id){		
		
		$session_data = $this->session->userdata('sht_ssndata');

		//This method will have the credentials validation
		$validation_rules = array(
               	array('field'   => 'sms_text', 'label'   => 'SMS text', 'rules'   => 'trim|xss_clean|required'),
				);
		$errors_array = $this->form_validation->validation($validation_rules);
		if($errors_array)
            echo $errors_array;
        else{
				$data = array(
					'sms_text'=>$this->input->post('sms_text'),
					'email_text'=>$this->input->post('email_text'),
					'sms_text_disallow'=>$this->input->post('sms_text_disallow'),
					'email_text_disallow'=>$this->input->post('email_text_disallow'),
				);
				//Transfering data to Model
				$this->a_settings_m->sms_update($id,$data);
				
				echo $errors_array.'Update Successfully';
		}
	}

	
    
	function is_ajax(){
		if (!$this->input->is_ajax_request()) {
            if($this->session->userdata('sht_ssndata')){			
				redirect('admin', 'refresh');						
			}else{
				redirect('admin/login', 'refresh');
			}
		}
	}
	

	
} // End Class

?>