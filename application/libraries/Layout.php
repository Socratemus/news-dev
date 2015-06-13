<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    public $data = array();
    public $view = null;
    public $viewFolder = null;
    public $layoutsFodler = 'layouts';
    public $layout = 'default';
    
    public $css = array();
    var $obj;

    function __construct()
    {
        $this->obj =& get_instance();
    }

    function setLayout($layout)
    {
        $this->layout = $layout;
    }
    function setLayoutFolder($layoutFolder)
    {
        $this->layoutsFodler = $layoutFolder;
    }

    function render($Payload = array())
    {
        
        
        $controller = $this->obj->router->fetch_class();
        $method = $this->obj->router->fetch_method();
        $viewFolder = !($this->viewFolder) ? $controller.'.views' : $this->viewFolder . '.views';
        $view = !($this->view) ? $method : $this->view;
    
        
        $loadedData = array();
        $loadedData['view'] = $viewFolder.'/'.$view;
        $loadedData['data'] = $Payload;
        
        $loadedData['data']['meta'] = $this->getMeta();
        
        $layoutPath = '/'.$this->layoutsFodler.'/'.$this->layout;
        $this->obj->load->view($layoutPath, $loadedData);
    }
    
    //**************************************************************************
    public function getMeta(){
        if(isset($this->obj->config->config['meta'])){
            return $this->obj->config->config['meta'];
        }
        return array();
    }
    
}
?>