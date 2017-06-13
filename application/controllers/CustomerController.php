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

    public function profile() {
        $data['pageName'] = "PROFILE";
        $this->load->view('view_customer', $data);
    }

    // profile page 
    public function contactus() {
        $data['pageName'] = "CONTACTUS";
        $this->load->view('view_customer', $data);
    }

    // function for opening restaurants page 
    public function restaurants() {
        $data['pageName'] = "RESTAURANTS";
        $this->load->view('view_customer', $data);
    }

    // about us page of footer 
    public function about() {
        $data['pageName'] = "ABOUT";
        $this->load->view('view_customer', $data);   
    }

    public function restaurantlist() {
        $data['pageName'] = "RESTAURANTLIST";
        $this->load->view('view_customer', $data);   
    }

    public function restaurantdetails() {
        $data['pageName'] = "RESTAURANTDETAILS";
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
    
}
