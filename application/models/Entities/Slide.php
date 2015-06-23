<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Slides")
 */
class Slide extends AbstractEntity {
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $SlideId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Title;

    /**
     * @Column(type="string") @var string 
     */
    protected $Url;
    
    /**
     * @Column(type="integer") @var string 
     */
    protected $ImageId;
    
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
    
    /**
     * @OneToOne(targetEntity="Image")
     * @JoinColumn(name="ImageId", referencedColumnName="ImageId" , onDelete="CASCADE")
     **/
    private $Image;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
        $this->Status = 1;
    }
    
    public function getSlideId(){
        return $this->SlideId;
    }
    
    public function getTitle(){
        return $this->Title;
    }
    
    public function getUrl(){
        return $this->Url;
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
    
    public function setImage($Image){
        $this->ImageId = $Image->getImageId();
        $this->Image = $Image;
    }
    
    public function setSlideId($PageId){
        $this->SlideId = $PageId;
    }
    public function setTitle($Title){
        $this->Title = $Title;
    }
    public function setUrl($Url){
        $this->Url = $Url;
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
    public function getImage(){
        return $this->Image;
    }
    
}