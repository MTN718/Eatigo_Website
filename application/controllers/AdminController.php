<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class AdminController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    
    public function index()
    {        
        echo "ccc";
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
