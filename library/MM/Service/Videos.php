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
    
    public static function getAll($type = null) {
        $inst = self::getInstance();
        $select = $inst->select();
        if($type === null)
            $select->where('object_type is null');
        else {
            $select->where('object_type = ?', $type);
        }
        return $inst->fetchAll($select);
    }
    
    public static function create($file) {
        $inst = self::getInstance();
        return $inst->createNew($file);
    }
    
    public function createNew($file) {
        $vid = $this->fetchNew();
        $vid->file_id = $file;
        $vid->created = date('Y-m-d H:i:s');
        $vid->save();
        
        $vid->process();
        
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
    
}