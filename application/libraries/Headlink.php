<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Headlink
{
    protected $Files = array();
    
    private $_prepend = array();
    
    private $_append = array();
    
    var $obj;
    
    public function __construct(){
        
        $this->obj =& get_instance();
        $confCssFiles = $this->obj->config->config['css'];
        foreach($confCssFiles as $css){
            $this->appendStyleSheet($css);
        }
        
    }
    
    public function reset(){
        $this->_append = array();
        $this->_prepend = array();
    }
    
    public function appendStyleSheet($StyleSheet, $Position = false){
        array_push($this->_append , $StyleSheet);
        return $this;
    }
    
    public function prependStyleSheet($StyleSheet , $Position = false){
         array_push($this->_prepend , $StyleSheet);
         return $this;
    }
    
    public function addAddons($Addons){
        foreach($Addons as $add){
            if(!isset($this->obj->config->config['addons'][$add])){
                throw new \Exception($add . ' addon was not found.');
            } else {
                $addonFiles = $this->obj->config->config['addons'][$add]['css'];
                foreach($addonFiles as $js){
                    $this->appendStyleSheet($js);    
                }
            }
        }
    }
    
    public function __toString(){
        $cssLinks = '';
        foreach($this->_prepend as $css) {
            $cssLinks .= '<link rel="stylesheet" type="text/css" href="'. base_url() .$css.'">
        ';
        }
        
        foreach($this->_append as $css) {
            $cssLinks .= '<link rel="stylesheet" type="text/css" href="'. base_url() .$css.'">
        ';
        }
        
        return $cssLinks;
    }
    
}
?>