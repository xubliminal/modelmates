<?php

class IndexController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        if(isset($_COOKIE['showWelcome']) && $_COOKIE['showWelcome'] == 0)
            $this->_redirect('home');
        
        // Javascript
        $this->addScript('scripts/welcome.js');
        
        // View variables
        $this->view->title = "Welcome to ModelMates";
        $this->view->bodyClass = '';
    }
    
    public function homeAction() 
    {
        setcookie('showWelcome', 0, time()+60*60*24*365);
        
        // Javascript
        $this->addScript('scripts/home.js');
        
        // View Variables
        $this->view->title = "Welcome to ModelMates";
        $this->view->bodyClass = 'page-home';
    }


}

