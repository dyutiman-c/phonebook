<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact');
        $this->load->library('pagination');
    }

    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $params = array();
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit_per_page = 10;
        $total_records = $this->contact->count_all();

        $q = $this->input->get('q');
        $s = $this->input->get('s');
        $e = $this->input->get('e');


        if ($total_records > 0) {
            // get current page records
            $params["result"] = $contacts = $this->contact->search($q, $s, $e, $offset, $limit_per_page);
            $config['base_url'] = base_url() . 'dashboard/index';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['reuse_query_string'] = TRUE;
            $this->pagination->initialize($config);
            $params['total'] = $total_records;
            $params["links"] = $this->pagination->create_links();
        }

        if($q || $s || $e) {
            $params['filter_cancel_link'] = true;
            $params['filter']['q'] = $q;
            $params['filter']['s'] = $s;
            $params['filter']['e'] = $e;
        }

        $this->load->view('dashboard', $params);
	}

	public function contact()
    {
        $contact_id = $this->input->post('cid');
        if ($contact_id) {
           $this->contact->update($this->input->post('name'), array(
               'name'   => $this->input->post('name'),
               'phone'   => $this->input->post('phone'),
               'note'   => $this->input->post('note'),
           ));
        } else {
           $this->contact->add(array(
              'name'   => $this->input->post('name'),
              'phone'   => $this->input->post('phone'),
              'note'   => $this->input->post('note'),
           ));
           redirect('/');
        }
        redirect('/');
    }

    public function cdel()
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->contact->delete($id);
        redirect('/');
    }
}
