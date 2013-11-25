<?php

class AccountController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
        if($this->user === null)
            $this->_redirect('login');
    }

    public function indexAction()
    {
        // action body
    }
    
    public function profileAction() 
    {
        
    }
    
    public function messagesAction() 
    {
        
    }
    
    public function recentAction() 
    {
        
    }
    
    public function favoritesAction()
    {
        
    }
    
    public function settingsAction()
    {
        
    }
    
    public function mediaAction() 
    {
        
    }
    
    public function passwordAction()
    {
        
    }
    
    public function privacyAction()
    {
        
    }
    
    public function subscriptionAction()
    {
        
    }
    
    public function upgradeAction()
    {
        
    }


}

