<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    public $data = array();
    public $view = null;
    public $viewFolder = null;
    public $layoutsFodler = 'layouts';
    public $layout = 'default';
    private $vars = array();
    
    protected $meta = array();
    
    public $css = array();
    var $obj;

    function __construct()
    {
        $this->obj =& get_instance();
    }
    
    public function setView($View){
        $this->view = $View;
    }
    
    public function setViewFolder($Folder){
        $this->viewFolder = $Folder;
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
        
        $loadedData['data']  = array_merge($loadedData['data'] , $this->vars);
        
        $layoutPath = '/'.$this->layoutsFodler.'/'.$this->layout;
        
        $this->obj->load->view($layoutPath, $loadedData);
    }
    
    //**************************************************************************
    public function getMeta(){
        $ret = array();
        
        if(isset($this->obj->config->config['meta'])){
            foreach($this->obj->config->config['meta'] as $mt){
                array_push($ret , $mt);
            }

        }
        
        foreach($this->meta as $mt){
            array_push($ret , $mt);
        }
        
        return $ret;
    }
    
    public function addMeta($meta = array()){
        // if($type) {
        //     $meta = array('name' => $Key, 'content' => $Desc, 'type' => $type);    
        // } else {
        //     $meta = array('name' => $Key, 'content' => $Desc);
        // }
        array_push($this->meta , $meta);
    }
    
    public function addVariable($Key , $Value){
        $this->vars[$Key] = $Value;
    }
}
?>