<?php 

class MM_Helpers_Js {
    
    protected $js;
    
    protected $settings;
    
    public function __construct()
    {
        $this->js = array();
        $this->settings = array();
    }
    
    public function addSettings($key, $value) {
        $this->settings[$key] = $value;
    }
    
    public function getSettings() {
        return $this->settings;
    }
    
    public function add($src, $ie = false, $external = false) {
        if(!isset($this->js[$src])) {
            $js = new stdClass();
            $js->src = $src;
            $js->ie = $ie;
            $js->external = $external;

            $this->js[$src] = $js;
        }
    }
    
    public function getAll() {
        return $this->js;
    }
}