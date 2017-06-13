<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class VendorController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    

    public function index($active="1") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
        $data['vendor']  = $this->Vendor_Modal->vendore_details();
        $data['resto_no']  = $this->Vendor_Modal->total_restaurant();
        $data['discountlist']  = $this->Vendor_Modal->discount_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['active'] = $active;
        $this->load->view('view_customer', $data);               
    }

    public function add_restaurant() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        } 
            
        $this->Vendor_Modal->create_restaurant();
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('VendorController/index/1'); 
    }

    public function delete_restaurant($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        } 
            
        $this->Vendor_Modal->delete_restaurant($id);
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('VendorController/index/1'); 
    }

    public function view_restaurant($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
        $data['vendor']  = $this->Vendor_Modal->vendore_details();
        $data['resto_no']  = $this->Vendor_Modal->total_restaurant();
        $data['discountlist']  = $this->Vendor_Modal->discount_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['selected_restaurant'] =  $this->Vendor_Modal->selected_restaurant($id);
        $data['active'] = 'update_restaurant';
        $this->load->view('view_customer', $data);  
    }

    public function update_restaurant($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Vendor_Modal->update_restaurant($id);
        $this->session->set_flashdata('message' , 'Restaurant Updated successfully');
        redirect('VendorController/index/1');  
    }

    public function add_discount() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Vendor_Modal->add_discount();
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('VendorController/index/2'); 
    }

    public function delete_discount($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        } 
            
        $this->Vendor_Modal->delete_discount($id);
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('VendorController/index/2'); 
    }

    public function view_discount($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
        $data['vendor']  = $this->Vendor_Modal->vendore_details();
        $data['resto_no']  = $this->Vendor_Modal->total_restaurant();
        $data['discountlist']  = $this->Vendor_Modal->discount_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['selected_discount'] =  $this->Vendor_Modal->selected_discount($id);
        $data['active'] = 'update_discount';
        $this->load->view('view_customer', $data);  
    }

    public function update_discount($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Vendor_Modal->update_discount($id);
        $this->session->set_flashdata('message' , 'Discount Updated successfully');
        redirect('VendorController/index/2');  
    }

    public function update_profile() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Vendor_Modal->update_profile();
        $this->session->set_flashdata('message' , 'user_info_added_successfuly');
        redirect('VendorController'); 
    }

    public function update_picture() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Vendor_Modal->update_picture();
        $this->session->set_flashdata('message' , 'Profile Picture Updated successfully');
        redirect('VendorController'); 
    }
    
}
