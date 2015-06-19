<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends _Controller {
    
    public function __construct(){
        parent::__construct();
        if(isset($_GET['token'])) return; //REMOVE HACK
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
	    try
		{
			$this->load->library('form_validation');
			$this->load->model('Category_model' , 'categoryModel');
			$this->form_validation->set_rules('Title', 'Title', 'required');
	    	$this->form_validation->set_rules('Slug', 'Slug', 'required');
			
			if($this->isPost()){
				if ($this->form_validation->run() == TRUE)
				{	
					//Este valid
					$category = $this->categoryModel->add($this->input->post());
					redirect('/admin/editCategory?id=' . $category->getCategoryId());
				}
				
			}
			
			$this->layout->setLayout('admin/admin_layout_test');
			$this->layout->render();
		}
		catch(\Exception $e)
		{
			$this->layout->setLayout('error/index');
			$this->layout->setViewFolder('errors');
			$this->layout->setView('404');
			$this->layout->render(array('message' => $e->getMessage()));
		}
	}
	
	/**
	 * Editeaza o categorie existenta
	 */
	public function editCategory(){
	    try
		{
			$this->load->library('form_validation');
			$this->load->model('Category_model' , 'categoryModel');
			$this->form_validation->set_rules('Title', 'Title', 'required');
	    	$this->form_validation->set_rules('Slug', 'Slug', 'required');
			
			$category = $this->categoryModel->getById($this->input->get('id'));
				
			if($this->isPost()){
				if ($this->form_validation->run() == TRUE)
				{	
				
					//Este valid
					$category = $this->categoryModel->save($this->input->post());
					//redirect('/admin/editCategory?id=' . $category->getCategoryId());
				}
				
			}
			
			$this->layout->setLayout('admin/admin_layout_test');
			$this->layout->render(array('category' => $category));
		}
		catch(\Exception $e)
		{
			$this->error($e);
		}
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
		try
		{
			$this->load->model('Article_model' ,'articleModel');
			$this->load->model('Category_model' ,'categoryModel');
			$this->load->model('Image_model' ,'imageModel');
			
			if($this->isPost()){
				//TODO VALIDARE FORMA
				$post = $this->input->post();
				
				$config = array(
					'upload_path' => "./public/data/original",
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => TRUE,
					'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					'max_height' => "768",
					'max_width' => "1024",
					'file_name' => strtoupper(md5( 'coverfile' .time()) )
				);
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('Cover'))
				{
					$data = array('upload_data' => $this->upload->data());
				}
				else
				{
					throw new \Exception('Nu s-a putut salva imaginea de cover');
					//$error = array('error' => $this->upload->display_errors());
				}
				
				$category = $this->categoryModel->getById($post['CategoryId']);
				
				$cover = $this->imageModel->add($data['upload_data']);
				
				$post['Cover'] = $cover;
				$post['Category'] = $category;
				
				$article = $this->articleModel->addArticle($post);
				
				redirect('/admin/editArticle?id=' . $article->getStoryId());
			}
			
			$categories = $this->categoryModel->getAll();
			
			$addons = array('jQuery-tagEditor-master', 'ckeditor', 'jQueryUI' , 'datetimepicker');
			$this->headscript->addAddons($addons);
			$this->headlink->addAddons($addons);
			
		    $this->layout->setLayout('admin/admin_layout_test');
			$this->layout->render(array('categories' => $categories));
		}
		catch(\Exception $e){
			$this->layout->setLayout('error/index');
			$this->layout->setViewFolder('errors');
			$this->layout->setView('404');
			$this->layout->render(array('message' => $e->getMessage()));
		}
		
	}
	
	/**
	 * Editeaza un articol
	 */
	public function editArticle(){
	    try
		{
			$this->load->library('form_validation');
			$this->load->model('Article_model' ,'articleModel');
			$this->load->model('Image_model' ,'imageModel');
			$this->load->model('Category_model' ,'categoryModel');
			
			$id = $this->input->get('id');
			$article = $this->articleModel->getById($id);
			
			$this->form_validation->set_rules('Title', 'Title', 'required');
	    	$this->form_validation->set_rules('Slug', 'Slug', 'required');
			
			
			
			if($this->isPost()){
				if ($this->form_validation->run() == true)
				{	
					$post = $this->input->post();
					$category = $this->categoryModel->getById($post['CategoryId']);
					$post['Category'] = $category;
					
					//save
					$this->articleModel->save($article , $post);
					redirect('/admin/editArticle?id=' . $id);
					//exit('not valid');
				}
				
				//Handle post request, validation...
			}
			$categories = $this->categoryModel->getAll();
			
			$addons = array('jQuery-tagEditor-master', 'ckeditor', 'jQueryUI' , 'datetimepicker');
			$this->headscript->addAddons($addons);
			$this->headlink->addAddons($addons);
			
		    $this->layout->setLayout('admin/admin_layout_test');
			$this->layout->render(array('article' => $article , 'categories' => $categories));
		}
		catch(\Exception $e){
			$this->layout->setLayout('error/index');
			$this->layout->setViewFolder('errors');
			$this->layout->setView('404');
			$this->layout->render(array('message' => $e->getMessage()));
		}
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
	 
	 /**
	  * Adauga un autor nou
	  */
	 public function addUser(){
	 	try
	 	{
	 		//Add user logic
	 		
	 		$this->layout->render();
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
	 }
	 
	 public function editUser(){
	 	try
	 	{
	 		
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
	 }
	 
	 public function removeUser(){
	 	try
	 	{
	 		
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
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
    private function error($Error){
    	$this->layout->setLayout('error/index');
		$this->layout->setViewFolder('errors');
		$this->layout->setView('error');
		$this->layout->render(array('message' => $Error->getMessage()));
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
	
	//Setting the first admin! Add security
    public function reset(){
        
        $data = array(
            'Firstname' => 'iancu',
            'Lastname' => 'cornel',
            'Username' => 'socratemus',
            'Email'    => 'corneliu.iancu27@gmail.com',
            'RealPassword' => 'Bucuresti91',
            'Access' =>3
        );
        
        $this->user_model->addUser($data);
        echo 'we have an admin!';
    }
	
}