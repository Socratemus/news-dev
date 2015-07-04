<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    
    private $ItemsPerPage = 10;
    
    public function __construct(){
    	parent::__construct();
    	//loading slider model
    	$this->load->model('Slider_model' , 'sliderModel');
    }
    
	public function index()
	{
		try 
		{
			$this->load->model('Category_model' , 'categoryModel' );
			$this->load->model('Article_model' , 'articleModel' );
			$page = $this->input->get('page');
			if(!isset($page) || empty($page)){
				$page = 1;
			}
			
			$recents = $this->articleModel->getAll($page - 1 , $this->ItemsPerPage);
			$pagesCount = ceil($recents->count() / $this->ItemsPerPage);
			$addons = array('carouFredSel');
			$this->headscript->addAddons($addons);
			$this->layout->render(array('recents' => $recents , 'pages' => $pagesCount));	
		}
		catch(\Exception $e)
		{
			$this->error($e);
		}
			
	}   
	
	/**
	 * Pagina articolului
	 */
	public function article(){
		try
		{
			$this->load->model('Article_model' ,'articleModel');
			$this->load->model('Category_model' , 'categoryModel' );
			$slug = $this->uri->segment(2);
			$article = $this->articleModel->getBySlug($slug);
			$this->articleModel->updateHits($article);
			
			
			//var_dump($article);
			
			$addons = array('jqueryValidate');
			$this->headscript->addAddons($addons);
			
			/**
			 * Facebook meta tags
			 */
			$this->layout->addMeta(array('name' => 'og:image', 'content' => $article->getCover()->getMedium(), 'type' => 'property'));
			$this->layout->addMeta(array('name' => 'og:description', 'content' => $article->getTitle(), 'type' => 'property'));
			$this->layout->addMeta(array('name' => 'og:url', 'content' => site_url('/a/' . $article->getSlug()), 'type' => 'property'));
			$this->layout->addMeta(array('name' => 'og:title', 'content' => $article->getTitle(), 'type' => 'property'));
			$this->layout->addMeta(array('name' => 'og:type',  'content' => 'article', 'type' => 'property'));
			
			/**
			 * Twitter meta tags
			 */
		 	$this->layout->addMeta(array('name' => 'twitter:card', 'content' => 'summary'));
		 	$this->layout->addMeta(array('name' => 'twitter:title', 'content' => $article->getTitle()));
		 	$this->layout->addMeta(array('name' => 'twitter:image', 'content' => $article->getCover()->getMedium()));
			
			/**
			 * Google plus meta tags
			 */
			 
			
			
			$this->layout->render(array(
				'article' =>$article 
				)
			);
		}
		catch(\Exception $e)
		{
			$this->error($e);
		}
		
	}
	
	/**
	 * Afiseaza stirile dintro categorie
	 */
	public function category(){
		try
		{
			$page = $this->input->get('page');
			if(!isset($page) || empty($page)){
				$page = 1;
			}
			
			$slug = $this->uri->segment(2);
			$category = $this->category_model->getBySlug($slug);
			$articles = $this->category_model->getPagesStories($category , $page - 1 , $this->ItemsPerPage);
			$pagesCount = ceil($articles->count() / $this->ItemsPerPage);
			
			$this->layout->render(array('category' => $category , 'articles' => $articles , 'pages' => $pagesCount));
			
		}
		catch(\Exception $e)
		{
			$this->error($e);
		}
	}
	
	/**
	 * Displays news for a certain month
	 * url format /year/month
	 */
	public function month(){
		try
		{
			// echo $this->uri->segment(1); // year
			// echo '<br/>';
			// echo $this->uri->segment(2); // month
			$date = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/01';
			$date = new \DateTime($date);
			//var_dump($date);
			
			$articles = $this->article_model->getArticlesByMonth($date );
			
			$this->layout->render(array('date' => $date , 'articles' => $articles));
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();exit();
			$this->error($e);
		}
		
	}
	
	public function addComment(){
		try
		{
			$post = $this->input->post();
			
			$storyId = $post['StoryId'];
			$content = $post['Content'];
			$name = $post['Name'];
			$email = $post['Email'];
			$website = $post['Website'];
			
			$data = array(
				'Name' => $name,
				'Email' =>$email, 
				'Website' => $website == '' ? 'none' : $website,
				'Content' => $content
			);
			
			$story = $this->article_model->getById($post['StoryId']);
			$comm = new \models\Entities\Comment();
			$comm->exchange($data);
			$story->addComment($comm);
			
			$this->doctrine->em->persist($comm);
			$this->doctrine->em->flush();
			
			redirect('/a/' . $story->getSlug() . '#CommentForm');
			
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**************************************************************************/
	
	private function error($Error){
		// $this->layout->setLayout('error/index');
		$this->layout->setViewFolder('errors');
		$this->layout->setView('404');
		$this->layout->render(array('message' => $Error->getMessage()));
	}
    
}