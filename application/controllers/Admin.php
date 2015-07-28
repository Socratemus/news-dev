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
	    $id = $this->input->get('id');
	    $em = $this->doctrine->em;
	    $cat = $em->getRepository('Entity:Category')->findOneBy(array('CategoryId' => $id));
	    $em->remove($cat);
	    $em->flush();
	    redirect('admin/categories');
	    echo $id;
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
			$this->load->model('Tag_model' ,'tagModel');
			
			$authors = $this->user_model->getAuthors();
			
			if($this->isPost()){
				//TODO VALIDARE FORMA
				$post = $this->input->post();
				
				$config = $this->getFileuploadConf();
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('Cover'))
				{
					$data = array('upload_data' => $this->upload->data());
				}
				else
				{
					throw new \Exception('Nu s-a putut salva imaginea de cover <br />' . $this->upload->display_errors()	);
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
			$tags = $this->tagModel->getAll();
			$addons = array('jQuery-tagEditor-master', 'ckeditor', 'jQueryUI' , 'datetimepicker');
			$this->headscript->addAddons($addons);
			$this->headlink->addAddons($addons);
			
		    $this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('categories' => $categories , 'authors' => $authors , 'tags' => $tags ));
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
			$authors = $this->user_model->getAuthors();
			
			$id = $this->input->get('id');
			$article = $this->articleModel->getById($id);
			
			$this->form_validation->set_rules('Title', 'Title', 'required');
			
			if($this->isPost()){
				
				$config = $this->getFileuploadConf();
				
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
			$this->layout->render(array('article' => $article , 'categories' => $categories, 'tags' => $tags , 'authors' => $authors));
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
	    $id = $this->input->get('id');
	    $article = $this->article_model->getById($id);
	    $em = $this->doctrine->em;
	    $em->remove($article);
		$em->flush();
	    redirect('admin/articles');
	    
	}
	
	
	public function motd(){
		try 
		{
			$this->load->helper('file');
			$motdFile = 'application/cache/motd.conf.json';
			if(file_exists($motdFile)){
        		$json = file_get_contents($motdFile);
        		$data = json_decode($json, true);
        		
        	} else {
        		$data = array(
        			date('Y-m-d') => array('My first message of the day.')
    			);
    			
    			$json = json_encode($data);
    			if ( ! write_file($motdFile, $json))
				{
				     echo 'Unable to write the file'; exit();
				}
        	}
        	
        	if(isset($data[date('Y-m-d')])){
        		$var = $data[date('Y-m-d')];
        	} else {
        		end($data); $key = key($data);
        		$var = $data[$key];
        	}
			
			if($this->isPost()){
				$motd = $this->input->post('motd');
				if($motd){
					$data[date('Y-m-d')] = array($motd);
					$json = json_encode($data);
					if ( ! write_file($motdFile, $json))
					{
					     echo 'Unable to write the file'; exit();
					}
				}
				redirect('admin/motd');
			}
			
			$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('current' => $var , 'all' => $data));
		}
		catch(\Exception $e){
			$this->error($e);
		}
	}
	/**
	 * Edit seo configuration.
	 */
	 public function seo(){
	    try 
        {
        	$this->load->helper('file');
        	
        	$seoFile =  'application/cache/seo.conf.json';
        	if(file_exists($seoFile)){
        		$json = file_get_contents($seoFile);
        		$data = json_decode($json, true);
        		
        	} else {
        		$data = array(
        			'title' => '',
        			'description' => '',
        			'keywords' => '',
        			'publisher' => '',
        			'news_keywords' => ''
    			);
    			
    			$json = json_encode($data);
    			
    			if ( ! write_file($seoFile, $json))
				{
				     echo 'Unable to write the file'; exit();
				}
				else
				{
				     //echo 'File written!';
				}
        	}
        	
        	if($this->isPost()){
        		$post = $this->input->post();
        		
        		if ( ! write_file($seoFile, json_encode($post)))
				{
				     echo 'Unable to write the file'; exit();
				}
				redirect('admin/seo');
        		
        	}
        	
        	$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('data' => $data));
        }
        catch(\Exception $e)
        {
        	echo $e->getMessage();
        }
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
					
					$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 300 , 'height' => 230)));
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
						$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 300 , 'height' => 230)));
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
	  * Listeaza utilizatorii
	  */
	 public function users(){
	 	try
	 	{
	 		$users = $this->user_model->getAll();
	 		
	 		$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('users' => $users));
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
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
	 			//var_dump($this->input->post());
	 			$post = $this->input->post();
	 			$config = $this->getFileuploadConf();
	 			$this->load->library('upload', $config);
	 			$this->load->model('image_model' , 'imageModel');
	 			if(isset($_FILES['Cover']['name']) && !empty($_FILES['Cover']['name'])){
					//Sterge poza veche...
					if($this->upload->do_upload('Cover'))
					{
						$data = array('upload_data' => $this->upload->data());
					}
					else
					{
						throw new \Exception('Nu s-a putut salva imaginea de cover');
						//$error = array('error' => $this->upload->display_errors());
					}
					$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 500 , 'height' => 500)));
					$post['Cover'] = $image;
				}
	 			
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
	 
	 /**
	  * Editeaza un utilizator
	  */
	 public function editUser(){
	 	try
	 	{
	 		$userId = $this->input->get('id');
	 		$user = $this->user_model->getById($userId);
	 		//var_dump($user);exit();
	 		
	 		if($this->isPost()){
	 			$post = $this->input->post();
	 			$config = $this->getFileuploadConf();
	 			$this->load->library('upload', $config);
	 			$this->load->model('image_model' , 'imageModel');
	 			if(isset($_FILES['Cover']['name']) && !empty($_FILES['Cover']['name'])){
					//Sterge poza veche...
					if($this->upload->do_upload('Cover'))
					{
						$data = array('upload_data' => $this->upload->data());
					}
					else
					{
						throw new \Exception('Nu s-a putut salva imaginea de cover');
						//$error = array('error' => $this->upload->display_errors());
					}
					$image = $this->imageModel->add($data['upload_data'] , array('medium' => array('width' => 500 , 'height' => 500)));
					$post['Cover'] = $image;
				}
	 			
	 			$this->user_model->save($user , $post);

	 		}
	 		
	 		$this->layout->setLayout('admin/admin_layout');
			$this->layout->render(array('user' => $user));
	 	}
	 	catch(\Exception $e)
	 	{
	 		$this->error($e);
	 	}
	 }
	 
	 /**
	  * Sterge un utilizator
	  */
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
    private function getFileuploadConf(){
    	$config = array(
			'upload_path' => "./public/data/original",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "20480000", // Can be set to particular file size , here it is 20 MB(2048 Kb)
			'max_height' => "3036",
			'max_width' => "4048",
			'file_name' => strtoupper(md5( 'imagefile' .time()) )
		);
		return $config;
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