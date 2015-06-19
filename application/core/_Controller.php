<?php

class _Controller extends CI_Controller {
    
    public function __construct(){
        
        parent::__construct();
        
    }
    
    public function isPost(){
        $method = $this->input->server('REQUEST_METHOD');
        return $method == 'POST';
    }
    
    public function isGet(){
        $method = $this->input->server('REQUEST_METHOD');
        return $method == 'GET';
    }
    
}