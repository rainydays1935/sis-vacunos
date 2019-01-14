<?php 
class Clients_Model extends CI_Model {
    
    public function get_clients() {
        $result = $this->db->get('clients');
        return $result->result();
    }
    
    public function create_client() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'correo' => $this->input->post('correo'),
            'celular' => $this->input->post('celular')
        );
        $query = $this->db->insert('clients',$data);
        return $query;
    }

    public function update_client() {
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('correo');
        $celular = $this->input->post('celular');
        $id = $this->input->post('id');

        $this->db->set('nombre',$nombre);
        $this->db->set('correo',$correo);
        $this->db->set('celular',$celular);
        $this->db->where('id',$id);
        
        $result = $this->db->update('clients');
        return $result;
    }

    public function delete_client() {

        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $result = $this->db->delete('clients');
        return $result;
    }
}

?>