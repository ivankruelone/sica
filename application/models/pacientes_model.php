<?php
class Pacientes_model extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');

    }
    
    function catalogo($limit, $offset = 0){

        $this->db->select("p.*, floor(DATEDIFF(now(), fecnac)/365) as edad, s.programa as programa_text", FALSE);
        $this->db->from('pacientes p');
        $this->db->join('programas s', 'p.programa = s.id', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }
    
    function catalogo_rows(){
        
        $query = $this->db->get('pacientes');
        return $query->num_rows();
    }

    function autocomplete($term){
        $this->db->select('id, nombre, apaterno, amaterno');
        $this->db->or_like('nombre', $term);
        $this->db->or_like('apaterno', $term);
        $this->db->or_like('amaterno', $term);
        $this->db->or_like('clave', $term);
        
        $query = $this->db->get('pacientes');
        
        return $query->result();
    }

    function get_paciente($id){
        $this->db->where('id', $id);
        $query = $this->db->get('pacientes');
        return $query->row();
    }
    
    function get_paciente2($id)
    {
        $this->db->select("p.*, floor(DATEDIFF(now(), fecnac)/365) as edad, s.programa as programa_text", FALSE);
        $this->db->from('pacientes p');
        $this->db->join('programas s', 'p.programa = s.id', 'LEFT');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_anotaciones($id){
        $this->db->where('paciente_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(2);
        $query = $this->db->get('anotaciones');
        return $query->result();
    }

    function get_recetas($id){
        $this->db->select("r.*, date_format(r.fecha, '%Y%m%d') as fecha_folio, receta_estatus", FALSE);
        $this->db->from('receta r');
        $this->db->join('receta_estatus e', 'r.estatus = e.id', 'LEFT');
        $this->db->where('paciente_id', $id);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_recetas_todas($id){
        $this->db->select("r.*, date_format(r.fecha, '%Y%m%d') as fecha_folio, receta_estatus", FALSE);
        $this->db->from('receta r');
        $this->db->join('receta_estatus e', 'r.estatus = e.id', 'LEFT');
        $this->db->where('paciente_id', $id);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function insert_paciente()
    {
		$data = new stdClass();
        $data->clave = $this->input->post('clave');
        $data->apaterno = $this->input->post('apaterno');
        $data->amaterno = $this->input->post('amaterno');
        $data->nombre = $this->input->post('nombre');
        $data->fecnac = $this->input->post('fecnac');
        $data->sexo = $this->input->post('sexo');
        $data->programa = $this->input->post('programa');
        $data->user_id = $this->session->userdata('user_id');

        $this->db->set('fecalta', 'now()', false);
        $this->db->set('fecmodi', 'now()', false);
        
        //id, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp, contacto,
        //tel, email, alta, modificado, cliente_id, nombre
        
        $this->db->insert('pacientes', $data);
        
        return $this->db->insert_id();
    }
    
    function update_paciente()
    {
		$data = new stdClass();
        $data->clave = $this->input->post('clave');
        $data->apaterno = $this->input->post('apaterno');
        $data->amaterno = $this->input->post('amaterno');
        $data->nombre = $this->input->post('nombre');
        $data->fecnac = $this->input->post('fecnac');
        $data->sexo = $this->input->post('sexo');
        $data->programa = $this->input->post('programa');
        $data->user_id = $this->session->userdata('user_id');

        $this->db->set('fecmodi', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pacientes', $data);

        return $this->db->affected_rows();
    }

    function insert_anotacion()
    {
        $data->paciente_id = $this->input->post('paciente_id');
        $data->anotacion = $this->input->post('anotacion');

        $this->db->set('fecha', 'now()', false);
        $this->db->set('fecmodi', 'now()', false);
        
        //id, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp, contacto,
        //tel, email, alta, modificado, cliente_id, nombre
        
        $this->db->insert('anotaciones', $data);
        
        return $this->db->insert_id();
    }

    function get_detalle_captura_receta_temp($orden = 'id', $direccion ='DESC')
    {
        $this->db->select('r.*, descripcion');
        $this->db->from('receta_detalle_temp r');
        $this->db->join('productos p', 'r.producto_id = p.id', 'LEFT');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }

    function submit_captura_clave()
    {
        $clave = $this->input->post('clave');
        $piezas = $this->input->post('piezas');
        
            //id, producto_id, alta, canreq, user_id, posologia, clave
            
            $row = $this->producto_clave($clave);
            if(count($row) > 0)
            {
				$data = new stdClass();
                $data->producto_id = $row->id;
                $data->canreq = $piezas;
                $data->clave = $row->clave;
                $data->posologia = '';
                $data->user_id = $this->session->userdata('id');
                
                
                
                $this->db->set('alta', 'now()', false);
                
                $this->db->insert('receta_detalle_temp', $data);
                
                return $this->db->insert_id();
            
            }else{
                return 0;
            }

    }

    function producto_clave($clave){
        $this->db->select("id, ean, descripcion, unidad, clave");
        $this->db->where('clave', $clave);
        $query = $this->db->get('productos');
        return $query->row();
    }

    function borra_detalle($id)
    {
        $this->db->delete('receta_detalle_temp', array('id' => $id));
        return $this->db->affected_rows();
    }
    
    function guardar_receta()
    {
        $ciepri = $this->input->post('cieprimaria');
        $ciesec = $this->input->post('ciesecundaria');
        
        $ciepri = explode('-', $ciepri);
        $ciesec = explode('-', $ciesec);
		
		$data = new stdClass();
        
        if(count($ciepri == 2))
        {
            $data->cie_pri = trim($ciepri[0]);
            $data->pri = trim($ciepri[1]);
        }
        
        if(count($ciesec == 2))
        {
            $data->cie_sec = trim($ciesec[0]);
            $data->sec = trim($ciesec[1]);
        }
        
        //id, tipo, servicio, user_id, paciente_id, fecha, surtida, cie_pri, cie_sec, pri, sec, estatus
        
        $data->tipo = 1;
        $data->servicio = $this->session->userdata('servicio');
        $data->user_id = $this->session->userdata('id');
        $data->paciente_id = $this->input->post('paciente_id');
        $data->estatus = 0;
        $this->db->set('fecha', 'now()', false);
        
        $this->db->insert('receta', $data);
        
        $receta_id = $this->db->insert_id();
        
        if($receta_id > 0){
        
            $sql = "insert into receta_detalle (receta_id, producto_id, alta, canreq, user_id, posologia, clave) (select $receta_id, producto_id, now(), canreq, user_id, posologia, clave from receta_detalle_temp where user_id = ".$this->session->userdata('id').");";
            
            $this->db->query($sql);
            
            
            
            
            $detalle = $this->db->affected_rows();
            if($detalle > 0){
                $this->db->delete('receta_detalle_temp', array('user_id' => $this->session->userdata('id')));
                return $receta_id;
            }
        }
        
        
    }

}