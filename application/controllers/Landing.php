<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    
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
			
			//$menuCats = $this->categoryModel->getPrimaryMenuCategories();
		
			$addons = array('carouFredSel');
			$this->headscript->addAddons($addons);
			$this->layout->render(array());	
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
			$menupr = $this->categoryModel->getPrimaryMenuCategories();
			$menusc = $this->categoryModel->getSecondaryMenuCategories();
			
			$fpt  = $this->categoryModel->getFpt();
			$fpb = $this->categoryModel->getFpb();
			
			$article = $this->articleModel->getById(4);
			//var_dump($article);
			$this->layout->render(array(
				'article' =>$article ,
				'menupr' => $menuCats,
				'menusc' => $menuCats,
				'fpt' => $fpt , 
				'fpb' => $fpb
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
			echo $this->uri->segment(1);
			echo $this->uri->segment(2);
		}
		catch(\Exception $e)
		{
			//Render error page.
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