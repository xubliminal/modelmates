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
        
        require_once "Services/Zencoder.php";
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
        
        // Replace video path
        $pathinfo = pathinfo($notification->outputs[0]->url);
        
        $this->_file->uri = $pathinfo['filename'];
        $this->_file->extension = $pathinfo['extension'];
        $this->_file->width = $notification->outputs[0]->width;
        $this->_file->height = $notification->outputs[0]->height;
        $this->_file->save();
        
        $this->duration = date('h:i:s', round($notification->outputs[0]->duration_in_ms / 1000));
        $this->processed = 1;
        $this->save();
        
        // Create Thumbnails and asign one as thumbnail
        $uploadDir = APPLICATION_PATH . '/uploads/';
        foreach($notification->outputs[0]->thumbnails[0]->images as $i => $image) {
            // Download File
            $pinfo = pathinfo($image->url);
            $name = $pinfo['filename'];
            $extension = $pinfo['extension'];
            $path = $uploadDir.$name.'.'.$extension;
            file_put_contents($path, fopen($this->_cloudConfig['cdn'].$name.'.'.$extension, 'r'));
            
            // Generate Thumbnails
            $images = $this->_file->generateThumbnials($path, $name, $extension, 'video');
            
            // Move to cloud
            $files = $this->_file->moveToCloud($images);
            
            // Save picture to database
            $thumbnail_file = MM_Service_Files::create();
            $thumbnail_file->user_id = $this->_file->user_id;
            $thumbnail_file->width = $images['original']['width'];
            $thumbnail_file->height = $images['original']['height'];
            $thumbnail_file->size = $image->file_size_bytes;
            $thumbnail_file->uri = $name;
            $thumbnail_file->extension = $extension;
            $thumbnail_file->type = 'image/png';
            $thumbnail_file->created = date('Y-m-d H:i:s');
            $thumbnail_file->save();
            
            $thumbnail = MM_Service_Pictures::create($thumbnail_file->id, 'video', $this->id);
            
            if($i == 0) {
                $this->thumb = $thumbnail->id;
                $this->save();
            }
        }

        // Return result
        return array('success' => 1);
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