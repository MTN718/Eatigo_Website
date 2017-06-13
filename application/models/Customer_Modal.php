<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_Modal extends CI_Model{

	public function __construct() {

		parent::__construct();
		$this->load->database(); 
	}

	public function create_vendor() { 

        $data['name']         		= $this->input->post('name');
        $data['email']              = $this->input->post('email'); 
        $data['password']           = $this->input->post('password');
        $data['mobile']   			= $this->input->post('phone');
        $data['address']   			= $this->input->post('address');
        $data['role']       		= '1';

        $this->db->insert('tbl_user',$data);      
    }

    public function create_customer() { 

        $data['name']               = $this->input->post('name');
        $data['email']              = $this->input->post('email'); 
        $data['password']           = $this->input->post('password');
        $data['mobile']             = $this->input->post('phone');
        $data['role']               = '0';

        $this->db->insert('tbl_user',$data);      
    }

}