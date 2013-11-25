<?php

class MM_Domain_User extends MM_Domain {
    
    protected $_profiles;
    
    protected $_profile;
    
    public function createProfile($data) {
        $unset = array('step', 'user', 'token', 'type');
        $this->type = $data['type'];
        foreach($unset as $key) {
            unset($data[$key]);
        }
        
        if($this->_profiles === null) {
            $this->_profiles = new MM_Service_Profiles();
        }
        
        $this->_profile = $this->_profiles->create($this, $data);
        
        $this->save();
    }
    
}