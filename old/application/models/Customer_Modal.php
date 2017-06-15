<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_Modal extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function create_vendor() {

        $email                      = $this->input->post('email');

        $this->db->select('*');
        $this->db->where('email',$email);
        $query = $this->db->get('tbl_user');
        $num = $query->num_rows();
        if($num > 0) {
            return false;   
        }
        $data['name']               = $this->input->post('name');
        $data['email']              = $email;
        $data['password']           = $this->input->post('password');
        $data['mobile']             = $this->input->post('phone');
        $data['address']            = $this->input->post('address');
        $data['role']               = '1';
        $this->db->insert('tbl_user',$data);  
        return true;    
    }
    
     public function create_fb_user($model_data) {
        $name = $model_data['name'];
        $email = $model_data['email'];
        $type = '1';
        $role = '0';

        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('email',$email);
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        if($rowcount > 0) {
            return true;
        }
        
        $sql = "INSERT INTO tbl_user(name,email,type,role) VALUES('$name','$email','$type','$role') ";
        $result = $this->db->query($sql);
        return true;
    }

    public function create_customer() { 

        $email                      = $this->input->post('email');
        $this->db->select('*');
        $this->db->where('email',$email);
        $query = $this->db->get('tbl_user');
        $num = $query->num_rows();
        if($num > 0) {
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

    public function customer_details() {  

        $uid = $this->session->userdata('login_user_id');       

        $sql = $this->db->get_where('tbl_user', array('no' => $uid));
        $result = $sql->row();
        return $result;      
    }

    public function previous_order_list() {  

        $uid = $this->session->userdata('login_user_id');       

        $this->db->select('*');
        $this->db->from('tbl_reservation');
        $this->db->where('uid', $uid);
        $this->db->where('state', 1);
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function current_order_list() {  

        $uid = $this->session->userdata('login_user_id');       

        $this->db->select('*');
        $this->db->from('tbl_reservation');
        $this->db->where('uid', $uid);
        $this->db->where('state', 0);
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function cancel_order_list() {  

        $uid = $this->session->userdata('login_user_id');       

        $this->db->select('*');
        $this->db->from('tbl_reservation');
        $this->db->where('uid', $uid);
        $this->db->where('state', 3);
        $rows = $this->db->get()->result();
        return $rows;      
    }

    public function update_profile() { 

        $user_id                    = $this->session->userdata('login_user_id');

        $data['name']            = $this->input->post('name'); 
        $data['email']         = $this->input->post('email');
        $data['mobile']           = $this->input->post('mobile');

        $this->db->where('no',$user_id);
        $this->db->update('tbl_user',$data);      
    }

    public function update_picture() { 

        $user_id                = $this->session->userdata('login_user_id');

        if (isset($_FILES['image'])) {
            $imageFile = $this->utils->uploadImage($_FILES['image'], 0, 300, 300);
            if ($imageFile == "")       $data['image'] = 
                $imageFile = $data->image;
        }
        $data['image'] = $imageFile;
        $this->db->where('no',$user_id);
        $this->db->update('tbl_user',$data);      
    }

    public function cancel_order($id = "") { 

        $data['state']            = 3; 

        $this->db->where('no',$id);
        $this->db->update('tbl_reservation',$data);      
    }

}