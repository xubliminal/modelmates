<?php 

class MM_Helpers_Css {
    
    protected $css;
    
    public function __construct()
    {
        $this->css = array();
    }
    
    public function add($href, $ie = false, $external = false, $media = 'all') {
        $css = new stdClass();
        $css->href = $href;
        $css->ie = $ie;
        $css->external = $external;
        $css->media = $media;
        
        $this->css[] = $css;
    }
    
    public function getAll() {
        return $this->css;
    }
}