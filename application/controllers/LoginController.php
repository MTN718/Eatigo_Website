<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class LoginController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }  

    public function index() {        
        echo "ccc";
    }

    public function validate_user() {

        $this->load->model('Login_Modal');

        $email=$this->input->post('email');
        $password=$this->input->post('password');

        $credential = array('email' => $email, 'password' => $password);
                 
        $row = $this->Login_Modal->checkLogin($credential);

        if (count($row) > 0) {

            //0:customer,1:vendor

            if (0 == $row->role) {

                $this->session->set_userdata('customer_login', '1');  
                $this->session->set_userdata('login_user_id', $row->no);   
                $this->session->set_userdata('name',$row->name);          
                $this->session->set_userdata('login_type','customer');
                $last_page = $this->session->userdata('last_page');
                if(isset($last_page) and $last_page != NULL) {
                redirect($last_page);
                } else {                    
                redirect(base_url() . 'index.php/CustomerController/profile','refresh');
                }
            }
            else if (1 == $row->role) {
                
                $this->session->set_userdata('vendor_login', '1');             
                $this->session->set_userdata('login_user_id', $row->no);            
                $this->session->set_userdata('name',$row->name);   
                $this->session->set_userdata('login_type','vendor');
                redirect(base_url() . 'index.php/VendorController','refresh');
            }       
        }
        $this->session->set_flashdata('loginerror' , 'Invalid User');
        redirect('CustomerController/login'); 
    }

    public function logout() {
        $this->session->unset_userdata('jobposter_login');
        $this->session->unset_userdata('businessposter_login');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'index.php/CustomerController/login', 'refresh');
    }    
}