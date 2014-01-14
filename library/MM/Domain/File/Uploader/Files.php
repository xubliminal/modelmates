<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Files
 *
 * @author magentodeveloper
 */
class MM_Domain_File_Uploader_Files {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    public function save($path,$name,$ext) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path.$name.'.'.$ext)){
            return false;
        }
        return array(
            'url'   => $name,
            'format'=> $ext            
        );
    }
    
    public function getName() {
        return $_FILES['qqfile']['name'];
    }
    
    public function getSize() {
        return $_FILES['qqfile']['size'];
    }
    
    public function getMime() {
        return $_FILES['qqfile']['type'];
    }
}
