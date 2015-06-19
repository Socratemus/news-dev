<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Stories")
 */
class Story extends AbstractEntity {

    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $StoryId;

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
    protected $ShortDescription;

    /**
     * @Column(type="text") @var string 
     */
    protected $LongDescription;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $PubDate;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $Created;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;
    
    /**
     * @Column(type="boolean") @var string 
     */
    protected $Status;
    
    /**
     * @OneToOne(targetEntity="Image")
     * @JoinColumn(name="CoverId", referencedColumnName="ImageId" , onDelete="CASCADE")
     **/
    private $Cover;
    
    /**
     * @ManyToOne(targetEntity="Category", inversedBy="Stories")
     * @JoinColumn(name="CategoryId", referencedColumnName="CategoryId" , onDelete="CASCADE")
     **/
    private $Category;
    
    private $Comments;
    private $Tags;
    private $Author;

    public function __construct() {
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->PubDate = new \DateTime('now');
        $this->Status = 1;
        
    }

    /* Setters and getters */
    
    public function getStoryId() {
        return $this->StoryId;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getSlug() {
        return $this->Slug;
    }

    public function getShortDescription() {
        return $this->ShortDescription;
    }

    public function getLongDescription() {
        return $this->LongDescription;
    }

    public function getPubDate() {
        return $this->PubDate;
    }

    public function getCreated() {
        return $this->Created;
    }

    public function getUpdated() {
        return $this->Updated;
    }
    
    public function getStatus() {
        return $this->Status;
    }

    public function getComments() {
        return $this->Comments;
    }

    public function getTags() {
        return $this->Tags;
    }

    public function getAuthor() {
        return $this->Author;
    }

    public function getCover(){
        return $this->Cover;
    }
    
    public function getCategory(){
        return $this->Category;
    }

    public function setStoryId($StoryId) {
        $this->StoryId = $StoryId;
        return $this;
    }

    public function setTitle($Title) {
        $this->Title = $Title;
        return $this;
    }

    public function setSlug($Slug) {
        $this->Slug = $Slug;
        return $this;
    }

    public function setShortDescription($ShortDescription) {
        $this->ShortDescription = $ShortDescription;
        return $this;
    }

    public function setLongDescription($LongDescription) {
        $this->LongDescription = $LongDescription;
        return $this;
    }

    public function setPubDate($PubDate) {
        $this->PubDate = $PubDate;
        return $this;
    }

    public function setCreated($Created) {
        $this->Created = $Created;
        return $this;
    }

    public function setUpdated($Updated) {
        $this->Updated = $Updated;
        return $this;
    }
    
    public function setStatus($Status){
        $this->Status = $Status;
        return $this;
    }

    public function setComments($Comments) {
        $this->Comments = $Comments;
        return $this;
    }

    public function setTags($Tags) {
        $this->Tags = $Tags;
        return $this;
    }

    public function setAuthor($Author) {
        $this->Author = $Author;
        return $this;
    }
    
    public function setCover($Cover){
        $this->Cover = $Cover;
    }
    
    public function setCategory($Category){
        $this->Category = $Category;
    }
}
