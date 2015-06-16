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
    
    public function addUser($Input){
        
        $user = new models\Entities\User();
        
        $user->exchange($Input);
        
        $hash = \Utils::generateHash(30);
        
        $user->setHash($hash);
        
        $password = sha1($hash . $user->getRealPassword());
        $user->setPassword($password);
        
        $this->doctrine->em->persist($user);
        
        $this->doctrine->em->flush();
        
    }
    
}