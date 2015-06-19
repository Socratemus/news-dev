<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    
	public function index()
	{
		
		
		$this->layout->render();
	}   
	
	
	/**
	 * Pagina articolului
	 */
	public function article(){
		try
		{
			$this->load->model('Article_model' ,'articleModel');
			$article = $this->articleModel->getById(2);
			//var_dump($article);
			$this->layout->render(array('article' =>$article));
		}
		catch(\Exception $e)
		{
			$this->error($e);
			// $this->layout->setLayout('error/index');
			// $this->layout->setViewFolder('errors');
			// $this->layout->setView('404');
			// $this->layout->render(array('message' => $e->getMessage()));
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