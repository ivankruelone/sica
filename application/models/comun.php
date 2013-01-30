<?php
class Comun extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
    }
    
    
    function juris(){
        
        if($this->juris > 0)
        {
            $this->db->where('juris', $this->juris);
        }
        $query = $this->db->get('juris');

        return $query->result();
    }
    
    function cias_combo(){
        
        $this->db->select('cia_id, razon');
        $query = $this->db->get('cia');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->cia_id] = $row->razon;
        }
        
        return $a;
    }
    
    function suc_combo(){
        
        $this->db->select('numsuc, sucursal');
        $query = $this->db->get('sucursales');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->numsuc] = $row->numsuc." - ".$row->sucursal;
        }
        
        return $a;
    }

    function devo_suc_merma_combo(){
        
        $this->db->select('subtipo, movimiento');
        $this->db->or_where('subtipo', 401);
        $this->db->or_where('subtipo', 402);
        $query = $this->db->get('movimientos');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->subtipo] = $row->movimiento;
        }
        
        return $a;
    }

    function devo_alm_merma_combo(){
        
        $this->db->select('subtipo, movimiento');
        $this->db->or_where('subtipo', 102);
        $this->db->or_where('subtipo', 103);
        $this->db->or_where('subtipo', 104);
        $this->db->or_where('subtipo', 105);
        $query = $this->db->get('movimientos');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->subtipo] = $row->movimiento;
        }
        
        return $a;
    }

    function niveles_combo(){
        
        $query = $this->db->get('niveles');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->nivel] = $row->nombre_nivel;
        }
        
        return $a;
    }

    function estados_combo(){
        
        $this->db->select('e.estado_int, e.estado');
        $this->db->from('estados_activos a');
        $this->db->join('estados e', 'a.estado=e.estado_int', 'LEFT');
        $query = $this->db->get();
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->estado_int] = $row->estado;
        }
        
        return $a;
    }

    function estados_combo_todos(){
        
        $query = $this->db->get('estados');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->estado_int] = $row->estado;
        }
        
        return $a;
    }

    function juris_combo($id){
        
        $this->db->select('estado_int');
        $this->db->where('id', $id);
        $q2 = $this->db->get('sucursales');
        
        $r2 = $q2->row();
        
        $this->db->where('estado', $r2->estado_int);
        
        $query = $this->db->get('juris');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->juris] = $row->jurisdiccion;
        }
        
        return $a;
    }

    function dias_combo(){
        
        $query = $this->db->get('dias');
        
        $a = array();
        
        foreach($query->result() as $row){
            $a[$row->mysqldia] = $row->dia;
        }
        
        return $a;
    }
    
    function meses_combo(){
        
        $query = $this->db->get('meses');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->mes_int] = $row->mes;
        }
        
        return $a;
    }

    function productos_combo(){
        $this->db->select('clave, SUBSTRING(descripcion, 1, 25) as descripcion', false);
        $this->db->where('activo', 1);
        $query = $this->db->get('productos');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->clave] = $row->clave." - ".$row->descripcion;
        }
        
        return $a;
    }

    function programas_combo(){
        
        $query = $this->db->get('programas');
        
        $a = array();
        $a[0] = "Selecciona una opcion";
        
        foreach($query->result() as $row){
            $a[$row->id] = $row->programa;
        }
        
        return $a;
    }

    function sexo_combo(){
        
        $a = array();
        $a['0'] = "Selecciona una opcion";
        $a['M'] = "MASCULINO";
        $a['F'] = "FEMENINO";
        
        return $a;
    }

    function juris_act($estado){

        $this->db->where('estado', $estado);
        $query = $this->db->get('juris');
        return $query->result();
    }

    function condiciones(){
        $this->db->order_by('condicion');
        $query = $this->db->get('condiciones');
        
        $a = array();
        
        foreach($query->result() as $row){
            $a[$row->condicion] = $row->nombre_condicion;
        }
        
        return $a;
    }
    
    function precios(){
        $query = $this->db->get('precios');
        
        $a = array();
        
        foreach($query->result() as $row){
            $a[$row->precio] = $row->nombre_precio;
        }
        
        return $a;
    }

    function iva(){
        $query = $this->db->get('iva');
        
        $a = array();
        
        foreach($query->result() as $row){
            $a[$row->iva] = $row->iva_nombre;
        }
        
        return $a;
    }
    
    function exclusivos_drop(){
        $this->db->select('id, rfc, razon');
        $this->db->where('exclu', 1);
        $query = $this->db->get('clientes');
        
        $a = array();
        $a[0] = "Este producto no es exclusivo";

        foreach($query->result() as $row){
            $a[$row->id] = $row->rfc.' - '.$row->razon;
        }
        
        return $a;
    }
    
    function clientes_drop(){
        $this->db->select('id, rfc, razon');
        $query = $this->db->get('clientes');
        
        $a = array();
        $a[0] = "Selecciona un cliente";

        foreach($query->result() as $row){
            $a[$row->id] = $row->razon.' ('.$row->rfc.' )';
        }
        
        return $a;
    }

    function proveedores_drop(){
        $this->db->select('id, rfc, razon');
        $this->db->where_not_in('id', array('1'));
        $query = $this->db->get('proveedores');
        
        $a = array();
        $a[0] = "Selecciona un proveedor";

        foreach($query->result() as $row){
            $a[$row->id] = $row->razon.' ('.$row->rfc.' )';
        }
        
        return $a;
    }

    function anios_validos(){
        
        $anio = date('Y');
        $a = null;
        
        for($i = 1; $i <= 10; $i++)
        {
            $a.= $anio.'|';
            $anio = $anio + 1;
        }
        
        $a = substr($a, 0, -1); 
        
        return $a;
    }
    
    function combo_tipo_subtipo()
    {
        $sql = "SELECT t.id as tipo, t.tipo_producto, s.id as subtipo, s.subtipo_producto FROM productos p
left join tipo_producto t on p.tipo_producto = t.id
left join subtipo_producto s on p.subtipo_producto = s.id
group by t.id, s.id
order by t.id, s.id;";
        
        $query = $this->db->query($sql);
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->tipo."-".$row->subtipo] = $row->tipo_producto." - ".$row->subtipo_producto;
        }
        
        return $a;
    }
    
    function combo_preajuste_areas()
    {
        $sql = "SELECT concat(t.id, s.id) as area, concat(tipo_producto, ' ',subtipo_producto) as desc_area FROM tipo_producto t
cross join subtipo_producto s
UNION
select * from inv_temp_areas
order by cast(area as signed);";
        $query = $this->db->query($sql);
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->area] = $row->area." - ".$row->desc_area;
        }
        
        return $a;
    }
    
    function titulo_area($area)
    {
        $sql = "SELECT concat(t.id, s.id) as area, concat(tipo_producto, ' ',subtipo_producto) as desc_area FROM tipo_producto t
cross join subtipo_producto s
where concat(t.id, s.id) = ?
UNION
select * from inv_temp_areas
where id = ?
order by cast(area as signed)
";
        $query = $this->db->query($sql, array($area, $area));
        
        $row = $query->row();
        
        return " Area: ".$row->desc_area;
    }
    
    function tipo_servicio_web()
    {
        $a = array();
        $a[0] = "Selecciona una Opcion";
        $a[1] = "Retail";
        $a[2] = "SICA";
        return $a;
        
    }
    
    function si_no()
    {
        $a = array();
        $a[0] = "NO";
        $a[1] = "SI";
        
        return $a;
    }
    
    function agregar_claves()
    {
        $sql = "insert into inventario 
            (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id, user_id)
            (select id, 'SL', '0000-00-00', 0, now(), 1, 1, '".date('Ymd')."', 0, 0, 1 from productos where id not in(select p_id from inventario))";
            
        $this->db->query($sql);
            
        $sql2 = "insert into productos_estados 
            (SELECT ".ESTADO.", clave, 1, 0, 0, 0, 0, 0, 0 FROM productos p where clave not in(select clave from productos_estados where estado = ".ESTADO."));";
            
        $this->db->query($sql2);
    }
    
    function settings()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('config');
        $row = $query->row();
        
        return $row;
    }
    
    function semanas_buffer($perini, $perfin)
    {
        $sql = "SELECT CEIL(DATEDIFF('$perfin', '$perini')/7) as semanas_buffer;";
        $query = $this->db->query($sql);
        $row = $query->row();
        
        return $row->semanas_buffer;
    }
    
    function update_settins_pedidos($perini, $perfin, $semanas_buffer, $semanas_calculo, $porcentaje)
    {
        $this->db->where('id', 1);
        $a = array(
            'perini' => $perini,
            'perfin' => $perfin,
            'semanas_buffer' => $semanas_buffer,
            'semanas_calculo' => $semanas_calculo,
            'porcentaje' => ceil($porcentaje)
            );
            
        $this->db->update('config', $a);
    }

}