<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class VendorController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    

    public function index() {

        if ($this->session->userdata('vendor_login') != 1)
        {
            $data = $this->session->userdata('name');
            print_r($data);
            print_r("sudeep");
            exit();

            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['pageName'] = "PROFILE";
        $this->load->view('view_customer', $data);               
    }
    
}
