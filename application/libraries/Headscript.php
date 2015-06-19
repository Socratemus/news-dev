<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Headscript
{
    protected $Files = array();
    
    private $_prepend = array();
    
    private $_append = array();
    
    var $obj;
    
    public function __construct(){
        $this->obj =& get_instance();
        $confCssFiles = $this->obj->config->config['js'];
        foreach($confCssFiles as $css){
            $this->appendFile($css);
        }
    }   
    
    public function reset(){
        $this->_append = array();
        $this->_prepend = array();
    }
    
    public function appendFile($File){
        array_push($this->_append , $File);
        return $this;
    }
    
    public function appendFiles($Files){
        foreach($Files as $file){
            $this->appendFile($file);
        }
        return $this;
    }
    
    public function appendScript($Script){
        throw new \Exception('Method not implemented yet.');
    }
    
    public function prependFile($File){
        array_push($this->_prepend , $File);
        return $this;
    }
    
    public function prependFiles($Files){
        foreach($Files as $file){
            $this->prependFile($file);
        }
    }
    
    public function addAddons($Addons){
        foreach($Addons as $add){
            if(!isset($this->obj->config->config['addons'][$add])){
                throw new \Exception($add . ' addon was not found.');
            } else {
                $addonFiles = $this->obj->config->config['addons'][$add]['js'];
                foreach($addonFiles as $js){
                    $this->appendFile($js);    
                }
            }
        }
    }
    
    public function __toString(){
        $script = '';
        foreach($this->_prepend as $js ){
            $script .= '<script type="text/javascript" src="'. base_url() . $js .'"></script>
        ';    
        }
        foreach($this->_append as $js ){
            $script .= '<script type="text/javascript" src="'. base_url() . $js .'"></script>
        ';    
        }
        return $script;
    }
}