<?php

class SessionController extends MM_Web_Controller
{

    public function init()
    {
        parent::init();
    }
    
    public function loginAction() 
    {
        $this->view->title = 'Login | ModelMates.com';
    }
    
    public function signupAction() 
    {
        $this->view->step = 1;
        if($this->_isPost()) {
            $users = new MM_Service_Users();
            if($_POST['step'] == 1) {                
                $user = $users->create($_POST);
                if($user === null) {
                    $errors = $users->getErrors();
                    $result = array(
                        'error' => 1,
                        'messages' => $errors,
                    );
                } else {
                    $result = array(
                        'success' => 1,
                        'user' => $user->id,
                        'token' => $user->token,
                        'step' => 2
                    );
                }
                if($this->_isAjax()) {
                    header('Content-type: application/json');
                    echo json_encode($result); die;
                } else {
                    if(isset($result['success'])) {
                        $this->view->step = 2;
                        $this->view->user = $user->id;
                        $this->view->token = $user->token;
                    } else {
                        $this->view->errors = $result['messages'];
                    }
                }
            } else if($_POST['step'] == 2) {
                $user = $users->getByID($_POST['user']);
                if($user->token != $_POST['token']) {
                    throw new Exception('Page Not Found');
                }
                
                $user->createProfile($_POST);
                
                if($this->_isAjax()) {
                    
                    $result = array(
                        'success' => 1,
                        'user' => $user->id,
                        'token' => $user->token,
                        'step' => 3
                    );
                    
                    header('Content-type: application/json');
                    echo json_encode($result); die;
                } else {
                    $this->addScript('scripts/uploader.js');
                    
                    $this->view->step = 3;
                    $this->view->user = $user->id;
                    $this->view->token = $user->token;
                }                
            }
        }
        
        
        $this->addScript('scripts/signup.js');
        $this->view->title = "Signup | ModelMates";
        $this->view->roles = MM_Service_Users::getRoles();
    }


}

