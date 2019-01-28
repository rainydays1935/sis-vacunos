<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Busqueda extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Products','products');
            $this->load->model('Observaciones_Model','observaciones');
            }
        
            public function index() {
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');
            $this->load->view('partials/footer');
            
            $result = $this->observaciones->get_all();
            $array = json_decode(json_encode($result),true);
            $data['observaciones'] = $array;

            $this->load->view('busqueda', $data);
            }

            public function filter() {
                $result = $this->products->get_where();
                echo json_encode($result);
            }

            public function vacunos() {
                $result = $this->products->get_vacunos();
                
                echo json_encode($result);
            }

          

    
    }
?>