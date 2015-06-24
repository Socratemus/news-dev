<?php

class Image_model extends CI_Model {
    
    private $FolderThumb    = 'public/data/thumbs' ;
    private $FolderMedium   = 'public/data/medium' ;
    private $FolderBig      = 'public/data/big' ;
    private $FolderOriginal = 'public/data/original' ;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add($Data = false , $Options = array()){
        
        $name = $Data['file_name'];
        $path = $Data['full_path'];
        
        $thumb  =  $this->generateThumb($path , $name , $Options );
        $medium =  $this->generateMedium( $path , $name , $Options );
        $big    =  $this->generateBig( $path , $name , $Options );
        
        $data = array(
            'Thumb' => base_url($thumb) ,
            'Medium' => base_url($medium) ,
            'Big' => base_url($big) ,
            'Original' => base_url($this->FolderOriginal . '/' . $name),
            'Data' => json_encode($Data)
        );
        
        $image = new \models\Entities\Image();
        $image->exchange($data);
        
        $this->doctrine->em->persist($image);
        $this->doctrine->em->flush();
        return $image;
    }
    
    /**************************************************************************/
    
    private function generateThumb($Path , $Name , $Options) {
        $image = new Imagick($Path);
        $width = 120; $width = isset($Options['thumb']['width']) ? $Options['thumb']['width'] : $width; 
        $height = 90; $height = isset($Options['thumb']['height']) ? $Options['thumb']['height'] : $height;
        $image->cropThumbnailImage( $width, $height );
        $savePath = $this->FolderThumb . "/" . $Name;
        $image->writeImage( $savePath );
        return $savePath;
    }
    
    private function generateMedium($Path , $Name , $Options) {
         $image = new Imagick($Path);
         $width = 360; $width = isset($Options['medium']['width']) ? $Options['medium']['width'] : $width; 
         $height = 250; $height = isset($Options['medium']['height']) ? $Options['medium']['height'] : $height;
         $image->cropThumbnailImage( $width, $height );
         $savePath = $this->FolderMedium . "/" . $Name;
         $image->writeImage( $this->FolderMedium . "/" . $Name );
         return $savePath;
    }
    
    private function generateBig($Path , $Name , $Options) {
         $image = new Imagick($Path);
         $width = 720; $width = isset($Options['big']['width']) ? $Options['big']['width'] : $width; 
         $height = 520; $height = isset($Options['big']['height']) ? $Options['big']['height'] : $height;
         $image->cropThumbnailImage( $width, $height );
         $savePath = $this->FolderBig . "/" . $Name;
         $image->writeImage( $this->FolderBig . "/" . $Name );
         return $savePath;
    }
    
}