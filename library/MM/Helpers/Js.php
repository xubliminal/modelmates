<?php 

class MM_Helpers_Js {
    
    protected $js;
    
    public function __construct()
    {
        $this->js = array();
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