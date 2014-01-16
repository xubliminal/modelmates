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
                    'width' => 606,
                    'height' => 346,
                    'format' => 'mp4',
                    'upscale' => true,
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
        $pathinfo = pathinfo($notification->job->outputs[0]->url);
        
        $this->_file->uri = $pathinfo['filename'];
        $this->_file->extension = $pathinfo['extension'];
        $this->_file->width = $notification->job->outputs[0]->width;
        $this->_file->height = $notification->job->outputs[0]->height;
        $this->_file->save();
        
        $this->duration = date('h:i:s', round($notification->job->outputs[0]->duration_in_ms / 1000));
        $this->processed = 1;
        $this->save();
        
        // Create Thumbnails and asign one as thumbnail
        $uploadDir = APPLICATION_PATH . '/uploads/';
        foreach($notification->job->outputs[0]->thumbnails[0]->images as $i => $image) {
            // Download File
            $pinfo = pathinfo($image->url);
            $name = $pinfo['filename'];
            $extension = $pinfo['extension'];
            $path = $uploadDir.$name.'.'.$extension;
            file_put_contents($path, fopen($this->_cloudConfig['cdn'].$name.'.'.$extension, 'r'));
            
            // Generate Thumbnails
            $images = $this->_file->generateImages($path, $name, $extension, 'video');
            
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
                $this->thumb = $thumbnail->file_id;
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
    
    public function getThumbUrl() {
        $pic = MM_Service_Pictures::getByFile($this->thumb);
        return $pic->getUrl();
    }
    
    public function getFile() {
        $this->_file = MM_Service_Files::get($this->file_id);
    }
    
    public function getCategory() {
        return '--';
    }
    
    public function getImages() {
        return MM_Service_Pictures::getAllOf('video', $this->id);
    }
    
    public function toArray() {
        $return = parent::toArray();
        if($this->object_type === 'hot100') {
            $hot100 = MM_Service_Hot100::get($this->object_id);
            $return['username'] = $hot100->getUsername();
        }
        $return['username'] = '';
        return $return;
    }
    
    public function updateInfo($data) {
        // Update Images
        $images = isset($data['image']) ? $data['image'] : array();
        $this->updateImages($images); unset($data['image']);
        
        // Add Images
        if(isset($data['images'])) {
            $this->addImages($data['images']);
            unset($data['images']);
        }
        
        // Update and save
        if(!empty($data['username'])) {
            // Add hot100 code here
        }
        unset($data['username']);
        
        if(empty($data['category_id'])) {
            $data['category_id'] = NULL;
        }
        
        $this->setFromArray($data);
        $this->save();
    }
    
    public function updateImages($images) {
        $_images = $this->getImages();
        foreach($_images as $pic) {
            if(!isset($images[$pic->file_id])) {
                $pic->delete();
            }
        }
    }
    
    public function addImages($images) {
        foreach($images as $file_id) {
            $pic = MM_Service_Pictures::getByFile($file_id);
            $pic->object_type = "video";
            $pic->object_id = $this->id;
            $pic->save();
        }
    }
    
    public function getThumbnail($size, $width, $height = '', $class = '') {
        $pic = MM_Service_Pictures::getByFile($this->thumb);
        return $pic->getImage($size, $width, $height, $class);
    }
    
    public function getDate($format = 'F jS, Y') {
        if($format != 'ago')
            return date($format, strtotime($this->created));
        
        $time = time() - strtotime($this->created);
 
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );
 
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($time / $seconds)) != 0) {
                break;
            }
        }
 
        $print = ($count == 1) ? '1 '.$name.' ago' : "$count {$name}s ago";
        return $print;
        
    }
    
}