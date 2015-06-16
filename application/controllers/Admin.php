<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $identity = $this->user_model->getIdentity();
        if(!$identity){
        	redirect('/auth');
        }
        $this->resetAssets();
        $this->setAdminAssets();
    }
    
	public function index()
	{
		
		$this->layout->setLayout('admin/admin_layout');
		$this->layout->render();
	}   
	
	/*******************************************************/
	/**********************ADMIN PAGES *********************/
	
	/**
	 * Lists the page of categories
	 */
	public function categories(){
	    
	}
	
	/**
	 * Adauga o categorie
	 */
	public function newCategory(){
	    
	}
	
	/**
	 * Editeaza o categorie existenta
	 */
	public function editCategory(){
	    
	}
	
	/**
	 * Sterge o categorie
	 */
	public function removeCategory(){
	    
	}
	
	/**
	 * Listing articole
	 */
	public function articles(){
	    
	}
	
	/**
	 * Adauga un articol
	 */
	public function newArticle(){
	    
	}
	
	/**
	 * Editeaza un articol
	 */
	public function editArticle(){
	    
	}
	
	/**
	 * Starge un articol
	 */
	public function removeArticle(){
	    
	}
	
	/**
	 * Edit seo configuration.
	 */
	 public function seo(){
	     
	 }
	 
	 /**
	  * Renders all cms pages.
	  */
	 public function cms(){
        
	 }
	 
	 /**
	  * Adauga o pagina noua de cms
	  * About Us, Contact...
	  */
	 public function addCmsPage(){
	     
	 }
	 
	 /**
	  * Editeaza o pagina existenta de cms
	  */
	 public function editCmsPage(){
	     
	 }
	 
	 /**
	  * Sterge o pagina de CMS
	  */
	 public function removeCmsPage(){
	     
	 }
	 
	/*******************************************************/
	
	/**************************************************************************/
    private function resetAssets(){
        $this->headlink->reset();
        $this->headscript->reset();
        $this->inlinescript->reset();
    }
    private function setAdminAssets(){
        $this->headlink->prependStyleSheet('public/addons/bootstrap-3.3.4-dist/css/bootstrap.css')
            ->prependStyleSheet('public/addons/font-awesome-4.3.0/css/font-awesome.css')
            ->prependStyleSheet('public/css/general.css')
            ->prependStyleSheet('public/css/admin.css')
        ;
        $this->headscript->prependFile('public/addons/jquery/jquery-2.1.4.js')
            ->prependFile('public/addons/bootstrap-3.3.4-dist/js/bootstrap.js')
            ->prependFile('public/js/admin.js')
        ;
    }
    /**************************************************************************/
	/**
	 * Resets the database
	 */
	public function resetDatabase(){
	    $get = $this->input->get();
	    
	    if(!isset($get['token']) || $get['token'] != 'cornelius'){
	        
	        exit('you are no allowed'); //render unauthorized!!
	    }
	    
	    $this->doctrine->generateDatabase();
	    
	}
	
}