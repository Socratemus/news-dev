<?php

use Doctrine\ORM\Tools\Pagination\Paginator;

class Cms_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll(){
       $pages = $this->doctrine->em->getRepository('Entity:Page')->findAll();
       return $pages;
    }
    
    public function getPaged( $offset = 0 ,  $limit = 10 ) {
        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from('Entity:Page', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );
       
        return $paginator;
    }
    
    public function getById($Id){
        $page = $this->doctrine->em->getRepository('Entity:Page')->findBy(array('PageId' => $Id));
        if(isset($page[0])){
            return $page[0];
        }
        throw new \Exception('This CMS page was not found.');
    }
    
    public function add($Data){
        
        $page = new \models\Entities\Page();
        $page->exchange($Data);
        $this->doctrine->em->persist($page);
        $this->doctrine->em->flush();
        return $page;
        
    }
    
    public function save($Page , $Data = false){
        $Page->exchange($Data);
        $this->doctrine->em->persist($Page);
        $this->doctrine->em->flush();
        return $Page;
    }
    
    public function remove($Id){
        
    }
    
    public function disable($Id){
        
    }
    
}