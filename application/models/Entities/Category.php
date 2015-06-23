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
     * @Column(type="boolean" , options={"comment":"Site primary Menu"}) @var string 
     */
    protected $PrMenu;
    
    /**
     * @Column(type="boolean" , options={"comment":"Site secondary"}) @var string 
     */
    protected $ScMenu;
    
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
        $this->PrMenu = 0;
        $this->ScMenu = 0;
        $this->Status = 99;
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
    
    public function getPrMenu(){
        return $this->PrMenu;
    }
    
    public function getScMenu(){
        return $this->ScMenu;
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
    
    public function setPrMenu($Menu){
        $this->PrMenu = $Menu;
    }
    
    public function setScMenu($Menu){
        $this->ScMenu = $Menu;
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