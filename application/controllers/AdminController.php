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

    public function restaurantPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Restaurants", "Admin");
        $data = $this->setMessages($data);
        $data['restaurants'] = $this->sqllibs->selectAllRows($this->db, 'tbl_restaurant');
        
        
        $data['restaurants'] = $this->sqllibs->selectJoinTables($this->db, array('tbl_restaurant','tbl_category')
                ,array('category','no')
                ,null
                ,$selectFields = array(null,array('name as cname'))
                );
        
        
        
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
        $data['facilitys'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_facility');
        $this->load->view('view_admin', $data);
    }

    public function languagePage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Languages", "Admin");
        $data = $this->setMessages($data);
        $data['langs'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_language');
        $this->load->view('view_admin', $data);
    }

    public function atmospherePage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Atmospheres", "Admin");
        $data = $this->setMessages($data);
        $data['atoms'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_atmosphere');
        $this->load->view('view_admin', $data);
    }

    public function categoryPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Categorys", "Admin");
        $data = $this->setMessages($data);
        $tables = 
        $condition = array('cid','no');
        $where = null;
        $selectFields = array(
            null,
            array('name as country')
        );
        $data['categorys'] = $this->sqllibs->selectJoinTables($this->db, array('tbl_category','tbl_base_country')
                ,array('cid','no')
                ,null
                ,$selectFields = array(null,array('name as country'))
                );
        $data['countrys'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_country');
        $this->load->view('view_admin', $data);
    }
    
    public function discountPage()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Discounts", "Admin");
        $data = $this->setMessages($data);        
        $data['discounts'] = $this->sqllibs->selectJoinTables($this->db, array('tbl_map_discount_restaurant','tbl_restaurant')
                ,array('rid','no')
                ,null
                ,array(null,array('name as restaurant'))
                );        
        $this->load->view('view_admin', $data);
    }
    
    public function faqPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Faq", "Admin");
        $data = $this->setMessages($data);
        $faq = $this->sqllibs->getOneRow($this->db, 'tbl_faq',null);
        $data['faq'] = ($faq==null?"":$faq->content);
        $this->load->view('view_admin', $data);
    }
    
    public function termPage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Terms", "Admin");
        $data = $this->setMessages($data);
        $term = $this->sqllibs->getOneRow($this->db, 'tbl_terms',null);
        $data['term'] = ($term==null?"":$term->content);
        $this->load->view('view_admin', $data);
    }
    
    public function contactusPage()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("Contactus", "Admin");
        $data = $this->setMessages($data);
        $content = $this->sqllibs->getOneRow($this->db, 'tbl_contactus',null);
        $data['content'] = ($content==null?"":$content->content);
        $this->load->view('view_admin', $data);
    }

    public function editCountryPage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditCountry", "Admin");
        $data = $this->setMessages($data);
        $data['countryInfo'] = $this->sqllibs->getOneRow($this->db, 'tbl_base_country', array(
            "no" => $id
        ));
        $this->load->view('view_admin', $data);
    }

    public function editFacilityPage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditFacility", "Admin");
        $data = $this->setMessages($data);
        $data['facilityInfo'] = $this->sqllibs->getOneRow($this->db, 'tbl_base_facility', array(
            "no" => $id
        ));
        $this->load->view('view_admin', $data);
    }

    public function editLanguagePage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditLanguage", "Admin");
        $data = $this->setMessages($data);
        $data['langInfo'] = $this->sqllibs->getOneRow($this->db, 'tbl_base_language', array(
            "no" => $id
        ));
        $this->load->view('view_admin', $data);
    }

    public function editAtomPage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditAtom", "Admin");
        $data = $this->setMessages($data);
        $data['atom'] = $this->sqllibs->getOneRow($this->db, 'tbl_base_atmosphere', array(
            "no" => $id
        ));
        $this->load->view('view_admin', $data);
    }

    public function editCategoryPage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $data = $this->getViewParameters("EditCategory", "Admin");
        $data = $this->setMessages($data);
        $data['category'] = $this->sqllibs->getOneRow($this->db, 'tbl_category', array(
            "no" => $id
        ));
        $data['countrys'] = $this->sqllibs->selectAllRows($this->db, 'tbl_base_country');
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
        $this->session->set_flashdata('errorMessage', "Login Fail");
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

    public function actionAddFacility() {
        $postVars = $this->utils->inflatePost(array('facilityName'));
        $this->sqllibs->insertRow($this->db, 'tbl_base_facility'
                , array(
            "name" => $postVars['facilityName']
        ));
        $this->session->set_flashdata('message', "Success Add Service");
        redirect(base_url() . ADMIN_PAGE_FACILITYS);
    }

    public function actionAddLanguage() {
        $postVars = $this->utils->inflatePost(array('langName'));
        $this->sqllibs->insertRow($this->db, 'tbl_base_language'
                , array(
            "name" => $postVars['langName']
        ));
        $this->session->set_flashdata('message', "Success Add Language");
        redirect(base_url() . ADMIN_PAGE_LANGUAGES);
    }

    public function actionAddAtom() {
        $postVars = $this->utils->inflatePost(array('atomName'));
        $this->sqllibs->insertRow($this->db, 'tbl_base_atmosphere'
                , array(
            "name" => $postVars['atomName']
        ));
        $this->session->set_flashdata('message', "Success Add Atmosphere");
        redirect(base_url() . ADMIN_PAGE_ATMOSPHERES);
    }

    public function actionAddCategory() {
        $postVars = $this->utils->inflatePost(array('categoryName', 'categoryCountry', 'categoryFeature'));
        $imageFile = "";
        if (isset($_FILES['uploadImage'])) {
            $imageFile = $this->utils->uploadImage($_FILES['uploadImage'], 0, 400, 250);
        }
        $this->sqllibs->insertRow($this->db, 'tbl_category'
                , array(
            "name" => $postVars['categoryName'],
            "cid" => $postVars['categoryCountry'],
            "feature" => $postVars['categoryFeature'],
            "image" => $imageFile
        ));
        $this->session->set_flashdata('message', "Success Add Category");
        redirect(base_url() . ADMIN_PAGE_CATEGORYS);
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

    public function actionDeleteFacility($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_base_facility', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_FACILITYS);
    }

    public function actionDeleteLanguage($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_base_language', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_LANGUAGES);
    }

    public function actionDeleteAtom($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_base_atmosphere', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_ATMOSPHERES);
    }

    public function actionDeleteCategory($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_category', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_CATEGORYS);
    }
    
    public function actionDeleteUser($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_user', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_USERS);
    }

    public function actionUpdateCountry() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('countryName', 'cid'));
        $data = $this->sqllibs->getOneRow($this->db, 'tbl_base_country', array(
            "no" => $postVars['cid']
        ));
        $imageFile = $data->image;
        if (isset($_FILES['uploadLogo0'])) {
            $imageFile = $this->utils->uploadImage($_FILES['uploadLogo0'], 0, 200, 130);
            if ($imageFile == "")
                $imageFile = $data->image;
        }
        $this->sqllibs->updateRow($this->db, 'tbl_base_country'
                , array(
            "name" => $postVars['countryName'],
            "image" => $imageFile,
                )
                , array(
            "no" => $postVars['cid']
        ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_COUNTRYS);
    }

    public function actionUpdateFacility() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('facilityName', 'cid'));
        $data = $this->sqllibs->getOneRow($this->db, 'tbl_base_facility', array(
            "no" => $postVars['cid']
        ));
        $this->sqllibs->updateRow($this->db, 'tbl_base_facility'
                , array(
            "name" => $postVars['facilityName']
                )
                , array(
            "no" => $postVars['cid']
        ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_FACILITYS);
    }

    public function actionUpdateLanguage() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('langName', 'cid'));
        $data = $this->sqllibs->getOneRow($this->db, 'tbl_base_language', array(
            "no" => $postVars['cid']
        ));
        $this->sqllibs->updateRow($this->db, 'tbl_base_language'
                , array(
            "name" => $postVars['langName']
                )
                , array(
            "no" => $postVars['cid']
        ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_LANGUAGES);
    }

    public function actionUpdateAtom() {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('atomName', 'cid'));
        $data = $this->sqllibs->getOneRow($this->db, 'tbl_base_atmosphere', array(
            "no" => $postVars['cid']
        ));
        $this->sqllibs->updateRow($this->db, 'tbl_base_atmosphere'
                , array(
            "name" => $postVars['atomName']
                )
                , array(
            "no" => $postVars['cid']
        ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_ATMOSPHERES);
    }

    public function actionUpdateCategory() {

        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('categoryName', 'categoryCountry', 'cid', 'categoryFeature'));
        $data = $this->sqllibs->getOneRow($this->db, 'tbl_category', array(
            "no" => $postVars['cid']
        ));

        $imageFile = $data->image;
        if (isset($_FILES['uploadLogo0'])) {
            $imageFile = $this->utils->uploadImage($_FILES['uploadLogo0'], 0, 400, 250);
            if ($imageFile == "")
                $imageFile = $data->image;
        }


        $this->sqllibs->updateRow($this->db, 'tbl_category'
                , array(
            "name" => $postVars['categoryName'],
            "cid" => $postVars['categoryCountry'],
            "feature" => $postVars['categoryFeature'],
            "image" => $imageFile
                )
                , array(
            "no" => $postVars['cid']
        ));
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_CATEGORYS);
    }
    public function actionUpdateFaq()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('faq'));        
        $this->sqllibs->updateRow($this->db, 'tbl_faq'
                , array(
            "content" => $postVars['faq']
                )
        );
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_FAQ);
    }
    public function actionUpdateTerms()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('term'));        
        $this->sqllibs->updateRow($this->db, 'tbl_terms'
                , array(
            "content" => $postVars['term']
                )
        );
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_TERMS);
    }
    
    public function actionUpdateContact()
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $postVars = $this->utils->inflatePost(array('content'));        
        $this->sqllibs->updateRow($this->db, 'tbl_contactus'
                , array(
            "content" => $postVars['content']
                )
        );
        $this->session->set_flashdata('message', "Update Successful");
        redirect(base_url() . ADMIN_PAGE_CONTACTUS);
    }
    
    public function actionRestaurantFeature($id)
    {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $rtInfo = $this->sqllibs->getOneRow($this->db, 'tbl_restaurant',array('no'=>$id));
        $featureValue = 0;
        if ($rtInfo->feature == 0)
            $featureValue = 1;
        $this->sqllibs->updateRow($this->db, 'tbl_restaurant'
                , array(
            "feature" => $featureValue
                ),
                array('no'=>$id)
        );
        $this->session->set_flashdata('message', "Featured");
        redirect(base_url() . ADMIN_PAGE_RESTAURANTS);
    }
    
    public function actionDeleteRestaurant($id) {
        if (!$this->isLogin()) {
            $this->utils->redirectPage(ADMIN_PAGE_HOME);
            return;
        }
        $this->sqllibs->deleteRow($this->db, 'tbl_restaurant', array(
            "no" => $id
        ));

        $this->session->set_flashdata('message', "Delete Successful");
        redirect(base_url() . ADMIN_PAGE_RESTAURANTS);
    }
    

}
