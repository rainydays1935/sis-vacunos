<?php

class Products extends CI_Model {
    
    public function create_product() {
        //comprobar si existe
        $arete = $this->input->post('arete');
        $ql = $this->db->select('arete')->from('products')->where('arete',$arete)->get();

        if( $ql->num_rows() > 0 ) {
            return false;
        } else {
            //Insertar vacuno
            $data = array(
                'arete' => $this->input->post('arete'),
                'color' => $this->input->post('color'),
                'sexo' => $this->input->post('sexo'),
                'edad' => $this->input->post('edad'),
                'descripcion' => $this->input->post('descripcion'),
                'estado' => 'E'
            );
            $this->db->insert('products', $data);
            $last_id_product = $this->db->insert_id();

            //Insertar tabla intermedia
            $observaciones = $this->input->post('myselect');
            foreach($observaciones as $i) {
                $this->db->set('id_products',$last_id_product);
                $this->db->set('id_observaciones',$i);
                $this->db->insert('vacunos_observaciones');
            }
        }

        //Redireccionar
        $data['status']= true;
        return $last_id_product;
    }


    public function get_vacunos(){
        $result = $this->db->get('products');
        return $result->result_array();
    }
    
    public function get_recuento(){
        $result = $this->db->where('estado','E');
        $result = $this->db->get('products');
        return $result->result_array();
    }

    public function get_where() {
        $selected = $this->input->post('selected');
        
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->join('vacunos_observaciones','vacunos_observaciones.id_products=products.id');
        
        //Filtro de opciones
        $this->db->where_in('vacunos_observaciones.id_observaciones',$selected);
        $this->db->group_by('products.id');
        
        $query=$this->db->get();
        $data= $query->result_array();

        return $data;
    }
}

?>