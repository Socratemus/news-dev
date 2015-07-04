<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Comments")
 */
class Comment extends AbstractEntity{
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $CommentId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Name;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Email;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Website;
    
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
    
    private $User;
    
    /**
     * @ManyToOne(targetEntity="Story", inversedBy="Comments")
     * @JoinColumn(name="Story", referencedColumnName="StoryId")
     **/
    private $Story;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }
    
    /* Setters and getters */
    
    public function getName(){
        return $this->Name;
    }
    public function getEmail(){
        return $this->Email;
    }
    public function getWebsite(){
        return $this->Website;
    }
    public function getContent(){
        return $this->Content;
    }
    public function getCreated(){
        return $this->Created;
    }
    public function getUpdated(){
        return $this->Updated;
    }
    public function getStory(){
        return $this->Story;
    }
    
    public function setName($Name){
        $this->Name = $Name;
    }
    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function setWebsite($Website){
        $this->Website = $Website;
    }
    public function setContent($Content){
        $this->Content = $Content;
    }
    public function setCreated($Created){
        $this->Created = $Created;
    }
    public function setUpdated($Updated){
        $this->UpdatedCreated = $Updated;
    }
    public function setStory($Story){
        $this->Story = $Story;
    }
    
}