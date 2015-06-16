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
			echo $this->uri->segment(2); //article slug
			echo 'pagina articolului';	
		}
		catch(\Exception $e)
		{
			//Render error page.
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
			//Render error page.
			//echo 'the page is broken';
			$this->layout->setLayout('error/index');
			$this->layout->setViewFolder('errors');
			$this->layout->setView('404');
			$this->layout->render(array('message' => $e->getMessage()));
		}
		
	}
    
}