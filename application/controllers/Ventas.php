<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Ventas extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Ventas_Model','ventas');
            $this->load->model('Clients_Model','clients');
          }
        
          public function index() {
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');
            $this->load->view('partials/footer');
            $result = $this->clients->get_clients();
            $array = json_decode(json_encode($result),true);
            $data['clients'] = $array;
            $this->load->view('ventas',$data);
          }

          public function ventas() {
              $result = $this->ventas->get_ventas();
              echo json_encode($result);
          }

          public function save() {
            $result = $this->ventas->create_venta();
            echo json_encode($result);
          }

          public function update() {
            $result = $this->ventas->update_venta();
            echo json_encode($result);
          }

          public function delete() {
            $result = $this->ventas->delete_venta();
            echo json_encode($result);
          }

    }

?>