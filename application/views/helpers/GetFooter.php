<?php

class Zend_View_Helper_GetFooter extends Zend_View_Helper_Abstract {
    
    
    public function getFooter($scope = '') {
        $params = array(
            'scope' => $scope
        );
        echo $this->view->partial('partials/footer.phtml', $params);
        //echo $this->view->partial('partials/header.phtml', array('title' => $title));
    }
    
    
}