<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {

    public $database;

    function __construct() {
        parent::__construct();
        $this->connectDB();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils');
        $this->load->library('sqllibs');
    }
    public function connectDB() {
        $this->database = $this->load->database();
    }
    
    public function getViewParameters($pageName='',$role='Customer',$title='Bruped')
    {        
        $data['title'] = $title;
        $data['pageName'] = $pageName;
        $data['role'] = $role;
        return $data;
    }
    
}

?>