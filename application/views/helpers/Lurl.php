<?php

class Zend_View_Helper_Lurl  extends Zend_View_Helper_Abstract {
    
    public function lurl($path = '') {
        return $this->view->baseUrl() . '/' . $path;
    }
    
}