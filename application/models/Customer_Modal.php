<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_Modal extends CI_Model{

	public function __construct() {

		parent::__construct();
		$this->load->database(); 
	}

	public function create_vendor() {

        $email                      = $this->input->post('email');
        $check_email                = $this->db->get_where('tbl_user', array('email' => $email))->row()->email;
        if($email == $check_email) {
            return false;
        }

        $data['name']         		= $this->input->post('name');
        $data['email']              = $email;
        $data['password']           = $this->input->post('password');
        $data['mobile']   			= $this->input->post('phone');
        $data['address']   			= $this->input->post('address');
        $data['role']       		= '1';

        $this->db->insert('tbl_user',$data);  
        return true;    
    }

    public function create_customer() { 

        $email                      = $this->input->post('email');
        $check_email                = $this->db->get_where('tbl_user', array('email' => $email))->row()->email;
        if($email == $check_email) {
            return false;
        }
        $data['name']               = $this->input->post('name');
        $data['email']              = $this->input->post('email'); 
        $data['password']           = $this->input->post('password');
        $data['mobile']             = $this->input->post('phone');
        $data['role']               = '0';

        $this->db->insert('tbl_user',$data); 
        return true;     
    }

    public function category_list() {  

        $this->db->select('*');
        $this->db->from('tbl_category');
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function restaurant_list() {  

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $rows = $this->db->get()->result();
        return $rows;      
    }

}