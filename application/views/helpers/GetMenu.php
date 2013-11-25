<?php

class Zend_View_Helper_GetMenu extends Zend_View_Helper_Abstract {
    
    public function getMenu($active = 'none') {
        $items = array(
            'items' => array(
                array(
                    'href' => 'account',
                    'label' => 'Dashboard',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'members',
                    'label' => 'Members',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'hot100',
                    'label' => 'Hot 100',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'videos',
                    'label' => 'Videos',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'galleries',
                    'label' => 'Gallery',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'events',
                    'label' => 'Parties<br />&amp; Events',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'life',
                    'label' => 'The<br />Good Life',
                    'class' => '',
                    'access' => TRUE
                ),
                array(
                    'href' => 'more',
                    'label' => 'More',
                    'class' => '',
                    'access' => TRUE
                )
            )
        );
        
        if(isset($items['items'][$active]))
            $items['items'][$active]['class'] .= ' active';
        
        echo $this->view->partial('widgets/menu.phtml', $items);
    }
    
}