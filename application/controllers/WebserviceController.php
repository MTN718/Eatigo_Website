<?php

header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class WebserviceController extends BaseController {

    function __construct() {
        parent::__construct();
    }

    function makeFailResponse() {
        $channel = array();
        $channel["response"] = 400;
        echo json_encode($channel);
    }

    function makeSuccessResponse() {
        $channel = array();
        $channel["response"] = 200;
        echo json_encode($channel);
    }

    function loadAllCountry() {
        $result = array();
        $result['countries'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_country');
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadRestaurantTab()
    {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();        
        $categorys = $this->sqllibs->rawSelectSql($this->db, "select *,(select count(*) from tbl_restaurant as B where B.category=A.no) as countRestaurant  from tbl_category as A where A.cid='" . $postVars['cid'] . "'");        
        $result['categorys'] = $categorys;
        //AZ
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.avgrate desc limit 0,50";        
        $reservations = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['az_restaurants'] = $reservations;
        
        //Top 50
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.avgrate desc limit 0,50";
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['50_restaurants'] = $this->generateRestaurantArray($restaurants);
        
        //Home
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.createdate desc limit 0,10";
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['new_restaurants'] = $this->generateRestaurantArray($restaurants);                
        
        $result['result'] = 200;
        echo json_encode($result);        
    }
    function loadCategory() {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $result['categorys'] = $this->sqllibs->rawSelectSql($this->db, "select *,(select count(*) from tbl_restaurant as B where B.category=A.no) as countRestaurant  from tbl_category as A where A.cid='" . $postVars['cid'] . "'");
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadAZRestaurant() {
        $postVars = $this->utils->inflatePost(array('cid'));
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category', array("cid" => $postVars['cid']));
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
<<<<<<< HEAD
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.avgrate desc limit 0,50";
        $result = array();
        $reservations = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['restaurants'] = $reservations;
=======
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (".$sqlIn.") order by A.avgrate desc limit 0,50";
        $result = array();
        $result['restaurants'] = $this->sqllibs->rawSelectSql($this->db,$sqlIn);
>>>>>>> origin/master
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadNearbyRestaurants() {
        $postVars = $this->utils->inflatePost(array('lat', 'lng'));
        $distance = 10;
        $result['restaurants'] = $this->sqllibs->rawSelectSql($this->db, "SELECT * 
                FROM (SELECT *, (((acos(sin((" . $postVars['lat'] . "*pi()/180)) *
                sin((`lat`*pi()/180))+cos((" . $postVars['lat'] . "*pi()/180)) *
                cos((`lat`*pi()/180)) * cos(((" . $postVars['lng'] . "-
                `lng`)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
                as distance
                FROM `tbl_restaurant`)myTable 
                WHERE distance <= " . $distance . " 
                LIMIT 15");
        $result['result'] = 200;
        echo json_encode($result);
    }

    function login() {
        $postVars = $this->utils->inflatePost(array('email', 'password'));
        $result = array();
        if ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email'], "password" => $postVars['password']))) {
            $result['user'] = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
                "email" => $postVars['email'],
                "password" => $postVars['password']
            ));
            $result['result'] = 200;
            echo json_encode( );
            return;
        }
        $result['result'] = 400;
        echo json_encode($result);
    }

    function loadCardList() {
        $postVars = $this->utils->inflatePost(array('uid'));
        $cards = $this->sqllibs->selectAllRows($this->db, 'tbl_card', array("uid" => $postVars['uid']));
        $result = array();
        $cardInfos = array();
        for ($i = 0; $i < count($cards); $i++) {
            $cardNumber = $cards[$i]->cardnumber;
<<<<<<< HEAD
            $cardInfo = array();
            if (strlen($cardNumber) > 4) {
                $cardNumber = substr($cardNumber, 0, 4);
                $cardNumber = $cardNumber . " **** **** ****";

                $cardInfo['no'] = $cards[$i]->no;
                $cardInfo['number'] = $cardNumber;
=======
            if (strlen($cardNumber) > 4)
            {
                $cardNumber = substr($cardNumber,0,4);
                $cardNumber = $cardNumber." **** **** ****";
>>>>>>> origin/master
            }
            $cardInfos[$i] = $cardNumber;
        }
        $result['cards'] = $cardInfos;
        $result['result'] = 200;
        echo json_encode($result);
    }

    function addCardInfo() {
        $postVars = $this->utils->inflatePost(array('uid', 'name', 'cardnumber', 'expmonth','expyear', 'security'));
        $this->sqllibs->insertRow($this->db, 'tbl_card'
                , array(
            "uid" => $postVars['uid'],
            "name" => $postVars['name'],
            "cardnumber" => $postVars['cardnumber'],
            "expmonth" => $postVars['expmonth'],
            "expyear" => $postVars['expyear'],
            "security" => $postVars['security'],
        ));
        $result = array();
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadReservation() {
        $postVars = $this->utils->inflatePost(array('uid'));
        $result = array();
        $reservations = $this->sqllibs->selectJoinTables($this->db, array('tbl_reservation', 'tbl_restaurant')
                , array('rid', 'no')
                , array('uid' => $postVars['uid'])
                , array(null, array('name as rs_name', 'about as rs_about'))
        );
        $rsArray = array();
        for ($i = 0; $i < count($reservations); $i++) {
            $image = $this->sqllibs->getOneRow($this->db, 'tbl_image_restaurant', array(
                "rid" => $reservations[$i]->rid
            ));
            $extended = (object) array_merge((array) $reservations[$i], array('rs_image' => $image->image));
            $rsArray[$i] = $extended;
        }
        $result['reservations'] = $rsArray;
        $result['result'] = 200;
        echo json_encode($result);
    }

    function register() {
        $postVars = $this->utils->inflatePost(array('name', 'email', 'password', 'device_type'));
        if ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email']))) {
            $result['result'] = 400;
            $result['message'] = "Email already registered";
            echo json_encode($result);
            return;
        }

        $id = $this->sqllibs->insertRow($this->db, 'tbl_user'
                , array(
            "name" => $postVars['name'],
            "email" => $postVars['email'],
            "password" => $postVars['password'],
            "device_type" => $postVars['device_type'],
        ));
        $userData = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
            "no" => $id,
        ));
        $result = array();
        $result['user'] = $userData;
        $result['result'] = 200;
        echo json_encode($result);
    }

    function registerFacebook() {
        $postVars = $this->utils->inflatePost(array('name', 'email', 'device_type','image'));
        if ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email'], "type" => 1))) {
            $userData = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
                "email" => $postVars['email'],
                "type" => 1
            ));
        } else {
            $id = $this->sqllibs->insertRow($this->db, 'tbl_user'
                    , array(
                "name" => $postVars['name'],
                "email" => $postVars['email'],
                "image" => $postVars['image'],
                "type" => 1,
                "device_type" => $postVars['device_type'],
            ));
            $userData = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
                "no" => $id,
            ));
        }
        $result = array();
        $result['user'] = $userData;
        $result['result'] = 200;
        echo json_encode($result);
    }
<<<<<<< HEAD

    function generateRestaurantArray($restaurants) {
        $rstArray = array();
        $index = 0;
        foreach ($restaurants as $rst) {
            $images = $this->sqllibs->selectAllRows($this->db, 'tbl_image_restaurant', array("rid" => $rst->no));
            $rstExtend = (object) array_merge((array) $rst, array('rs_image' => $images));

            $discounts = $this->sqllibs->selectJoinTables($this->db, array('tbl_map_discount_restaurant', 'tbl_base_discount')
                    , array('did', 'no')
                    , array('rid' => $rst->no)
            );

            $rstExtend = (object) array_merge((array) $rstExtend, array('rs_discounts' => $discounts));
=======
    //Incomplete
    function generateRestaurantArray($restaurants)
    {
        $rstArray = array();
        $index = 0;
        foreach($restaurants as $rst)
        {
            $image = $this->sqllibs->getOneRow($this->db, 'tbl_image_restaurant', array(
            "rid" => $rst->no
            ));
            $rstExtend = (object) array_merge((array)$rst, array('rs_image' =>""));
            if ($image != null)
                $rstExtend->rs_image = $image->image;
            $discounts = $this->sqllibs->selectJoinTables($this->db, array('tbl_map_discount_restaurant','tbl_base_discount')
                ,array('did','no')
                ,array('rid'    =>  $rst->no)
                );

            $rstExtend = (object) array_merge((array)$rstExtend, array('rs_discounts' =>$discounts));
>>>>>>> origin/master
            $rstArray[$index] = $rstExtend;
            $index++;
        }
        return $rstArray;
    }

    function loadTop50Restaurant() {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category', array("cid" => $postVars['cid']));
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.avgrate desc limit 0,50";
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['restaurants'] = $this->generateRestaurantArray($restaurants);
        $result['result'] = 200;
        echo json_encode($result);
    }
<<<<<<< HEAD

    function loadNew10Restaurant() {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category', array("cid" => $postVars['cid']));
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.createdate desc limit 0,10";
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['restaurants'] = $this->generateRestaurantArray($restaurants);
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadRestaurants() {
        $postVars = $this->utils->inflatePost(array('cid', 'page'));
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category', array("cid" => $postVars['cid']));
=======
    function loadRestaurants()
    {
        $postVars = $this->utils->inflatePost(array('cid','page'));
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category',array( "cid" =>  $postVars['cid']));
>>>>>>> origin/master
        $sqlIn = "";
        foreach ($categorys as $category) {
            $sqlIn = $sqlIn . $category->no . ",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.avgrate desc limit " . ($postVars['page'] * 30) . "," . (($postVars['page'] + 1) * 30);
        $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
        $result['restaurants'] = $this->generateRestaurantArray($restaurants);
        $result['result'] = 200;
        echo json_encode($result);
    }

    function loadDetailRestaurant() {
        $postVars = $this->utils->inflatePost(array('rid'));
        $restaurants = $this->sqllibs->selectAllRows($this->db, 'tbl_restaurant', array("no" => $postVars['rid']));
        $rsts = $this->generateRestaurantArray($restaurants);
        $result['restaurant'] = $rsts[0];
        $result['result'] = 200;
        echo json_encode($result);
    }

    
<<<<<<< HEAD

    function updateProfile() {
        $postVars = $this->utils->inflatePost(array('uid', 'name', 'email', 'phone', 'password'));
        $userInfo = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
            "no" => $postVars['uid']
        ));

        if (($userInfo->email != $postVars['email']) && ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email'])))) {
            $result = array();
            $result['result'] = 400;
            $result['message'] = "Email already registered";
            echo json_encode($result);
            return;
        }
        $imageFile = $userInfo->image;
        if (isset($_FILES['image'])) {
            $imageFile = $this->utils->uploadImage($_FILES['image'], 0, 200, 200);
            if ($imageFile == "")
                $imageFile = $userInfo->image;
        }
        $this->sqllibs->updateRow($this->db, 'tbl_user'
                , array(
            "name" => $postVars['name'],
            "email" => $postVars['email'],
            "mobile" => $postVars['phone'],
            "password" => $postVars['password'],
            "image" => $imageFile,
                )
                , array(
            "no" => $postVars['uid']
        ));
        
        $userInfo = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
            "no" => $postVars['uid']
        ));
        
        $result = array();
        $result['result'] = 200;        
        $result['user'] = $userInfo;
        echo json_encode($result);
        return;
    }
    
    function loadPromoRestaurants()
    {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category', array("cid" => $postVars['cid']));
        $sqlIn = "";
        if (count($categorys) > 0)
        {
            foreach ($categorys as $category) {
                $sqlIn = $sqlIn . $category->no . ",";
            }
            $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
            $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (" . $sqlIn . ") order by A.createdate desc";
            $restaurants = $this->sqllibs->rawSelectSql($this->db, $sqlIn);
            $rstArray = array();
            $i = -1;
            foreach($restaurants as $rst)
            {
                if ($rst->feature == 1)
                {
                    $i++;
                    $rstArray[$i] = $rst;
                }
            }
            $result['restaurants'] = $this->generateRestaurantArray($rstArray);
        }
        else
            $result['restaurants'] = array();
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadTerms()
    {
        $terms = $this->sqllibs->selectAllRows($this->db, 'tbl_terms');        
        $result['content'] = $terms[0]->content;
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadFaq()
    {
        $terms = $this->sqllibs->selectAllRows($this->db, 'tbl_faq');        
        $result['content'] = $terms[0]->content;
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadContactus()
    {
        $terms = $this->sqllibs->selectAllRows($this->db, 'tbl_contactus');        
        $result['content'] = $terms[0]->content;
        $result['result'] = 200;
        echo json_encode($result);
    }
   
    function submitReservation() {
        $postVars = $this->utils->inflatePost(array('uid', 'rid', 'did', 'people', 'cardid', 'date', 'time'));

        $discountInfo = $this->sqllibs->getOneRow($this->db, 'tbl_map_discount_restaurant', array(
            "no" => $postVars['did']
        ));
        if ($discountInfo->amount > $postVars['people']) {
            //Generate Code
            $code = $this->utils->generateRandomString();
            //Update amount
            $this->sqllibs->updateRow($this->db, 'tbl_map_discount_restaurant'
                    , array(
                "amount" => $discountInfo->amount - $postVars['people']
                    )
                    , array(
                "no" => $postVars['did']
            ));

            $cardInfo = $this->sqllibs->getOneRow($this->db, 'tbl_card', array(
                "no" => $postVars['cardid']
            ));
            //Checkout
            $transactionId = $this->strip->checkOut($cardInfo->cardnumber, $cardInfo->expmonth,$cardInfo->expyear,$cardInfo->security,$discountInfo->price);            
            if ($transactionId != false)
            {
                $this->sqllibs->insertRow($this->db, 'tbl_transaction'
                , array(
                    "transaction" => $transactionId,
                    "status" => 0,
                    "price" => $discountInfo->price,
                    "uid" => $postVars['uid'],
                    "rid" => $postVars['rid'],
                    "did" => $postVars['did']
                ));
                
                $this->sqllibs->insertRow($this->db, 'tbl_reservation'
                , array(
                    "uid" => $postVars['uid'],
                    "rid" => $postVars['rid'],
                    "did" => $postVars['did'],
                    "code" => $code,
                    "people" => $postVars['people'],
                    "date" => $postVars['date'],
                    "cardid" => $postVars['cardid'],
                    "time" => $postVars['time']
                ));
                
                $result = array();
                $result['code'] = $code;
                $result['result'] = 200;
                echo json_encode($result);
                return;
            }
        }
        $result = array();
        $result['code'] = $code;
        $result['result'] = 400;
        echo json_encode($result);
        return;
    }
     //Incomplete
    function loadDetailBook() {
        $postVars = $this->utils->inflatePost(array('rid'));
    }

    function submitReportReservation() {
        $postVars = $this->utils->inflatePost(array('email,title,phone,content'));

        $this->sqllibs->insertRow($this->db, 'tbl_card'
                , array(
            "uid" => $postVars['uid'],
            "name" => $postVars['name'],
            "cardnumber" => $postVars['cardnumber'],
            "expire" => $postVars['expire'],
            "security" => $postVars['security']
        ));

        $result = array();
        $result['restaurant'] = $rsts[0];
        $result['result'] = 200;
        echo json_encode($result);
    }

    function testPayment() {
        $this->stripe->testCheckout();
    }

    function testRefund() {
        $this->stripe->testRefund();
    }

=======
    function loadDetailBook()
    {
        
    }
    
    function submitReportReservation()
    {
        
    }
    
    
>>>>>>> origin/master
}
