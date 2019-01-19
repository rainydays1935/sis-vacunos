<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Clients extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Clients_Model','clients');
          }
        
          public function index() {
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');
            $this->load->view('partials/footer');
            // $vacunos = $this->historial->get_vacunos();
            $this->load->view('clients');
          }

          public function clients() {
              $result = $this->clients->get_clients();
              echo json_encode($result);
          }

          public function save() {
            $result = $this->clients->create_client();
            echo json_encode($result);
          }

          public function update() {
            $result = $this->clients->update_client();
            echo json_encode($result);
          }

          public function delete() {
            $result = $this->clients->delete_client();
            echo json_encode($result);
          }

    }

?>