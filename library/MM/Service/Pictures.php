<?php

class MM_Service_Pictures extends MM_Service {
    
    protected static $_instance;
    
    protected $_name = 'pictures';
    
    protected $_rowClass = 'MM_Domain_Picture';
    
    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public static function create($file, $type, $id) {
        $inst = self::getInstance();
        return $inst->createNew($file, $type, $id);
    }
    
    public static function getByFile($file) {
        $inst = self::getInstance();
        return $inst->getByFileId($file);
    }
    
    public static function getMainOf($type, $id) {
        $inst = self::getInstance();
        $select = $inst->select();
        $select->where('object_type = ?', $type);
        $select->where('object_id = ?', $id);
        
        return $inst->fetchRow($select);
    }
    
    public static function getAllOf($type, $id) {
        $inst = self::getInstance();
        $select = $inst->select();
        $select->where('object_type = ?', $type);
        $select->where('object_id = ?', $id);
        
        return $inst->fetchAll($select);
    }
    
    public function createNew($file, $type, $id) {
        $pic = $this->fetchNew();
        $pic->object_id = $id;
        $pic->object_type = $type;
        $pic->file_id = $file;
        $pic->created = date('Y-m-d H:i:s');
        
        $pic->save();
        return $pic;
    }
    
    public function getByFileId($file) {
        $select = $this->select();
        $select->where('file_id = ?', $file);
        
        return $this->fetchRow($select);
    }
    
}