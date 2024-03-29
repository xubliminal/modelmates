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
        $this->view->categories = MM_Service_Videos::getCategories();
        $this->view->events = MM_Service_Events::getAll(6);
    }
    
    public function videoAction()
    {
        $video = MM_Service_Videos::get($this->_getParam('id'));
        if($video === null)
            throw new Exception('Page Not Found');
        
        $this->view->videos = MM_Service_Videos::getAll();
        $this->view->next = MM_Service_Videos::getNext($video->id);
        $this->view->video = $video;
        
        $this->addJSSettings('video_image', $video->getThumbUrl());
        $this->addJSSettings('video_file', $video->getUrl());
        
        $this->addScript('scripts/jwplayer.js');
        $this->addScript('scripts/video.js');
    }
    
    public function categoryAction()
    {
        $category = $this->_getParam('category');
        $this->view->videos = MM_Service_Videos::getAll(null, $category);
    }
    
    public function galleriesAction()
    {
        $galleries = MM_Service_Galleries::getAll();
        $id = $this->_getParam('id', null);
        if($id === null)
            $gallery = $galleries[0];
        else
            $gallery = MM_Service_Galleries::get($id);
        if($gallery === null)
            throw new Exception('Page Not Found');
        
        $this->view->galleries = $galleries;
        $this->view->gallery = $gallery;
       
        
        $this->view->title = 'Gallery: '. $gallery->title.' | ModelMates';
        
    }
    
    public function eventsAction()
    {
        $this->view->events = MM_Service_Events::getAll(6);
        $this->view->title = 'Events | ModelMates';
    }
    
    public function eventsallAction()
    {
        $this->view->events = MM_Service_Events::getAll();
        $this->view->title = 'Events | ModelMates';
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

