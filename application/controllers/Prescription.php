<?php

class Prescription extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}


	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('prescription/list');
		$this->load->view('partials/footer');
	}
}
