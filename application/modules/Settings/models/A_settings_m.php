<?php
Class A_settings_m extends CI_Model{

	public function get_registration_control($id)
	{
		$this -> db -> select('*');
		$this -> db -> from(DB_PREFIX.'settings');
		$this -> db -> where('id', $id);
		$query = $this->db->get();
		return $query->first_row();
	}

   
    public function registration_control_update($id,$data) {
        //Transfering data to Model
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update(DB_PREFIX.'settings', $data);		
		$this->db->trans_complete();					
   	} // End of function
	
	public function get_paymentList() {
        $this -> db -> select('t1.*, t2.student_id, t2.st_name, t2.batch');
		$this -> db -> from(DB_PREFIX.'online_payments t1');
		$this->db->join(DB_PREFIX.'student t2', 't2.st_id = t1.onpay_student_id', 'left');
		$this -> db -> order_by('t1.onpay_id','DESC');
		$query = $this->db->get();
		return $query->result();
    } // End of function
	
	public function getotp() {
        $this -> db -> select('t1.*,t2.*');
		$this -> db -> join(DB_PREFIX.'student t2', 't2.st_id = t1.user_id', 'LEFT');
		$this -> db -> from(DB_PREFIX.'login_data t1');
		$this -> db -> limit('300');
		$this-> db -> order_by('t1.login_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
    } // End of function
	
	public function get_smslist() {
        $this -> db -> select('*');
		$this -> db -> from(DB_PREFIX.'sms');
		$this -> db -> order_by('sms_place','ASC');
		$query = $this->db->get();
		return $query->result();
    } // End of function

    public function get_smsdata($id)
	{
		$this -> db -> select('*');
		$this -> db -> from(DB_PREFIX.'sms');
		$this -> db -> where('id', $id);
		$query = $this->db->get();
		return $query->first_row();
	}

	public function sms_update($id,$data) {
        //Transfering data to Model
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update(DB_PREFIX.'sms', $data);		
		$this->db->trans_complete();					
   	} // End of function


}//end of Class 
?>