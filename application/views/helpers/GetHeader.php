<?php

class Zend_View_Helper_GetHeader extends Zend_View_Helper_Abstract {
    
    public function getHeader($title = '', $class = '', $active = 'none') {
        $vars = array(
            'title' => $title,
            'class' => $class,
            'active' => $active
        );
        echo $this->view->partial('partials/header.phtml', $vars);
    }
    
}