<?php

class MM_Domain_Video extends MM_Domain {
    
    protected $_zenAPI;
    
    protected $_cloudConfig;
    
    protected $_file;
    
    public function __construct(array $config = array()) {
        parent::__construct($config);
        
        $this->_zenAPI = Zend_Registry::get('Zencoder');
        $this->_cloudConfig = Zend_Registry::get('cloud');
        
        $this->getFile();
    }
    
    public function process() {
        require "Services/Zencoder.php";
        $zencoder = new Services_Zencoder($this->_zenAPI);
        $baseUrl = $this->getCloudUrl();
        $job = $zencoder->jobs->create(array(
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
                        'url' => 'http://166.78.10.207/ajax/videoprocessed'
                    )
                )
            )
        ));
        $this->job = $job->id;
        $this->save();
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