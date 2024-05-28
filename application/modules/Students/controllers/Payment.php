<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('students_m');
		$this->load->library('forminput');	
		$this->load->library('form_validation');
		$this->load->library('form_engine');
		$this->load->library('Querylib');
		$this->load->library('datatables');
		/*$this->load->library('encrypt');*/
		$this->load->library('email');
		
	}
	
	
	
	function index(){
		if($this->session->userdata('sht_stdnt')){
    	
			$session_data = $this->session->userdata('sht_stdnt');			
			$metadata = array(
				'title' => 'Dashboard',
				'description' => 'Admin Home',
				'keywords' => 'Admin Home',
				'imageurl' => base_url('user/images/logo.png'),
				'siteurl' => base_url(''),
				'imageuploadurl' => base_url('a_imageupload'),				
				'id' => $session_data['id'],
				//'user_login' => $session_data['user_login'],
				'display_name' => $session_data['display_name'],
				//'user_type' => $session_data['user_type'],
				'page' => 'index',				
				);
			$data["metadata"] = $metadata;			
			$data["page"] = 1;
			$cdate = date("Y-m-d");
			$data["exam_list"] = $this->students_m->get_exam_schedule($cdate);
			$data["std_info"] = $this->students_m->get_studentinfo($session_data['id']);
			$data["paymentdata"] = $this->students_m->get_paymentinfo();

			$this->load->view('paymentinfo',$data);
						
    	}else{
      		//If no session, redirect to login page
      		redirect('students/login', 'refresh');
		}
		
	}

	public function pay(){
		$session_data = $this->session->userdata('sht_stdnt');
		$std_info = $this->students_m->get_studentinfo($session_data['id']);
		$paymentdata = $this->students_m->get_paymentinfo();
		/* PHP */
		$post_data = array();
		$post_data['store_id'] = "distancelearningprogramlive";
		$post_data['store_passwd'] = "6135F66430DA264477";
		$post_data['total_amount'] = $paymentdata->fee_amount;
		$post_data['currency'] = "BDT";
		$post_data['tran_id'] = "ECE_".uniqid();
		$post_data['success_url'] = "https://eceexam.dldchc-badas.org.bd/students/payment/paymentsuccess";
		$post_data['fail_url'] = "https://eceexam.dldchc-badas.org.bd/students/payment/paymentfail";
		$post_data['cancel_url'] = "https://eceexam.dldchc-badas.org.bd/students/payment/paymentxcancel";
		# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

		$post_data['cus_name'] = $std_info->st_name;
		$post_data['cus_email'] = $std_info->st_email;
		$post_data['cus_phone'] = $std_info->phone;
		$post_data['value_a'] = $session_data['id'];
		$post_data['value_b'] = $paymentdata->fee_name;

		# REQUEST SEND TO SSLCOMMERZ
		$direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php";

		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $direct_api_url );
		curl_setopt($handle, CURLOPT_TIMEOUT, 30);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($handle, CURLOPT_POST, 1 );
		curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


		$content = curl_exec($handle );

		$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		if($code == 200 && !( curl_errno($handle))) {
			curl_close( $handle);
			$sslcommerzResponse = $content;
		} else {
			curl_close( $handle);
			echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
			exit;
		}

		# PARSE THE JSON RESPONSE
		$sslcz = json_decode($sslcommerzResponse, true );

		if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
		        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
		        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
			echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
			# header("Location: ". $sslcz['GatewayPageURL']);
			exit;
		} else {
			echo "JSON Data parsing error!";
		}
		
	}

	public function paidinfo()
	{
		/*$session_data = $this->session->userdata('sht_stdnt');*/
		$ipn_array = array(
						'date_time'               => $_POST['tran_date'],
						'transaction_id'          => $_POST['tran_id'],
						'bank'                    => $_POST['card_issuer'],
						'ipn_student_id'          => $_POST['value_a'],
						'amount'                  => $_POST['amount'],
						'card_type'               => $_POST['card_type'],
						'card_number'             => $_POST['card_no'],
						'card_name'               => $_POST['card_brand'],
						'issuer_bank_or_country	' => $_POST['card_issuer_country'],
						'ip_address'              => $this->input->ip_address(),
						'status'                  => $_POST['status'],
					);
		$this->db->insert('sht_ipn', $ipn_array);
		
		if($_POST['status'] === 'VALID')
		{
			//save students online payment details
			$p_details = array(
							'onpay_student_id' => $_POST['value_a'],
							'onpay_type' => $_POST['value_b'],
							'onpay_transaction_id' => $_POST['tran_id'],
							'onpay_transaction_date' => $_POST['tran_date'],
							'onpay_transaction_amount' => $_POST['amount'],
							'onpay_transaction_status' => 'Paid',
							'onpay_create_date' => date("Y-m-d H:i:s"),
						);
			$this->students_m->insert_payment($p_details);
			
			
		/*$get_studentinfo = $this->Payment_model->student_basic_info(sha1($_POST['value_a']));*/
		
		//set to enrolled
		$this->db->where('st_id', $_POST['value_a']);
		$this->db->update('sht_student', array('payment_status' => 1, 'need_payment' => 0));

		
		$message ='Dear '.$_POST['cus_name'].',Your payment of ECE-fee has been done. Please wait for final approval & instruction for ECE from DLP Admin.';
		sendsms($_POST['cus_phone'], $message);
		}
		
	}

	function paymentsuccess(){
		$this->load->view('paid');		
	}

	function paymentfail(){
		if($this->session->userdata('sht_stdnt')){
    	
			$session_data = $this->session->userdata('sht_stdnt');			
			$metadata = array(
				'title' => 'Dashboard',
				'description' => 'Admin Home',
				'keywords' => 'Admin Home',
				'imageurl' => base_url('user/images/logo.png'),
				'siteurl' => base_url(''),
				'imageuploadurl' => base_url('a_imageupload'),				
				'id' => $session_data['id'],
				//'user_login' => $session_data['user_login'],
				'display_name' => $session_data['display_name'],
				//'user_type' => $session_data['user_type'],
				'page' => 'index',				
				);
			$data["metadata"] = $metadata;			
			$data["page"] = 1;
			$cdate = date("Y-m-d");
			$data["exam_list"] = $this->students_m->get_exam_schedule($cdate);
			$data["std_info"] = $this->students_m->get_studentinfo($session_data['id']);

			$this->load->view('payfail',$data);
						
    	}else{
      		//If no session, redirect to login page
      		redirect('students/login', 'refresh');
		}
		
	}	
	
	function paymentxcancel(){
		if($this->session->userdata('sht_stdnt')){
    	
			$session_data = $this->session->userdata('sht_stdnt');			
			$metadata = array(
				'title' => 'Dashboard',
				'description' => 'Admin Home',
				'keywords' => 'Admin Home',
				'imageurl' => base_url('user/images/logo.png'),
				'siteurl' => base_url(''),
				'imageuploadurl' => base_url('a_imageupload'),				
				'id' => $session_data['id'],
				//'user_login' => $session_data['user_login'],
				'display_name' => $session_data['display_name'],
				//'user_type' => $session_data['user_type'],
				'page' => 'index',				
				);
			$data["metadata"] = $metadata;			
			$data["page"] = 1;
			$cdate = date("Y-m-d");
			$data["exam_list"] = $this->students_m->get_exam_schedule($cdate);
			$data["std_info"] = $this->students_m->get_studentinfo($session_data['id']);

			$this->load->view('paycancel',$data);
						
    	}else{
      		//If no session, redirect to login page
      		redirect('students/login', 'refresh');
		}
		
	}
}

?>