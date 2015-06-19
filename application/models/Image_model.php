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
    
    public function add($Data = false){
        
        $name = $Data['file_name'];
        $path = $Data['full_path'];
        
        $thumb  =  $this->generateThumb($path , $name);
        $medium =  $this->generateMedium( $path , $name );
        $big    =  $this->generateBig( $path , $name );
        
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
    
    private function generateThumb($Path , $Name) {
        $image = new Imagick($Path);
        $image->cropThumbnailImage( 120, 100 );
        $savePath = $this->FolderThumb . "/" . $Name;
        $image->writeImage( $savePath );
        return $savePath;
    }
    
    private function generateMedium($Path , $Name) {
         $image = new Imagick($Path);
         $image->cropThumbnailImage( 360, 300 );
         $savePath = $this->FolderMedium . "/" . $Name;
         $image->writeImage( $this->FolderMedium . "/" . $Name );
         return $savePath;
    }
    
    private function generateBig($Path , $Name) {
         $image = new Imagick($Path);
         $image->cropThumbnailImage( 720, 600 );
         $savePath = $this->FolderBig . "/" . $Name;
         $image->writeImage( $this->FolderBig . "/" . $Name );
         return $savePath;
    }
    
}