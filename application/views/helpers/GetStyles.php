<?php

class Zend_View_Helper_GetStyles extends Zend_View_Helper_Abstract {
    
    public function getStyles() {
        $styles = Zend_Registry::get('styles');
        $css = $styles->getAll();
        $ordered = array('ie' => array(), 'noie' => array());
        foreach($css as $c) {
            if(!$c->external) {
                $c->href = $this->view->lurl($c->href);
            }
            if($c->ie) {
                $ordered['ie'][] = $c;
            } else {
                $ordered['noie'][] = $c;
            }
        }
        
        echo $this->view->partial('widgets/styles.phtml', array('styles' => $ordered));
    }
    
}