<?php

class Category_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll(){
        //$cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1));
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findAll();
        return $cats;
    }
    
    public function getPrimaryMenuCategories(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'PrMenu' => 1));
        return $cats;
    }
    
    public function getSecondaryMenuCategories(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'ScMenu' => 1));
        return $cats;
    }
    
    public function getFpt(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'Fpt' => 1));
        return $cats;
    }
    
    public function getFpb(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'Fpb' => 1));
        return $cats;
    }
    
    public function getById($Id){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('CategoryId' => $Id));
        if(isset($cats[0])){
            return $cats[0];
        }
        throw new \Exception('Nu exista o categorie cu acest id.');
    }
    
    /**
     * Intoarce o categorie dupa slugul ei.
     */
    public function getBySlug($Slug){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Slug' => $Slug , 'Status' => 1));
        if(isset($cats[0])){
            return $cats[0];
        }
        throw new \Exception('Nu exista o categorie cu acest id.');
    }
    
    /**
     * Adauga o categorie noua.
     */
    public function add($Data) {
        
        $category = new \models\Entities\Category();
        $category->exchange($Data);
        //var_dump($category);exit();
        $this->doctrine->em->persist($category);
        $this->doctrine->em->flush();
         
        return $category;
    }
    
    public function save($Data){
        //var_dump($Data);exit();
        $category = $this->getById($Data['CategoryId']);
        $category->exchange($Data);
        
        if(!isset($Data['Fpt'])){
           $category->setFpt(0); 
        }
        
        if(!isset($Data['Fpb'])){
           $category->setFpb(0); 
        }
        
        if(!isset($Data['Menu'])){
            $category->setMenu(0);
        }
        
        if(!isset($Data['Status'])){
            $category->setStatus(0);
        }
        
        $this->doctrine->em->persist($category);
        $this->doctrine->em->flush();
        return $category;
    }
    
}