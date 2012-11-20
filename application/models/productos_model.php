<?php
class Productos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function registros(){
        return $this->db->count_all('productos');
    }
    
    function registros_estado($estado){
        
        $this->db->where('estado', $estado);
        $query = $this->db->get('productos_estados');
        return $query->num_rows();
        
    }

    function catalogo($limit, $offset = 0){
        $this->db->select('p.*, t.tipo_producto as tipo, s.subtipo_producto as subtipo');
        $this->db->from('productos p');
        $this->db->join('tipo_producto t', 'p.tipo_producto = t.id', 'LEFT');
        $this->db->join('subtipo_producto s', 'p.subtipo_producto = s.id', 'LEFT');
        $this->db->order_by('cast(clave as SIGNED)');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
    
    function catalogo_estado($estado, $limit, $offset = 0){
        $this->db->select('p.*, t.tipo_producto as tipo, s.subtipo_producto as subtipo');
        $this->db->from('productos p');
        $this->db->join('tipo_producto t', 'p.tipo_producto = t.id', 'LEFT');
        $this->db->join('subtipo_producto s', 'p.subtipo_producto = s.id', 'LEFT');
        $this->db->join('productos_estados e', 'p.clave = e.clave');
        $this->db->where('e.estado', $estado);
        $this->db->order_by('cast(p.clave as SIGNED)');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    function producto_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('productos');
        return $query->row();
    }

    function producto_clave($clave){
        $this->db->where('clave', $clave);
        $query = $this->db->get('productos');
        return $query->row();
    }

    function detalle($id){
        $this->db->select('p.*, t.tipo_producto as tipo, s.subtipo_producto as subtipo', FALSE);
        $this->db->from('productos p');
        $this->db->join('tipo_producto t', 'p.tipo_producto = t.id', 'LEFT');
        $this->db->join('subtipo_producto s', 'p.subtipo_producto = s.id', 'LEFT');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function autocomplete($term){
        $this->db->select('id, clave, SUBSTRING(descripcion, 1, 255) as descripcion, lc, activo', FALSE);
        $this->db->or_like('descripcion', $term);
        $this->db->or_like('clave', $term);
        $this->db->having('activo', 1);
        $query = $this->db->get('productos');
        
        return $query->result();
    }
    
    function autocomplete_estado($estado, $term){
        $this->db->select('p.id, p.clave, SUBSTRING(p.descripcion, 1, 255) as descripcion, p.lc, e.estado', FALSE);
        $this->db->from('productos p');
        $this->db->join('productos_estados e', 'p.clave = e.clave');
        $this->db->where("(p.clave like '%$term%' or p.descripcion like '%$term%') and e.estado = $estado and p.activo = 1", '', false);
        $this->db->limit(15);
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        

        return $query->result();
    }

    function empresa_drop(){
        $this->db->select('id, razon');
        $query = $this->db->get('cia');
        
        $a = array();
        
        $a[0] = 'Selecciona una opcion';
        
        foreach($query->result() as $row){
            $a[$row->id] = $row->razon;
        }
        
        return $a;
    }
    
    function tipo_producto_drop(){
        $query = $this->db->get('tipo_producto');
        
        $a = array();
        
        $a[0] = 'Selecciona una opcion';
        
        foreach($query->result() as $row){
            $a[$row->id] = $row->tipo_producto;
        }
        
        return $a;
    }

    function subtipo_producto_drop(){
        $query = $this->db->get('subtipo_producto');
        
        $a = array();
        
        $a[0] = 'Selecciona una opcion';
        
        foreach($query->result() as $row){
            $a[$row->id] = $row->subtipo_producto;
        }
        
        return $a;
    }

    function update_producto(){
		$data = new stdClass();
        //id, empresa, codigo, ean, descripcion, unidad, pactivo, pfarmacia, pdistribuidor, alta, modificado, iva
        $data->tipo_producto    = $this->input->post('tipo_producto');
        $data->subtipo_producto = $this->input->post('subtipo_producto');
        $data->clave            = $this->input->post('clave');
        $data->ean              = $this->input->post('ean');
        $data->descripcion      = $this->input->post('descripcion');
        $data->unidad           = $this->input->post('unidad');
        $data->iva              = $this->input->post('iva');
        $data->lc               = $this->input->post('lc');
        $data->min              = $this->input->post('min');
        $data->max              = $this->input->post('max');
        $data->preorden         = $this->input->post('preorden');
        $data->activo           = $this->input->post('activo');
        
        $this->db->set('modificado', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('productos', $data);
        
        if($this->db->affected_rows() > 0){
            
            $data2 = new stdClass();
            //id, area, clave, cant
            
            $data2->area = (int)($this->input->post('tipo_producto').$this->input->post('subtipo_producto'));
            
            $this->db->where('clave', $this->input->post('clave'));
            $this->db->where('area > 10');
            $this->db->update('inv_temp', $data2);
            
            return $this->input->post('id');
        }else{
            return 0;
        }
        
        
        
        
    }

    function insert_producto(){
        
        $clave = $this->input->post('clave');
        $clave = str_replace(array(' '), array(''), $clave);
        
        $this->db->where('clave', $clave);
        $q = $this->db->get('productos');
        
        if($q->num_rows() == 0){
			$data = new stdClass();
            ////id, tipo_producto, clave, ean, descripcion, unidad, precio_venta, precio_consigna, servicio, iva, lc, min, max, preorden, cuadro
            $data->tipo_producto    = $this->input->post('tipo_producto');
            $data->subtipo_producto = $this->input->post('subtipo_producto');
            $data->clave            = $clave;
            $data->ean              = $this->input->post('ean');
            $data->descripcion      = $this->input->post('descripcion');
            $data->unidad           = $this->input->post('unidad');
            $data->iva              = $this->input->post('iva');
            $data->lc               = $this->input->post('lc');
            $data->min              = $this->input->post('min');
            $data->max              = $this->input->post('max');
            $data->preorden         = $this->input->post('preorden');
    
            $this->db->set('modificado', 'now()', false);
            $this->db->set('alta', 'now()', false);
            
            $this->db->insert('productos', $data);
            
            $insert = $this->db->insert_id();
            
            $data2 = new stdClass();
            //id, area, clave, cant
            
            $data2->area = (int)($this->input->post('tipo_producto').$this->input->post('subtipo_producto'));
            $data2->clave = $clave;
            $data2->cant = 0;
            
            $this->db->insert('inv_temp', $data2);
            
            $this->comun->agregar_claves();
            
            return $insert;
        }else{
            return 0;
        }
    }
}