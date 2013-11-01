<?php

class Zend_View_Helper_GetMenu extends Zend_View_Helper_Abstract {
    
    public function getMenu() {
        echo $this->view->partial('widgets/menu.phtml');
    }
    
}