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
}