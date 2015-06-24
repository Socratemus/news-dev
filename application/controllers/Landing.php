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
			
			//$menuCats = $this->categoryModel->getPrimaryMenuCategories();
		
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
			
			$slug = $this->uri->segment(2);
			$category = $this->category_model->getBySlug($slug);
			
			$this->layout->render(array('category' => $category));
			
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
			throw new \Exception('no entries');
			//Fetching news from that month
			echo $this->uri->segment(1); // year
			echo '<br/>';
			echo $this->uri->segment(2); // month
		}
		catch(\Exception $e)
		{
			$this->error($e);
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