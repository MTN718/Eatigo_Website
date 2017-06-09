<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'BaseController.php';

class AdminController extends BaseController {

    function __construct() {
        parent::__construct();
    }

    private function setMessages($data) {
        $data['error'] = $this->session->flashdata('errorMessage');
        $data['message'] = $this->session->flashdata('message');
        $this->session->set_flashdata('errorMessage', "");
        $this->session->set_flashdata('message', "");
        return $data;
    }

    private function isLogin() {
        if ($this->session->adminLogin == "") {
            return false;
        } else {
            return true;
        }
    }

    public function index() {
        if ($this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_DASHBOARD);
        } else {
            $data = $this->setMessages(array());
            $this->load->view('login_admin', $data);
        }
    }

    public function dashboardPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Dashboard", "Admin");
        $data = $this->setMessages($data);
        $this->load->view('view_admin', $data);
    }

    public function userPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Users", "Admin");
        $data = $this->setMessages($data);
        $data['users'] = $this->sqllibs->selectAllRows($this->db, 'tbl_user');
        $this->load->view('view_admin', $data);
    }

    public function countryPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Countrys", "Admin");
        $data = $this->setMessages($data);
        $data['countrys'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_country');
        $this->load->view('view_admin', $data);
    }

    public function facilityPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Facilitys", "Admin");
        $data = $this->setMessages($data);
        $this->load->view('view_admin', $data);
    }

    public function languagePage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Languages", "Admin");
        $data = $this->setMessages($data);
        $this->load->view('view_admin', $data);
    }

    public function atmospherePage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Atmospheres", "Admin");
        $data = $this->setMessages($data);
        $this->load->view('view_admin', $data);
    }

    public function editCountryPage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditCountry", "Admin");
        $data = $this->setMessages($data);
        $data['countryInfo'] = $this->sqllibs->getOneRow($this->db,'tbl_base_country',
                array(
                    "no"    =>  $id
                ));
        $this->load->view('view_admin', $data);
    }

    public function actionLogin() {
        if ($this->utils->isEmptyPost(array('user', 'pw'))) {
            $this->session->set_flashdata('errorMessage', "Please fill input.");
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('user', 'pw'));
        if ($this->sqllibs->isExist($this->db, 'tbl_base_admin', array("user" => $postVars['user'], "password" => $postVars['pw']))) {
            $this->session->set_userdata(array("adminLogin" => "1"));

            $this->utils->redirectPage(ADMIN_PAGE_DASHBOARD);
            return;
        }
        $this->utils->redirectPage(ADMIN_PAGE_HOME);
    }

    public function actionLogout() {
        $this->session->set_userdata(array("adminLogin" => ""));
        $this->utils->redirectPage(ADMIN_PAGE_HOME);
    }

    public function actionAddCountry() {
        $postVars = $this->utils->inflatePost(array('countryName'));
        $imageFile = "";
        if (isset($_FILES['uploadFlag'])) {
            $imageFile = $this->utils->uploadImage($_FILES['uploadFlag'], 0, 200, 130);
        }
        $this->sqllibs->insertRow($this->db, 'tbl_base_country'
                , array(
            "name" => $postVars['countryName'],
            "image" => $imageFile
        ));
        $this->session->set_flashdata('message', "Success Add Country");
        redirect(base_url() . ADMIN_PAGE_COUNTRYS);
    }

    public function actionDeleteCountry($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_base_country', array(
            "no" => $id
        ));
        
        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_COUNTRYS);
    }
    public function actionUpdateCountry()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('countryName','cid'));        
        $data = $this->sqllibs->getOneRow($this->db,'tbl_base_country',
                array(
                    "no"        =>      $postVars['cid']
                ));         
        $imageFile = $data->image;
        if (isset($_FILES['uploadLogo0'])) {
            $imageFile = $this->utils->uploadImage($_FILES['uploadLogo0'], 0, 200, 130);
            if ($imageFile == "")
                $imageFile = $data->image;
        }        
        $this->sqllibs->updateRow($this->db, 'tbl_base_country'
                , array(
                    "name"      =>      $postVars['countryName'],
                    "image"     =>      $imageFile,
                    )
                , array(
                    "no"        =>      $postVars['cid']
                ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_COUNTRYS);
    }

}
