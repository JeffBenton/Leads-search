<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('lead');
	}

	public function index()
	{
		$this->load->view('leads');
	}

	public function update($page){
		$filters = $this->input->post();
		$data['leads'] = $this->lead->get_filtered($filters);
		$rows = count($data['leads']);
		$this->session->set_userdata('pages', ceil($rows/20));
		$data['leads'] = $this->lead->get_limited($filters, array(20*($page-1), 20));
		$this->load->view('partial_leads', $data);
	}
}

//end of main controller