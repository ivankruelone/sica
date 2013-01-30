<?php
class Pedidos_model extends CI_Model {

    var $juris = null;
    var $numsuc = null;
    var $nivel = null;
    var $user_id = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
        $this->nivel = $this->session->userdata('nivel');
        $this->user_id = $this->session->userdata('id');
    }
    
    function insert_pedido()
    {
        $a = explode('-', $this->input->post('sucursal'));
        $this->db->where('numsuc', trim($a[0]));
        $query = $this->db->get('sucursales');
        
        if($query->num_rows() > 0){
			
			$data = new stdClass();
			
            $row = $query->row();
            //id, fecha, user_id, cliente_id, alta
            $data->user_id = $this->session->userdata('id');
            $data->sucursal_id = trim($a[0]);
            $data->cad_min = $row->cad_min;
            $data->flag = $this->input->post('flag');
            
            $this->db->set('fecha', 'date(now())', false);
            $this->db->set('alta', 'now()', false);
            $this->db->insert('pedidos', $data);
            
            return $this->db->insert_id();
        }
    }
    
    function get_pedido($id)
    {
        $this->db->select('p.*, s.numsuc, s.sucursal, nombre, s.estado_int');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->where('p.id', $id);
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function get_pedido_automatico($id)
    {
        $this->db->select('p.*, s.numsuc, s.sucursal, nombre, s.estado_int');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->where('p.id', $id);
        
        $query = $this->db->get();
        
        return $query->row();
    }

    function cambiar_pedido_attr()
    {
        $valor = $this->input->post('valor');
        $columna = $this->input->post('columna');
        $id = $this->input->post('id');
        
        $this->db->set($columna, $valor);
        $this->db->where('id', $id);
        $this->db->update('pedidos');
        
        return $this->db->affected_rows();
        
    }

    function get_productos($id, $orden = 'd.id', $direccion ='DESC')
    {
        $this->db->select('d.*, l.lote, l.caducidad');
        $this->db->from('detalle d');
        $this->db->join('detalle_lotes l', 'd.id = l.d_id', 'LEFT');
        $this->db->where('p_id', $id);
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_productos_automatico($id, $orden = 'p.tipo_producto, p.id', $direccion ='ASC')
    {
        $this->db->select('d.*, p.descripcion');
        $this->db->from('pedidos_retail d');
        $this->db->join('productos p', 'clave_sica = p.clave');
        $this->db->where('c_id', $id);
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_productos2($id, $orden = 'd.id', $direccion ='DESC')
    {
        $this->db->select('d.*, l.lote, l.caducidad, s.subtipo_producto');
        $this->db->from('detalle d');
        $this->db->join('detalle_lotes l', 'd.id = l.d_id', 'LEFT');
        $this->db->join('productos p', 'd.producto_id = p.id', 'LEFT');
        $this->db->join('subtipo_producto s', 'p.subtipo_producto = s.id', 'LEFT');
        $this->db->where('p_id', $id);
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }

    function submit_captura_clave($p_id = null, $clave = null, $piezas = null)
    {
        //id, producto_id, lote, caducidad, alta, modificado, canreq, cansur, p_id,
        //precio, iva, descuento, porc, iva_t, descuento_t, subtotal, clave, descripcion, unidad
        if(isset($p_id)){
            $p_id = $p_id;
        }else{
            $p_id = $this->input->post('id');
        }
        
        if(isset($clave)){
            $clave = $clave;
        }else{
            $clave = $this->input->post('clave');
        }
        
        if(isset($piezas)){
            $piezas = $piezas;
        }else{
            $piezas = $this->input->post('piezas');
        }
        
        
        
        if($this->busca_clave_pedidos($p_id, $clave) == 0)
        {
            
            $row = $this->producto_clave($clave);
            if(count($row) > 0)
            {
				$data = new stdClass();
				
                $data->p_id = $p_id;
                $data->producto_id = $row->id;
                $data->canreq = $piezas;
                $data->clave = $row->clave;
                
                $data->descripcion = trim($row->descripcion);
                $data->unidad = trim($row->unidad);
                
                
                $this->db->set('alta', 'now()', false);
                $this->db->set('modificado', 'now()', false);
                
                $this->db->insert('detalle', $data);
                
                return $this->db->insert_id();
            
            }else{
                return 0;
            }

        }else{
            return 0;
        }
    }
    
    function busca_clave_pedidos($p_id, $clave)
    {
        $this->db->where('p_id', $p_id);
        $this->db->where('clave', $clave);
        $query = $this->db->get('detalle');
        return $query->num_rows();
    }

    function pedidos($estatus = null, $limit, $offset = 0)
    {
        $this->db->select('p.*, s.numsuc, sucursal, nombre, e.estatus as est, sum(d.canreq) as canreq, sum(d.cansur) as cansur');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        $this->db->join('detalle d', 'p.id = d.p_id', 'LEFT');
        
        if(isset($estatus)){
            $this->db->where('p.estatus', $estatus);
        }

        if($this->numsuc > 0){
            $this->db->where('s.numsuc', $this->numsuc);
        }

        if($estatus == 3){
            $this->db->order_by('p.f_embarque', 'desc');
        }
        
        $this->db->group_by('p.id');

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        return $query->result();
    }

    function pedidos_automaticos($estatus = null, $limit, $offset = 0)
    {
        $this->db->select('p.*, s.numsuc, s.sucursal, nombre, e.estatus as est, sum(d.cantidad) as cantidad, sum(d.adicional) as adicional');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        $this->db->join('pedidos_retail d', 'p.id = d.c_id', 'LEFT');
        
        if(isset($estatus)){
            $this->db->where('p.estatus', $estatus);
        }

        if($this->numsuc > 0){
            $this->db->where('s.numsuc', $this->numsuc);
        }

        if($estatus == 3){
            $this->db->order_by('p.f_embarque', 'desc');
        }
        
        $this->db->group_by('p.id');

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        return $query->result();
    }

    function pedidos_automaticos_hoy($estatus = null, $limit, $offset = 0)
    {
        $this->db->select('p.*, s.numsuc, s.sucursal, nombre, e.estatus as est, sum(d.cantidad) as cantidad, sum(d.adicional) as adicional');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        $this->db->join('pedidos_retail d', 'p.id = d.c_id', 'LEFT');
        if($estatus == 0){
            $this->db->where('p.fecha', date('Y-m-d'));
        }else{
            
        }
        $this->db->group_by('p.id');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function pedidos_rows($estatus = null)
    {
        $this->db->select('p.id');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        
        if(isset($estatus)){
            $this->db->where('p.estatus', $estatus);
        }
        

        if($this->numsuc > 0){
            $this->db->where('s.numsuc', $this->numsuc);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function pedidos_automaticos_rows($estatus = null)
    {
        $this->db->select('p.id');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        
        if(isset($estatus)){
            $this->db->where('p.estatus', $estatus);
        }
        

        if($this->numsuc > 0){
            $this->db->where('s.numsuc', $this->numsuc);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function pedidos_automaticos_rows_hoy($estatus = null)
    {
        $this->db->select('p.id');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        
        if($estatus == 0){
            $this->db->where('p.fecha', date('Y-m-d'));
        }else{
            
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function busqueda_sucursal($sucursal)
    {
        $this->db->select('p.*, s.numsuc, sucursal, nombre, e.estatus as est, sum(d.canreq) as canreq, sum(d.cansur) as cansur');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        $this->db->join('detalle d', 'p.id = d.p_id', 'LEFT');
        $this->db->where('p.sucursal_id', $sucursal);
        $this->db->group_by('p.id');
        $query = $this->db->get();
        
        return $query->result();
    }

    function busqueda_pedido($pedido)
    {
        $this->db->select('p.*, s.numsuc, sucursal, nombre, e.estatus as est, sum(d.canreq) as canreq, sum(d.cansur) as cansur');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('usuarios u', 'p.user_id = u.id', 'LEFT');
        $this->db->join('estatus_pedido e', 'p.estatus = e.id', 'LEFT');
        $this->db->join('detalle d', 'p.id = d.p_id', 'LEFT');
        $this->db->where('p.id', $pedido);
        $this->db->group_by('p.id');
        $query = $this->db->get();
        
        return $query->result();
    }

    function producto_id($id){
        $this->db->select("id, ean, descripcion, unidad, clave");
        $this->db->where('id', $id);
        $query = $this->db->get('productos');
        return $query->row();
    }
    
    function producto_clave($clave){
        $this->db->select("id, ean, descripcion, unidad, clave");
        $this->db->where('clave', $clave);
        $this->db->where('activo', 1);
        $query = $this->db->get('productos');
        return $query->row();
    }

    function cerrar_captura($id)
    {
        $data = array(
                'estatus' => 1
                );
        $this->db->set('f_captura', 'now()', false);
        $this->db->where('id', $id);
        $this->db->update('pedidos', $data);
        
        return $this->db->affected_rows();
    }
    
    function borra_detalle($id)
    {
        $this->db->delete('detalle', array('id' => $id));
        return $this->db->affected_rows();
    }
    
    
    function autocomplete($id, $estado_int, $term)
    {
        $this->db->select('d.id, d.clave, d.descripcion, d.p_id, d.canreq, d.cansur, lc');
        $this->db->from('detalle d');
        $this->db->join('productos p', 'd.producto_id = p.id');
        $this->db->or_like('d.clave', $term);
        $this->db->or_like('d.descripcion', $term);
        $this->db->having('d.p_id', $id);
        $this->db->having('cast((d.canreq - d.cansur) as signed) > 0', '', false);
        $query = $this->db->get();
        

        return $query->result();
    }
    
    function busca_personal($term)
    {
        $this->db->select('num_emp, nombre, activo');
        $this->db->or_like('nombre', $term);
        $this->db->or_like('num_emp', $term);
        $this->db->having('activo', 1);
        $query = $this->db->get('personal');

        return $query->result();
    }

    function submit_captura_cansur_clave()
    {
        $lc = $this->input->post('lc');
        if($lc == 0)
        {
            $lote = 'SL';
            $caducidad = '0000-00-00';
        }else{
            $lote = $this->input->post('lote');
            $caducidad = $this->input->post('caducidad');
        }
        //id, d_id, cansur, lote, caducidad, producto_id, cerrada
        if($this->valida_pedido_detalle($this->input->post('clave'), $this->input->post('id')) > 0)
        {
            $cansur = $this->input->post('cansur');
            
            if($cansur <= $this->valida_cantidad($this->input->post('clave')))
            {
                $this->db->where('d_id', $this->input->post('clave'));
                $this->db->where('lote', $lote);
                $q = $this->db->get('detalle_lotes');
                if($q->num_rows() == 0)
                {
					$data = new stdClass();
					
                    $data->d_id = $this->input->post('clave');
                    $data->cansur = $cansur;
                    $data->lote = $lote;
                    $data->caducidad = $caducidad;
                    $data->producto_id = $this->get_producto_id($this->input->post('clave'));
                    
                    $this->db->insert('detalle_lotes', $data);
                    
                    $afecta = $this->db->insert_id();
                    
                    if($afecta > 0)
                    {
                        $act->cansur = $this->calcula_cansur($this->input->post('clave'));
                        $this->db->set('modificado', 'now()', false);
                        $this->db->where('id', $this->input->post('clave'));
                        $this->db->update('detalle', $act);
                        echo '<p class="message success">Guardado Correctamente</p>';
                    }else{
                        echo '<p class="message error">No se pudo agregar ese registro a la base de datos.</p>';
                    }
                }else{
                    echo '<p class="message error">El lote que capturaste ya existe.</p>';
                }
            }else{
                echo '<p class="message error">La Cantidad que estas intoduciendo es mayor a la que falta por surtir.</p>';            }
        }else{
            echo '<p class="message error">Esta clave no corresponde a este pedido.</p>';
        }
    }
    
    private function valida_pedido_detalle($id, $p_id)
    {
        $this->db->where('id', $id);
        $this->db->where('p_id', $p_id);
        $query = $this->db->get('detalle');
        
        return $query->num_rows();
    }
    
    function detalle_captura_cambio()
    {
        $this->db->set($this->input->post('columna'), $this->input->post('valor'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('detalle');
        
        $this->db->where('id', $this->input->post('id'));
        $q1 = $this->db->get('detalle');
        $row1 = $q1->row();

        $this->db->where('d_id', $this->input->post('id'));
        $q = $this->db->get('detalle_lotes');
        
		$data = new stdClass();
		
        if($q->num_rows() > 0){
            $this->db->set($this->input->post('columna'), $this->input->post('valor'));
            $this->db->where('d_id', $this->input->post('id'));
            $this->db->update('detalle_lotes');
        }else{
            
            $data->d_id = $this->input->post('id');
            $data->cansur = $this->input->post('valor');
            $data->producto_id = $row1->producto_id;
            
            $this->db->insert('detalle_lotes', $data);
            
        }
        
        $this->db->select('cansur');
        $this->db->where('id', $this->input->post('id'));
        $q3 = $this->db->get('detalle');
        
        $row3 = $q3->row();
        
        return $row3->cansur;
        
        
        

    }
    
    function detalle_captura_cambio_automatico($porcentaje)
    {
        $this->db->select('cantidad');
        $this->db->where('id', $this->input->post('id'));
        $q1 = $this->db->get('pedidos_retail');
        $r1 = $q1->row();
        
        $rate = ceil(($r1->cantidad * $porcentaje) / 100);
        $valor = $this->input->post('valor');
        
        if($valor <= $rate){
            $valor = $valor;
        }else{
            $valor = $rate;
        }
        
        
        $this->db->set($this->input->post('columna'), $valor);
        $this->db->where('id', $this->input->post('id'));
        if($this->db->update('pedidos_retail')){
            
            $this->db->select('(cantidad + adicional) as total');
            $this->db->where('id', $this->input->post('id'));
            $q = $this->db->get('pedidos_retail');
            $r = $q->row();
            
            return $r->total;
        }
        
        
    }
    
    function detalle_captura_cambio_lote_caucidad()
    {
        $columna = $this->input->post('columna');
        $valor = $this->input->post('valor');
        $id = $this->input->post('id');
        
        if($columna == "caducidad"){
            $valor = fecha_normalizada($valor);
        }else{
            $valor = $valor;
        }
        
        
        $this->db->set($columna, $valor);
        $this->db->where('d_id', $id);
        $this->db->update('detalle_lotes');

        $this->db->set($columna, $valor);
        $this->db->where('id', $id);
        $this->db->update('detalle');
        
        
        $dt = $this->db->affected_rows();
        
        if($dt > 0){
            if($columna == "caducidad"){
                return formato_caducidad($valor);
            }else{
                return $valor;
            }
        }else{
            return null;
        }
    }

    private function valida_cantidad($id)
    {
        $this->db->select('cast((canreq - cansur) as signed) as permitido', false);
        $this->db->where('id', $id);
        $query = $this->db->get('detalle');
        
        $row = $query->row();
        
        return $row->permitido;
    }
    
    private function get_producto_id($id)
    {
        $this->db->select('producto_id');
        $this->db->where('id', $id);
        $query = $this->db->get('detalle');
        
        $row = $query->row();
        
        return $row->producto_id;
    }
    
    private function calcula_cansur($d_id)
    {
        $this->db->where('d_id', $d_id);
        $this->db->select_sum('cansur');
        $query = $this->db->get('detalle_lotes');
        
        $row = $query->row();
        
        return $row->cansur;
    }

    function cerrar_surtido($id)
    {
        $data = array(
                'estatus' => 2
                );
        $this->db->set('f_surtido', 'now()', false);
        $this->db->where('id', $id);
        $this->db->update('pedidos', $data);
        
        return $this->db->affected_rows();
    }
    
    function cerrar_embarque($id)
    {
        $this->db->select('estatus');
        $this->db->where('id', $id);
        $q = $this->db->get('pedidos');
        
        $r = $q->row();
        
        $this->db->select('sum(canreq) as canreq, sum(cansur) as cansur');
        $this->db->where('p_id', $id);
        $q2 = $this->db->get('detalle');
        
        $r2 = $q2->row();
        
        if($r->estatus == 2 && $r2->canreq > 0 && $r2->cansur > 0){
        
            $data = array(
                    'estatus'   => 3,
                    'cajas'     => $this->input->post('cajas'),
                    'hieleras'     => $this->input->post('hieleras'),
                    'observaciones' => $this->input->post('observaciones')
                    );
            $this->db->set('f_embarque', 'now()', false);
            $this->db->where('id', $id);
            
            
            
            
            
                if($this->db->update('pedidos', $data))
                {
            
                $sql_act_det_lotes = "insert into detalle_lotes (d_id, cansur, lote, caducidad, producto_id, cerrada) (SELECT d.id as d_id, cansur, 'SL' as lote, '0000-00-00' as caducidad, p.id, 0 FROM detalle d
left join productos p on d.producto_id = p.id
where p_id = ? and lc = 0 and d.id not in(select d_id  from detalle_lotes));";

                $this->db->query($sql_act_det_lotes, $id);
            
            
                $sql = "INSERT INTO inventario (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id, user_id)
(SELECT c.id,
case when c.lc = 0 then 'SL'
else l.lote
end as lote,
case when c.lc = 0 then '0000-00-00'
else l.caducidad
end as caducidad,
sum(l.cansur) as cansur, now() as modificado, 2 as tipo, 101 as subtipo, p.id, p.sucursal_id, 0 as proveedor_id, ".$this->session->userdata('id')."
FROM pedidos p
Left JOIN detalle d on p.id = d.p_id
LEFT JOIN detalle_lotes l on d.id = l.d_id
LEFT JOIN productos c on d.producto_id = c.id
where p.id = ?
group by c.id)
on duplicate key update caducidad=values(caducidad), inv = cast((ifnull(inv, 0) - values(inv)) as signed), modificado = now(), tipo = values(tipo), subtipo = values(subtipo), idref = values(idref), sucursal_id = values(sucursal_id), proveedor_id = values(proveedor_id), user_id = values(user_id);";
            
                if($this->db->query($sql, $id)){
                    
                    return 0;
                    
                }else{
                    
                    return 3;
                    
                }
        
            }else{
                
                return 2;
                
            }
        }else{
            
            if($r2->canreq == 0 || $r2->cansur == 0){
            
                $data = array(
                        'estatus'   => 5,
                        'cajas'     => 0,
                        'observaciones' => $this->input->post('observaciones')
                        );
                $this->db->set('f_cancelado', 'now()', false);
                $this->db->where('id', $id);
                $this->db->update('pedidos', $data);
                return 0;
            
            }else{
                
                return 1;
            }
        }
    }

    function previo_pedido_header($id)
    {
        $this->db->select('p.id, p.fecha, p.sucursal_id, sucursal, s.estado, s.juris, j.jurisdiccion');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc');
        $this->db->join('juris j', 's.juris = j.juris and s.estado_int = j.estado');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        
        $row = $query->row();
        
        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="3" width="130px">'.img($logo).'</td>
                <td rowspan="3" width="400px" align="center"><font size="10">'.EMPRESA.'<br />'.ALMACEN.$row->estado.'<br />'.$row->jurisdiccion.'<br />SUCURSAL: '.$row->sucursal.'</font></td>
                <td width="65px">FOLIO: </td>
                <td width="65px" align="right">'.$row->id.'</td>
            </tr>
            <tr>
                <td width="65px">FECHA: </td>
                <td width="65px" align="right">'.$row->fecha.'</td>
            </tr>
            <tr>
                <td width="65px"># SUC: </td>
                <td width="65px" align="right">'.$row->sucursal_id.'</td>
            </tr>
        </table>';
        
        return $tabla;
    }
    
    function embarque_header($id)
    {
        $this->db->select('p.id, p.fecha, p.sucursal_id, sucursal, s.estado, s.juris, j.jurisdiccion');
        $this->db->from('pedidos p');
        $this->db->join('sucursales s', 'p.sucursal_id = s.numsuc');
        $this->db->join('juris j', 's.juris = j.juris and s.estado_int = j.estado');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        
        $row = $query->row();
        
        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="3" width="130px">'.img($logo).'</td>
                <td rowspan="3" width="470px" align="center"><font size="10">'.EMPRESA.'<br />'.ALMACEN.$row->estado.'<br />'.$row->jurisdiccion.'<br />SUCURSAL: '.$row->sucursal.'</font></td>
                <td width="65px">FOLIO: </td>
                <td width="65px" align="right">'.$row->id.'</td>
            </tr>
            <tr>
                <td width="65px">FECHA: </td>
                <td width="65px" align="right">'.$row->fecha.'</td>
            </tr>
            <tr>
                <td width="65px"># SUC: </td>
                <td width="65px" align="right">'.$row->sucursal_id.'</td>
            </tr>
        </table>';
        
        return $tabla;
    }

    function previo_pedido($id)
    {
        $this->db->where('p_id', $id);
        $query = $this->db->get('detalle');
        
        $tabla = '
        <style>
        table
        {
        	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }
        th
        {
        	font-weight: normal;
        	border-bottom: 2px solid #000000;
        }
        td
        {
        	border-bottom: 1px solid #000000;
        }
        </style>';
        
        $tabla.= '<table cellpadding="4">
        <thead>
            <tr>
                <th width="100px">Clave</th>
                <th width="410px">Descripcion</th>
                <th width="70px" align="right">Req.</th>
                <th width="70px" align="right">Surt.</th>
            </tr>
        </thead>
        <tbody>
        ';
        $canreq = 0;
        
        foreach($query->result() as $row)
        {
            $tabla.= '<tr>
                <td width="100px">'.$row->clave.'</td>
                <td width="410px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->canreq, 0).'</td>
                <td width="70px" align="right">&nbsp;</td>
            </tr>
            ';
            $canreq = $canreq + $row->canreq;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">'.number_format($canreq, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
        </tfoot>
        </table>';
        
        return $tabla;
    }
    
    function previo_pedido_tipo_subtipo($id, $tipo, $subtipo, $subtipo_desc)
    {
        $this->db->select('d.*');
        $this->db->from('detalle d');
        $this->db->join('productos p', 'd.producto_id = p.id', 'LEFT');
        $this->db->where('p_id', $id);
        $this->db->where('tipo_producto', $tipo);
        $this->db->where('subtipo_producto', $subtipo);
        $this->db->order_by('d.id');
        $query = $this->db->get();
        
        $tabla = '
        <style>
        table
        {
        	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }
        th
        {
        	font-weight: normal;
        	border-bottom: 2px solid #000000;
        }
        td
        {
        	border-bottom: 1px solid #000000;
        }
        </style>';
        
        $tabla.= '<table cellpadding="4">
        <thead>
            <tr>
                <th width="50px">Sub</th>
                <th width="100px">Clave</th>
                <th width="360px">Descripcion</th>
                <th width="70px" align="right">Req.</th>
                <th width="70px" align="right">Surt.</th>
            </tr>
        </thead>
        <tbody>
        ';
        $canreq = 0;
        
        foreach($query->result() as $row)
        {
            $tabla.= '<tr>
                <td width="50px"><font size="4">'.$subtipo_desc.'</font></td>
                <td width="100px">'.$row->clave.'</td>
                <td width="360px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->canreq, 0).'</td>
                <td width="70px" align="right">&nbsp;</td>
            </tr>
            ';
            $canreq = $canreq + $row->canreq;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">'.number_format($canreq, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
        </tfoot>
        </table>';
        
        return $tabla;
    }

    function previo_pedido_surtido($id)
    {
        $sql = "SELECT t.tipo_producto, s.subtipo_producto, p.tipo_producto as tipo, p.subtipo_producto as subtipo, d.p_id as id_pedido FROM detalle d
left join productos p on d.producto_id = p.id
left join tipo_producto t on p.tipo_producto= t.id
left join subtipo_producto s on p.subtipo_producto= s.id
where d.p_id = ?
group by tipo_producto, subtipo_producto;";

        return $this->db->query($sql, $id);
        
        
    }
    
    function pedido_embarque($id)
    {
        $this->db->where('p_id', $id);
        $this->db->where('cansur > 0', '', false);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('detalle');
        
        $this->db->select('cajas, hieleras, observaciones');
        $this->db->where('id', $id);
        $query2 = $this->db->get('pedidos');
        
        $row2 = $query2->row();
        
        $tabla = '
        <style>
        table
        {
        	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }
        th
        {
        	font-weight: normal;
        	border-bottom: 2px solid #000000;
        }
        td
        {
        	border-bottom: 1px solid #000000;
        }
        </style>';
        
        $tabla.= '<table cellpadding="4">
        <thead>
            <tr>
                <th width="100px">Clave</th>
                <th width="410px">Descripcion</th>
                <th width="70px" align="right">Req.</th>
                <th width="70px" align="right">Sur.</th>
                <th width="70px" align="right">LOT CAD</th>
            </tr>
        </thead>
        <tbody>
        ';
        $canreq = 0;
        $cansur = 0;
        
        foreach($query->result() as $row)
        {
            
            
            $tabla.= '<tr>
                <td width="100px">'.$row->clave.'</td>
                <td width="410px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->canreq, 0).'</td>
                <td width="70px" align="right">'.number_format($row->cansur, 0).'</td>
                <td width="70px" align="left">'.$row->lote.' - '.formato_caducidad($row->caducidad).'</td>
            </tr>
            ';
            $canreq = $canreq + $row->canreq;
            $cansur = $cansur + $row->cansur;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">'.number_format($canreq, 0).'</td>
                <td align="right">'.number_format($cansur, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Numero de Cajas: '.$row2->cajas.'</td>
                <td colspan="3">Numero de Hieleras: '.$row2->hieleras.'</td>
            </tr>
            <tr>
                <td colspan="5">Observaciones: '.$row2->observaciones.'</td>
            </tr>
        </tfoot>
        </table>';
        
        $tabla.= '<table align="center" border="0">
        <tr>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN EMBARCA<br /><br /><br />
            </td>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN RECIBE<br /><br /><br />
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        
        <tr>
            <td>
                A U T O R I Z O<br />MANUEL SIERRA CUESTA<br />JEFE DE ALMACEN
            </td>
            <td>
                Nombre y Firma del Operador
            </td>
        </tr>
        </table>';
        
        return $tabla;
    }
    
    function cancela_pedido($id, $motivo){
        
        $data = array(
                        'estatus'   => 5,
                        'cajas'     => 0,
                        'observaciones' => strtoupper($motivo)
        );
        $this->db->set('f_cancelado', 'now()', false);
        $this->db->where('id', $id);
        $this->db->update('pedidos', $data);
        
        return $this->db->affected_rows();
        
    }
    
    function regresa_pedido($id, $estatus){
        
        $estatus_nuevo = $estatus - 1;
        
        if($estatus == 3){
            $sql = "INSERT INTO inventario (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id, user_id)
(SELECT c.id,
case when c.lc = 0 then 'SL'
else l.lote
end as lote,
case when c.lc = 0 then '0000-00-00'
else l.caducidad
end as caducidad,
sum(l.cansur) as cansur, now() as modificado, 2 as tipo, 101 as subtipo, p.id, p.sucursal_id, 0 as proveedor_id, ".$this->session->userdata('id')."
FROM pedidos p
Left JOIN detalle d on p.id = d.p_id
LEFT JOIN detalle_lotes l on d.id = l.d_id
LEFT JOIN productos c on d.producto_id = c.id
where p.id = ?
group by c.id)
on duplicate key update caducidad=values(caducidad), inv = cast((ifnull(inv, 0) +  values(inv)) as signed), modificado = now(), tipo = values(tipo), subtipo = values(subtipo), idref = values(idref), sucursal_id = values(sucursal_id), proveedor_id = values(proveedor_id), user_id = values(user_id);";
            
                if($this->db->query($sql, $id)){
                    
                    $data = array(
                        'estatus'   => $estatus_nuevo
                    );
                    $this->db->where('id', $id);
                    $this->db->update('pedidos', $data);
                    
                    return $this->db->affected_rows();
                }
        }else{
            
            $data = array(
                        'estatus'   => $estatus_nuevo
            );
            $this->db->where('id', $id);
            $this->db->update('pedidos', $data);
            
            return $this->db->affected_rows();
        }
        
        
        
        
        
    }

    function inserta_pedido_option_c($archivo)
    {
        $data = new stdClass();
        $data->fecha = date('Y-m-d');
        $data->archivo = (string)$archivo;
        
        $this->db->insert('pedidos_opcion_c', $data);
        
        return $this->db->insert_id();
    }    

    function inserta_pedido_option_d($suc, $clave, $cantidad, $op_id)
    {
        //suc, clave, cantidad, op_id
        $data = new stdClass();
        $data->suc = (int)$suc;
        $data->clave = (string)trim($clave);
        $data->cantidad = (int)$cantidad;
        $data->op_id = (int)$op_id;
        
        $this->db->insert('pedidos_opcion_d', $data);
        
    }
    
    function procesar_subida($id)
    {
        $sql = "SELECT op_id, p.suc, s.tipo_producto, s.subtipo_producto FROM pedidos_opcion_d p
left join productos s on p.clave = s.clave
where op_id = ?
group by op_id, p.suc, s.tipo_producto, s.subtipo_producto;";
        
        $query = $this->db->query($sql, $id);
        
        foreach($query->result() as $row)
        {
            $pedido_id = $this->inserta_control($row->suc);
            
            $sql2 = "SELECT p.clave, p.cantidad FROM pedidos_opcion_d p
left join productos s on p.clave = s.clave
where op_id = ? and p.suc = ? and s.tipo_producto = ? and s.subtipo_producto = ?;";

            $query2 = $this->db->query($sql2, array($id, $row->suc, $row->tipo_producto, $row->subtipo_producto));
            
            foreach($query2->result() as $row2)
            {
                $this->submit_captura_clave($pedido_id, $row2->clave, $row2->cantidad);
            }
        }
        
    }
    
    private function inserta_control($suc)
    {
			$data = new stdClass();
			
            //id, fecha, user_id, cliente_id, alta
            $data->user_id = $this->session->userdata('id');
            $data->sucursal_id = $suc;
            $data->cad_min = 300;
            $data->flag = 0;
            $data->estatus = 1;
            
            $this->db->set('fecha', 'date(now())', false);
            $this->db->set('f_captura', 'now()', false);
            $this->db->set('alta', 'now()', false);
            $this->db->insert('pedidos', $data);
            
            return $this->db->insert_id();
    }

    function cerrar_automaticos_hoy()
    {
        $sql = "SELECT id, sucursal FROM pedidos_retail_c p where estatus = 0 and fecha =date(now());";
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0){
            
            foreach($query->result() as $row)
            {
    
                $sql2 = "SELECT clave_sica as clave, (cantidad + adicional) as cantidad FROM pedidos_retail p where c_id = ? and (cantidad + adicional) > 0;";
    
                $query2 = $this->db->query($sql2, array($row->id));
                
                if($query2->num_rows() > 0){
                    
                    $pedido_id = $this->inserta_control($row->sucursal);
                    
                    foreach($query2->result() as $row2)
                    {
                        $this->submit_captura_clave($pedido_id, $row2->clave, $row2->cantidad);
                    }
                    
                    $this->actualiza_estatus_pedido_automatico($row->id, $pedido_id);
                }else{
                    $this->actualiza_estatus_pedido_automatico_vacio($row->id);
                }
    
            }
            
            redirect('webservices/automaticos/4/success');

        }else{
            
            $sql3 = "SELECT id, sucursal FROM pedidos_retail_c p where estatus = 1 and fecha =date(now());";
            $q3 = $this->db->query($sql3);
            
            if($q3->num_rows() > 0){
                redirect('webservices/automaticos/5/warning');
            }else{
                redirect('webservices/automaticos/6/warning');
            }

        }
        
        
    }
    
    function actualiza_estatus_pedido_automatico($id, $folio)
    {
        $this->db->set('cerrado', 'now()', false);
        $a = array('estatus' => 1,
        'folio' => $folio
            );
        
        $this->db->where('id', $id);
        $this->db->update('pedidos_retail_c', $a);
        
        $b = array('automatico' => 1);
        $this->db->where('id', $folio);
        $this->db->update('pedidos', $b);
        
    }

    function actualiza_estatus_pedido_automatico_vacio($id)
    {
        $this->db->set('cerrado', 'now()', false);
        $a = array('estatus' => 1);
        
        $this->db->where('id', $id);
        $this->db->update('pedidos_retail_c', $a);
    }

}