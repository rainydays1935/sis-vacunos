<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Observaciones extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Observaciones_Model','observaciones');
            }
            
            public function common() {
  
                $this->load->view('partials/header');
                $this->load->view('partials/navbar');
                $this->load->view('partials/sidebar');
            }

            public function index() {
                $this->common();  
                $this->load->view('observaciones');
            }

            public function create() {
                $result = $this->observaciones->create_ob();
                echo json_encode($result);
            }

            public function update() {
                $result = $this->observaciones->update_ob();
                echo json_encode($result);
            }

            public function observaciones() {
                $result = $this->observaciones->get_all();
                echo json_encode($result);
            }

    
    }
?>