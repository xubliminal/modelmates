<?php

class MembersController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        // action body
    }
    
    public function userAction() {
        if($this->_getParam('username') != 'girl') {
            $this->_forward('about');
        }
    }
    
    public function aboutAction() {
        $template = ($this->_getParam('username') != 'girl') ? 'about' : 'about-girl';
        
        
        
        $this->render($template);
    }
    
    public function moreAction() {
        
    }
    
    public function lookbookAction() {
        
    }
    
    public function searchAction() {
        if(isset($_GET['type'])) {
            $template = 'results';
        } else {
            $template = 'search';
        }
        
        $this->view->for = (isset($_GET['for'])) ? $_GET['for'] : 'women';
        
        $this->render($template);
    }
}

