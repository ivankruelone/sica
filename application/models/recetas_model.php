<?php
class Recetas_model extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');

    }
    
    function recetas()
    {
       	$this->db->select("r.*, date_format(r.fecha, '%Y%m%d') as fecha_folio, r.id as folioreceta, tipo_receta, s.servicio as servicio_nombre, p.apaterno, p.amaterno, p.nombre as nombre_paciente, p.clave, u.nombre as nombre_medico, rfc, receta_estatus, floor(DATEDIFF(now(), fecnac)/365) as edad, sexo, d.clave as clave_producto, cansur, q.programa as programa_text", false);
        $this->db->from('receta r');
        $this->db->join('tipo_receta t', 'r.tipo = t.id', 'LEFT');
        $this->db->join('servicios s', 'r.servicio = s.id', 'LEFT');
        $this->db->join('usuarios u', 'r.user_id = u.id', 'LEFT');
        $this->db->join('pacientes p', 'r.paciente_id = p.id', 'LEFT');
        $this->db->join('programas q', 'p.programa = q.id', 'LEFT');
        $this->db->join('receta_estatus e', 'r.estatus = e.id', 'LEFT');
        $this->db->join('receta_detalle d', 'r.id = d.receta_id', 'LEFT');
        $this->db->where('r.estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }
}