<?php



class Slider_model extends CI_Model {
    
    /**
     * Lureaza in principal cu entitatea : Slide 
    **/

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll(){
        $slides = $this->doctrine->em->getRepository('Entity:Slide')->findAll();
        return $slides;
    }
    
    public function getAllActive(){
        $slides = $this->doctrine->em->getRepository('Entity:Slide')->findBy(array('Status' => 1));
        return $slides;
    }
    
    public function getById($Id){
        $slide = $this->doctrine->em->getRepository('Entity:Slide')->findBy(array('SlideId' => $Id));
        if(isset($slide[0])){
            return $slide[0];
        }
        throw new \Exception('Slide ul nu a fost gasit!');
    }
    
    public function add($Data){
        //var_dump($Data);
        $slider = new \models\Entities\Slide();
        $slider->exchange($Data);
        if(isset($Data['Image'])){
            $slider->setImage($Data['Image']);
        }
        $this->doctrine->em->persist($slider);
        $this->doctrine->em->flush();
    }
    
    public function save($Slide , $Data = false){
        $Slide->exchange($Data);
        if(isset($Data['Image'])){
            $Slide->setImage($Data['Image']);
        }
        $this->doctrine->em->persist($Slide);
        $this->doctrine->em->flush();
        return $Slide;
    }
    
}