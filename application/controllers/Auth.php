<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    /**
     * Login controller constructor.
     */
    public function __construct(){

        parent::__construct();
        
        $this->load->library('form_validation');
        
        $identity = $this->user_model->getIdentity();
        
        // if($identity){
        // 	redirect('/admin');
        // }
        
        $this->resetAssets();
        $this->setLoginAssets();
        
    }

    /**
     * Renders the login page.
     */
    public function index(){

        $this->layout->setLayout('admin-login');
        
        $this->layout->render();
    }
    
    /**
     * Receive login post data and process
     */
    public function check(){
        
        $identity = $this->input->post('identity');
        
        $this->form_validation->set_rules('identity', 'Identity', 'callback_identity_check');
	    $this->form_validation->set_rules('credidential', 'Credidential', 'callback_validate_login['. $identity .']');
        
        if ($this->form_validation->run() == FALSE)
		{
		    $this->post = $this->input->post();
		    $this->layout->setLayout('admin-login');
            $this->layout->render();
		}
		else
		{
		    $this->user_model->setIdentity($identity);
		    redirect('/admin');
		}
    }
    
    /**
	 * Logout the current user.
	 */
	public function logout(){
		$this->session->unset_userdata('identity');
		redirect('/auth');
	}
    
    
    /**************************************************************************/
    private function resetAssets(){
        $this->headlink->reset();
        $this->headscript->reset();
        $this->inlinescript->reset();
    }
    private function setLoginAssets(){
        $this->headlink->prependStyleSheet('public/addons/bootstrap-3.3.4-dist/css/bootstrap.css')
            ->prependStyleSheet('public/addons/font-awesome-4.3.0/css/font-awesome.css')
            ->prependStyleSheet('public/css/general.css')
            ->prependStyleSheet('public/css/admin-login.css')
        ;
        $this->headscript->prependFile('public/addons/jquery/jquery-2.1.4.js')
            ->prependFile('public/addons/bootstrap-3.3.4-dist/js/bootstrap.js')
        ;
    }
    /**************************************************************************/
    /* Form validators */
    
    /**
     * Check if the user exists 
    **/
    public function identity_check($Identity){
        
        $bool = $this->user_model->fetchByUsername($Identity);
        
        if (!$bool)
		{
			$this->form_validation->set_message('identity_check', 'The %s provided does not exists.');
			return FALSE;
		}
		
		return TRUE;
    }
    
    /**
     * Validates password
    **/
    public function validate_login($Credidential , $Identity){
        
        $bool = $this->user_model->authenticate($Identity , $Credidential);
        
        if(!$bool){
            $this->form_validation->set_message('validate_login', 'The %s field failed to be validate.');
            return FALSE;    
        }
        
        return true;
        
    }
}