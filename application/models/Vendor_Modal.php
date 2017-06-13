<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_Modal extends CI_Model{

	public function __construct() {
		parent::__construct();
		$this->load->database(); 
	}

	public function create_restaurant() { 

    	$user_id   			= $this->session->userdata('login_user_id');

        $data['reviews']         	= $this->input->post('radio1');
        $data['name']              	= $this->input->post('name'); 
        $data['start_time']        	= $this->input->post('start_time');
        $data['end_time']   		= $this->input->post('end_time');
        $data['address']   			= $this->input->post('address');
        $data['lat']   				= $this->input->post('lat');
        $data['lng']   				= $this->input->post('lng');
        $data['about']   			= $this->input->post('description');
        $data['uid']			= $user_id;

        $this->db->insert('tbl_restaurant',$data);      
    }

    public function restaurent_list() {  

        $uid = $this->session->userdata('login_user_id');       

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $this->db->where('uid =', $uid);
        $rows = $this->db->get()->result();
        return $rows;      
    }

}