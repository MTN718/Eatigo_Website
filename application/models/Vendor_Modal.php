<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_Modal extends CI_Model{

	public function __construct() {
		parent::__construct();
		$this->load->database(); 
	}

	public function create_restaurant() { 

    	$user_id   			= $this->session->userdata('login_user_id');

        $data['reviews']            = $this->input->post('radio1');
        $data['level']             = $this->input->post('radio2');
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

    public function delete_restaurant($id = "") { 

        $this->db->where('no', $id);
        $this->db->delete('tbl_restaurant');  
    }

    public function vendore_details() {  

        $uid = $this->session->userdata('login_user_id');       

        $sql = $this->db->get_where('tbl_user', array('no' => $uid));
        $result = $sql->row();
        return $result;      
    }

    public function selected_discount($id = "") {  

        $uid = $this->session->userdata('login_user_id');

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $this->db->join('tbl_map_discount_restaurant', 'tbl_map_discount_restaurant.rid = tbl_restaurant.no');
        $this->db->where('tbl_map_discount_restaurant.no', $id);
        $row = $this->db->get()->row();
        return $row;     
    }

    public function selected_restaurant($id = "") {  

        $uid = $this->session->userdata('login_user_id');

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $this->db->where('no', $id);
        $row = $this->db->get()->row();
        return $row;     
    }

    public function restaurent_list() {  

        $uid = $this->session->userdata('login_user_id');       

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $this->db->where('uid =', $uid);
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function discount_list() {  

        $this->db->select('*');
        $this->db->from('tbl_base_discount');
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function discountdata_list() {  

        $uid = $this->session->userdata('login_user_id');

        $this->db->select('*');
        $this->db->from('tbl_restaurant');
        $this->db->join('tbl_map_discount_restaurant', 'tbl_map_discount_restaurant.rid = tbl_restaurant.no');
        $this->db->where('tbl_restaurant.uid', $uid);
        $rows = $this->db->get()->result();
        return $rows;             
    }

    public function update_profile() { 

        $user_id                    = $this->session->userdata('login_user_id');

        $data['name']            = $this->input->post('name');
        $data['address']               = $this->input->post('address'); 
        $data['email']         = $this->input->post('email');
        $data['mobile']           = $this->input->post('mobile');

        $this->db->where('no',$user_id);
        $this->db->update('tbl_user',$data);      
    }

    public function update_discount($id = "") { 

        $data['rid']            = $this->input->post('resto');
        $data['rtime']          = $this->input->post('discount_time'); 
        $data['did']            = $this->input->post('discount'); 
        $data['amount']         = $this->input->post('no_people');
        $data['status']         = 0;

        $this->db->where('no',$id);
        $this->db->update('tbl_map_discount_restaurant',$data);      
    }

    public function update_restaurant($id = "") { 

        $data['reviews']            = $this->input->post('radio1');
        $data['level']              = $this->input->post('radio2');
        $data['name']               = $this->input->post('name'); 
        $data['start_time']         = $this->input->post('start_time');
        $data['end_time']           = $this->input->post('end_time');
        $data['address']            = $this->input->post('address');
        $data['lat']                = $this->input->post('lat');
        $data['lng']                = $this->input->post('lng');
        $data['about']              = $this->input->post('description');

        $this->db->where('no',$id);
        $this->db->update('tbl_restaurant',$data);      
    }

    public function total_restaurant() {  

        $uid = $this->session->userdata('login_user_id');       

        $sql = $this->db->get_where('tbl_restaurant', array('uid' => $uid));
        $result = $sql->num_rows();
        return $result;      
    }

    public function add_discount() { 

        $data['rid']            = $this->input->post('resto');
        $data['rtime']          = $this->input->post('discount_time'); 
        $data['did']            = $this->input->post('discount'); 
        $data['amount']         = $this->input->post('no_people');
        $data['status']         = 0;

        $this->db->insert('tbl_map_discount_restaurant',$data);      
    }

    public function delete_discount($id = "") { 

        $this->db->where('no', $id);
        $this->db->delete('tbl_map_discount_restaurant');  
    }

    public function update_picture() { 

        $user_id                = $this->session->userdata('login_user_id');

        if (isset($_FILES['image'])) {
            $imageFile = $this->utils->uploadImage($_FILES['image'], 0, 317, 236);
            if ($imageFile == "")       $data['image'] = 
                $imageFile = $data->image;
        }
        $data['image'] = $imageFile;
        $this->db->where('no',$user_id);
        $this->db->update('tbl_user',$data);      
    }
}