<?php

class Zend_View_Helper_GetHeader extends Zend_View_Helper_Abstract {
    
    public function getHeader($title = '') {
        echo $this->view->partial('partials/header.phtml', array('title' => $title));
    }
    
}