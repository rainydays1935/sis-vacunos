<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Recuento extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Products','products');
            }
        
            public function index() {
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');
            $this->load->view('recuento');
            }

            public function vacunos() {
                $result = $this->products->get_recuento();
                echo json_encode($result);
            }

            public function save() {
                $selected = $this->input->post('selected');
                $fecha = $this->input->post('fecha');
                // $date = $this->input->post('date');
                
                foreach($selected as $i) {
                    // $this->db->set('fecha',$date);
                    $this->db->set('id_products',$i);
                    $this->db->set('fecha',$fecha);
                    $result = $this->db->insert('recuento');
                }
                echo json_encode($result);
            }
    
    }
?>