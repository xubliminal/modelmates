<?php

class Zend_View_Helper_GetScripts extends Zend_View_Helper_Abstract {
    
    public function getScripts() {
        $scripts = Zend_Registry::get('scripts');
        $js = $scripts->getAll();
        $ordered = array('ie' => array(), 'noie' => array());
        foreach($js as $j) {
            if(!$j->external) {
                $j->src = $this->view->lurl($j->src);
            }
            if($j->ie) {
                $ordered['ie'][] = $j;
            } else {
                $ordered['noie'][] = $j;
            }
        }
        
        echo $this->view->partial('widgets/scripts.phtml', array('scripts' => $ordered));
    }
    
}