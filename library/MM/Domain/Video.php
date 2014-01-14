<?php

class MM_Domain_Video extends MM_Domain {
    
    protected $_zenAPI;
    
    protected $_cloudConfig;
    
    protected $_file;
    
    protected $_encoder;
    
    public function __construct(array $config = array()) {
        parent::__construct($config);
        
        $this->_zenAPI = Zend_Registry::get('Zencoder');
        $this->_cloudConfig = Zend_Registry::get('cloud');
        
        $this->getFile();
        
        require "Services/Zencoder.php";
        $this->_encoder = new Services_Zencoder($this->_zenAPI);
    }
    
    public function process() {
        
        $baseUrl = $this->getCloudUrl();
        $job = $this->_encoder->jobs->create(array(
            'input' => $this->getUrl(),
            'outputs' => array(
                array(
                    'base_url' => $baseUrl,
                    'filename' => $this->_file->uri.'-p.mp4',
                    'thumbnails' => array(
                        'base_url' => $baseUrl,
                        'filename' => $this->_file->uri.'-thumb-{{number}}',
                        'number' => 5,
                    ),
                    'notifications' => array(
                        'url' => 'http://166.78.10.207/ajax/videoprocessed/?v='.$this->file_id
                    )
                )
            )
        ));
        $this->job = $job->id;
        $this->save();
    }
    
    public function processNotification() {
        $notification = $this->_encoder->notifications->parseIncoming();
        if($this->job != $notification->job->id) 
            return array('error' => 'Video not found');
        
        $images = array();
        var_dump($notification->job->outputs[0]); die;
    }
    
    public function getCloudUrl() {
        return 'cf://'.$this->_cloudConfig['username'].':'.$this->_cloudConfig['key'].'@'.$this->_cloudConfig['container'];
    }
    
    public function getUrl() {
        $this->getFile();
        return $this->_cloudConfig['cdn'].$this->_file->uri.'.'.$this->_file->extension;
    }
    
    public function getFile() {
        $this->_file = MM_Service_Files::get($this->file_id);
    }
    
}