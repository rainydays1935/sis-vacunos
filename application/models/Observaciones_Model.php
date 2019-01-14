<?php
class Observaciones_Model extends CI_Model {
    
    public function get_all() {
        $result = $this->db->get('observaciones');
        return $result->result_array();
    }
    
    public function create_ob() {
        $observacion = $this->input->post('descripcion');
        $this->db->set('descripcion',$observacion);
        $result = $this->db->insert('observaciones');
        return $result;
    }

    public function update_ob() {
        $observacion = $this->input->post('descripcion');
        $id = $this->input->post('id');
        $this->db->set('descripcion',$observacion);
        $this->db->where('id',$id);

        $result = $this->db->update('observaciones');
        return $result;
    }

}
?>