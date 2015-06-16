<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Stories")
 */
class Story {
    
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
    
    private $Comments;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }
    
    /* Setters and getters */
    
}