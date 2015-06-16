<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Comments")
 */
class Comment {
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $CommentId;
    
    /**
     * @Column(type="string") @var string 
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
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }
    
    /* Setters and getters */
       
}