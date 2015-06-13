<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Headlink
{
    protected $Files = array();
    
    private $prepend = array();
    
    private $append = array();
    
    var $obj;
    
    public function __construct(){
        
        $this->obj =& get_instance();
        $confCssFiles = $this->obj->config->config['css'];
        foreach($confCssFiles as $css){
            $this->appendStyleSheet($css);
        }
        
    }
    
    public function appendStyleSheet($StyleSheet, $Position = false){
        array_push($this->append , $StyleSheet);
    }
    
    public function prependStyleSheet($StyleSheet , $Position = false){
         array_push($this->prepend , $StyleSheet);
    }
    
    public function __toString(){
        $cssLinks = '';
        foreach($this->prepend as $css) {
            $cssLinks .= '<link rel="stylesheet" type="text/css" href="'.$css.'">
        ';
        }
        
        foreach($this->append as $css) {
            $cssLinks .= '<link rel="stylesheet" type="text/css" href="'.$css.'">
        ';
        }
        
        return $cssLinks;
    }
    
}
?>