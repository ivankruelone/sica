<?php
class Proveedores_model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();

    }
    
    function catalogo($limit, $offset = 0){
        
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get('proveedores');
        return $query->result();
    }
    
    function catalogo_rows(){
        
        $query = $this->db->get('proveedores');
        return $query->num_rows();
    }

    function autocomplete($term){
        $this->db->select('id, rfc, razon');
        $this->db->or_like('rfc', $term);
        $this->db->or_like('razon', $term);
        
        $query = $this->db->get('proveedores');
        
        return $query->result();
    }

    function get_proveedor($id){
        $this->db->where('id', $id);
        $query = $this->db->get('proveedores');
        return $query->row();
    }
    
    function insert_proveedor()
    {
		$data = new stdClass();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
        $data->rfc = $this->input->post('rfc');
        $data->npro = $this->input->post('npro');
        $data->razon = $this->input->post('razon');
        $data->calle = $this->input->post('calle');
        $data->exterior = $this->input->post('exterior');
        $data->interior = $this->input->post('interior');
        $data->colonia = $this->input->post('colonia');
        $data->colonia = $this->input->post('colonia');
        $data->referencia = $this->input->post('referencia');
        $data->municipio = $this->input->post('municipio');
        $data->estado = $this->input->post('estado');
        $data->pais = $this->input->post('pais');
        $data->cp = $this->input->post('cp');
        $data->contacto = $this->input->post('contacto');
        $data->tel = $this->input->post('tel');
        $data->email = $this->input->post('email');
        //alta, modificado, zona, plaza, condiciones, limite, descuento1, descuento2, precio
        $data->condiciones = $this->input->post('condiciones');

        $this->db->set('modificado', 'now()', false);
        $this->db->set('alta', 'now()', false);
        
        $this->db->insert('proveedores', $data);
        return $this->db->insert_id();
    }
    
    function update_proveedor()
    {
		$data = new stdClass();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
        $data->rfc = $this->input->post('rfc');
        $data->npro = $this->input->post('npro');
        $data->razon = $this->input->post('razon');
        $data->calle = $this->input->post('calle');
        $data->exterior = $this->input->post('exterior');
        $data->interior = $this->input->post('interior');
        $data->colonia = $this->input->post('colonia');
        $data->colonia = $this->input->post('colonia');
        $data->referencia = $this->input->post('referencia');
        $data->municipio = $this->input->post('municipio');
        $data->estado = $this->input->post('estado');
        $data->pais = $this->input->post('pais');
        $data->cp = $this->input->post('cp');
        $data->contacto = $this->input->post('contacto');
        $data->tel = $this->input->post('tel');
        $data->email = $this->input->post('email');
        //alta, modificado, zona, plaza, condiciones, limite, descuento1, descuento2, precio
        $data->condiciones = $this->input->post('condiciones');
        $data->limite = $this->input->post('limite');

        $this->db->set('modificado', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('proveedores', $data);
        return $this->db->affected_rows();
    }

}