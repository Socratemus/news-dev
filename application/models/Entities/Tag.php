<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Tags")
 */
class Tag extends AbstractEntity
{
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $TagId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Title;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Slug;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Created;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;
    
    /**
     * @ManyToMany(targetEntity="Story", mappedBy="Tags")
     **/
    private $Stories;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->Stories = new ArrayCollection();
    }
    
    public function getTagId(){
        return $this->TagId;
    }
    public function getTitle(){
        return $this->Title;
    }
    public function getSlug(){
        return $this->Slug;
    }
    public function getCreated(){
        return $this->Created;
    }
    public function getUpdated(){
        return $this->Updated;
    }
    public function getStories(){
        return $this->Stories;
    }
    
    public function setTagId($TagId){
        $this->TagId = $TagId;
    }
    public function setTitle($Title){
        $this->Title = $Title;
    }
    public function setSlug($Slug){
        $this->Slug = $Slug;
    }
    public function setCreated($Created){
        $this->Created = $Created;
    }
    public function setUpdated($Updated){
        $this->Updated = $Updated;
    }
    public function setStories($Stories){
        $this->Stories = $Stories;
    }
    
    public function addStory($Story){
        $this->Stories->add($Story);
    }

}