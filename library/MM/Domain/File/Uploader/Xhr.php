<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Xhr
 *
 * @author magentodeveloper
 */
class MM_Domain_File_Uploader_Xhr {
    
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    public function save($path, $name, $ext) {    
        $input = fopen("php://input", "r");
        $temp  = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path.$name.'.'.$ext, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return array(
            'url'   => $name,
            'format'=> $ext            
        );
    }
    
    public function getName() {
        return $_GET['qqfile'];
    }
    
    public function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    } 
    
}
