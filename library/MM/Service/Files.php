<?php

class MM_Service_Files extends MM_Service {
    
    protected static $_instance;
    
    protected $_name = 'files';
    
    protected $_rowClass = 'MM_Domain_File';
    
    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public static function create() {
        $inst = self::getInstance();
        return $inst->fetchNew();
    }
    
    public static function get($id) {
        $inst = self::getInstance();
        return $inst->getByID($id);
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