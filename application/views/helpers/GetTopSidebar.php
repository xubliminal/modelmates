<?php

class Zend_View_Helper_GetTopSidebar extends Zend_View_Helper_Abstract
{
    
    public function getTopSidebar($widgets = array()) {
        $vars = array(
            'widgets' => $widgets
        );
        echo $this->view->partial('widgets/top.phtml', $vars);
    }
    
}