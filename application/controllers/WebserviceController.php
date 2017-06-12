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
    function loadTop50Restaurant()
    {
        $postVars = $this->utils->inflatePost(array('lat','lng'));
        $result = array();
        $restaurants = $this->sqllibs->rawSelectSql($this->db,
                "select *,(select count(*) from tbl_reservation as B where B.rid=A.no) as countReservation  from tbl_restaurant as A order by A.avgrate desc limit 0,50");
        
        
        $result['result'] = 200;
        echo json_encode($result);             
    }
    
    function loadAZRestaurant()
    {        
        $result = array();
        $result['restaurants'] = $this->sqllibs->rawSelectSql($this->db,
                "select * from tbl_restaurant order by name asc");
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
            echo json_encode( );
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
    
}
