<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class VendorController extends BaseController {
    
    function __construct() {
        parent::__construct();                
    }    

    public function index($active = "1") {

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
        $data['categorytlist']  = $this->Vendor_Modal->category_list();
        $data['subcategorytlist']  = $this->Vendor_Modal->subcategory_list();
        $data['languagelist']  = $this->Vendor_Modal->language_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['active'] = $active;
        $this->load->view('view_customer', $data);               
    }

    public function add_restaurant() {
        $this->load->model('Vendor_Modal');            
        $status = $this->Vendor_Modal->create_restaurant();

        if($status == "false") {
            
            $this->load->model('Vendor_Modal'); 
            unset($_SESSION['file_name']);

            if ($this->session->userdata('vendor_login') != 1)
            {
                $this->session->set_userdata('last_page' , current_url());
                redirect(base_url(), 'refresh');
            }
            
            $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
            $data['vendor']  = $this->Vendor_Modal->vendore_details();
            $data['resto_no']  = $this->Vendor_Modal->total_restaurant();
            $data['discountlist']  = $this->Vendor_Modal->discount_list();
            $data['categorytlist']  = $this->Vendor_Modal->category_list();
            $data['subcategorytlist']  = $this->Vendor_Modal->subcategory_list();
            $data['languagelist']  = $this->Vendor_Modal->language_list();
            $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
            $data['active'] = 'update_restaurant';
            $this->session->set_flashdata('img_error' , 'Need to upload atleast one image of restaurant at the time of registration.');
            redirect('VendorController/index/update_restaurant'); 
        }
        
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
        $data['categorytlist']  = $this->Vendor_Modal->category_list();
        $data['subcategorytlist']  = $this->Vendor_Modal->subcategory_list();
        $data['languagelist']  = $this->Vendor_Modal->language_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['selected_restaurant'] =  $this->Vendor_Modal->selected_restaurant($id);
        $data['selected_category'] =  $this->Vendor_Modal->selected_category($id);
        $data['selected_subcategorytlist'] =  $this->Vendor_Modal->selected_subcategorytlist($id);
        $data['selected_language'] =  $this->Vendor_Modal->selected_language($id);
        $data['selected_image'] =  $this->Vendor_Modal->selected_image($id);
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
        
        $result = $this->Vendor_Modal->update_restaurant($id);
        if (isset($result) and $result != NULL) {

            $this->session->set_flashdata('img_error' , 'Need to upload atleast one image of restaurant at the time of Updation.');  
            redirect('VendorController/view_restaurant/'.$result); 
            
        } else {
             
            redirect('VendorController/index/1'); 
        } 
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

    public function delete_image($id = "") {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        } 
            
        $resto_id = $this->Vendor_Modal->delete_image($id); 
        echo json_encode(array("status"=>"done"));
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
        $data['categorytlist']  = $this->Vendor_Modal->category_list();
        $data['subcategorytlist']  = $this->Vendor_Modal->subcategory_list();
        $data['languagelist']  = $this->Vendor_Modal->language_list();
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

    public function update_restauranttime() {

        $this->load->model('Vendor_Modal');

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $resto_id = $this->Vendor_Modal->update_restauranttime();
        redirect('VendorController/view_restaurant/'.$resto_id); 
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

    public function upload_resto_image() {

        $this->load->model('Vendor_Modal');
        $this->Vendor_Modal->upload_resto_image();
    }

    public function add_restaurant_page() {  

        $this->load->model('Vendor_Modal'); 
        unset($_SESSION['file_name']);

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
        $data['categorytlist']  = $this->Vendor_Modal->category_list();
        $data['subcategorytlist']  = $this->Vendor_Modal->subcategory_list();
        $data['languagelist']  = $this->Vendor_Modal->language_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();
        $data['active'] = 'update_restaurant';
        $this->load->view('view_customer', $data);  
    }

    public function view_reservation($rid = "") {  

        $this->load->model('Vendor_Modal'); 

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $data = $this->getViewParameters('VENDORPROFILE','Customer');
        $reservation = $this->Vendor_Modal->reservation($rid);
        $data['reservation']  = $reservation;
        $data['user']  = $this->Vendor_Modal->customer($reservation->uid);
        $data['restaurant']  = $this->Vendor_Modal->selected_restaurant($reservation->rid);
        $data['selected_resto_discount']  = $this->Vendor_Modal->selected_resto_discount($reservation->did);
        $data['restaurantlist']  = $this->Vendor_Modal->restaurent_list();
        $data['vendor']  = $this->Vendor_Modal->vendore_details();
        $data['resto_no']  = $this->Vendor_Modal->total_restaurant();
        $data['discountlist']  = $this->Vendor_Modal->discount_list();
        $data['categorytlist']  = $this->Vendor_Modal->category_list();
        $data['languagelist']  = $this->Vendor_Modal->language_list();
        $data['discountdatalist']  = $this->Vendor_Modal->discountdata_list();

        $data['active'] = 'view_reservation';
        $this->load->view('view_customer', $data);  
    }

    public function complete_reservation($rid = "") {  

        $this->load->model('Vendor_Modal'); 

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $this->Vendor_Modal->complete_reservation($rid);
        redirect('VendorController/index/3'); 
    }

    public function cancel_reservation($rid = "") {  

        $this->load->model('Vendor_Modal'); 

        if ($this->session->userdata('vendor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $this->Vendor_Modal->cancel_reservation($rid);
        redirect('VendorController/index/3'); 
    }
    
}
