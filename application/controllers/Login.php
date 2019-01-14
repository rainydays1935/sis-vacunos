<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('user');
  }

  public function index() {
    $this->load->helper('url');
    $this->load->view('partials/header');
    $this->load->view('login');
    $this->load->view('partials/footer');
  }

  public function validate_user() {
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      
      if ($this->form_validation->run() == FALSE) {
        if(isset($this->session->userdata['logged_in'])){
           $this->load->view('dashboard');
          }
          else {
            $this->load->view('login');
        }
      }
      else {
        $data = [
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        ];
  
        $result = $this->user->login($data);
        if(!isset($result['error'])) {
          $this->session->set_userdata('logged_in',$result);
          $this->load->helper('url');
          $this->load->view('partials/header');
          $this->load->view('partials/navbar');
          $this->load->view('partials/sidebar');
          $this->load->view('dashboard');
          $this->load->view('partials/footer');
        }
        else {
          $this->load->helper('url');
          $this->load->view('partials/header');
          $this->load->view('login', $result);
          $this->load->view('partials/footer');
        }
      }
  }
   
}
