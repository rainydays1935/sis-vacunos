<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class HistorialC extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Historial','historial');
          }

          public function common() {
  
            $this->load->view('partials/header');
            $this->load->view('partials/navbar');
            $this->load->view('partials/sidebar');
            $this->load->view('partials/footer');
        }

        
          public function index() {
            $this->common();  
            $this->load->view('historial');
          }

          public function update() {
            $arete = ($this->input->post('arete_edit'));
            $query = $this->db->query("select id from products where arete=".$arete);
            $data  = $query->result_array();
            if($query->num_rows() != 0){
                //Id producto
                $id_product = $data[0]["id"];

                $color = $this->input->post('color_edit');
                $edad = $this->input->post('edad_edit');
    
                $this->db->set('color',$color);
                $this->db->set('edad',$edad);
                $this->db->where('arete',$arete);
                //actualizar producto por arete
                $result = $this->db->update('products');
                if($result){
                    $this->upload_image($id_product);
                    $observaciones = $this->input->post('myselect');
                    
                    if($observaciones!=0){
                        //borrar anteriores
                        $this->db->where('id_products',$id_product);
                        $this->db->delete('vacunos_observaciones');

                        //Insertar tabla intermedia
                        $observaciones = $this->input->post('myselect');
                        foreach($observaciones as $i) {
                            $this->db->set('id_products',$id_product);
                            $this->db->set('id_observaciones',$i);
                            $this->db->insert('vacunos_observaciones');
                        }
                    }

                    redirect('historialC');
                }
                echo json_encode($result);
            }
           
          }

          //Modificar imagen
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

            $example = $this->input->post('userfile');
            //Controlar imagen
            if ( ! $this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                
            }
            else {
                $date = date_create()->format('Y-m-d H:i:s');
                //borrar actual
                $this->db->where('id_product',$id);
                $this->db->delete('pictures');

                //editar imagen
                $this->db->set('id_product',$id);
                $this->db->set('url',$new_name);
                $this->db->set('fecha',$date);
                $this->db->insert('pictures');
                $data = array('upload_data' => $this->upload->data());
            }

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
                
                $tmp4 = $this->db->query("select * from observaciones");
                $carac = $tmp4->result_array();


                $flatten = $this->array_flatten($data, $obs);

                //Imagenes
                array_push($flatten, $dates, $images, $carac);
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