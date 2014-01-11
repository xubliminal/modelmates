<?php

class MM_Service_Galleries extends MM_Service {
    
    protected $_name = "galleries";
    
    protected $_rowClass = "MM_Domain_Gallery";
    
    protected static $_instance;
    
    public static function getInstance() {
        if(self::$_instance === null)
            self::$_instance = new self();
        
        return self::$_instance;
    }
    
    public static function getAll() {
        $inst = self::getInstance();
        return $inst->fetchAll();
    }
    
    public static function create($data) {
        $inst = self::getInstance();
        return $inst->createNew($data);
    }
    
    public function createNew($data) {
        $gallery = $this->fetchNew();
        $images = $data['images']; unset($data['images']);
        
        $data['created'] = date('Y-m-d H:i:s');
        $data['updated'] = date('Y-m-d H:i:s');
        
        $gallery->setFromArray($data);
        $gallery->save();
        
        $gallery->addImages($images);
        return $gallery;
    }
    
    public static function get($id) {
        $inst = self::getInstance();
        return $inst->getByID($id);
    }
    
    public static function remove($id) {
        $gallery = self::get($id);
        $gallery->delete();
    }
    
}