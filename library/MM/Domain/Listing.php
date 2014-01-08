<?php

class MM_Domain_Listing extends MM_Domain {
    
    protected $_category;
    
    public function getCategory() {
        if($this->_category === null) {
            $this->_category = MM_Service_Listings::getCategory($this->category);
        }
        
        return $this->_category;
    }
    
    
    public function addImages($images) { 
        foreach($images as $fid) {
            $picture = MM_Service_Pictures::getByFile($fid);
            $picture->object_id = $this->id;
            $picture->save();
        }
    }
    
    public function getMainPicture($size, $class = "") {
        $picture = MM_Service_Pictures::getMainOf('listing', $this->id);
        if($picture === null)
            return '';
        else {
            var_dump($picture); die;
        }
    }
    
    public function getCategoryLabel() {
        if($this->_category == null)
            $this->getCategory();
        
        return $this->_category->description;
    }
    
}