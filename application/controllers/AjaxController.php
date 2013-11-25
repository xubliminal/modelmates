<?php

class AjaxController extends MM_Web_Controller {
    
    public function init()
    {
        parent::init();
    }
    
    public function uploadAction() 
    {
        if($this->_isAjax() && $this->_isPost()) {
            $file = MM_Service_Files::create();
            $result = $file->upload($_GET['user'], $_GET['size']);
            $this->_dispatchJsonResponse($result);
        }
    }
    
}