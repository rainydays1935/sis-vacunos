<?php

class User extends CI_Model {
    public function login ($data) {
        
        $condition = "username='".$data['username']."' AND password='".$data['password']."'";

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);

        $query = $this->db->get();
        try {
            $ob = $query->row_array();
        } catch (Exception $err) {
            echo $err;
        }

        if($query->num_rows() == 1 ){
            return $query->row_array();
        }
        return [
            'error' => 'No se encontro el usuario'
        ];
    }

    public function register_user() {
        
    }

    public function update_user() {
        
    }
}

?>