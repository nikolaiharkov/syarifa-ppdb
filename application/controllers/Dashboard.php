<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

	public function index()
	{
		$this->load->view('layout/dash_header');
		$this->load->view('dashboard');
		$this->load->view('layout/dash_footer');
	}
}
