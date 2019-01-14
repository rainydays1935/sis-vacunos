<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Inventory extends CI_Controller {
        

        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->model('Products','products');
            $this->load->model('Observaciones_Model','observaciones');
          }
        
          public function common() {
  
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');

            
            $this->load->view('partials/footer');
          }

          public function index() {
            $this->common();  

            $data['observaciones'] = $this->observaciones->get_all();
            $data['status'] = false;
            $data['exist'] = false;
            $data['error'] = [];
            
            $this->load->view('products', $data);
          }

          public function upload_image($id) {
            $data['status'] = false;
            $data['exist'] = false;
            $data['error'] = [];


            $config['upload_path'] =        './uploads/';
            $config['allowed_types']        = 'jpg';
            $config['max_size']             = '';
            $config['max_width']            = '';
            $config['max_height']           = '';

            $new_name = time();
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            //Controlar imagen
            if ( ! $this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                
            }
            else {
                $date = date_create()->format('Y-m-d H:i:s');
                $this->db->set('id_product',$id);
                $this->db->set('url',$new_name);
                $this->db->set('fecha',$date);
                $this->db->insert('pictures');
                $data = array('upload_data' => $this->upload->data());
            }

          }

          public function test() {
            echo date('YYYY-MM-DD');
          }

          public function create(){

            //Validacion
            $this->common();  
            

            $data['observaciones'] = $this->observaciones->get_all();
            $data['status'] = false;
            $data['exist'] = false;
            $data['error'] = [];

            $this->form_validation->set_rules('arete', 'Nro Arete', 'required');
            $this->form_validation->set_rules('color', 'Color arete', 'required');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');
            $this->form_validation->set_rules('edad', 'Edad', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
            $this->form_validation->set_rules('myselect[]', 'Caracteristicas', 'required');


            if ($this->form_validation->run() == FALSE) {
                    $data['error'] = $this->form_validation->error_array();
                    $this->load->view('products',$data);
            }
            else {
                 //Recuperando productos y observaciones
                $result = $this->products->create_product();
                if($result){ $data['status'] = true; $this->upload_image($result); }
                else { $data['exist'] = true; }
                $this->load->view('products',$data);
                }
            }

          public function where() {
            $result = $this->products->get_where();
            echo json_encode($result);
          }
    }

?>