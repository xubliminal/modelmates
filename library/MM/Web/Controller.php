<?php

class MM_Web_Controller extends Zend_Controller_Action {
    
    protected $user;
    
    public function init() {
        // Add css
        $this->addStyle('styles/reset.css');
        $this->addStyle('styles/fonts.css');
        $this->addStyle('scripts/fancybox/jquery.fancybox.css');
        $this->addStyle('styles/main.css');
        $this->addStyle('styles/ie.css', true);
        
        // Add Javascript
        $this->addScript('scripts/jquery.js');
        $this->addScript('scripts/jquery.backstretch.js');
        $this->addScript('scripts/fancybox/jquery.fancybox.js');
        $this->addScript('scripts/bind.js');
        $this->addScript('scripts/html5shiv.js', true);
        
        $this->addJSSettings('baseUrl', $this->view->baseUrl());
        
        $this->user = MM_Service_Users::getCurrent();
    }
    
    public function addStyle($href, $ie = false, $external = false, $media = 'all') {
        $styles = Zend_Registry::get('styles');
        $styles->add($href, $ie, $external, $media);
        Zend_Registry::set('styles', $styles);
    }
    
    public function addScript($src, $ie = false, $external = false) {
        $scripts = Zend_Registry::get('scripts');
        $scripts->add($src, $ie, $external);
        Zend_Registry::set('scripts', $scripts);
    }
    
    public function addJSSettings($key, $value) {
        $scripts = Zend_Registry::get('scripts');
        $scripts->addSettings($key, $value);
        Zend_Registry::set('scripts', $scripts);
    }
    
    protected function _isAjax() {
        return $this->_request->isXmlHttpRequest();
    }
    
    protected function _isPost() {
        return $this->_request->isPost();
    }
    
    protected function _dispatchJsonResponse($data) {
        header('Content-type: application/json');
        echo json_encode($data); die;
    }
    
}