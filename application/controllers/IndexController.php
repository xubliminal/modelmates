<?php

class IndexController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        // action body
        $this->view->title = "Welcome to ModelMates";
        
        $this->addScript('scripts/welcome.js');
    }


}

