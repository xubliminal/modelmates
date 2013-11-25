<?php

class MM_Service_Profiles extends MM_Service {
    
    protected $_name = "profiles";
    
    protected $_rowClass = 'MM_Domain_Profile';
    
    public function create($user, $data) {
        $profile = $this->fetchNew();
        $profile->setFromArray($data);
        $profile->user_id = $user->id;
        $profile->save();
        
        return $profile;
    }
    
}