<?php
class Clientes_model extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');

    }
    
    function catalogo($limit, $offset = 0){
        
        if($this->zona > 0){
            $this->db->where('zona', $this->zona);
        }
        
        if($this->plaza > 0){
            $this->db->where('plaza', $this->plaza);
        }
        
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get('clientes');
        return $query->result();
    }
    
    function catalogo_rows(){
        
        if($this->zona > 0){
            $this->db->where('zona', $this->zona);
        }
        
        if($this->plaza > 0){
            $this->db->where('plaza', $this->plaza);
        }
        
        
        $query = $this->db->get('clientes');
        return $query->num_rows();
    }

    function autocomplete($term){
        $this->db->select('id, rfc, razon, zona, plaza');
        $this->db->or_like('rfc', $term);
        $this->db->or_like('razon', $term);
        
        if($this->zona > 0){
            $this->db->having('zona', $this->zona);
        }
        
        if($this->plaza > 0){
            $this->db->having('plaza', $this->plaza);
        }
        
        $query = $this->db->get('clientes');
        
        return $query->result();
    }

    function get_cliente($id){
        $this->db->where('id', $id);
        $query = $this->db->get('clientes');
        return $query->row();
    }
    
    function insert_cliente()
    {
		$data = new stdClass();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
        $data->clave = $this->input->post('clave');
        $data->rfc = $this->input->post('rfc');
        $data->razon = $this->input->post('razon');
        $data->calle = $this->input->post('calle');
        $data->exterior = $this->input->post('exterior');
        $data->interior = $this->input->post('interior');
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
        $data->zona = $this->input->post('zona');
        $data->plaza = $this->input->post('plaza');
        $data->condiciones = $this->input->post('condiciones');
        $data->limite = $this->input->post('limite');
        $data->precio = $this->input->post('precio');
        $data->descuento1 = $this->input->post('descuento1');
        $data->descuento2 = $this->input->post('descuento2');
        $data->iva = $this->input->post('iva');
        $data->cad_min = $this->input->post('cad_min');
        $data->exclu = $this->input->post('exclu');
        $data->prioridad = $this->input->post('prioridad');

        $this->db->set('modificado', 'now()', false);
        $this->db->set('alta', 'now()', false);
        
        //id, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp, contacto,
        //tel, email, alta, modificado, cliente_id, nombre
        
        $this->db->insert('clientes', $data);
        
        $id = $this->db->insert_id();
		
		$data2 = new stdClass();
        
        $data2->calle = $this->input->post('calle');
        $data2->exterior = $this->input->post('exterior');
        $data2->interior = $this->input->post('interior');
        $data2->colonia = $this->input->post('colonia');
        $data2->referencia = $this->input->post('referencia');
        $data2->municipio = $this->input->post('municipio');
        $data2->estado = $this->input->post('estado');
        $data2->pais = $this->input->post('pais');
        $data2->cp = $this->input->post('cp');
        $data2->contacto = $this->input->post('contacto');
        $data2->tel = $this->input->post('tel');
        $data2->email = $this->input->post('email');
        $data2->cliente_id = $id;
        
        $this->db->insert('consignar', $data2);
        
        return $this->db->affected_rows();
    }
    
    function update_cliente()
    {
		$data = new stdClass();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
        $data->clave = $this->input->post('clave');
        $data->rfc = $this->input->post('rfc');
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
        $data->zona = $this->input->post('zona');
        $data->plaza = $this->input->post('plaza');
        $data->condiciones = $this->input->post('condiciones');
        $data->limite = $this->input->post('limite');
        $data->precio = $this->input->post('precio');
        $data->descuento1 = $this->input->post('descuento1');
        $data->descuento2 = $this->input->post('descuento2');
        $data->iva = $this->input->post('iva');
        $data->cad_min = $this->input->post('cad_min');
        $data->exclu = $this->input->post('exclu');
        $data->prioridad = $this->input->post('prioridad');

        $this->db->set('modificado', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('clientes', $data);
		
		$data2 = new stdClass();
        $data2->calle = $this->input->post('calle');
        $data2->exterior = $this->input->post('exterior');
        $data2->interior = $this->input->post('interior');
        $data2->colonia = $this->input->post('colonia');
        $data2->referencia = $this->input->post('referencia');
        $data2->municipio = $this->input->post('municipio');
        $data2->estado = $this->input->post('estado');
        $data2->pais = $this->input->post('pais');
        $data2->cp = $this->input->post('cp');
        $data2->contacto = $this->input->post('contacto');
        $data2->tel = $this->input->post('tel');
        $data2->email = $this->input->post('email');

        $this->db->where('cliente_id', $this->input->post('id'));
        $this->db->where('nombre', 'DEFAULT');
        $this->db->update('consignar', $data);

        return $this->db->affected_rows();
    }

    function consignar($id){
        
        $this->db->where('cliente_id', $id);
        $query = $this->db->get('consignar');
        return $query->result();
    }

}