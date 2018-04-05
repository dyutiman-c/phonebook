<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function ___debug($var)
{
    echo '<pre>';
    print_r($var);
    exit;
}

abstract class MY_Controller extends CI_Controller {

    protected $authentication = true;

    public function __construct()
    {
        parent::__construct();
        $this->enforceSSL();
        if($this->authentication == true) {
            $this->authenticate();
        }
    }

    protected function authenticate()
    {
        $this->load->model('user');
        if($this->session->id) {
            //Load the user from DB, if available, or redirect to login page
            if(!$this->user->exists($this->session->id)) {
                $this->session->sess_destroy();
            }
        } else {
           $username = $this->input->post('username');
           $password = $this->input->post('password');
           if($username && $password) {
               $authentication_result = $this->user->authenticate($username, $password);
               if($authentication_result) {
                   $this->session->set_userdata($authentication_result);
                   redirect('/');
               } else {
                   $this->session->set_flashdata('auth_error', 'Access Denied');
               }
           }
           redirect('/login');
        }
    }

    protected function enforceSSL()
    {
        $this->config->config['base_url'] = str_replace('http://', 'https://', $this->config->config['base_url']);
        if ($_SERVER['SERVER_PORT'] != 443) redirect($this->uri->uri_string());
        return true;
    }

}
