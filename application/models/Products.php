<?php

class Products extends CI_Model {
    
    public function create_product() {
        //comprobar si existe
      /*   $arete = $this->input->post('arete');
        $ql = $this->db->select('arete')->from('products')->where('arete',$arete)->get();

        if( $ql->num_rows() > 0 ) {
            return false;
        } else {
            //Insertar vacuno
          
        } */
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

        //Redireccionar
        $data['status']= true;
        return $last_id_product;
    }


    public function get_vacunos(){
        $result = $query = $this->db->query("select id, edad, arete, color, sexo, estado from products");
        $dat = $this->observaciones_query($query);
        return $dat;
    }
    
    public function get_recuento(){
        $this->db->select("id, edad, arete, color, sexo, estado from products WHERE estado='E'");
        $query=$this->db->get();
        $dat = $this->observaciones_query($query);
        return $dat;

    }
    
    public function get_recuento_fecha(){
        $fecha = $this->input->post('fecha');
        $query = $this->db->query("select distinct a.id, a.edad, a.arete, a.color, a.sexo, a.estado from products a inner join recuento b on a.id=b.id_products where b.fecha='".$fecha."'");
        $dat = $this->observaciones_query($query);
        return $dat;
    }
    public function get_recuento_faltantes(){
        $fecha = $this->input->post('fecha');
        $query = $this->db->query("select c.id, c.arete, c.color,  a.fecha from recuento a inner join (select id_products, max(fecha) as mxdate from recuento group by id_products) b on a.id_products = b.id_products and a.fecha = b.mxdate  right join products c on c.id = b.id_products where a.fecha <> '".$fecha."' order by a.fecha DESC;");
        $dat = $this->observaciones_query($query);
        return $dat;
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
        $array = json_decode(json_encode($row), True);
        $array += ['descripcion' => $tmp];
        return $array;

    }


    public function get_vendidos_fecha(){
        $fecha = $this->input->post('fecha');
        $result = $this->db->query(" select a.*, b.*, c.* from products a inner join ventas b on a.id=b.id_product inner join clients c on b.id_client=c.id where b.fecha = '".$fecha."'");
        return $result->result_array();
    }

    public function get_edades_vacunos(){
        $edad = $this->input->post('edad');
        if($edad == 'l'){
            $result = $this->db->query('select * from products where (select datediff (now(), edad)) <= 730');
            return $result->result_array();
        }
        if($edad == 'm'){
            $result = $this->db->query('select * from products where ((select datediff (now(), edad))  > 730 && ((select datediff (now(), edad)) <=1825))');
            return $result->result_array();
        }
        else {
            $result = $this->db->query('select * from products where (select datediff (now(), edad)) > 1825');
            return $result->result_array();
        }
    }

    public function get_where() {
        $selected = $this->input->post('selected');
        
        $this->db->select('products.id, products.edad, products.arete, products.color, products.sexo, products.estado');
        $this->db->from('products');
        $this->db->join('vacunos_observaciones','vacunos_observaciones.id_products=products.id');
        
        //Filtro de opciones
        $this->db->where_in('vacunos_observaciones.id_observaciones',$selected);
        $this->db->group_by('products.id');
        
        $query=$this->db->get();
        $dat = $this->observaciones_query($query);
        return $dat;

    }
}
