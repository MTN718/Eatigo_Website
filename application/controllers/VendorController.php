<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class VendorController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    

    public function index() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
        $this->load->view('view_customer', $data);               
    }

    public function add_restaurant($task="") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $this->load->view('view_customer', $data); 

        if ($task == "create")
        {
            $this->Vendor_Modal->create_restaurant();
            $this->session->set_flashdata('message' , 'user_info_added_successfuly');
            redirect('VendorController');
        }  
    }
    
}
