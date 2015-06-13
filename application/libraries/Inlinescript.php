<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inlinescript
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
    
    public function __toString(){
        $script = '';
        foreach($this->_prepend as $js ){
            $script .= '<script type="text/javascript" src="'.$js.'"></script>
        ';    
        }
        foreach($this->_append as $js ){
            $script .= '<script type="text/javascript" src="'.$js.'"></script>
        ';    
        }
        return $script;
    }
}