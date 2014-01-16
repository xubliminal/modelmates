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
        
        $this->getFile();
    }
    
    public function getUrl() {
        $this->getFile();
        return $this->_cloudConfig['cdn'].$this->_file->uri.'.'.$this->_file->extension;
    }
    
    public function getImage($size, $width, $height = null, $class = '') {
        if($this->_file == null){
            $this->getFile();
        }
        
        $Idimensions = (isset($this->_sizes[$this->object_type][$size])) 
                ? $this->_sizes[$this->object_type][$size] 
                : array(
                    'width' => $this->_file->width,
                    'height' => $this->_file->height
                );
        
        $Ddimensions = array(
            'width' => (!empty($width) && $width != 'auto') ? $width : $Idimensions['width'],
            'height' => (!is_null($height) && !empty($height) && $height != 'auto') ? $height : $Idimensions['height']
        );
        
        $imgRatio = $Idimensions['width'] / $Idimensions['height'];
        $divRatio = $Ddimensions['width'] / $Ddimensions['height'];
        
        
        $divWidth = $Ddimensions['width'];
        $divHeight = $Ddimensions['height'];
        $imgWidth = ($imgRatio > $divRatio) ? 'auto' : $Ddimensions['width'];
        $imgHeight = ($imgRatio > $divRatio) ? $Ddimensions['height'] : 'auto';
        
        
        if(empty($size)) {
            $src = $this->_cloudConfig['cdn'].$this->_file->uri.'.'.$this->_file->extension;
        } else {
            $src = $this->_cloudConfig['cdn'].$this->_file->uri.'_'.md5($size).'.'.$this->_file->extension;
        }
        
        $html = '<div style="width:'.$divWidth.'px; height:'.$divHeight.'px; overflow:hidden;" class="'.$class.'">';
        $html.= '<img src="'.$src.'" class="'.$class.'" width="'.$imgWidth.'" height="'.$imgHeight.'"/></div>';
        return $html;
    }
    
    public function getFile() {
        $this->_file = MM_Service_Files::get($this->file_id);
    }
    
}