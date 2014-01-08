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
            $scope = isset($_GET['scope']) ? $_GET['scope'] : 'profile';
            $result = $file->upload($_GET['user'], $_GET['size'], $scope);
            $this->_dispatchJsonResponse($result);
        }
    }
    
}