<?php

class Zend_View_Helper_GetSidebar extends Zend_View_Helper_Abstract
{
    
    public function getSidebar($widgets = array()) {
        $vars = array(
            'widgets' => $widgets
        );
        
        echo $this->view->partial('widgets/sidebar.phtml', $vars);
        
    }
    
}