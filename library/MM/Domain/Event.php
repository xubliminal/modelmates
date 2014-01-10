<?php

class MM_Domain_Event extends MM_Domain {
    
    public function addImage() {
        $picture = MM_Service_Pictures::getByFile($this->image);
        $picture->object_id = $this->id;
        $picture->save();
    }
    
    public function updateInfo($data) {
        // Update remove existing covers
        $existing_covers = isset($data['cover']) ? $data['cover'] : array();
        $this->updateCovers($existing_covers);
        unset($data['cover']);
        
        // Add new covers
        if(isset($data['covers'])) {
            $this->addCovers($data['covers']);
            unset($data['covers']);
        }
        
        $this->setFromArray($data);
        $this->save();
        
        $this->addImage();
    }
    
    public function updateCovers($covers) {
        $_covers = $this->getCovers();
        if(count($_covers)) {
            foreach($_covers as $c) {
                if(!isset($covers[$c->id]))
                    $c->delete();
                else {
                    $c->setFromArray($covers[$c->id]);
                    $c->save();
                }
            }
        }
    }
    
    public function addCovers($new_covers) {
        $covers = new Zend_Db_Table('event_covers');
        foreach($new_covers as $c) {
            $cover = $covers->fetchNew();
            $cover->setFromArray($c);
            $cover->event_id = $this->id;
            $cover->save();
        }
    }
    
    public function getCovers() {
        $covers = new Zend_Db_Table('event_covers');
        $select = $covers->select();
        $select->where('event_id = ?', $this->id);
        return $covers->fetchAll($select);
    }
    
    public function getDate($format = 'F jS, Y') {
        $datetime = strtotime($this->date);
        return date($format, $datetime);
    }
    
    public function getTime() {
        $start = strtotime($this->start);
        $finish = strtotime($this->finish);
        
        return date('g:i a', $start) . ' - ' . date('g:i a', $finish);
    }
    
    public function getPicture($size, $width, $height, $class = '') {
        $picture = MM_Service_Pictures::getByFile($this->image);
        return $picture->getImage($size, $width, $height, $class);
    }
    
}