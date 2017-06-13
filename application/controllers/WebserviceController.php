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
    
    function loadAllCountry()
    {
        $result = array();        
        $result['countries'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_country');
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadCategory()
    {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $result['categorys'] = $this->sqllibs->rawSelectSql($this->db,
                "select *,(select count(*) from tbl_restaurant as B where B.category=A.no) as countRestaurant  from tbl_category as A where A.cid='".$postVars['cid']."'");
        $result['result'] = 200;
        echo json_encode($result);
    }    
    
    function loadAZRestaurant()
    {   
        $postVars = $this->utils->inflatePost(array('cid'));
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category',array( "cid" =>  $postVars['cid']));
        $sqlIn = "";
        foreach($categorys as $category)
        {
            $sqlIn = $sqlIn.$category->no.",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (".$sqlIn.") order by A.avgrate desc limit 0,50";
        $result = array();
        $result['restaurants'] = $this->sqllibs->rawSelectSql($this->db,$sqlIn);
        $result['result'] = 200;
        echo json_encode($result);  
    }
    function loadNearbyRestaurants()
    {
        $postVars = $this->utils->inflatePost(array('lat','lng'));
        $distance = 10;
        $result['restaurants'] = $this->sqllibs->rawSelectSql($this->db,
                "SELECT * 
                FROM (SELECT *, (((acos(sin((".$postVars['lat']."*pi()/180)) *
                sin((`lat`*pi()/180))+cos((".$postVars['lat']."*pi()/180)) *
                cos((`lat`*pi()/180)) * cos(((".$postVars['lng']."-
                `lng`)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
                as distance
                FROM `tbl_restaurant`)myTable 
                WHERE distance <= ".$distance." 
                LIMIT 15");
        $result['result'] = 200;
        echo json_encode($result);        
    }
    function login()
    {
        $postVars = $this->utils->inflatePost(array('email','password'));
        $result = array();
        if ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email'], "password" => $postVars['password']))) {
            $result['user'] = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
            "email" => $postVars['email'],
            "password" => $postVars['password']            
            ));
            $result['result'] = 200;
            echo json_encode($result);
            return;
        }
        $result['result'] = 400;
        echo json_encode($result);
        
    }
    
    function loadCardList()
    {
        $postVars = $this->utils->inflatePost(array('uid'));
        $cards = $this->sqllibs->selectAllRows($this->db, 'tbl_card',array( "uid" =>  $postVars['uid']));
        $result = array();
        $cardInfos = array();
        for($i = 0;$i < count($cards);$i++)
        {
            $cardNumber = $cards[$i]->cardnumber;
            if (strlen($cardNumber) > 4)
            {
                $cardNumber = substr($cardNumber,0,4);
                $cardNumber = $cardNumber." **** **** ****";
            }
            $cardInfos[$i] = $cardNumber;
        }
        $result['cards'] = $cardInfos;
        $result['result'] = 200;
        echo json_encode($result);
    }
    
    function addCardInfo()
    {
        $postVars = $this->utils->inflatePost(array('uid','name','cardnumber','expire','security'));
        $this->sqllibs->insertRow($this->db, 'tbl_card'
                , array(
            "uid" => $postVars['uid'],
            "name" => $postVars['name'],
            "cardnumber" => $postVars['cardnumber'],
            "expire" => $postVars['expire'],
            "security" => $postVars['security'],
        ));
        $result = array();
        $result['result'] = 200;
        echo json_encode($result);
    }
    
    function loadReservation()
    {
        $postVars = $this->utils->inflatePost(array('uid'));
        $result = array();        
        $reservations = $this->sqllibs->selectJoinTables($this->db, array('tbl_reservation','tbl_restaurant')
                ,array('rid','no')
                ,array('uid'    =>  $postVars['uid'])
                ,array(null,array('name as rs_name','about as rs_about'))
                );
        $rsArray = array();
        for ($i = 0;$i < count($reservations);$i++)
        {            
            $image = $this->sqllibs->getOneRow($this->db, 'tbl_image_restaurant', array(
            "rid" => $reservations[$i]->rid
            ));            
            $extended = (object) array_merge((array)$reservations[$i], array('rs_image' =>$image->image));
            $rsArray[$i] = $extended;
        }
        $result['reservations'] = $rsArray;
        $result['result'] = 200;
        echo json_encode($result);
    }
    
    function register()
    {
        $postVars = $this->utils->inflatePost(array('name','email','password','device_type'));
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
    
    function registerFacebook()
    {
        $postVars = $this->utils->inflatePost(array('name','email','device_type'));
        if ($this->sqllibs->isExist($this->db, 'tbl_user', array("email" => $postVars['email'],"type" => 1))) {
            $userData = $this->sqllibs->getOneRow($this->db, 'tbl_user', array(
            "email"  => $postVars['email'],
            "type"   => 1       
            ));            
        }      
        else
        {
            $id = $this->sqllibs->insertRow($this->db, 'tbl_user'
                    , array(
                "name" => $postVars['name'],
                "email" => $postVars['email'],
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
            $rstArray[$index] = $rstExtend;
            $index++;
        }
        return $rstArray;
    }
    function loadTop50Restaurant()
    {
        $postVars = $this->utils->inflatePost(array('cid'));
        $result = array();
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category',array( "cid" =>  $postVars['cid']));
        $sqlIn = "";
        foreach($categorys as $category)
        {
            $sqlIn = $sqlIn.$category->no.",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (".$sqlIn.") order by A.avgrate desc limit 0,50";
        $restaurants = $this->sqllibs->rawSelectSql($this->db,$sqlIn);
        $result['restaurants'] = $this->generateRestaurantArray($restaurants);
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadRestaurants()
    {
        $postVars = $this->utils->inflatePost(array('cid','page'));
        $categorys = $this->sqllibs->selectAllRows($this->db, 'tbl_category',array( "cid" =>  $postVars['cid']));
        $sqlIn = "";
        foreach($categorys as $category)
        {
            $sqlIn = $sqlIn.$category->no.",";
        }
        $sqlIn = substr($sqlIn, 0, strlen($sqlIn) - 1);
        $sqlIn = "select A.*,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation from tbl_restaurant as A where A.category in (".$sqlIn.") order by A.avgrate desc limit ".($postVars['page'] * 30).",".(($postVars['page'] + 1) * 30);        
        $restaurants = $this->sqllibs->rawSelectSql($this->db,$sqlIn);
        $result['restaurants'] = $this->generateRestaurantArray($restaurants);
        $result['result'] = 200;
        echo json_encode($result);
    }
    function loadDetailRestaurant()
    {
        $postVars = $this->utils->inflatePost(array('rid'));
        $restaurants = $this->sqllibs->selectAllRows($this->db, 'tbl_restaurant',array( "no" =>  $postVars['rid']));        
        $rsts = $this->generateRestaurantArray($restaurants);
        $result['restaurant'] = $rsts[0];
        $result['result'] = 200;
        echo json_encode($result);
    }
    
    //Incomplete
    function loadDetailBook()
    {
        $postVars = $this->utils->inflatePost(array('rid'));
        
    }
    
    function submitReportReservation()
    {
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
    
    function testPayment()
    {
        $this->stripe->testCheckout();        
    }
    function testRefund()
    {
        $this->stripe->testRefund();        
    }
}
