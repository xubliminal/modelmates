<?php

class MM_Service_Events extends MM_Service {
    
    protected static $_instance;
    
    protected $_name = "events";
    
    protected $_rowClass = "MM_Domain_Event";
    
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
        $event = $this->fetchNew();
        $covers = (isset($data['covers'])) ? $data['covers'] : array();
        unset($data['covers']);
        
        $data['created'] = date('Y-m-d H:i:s');
        $event->setFromArray($data);
        $event->save();
        
        $event->addImage();
        if(count($covers) > 0)
            $event->addCovers($covers);
        
        return $event;
    }
    
    public static function getAll($limit = false) {
        $inst = self::getInstance();
        $select = $inst->select();
        if($limit !== false) {
            $select->limit($limit);
        }
        return $inst->fetchAll($select);
    }
    
    public static function get($id) {
        $inst = self::getInstance();
        return $inst->getByID($id);
    }
    
    public static function remove($id) {
        $inst = self::getInstance();
        $event = $inst->getByID($id);
        if($event !== null)
            $event->delete();
    }
}