<?php

class MM_Domain_File extends MM_Domain {
    
    protected $_extensions;
    
    protected $_rowFile;
    
    protected $_sizeLimit;
    
    protected $_uploadDir;
    
    protected $_uploader;
    
    public function __construct(array $config = array())
    {
        parent::__construct($config);
        
        $this->_extensions = array(
            'image' => array('jpeg', 'jpg', 'png', 'gif'),
            'video' => array('mp4', 'm4v', 'f4v','mov','mpeg','ogm','ogv','wmv', 'webm', 'flv','3gp','3g2','3gpp','dat', 'asf', 'aff','avi','divx', 'dv')
        );
        
        $this->_sizeLimit = 20 * 1024 * 1024;
        
        $this->_uploadDir = APPLICATION_PATH . '/uploads/';
    }
    
    public function upload($user, $size = array(), $scope = 'profile', $type = 'image') {
        
        $user = MM_Service_Users::get($user);
        
        $name = $user->id.'z'.rand().'-'.md5($user->token.time().rand());
        
        $this->_uploader = new MM_Domain_File_Uploader($this->_extensions[$type], $this->_sizeLimit);
        
        $result = $this->_uploader->handleUpload($this->_uploadDir, $name);
        
        if(isset($result['error'])) 
            return $result;
        
        $path = realpath($this->_uploadDir.$result['url'].'.'.$result['format']);
        
        if($type == 'image') {
            $images = $this->_generateImages($path, $name, $result['format'], $scope);
            
            if(count($images) == 0)
                return array('error'=>'Unable to generate different sizes for the image');

            $cloudImages = $this->_moveToCloud($images);
            
            if(count($cloudImages) == 0)
                return array('error'=>'Unable to move files to the cloud');
        
            $this->user_id = $user->id;
            $this->width = $images['original']['width'];
            $this->height = $images['original']['height'];
            $this->size = $this->_uploader->getSize();
            $this->uri = $name;
            $this->extension = $result['format'];
            $this->type = $images['original']['type'];
            $this->created = date('Y-m-d H:i:s');
            $this->save();
            
            if($scope == 'profile')
                $picture = MM_Service_Pictures::create($this->id, $scope, $user->id);
            else
                $picture = MM_Service_Pictures::create($this->id, $scope, 0);
            
            return array(
                'success' => true,
                'image' => $picture->getImage($size['name'], $size['width'], $size['height']),
                'id' => $this->id
            );
            
        } else {
            //var_dump($_FILES); die;
            
            $videos = array(
                'original' => array(
                    'path' => $path,
                    'name' => $name . '.' . $result['format'],
                    'type' => $this->_uploader->getMime()
                )
            );
            
            $cloudVideos = $this->_moveToCloud($videos);

            if(count($cloudVideos) == 0)
                return array('error'=>'Unable to move files to the cloud');
            
            $this->user_id = $user->id;
            $this->size = $this->_uploader->getSize();
            $this->uri = $name;
            $this->extension = $result['format'];
            $this->type = $videos['original']['type'];
            $this->created = date('Y-m-d H:i:s');
            $this->save();
            
            $video = MM_Service_Videos::create($this->id);
            
            return array(
                'success' => true,
                'id' => $this->id
            );
        }        
        
        return array('success' => 1);
    }
    
    public function generateImages($path, $name, $ext, $scope = 'profile') {
        $this->_generateImages($path, $name, $ext, $scope);
    }
    
    protected function _generateImages($path, $name, $ext, $scope = 'profile')
    {
        $sizes = Zend_Registry::get('sizes');
        $images = array();
        $size = GetImageSize($path);
        if(isset($sizes[$scope])) {
        foreach($sizes[$scope] as $sizeName => $s) {
            
            $opts = array(
                'w' => $s['width'],
                'h' => $s['height'],
                'crop' => true
            );
            
            $quality = 90;
            
            $newName = $this->_uploadDir.$name.'_'.md5($sizeName).'.'.$ext;
            
            $offsetX = null;
            $offsetY = null;
            
            $mime = $size['mime'];
            
            $width  = $size[0];
            $height = $size[1];
            
            $maxWidth  = (isset($opts['w'])) ? (int) $opts['w'] : 0;
            $maxHeight = (isset($opts['h'])) ? (int) $opts['h'] : 0;
            
            $cropRatio = array(
                $opts['w'],
                $opts['h']
            );
            
            if (count($cropRatio) == 2) {
                $ratioComputed = $width / $height;
                $cropRatioComputed = (float) $cropRatio[0] / (float) $cropRatio[1];

                if ($ratioComputed < $cropRatioComputed) { // Image is too tall so we will crop the top and bottom
                    $origHeight = $height;
                    $height = $width / $cropRatioComputed;
                    $offsetY = ($origHeight - $height) / 2;
                } else if ($ratioComputed > $cropRatioComputed) { // Image is too wide so we will crop off the left and right sides
                    $origWidth = $width;
                    $width = $height * $cropRatioComputed;
                    $offsetX = ($origWidth - $width) / 2;
                }
            }

            $xRatio = $maxWidth / $width;
            $yRatio = $maxHeight / $height;

            if ($xRatio * $height < $maxHeight) { // Resize the image based on width
                $tnHeight = ceil($xRatio * $height);
                $tnWidth = $maxWidth;
            } else { // Resize the image based on height
                $tnWidth = ceil($yRatio * $width);
                $tnHeight = $maxHeight;
            }
            
            $dst = imagecreatetruecolor($tnWidth, $tnHeight);
            
            switch ($size['mime']) {
                case 'image/gif':
                    // We will be converting GIFs to PNGs to avoid transparency issues when resizing GIFs
                    // This is maybe not the ideal solution, but IE6 can suck it
                    $creationFunction = 'ImageCreateFromGif';
                    $outputFunction = 'ImagePng';
                    $mime = 'image/png'; // We need to convert GIFs to PNGs
                    $doSharpen = FALSE;
                    $quality = round(10 - ($quality / 10)); // We are converting the GIF to a PNG and PNG needs a compression level of 0 (no compression) through 9
                    break;

                case 'image/x-png':
                case 'image/png':
                    $creationFunction = 'ImageCreateFromPng';
                    $outputFunction = 'ImagePng';
                    $doSharpen = FALSE;
                    $quality = round(10 - ($quality / 10)); // PNG needs a compression level of 0 (no compression) through 9
                    break;

                default:
                    $creationFunction = 'ImageCreateFromJpeg';
                    $outputFunction = 'ImageJpeg';
                    $doSharpen = TRUE;
                    break;
            }
            
            $src = $creationFunction($path);
            
            $color = false;

            if (in_array($size['mime'], array('image/gif', 'image/png'))) {
                if (!$color) {
                    // If this is a GIF or a PNG, we need to set up transparency
                    imagealphablending($dst, false);
                    imagesavealpha($dst, true);
                } else {
                    // Fill the background with the specified color for matting purposes
                    if ($color[0] == '#')
                        $color = substr($color, 1);

                    $background = FALSE;

                    if (strlen($color) == 6)
                        $background = imagecolorallocate($dst, hexdec($color[0] . $color[1]), hexdec($color[2] . $color[3]), hexdec($color[4] . $color[5]));
                    else if (strlen($color) == 3)
                        $background = imagecolorallocate($dst, hexdec($color[0] . $color[0]), hexdec($color[1] . $color[1]), hexdec($color[2] . $color[2]));
                    if ($background)
                        imagefill($dst, 0, 0, $background);
                }
            }

            // Resample the original image into the resized canvas we set up earlier
            ImageCopyResampled($dst, $src, 0, 0, $offsetX, $offsetY, $tnWidth, $tnHeight, $width, $height);

            ImageDestroy($src);

            if ($doSharpen) {
                // Sharpen the image based on two things:
                //	(1) the difference between the original size and the final size
                //	(2) the final size
                $sharpness = $this->findSharp($width, $tnWidth);

                $sharpenMatrix = array(
                    array(-1, -2, -1),
                    array(-2, $sharpness + 12, -2),
                    array(-1, -2, -1)
                );
                $divisor = $sharpness;
                $offset = 0;
                imageconvolution($dst, $sharpenMatrix, $divisor, $offset);
            }

            // Write the resized image to the cache
            $outputFunction($dst, $newName, $quality);

            ImageDestroy($dst);
            
            $images[$sizeName]['path'] = $newName;
            $images[$sizeName]['name'] = $name.'_'.md5($sizeName).'.'.$ext;
            $images[$sizeName]['type'] = $size['mime'];
        }
        }
        
        $images['original']['path'] = $path;
        $images['original']['name'] = $name.'.'.$ext;
        $images['original']['type'] = $size['mime'];
        $images['original']['width'] = $size[0];
        $images['original']['height'] = $size[1];
        
        return $images;
    }
    
    protected function findSharp($orig, $final) // function from Ryan Rud (http://adryrun.com)
    {
        $final = $final * (750.0 / $orig);
        $a = 52;
        $b = -0.27810650887573124;
        $c = .00047337278106508946;

        $result = $a + $b * $final + $c * $final * $final;

        return max(round($result), 0);
    }
    
    public function moveToCloud($files) {
        return $this->_moveToCloud($files); die;
    }
    
    protected function _moveToCloud($files)
    {
        require_once 'Cloud/cloudfiles.php';
        $conf = Zend_Registry::get('cloud');
        
        $auth = new CF_Authentication($conf['username'], $conf['key']);
        $auth->authenticate();
        
        $conn = new CF_Connection($auth);
        $container = $conn->get_container($conf['container']);
        
        $_files = array();
        
        foreach($files as $file) {
            $object = $container->create_object($file['name']);
            $object->content_type = $file['type'];
            $object->load_from_filename($file['path']);
            $_files[] = $object->public_uri();
            unlink($file['path']);
        }
        
        return $_files;
    }
    
}