<?php

class MediaController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        // action body
    }
    
    public function videoAction()
    {
        
    }
    
    public function categoryAction()
    {
        
    }
    
    public function galleriesAction()
    {
        
    }
    
    public function eventsAction()
    {
        $this->view->events = MM_Service_Events::getAll(6);
    }
    
    public function eventsallAction()
    {
        $this->view->events = MM_Service_Events::getAll();
    }
    
    public function eventAction()
    {
        $event = MM_Service_Events::get($this->_getParam('id'));
        if($event === null)
            throw new Exception('Page Not Found');
        
        $this->view->event = $event;
        $this->view->title = 'Event: '. $event->title.' | ModelMates';
    }
    
    public function lifeAction()
    {
        $categories = MM_Service_Listings::getCategories();
        $category   = (isset($_GET['cat'])) ? $_GET['cat'] : $categories[0]->id;
        
        $listings = MM_Service_Listings::getAll($category);
        
        $this->view->categories = $categories;
        $this->view->category = $category;
        $this->view->listings = $listings;
        
        $this->view->title = "The Good Life | ModelMates";
    }
    
    public function lifedetailAction()
    {
        $listing = MM_Service_Listings::get($this->_getParam('id'));
        if($listing === null)
            throw new Exception('Page Not Found');
        
        $this->view->listing = $listing;
        
        $this->view->title = $listing->title ." | ModelMates";
    }
}

