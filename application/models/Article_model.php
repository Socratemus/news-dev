<?php

use Doctrine\ORM\Tools\Pagination\Paginator;

class Article_model extends CI_Model {
    
    /**
     * Lureaza in principal cu entitatea : Story 
    **/

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll($offset = 0, $limit = 10){
        
        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from('Entity:Story', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset * $limit)
            ->orderBy('u.PubDate' , 'DESC');

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );
        
        return $paginator;
        
    }
    
    public function getById($id){
        
        $article = $this->doctrine->em->getRepository('Entity:Story')->findBy(array('StoryId' => $id ));
        if(isset($article[0])){
            return $article[0];
        } else {
            return new \models\Entities\Story();
        }
        
        
        exit();
    }
    
    public function getBySlug($Slug){
         $article = $this->doctrine->em->getRepository('Entity:Story')->findBy(array('Slug' => $Slug , 'Status' => 1));
        if(isset($article[0])){
            return $article[0];
        }
        throw new \Exception('Articolul nu a fost gasit');
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
        
        if(!isset($Data['Slug']) || empty($Data['Slug'])){
            $slug = Utils::slugify($Data['Title']);
            $article->setSlug($slug);
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
        
        if(!isset($Data['Status'])){
            $Article->setStatus(99);
        }
        
        if(!isset($Data['Slug']) || empty($Data['Slug'])){
            $slug = Utils::slugify($Data['Title']);
            $Article->setSlug($slug);
        }
        
        if(isset($Data['Tags']) && !empty($Data['Tags'])){
            $this->clearArticleTags($Article);
            $tagnames = $Data['Tags'];
            $tagnames = explode(',' , $tagnames);
            
            foreach($tagnames as $tagname){
               
                $tag = $this->getTag($tagname);
                if(!$tag){
                    $tag = new \models\Entities\Tag();
                    $tag->setTitle($tagname);
                    $tag->setSlug(Utils::slugify($tagname));
                }
                $Article->addTag($tag);
                $this->doctrine->em->persist($tag);
            }
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
    
    public function updateHits($Article){
        $currHits = $Article->getHits();
        $Article->setHits($currHits + 1);
        $this->doctrine->em->persist($Article);
        $this->doctrine->em->flush();
    }
    
    public function getTag($tagname){
        $ts = Utils::slugify($tagname);
        // var_dump($ts);
        // exit();
        $tag = $this->doctrine->em->getRepository('Entity:Tag')->findBy(array('Slug' => $ts));
        if(isset($tag[0])){
            return $tag[0];
        }
        return false;
    }
    
    public function clearArticleTags($Article){
        $tags = $Article->getTags();
        foreach($tags as $tag){
            $Article->getTags()->removeElement($tag);
            $tag->getStories()->removeElement($Article);
            $this->doctrine->em->persist($tag);
            //$this->doctrine->em->flush($tag);
        }
        
    }
    
}

