<?php

class MM_Web_Controller extends Zend_Controller_Action {
    
    public function init() {
        // Add css
        $this->addStyle('styles/reset.css');
        $this->addStyle('styles/fonts.css');
        $this->addStyle('styles/main.css');
        $this->addStyle('styles/ie.css', true);
        
        // Add Javascript
        $this->addScript('scripts/jquery.js');
        $this->addScript('scripts/jquery.backstretch.js');
        $this->addScript('scripts/bind.js');
        $this->addScript('scripts/html5shiv.js', true);
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
    
}