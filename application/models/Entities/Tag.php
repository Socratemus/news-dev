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
    
    protected $Title;
    
    protected $Slug;
    
    protected $Created;

    protected $Updated;
    
    private $Articles;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->Articles = new ArrayCollection();
    }

}