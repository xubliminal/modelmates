<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_user;
    
    /**
     *
     * @var Zend_Auth
     */
    protected $_auth;
    
    public function init() {
        parent::init();
        $this->_auth = Zend_Auth::getInstance();
        $this->_auth->setStorage(new Zend_Auth_Storage_Session('Admin_Auth'));
        if(!$this->_auth->hasIdentity() && $this->_getParam('action') != 'login')
            $this->_redirect('admin/login');
        
        $this->_user = $this->_auth->getIdentity();
    }
    
    public function loginAction() { 
        $this->_auth->clearIdentity();
        if($this->_request->isPost()) {
            try {
                $adapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'admins', 'user', 'passw', 'MD5(?)');
                $adapter->setIdentity($_POST['username']);
                $adapter->setCredential($_POST['password']);
                $result = $adapter->authenticate();
                if($result->isValid()) {
                    $this->_auth->getStorage()->write($adapter->getResultRowObject(null, 'passw'));
                    $this->_redirect('admin');
                } else {
                    $this->view->error = 'Invalid Username or Password';
                }
            } catch(Exception $e) {
                $this->view->error = 'Invalid Username or Password';
            }
        }
    }
    
    public function logoutAction() {
        $this->_auth->clearIdentity();
        $this->_redirect('admin/login');
    }
    
    public function indexAction() {
        
    }
    
    public function listingsAction() {
        switch($this->_getParam('task', 'index')) {
            case 'new':
                $this->view->categories = MM_Service_Listings::getCategories();
                $this->view->data = array('title' => '','description' => '','category' => '','type' => '','state' => '','city' => '','address' => '','phone' => '','parking' => '1');
                if($this->_request->isPost()) {
                    $listing = MM_Service_Listings::create($_POST);
                    if($listing != null)
                        $this->_redirect('admin/listings');
                }
                $this->render('listings-new');
                break;
            case 'edit':
                $listing = MM_Service_Listings::get($_GET['id']);
                if($this->_request->isPost()) {
                    $listing->updateInfo($_POST);
                    $this->_redirect('admin/listings');
                }
                
                $this->view->pictures = MM_Service_Pictures::getAllOf('listing', $listing->id);
                $this->view->categories = MM_Service_Listings::getCategories();
                $this->view->data = $listing->toArray();
                $this->render('listings-new');
                break;
            case 'index':
                $this->view->listings = MM_Service_Listings::getAll();
                break;
            case 'delete':
                MM_Service_Listings::remove($_GET['id']);
                $this->_redirect('admin/listings'); 
                break;
        }
    }
    
    public function eventsAction() {
        switch($this->_getParam('task', 'index')) {
            case 'new':
                if($this->_request->isPost()) {
                    //echo '<pre>'; var_dump($_POST); die;
                    $event = MM_Service_Events::create($_POST);
                    if($event !== null) 
                        $this->_redirect('admin/events');                    
                }
                $this->render('events-new');
                break;
            case 'edit':
                $event = MM_Service_Events::get($_GET['id']);
                if($this->_request->isPost()) {
                    //echo '<pre>'; var_dump($_POST); die;
                    $event->updateInfo($_POST);
                    $this->_redirect('admin/events');
                }
                $this->view->covers = $event->getCovers();
                $this->view->data   = $event->toArray();
                $this->render('events-new');                
                break;
            case 'index':
                $this->view->events = MM_Service_Events::getAll();
                break;
            case 'delete':
                MM_Service_Events::remove($_GET['id']);
                $this->_redirect('admin/events');                 
                break;
        }
    }
}