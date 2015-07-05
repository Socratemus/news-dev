<?php

class Tag_model extends CI_Model {
    
    /**
     * Lureaza in principal cu entitatea : Tag
    **/

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll(){
        $tags = $this->doctrine->em->getRepository('Entity:Tag')->findAll();
        return $tags;
    }   
    
    public function getBySlug($Slug) {
         $tags = $this->doctrine->em->getRepository('Entity:Tag')->findBy(array('Slug' => $Slug));
         if(isset($tags[0])){
             return $tags[0];
         }
         throw new \Exception('Tag not found.');
    }
}