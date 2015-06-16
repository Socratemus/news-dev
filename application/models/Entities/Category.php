<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Categories")
 */
class Category {
    
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
     * @Column(type="datetime") @var string 
     */
    protected $Created;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;
    
    private $Stories;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }
    
    /* Setters and getters */
    
}