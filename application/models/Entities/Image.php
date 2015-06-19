<?php

namespace models\Entities;

/**
 * @Entity 
 * @Table(name="Images")
 */
class Image extends AbstractEntity
{

    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $ImageId;

    /**
     * @Column(type="string") @var string 
     */
    protected $Thumb;

    /**
     * @Column(type="string") @var string 
     */
    protected $Medium;

    /**
     * @Column(type="string") @var string 
     */
    protected $Big;

    /**
     * @Column(type="string") @var string 
     */
    protected $Original;

    /**
     * @Column(type="text") @var string 
     */
    protected $Data;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $Created;

    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;

    public function __construct()
    {
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }

    public function getImageId()
    {
        return $this->ImageId;
    }

    public function getThumb()
    {
        return $this->Thumb;
    }

    public function getMedium()
    {
        return $this->Medium;
    }

    public function getBig()
    {
        return $this->Big;
    }

    public function getOriginal()
    {
        return $this->Original;
    }

    public function getData()
    {
        return $this->Data;
    }

    public function getCreated()
    {
        return $this->Created;
    }

    public function getUpdated()
    {
        return $this->Updated;
    }

    public function setImageId($ImageId)
    {
        $this->ImageId = $ImageId;
        return $this;
    }

    public function setThumb($Thumb)
    {
        $this->Thumb = $Thumb;
        return $this;
    }

    public function setMedium($Medium)
    {
        $this->Medium = $Medium;
        return $this;
    }

    public function setBig($Big)
    {
        $this->Big = $Big;
        return $this;
    }

    public function setOriginal($Original)
    {
        $this->Original = $Original;
        return $this;
    }

    public function setData($Data)
    {
        $this->Data = $Data;
        return $this;
    }

    public function setCreated($Created)
    {
        $this->Created = $Created;
        return $this;
    }

    public function setUpdated($Updated)
    {
        $this->Updated = $Updated;
        return $this;
    }

}
