<?php

class MM_Service_Listings extends MM_Service {
    
    public static $_categories;
    
    public static $_instance;
    
    protected $_name = 'listings';
    
    protected $_rowClass = 'MM_Domain_Listing';
    
    public static function getCategories() {
        if(self::$_categories === null) {
            $categories = new Zend_Db_Table('listing_categories');
            self::$_categories = $categories->fetchAll();
        }
        return self::$_categories;
    }
    
    public static function remove($id) {
        $inst = self::getInstance();
        $select = $inst->select();
        $select->where('id = ?', $id);
        
        $listing = $inst->fetchRow($select);
        if($listing !== null)
            $listing->delete();
    }
    
    public static function getCategory($id) {
        $categories = new Zend_Db_Table('listing_categories');
        $select = $categories->select();
        $select->where('id = ?', $id);
        
        return $categories->fetchRow($select);
    }
    
    public static function getInstance() {
        if(self::$_instance === null)
            self::$_instance = new self();
        
        return self::$_instance;
    }
    
    public static function create($data) {
        $inst = self::getInstance();
        return $inst->createNew($data);
    }
    
    public function createNew($data) {
        $listing = $this->fetchNew();
        $images = $data['images']; unset($data['images']);
        $data['created'] = date('Y-m-d H:i:s');
        $listing->setFromArray($data);
        $listing->save();
        $listing->addImages($images);
        
        return $listing;
    }
    
    public static function getAll() {
        $inst = self::getInstance();
        return $inst->fetchAll();
    }
    
}