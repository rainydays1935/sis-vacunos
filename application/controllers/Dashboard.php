<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('partials/header');
		$this->load->view('partials/sidebar');
		$this->load->view('dashboard');
		$this->load->view('partials/footer');
	}

	public function show(){
		echo "prueba";
	}
}
