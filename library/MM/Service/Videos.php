<?php

class MM_Service_Videos extends MM_Service {
    
    protected static $_instance;
    
    protected $_name = "videos";
    
    protected $_rowClass = 'MM_Domain_Video';
    
    protected static function getInstance() {
        if(self::$_instance === null)
            self::$_instance = new self();
        
        return self::$_instance;
    }
    
    public static function getCategories() {
        $categories = new Zend_Db_Table('video_categories');
        return $categories->fetchAll();
    }
    
    public static function getCategory($slug) {
        $categories = new Zend_Db_Table('video_categories');
        $select = $categories->select();
        $select->where('permalink = ?', $slug);
        
        return $categories->fetchRow($select);
    }
    
    public static function getAll($type = null, $category = 'all') {
        $inst = self::getInstance();
        $select = $inst->select();
        if($type === null)
            $select->where('object_type is null');
        else {
            $select->where('object_type = ?', $type);
        }
        if($category != 'all') {
            $category = self::getCategory($category);
            if($category !== null) 
                $select->where('category_id = ?', $category->id);                
        }
        return $inst->fetchAll($select);
    }
    
    public static function create($file = null, $data = array()) {
        $inst = self::getInstance();
        return $inst->createNew($file, $data);
    }
    
    public function createNew($file = null, $data = array()) {
        if($file !== null) {
            $vid = $this->fetchNew();
            
            $vid->file_id = $file;
            $vid->created = date('Y-m-d H:i:s');
            $vid->save();
            
            $vid->process();
        } else if(count($data) > 0) {
            $vid = $this->getByFileId($data['file_id']);
            $vid->title = $data['title'];
            if(isset($data['thumb'])) 
                $vid->thumb = $data['thumb'];
            
            if(!empty($data['username'])) {
                $user = MM_Service_Users::getByUsername($data['user']);
                $vid->user_id = $user->id;
            }
            if(!empty($data['category_id'])) 
                $vid->category_id = $data['category_id'];
            
            $vid->save();
        }
        
        
        
        return $vid;
    }
    
    public static function getByFile($file) {
        $inst = self::getInstance();
        return $inst->getByFileId($file);
    }
    
    public function getByFileId($file) {
        $select = $this->select();
        $select->where('file_id = ?', $file);
        
        return $this->fetchRow($select);
    }
    
    public static function get($id) {
        $inst = self::getInstance();
        return $inst->getByID($id);
    }
    
    public static function remove($id) {
        $video = self::get($id);
        $video->delete();
    }
    
    public static function getNext($id) {
        $inst = self::getInstance();
        $select = $inst->select();
        $select->where('id > ?', $id);
        
        $next = $inst->fetchRow($select);
        if($next === null) {
            $select = $inst->select();
            $select->order('id ASC');
            
            $next = $inst->fetchRow($select);
        }
        return $next;
    }
}