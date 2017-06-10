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
}
