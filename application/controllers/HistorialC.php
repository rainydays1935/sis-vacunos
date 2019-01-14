<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class HistorialC extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Historial','historial');
          }
        
          public function index() {
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');

            $this->load->view('historial');
          }

          public function get_vacuno() {
            $arete = ($this->input->post('arete'));
            $query = $this->db->get_where('products',array('arete' => $arete));
            $data  = $query->result_array();

            if($query->num_rows() != 0){
                //Recuento
                $id_product = $data[0]["id"];

                $tmp = $this->db->get_where('recuento',array('id_products' => $id_product));
                $dates  = $tmp->result_array();
                
                $tmp2 = $this->db->get_where('pictures',array('id_product' => $id_product));
                $images  = $tmp2->result_array();

                //Imagenes
                array_push($data, $dates, $images);

                echo json_encode($data);
            }
            else {
                $error = array(
                    'err' => true
                );
                echo json_encode($error);
            }
          }

    }

?>