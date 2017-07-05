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

    $data = $this->getViewParameters('Home', 'Customer');
    $data['categorylist']  = $this->Customer_Modal->category_list();
    $data['discountlist']  = $this->Customer_Modal->base_discount();
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

public function complete_order($id="") {
    $this->load->model('Customer_Modal');
    $status = $this->Customer_Modal->complete_order($id);
    redirect('CustomerController/profile/2');
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

public function subcategory($categoryid = "") {

    $this->load->model('Customer_Modal');  

    $data['pageName'] = "SUBCATEGORY";

    $data['subcategorylist']  = $this->Customer_Modal->sub_category_list($categoryid);
    $data['categories']  = $this->Customer_Modal->category_list();
    $data['category_id'] = $categoryid;
    $this->load->view('view_customer', $data);
}

    // function for opening restaurants page 

public function restaurants($subcategoryid = "") {

    $this->load->model('Customer_Modal');  

    $data['pageName'] = "RESTAURANTS";

    if(isset($subcategoryid) and $subcategoryid != NULL) {
        $data['restaurantlist']  = $this->Customer_Modal->subcategory_restaurant_list($subcategoryid);
    } else {   
        $data['restaurantlist']  = $this->Customer_Modal->restaurant_list();         
    }

    $data['discount']  = $this->Customer_Modal->base_discount();
    $data['subcategories']  = $this->Customer_Modal->subcategory_list();
    $data['subcategory_id'] = $subcategoryid;      
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

    public function restaurantdetails($rid = "", $active = "1", $reserv_id = "") {
        $this->load->model('Customer_Modal');

        $data['pageName'] = "RESTAURANTDETAILS";
        $data['restaurantdetails']  = $this->Customer_Modal->restaurant_details($rid);
        $data['restaurantreviews']  = $this->Customer_Modal->restaurant_reviews($rid);
        $data['restaurantimages']  = $this->Customer_Modal->restaurant_images($rid);
        $data['restaurantdiscounts']  = $this->Customer_Modal->restaurant_discount($rid);
        $data['customerdetails']  = $this->Customer_Modal->customer_details();
        $data['savedcards'] = $this->Customer_Modal->card_list();
        $data['rating'] = $this->Customer_Modal->restaurantrating($rid);

        $noofrids = $data['rating']['noofrids'];
        $totalrating = $data['rating']['totalrating'];

        if ($noofrids == 0)
        {
            $temprating = 0;
        }    

        if ($noofrids != 0)
        {
            $temprating = $totalrating/$noofrids;            
        }
        $data['mainrating'] = round($temprating);

        if (isset($reserv_id) and $reserv_id != NULL) {
            $data['reserv_id'] = $reserv_id;
        }

        $data['active'] = $active;
        $this->load->view('view_customer', $data);   
    }

public function faq() {
    $this->load->model('Customer_Modal');
    $data['faqs'] = $this->Customer_Modal->getFaqs();
    $data['pageName'] = "FAQ";
    $this->load->view('view_customer', $data);      
}

public function terms() {
    $this->load->model('Customer_Modal');
    $data['terms'] = $this->Customer_Modal->getTerms();
    $data['pageName'] = "TERMS";
    $this->load->view('view_customer', $data);      
}

public function pricingplan() {
    $this->load->model('Customer_Modal');
    $data['membershipplanlist'] = $this->Customer_Modal->membershipplan();
    $data['pageName'] = "PRICINGPLAN";
    if ($this->session->userdata('customer_login') == 1)
    {
        $data['usercardlist'] = $this->Customer_Modal->card_list();
        $data['usercurrentplan'] = $this->Customer_Modal->customer_details();
    }
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
    redirect('CustomerController/profile/1');
}


     public function add_review($restro_id = "", $reserv_id = "") {

        $this->load->model('Customer_Modal');
        
        redirect('CustomerController/restaurantdetails/'.$restro_id.'/4/'.$reserv_id);
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

    if ($reservation_id == "credit_error")
    {
        $this->session->set_flashdata('booking_error' , 'Not have enough Credit');
        redirect('CustomerController/restaurantdetails/'.$rid); 
    }

    if (isset($reservation_id) and $reservation_id != NUll) {
        $status = $this->Customer_Modal->payment_complete($reservation_id);         
        if($status==true)
            redirect('CustomerController/profile/2');
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

    if($id == "add_credit") {

        $user_id = $this->session->userdata('login_user_id');
        $cardid = $this->input->post('card_id');
        $planid = $this->input->post('plan_id');
        $carddetails = $this->Customer_Modal->getcarddetails($cardid);
        $plandetails = $this->Customer_Modal->getplandetails($planid);
        $cardnumber  = $carddetails->cardnumber;
        $expmonth = $carddetails->expmonth;
        $expyear = $carddetails->expyear;
        $security = $carddetails->security;
        $price = $plandetails->price;
        $credit = $plandetails->credit;
            //for updating user credit
        $this->Customer_Modal->updateusercredit($planid,$credit,$price);
        redirect('CustomerController/profile/6');

    } else {

        $carddetails = $this->Customer_Modal->getcarddetails($cardid);
        $cardnumber  = $carddetails->cardnumber;
        $expmonth = $carddetails->expmonth;
        $expyear = $carddetails->expyear;
        $security = $carddetails->security;
        $price = $amt;
        $reservationid = $id;
    }          

        // Checkout
    $transactionId = $this->stripe->checkOut($cardnumber, $expmonth, $expyear, $security, $price);
            //$transactionId = $this->stripe->testCheckout();

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


public function aboutusPage()
{
    $data = $this->getViewParameters('ABOUTUS', 'Customer');                        
    $content = $this->sqllibs->getOneRow($this->db, 'tbl_contactus', null);        
    $data['content'] = $content;
    $this->load->view('view_customer', $data); 
}

public function termPage()
{
    $data = $this->getViewParameters('TERMS', 'Customer');                        
    $content = $this->sqllibs->getOneRow($this->db, 'tbl_terms', null);        
    $data['content'] = $content;
    $this->load->view('view_customer', $data); 
}

public function faqPage()
{
    $data = $this->getViewParameters('FAQ', 'Customer');                        
    $content = $this->sqllibs->getOneRow($this->db, 'tbl_faq', null);        
    $data['content'] = $content;
    $this->load->view('view_customer', $data);         
}

public function ajaxSearchRestaurant()
{
    $postVars = $this->utils->inflatePost(array('discount','level','rate','subcategory'));        
    $sql = "";
    if ($postVars['discount'] == '')
        $sql = "select no as rid from tbl_restaurant";            
    else $sql = "select B.rid from tbl_base_discount as A left join tbl_map_discount_restaurant as B on A.no = B.did where A.percent >='".$postVars['discount']."' group by B.rid";        
    $rids = $this->sqllibs->rawSelectSql($this->db, $sql);        

    $sqlIn = "";
    foreach ($postVars['level'] as $level) {
        $sqlIn = $sqlIn . $level . ",";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
    if ($sqlIn !='')
    {
        $sql = "select no as rid from tbl_restaurant where level in (".$sqlIn.")";            
    }
    else
        $sql = "select no as rid from tbl_restaurant";            
    $rids2 = $this->sqllibs->rawSelectSql($this->db, $sql);


    $sqlIn = "";
    foreach ($postVars['subcategory'] as $cat) {
        $sqlIn = $sqlIn . $cat . ",";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);

    if ($sqlIn !='')
    {
        $sql = "select no as rid from tbl_map_sub_restaurant where sid in (".$sqlIn.")";
    }
    else
        $sql = "select no as rid from tbl_restaurant";      


    $rids3 = $this->sqllibs->rawSelectSql($this->db, $sql);        


    $sqlIn = "";
    foreach($postVars['rate'] as $rate)
    {
        $minPrice = $rate - 0.5;
        $maxPrice = $rate + 0.5;            
        $sqlIn = $sqlIn." (avgrate >='".$minPrice."' and avgrate <'".$maxPrice."') or";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 3);        

    if ($sqlIn !='')
    {
        $sql = "select no as rid from tbl_restaurant where ".$sqlIn;
    }
    else
        $sql = "select no as rid from tbl_restaurant";            
    $rids4 = $this->sqllibs->rawSelectSql($this->db, $sql);     

    $array1 = array();
    $array2 = array();
    $array3 = array();
    $array4 = array();
    foreach ($rids as $rid) 
        $array1[] = $rid->rid;        
    foreach ($rids2 as $rid) 
        $array2[] = $rid->rid;        
    foreach ($rids3 as $rid) 
        $array3[] = $rid->rid;                
    foreach ($rids4 as $rid) 
        $array4[] = $rid->rid;   
    $ridArray = array_intersect($array1, $array2,$array3,$array4);        
    if (count($ridArray) == 0)
    {
        $result = array();
        $result['restaurants'] = array();
        $result['result'] = 200;
        echo json_encode($result);
        return;
    }
    $sqlIn = "";
    foreach ($ridArray as $rid) {
        $sqlIn = $sqlIn . $rid . ",";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);

    $sql = "select *,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.no in (".$sqlIn.")";
    $restaurants = $this->sqllibs->rawSelectSql($this->db, $sql);                     
    $result = array();
    $result['restaurants'] = $this->generateRestaurantArray($restaurants);
    $result['result'] = 200;
    echo json_encode($result);
}

public function selectplan($task = "") {

    $this->load->model('Customer_Modal');

    if ($this->session->userdata('customer_login') != 1)
    {
        $this->session->set_userdata('last_page' , current_url());
        redirect('CustomerController/login');
    }

    if($task == "checkout") {

        $data['pageName'] = "CONFIRMPAYMENTPAGE";
        $data['cardid'] = $this->input->post('cardid');
        $data['planid'] = $this->input->post('plan_id');
        $this->load->view('view_customer', $data);  

    } else {

        redirect('CustomerController/pricingplan');            
    }    
}

public function ajaxSearchSubCategory()
{
    $postVars = $this->utils->inflatePost(array('category'));        

    $sqlIn = "";
    foreach ($postVars['category'] as $cat) {
        $sqlIn = $sqlIn . $cat . ",";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);

    if ($sqlIn !='')
    {
        $sql = "select no as rid from tbl_subcategory where cid in (".$sqlIn.")";
    }
    else
        $sql = "select no as rid from tbl_subcategory";      


    $rids4 = $this->sqllibs->rawSelectSql($this->db, $sql);    


    $array4 = array();

    foreach ($rids4 as $rid) 
        $array4[] = $rid->rid;  

    $ridArray = $array4;  

    if (count($ridArray) == 0)
    {
        $result = array();
        $result['restaurants'] = array();
        $result['result'] = 200;
        echo json_encode($result);
        return;
    }
    $sqlIn = "";
    foreach ($ridArray as $rid) {

        $sqlIn = $sqlIn . $rid . ",";
    }
    $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);

    $sql = "select *,(select count(*) from tbl_map_sub_restaurant as B where B.sid=A.no) as countRestaurant from tbl_subcategory as A where A.no in (".$sqlIn.")";
    $subcategory = $this->sqllibs->rawSelectSql($this->db, $sql); 
    $result = array();
    $result['restaurants'] = $subcategory;
    $result['result'] = 200;
    echo json_encode($result);
}    

public function getrestaurantsbysearch($categoryid = "") {
    $this->load->model('Customer_Modal'); 

    $postVars = $this->utils->inflatePost(array('searchdate','searchdiscount','noofperson'));    
    $sql = "";
    if ($postVars['searchdiscount'] == '')
        $sql = "select no as rid from tbl_restaurant";            
    else $sql = "select rid from tbl_map_discount_restaurant where did >='".$postVars['searchdiscount']."'";        
    $rids = $this->sqllibs->rawSelectSql($this->db, $sql);


    if ($postVars['noofperson'] == '')
        $sql = "select no as rid from tbl_restaurant";            
    else $sql = "select rid from tbl_map_discount_restaurant where amount >='".$postVars['noofperson']."'";             
    $rids2 = $this->sqllibs->rawSelectSql($this->db, $sql);


    if ($postVars['searchdate'] == '')
        $sql = "select no as rid from tbl_restaurant";            
    else $sql = "select rid from tbl_map_discount_restaurant where date ='".date('Y-m-d', strtotime($postVars['searchdate']))."'"; 
    $rids3 = $this->sqllibs->rawSelectSql($this->db, $sql);        


    $array1 = array();
    $array2 = array();
    $array3 = array();
    foreach ($rids as $rid) 
        $array1[] = $rid->rid;        
    foreach ($rids2 as $rid) 
        $array2[] = $rid->rid;        
    foreach ($rids3 as $rid) 
        $array3[] = $rid->rid;     
    $ridArray = array_intersect($array1, $array2,$array3);        
    if (count($ridArray) == 0)
    {
        $restaurants = "";
        $data['restaurantlist'] = $restaurants;
        $data['pageName'] = "SEARCHRESTAURANTS";
        $data['category_id'] = $categoryid;
        $this->load->view('view_customer', $data);
    } else {
        $sqlIn = "";
        foreach ($ridArray as $rid) {
            $sqlIn = $sqlIn . $rid . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);

        $sql = "select * from tbl_restaurant where no in (".$sqlIn.")";
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sql); 

        $data['restaurantlist'] = $restaurants;
        $data['pageName'] = "SEARCHRESTAURANTS";
        $data['category_id'] = $categoryid;
        $this->load->view('view_customer', $data); 
    }
}

public function datediscount($restoid = "") {    

  $date = date('Y-m-d', strtotime($_POST["dateval"]));

  $this->db->select('*');
  $this->db->from('tbl_map_discount_restaurant');
  $this->db->where('date',$date);
  $this->db->where('rid',$restoid);
  $results = $this->db->get()->result();

  if (isset($results) and $results != NULL) {
    echo '<option value="">Select Time - Discount</option>';
    foreach ($results as $result) {

    $discount = $this->db->get_where('tbl_base_discount', array('no' => $result->did))->row(); 

    echo '<option value="'.$result->no.'">'.$discount->percent.'% - '.$result->rtime.'</option>';
  }
} else {
    echo '<option value="">Discount Not Available</option>';
}
}

    public function add_reviewed($rid = "", $active = "7") {

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
        $data['selected_reserv_id'] = $rid;
        $this->load->view('view_customer', $data);   
    }

    public function submit_reviewed($rid = "") {

        $this->load->model('Customer_Modal');
        
        $rid = $this->Customer_Modal->submit_reviewed();
        redirect('CustomerController/profile/1');
    }

    public function submit_review($rid = "") {

        $this->load->model('Customer_Modal');
        
        $rid = $this->Customer_Modal->submit_reviews();
        redirect('CustomerController/restaurantdetails/'.$rid.'/2');
    }



}
