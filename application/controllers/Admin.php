<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends _Controller {
   
   	protected $ItemsOnPage = 10;
    
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
	    try
		{
			$categories = $this->category_model->getAll();
			
			$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('categories' => $categories));
		}
		catch(\Exception $e)
		{
			$this->error($e);	
		}
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
			
			$this->layout->setLayout('admin/admin_layout');
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
			
			$this->layout->setLayout('admin/admin_layout');
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
	    try
		{
			$this->load->model('Article_model' ,'articleModel');
			$params = array();
			$articles = $this->articleModel->getAll(0 , 10);
			
			$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('articles' => $articles));
		}
		catch(\Exception $e)
		{
			$this->error($e);	
		}
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
			
		    $this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('categories' => $categories));
		}
		catch(\Exception $e){
			$this->error($e);
			// exit('sunt erori');
			// $this->layout->setLayout('error/index');
			// $this->layout->setViewFolder('errors');
			// $this->layout->setView('404');
			// $this->layout->render(array('message' => $e->getMessage()));
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
			$this->load->model('Tag_model' ,'tagModel');
			
			$id = $this->input->get('id');
			$article = $this->articleModel->getById($id);
			
			$this->form_validation->set_rules('Title', 'Title', 'required');
	    	// $this->form_validation->set_rules('Slug', 'Slug', 'required');
			
			if($this->isPost()){
				
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
				
				if ($this->form_validation->run() == true)
				{	
					$post = $this->input->post();
					//var_dump($post);exit();
					$category = $this->categoryModel->getById($post['CategoryId']);
					$post['Category'] = $category;
					
					if(isset($_FILES['Cover']['name']) && !empty($_FILES['Cover']['name'])){
						if($this->upload->do_upload('Cover'))
						{
							$data = array('upload_data' => $this->upload->data());
						}
						else
						{
							throw new \Exception('Nu s-a putut salva imaginea de cover');
						}
						
						$cover = $this->imageModel->add($data['upload_data']);
						$post['Cover'] = $cover;
					}
					//var_dump($post);exit();
					//save
					$this->articleModel->save($article , $post);
					redirect('/admin/editArticle?id=' . $id);
				}
			}
			$categories = $this->categoryModel->getAll();
			$tags = $this->tagModel->getAll();
			$addons = array('jQuery-tagEditor-master', 'ckeditor', 'jQueryUI' , 'datetimepicker');
			$this->headscript->addAddons($addons);
			$this->headlink->addAddons($addons);
			
		    $this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('article' => $article , 'categories' => $categories, 'tags' => $tags));
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
	 
	 public function slider(){
	 	try
	 	{
	 		
	 		$this->load->model('Slider_model' , 'sliderModel');
	 		$this->load->model('Image_model' , 'imageModel');
	 		
	 		$slides = $this->sliderModel->getAll();
	 		
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
				
				
				if(!isset($post['SlideId'])){
					//Add
					if($this->upload->do_upload('SliderPhoto'))
					{
						$data = array('upload_data' => $this->upload->data());
					}
					else
					{
						throw new \Exception('Nu s-a putut salva imaginea de cover');
						//$error = array('error' => $this->upload->display_errors());
					}
					
					$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 100 , 'height' => 50)));
					$post['Image'] = $image;
					
					$this->sliderModel->add($post);
					redirect('/admin/slider');
				}
				
				else 
				{
					//edit
					$slideId = $post['SlideId'];
					
					$slide = $this->sliderModel->getById($slideId);
					if(isset($_FILES['SliderPhoto']['name']) && !empty($_FILES['SliderPhoto']['name'])){
						//Sterge poza veche...
						if($this->upload->do_upload('SliderPhoto'))
						{
							$data = array('upload_data' => $this->upload->data());
						}
						else
						{
							throw new \Exception('Nu s-a putut salva imaginea de cover');
							//$error = array('error' => $this->upload->display_errors());
						}
						$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 300 , 'height' => 150)));
						$post['Image'] = $image;
					}
					
					$this->sliderModel->save($slide , $post);
					redirect('/admin/slider');
				}
				
	 		}
	 		
 			$addons = array('ckeditor');
			$this->headscript->addAddons($addons);
	 		$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('slides' => $slides));
	 	}
	 	catch(\Exception $e)
	 	{
	 		var_dump($e->getMessage());
	 		exit();
	 		$this->error($e);
	 	}
	 	
	 }
	 
	 /**
	  * Renders all cms pages.
	  */
	 public function cms(){
        try 
        {
        	//Lets do it by page.
        	$this->load->model('Cms_model' , 'cmsModel');
        	$page = $this->input->get('Page');
        	if(empty($page)){
        		$page = 1;
        	}
        	
        	$pages = $this->cmsModel->getPaged();
        	//var_dump($pages);
        	$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('pages' => $pages));
        }
        catch(\Exception $e)
        {
        	$this->error($e);
        }
	 }
	 
	 /**
	  * Adauga o pagina noua de cms
	  * About Us, Contact...
	  */
	 public function newCmsPage(){
	 	try
	 	{
	 		$this->load->library('form_validation');
	 		$this->load->model('Cms_model' , 'cmsModel');
	 		$this->form_validation->set_rules('Title', 'Title', 'required');
	    	$this->form_validation->set_rules('Slug', 'Slug', 'required');
	    	$this->form_validation->set_rules('Content', 'Content', 'required');
			
			if($this->isPost()){
				if ($this->form_validation->run() == true)
				{	
					$post = $this->input->post();
					$page = $this->cmsModel->add($post);
					redirect('/admin/editCmsPage?id=' . $page->getPageId());
				}
			}
	 		
	 		$addons = array('ckeditor');
			$this->headscript->addAddons($addons);
			// $this->headlink->addAddons($addons);
	 		$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array());	
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
	 }
	 
	 /**
	  * Editeaza o pagina existenta de cms
	  */
	 public function editCmsPage(){
		try
	 	{
 			$this->load->library('form_validation');
	 		$this->load->model('Cms_model' , 'cmsModel');
	 		$this->form_validation->set_rules('Title', 'Title', 'required');
	    	$this->form_validation->set_rules('Slug', 'Slug', 'required');
	    	$this->form_validation->set_rules('Content', 'Content', 'required');
	    	
	    	$page = $this->cmsModel->getById($this->input->get('id'));
	    	
	    	if($this->isPost()){
				if ($this->form_validation->run() == true)
				{	
					$this->cmsModel->save($page , $this->input->post());
					redirect('/admin/editCmsPage?id=' . $page->getPageId());
				}
			}
			
			$addons = array('ckeditor');
			$this->headscript->addAddons($addons);
			// $this->headlink->addAddons($addons);
	 		$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('page' => $page));
	    	
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
	 }
	 
	 /**
	  * Sterge o pagina de CMS
	  */
	 public function removeCmsPage(){
	     
	 }
	 
	 /**
	  * Adauga un autor nou
	  */
	 public function newUser(){
	 	try
	 	{
	 		$this->load->library('form_validation');
	 		//Add user logic
	 		
	 		if($this->isPost()){
	 			var_dump($this->input->post());
	 			$post = $this->input->post();
	 			$user = $this->user_model->add($post);
	 			redirect('admin/editUser?id=' . $user->getUserId());
	 		}
	 		
	 		$this->layout->setLayout('admin/admin_layout');
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
    	echo $Error->getMessage() . '<br/>';
    	exit('eroare');
    	
  //  	$this->layout->setLayout('error/index');
		// $this->layout->setViewFolder('errors');
		// $this->layout->setView('error');
		// $this->layout->render(array('message' => $Error->getMessage()));
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