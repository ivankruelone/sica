<?php
class Inv_model extends CI_Model {
    
    var $caducidad_minima = null;
    var $user_id = null;

    function __construct()
    {
        parent::__construct();
        $config = $this->config();
        $this->caducidad_minima = $config->caducidad_minima;
        $this->user_id = $this->session->userdata('id');
    }
    
    function config(){
        $query = $this->db->get('config');
        return $query->row();
    }
    
    function catalogo(){
        $elige = $this->input->post('elige');
        if(isset($elige) && $elige != null){
            $e = explode("-", $elige);
            $tipo = $e[0];
            $subtipo = $e[1];
            
            $this->db->where('p.tipo_producto', $tipo);
            $this->db->where('p.subtipo_producto', $subtipo);
        }
        
        $this->db->select('p.*');
        $this->db->select_sum('inv');
        $this->db->from('productos p');
        $this->db->join('inventario i', 'p.id = i.p_id', 'LEFT');
        $this->db->where('clave in(select clave from productos_agrupados)', '', false);
        $this->db->group_by('p.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    function ajuste(){
        $elige = $this->input->post('elige');
        if(isset($elige) && $elige != null){
            $e = explode("-", $elige);
            $tipo = $e[0];
            $subtipo = $e[1];
            
            $this->db->where('p.tipo_producto', $tipo);
            $this->db->where('p.subtipo_producto', $subtipo);
        }

        $this->db->select('p.*, i.lote, i.caducidad, i.inv, i.id as id_inv');
        $this->db->from('productos p');
        $this->db->join('inventario i', 'p.id = i.p_id', 'LEFT');
        $this->db->where('clave in(select clave from productos_agrupados)', '', false);
        $query = $this->db->get();
        return $query->result();
    }
    
    function preajuste($area)
    {
        $this->db->select('i.id, p.clave, descripcion, unidad, cant as inv');
        $this->db->from('inv_temp i');
        $this->db->join('productos p', 'i.clave = p.clave', 'LEFT');
        $this->db->where('i.area', $area);
        $query = $this->db->get();
        return $query->result();
    }
    
    function preajuste_areas()
    {
        $this->db->select('i.id, p.clave, descripcion, unidad, sum(cant) as inv');
        $this->db->from('inv_temp i');
        $this->db->join('productos p', 'i.clave = p.clave', 'LEFT');
        $this->db->group_by('p.clave');
        $this->db->order_by('p.tipo_producto, p.clave');
        $query = $this->db->get();
        return $query->result();
    }

    function kardex_ajuste($clave){
        $this->db->select('unix_timestamp(k.modiicada) as fecha, (k.nueva - k.vieja) as ajuste');
        $this->db->from('kardex k');
        $this->db->join('productos p', 'k.p_id = p.id');
        $this->db->where('p.clave', $clave);
        $this->db->where('k.tipo', 3);
        $query = $this->db->get();
        
        $a = null;
        $num = 1;
        
        foreach($query->result() as $row)
        {
            $a.= "{
					x: ".($row->fecha * 1000).",
					title: 'Ajuste ".$num."',
                    y: ".$row->ajuste."
				},";
                
                $num++;
        }
        
        $a = substr($a, 0, -1);
        
        return $a;
    }
    
    function ajuste_hist(){
        $this->db->select('modiicada, id_ref');
        $this->db->where('tipo', 3);
        $this->db->group_by('id_ref');
        $query = $this->db->get('kardex');
        return $query->result();
    }

    function ajuste_hist_detalle($id_ref){
        $sql = "SELECT k.*, movimiento, clave, SUBSTRING(descripcion, 1, 25) as descripcion, sucursal, razon, u.nombre as usuario
        FROM kardex k
left join productos p on k.p_id = p.id
left join movimientos m on k.tipo = m.tipo and k.subtipo = m.subtipo
left join sucursales s on k.sucursal_id = s.numsuc
left join proveedores o on k.proveedor_id = o.id
left join usuarios u on k.user_id = u.id
where
id_ref = ?
order by p.id, k.id asc;";
        $query = $this->db->query($sql, $id_ref);
        
        return $query->result();
    }

    function ajuste_cambia($id, $valor)
    {
        //id, p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id
        
        $alt = explode("+", $valor);
        
        
        if(count($alt) > 1){
            
            $valor_alt = 0;
            
            foreach($alt as $val)
            {
                $valor_alt = $valor_alt + $val;
            }
            
            $valor = $valor_alt;
            
            
        }else{
            $valor = $valor;
        }
        
        
        
        $this->db->set('inv', $valor);
        $this->db->set('modificado', 'now()', false);
        $this->db->set('tipo', 3);
        $this->db->set('subtipo', 300);
        $this->db->set('idref', date('Ymd'));
        $this->db->set('sucursal_id', 0);
        $this->db->set('proveedor_id', 0);
        $this->db->set('user_id', $this->session->userdata('id'));
        
        $this->db->where('id', $id);
        $this->db->update('inventario');
        
        return $this->db->affected_rows();
        
        
        
    }

    function preajuste_cambia($id, $valor)
    {
        //id, p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id
        
        $alt = explode("+", $valor);
        
        
        if(count($alt) > 1){
            
            $valor_alt = 0;
            
            foreach($alt as $val)
            {
                $valor_alt = $valor_alt + $val;
            }
            
            $valor = $valor_alt;
            
            
        }else{
            $valor = $valor;
        }
        
        
        
        $this->db->set('cant', $valor);
        $this->db->where('id', $id);
        $this->db->update('inv_temp');
        
        return $this->db->affected_rows();
        
        
        
    }
    
    function detalle_modal($id){
        $this->db->where('p_id', $id);
        $this->db->where('inv >', 0);
        $query = $this->db->get('inventario');
        return $query->result();
    }
    
    function get_invi_ini_c()
    {
        $this->db->select('*');
        $this->db->from('inv_ini_c c');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_productos_invini($orden = 'i.id', $direccion = 'ASC')
    {
        $this->db->select('i.*, clave, descripcion');
        $this->db->from('inv_ini i');
        $this->db->join('productos p', 'p.id = i.p_id', 'LEFT');
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function submit_captura_clave_invini()
    {
        $lc = $this->input->post('lc');
		$data = new stdClass();
        
        if($lc == 0){
            
                $this->db->where('empresa', $this->input->post('empresa'));
                $this->db->where('p_id', $this->input->post('p_id'));
                $query = $this->db->get('inv_ini');
                if($query->num_rows() == 0){
                    //id, p_id, lote, caducidad, piezas, empresa
                    $data->p_id         = $this->input->post('p_id');
                    $data->piezas       = $this->input->post('piezas');
                    $data->empresa      = $this->input->post('empresa');
                    $this->db->insert('inv_ini', $data);
                }else{
                    
                }
            
            
        }else{
            
            $fecha = $this->input->post('caducidad');
            $caducidad = fecha_normalizada($fecha);
            
            if(caduca_en_dias($caducidad) > $this->caducidad_minima){
    
                $this->db->where('empresa', $this->input->post('empresa'));
                $this->db->where('lote', $this->input->post('lote'));
                $this->db->where('p_id', $this->input->post('p_id'));
                $query = $this->db->get('inv_ini');
                if($query->num_rows() == 0){
                    //id, p_id, lote, caducidad, piezas, empresa
                    $data->p_id         = $this->input->post('p_id');
                    $data->lote         = $this->input->post('lote');
                    $data->caducidad    = $caducidad;
                    $data->piezas       = $this->input->post('piezas');
                    $data->empresa      = $this->input->post('empresa');
                    $this->db->insert('inv_ini', $data);
                }
                
            }else{
                echo '<p class="message error">Caducidad no aceptada.</p>';
            }
        
        }
        
    }
    
    function borra_detalle_invini($id)
    {
        $this->db->delete('inv_ini', array('id' => $id));
        return $this->db->affected_rows();
    }
    
    function cerrar_invini()
    {
        
        $this->db->trans_start();
        
        $this->db->where('estatus', 0);
        $query = $this->db->get('inv_ini_c');
        if($query->num_rows() > 0)
        {
            $sql = "INSERT INTO inventario (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref)
(SELECT p_id, lote, caducidad, d.piezas, now(), 1, 1, id FROM inv_ini d)
on duplicate key update caducidad=values(caducidad), inv = cast(values(inv) + inv as signed), modificado = now(), tipo = values(tipo), subtipo = values(subtipo), idref = values(idref);";
            
            $this->db->query($sql);
        }
        
        $data->estatus = 1;
        
        $this->db->where('estatus', 0);
        $this->db->update('inv_ini_c', $data);
        
        
        $this->db->trans_complete();
    }
    
    function get_entradas($subtipo, $estatus = 0)
    {
        $this->db->select('c.*, movimiento, s.sucursal, p.razon as proveedor, c.referencia, cerrado, ifnull(sum(piezas), 0) as piezas, e.estatus_desc', false);
        $this->db->from('entradas_c c');
        $this->db->join('movimientos m', 'c.tipo = m.tipo and c.subtipo = m.subtipo', 'LEFT');
        $this->db->join('sucursales s', 'c.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('entradas d', 'c.id = d.e_id', 'LEFT');
        $this->db->join('proveedores p', 'c.proveedor_id = p.id', 'LEFT');
        $this->db->join('entradas_estatus e', 'c.estatus = e.id', 'LEFT');
        
        if(is_array($subtipo)){
            
            foreach($subtipo as $st){
                $this->db->or_where('c.subtipo', $st);
            }
            
        }else{
            $this->db->where('c.subtipo', $subtipo);
        }
        $this->db->group_by('c.id');
        $this->db->order_by('c.id', 'desc');
        $query = $this->db->get();
        
        
        return $query->result();
        
    }
    
    function nueva_entrada()
    {
        $monto = $this->input->post('monto');
        $sucursal = $this->input->post('sucursal_id');
        $sucursal = explode('-', $sucursal);
        $sucursal = trim($sucursal[0]);
		
		$data = new stdClass();
        
        if(isset($monto)){
            $monto = $monto;
        }else{
            $monto = 0;
        }
        //estatus, mod, empresa, tipo, subtipo, cerrado, id, cliente_id, user_id, referencia, notas, fec_doc
        $data->tipo = $this->input->post('tipo');
        $data->subtipo = $this->input->post('subtipo');
        $data->sucursal_id = $sucursal;
        $data->user_id = $this->user_id;
        $data->referencia = $this->input->post('referencia');
        $data->notas = $this->input->post('notas');
        $data->fec_doc = $this->input->post('fec_doc');
        $data->proveedor_id = $this->input->post('proveedor_id');
        $data->monto = $monto;
        
        $this->db->insert('entradas_c', $data);
        
        return $this->db->insert_id();
    }
    
    function get_entrada($id)
    {
        $this->db->select('c.*, movimiento, numsuc, sucursal, p.rfc, p.razon as proveedor, c.referencia, cerrado, piezas', false);
        $this->db->from('entradas_c c');
        $this->db->join('movimientos m', 'c.tipo = m.tipo and c.subtipo = m.subtipo', 'LEFT');
        $this->db->join('sucursales s', 'c.sucursal_id = s.numsuc', 'LEFT');
        $this->db->join('entradas d', 'c.id = d.e_id', 'LEFT');
        $this->db->join('proveedores p', 'c.proveedor_id = p.id', 'LEFT');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        
        return $query->row();
        
    }

    function get_productos_entrada($id, $orden = 'i.id', $direccion = 'ASC')
    {
        $this->db->select('i.*, clave, descripcion, unidad, tipo_producto');
        $this->db->from('entradas i');
        $this->db->join('productos p', 'p.id = i.p_id', 'LEFT');
        $this->db->where('e_id', $id);
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_productos_entrada_rechazados($id, $orden = 'i.id', $direccion = 'ASC')
    {
        $this->db->select('i.*, clave, descripcion');
        $this->db->from('entradas_rechazadas i');
        $this->db->join('productos p', 'p.id = i.p_id', 'LEFT');
        $this->db->where('e_id', $id);
        $this->db->order_by($orden, $direccion);
        $query = $this->db->get();
        
        return $query->result();
    }

    function submit_captura_clave_entrada()
    {
        $lc = $this->input->post('lc');
        $precio = $this->input->post('precio');
        
        $id_entrada = $this->input->post('id');
        
        $this->db->select('tipo');
        $this->db->from('entradas_c');
        $this->db->where('id', $id_entrada);
        $q2 = $this->db->get();
        $r2 = $q2->row();
        
        
        if(isset($precio)){
            $precio = $precio;
        }else{
            $precio = 0;
        }
        
        $this->db->select('id');
        $this->db->where('clave', $this->input->post('p_id'));
        $prod_id = $this->db->get('productos');
        
        $producto_id = $prod_id->row();
        
        $data =  new StdClass();
        
        if($lc == 0){
            
                $this->db->where('e_id', $this->input->post('id'));
                $this->db->where('p_id', $producto_id->id);
                $query = $this->db->get('entradas');
                if($query->num_rows() == 0){
                    //id, e_id, lote, caducidad, piezas, empresa, mod, p_id
                    $data->e_id         = $this->input->post('id');
                    $data->p_id         = $producto_id->id;
                    $data->piezas       = $this->input->post('piezas');
                    $data->empresa      = $this->input->post('empresa');
                    $data->precio       = $precio;
                    $this->db->insert('entradas', $data);
                }else{
                    echo '<p class="message error">Ya se habia agregado esa clave.</p>';
                }
            
            
        }else{
            
            $fecha = $this->input->post('caducidad');
            $caducidad = fecha_normalizada($fecha);
            
            if(caduca_en_dias($caducidad) > $this->caducidad_minima || $r2->tipo == 2 || $r2->tipo == 4 || $caducidad == '0000-00-00'){
    
                $this->db->where('e_id', $this->input->post('id'));
                $this->db->where('lote', $this->input->post('lote'));
                $this->db->where('p_id', $producto_id->id);
                $query = $this->db->get('entradas');
                if($query->num_rows() == 0){
                    //id, e_id, lote, caducidad, piezas, empresa, mod, p_id
                    $data->e_id         = $this->input->post('id');
                    $data->p_id         = $producto_id->id;
                    $data->lote         = $this->input->post('lote');
                    $data->caducidad    = $caducidad;
                    $data->piezas       = $this->input->post('piezas');
                    $data->empresa      = $this->input->post('empresa');
                    $data->precio       = $precio;
                    $this->db->insert('entradas', $data);
                }
                
            }else{
                $data->e_id         = $this->input->post('id');
                $data->p_id         = $producto_id->id;
                $data->lote         = $this->input->post('lote');
                $data->caducidad    = $caducidad;
                $data->piezas       = $this->input->post('piezas');
                $data->empresa      = $this->input->post('empresa');
                $data->precio       = $precio;
                $this->db->insert('entradas_rechazadas', $data);
                echo '<p class="message error">Caducidad no aceptada.</p>';
            }
        
        }
        
    }

    function borra_detalle_entrada($id)
    {
        $this->db->delete('entradas', array('id' => $id));
        return $this->db->affected_rows();
    }

    function borra_detalle_entrada_rechazada($id)
    {
        $this->db->delete('entradas_rechazadas', array('id' => $id));
        return $this->db->affected_rows();
    }

    function cerrar_entrada($id)
    {
        
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->where('estatus', 0);
        $query = $this->db->get('entradas_c');
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            echo $row->tipo;
            
            if($row->tipo == 1){
                
                    
                    //Inserta a inventario

            $sql = "INSERT INTO inventario (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id, user_id)
(SELECT p_id, case when p.lc = 0 then 'SL' else lote end as lote, case when p.lc = 0 then '0000-00-00' else caducidad end as caducidad, d.piezas, now(), tipo, subtipo, d.id, i.sucursal_id, i.proveedor_id, ".$this->session->userdata('id')."
FROM entradas_c i
join entradas d on i.id = d.e_id
join productos p on d.p_id = p.id
where i.id = ? and i.estatus = ?)
on duplicate key update caducidad=values(caducidad), inv = cast(values(inv) + inv as signed), modificado = now(), tipo = values(tipo), subtipo = values(subtipo), idref = values(idref), sucursal_id = values(sucursal_id), proveedor_id = values(proveedor_id), user_id = values(user_id);";
             $this->db->query($sql, array($id, 0));       
                
            }elseif($row->tipo == 2){
                
                //Resta al Inventario

            $sql = "INSERT INTO inventario (p_id, lote, caducidad, inv, modificado, tipo, subtipo, idref, sucursal_id, proveedor_id, user_id)
(SELECT p_id, case when p.lc = 0 then 'SL' else lote end as lote, case when p.lc = 0 then '0000-00-00' else caducidad end as caducidad, d.piezas, now(), tipo, subtipo, d.id, i.sucursal_id, i.proveedor_id, ".$this->session->userdata('id')."
FROM entradas_c i
join entradas d on i.id = d.e_id
join productos p on d.p_id = p.id
where i.id = ? and i.estatus = ?)
on duplicate key update caducidad=values(caducidad), inv = cast((ifnull(inv, 0) - values(inv)) as signed), modificado = now(), tipo = values(tipo), subtipo = values(subtipo), idref = values(idref), sucursal_id = values(sucursal_id), proveedor_id = values(proveedor_id), user_id = values(user_id);";
             $this->db->query($sql, array($id, 0));   
            }elseif($row->tipo == 4){
                
                //No se resta del inve, es un movimiento que no requiere mover el inv.
            }
            
            
            
        }
        
        $data->estatus = 1;
        $this->db->set('cerrado', 'now()', false);
        
        $this->db->where('id', $id);
        $this->db->where('estatus', 0);
        $this->db->update('entradas_c', $data);
        
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }else{
            return 1;
        }
    }

    function cancela_folio($id, $motivo){
        
        $data = array(
                        'estatus'   => 2,
                        'motivo' => strtoupper($motivo)
        );
        $this->db->set('cancelado', 'now()', false);
        $this->db->where('id', $id);
        $this->db->update('entradas_c', $data);
        
        return $this->db->affected_rows();
        
    }

    function reporte_header($id)
    {
        $row = $this->get_entrada($id);
        
        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );
             
             if($row->rfc == 'FVA961108MD7'){
                $logo1 = null;
                $empresa = "FARMACIAS DE VANGUARDIA SA DE CV";
                $almacen = "ALMACEN CENTRAL MEXICO DF";
                $estado_desc = null;
             }else{
                $logo1 = img($logo);
                $empresa = EMPRESA;
                $almacen = ALMACEN;
                $estado_desc = ESTADO_DESC;
             }   
        

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="3" width="130px">'.$logo1.'</td>
                <td rowspan="3" width="470px" align="center"><font size="10">'.$empresa.'<br />'.$almacen.' '.$estado_desc.'<br />'.'SUCURSAL: '.$row->sucursal.'<br />PROVEEDOR: '.$row->proveedor.'<br />MOVIMIENTO: '.strtoupper($row->movimiento).'</font></td>
                <td width="65px">FOLIO: </td>
                <td width="65px" align="right">'.$row->id.'</td>
            </tr>
            <tr>
                <td width="65px">FECHA: </td>
                <td width="65px" align="right">'.$row->cerrado.'</td>
            </tr>
            <tr>
                <td width="65px">REF.: </td>
                <td width="65px" align="right">'.$row->referencia.'</td>
            </tr>
        </table>';
        
        return $tabla;
    }
    
    function reporte_header_inv_ini()
    {
        $query = $this->db->get('inv_ini_c');
        $row = $query->row();
        
        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="2" width="130px">'.img($logo).'</td>
                <td rowspan="2" width="470px" align="center"><font size="10">'.EMPRESA.'<br />'.ALMACEN.' '.ESTADO_DESC.'<br />'.'REPORTE DE INVENTARIO INICIAL</font></td>
                <td width="65px">FECHA INVENTARIO: </td>
                <td width="65px" align="right">'.$row->mod.'</td>
            </tr>
            <tr>
                <td width="65px">FECHA IMPRESION: </td>
                <td width="65px" align="right">'.date('Y-m-d').'</td>
            </tr>
        </table>';
        
        return $tabla;
    }

    function reporte_header_inv($tipo = null, $subtipo = null)
    {
        $a = null;
        
        if($tipo != null)
        {
            $this->db->where('id', $tipo);
            $tipo = $this->db->get('tipo_producto');
            $tipo = $tipo->row();
            $a.= "<br />".$tipo->tipo_producto;
            
        }

        if($subtipo != null)
        {
            $this->db->where('id', $subtipo);
            $subtipo = $this->db->get('subtipo_producto');
            $subtipo = $subtipo->row();
            $a.= " - ".$subtipo->subtipo_producto;
        }

        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="2" width="130px">'.img($logo).'</td>
                <td rowspan="2" width="470px" align="center"><font size="10">'.EMPRESA.'<br />'.ALMACEN.' '.ESTADO_DESC.'<br />'.'REPORTE DE INVENTARIO ACTUAL'.$a.'</font></td>
                <td width="65px">FECHA: </td>
                <td width="65px" align="right">'.date('Y-m-d').'</td>
            </tr>
            <tr>
                <td width="65px">HORA: </td>
                <td width="65px" align="right">'.date('H:s:i').'</td>
            </tr>
        </table>';
        
        return $tabla;
    }

    function reporte_header_ajuste($id_ref)
    {
        
        $logo = array(
                                  'src' => base_url().'images/logo.png',
                                  'width' => '120'
                        );

        
        $tabla = '<table cellpadding="5">
            <tr>
                <td rowspan="2" width="130px">'.img($logo).'</td>
                <td rowspan="2" width="470px" align="center"><font size="10">'.EMPRESA.'<br />'.ALMACEN.' '.ESTADO_DESC.'<br />'.'REPORTE DE AJUSTE DE INVENTARIO A DETALLE</font></td>
                <td width="65px">REF.: </td>
                <td width="65px" align="right">'.$id_ref.'</td>
            </tr>
            <tr>
                <td width="65px">FECHA IMPRESION: </td>
                <td width="65px" align="right">'.date('Y-m-d H:s:i').'</td>
            </tr>
        </table>';
        
        return $tabla;
    }

    function reporte_detalle($id)
    {
        $this->db->select('*');
        $this->db->from('entradas e');
        $this->db->join('productos p', 'e.p_id = p.id', 'left');
        $this->db->where('e.e_id', $id);
        $this->db->order_by('tipo_producto, clave', 'asc');
        $query = $this->db->get();
        
        $this->db->select('notas');
        $this->db->where('id', $id);
        $query2 = $this->db->get('entradas_c');
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
                <th width="480px">Descripcion</th>
                <th width="70px" align="right">Piezas</th>
                <th width="70px" align="right">LOT CAD</th>
            </tr>
        </thead>
        <tbody>
        ';
        $piezas = 0;
        
        foreach($query->result() as $row)
        {
            
            
            $tabla.= '<tr>
                <td width="100px">'.$row->clave.'</td>
                <td width="480px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->piezas, 0).'</td>
                <td width="70px" align="left">'.$row->lote.' - '.formato_caducidad($row->caducidad).'</td>
            </tr>
            ';
            $piezas = $piezas + $row->piezas;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">'.number_format($piezas, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">Observaciones: '.$row2->notas.'</td>
            </tr>
        </tfoot>
        </table>';
        
        $tabla.= '<table align="center" border="0">
        <tr>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN ENTREGA<br /><br /><br />
            </td>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN RECIBE<br /><br /><br />
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        
        </table>';
        
        return $tabla;
    }

    function reporte_detalle_inv_ini()
    {
        $this->db->select('*');
        $this->db->from('inv_ini e');
        $this->db->join('productos p', 'e.p_id = p.id', 'left');
        $this->db->order_by('tipo_producto, clave', 'asc');
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
                <th width="70px">Clave</th>
                <th width="510px">Descripcion</th>
                <th width="70px" align="right">Piezas</th>
                <th width="70px" align="right">LOT CAD</th>
            </tr>
        </thead>
        <tbody>
        ';
        $piezas = 0;
        
        foreach($query->result() as $row)
        {
            
            
            $tabla.= '<tr>
                <td width="70px">'.$row->clave.'</td>
                <td width="510px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->piezas, 0).'</td>
                <td width="70px" align="left">'.$row->lote.' - '.formato_caducidad($row->caducidad).'</td>
            </tr>
            ';
            $piezas = $piezas + $row->piezas;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">'.number_format($piezas, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
        </tfoot>
        </table>';
        
        $tabla.= '<table align="center" border="0">
        <tr>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN ENTREGA<br /><br /><br />
            </td>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN RECIBE<br /><br /><br />
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        
        </table>';
        
        return $tabla;
    }

    function reporte_detalle_inv($tipo = null, $subtipo = null)
    {
        $this->db->select('*');
        $this->db->from('inventario e');
        $this->db->join('productos p', 'e.p_id = p.id', 'left');
        if($tipo != null)
        {
            $this->db->where('p.tipo_producto', $tipo);
        }
        if($subtipo != null)
        {
            $this->db->where('p.subtipo_producto', $subtipo);
        }
        $this->db->order_by('tipo_producto, clave', 'asc');
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
                <th width="70px">Clave</th>
                <th width="510px">Descripcion</th>
                <th width="70px" align="right">Piezas</th>
                <th width="70px" align="right">LOT CAD</th>
            </tr>
        </thead>
        <tbody>
        ';
        $piezas = 0;
        
        foreach($query->result() as $row)
        {
            
            
            $tabla.= '<tr>
                <td width="70px">'.$row->clave.'</td>
                <td width="510px">'.$row->descripcion.'</td>
                <td width="70px" align="right">'.number_format($row->inv, 0).'</td>
                <td width="70px" align="left">'.$row->lote.' - '.formato_caducidad($row->caducidad).'</td>
            </tr>
            ';
            $piezas = $piezas + $row->inv;
        }
        
        $tabla.= '</tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">'.number_format($piezas, 0).'</td>
                <td align="right">&nbsp;</td>
            </tr>
        </tfoot>
        </table>';
        
        $tabla.= '<table align="center" border="0">
        <tr>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN ENTREGA<br /><br /><br />
            </td>
            <td width="360">
                NOMBRE Y FIRMA DE QUIEN RECIBE<br /><br /><br />
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        
        </table>';
        
        return $tabla;
    }

    function reporte_detalle_ajuste($id_ref)
    {
        $query = $this->ajuste_hist_detalle($id_ref);
        
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
                <th width="70px">Clave</th>
                <th width="150px">Descripcion</th>
                <th width="130px">Usuario</th>
                <th width="80px">Mensaje</th>
                <th width="70px" align="right">Piezas</th>
                <th width="70px" align="right">I.Ant.</th>
                <th width="70px" align="right">I.Nuevo</th>
                <th width="80px" align="right">LOT CAD</th>
            </tr>
        </thead>
        <tbody>
        ';
        
        foreach($query as $row)
        {
            
            
            $tabla.= '<tr>
                <td width="70px">'.$row->clave.'</td>
                <td width="150px">'.$row->descripcion.'</td>
                <td width="130px">'.$row->usuario.'</td>
                <td width="80px">'.$row->mensaje.'</td>
                <td width="70px" align="right">'.number_format($row->nueva - $row->vieja, 0).'</td>
                <td width="70px" align="right">'.number_format($row->vieja, 0).'</td>
                <td width="70px" align="right">'.number_format($row->nueva, 0).'</td>
                <td width="80px" align="left">'.$row->lote.' - '.formato_caducidad($row->caducidad).'</td>
            </tr>
            ';
        }
        
        $tabla.= '</tbody>
        </table>';
        
        $tabla.= '<table align="center" border="0">
        <tr>
            <td width="720">
                NOMBRE(S) Y FIRMA(S) DE QUIEN AJUSTA<br /><br /><br />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        
        </table>';
        
        return $tabla;
    }
    
    function negados($perini, $perfin)
    {
        $sql = "SELECT clave, descripcion, unidad, sum(canreq) as canreq, sum(cansur) as cansur, sum(cast(canreq as signed) - cast(cansur as signed)) as negados, inv FROM pedidos p
left join detalle d on p.id = d.p_id
left join inventario i on i.p_id = d.producto_id
where p.estatus = 3 and date(f_embarque) between ? and ?
group by clave
having sum(cast(canreq as signed) - cast(cansur as signed)) > 0
order by sum(cast(canreq as signed) - cast(cansur as signed)) desc;";

        return $this->db->query($sql, array($perini, $perfin));
    }
    
    function inserta_inv_csv($arr)
    {
        $this->db->insert_batch('inv_csv', $arr);
    }
    
    function get_inv_csv()
    {
        $this->db->select('i.clave, descripcion, unidad, sum(cant) as cant');
        $this->db->from('inv_csv i');
        $this->db->join('productos p', 'i.clave = p.clave', 'LEFT');
        $this->db->group_by('clave');
        
        return $this->db->get();
        
    }
    
    function eliminar_subida()
    {
        $this->db->query("delete from inv_csv;");
    }

    function subir_csv_entrada($arr)
    {
        $this->db->insert_batch('entradas', $arr);
    }    
}