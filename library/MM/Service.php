<?php

class MM_Service extends Zend_Db_Table_Abstract 
{   
    public function getByID($id) {
        if($id === null) {
            return null;
        }        
        $select = $this->select();
        $select->where('id = ?', $id);
        
        $row = $this->fetchRow($select);
        return $row;
    }
}