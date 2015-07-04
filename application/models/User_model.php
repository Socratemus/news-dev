<?php

class User_model extends CI_Model {
    
    public $identity = null;

    function __construct()
    {
        parent::__construct();
    }
    
    public function getIdentity(){
        if($this->identity){
            return $this->identity;
        }
        $id = $this->session->userdata('identity');
        if(isset($id) && !empty($id)){
            $tmp = $this->doctrine->em->getRepository('Entity:User')->find($id);
            if($tmp){
                $this->identity = $tmp;
            }
        }
        
        //exit();
        return $this->identity;    
    }
    
    public function setIdentity($Username){
        $tmp = $this->fetchByUsername($Username);
        if(!isset($tmp[0]) || empty($tmp[0])){
            throw new \Exception('Couldn\'t find user.');
        }
        $identity = $tmp[0];
        $this->session->set_userdata('identity', $identity->getUserId());
    }
    
    public function fetchByUsername($Username){
       
       $repo = $this->doctrine->em->getRepository('Entity:User');
       
       $user = $repo->findBy(array('Username' => $Username));
       
       return $user; 
    }
    
    public function authenticate($Username , $Password){
        
        $user = $this->fetchByUsername($Username);
        if(!isset($user[0])){
            return false;
        }
        $user = $user[0];
        
        $crypted = sha1($user->getHash() . $Password);
        
        return $crypted == $user->getPassword();

    }
    
    public function add($Input){
        
        $user = new models\Entities\User();
        
        $user->exchange($Input);
        //var_dump($Input);exit();
        $hash = \Utils::generateHash(30);
        
        $user->setHash($hash);
        
        $password = sha1($hash . $user->getRealPassword());
        $user->setPassword($password);
        
        if(isset($Input['Cover'])){
            $user->setCover($Input['Cover']);
        }
        
        $this->doctrine->em->persist($user);
        
        $this->doctrine->em->flush();
        
        return $user;
        
    }
    
    public function save($User , $Data){
        
        if(isset($Data['Cover']) && !empty($Data['Cover'])){
            $User->setCover($Data['Cover']);
        }
        
        if(isset($Data['Username']) && !empty($Data['Username'])){
            $User->setUsername($Data['Username']);
        }
        
        if(isset($Data['Firstname']) && !empty($Data['Firstname'])){
            $User->setFirstname($Data['Firstname']);
        }
        
        if(isset($Data['Lastname']) && !empty($Data['Lastname'])){
            $User->setLastname($Data['Lastname']);
        }
        
        if(isset($Data['Quota']) && !empty($Data['Quota'])){
            $User->setQuota($Data['Quota']);
        }
        
        $this->doctrine->em->persist($User);
        
        $this->doctrine->em->flush();
        
        return $User;    
    }
    
    /**
     * Return all users
     */
    public function getAll(){
        return $this->doctrine->em->getRepository('Entity:User')->findBy(array('Access' => 2));
    }
    
    public function getById($Id){
        return $this->doctrine->em->getRepository('Entity:User')->find($Id);
    }
    
    /**
     * Returneaza autorii
     */
    public function getAuthors(){
        return $this->doctrine->em->getRepository('Entity:User')->findBy(array('Access' => 2));
    }
    
}