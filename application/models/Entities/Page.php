<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="CmsPages")
 */
class Page extends AbstractEntity {

    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $PageId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Title;

    /**
     * @Column(type="string") @var string 
     */
    protected $Slug;
    
    /**
     * @Column(type="text") @var string 
     */
    protected $Content;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Created;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;
    
    /**
     * @Column(type="integer") @var string 
     */
    protected $Status;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->Status = 1;
    }
    
    public function getPageId(){
        return $this->PageId;
    }
    
    public function getTitle(){
        return $this->Title;
    }
    
    public function getSlug(){
        return $this->Slug;
    }
    
    public function getContent(){
        return $this->Content;
    }
    
    public function getCreated(){
        return $this->Created;
    }
    
    public function getUpdate(){
        return $this->Updated;
    }
    
    public function getStatus(){
        return $this->Status;
    }
    
    public function setPageId($PageId){
        $this->PageId = $PageId;
    }
    public function setTitle($Title){
        $this->Title = $Title;
    }
    public function setSlug($Slug){
        $this->Slug = $Slug;
    }
    public function setContent($Content){
        $this->Content = $Content;
    }
    public function setCreated($Created){
        $this->Created = $Created;
    }
    public function setUpdated($Updated){
        $this->Updated = $Updated;
    }
    public function setStatus($Status){
        $this->Status = $Status;
    }
    
}