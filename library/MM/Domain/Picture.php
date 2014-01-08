<?php

class MM_Domain_Picture extends MM_Domain {
    
    protected $_cloudConfig;
    
    protected $_sizes;
    
    protected $_file;
    
    public function __construct(array $config = array())
    {
        parent::__construct($config);
        
        $this->_cloudConfig = Zend_Registry::get('cloud');
        $this->_sizes = Zend_Registry::get('sizes');
        
        $this->_file = $this->getFile();
    }
    
    public function getUrl() {
        return $this->_cloudConfig['cdn'].$this->_file->uri.'.'.$this->_file->extension;
    }
    
    public function getImage($size, $width, $height = null, $class = '') {
        if($this->_file == null){
            $this->getFile();
        }
        if($width == '') {
            $width = $this->_file->width;
        }
        if($height === null) {
            $height = $width;
        } 
        elseif($height == '') {
            $height = $this->_file->height;
        }
        
        if(!isset($this->_sizes[$this->object_type][$size])) {
            $src = $this->_cloudConfig['cdn'].$this->_file->uri.'.'.$this->_file->extension;
        } else {
            $src = $this->_cloudConfig['cdn'].$this->_file->uri.'_'.md5($size).'.'.$this->_file->extension;
        }
        
        $html = '<div style="width:'.$width.'px; height:'.$height.'px; overflow:hidden;">';
        $html.= '<img src="'.$src.'" class="'.$class.'" width="'.$width.'" height="'.$height.'"/></div>';
        return $html;
    }
    
    public function getFile() {
        $this->_file = MM_Service_Files::get($this->file_id);
    }
    
}