<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Categories")
 */
class Category extends AbstractEntity {
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $CategoryId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Title;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Slug;
    
    /**
     * @Column(type="boolean" , options={"comment":"Site Menu"}) @var string 
     */
    protected $Menu;
    
    /**
     * @Column(type="boolean" , options={"comment":"Front page top"}) @var string 
     */
    protected $Fpt;
    
    /**
     * @Column(type="boolean" , options={"comment":"Front page bottom"}) @var string 
     */
    protected $Fpb;
    
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
    
    /**
     * @OneToMany(targetEntity="Story", mappedBy="Category")
     **/
    private $Stories;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->Stories = new ArrayCollection();
        
        $this->Fpb = 0;
        $this->Fpt = 0;
        $this->Menu = 0;
        $this->Status = 91;
    }
    
    public function getCategoryId(){
        return $this->CategoryId;
    }
    
    public function getTitle(){
        return $this->Title;
    }
    
    public function getSlug(){
        return $this->Slug;
    }
    
    public function getMenu(){
        return $this->Menu;
    }
    
    public function getFpt(){
        return $this->Fpt;
    }
    
    public function getFpb(){
        return $this->Fpb;
    }
    
    public function getCreated(){
        return $this->Created;
    }
    
    public function getUpdated(){
        return $this->Updated;
    }
    
    public function getStatus(){
        return $this->Status;
    }
    
    public function getStories(){
        return $this->Stories;
    }
    
    public function setCategoryId($CategoryId){
        $this->CategoryId = $CategoryId;
    }
    
    public function setTitle($Title){
        $this->Title = $Title;
    }
    
    public function setSlug($Slug){
        $this->Slug = $Slug;
    }
    
    public function setMenu($Menu){
        $this->Menu = $Menu;
    }
    
    public function setFpt($Fpt){
        $this->Fpt = $Fpt;
    }
    
    public function setFpb($Fpb){
        $this->Fpb = $Fpb;
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
    
    public function setStories($Stories){
        $this->Stories = $Stories;
    }
    
    
}