<?php

class MM_Domain_Gallery extends MM_Domain {
    
    
    public function addImages($images) {
        foreach($images as $file_id) {
            $pic = MM_Service_Pictures::getByFile($file_id);
            $pic->object_id = $this->id;
            $pic->save();
        }
    }
    
    public function imagesCount() {
        $pictures = MM_Service_Pictures::getAllOf('gallery', $this->id);
        return count($pictures);
    }
    
    public function getImages() {
        return MM_Service_Pictures::getAllOf('gallery', $this->id);
    }
    
    public function updateInfo($data) {
        $images = (isset($data['image'])) ? $data['image'] : array();
        $this->updateImages($images); unset($data['image']);
        
        if(isset($data['images'])) {
            $this->addImages($data['images']); unset($data['images']);
        }
        
        $data['update'] = date('Y-m-d H:i:s');
        $this->setFromArray($data);
        $this->save();
    }
    
    public function updateImages($images) {
        $pictures = $this->getImages();
        foreach($pictures as $pic) {
            if(!isset($images[$pic->file_id]))
                $pic->delete();
        }
    }
}