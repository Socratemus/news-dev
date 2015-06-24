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
}