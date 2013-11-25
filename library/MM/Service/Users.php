<?php

class MM_Service_Users extends MM_Service 
{
    protected static $_instance;
    
    protected $_current;
    
    protected $_name = 'users';
    
    protected $_rowClass = 'MM_Domain_User';
    
    protected $_roles;
    
    protected $_errors;
    
    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public static function getRoles() {
        $inst = self::getInstance();
        return $inst->getAllRoles();
    }
    
    public static function getCurrent() {
        $inst = self::getInstance();
        return $inst->getCurrentUser();
    }
    
    public function getCurrentUser() {
        if($this->_current === null) {
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity()) {
                $user = $auth->getIdentity();
                $this->_current = $this->getByID($user->id);
            }
        }
        
        return $this->_current;
    }
    
    public function getAllRoles() {
        if($this->_roles === null) {
            $rolesTable = new Zend_Db_Table('roles');
            $this->_roles = $rolesTable->fetchAll();
        }
        return $this->_roles;
    }
    
    public function create($data) {
        $this->_validateRequired($data);
        if(count($this->_errors) > 0) {
            return null;
        }
        $this->_validateData($data);
        if(count($this->_errors) > 0) {
            return null;
        }
        
        $data['password'] = md5($data['password']);
        $data['birthday'] = date('Y-m-d', strtotime($data['bday']['month'].' '.$data['bday']['day'].', '.$data['bday']['year']));
        $data['type'] = $data['gender'] == 'Male' ? 1 : 2;
        $data['token'] = md5($data['email'].time());
        $data['created'] = date('Y-m-d H:i:s');
        $data['updated'] = date('Y-m-d H:i:s');
        if($data['role_id'] == 1) {
            $data['exprires'] = date('Y-m-d H:i:s', time() + (72*60*60));
            $data['online'] = 1;
            $data['logout'] = date('Y-m-d H:i:s');
        }
        $unset = array('rpassword', 'remail', 'bday', 'step');
        foreach($unset as $key) {
            unset($data[$key]);
        }
        
        $user = $this->fetchNew();
        $user->setFromArray($data);
        $user->save();
        
        return $user;
    }
    
    protected function _validateRequired($data) {
        $required = array(
            'nickname' => 'Username is required', 
            'password' => 'Password is required', 
            'rpassword' => 'Repeat Password is required', 
            'fname' => 'First Name is required',
            'lname' => 'Last Name is required',
            'email' => 'Email is required',
            'remail' => 'Repeat Email is required',
            'gender' => 'Gender is required'
        );
        $this->_errors = array();
        foreach($required as $key => $msg) {
            if(!isset($data[$key]) || empty($data[$key])) {
                $this->_errors[] = $msg;
            }
        }
    }
    
    protected function _validateData($data) {
        if(!$this->_isUnique('nickname', $data['nickname'])) {
            $this->_errors[] = 'Username has already been taken';
        }
        if(strlen($data['password']) < 6 || strlen($data['password']) > 12) {
            $this->_errors[] = 'Password should be between 6 and 12 characters';
        }
        if($data['password'] != $data['rpassword']) {
            $this->_errors[] = 'Repeat Password and Password do not match';
        }
        if(!$this->_isUnique('email', $data['email'])) {
            $this->_errors[] = 'This email has already been registered';
        }
        if($data['email'] != $data['remail']) {
            $this->_errors[] = 'Repeat Email and Email do not match';
        }
    }
    
    protected function _isUnique($field, $value) {
        if($field == 'nickname') {
            $reserved = array('login', 'logout', 'signup', 'about', 'faqs', 'contact', 'home', 'memebers', 'woman', 'hot100', 'videos', 'galleries', 'events', 'life', 'more', 'account', 'search', 'ajax');
            if(in_array($value, $reserved)) {
                return false;
            }
        }
        $select = $this->select();
        $select->where($field.' = ?', $value);
        $row = $this->fetchRow($select);
        if($row === null) {
            return true;
        }
        return false;
    }
    
    public function getErrors() {
        return $this->_errors;
    }
    
    public static function get($user) {
        $inst = self::getInstance();
        return $inst->getByID($user);
    }
    
}