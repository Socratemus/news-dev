<?php

class Article_model extends CI_Model {
    
    /**
     * Lureaza in principal cu entitatea : Story 
    **/

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getById($id){
        //echo $id;
        $article = $this->doctrine->em->getRepository('Entity:Story')->findBy(array('StoryId' => $id , 'Status' => 1));
        if(isset($article[0])){
            return $article[0];
        } else {
            return new \models\Entities\Story();
        }
        
        
        exit();
    }
    
    public function getArticlesByCategory($CategoryId){
        throw new \Exception('Method not implemented');
    }
    
    public function getArticlesByMonth($Month){
        throw new \Exception('Method not implemented');
    }
    
    public function getArticlesByTag($Tag){
        throw new \Exception('Method not implemented');
    }
    
    public function addArticle($Data){
        $Data['PubDate'] = new \DateTime($Data['PubDate']);
        $article = new \models\Entities\Story();
        $article->exchange($Data);
        if(isset($Data['Cover'])){
            $article->setCover($Data['Cover']);    
        }
        
        if(isset($Data['Category'])){
            $article->setCategory($Data['Category']);    
        }
        
        $this->doctrine->em->persist($article);
        $this->doctrine->em->flush();
        return $article;
    }
    
    public function save($Article , $Data = array()){
        
        $Article->exchange($Data);
        
        if(isset($Data['Cover'])){
            $Article->setCover($Data['Cover']);    
        }
        
        if(isset($Data['Category'])){
            $Article->setCategory($Data['Category']);    
        }
        
        if(isset($Data['PubDate'])){
            $Article->setPubDate( new \DateTime($Data['PubDate']));    
        }
        
        $this->doctrine->em->persist($Article);
        $this->doctrine->em->flush();
        return $Article;
        
    }
    
    public function removeArticle($Id){
        throw new \Exception('Method not implemented');
    }
    
    public function addTag($Tag){
    
    }
    
    public function addTags($Tags){
        
    }
    
    
    
}

