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
                redirect(base_url() . 'index.php/CustomerController','refresh');
            }
            else if (1 == $row->role) {
                
                $this->session->set_userdata('vendor_login', '1');             
                $this->session->set_userdata('login_user_id', $row->no);            
                $this->session->set_userdata('name',$row->name);           
                $this->session->set_userdata('login_type','vendor');
                redirect(base_url() . 'index.php/VendorController','refresh');
            }       
        }
        
        redirect('CustomerController/login'); 
    }    
}