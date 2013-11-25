<?php 

class MM_Helpers_Css {
    
    protected $css;
    
    public function __construct()
    {
        $this->css = array();
    }
    
    public function add($href, $ie = false, $external = false, $media = 'all') {
        if(!isset($this->css[$href])) {
            $css = new stdClass();
            $css->href = $href;
            $css->ie = $ie;
            $css->external = $external;
            $css->media = $media;

            $this->css[$href] = $css;
        }
    }
    
    public function getAll() {
        return $this->css;
    }
}