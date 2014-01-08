<?php

class MM_Domain_Listing extends MM_Domain {
    
    protected $_category;
    
    public function getCategory() {
        if($this->_category === null) {
            $this->_category = MM_Service_Listings::getCategory($this->category);
        }
        
        return $this->_category;
    }
    
    public function updateInfo($data) {
        $images = $this->getPictures();
        foreach($images as $img) {
            if(!isset($data['image'][$img->file_id]))
                $img->delete();
        }
        if(isset($data['images']) && count($data['images']) > 0) {
            $images = $data['images']; 
            unset($data['images']);
            
            $this->addImages($images);
        }
        $this->setFromArray($data);
        $this->save();
    }
    
    
    public function addImages($images) { 
        foreach($images as $fid) {
            $picture = MM_Service_Pictures::getByFile($fid);
            $picture->object_id = $this->id;
            $picture->save();
        }
    }
    
    public function getMainPicture($size, $width, $height, $class = "") {
        $picture = MM_Service_Pictures::getMainOf('listing', $this->id);
        if($picture === null)
            return '';
        else 
           return $picture->getImage($size, $width, $height, $class);
    }
    
    public function getCategoryLabel() {
        if($this->_category == null)
            $this->getCategory();
        
        return $this->_category->description;
    }
    
    public function getPictures() {
        return MM_Service_Pictures::getAllOf('listing', $this->id);
        
    }
    
}