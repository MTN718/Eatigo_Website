<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class CustomerController extends BaseController {

    function __construct() {
        parent::__construct();                
    }  

    public function index()
    {        if($this->session->fb_login == 1) {
        $data['fb_logged_in'] = true;
        }
        $this->load->model('Customer_Modal');
        
        $data = $this->getViewParameters('Home','Customer');
        $data['categorylist']  = $this->Customer_Modal->category_list();
        $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();
        $data['reviews']  = $this->Customer_Modal->get_reviews();
        $data['times']  = $this->Customer_Modal->get_time();
        $this->load->view('view_customer', $data);                       
    }

    public function login()
    {        
        if($this->session->fb_login == 1 || $this->session->customer_login == 1) {
        	 redirect('CustomerController');
        }
        else {
        $data['pageName'] = "LOGIN";
            $this->load->view('view_customer', $data);
        }
    }
    
    public function fb_login() {
	    $this->load->model('Customer_Modal');
	        
	        $model_data = array(
	        'name' => $this->input->get('name'),
	        'email' => $this->input->get('email'),
	        );         
	            $data['status'] = $this->Customer_Modal->create_fb_user($model_data);
	            if($data['status'] == true)
	            {
	            	$row = $this->db->get_where('tbl_user', array('email' => $model_data['email']))->row();
                	$this->session->set_userdata('login_user_id', $row->no);
	            	$this->session->set_userdata('fb_login', '1'); 
	            	$this->session->set_userdata('customer_login', '1'); 
                	$this->session->set_userdata('login_type','customer'); 
	            redirect('CustomerController');
	            }
	        $data['pageName'] = "LOGIN";
	        $this->load->view('view_customer', $data);
    }

    public function fb_logout()
    {
        $this->session->unset_userdata('fb_login');
        $this->session->sess_destroy();
   
        redirect('CustomerController/login');
    }

    public function fb_profile() {
    if($this->session->fb_login == 1) {
        $data['fb_logged_in'] = true;
        $data['pageName'] = "PROFILE";
        $this->load->view('view_customer', $data);
        }
        else {
        redirect('CustomerController/login');
        }
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
            redirect('CustomerController/login');
        }
        
        $data['pageName'] = "PROFILE";
        $data['previousorder']  = $this->Customer_Modal->previous_order_list();
        $data['customer']  = $this->Customer_Modal->customer_details();
        $data['currentorder']  = $this->Customer_Modal->current_order_list();
        $data['canceldorder']  = $this->Customer_Modal->cancel_order_list();
        $data['cardlist']  = $this->Customer_Modal->card_list();
        $data['active'] = $active;
        $this->load->view('view_customer', $data);
    }

    // profile page 
    public function contactus() {
        $data['pageName'] = "CONTACTUS";
        $this->load->view('view_customer', $data);
    }

    // function for opening restaurants page 

    public function restaurants($categoryid = "") {

        $this->load->model('Customer_Modal');  
        
        $data['pageName'] = "RESTAURANTS";

        if(isset($categoryid) and $categoryid != NULL) {
            $data['restaurantlist']  = $this->Customer_Modal->category_restaurant_list($categoryid);
        } else {   
            $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();         
        }

        $data['discount']  = $this->Customer_Modal->base_discount();
        $data['categories']  = $this->Customer_Modal->category_list();
        $data['category_id'] = $categoryid;
        $this->load->view('view_customer', $data);
    }

    // function for opening restaurants page 
    public function refine_restaurants($categoryid = "") {

        $this->load->model('Customer_Modal');  
        
        $data['pageName'] = "RESTAURANTS";

        if(isset($categoryid) and $categoryid != NULL) {
            $data['restaurantlist']  = $this->Customer_Modal->refine_category_restaurant_list($categoryid);
        } else {   
            $data['restaurantlist']  = $this->Customer_Modal->refine_restaurant_list();         
        }

        $data['discount']  = $this->Customer_Modal->base_discount();
        $data['categories']  = $this->Customer_Modal->category_list();
        $data['category_id'] = $categoryid;
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

    public function restaurantlist($categoryid = "") {


        $this->load->model('Customer_Modal');

        $data['pageName'] = "RESTAURANTLIST";

        if(isset($categoryid) and $categoryid != NULL) {
            $data['restaurantlist']  = $this->Customer_Modal->category_restaurant_list($categoryid);
        } else {            
            $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();
        }
        $data['category_id'] = $categoryid;
        $this->load->view('view_customer', $data);   
    }

    public function restaurantdetails($rid = "", $active = "1") {
        $this->load->model('Customer_Modal');
        $data['pageName'] = "RESTAURANTDETAILS";
        $data['restaurantdetails']  = $this->Customer_Modal->restaurant_details($rid);
        $data['restaurantreviews']  = $this->Customer_Modal->restaurant_reviews($rid);
        $data['restaurantimages']  = $this->Customer_Modal->restaurant_images($rid);
        $data['restaurantdiscounts']  = $this->Customer_Modal->restaurant_discount($rid);
        $data['customerdetails']  = $this->Customer_Modal->customer_details();
        $data['savedcards'] = $this->Customer_Modal->card_list();
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

    public function shop_checkout($rid = "") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($_SESSION['reserve_status'] == 0 )
        { 
            $rrid = $this->db->get_where('tbl_reservation', array('no' => $rid))->row();
            $this->Customer_Modal->delete_recent_row($rid);
            redirect('CustomerController/restaurantdetails/'.$rrid->rid, 'refresh'); 
        }

        $data['pageName'] = "SHOPCHECKOUT";
        $data['reservation']  = $this->Customer_Modal->reservation_details($rid);
        $_SESSION['reserve_status'] = 0;
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

    public function getrestaurantsbysearch($categoryid = "") {
        $this->load->model('Customer_Modal');
        $model_data = array(
            'date' => $this->input->post('date'),
            'search_time' => $this->input->post('search_time'),
            'noofperson' => $this->input->post('noofperson'),
        );
        $model_data1 = array(
            'restaurantname' => $this->input->post('restaurantname'), 
        );

        if($model_data1['restaurantname'] != '') {
            $data['restaurantlist'] = $this->Customer_Modal->get_restaurants_by_search_name($model_data1);
            $data['pageName'] = "SEARCHRESTAURANTS";
            $data['category_id'] = $categoryid;
            $this->load->view('view_customer', $data); 
        }
        else {
            $data['restaurantlist'] = $this->Customer_Modal->get_restaurants_by_search($model_data);
            $data['pageName'] = "SEARCHRESTAURANTS";
            $data['category_id'] = $categoryid;
            $this->load->view('view_customer', $data); 
        }
    }
    public function booking($rid = "") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $reservation_id = $this->Customer_Modal->booking($rid);

        if ($reservation_id == false)
        {
            $this->session->set_flashdata('booking_error' , 'Number of seat are not available');
            redirect('CustomerController/restaurantdetails/'.$rid); 
        }

        $_SESSION['reserve_status'] = 1;
        redirect('CustomerController/shop_checkout/'.$reservation_id); 
    }

    public function delete_order($oid="") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $rid = $this->Customer_Modal->delete_order($oid);
        redirect('CustomerController/restaurantdetails/'.$rid);
    }

    public function confirm_payment($id="", $amt="", $cardid="") {


        $this->load->model('Customer_Modal');
        $carddetails = $this->Customer_Modal->getcarddetails($cardid);
        $cardnumber  = $carddetails->cardnumber;
        $expmonth = $carddetails->expirymonth;
        $expyear = $carddetails->expiryyear;
        $security = $carddetails->security;
        $price = $amt;
        $reservationid = $id;
        // Checkout
        // $transactionId = $this->stripe->checkOut($cardnumber, $expmonth, $expyear, $security, $price);
            $transactionId = $this->stripe->testCheckout();

            if ($transactionId != false) {
               $status = $this->Customer_Modal->payment_complete($transactionId,$reservationid);         
               if($status==true) {
                    redirect('CustomerController/profile/2');
               }
            }
    }

    public function confirm_order($oid="") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $this->Customer_Modal->confirm_order($oid);
        redirect('CustomerController/profile/2');
    }

    public function check_seat($rid = "") {

        $this->load->model('Customer_Modal');

        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $status = $this->Customer_Modal->check_seat($rid);

        if ($status == true) {
            $this->session->set_flashdata('booking_error' , 'Number of seat are not available');
            echo json_encode(array("status"=>"true"));
        } else {
            $this->session->set_flashdata('booking_error' , 'Number of seat available');
            echo json_encode(array("status"=>"flase"));
        }
    }

    public function add_card() {

        $this->load->model('Customer_Modal');  
        
        if ($this->session->userdata('customer_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data = $this->Customer_Modal->add_card();
        if($data == false)
        {
             $this->session->set_flashdata('error_card' , 'Card Already exist');
             redirect('CustomerController/profile/5');
        }
        if($data == true)
        {
             redirect('CustomerController/profile/4');
        }
    }

    public function card_delete($cid = "") {

        $this->load->model('Customer_Modal');
        
        $rid = $this->Customer_Modal->cardno_delete($cid);
        redirect('CustomerController/profile/4');
    }

    
}
