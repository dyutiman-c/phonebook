<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	protected $authentication = false;

	public function index()
	{
        if($this->session->id) {
            redirect('/');
        }
		$this->load->view('login_form');
	}

    public function terminate()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

}
