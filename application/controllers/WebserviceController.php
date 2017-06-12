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
            echo json_encode($result);
            return;
        }
        $result['result'] = 400;
        echo json_encode($result);
        
    }
}
