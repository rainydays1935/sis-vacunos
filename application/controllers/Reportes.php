<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Reportes extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Products','products');
            }
        
            public function  commom() {
                $this->load->view('partials/header');
                $this->load->view('partials/navbar');
                $this->load->view('partials/sidebar');
                $this->load->view('partials/footer');
            }
            public function index(){}    
                
                
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
            
            public function getFaltantes() {
                //!revisar si es la consulta que desea
                /* $query = $this->db->query("select c.id, a.fecha, c.arete, c.color from recuento a inner join (select id_products, max(fecha) as mxdate from recuento group by id_products) b on a.id_products = b.id_products and a.fecha = b.mxdate right join products c on c.id=b.id_products where c.estado = 'E'"); */
                /* $query = $this->db->query("select c.id, c.arete, c.color,  a.fecha from recuento a inner join (select id_products, max(fecha) as mxdate from recuento group by id_products) b on a.id_products = b.id_products and a.fecha = b.mxdate  inner join products c on c.id = b.id_products where a.fecha <> '2020-11-07' order by a.fecha DESC"); */

                $query = $this->products->get_recuento_faltantes();
                echo json_encode($query);
            }

            public function get_fecha() {
                $fecha = $this->products->get_recuento_fecha();
                echo json_encode($fecha);
            }

            public function fecha() {
                $this->commom();
                $this->load->view('fecha');
                
            }
            
            public function get_vendidos() {
                $fecha = $this->products->get_vendidos_fecha();
                echo json_encode($fecha);
            }

            public function vendidos() {
                $this->commom();
                $this->load->view('vendidos');
                
            }

            public function vacunos() {
                $this->commom();
                $this->load->view('vacunos');
                
            }

            public function get_vacunos() {
                $result = $this->products->get_recuento();
                echo json_encode($result);
            }

             
            public function get_edades() {
                $fecha = $this->products->get_edades_vacunos();
                echo json_encode($fecha);
            }

            public function edad() {
                $this->commom();
                $this->load->view('edad');
                
            }


            private function array_flatten ($row, $data) {
                $tmp = '';
                $i = 0;
                foreach ($data as $ob){
                    $tmp .= $ob['descripcion']." /";
                }
                $array = json_decode(json_encode($row), True);
                $array += ['descripcion' => $tmp];
                return $array;

            }

            public function faltantes() {
                $this->commom();
                $this->load->view('faltantes');
            }



    
    }
?>