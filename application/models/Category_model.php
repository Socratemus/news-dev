<?php

use Doctrine\ORM\Tools\Pagination\Paginator;

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
    
    /**
     * Intoarce categoriile din meniul princial
     */
    public function getPrimaryMenuCategories(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'PrMenu' => 1));
        return $cats;
    }
    
    /**
     * Intoarce categoriile din meniul secundar
     */
    public function getSecondaryMenuCategories(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'ScMenu' => 1));
        return $cats;
    }
    
    /**
     * Intoarce categoriile din prima pagina sus
     */
    public function getFpt(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'Fpt' => 1));
        return $cats;
    }
    
    /**
     * Intoarce categoriile din prima pagina jos
     */
    public function getFpb(){
        $cats = $this->doctrine->em->getRepository('Entity:Category')->findBy(array('Status' => 1 , 'Fpb' => 1));
        return $cats;
    }
    
    /**
     * Intoarce o categorie dupa idul ei
     */
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
     * Intoarce articolele din categorie paginate
     */
    public function getPagesStories($Category , $offset = 0, $limit = 10){
        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from('Entity:Story', 'u')
            ->where('u.Category = :catid')
            ->setMaxResults($limit)
            ->setFirstResult($offset * $limit)
            ->orderBy('u.PubDate' , 'DESC')
            ->setParameter('catid', $Category);;

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );
        
        return $paginator;
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
   
   /**
     * Salveaza o categorie.
     */
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
        
        if(!isset($Data['PrMenu'])){
            $category->setPrMenu(0);
        }
        if(!isset($Data['ScMenu'])){
            $category->setScMenu(0);
        }
        
        if(!isset($Data['Status'])){
            $category->setStatus(0);
        }
        
        $this->doctrine->em->persist($category);
        $this->doctrine->em->flush();
        return $category;
    }
    
}