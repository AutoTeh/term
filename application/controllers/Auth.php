<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

 	public function __construct()
    {
    	parent::__construct();
    }

	public function index()
	{
		$data['Title'] = "Авторизация";
        $data['Page'] = 'auth';

				$this->form_validation->set_rules('login', 'Логин', 'required');
				$this->form_validation->set_rules('pass', 'Пароль', 'required');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$this->Account->auth();
                redirect('/', 'refresh');
	        }

		$this->load->view('main', $data);
	}

	public function exit_logged()
	{
 		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}

}
