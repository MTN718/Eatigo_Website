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
        echo "aaa";
    }
    public function register()
    {
//        $data = $this->getViewParameters('Login','Customer');
//        $data['isLogin'] = false;
//        $this->load->view('view_customer', $data);        
        echo "bbb";
    }
}
