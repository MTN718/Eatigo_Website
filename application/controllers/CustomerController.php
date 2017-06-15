<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class CustomerController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }  

    public function index()
    {        
        $this->load->model('Customer_Modal');
        
        $data = $this->getViewParameters('Home','Customer');
        $data['categorylist']  = $this->Customer_Modal->category_list();
        $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();
        $this->load->view('view_customer', $data);                       
    }

    public function login()
    {       
        $data['pageName'] = "LOGIN";
        $this->load->view('view_customer', $data);
    }

    public function register($task="")
    {        

        $this->load->model('Customer_Modal');

        $data['pageName'] = "REGISTER";
        $this->load->view('view_customer', $data);

        if ($task == "create")
        {
            if ($this->Customer_Modal->create_customer()) {

                $this->session->set_flashdata('message' , 'Registration Successful please Login');
                redirect('CustomerController/login');

            } else {

                $this->session->set_flashdata('message' , 'Email Already Present');
                redirect('CustomerController/register');
            }
        }  
    }

    public function profile($active = "1") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['pageName'] = "PROFILE";
        $data['previousorder']  = $this->Customer_Modal->previous_order_list();
        $data['customer']  = $this->Customer_Modal->customer_details();
        $data['currentorder']  = $this->Customer_Modal->current_order_list();
        $data['canceldorder']  = $this->Customer_Modal->cancel_order_list();
        $data['active'] = $active;
        $this->load->view('view_customer', $data);
    }

    // profile page 
    public function contactus() {
        $data['pageName'] = "CONTACTUS";
        $this->load->view('view_customer', $data);
    }

    // function for opening restaurants page 
    public function restaurants() {
        
        $this->load->model('Customer_Modal');  
        
        $data['pageName'] = "RESTAURANTS";
        $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();
        $this->load->view('view_customer', $data);
    }

    // function for opening restaurants page 
    public function location() {
        
        $this->load->model('Customer_Modal');  
        
        $data['pageName'] = "RESTAURANTS";
        $data['restaurantlist']  = $this->Customer_Modal->add_location();
        $this->load->view('view_customer', $data);
    }

    // about us page of footer 
    public function about() {
        $data['pageName'] = "ABOUT";
        $this->load->view('view_customer', $data);   
    }

    public function restaurantlist() {

        $this->load->model('Customer_Modal');

        $data['pageName'] = "RESTAURANTLIST";
        $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();
        $this->load->view('view_customer', $data);   
    }

    public function restaurantdetails($rid = "", $active = "1") {

        $this->load->model('Customer_Modal');

        $data['pageName'] = "RESTAURANTDETAILS";
        $data['restaurantdetails']  = $this->Customer_Modal->restaurant_details($rid);
        $data['restaurantreviews']  = $this->Customer_Modal->restaurant_reviews($rid);
        $data['active'] = $active;
        $this->load->view('view_customer', $data);   
    }

    public function faq() {
        $data['pageName'] = "FAQ";
        $this->load->view('view_customer', $data);      
    }

    public function pricingplan() {
        $data['pageName'] = "PRICINGPLAN";
        $this->load->view('view_customer', $data);      
    }

    public function signupvendor($task="") {

        $this->load->model('Customer_Modal');

        $data['pageName'] = "SIGNUPVENDOR";
        $this->load->view('view_customer', $data);

        if ($task == "create")
        {
            if ($this->Customer_Modal->create_vendor()) {

                $this->session->set_flashdata('message' , 'Registration Successful Please Login');
                redirect('CustomerController/login');

            } else {

                $this->session->set_flashdata('message' , 'Email Already Present');
                redirect('CustomerController/signupvendor');
            }
        } 
    }

    public function shop_checkout() {
        $data['pageName'] = "SHOPCHECKOUT";
        $this->load->view('view_customer', $data);      
    }

    public function update_profile() {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Customer_Modal->update_profile();
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('CustomerController/profile'); 
    }

    public function update_picture() {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Customer_Modal->update_picture();
        $this->session->set_flashdata('message' , 'Profile Picture Updated successfully');
        redirect('CustomerController/profile');
    }

    public function cancel_order($id = "") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Customer_Modal->cancel_order($id);
        $this->session->set_flashdata('message' , 'Profile Picture Updated successfully');
        redirect('CustomerController/profile/3');
    }

    public function add_review() {

        $this->load->model('Customer_Modal');
        
        $rid = $this->Customer_Modal->add_reviews();
        redirect('CustomerController/restaurantdetails/'.$rid.'/2');
    }

    
}
