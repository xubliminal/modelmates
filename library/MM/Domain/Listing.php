<?php

class MM_Domain_Listing extends MM_Domain {
    
    protected $_category;
    
    public function getCategory() {
        if($this->_category === null) {
            $this->_category = MM_Service_Listings::getCategory($this->category);
        }
        
        return $this->_category;
    }
    
}