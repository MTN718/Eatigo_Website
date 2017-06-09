<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class CustomerController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    
    public function index()
    {        
        $data = $this->getViewParameters('Home','Customer');
        $data['isLogin'] = false;
        $this->load->view('view_customer', $data);                        
    }
    public function login()
    {
//        $data = $this->getViewParameters('Login','Customer');
//        $data['isLogin'] = false;
//        $this->load->view('view_customer', $data);        
        $data['pageName'] = "LOGIN";
        $this->load->view('view_customer', $data);
    }
    public function register()
    {
//        $data = $this->getViewParameters('Login','Customer');
//        $data['isLogin'] = false;
//        $this->load->view('view_customer', $data);        
        $data['pageName'] = "REGISTER";
        $this->load->view('view_customer', $data);
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
}
