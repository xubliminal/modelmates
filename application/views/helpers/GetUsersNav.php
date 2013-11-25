<?php

class Zend_View_Helper_GetUsersNav extends Zend_View_Helper_Abstract 
{
    
    public function getUsersNav() {
        echo $this->view->partial('widgets/usersNav.phtml');
    }
    
}