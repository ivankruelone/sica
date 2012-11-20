<?php
class Sucursales_model extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
    }
    
    function catalogo($limit, $offset = 0){
        
        if($this->juris > 0){
            $this->db->where('juris', $this->juris);
        }
        
        if($this->numsuc > 0){
            $this->db->where('numsuc', $this->numsuc);
        }
        
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get('sucursales');
        return $query->result();
    }
    
    function catalogo_rows(){
        
        if($this->juris > 0){
            $this->db->where('juris', $this->juris);
        }
        
        if($this->numsuc > 0){
            $this->db->where('numsuc', $this->numsuc);
        }
        
        
        $query = $this->db->get('sucursales');
        return $query->num_rows();
    }

    function autocomplete($term){
        $this->db->select('numsuc, sucursal, juris');
        $this->db->or_like('numsuc', $term);
        $this->db->or_like('sucursal', $term);
        
        if($this->juris > 0){
            $this->db->having('juris', $this->juris);
        }
        
        if($this->numsuc > 0){
            $this->db->having('numsuc', $this->numsuc);
        }
        
        $query = $this->db->get('sucursales');
        
        return $query->result();
    }

    function get_sucursal($id){
        $this->db->where('id', $id);
        $query = $this->db->get('sucursales');
        return $query->row();
    }
    
    function __get_estado($estado_int)
    {
        $this->db->where('estado_int', $estado_int);
        $query = $this->db->get('estados');
        
        $row = $query->row();
        
        return $row->estado;
    }
    
    function insert_sucursal()
    {
		$data = new stdClass();
        $data->cia = $this->input->post('cia');
        $data->juris = $this->input->post('juris');
        $data->numsuc = $this->input->post('numsuc');
        $data->sucursal = $this->input->post('sucursal');
        $data->calle = $this->input->post('calle');
        $data->exterior = $this->input->post('exterior');
        $data->interior = $this->input->post('interior');
        $data->colonia = $this->input->post('colonia');
        $data->referencia = $this->input->post('referencia');
        $data->municipio = $this->input->post('municipio');
        $data->estado_int = $this->input->post('estado_int');
        $data->estado = $this->__get_estado($this->input->post('estado_int'));
        $data->cp = $this->input->post('cp');
        $data->diaped = $this->input->post('diaped');
        $data->cad_min = $this->input->post('cad_min');

        $this->db->set('modificado', 'now()', false);
        $this->db->set('alta', 'now()', false);
        
        $this->db->insert('sucursales', $data);
        
        return $this->db->insert_id();
    }
    
    function update_sucursal()
    {
		$data = new stdClass();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
        $data->cia = $this->input->post('cia');
        $data->juris = $this->input->post('juris');
        $data->numsuc = $this->input->post('numsuc');
        $data->sucursal = $this->input->post('sucursal');
        $data->calle = $this->input->post('calle');
        $data->exterior = $this->input->post('exterior');
        $data->interior = $this->input->post('interior');
        $data->colonia = $this->input->post('colonia');
        $data->referencia = $this->input->post('referencia');
        $data->municipio = $this->input->post('municipio');
        $data->estado_int = $this->input->post('estado_int');
        $data->estado = $this->__get_estado($this->input->post('estado_int'));
        $data->cp = $this->input->post('cp');
        $data->diaped = $this->input->post('diaped');
        $data->cad_min = $this->input->post('cad_min');

        $this->db->set('modificado', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('sucursales', $data);


        return $this->db->affected_rows();
    }

}