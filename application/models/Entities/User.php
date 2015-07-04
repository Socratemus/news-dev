<?php

namespace models\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="Users")
 */
class User extends AbstractEntity {
    
    /**
     * @Id  @Column(type="integer")
     * @GeneratedValue
     */
    protected $UserId;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Firstname;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Lastname;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Username;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Password;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $RealPassword;
    
    /**
     * @Column(type="string") @var string 
     */
    protected $Hash;
    
    /**
     * @Column(type="integer") @var integer 
     */
    protected $Access = 0;
    
    /**
     * @Column(type="text") @var string 
     */
    protected $Quota;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Created;
    
    /**
     * @Column(type="datetime") @var string 
     */
    protected $Updated;
    
    /**
     * @OneToOne(targetEntity="Image")
     * @JoinColumn(name="CoverId", referencedColumnName="ImageId" , onDelete="CASCADE")
     **/
    private $Cover;
    
    //private $Comments;
    
    public function __construct(){
        $this->Created = new \DateTime('now');
        $this->Updated = new \DateTime('now');
    }
    
    /* Setters and getters */
    public function getUserId()
    {
        return $this->UserId;
    }

    public function getFirstname()
    {
        return $this->Firstname;
    }

    public function getLastname()
    {
        return $this->Lastname;
    }

    public function getUsername()
    {
        return $this->Username;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function getRealPassword()
    {
        return $this->RealPassword;
    }

    public function getHash()
    {
        return $this->Hash;
    }

    public function getAccess()
    {
        return $this->Access;
    }

    public function getCover(){
        return $this->Cover;
    }
    
    public function getQuota(){
        return $this->Quota;
    }
    
    public function getCreated()
    {
        return $this->Created;
    }

    public function getUpdated()
    {
        return $this->Updated;
    }

    public function getComments()
    {
        return $this->Comments;
    }

    public function setUserId($UserId)
    {
        $this->UserId = $UserId;
        return $this;
    }

    public function setFirstname($Firstname)
    {
        $this->Firstname = $Firstname;
        return $this;
    }

    public function setLastname($Lastname)
    {
        $this->Lastname = $Lastname;
        return $this;
    }

    public function setUsername($Username)
    {
        $this->Username = $Username;
        return $this;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }

    public function setRealPassword($RealPassword)
    {
        $this->RealPassword = $RealPassword;
        return $this;
    }

    public function setHash($Hash)
    {
        $this->Hash = $Hash;
        return $this;
    }

    public function setAccess($Access)
    {
        $this->Access = $Access;
        return $this;
    }

    public function setCover($Cover){
        $this->Cover = $Cover;
    }
    
    public function setQuota($Quota){
        $this->Quota = $Quota;
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

    public function setComments($Comments)
    {
        $this->Comments = $Comments;
        return $this;
    }
}