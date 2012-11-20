<?php
class Usuarios_model extends CI_Model {

    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
    }

    function catalogo($limit, $offset = 0){
        
        $this->db->select('u.*, n.nombre_nivel, e.estado as estado_c, jurisdiccion, sucursal');
        $this->db->from('usuarios u');
        $this->db->join('niveles n', 'u.nivel = n.nivel', 'LEFT');
        $this->db->join('estados e', 'u.estado = e.estado_int', 'LEFT');
        $this->db->join('juris j', 'u.juris = j.juris and u.estado = j.estado', 'LEFT');
        $this->db->join('sucursales s', 'u.numsuc = s.numsuc', 'LEFT');
        
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    function catalogo_rows(){
        
        $query = $this->db->get('usuarios');
        return $query->num_rows();
    }

}
