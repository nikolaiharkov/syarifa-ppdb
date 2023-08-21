<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/dash_header');
		$this->load->view('pendaftar/index');
		$this->load->view('layout/dash_footer');
	}
}
