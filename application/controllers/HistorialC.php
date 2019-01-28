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
            $this->load->view('partials/footer');
            $this->load->view('historial');
          }

          public function update() {
              $arete = $this->input->post('id');
              $color = $this->input->post('color');
              $edad = $this->input->post('edad');


              $this->db->set('color',$color);
              $this->db->set('edad',$edad);
              $this->db->where('arete',$arete);
              
            $result = $this->db->update('products');
            echo json_encode($result);
          }

          private function observaciones_query($data){
            $resultado = [];
            
            foreach ($data->result() as $row)
            {
                $id = $row->id;
                $tmp = $this->db->query("select d.descripcion from observaciones d inner join vacunos_observaciones e on d.id=e.id_observaciones where e.id_products='".$id."'");
                $data = $tmp->result_array();
                $flatten = $this->array_flatten($row, $data);
                array_push($resultado, $flatten);
            }
            return $resultado;
        }
    
        private function array_flatten ($row, $data) {
            $tmp = '';
            $i = 0;
            foreach ($data as $ob){
                $tmp .= $ob['descripcion']." /";
            }
            $row[0] += ['descripcion' => $tmp];
            return $row;
    
        }


          public function get_vacuno() {
            $arete = ($this->input->post('arete'));
            $query = $this->db->query("select a.id, a.edad, a.arete, a.color, a.sexo, a.estado from products a where a.arete=".$arete);
            $data  = $query->result_array();
            if($query->num_rows() != 0){
                //Recuento
                $id_product = $data[0]["id"];

                $tmp = $this->db->get_where('recuento',array('id_products' => $id_product));
                $dates  = $tmp->result_array();
                
                $tmp2 = $this->db->get_where('pictures',array('id_product' => $id_product));
                $images  = $tmp2->result_array();

                $tmp3 = $this->db->query("select d.descripcion from observaciones d inner join vacunos_observaciones e on d.id=e.id_observaciones where e.id_products='".$id_product."'");
                $obs = $tmp3->result_array();

                $flatten = $this->array_flatten($data, $obs);

                //Imagenes
                array_push($flatten, $dates, $images);
                echo json_encode($flatten);
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