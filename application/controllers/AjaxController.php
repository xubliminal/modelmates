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
            $type  = isset($_GET['type']) ? $_GET['type'] : 'image';
            $size  = isset($_GET['size']) ? $_GET['size'] : array();
            $result = $file->upload($_GET['user'], $size, $scope, $type);
            $this->_dispatchJsonResponse($result);
        }
    }
    
}