<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Headtitle
{
    protected $Title = 'Top24h News';
    
    var $obj;
    
    public function __construct(){
        $this->obj =& get_instance();
    }
    
    public function setTitle($Title){
        $this->Title = $Title;
    }
    
    public function getTitle(){
        return $this->Title;
    }
    
    
    public function __toString(){
        
        return $this->Title;
    }
}