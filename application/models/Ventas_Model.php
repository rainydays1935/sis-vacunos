<?php 
class Ventas_Model extends CI_Model {
    
    public function get_ventas() {
        $result = $this->db->get('ventas');
        return $result->result();
    }
    
    public function create_venta() {
        //Vacuno / Se recupera el id del vacuno
        $arete = $this->input->post('arete');
        $this->db->where('arete', $arete);
        $result = $this->db->get('products');

        if(!($result->num_rows()) > 0) return array('err' => 'No existe');
        
        $datos = $result->result();
        
        $id_vacuno = json_decode(json_encode($datos), true)[0]['id'];
        $estado = json_decode(json_encode($datos), true)[0]['estado'];

        if($estado == 'V') return array('err' => 'Vendido');

        //Actualizar estado
        $this->db->set('estado','V');
        $this->db->where('id',$id_vacuno);
        $this->db->update('products');
        
        
        //Ganadero
        $id_ganadero = $this->input->post('id_client');
        //Insertar venta
        $fecha = $this->input->post('fecha');
        $precio = $this->input->post('precio');

        $this->db->set('id_client', $id_ganadero);
        $this->db->set('id_product', $id_vacuno);
        $this->db->set('fecha', $fecha);
        $this->db->set('precio', $precio);

        $result = $this->db->insert('ventas');
        return $result;

    }

    public function update_venta() {
        $precio = $this->input->post('precio');
        $fecha = $this->input->post('fecha');
        $id = $this->input->post('id');

        $this->db->set('precio',$precio);
        $this->db->set('fecha',$fecha);
        $this->db->where('id',$id);

        $result = $this->db->update('ventas');
        return $result;

    }



}
?>