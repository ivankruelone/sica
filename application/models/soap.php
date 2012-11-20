<?php
class Soap extends CI_Model {
    
    var $juris = null;
    var $numsuc = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
    }
    
    function get_servicios()
    {
        $this->db->select('w.id, w.nombre, w.url, w.namespace, origen, uso, estado');
        $this->db->from('servicios_web w');
        $this->db->join('servicios_web_tipo t', 'w.tipo = t.id', 'LEFT');
        $this->db->join('estados e', 'w.edo = e.estado_int', 'LEFT');
        return $this->db->get();
    }

    function get_servicio_activo()
    {
        $this->db->select('*');
        $this->db->from('servicios_web w');
        $this->db->where('uso', 1);
        return $this->db->get();
    }
    
    function get_servicio($id)
    {
        $this->db->select('*');
        $this->db->from('servicios_web w');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    function nuevo_servicio()
    {
        $this->db->where('nombre', $this->input->post('nombre'));
        $query = $this->db->get('servicios_web');
        
        if($query->num_rows() == 0){
        
            $data = new stdClass();
            
            $data->nombre = $this->input->post('nombre');
            $data->url = $this->input->post('url');
            $data->namespace = $this->input->post('namespace');
            $data->tipo = $this->input->post('tipo');
            $data->uso = 0;
            $data->edo = $this->input->post('estado');
            
            if($this->db->insert('servicios_web', $data))
            {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        
        }else{
            return 0;
        }
        
    }

    function modificar_servicio()
    {
            $data = new stdClass();
            
            $data->nombre = $this->input->post('nombre');
            $data->url = $this->input->post('url');
            $data->namespace = $this->input->post('namespace');
            $data->tipo = $this->input->post('tipo');
            $data->uso = 0;
            $data->edo = $this->input->post('estado');
            
            $this->db->where('id', $this->input->post('id'));
            
            if($this->db->update('servicios_web', $data))
            {
                return $this->db->affected_rows();
            }else{
                return 0;
            }
        
    }

    function get_sucursales_retail()
    {
        $res = $this->ws_listado_sucursales();
        $a = array();
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
            $a[0] ="Selecciona una opcion";
            
            foreach($xml->sucursal as $row)
            {
                $a[(int)$row->suc] = $row->suc." - ".$row->nombre;
            }
            
            
            
        }else{
            
        }
        
        return $a;
        
    }

    private function ws_listado_sucursales()
    {
        $res = $this->get_servicio_activo();
        $row = $res->row();
        
        
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client($row->url, FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS
            );
            
            
            $result = $client->call('sucursales', $params, $row->namespace, '');
            
            if($client->fault){
                
                return array('codigo' => 0, 'resultado' => 'Error en el constructor.');
                
            }else{
                
                $err1 = $client->getError();
                if($err1){
                    
                    return array('codigo' => 0, 'resultado' => 'No hay respuesta del Proveedor');

                }else{
                    
                    return array('codigo' => 1, 'resultado' => $result);
                    
                }
                

            }
            

        }

    }    

    function get_sucursal_retail_inv($sucursal)
    {
        $res = $this->ws_sucursal_inv($sucursal);
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
            //print_r($xml);
            
            return $xml;
            
            
            
        }else{
            
            return "Imposible Cargar Inventario debido a un error desconocido";
            
        }
        
        
    }

    private function ws_sucursal_inv($sucursal)
    {
        $res = $this->get_servicio_activo();
        $row = $res->row();
        
        
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client($row->url, FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS,
                'sucursal'      => $sucursal
            );
            
            
            $result = $client->call('inventario_sucursal', $params, $row->namespace, '');
            
            if($client->fault){
                
                return array('codigo' => 0, 'resultado' => 'Error en el constructor.');
                
            }else{
                
                $err1 = $client->getError();
                if($err1){
                    
                    return array('codigo' => 0, 'resultado' => 'No hay respuesta del Proveedor');

                }else{
                    
                    return array('codigo' => 1, 'resultado' => $result);
                    
                }
                

            }
            

        }

    }    

    function get_sucursal_retail_buffer($sucursal, $perini, $perfin)
    {
        $res = $this->ws_sucursal_buffer($sucursal, $perini, $perfin);
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
            //print_r($xml);
            
            return $xml;
            
            
            
        }else{
            
            return "Imposible Cargar Desplazamiento debido a un error desconocido";
            
        }
        
        
    }

    private function ws_sucursal_buffer($sucursal, $perini, $perfin)
    {
        $res = $this->get_servicio_activo();
        $row = $res->row();
        
        
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client($row->url, FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS,
                'sucursal'      => $sucursal,
                'perini'        => $perini,
                'perfin'        => $perfin
            );
            
            
            $result = $client->call('desplazamiento_sucursal', $params, $row->namespace, '');
            
            if($client->fault){
                
                return array('codigo' => 0, 'resultado' => 'Error en el constructor.');
                
            }else{
                
                $err1 = $client->getError();
                if($err1){
                    
                    return array('codigo' => 0, 'resultado' => 'No hay respuesta del Proveedor');

                }else{
                    
                    return array('codigo' => 1, 'resultado' => $result);
                    
                }
                

            }
            

        }

    }    

    function get_retail_buffer($perini, $perfin)
    {
        $res = $this->ws_buffer($perini, $perfin);
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
            //print_r($xml);
            
            return $xml;
            
            
            
        }else{
            
            return "Imposible Cargar Desplazamiento debido a un error desconocido";
            
        }
        
        
    }

    private function ws_buffer($perini, $perfin)
    {
        $res = $this->get_servicio_activo();
        $row = $res->row();
        
        
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client($row->url, FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS,
                'edo'           => $row->edo,
                'perini'        => $perini,
                'perfin'        => $perfin
            );
            
            
            $result = $client->call('desplazamiento', $params, $row->namespace, '');
            
            if($client->fault){
                
                return array('codigo' => 0, 'resultado' => 'Error en el constructor.');
                
            }else{
                
                $err1 = $client->getError();
                if($err1){
                    
                    return array('codigo' => 0, 'resultado' => 'No hay respuesta del Proveedor');

                }else{
                    
                    return array('codigo' => 1, 'resultado' => $result);
                    
                }
                

            }
            

        }

    }    

    function get_sucursal_retail_pedido($sucursal, $perini, $perfin)
    {
        $res = $this->ws_sucursal_pedido($sucursal, $perini, $perfin);
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
            //print_r($xml);
            
            return $xml;
            
            
            
        }else{
            
            return "Imposible Cargar Pedido debido a un error desconocido";
            
        }
        
        
    }

    private function ws_sucursal_pedido($sucursal, $perini, $perfin)
    {
        $res = $this->get_servicio_activo();
        $row = $res->row();
        
        
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client($row->url, FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS,
                'sucursal'      => $sucursal,
                'perini'        => $perini,
                'perfin'        => $perfin
            );
            
            
            $result = $client->call('pedido_sucursal', $params, $row->namespace, '');
            
            if($client->fault){
                
                return array('codigo' => 0, 'resultado' => 'Error en el constructor.');
                
            }else{
                
                $err1 = $client->getError();
                if($err1){
                    
                    return array('codigo' => 0, 'resultado' => 'No hay respuesta del Proveedor');

                }else{
                    
                    return array('codigo' => 1, 'resultado' => $result);
                    
                }
                

            }
            

        }

    }
    
    function guardar_pedido_retail($xml)
    {
        $xml = simplexml_load_string($xml);
        
        
        $sucursal = (int)$xml->attributes()->sucursal;
        $fecha = date('Y-m-d');
        
        $this->db->where('sucursal', $sucursal);
        $this->db->where('fecha', $fecha);
        
        $query = $this->db->get('pedidos_retail_c');
        
        
        
        if($query->num_rows() == 0)
        {
            $data = new stdClass();
            
            
            $data->fecha = $fecha;
            $data->estatus = 0;
            $data->sucursal = $sucursal;
            $data->user_id = $this->session->userdata('id');
            
            
            if($this->db->insert('pedidos_retail_c', $data))
            {
                $id = $this->db->insert_id();
                
                if((int)$id > 0){
                    
                    $data2 = new stdClass();
                    
                    foreach($xml->linea as $row){
                        
                        $data2->c_id = (int)$id;
                        $data2->clave = (string)$row->clave;
                        $data2->cantidad = (int)$row->cantidad;
                        
                        $this->db->insert('pedidos_retail', $data2);
                        
                        
                    }
                    
                    $sql = "update pedidos_retail p, productos s set p.clave_sica = s.clave where p.clave = s.clave and p.c_id = ?;";
                    $this->db->query($sql, $id);
                    
                    $sql2 = "update pedidos_retail p, productos s set p.clave_sica = s.clave where CAST(p.clave AS SIGNED) = REPLACE(s.clave, '.', '') and p.c_id = ? and p.clave_sica is null;";
                    $this->db->query($sql2, $id);
                }
                
                
                
                return $id;
                
            }else{
                return false;
            }
            
            
        }else{
            return false;
        }
        
        
        
        
    }
    
    function get_pedidos_generados()
    {
        $this->db->select('p.id, p.sucursal, p.fecha, p.estatus, p.cerrado, s.sucursal as nombre_suc, u.nombre as empleado');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc');
        $this->db->join('usuarios u', 'p.user_id = u.id');
        return $this->db->get();
    }

    function get_pedido_generado($id)
    {
        $this->db->select('p.id, p.sucursal, p.fecha, p.estatus, p.cerrado, s.sucursal as nombre_suc, u.nombre as empleado');
        $this->db->from('pedidos_retail_c p');
        $this->db->join('sucursales s', 'p.sucursal = s.numsuc');
        $this->db->join('usuarios u', 'p.user_id = u.id');
        $this->db->where('p.id', $id);
        return $this->db->get();
    }

    function get_pedido_generado_detalle($id)
    {
        $this->db->select('s.clave, s.descripcion, s.presentacion, cantidad');
        $this->db->from('pedidos_retail p');
        $this->db->join('productos s', 'p.clave_sica = s.clave');
        $this->db->where('p.c_id', $id);
        return $this->db->get();
    }
    
    function guarda_previo_buffer_completo($xml)
    {
        $this->db->where('edo', $xml->attributes()->edo);
        $this->db->delete('desplazamiento_estado_temp');

        $a = array();

        foreach($xml->producto as $row){
            
            $b = array(
                'edo' => (int)$xml->attributes()->edo,
                'perini' => (string)$xml->attributes()->perini,
                'perfin' => (string)$xml->attributes()->perfin,
                'clave_r' => (string)$row->clave,
                'clave' => null,
                'canreq' => (int)$row->canreq,
                'cansur' => (int)$row->cansur
                );
            
            array_push($a, $b);
            
        }
        
        $this->db->insert_batch('desplazamiento_estado_temp', $a);
        
        $sql = "update desplazamiento_estado_temp p, productos s set p.clave = s.clave where p.clave_r = s.clave and p.edo = ?;";
        $this->db->query($sql, (int)$xml->attributes()->edo);
                    
        $sql2 = "update desplazamiento_estado_temp p, productos s set p.clave = s.clave where CAST(p.clave_r AS SIGNED) = REPLACE(s.clave, '.', '') and p.edo = ? and (p.clave is null and p.clave_r not like '%S/C%');";
        $this->db->query($sql2, (int)$xml->attributes()->edo);

    }
    
    function guarda_desplazamiento_estado($estado)
    {
        $this->db->delete('desplazamiento_estado', array('edo' => $estado));
        $sql = "insert into desplazamiento_estado (SELECT edo, perini, perfin, clave_r, clave, sum(canreq) as canreq, sum(cansur) as cansur FROM desplazamiento_estado_temp d where edo = ? group by clave_r);";
        $this->db->query($sql, $estado);
    }
    
    function get_desplazamiento()
    {
        $sql = "SELECT d.clave, descripcion, unidad, sum(canreq) as canreq, sum(cansur) as cansur FROM desplazamiento_estado d
join productos p on d.clave = p.clave
group by clave
order by p.tipo_producto, clave;";
        return $this->db->query($sql);
    }
    
    function get_periodo_desplazamiento()
    {
        $sql = "SELECT edo, perini, perfin, estado
FROM desplazamiento_estado d
left join estados e on d.edo = e.estado_int
group by edo, perini, perfin;";
        return $this->db->query($sql);
    }
}