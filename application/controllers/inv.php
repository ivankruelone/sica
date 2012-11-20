<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inv extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('inv_model');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function index()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.1;
       $data['titulo'] = 'Inventario Productos';
       $data['query'] = $this->inv_model->catalogo();
       $data['contenido'] = 'inv/catalogo';
       $data['js'] = 'inv/js_catalogo';
       $this->load->view('main', $data);
        
	}
    
    function inv_excel()
    {
        $this->load->view('excel/inventario');
    }
    
	function inv_clasificado_elige()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.15;
       $data['titulo'] = 'Inventario Productos segun su tipo';
       $data['contenido'] = 'inv/inv_clasificado_elige';
       $data['elige'] = $this->comun->combo_tipo_subtipo();
       $this->load->view('main', $data);
        
	}

	function inv_clasificado()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.15;
       $data['titulo'] = 'Inventario Productos';
       $data['query'] = $this->inv_model->catalogo();
       $data['contenido'] = 'inv/catalogo_clasificado';
       $data['js'] = 'inv/js_catalogo';
       $this->load->view('main', $data);
        
	}

    function inv_imprimir()
    {
        set_time_limit(0);
        $data['header'] = $this->inv_model->reporte_header_inv();
        $data['detalle'] = $this->inv_model->reporte_detalle_inv();
        $this->load->view('impresiones/inv_ini', $data);
        
    }

    function inv_clasificado_imprimir($tipo, $subtipo)
    {
        set_time_limit(0);
        $data['header'] = $this->inv_model->reporte_header_inv($tipo, $subtipo);
        $data['detalle'] = $this->inv_model->reporte_detalle_inv($tipo, $subtipo);
        $this->load->view('impresiones/inv_ini', $data);
        
    }
    
    //Empieza Ajustes

	function ajuste()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.13;
       $data['titulo'] = 'Ajuste de Inventario';
       $data['query'] = $this->inv_model->ajuste();
       $data['contenido'] = 'inv/ajuste';
       $data['js'] = 'inv/js_ajuste';
       $this->load->view('main', $data);
        
	}
    
	function ajuste_area()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.16;
       $data['titulo'] = 'Ajuste de Inventario por area';
       $data['elige'] = $this->comun->combo_tipo_subtipo();
       $data['contenido'] = 'inv/ajuste_area_elige';
       $this->load->view('main', $data);
        
	}

	function ajuste_area_claves()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.16;
       $data['titulo'] = 'Ajuste de Inventario';
       $data['query'] = $this->inv_model->ajuste();
       $data['contenido'] = 'inv/ajuste';
       $data['js'] = 'inv/js_ajuste';
       $this->load->view('main', $data);
        
	}

	function ajuste_hist()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.14;
       $data['titulo'] = 'Historico de Ajustes de Inventario';
       $data['query'] = $this->inv_model->ajuste_hist();
       $data['contenido'] = 'inv/ajuste_hist';
       $this->load->view('main', $data);
        
	}

	function ajuste_hist_detalle($id_ref)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.14;
       $data['titulo'] = 'Historico de Ajustes de Inventario a Detalle';
       $data['query'] = $this->inv_model->ajuste_hist_detalle($id_ref);
       $data['id_ref'] = $id_ref;
       $data['contenido'] = 'inv/ajuste_hist_detalle';
       $this->load->view('main', $data);
        
	}

    function ajuste_hist_detalle_imprimir($id_ref)
    {
        set_time_limit(0);
        $data['header'] = $this->inv_model->reporte_header_ajuste($id_ref);
        $data['detalle'] = $this->inv_model->reporte_detalle_ajuste($id_ref);
        $this->load->view('impresiones/ajuste', $data);
        
    }

    function ajuste_cambia()
    {
        $id = $this->input->post('id');
        $valor = $this->input->post('valor');
        
        echo $this->inv_model->ajuste_cambia($id, $valor);
    }
    
	function preajuste()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.17;
       $data['titulo'] = 'Ajuste de Inventario por area';
       $data['elige'] = $this->comun->combo_preajuste_areas();
       $data['query'] = $this->inv_model->preajuste_areas();
       $data['contenido'] = 'inv/preajuste_area_elige';
       $data['js'] = 'inv/preajuste_area_elige_js';
       $this->load->view('main', $data);
        
	}

	function preajuste_area_claves()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.17;
       $data['titulo'] = 'Pre-Ajuste de Inventario por area';
       $data['query'] = $this->inv_model->preajuste($this->input->post('elige'));
       $data['etiq'] = $this->comun->titulo_area($this->input->post('elige'));
       $data['contenido'] = 'inv/preajuste';
       $data['js'] = 'inv/js_preajuste';
       $this->load->view('main', $data);
        
	}

    function preajuste_cambia()
    {
        $id = $this->input->post('id');
        $valor = $this->input->post('valor');
        
        echo $this->inv_model->preajuste_cambia($id, $valor);
    }
    
    function sdjkdfowfjjyuwfjkofhjefqwf()
    {
        //Actualiza Inv desde preajuste
        $palabra = $this->input->post('palabra');
        $user_id = $this->session->userdata('id');
        $fecha = date('Ymd');
        $hash = "sicasys";
        
        $palabra2 = str_replace($fecha, '', $palabra);
        if(((string)$palabra2 == (string)$hash && $user_id == 1 && $this->checar_cierres() == 1) || ((string)$palabra2 == (string)$hash && $user_id == 7 && $this->checar_cierres() == 1))
        {
            echo $this->ejecuta_ajuste_preajuste();
        }else{
            echo 0;
        }
        
    }
    
    function dkufhsdfksdjfhksdjfhsdfkjsdhf()
    {
        //Actualiza Inv desde inventario csv
        $palabra = $this->input->post('palabra');
        $user_id = $this->session->userdata('id');
        $fecha = date('Ymd');
        $hash = "sicasys";
        
        $palabra2 = str_replace($fecha, '', $palabra);
        if(((string)$palabra2 == (string)$hash && $user_id == 1) || ((string)$palabra2 == (string)$hash && $user_id == 7))
        {
            echo $this->ejecuta_ajuste_inv_csv();
        }else{
            echo 0;
        }
        
    }

    private function checar_cierres()
    {
        $this->db->select_max('fecha');
        $q = $this->db->get('inv_temp_cierres');
        $r = $q->row();
        
        $sql = "SELECT DATEDIFF(date(now()), '$r->fecha') as dias; ";
        $q2 = $this->db->query($sql);
        
        $r2 = $q2->row();
        //echo $r2->dias;
        
        if($r2->dias == null || $r2->dias >= 7)
        {
            return 1;
        }else{
            return 0;
        }
        
        
        
    }
    
    private function ejecuta_ajuste_preajuste()
    {
        $sql = "update 
        inventario i, productos p, preajuste_areas a 
        set i.inv = cant, 
        i.modificado=now(), 
        i.tipo = 3, 
        i.subtipo = 300, 
        i.idref = date_format(now(), '%Y%m%d'), 
        i.sucursal_id = 0, 
        i.proveedor_id = 0, 
        i.user_id = ? 
        where i.p_id = p.id and p.clave = a.clave;";
        
        if($this->db->query($sql, $this->session->userdata('id'))){
            
            $data = new stdClass();
            
            $data->fecha = date('Y-m-d');
            $this->db->insert('inv_temp_cierres', $data);
            
           return 1; 
        }else{
            return 0;
        }
        
    }
    
    private function ejecuta_ajuste_inv_csv()
    {
        $sql = "update 
        inventario i, productos p, ajuste_inv_csv a 
        set i.inv = cant, 
        i.modificado=now(), 
        i.tipo = 3, 
        i.subtipo = 300, 
        i.idref = date_format(now(), '%Y%m%d'), 
        i.sucursal_id = 0, 
        i.proveedor_id = 0, 
        i.user_id = ? 
        where i.p_id = p.id and p.clave = a.clave;";
        
        if($this->db->query($sql, $this->session->userdata('id'))){
           return 1; 
        }else{
            return 0;
        }
        
    }

    function sdfkjsdfjkdfjkdfhfdjsdfkjhdfgjkdfgjk()
    {
        $palabra = $this->input->post('palabra');
        echo $this->poner_a_cero_preajuste($palabra);
        
    }
    
    private function poner_a_cero_preajuste($palabra)
    {
        if($palabra == "poneracero"){
            
            $data = new stdClass();
            $data->cant = 0;
            
            if($this->db->update('inv_temp', $data)){
                
                $this->comun->agregar_claves();
                
                return 1;
            }else{
                return 0;
            }
            
            
        }else{
            return 0;
        }
    }
    
    //Termina Ajustes

    function inv_detalle_modal($id){
        $data['query'] = $this->inv_model->detalle_modal($id);
        $this->load->view('inv/inv_detalle_modal', $data);
    }
    
    //Empieza Inventario Inicial

	function inicial($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Captura de Inventario Inicial';
       $data['contenido'] = 'inv/captura_invini';
       $data['row'] = $this->inv_model->get_invi_ini_c();
       $data['anios_validos'] = $this->comun->anios_validos();
       $data['js'] = 'inv/js_captura_invini';
       $this->load->view('main', $data);
        
	}
    
    function submit_captura_clave_invini()
    {
        $this->inv_model->submit_captura_clave_invini();
        $data['query'] = $this->inv_model->get_productos_invini('i.modi', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/invini_detalle', $data);
    }

    function detalle_invini()
    {
        $data['query'] = $this->inv_model->get_productos_invini('i.modi', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/invini_detalle', $data);
    }

    function borra_detalle_invini()
    {
        $res = $this->inv_model->borra_detalle_invini($this->input->post('id'));
        echo $res;
    }
    
    function cerrar_invini()
    {
        $data['res'] = $this->inv_model->cerrar_invini();
        $this->load->view('pedidos/resultado', $data);
    }
    
    //Termina Inventario Inicial
    
    //Empieza Entradas

	function entradas($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Entradas de Mercancia';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = 2;
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function entradas_historico($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Entradas de Mercancia';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = 2;
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 1);
       $this->load->view('main', $data);
        
	}

	function nueva_entrada_planta($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nueva Entrada de Mercancia';
       $data['contenido'] = 'inv/nueva_entrada_planta';
       $data['js'] = 'inv/js_nueva_entrada_planta';
       $this->load->view('main', $data);
	}

    function submit_nueva_entrada_planta()
    {
        $id = $this->inv_model->nueva_entrada();
        redirect('inv/entrada_precio/'.$id.'/'.$this->input->post('submenu'));
    }
    
    function submit_nueva_entrada_devo()
    {
        $id = $this->inv_model->nueva_entrada();
        redirect('inv/entrada/'.$id.'/'.$this->input->post('submenu'));
    }

	function entrada($id, $submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Hoja de Captura';
       $data['contenido'] = 'inv/captura_entrada';
       $data['row'] = $this->inv_model->get_entrada($id);
       $data['anios_validos'] = $this->comun->anios_validos();
       $data['js'] = 'inv/js_captura_entrada';
       $this->load->view('main', $data);
        
	}
    
	function entrada_precio($id, $submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Hoja de Captura';
       $data['contenido'] = 'inv/captura_entrada_precio';
       $data['row'] = $this->inv_model->get_entrada($id);
       $data['anios_validos'] = $this->comun->anios_validos();
       $data['js'] = 'inv/js_captura_entrada_precio';
       $this->load->view('main', $data);
        
	}

    function submit_captura_clave_entrada()
    {
        $this->inv_model->submit_captura_clave_entrada();
        $data['query'] = $this->inv_model->get_productos_entrada($this->input->post('id'), 'i.mod', 'DESC');
        $data['query2'] = $this->inv_model->get_productos_entrada_rechazados($this->input->post('id'), 'i.mod', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/entrada_detalle', $data);
    }

    function submit_captura_clave_entrada_precio()
    {
        $this->inv_model->submit_captura_clave_entrada();
        $data['query'] = $this->inv_model->get_productos_entrada($this->input->post('id'), 'i.mod', 'DESC');
        $data['query2'] = $this->inv_model->get_productos_entrada_rechazados($this->input->post('id'), 'i.mod', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/entrada_detalle_precio', $data);
    }

    function detalle_entrada()
    {
        $data['query'] = $this->inv_model->get_productos_entrada($this->input->post('id'), 'i.mod', 'DESC');
        $data['query2'] = $this->inv_model->get_productos_entrada_rechazados($this->input->post('id'), 'i.mod', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/entrada_detalle', $data);
    }

    function detalle_entrada_precio()
    {
        $data['query'] = $this->inv_model->get_productos_entrada($this->input->post('id'), 'i.mod', 'DESC');
        $data['query2'] = $this->inv_model->get_productos_entrada_rechazados($this->input->post('id'), 'i.mod', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('inv/entrada_detalle_precio', $data);
    }

    function borra_detalle_entrada()
    {
        $res = $this->inv_model->borra_detalle_entrada($this->input->post('id'));
        echo $res;
    }
    
    function borra_detalle_entrada_rechazada()
    {
        $res = $this->inv_model->borra_detalle_entrada_rechazada($this->input->post('id'));
        echo $res;
    }

    function cerrar_entrada()
    {
        echo $this->inv_model->cerrar_entrada($this->input->post('id'));
        //$this->load->view('pedidos/resultado', $data);
    }
    
    function cancela_folio($id)
    {
        $motivo = $this->input->post('motivo');
        echo $this->inv_model->cancela_folio($id, $motivo);
    }
    
    //Termina entradas
    
    //DEVOLUCIONES

	function devo($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Devoluciones de Mercancia por excedente';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = 3;
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function devo_sucursales_merma($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Devoluciones de Mercancia de sucursales por merma';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = array(401, 402);
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function devo_almacen_merma($submenu)
	{
	   $data['menu'] = 9;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Devoluciones de Mercancia de almacen por merma';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = array(102, 103, 104, 105);
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function nueva_devo($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nueva Devolucion de Mercancia por excedente';
       $data['contenido'] = 'inv/nueva_devo';
       $data['js'] = 'inv/js_nueva_devo';
       $data['subtipo'] = 3;
       $this->load->view('main', $data);
	}

	function nueva_devo_sucursales_merma($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nueva Devolucion de Mercancia de Sucursales por Merma';
       $data['contenido'] = 'inv/nueva_devo_sucursales_merma';
       $data['js'] = 'inv/js_nueva_devo_sucursales_merma';
       $data['sucursales'] = $this->comun->suc_combo();
       $data['subtipos'] = $this->comun->devo_suc_merma_combo();
       $this->load->view('main', $data);
	}

	function nueva_devo_almacen_merma($submenu)
	{
	   $data['menu'] = 9;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nueva Devolucion de Mercancia de Almacen por Merma';
       $data['contenido'] = 'inv/nueva_devo_almacen_merma';
       $data['js'] = 'inv/js_nueva_devo_almacen_merma';
       $data['proveedores'] = $this->comun->proveedores_drop();
       $data['subtipos'] = $this->comun->devo_alm_merma_combo();
       $this->load->view('main', $data);
	}

    //Proveedores

	function proveedor($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Entrada de Mercancia de un Proveedor';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = 4;
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function nueva_proveedor($submenu)
	{
	   $data['menu'] = 8;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nueva Entrada de Mercancia por un Proveedor';
       $data['contenido'] = 'inv/nueva_proveedor_precio';
       $data['js'] = 'inv/js_nueva_proveedor_precio';
       $data['subtipo'] = 4;
       $data['proveedor'] = $this->comun->proveedores_drop();
       $this->load->view('main', $data);
	}

    //Transpasos

	function transpasos($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Transpaso de Mercancia a otra bodega';
       $data['contenido'] = 'inv/entradas';
       $data['js'] = 'inv/js_entradas';
       $data['subtipo'] = 102;
       $data['query'] = $this->inv_model->get_entradas($data['subtipo'], 0);
       $this->load->view('main', $data);
        
	}

	function nuevo_transpaso($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nuevo Transpaso de Mercancia a otra bodega';
       $data['contenido'] = 'inv/nuevo_transpaso';
       $data['js'] = 'inv/js_nueva_devo';
       $data['subtipo'] = 102;
       $data['proveedor'] = $this->comun->proveedores_drop();
       $this->load->view('main', $data);
	}

    function movimiento_excel($id)
    {
        $data['row'] = $this->inv_model->get_entrada($id);
        $data['query'] = $data['query'] = $this->inv_model->get_productos_entrada($id, 'i.mod', 'DESC');
        $this->load->view('excel/movimiento', $data);
    }
    
   	function do_upload_formato()
	{
        $this->load->helper('path');
        $directory = './uploads';
        $id = $this->input->post('id');
        $submenu = $this->input->post('submenu');

		if ($_FILES["file"]["error"] > 0)
        {
            redirect('inv/entrada/'.$id.'/'.$submenu);
        }else{
            
            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);
            
            if($extension == 'csv'){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])){
                    
                    $filePath = './uploads/' . $_FILES["file"]["name"];
                    
                    $row = 1;
                    if (($handle = fopen($filePath, "r")) !== FALSE) {
                        
                        $a = array();
                        
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            //echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                            }
                            
                            //id, e_id, lote, caducidad, piezas, empresa, mod, p_id, precio, iva
                            $this->db->select('id');
                            $this->db->where('clave', $data[0]);
                            $q1 = $this->db->get('productos');
                            
                            if($q1->num_rows() > 0){
                                
                                $r1 = $q1->row();
                            
                                $b = array(
                                    'e_id' => $id,
                                    'lote' => $data[2],
                                    'caducidad' => $data[3],
                                    'piezas' => $data[1],
                                    'empresa' => 0,
                                    'mod' => date('Y-m-d H:i:s'),
                                    'p_id' => $r1->id,
                                    'precio' => 0,
                                    'iva' => 0
                                    );
                                    
                                array_push($a, $b);
                            
                            }
                            
                        }
                        $this->inv_model->subir_csv_entrada($a);
                        fclose($handle);
                        redirect('inv/entrada/'.$id.'/'.$submenu);
                    }
                }
            }else{
                redirect('inv/entrada/'.$id.'/'.$submenu);
            }
            
            
            
        }
	}

    //Termina Transpaso
    
    //Kardex
	function kardex($submenu)
	{
	   $data['menu'] = 3;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Kardex';
       $data['contenido'] = 'inv/kardex';
       $data['js'] = 'inv/js_kardex';
       $data['claves'] = $this->comun->productos_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_kardex()
    {
        $this->load->model('productos_model');
        $clave = $this->input->post('clave');
        
        $sql = "SELECT k.*, movimiento, clave, SUBSTRING(descripcion, 1, 25) as descripcion, sucursal, razon, u.nombre as usuario
        FROM kardex k
left join productos p on k.p_id = p.id
left join movimientos m on k.tipo = m.tipo and k.subtipo = m.subtipo
left join sucursales s on k.sucursal_id = s.numsuc
left join proveedores o on k.proveedor_id = o.id
left join usuarios u on k.user_id = u.id
where
clave = '$clave'
order by k.id asc;";
        
        $query = $this->db->query($sql);
        $data['query'] = $query->result();
        $data['producto'] = $this->productos_model->producto_clave($clave);
        $data['kardex_ajustes'] = $this->inv_model->kardex_ajuste($clave);
        $this->load->view('inv/kardex_busca', $data);
        
        
    }

    function reporte($id)
    {
        $data['header'] = $this->inv_model->reporte_header($id);
        $data['detalle'] = $this->inv_model->reporte_detalle($id);
        $this->load->view('impresiones/folios', $data);
    }

    function reporte_inv_ini()
    {
        set_time_limit(0);
        $data['header'] = $this->inv_model->reporte_header_inv_ini();
        //$data['detalle'] = "hola";
        $data['detalle'] = $this->inv_model->reporte_detalle_inv_ini();
        $this->load->view('impresiones/inv_ini', $data);
        
        //echo $this->inv_model->reporte_detalle($id);
    }
    
    function get_json_kardex($id)
    {
        header("Content-type: text/json");
        $this->db->select('unix_timestamp(modiicada) as fecha, extract(year from modiicada) as anio, extract(month from modiicada) as mes, extract(day from modiicada) as dia, extract(HOUR from modiicada) as horas, extract(MINUTE from modiicada) as minuto, extract(SECOND from modiicada) as segundo, nueva as inventario');
        $this->db->where('p_id', $id);
        $query = $this->db->get('kardex');
        
        $a = "[";
        
        foreach($query->result() as $row)
        {
            //$a.= "[Date.UTC(".$row->anio.",".$row->mes.",".$row->dia.",".$row->horas.",".$row->minuto.",".$row->segundo."),".$row->inventario."],";
            $a.= "[".($row->fecha*1000).",".$row->inventario."],";
        }
        
        $a = substr($a, 0, -1); 
        
        $a.="]";
        
        
        echo $a;
        
    }
    
    function get_sucursales()
    {
        $res = $this->ws_listado_sucursales();
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        
        if($res['codigo'] == 1){
            
            $xml = simplexml_load_string($res['resultado']);
            
                echo "<pre>";
                print_r($xml);
                echo "</pre>";
            
            
        }
        
    }

    private function ws_listado_sucursales()
    {
        require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nusoap
        
        $client = new nusoap_client("http://148.244.66.236/aguascalientes/nusoap/servicios/retail.php", FALSE, '', '', '', '', '', 40);
        $client->soap_defencoding = 'UTF-8';
        $err = $client->getError();
        
        if($err)
        {
            return $err;
        
        }else{
            
            $params = array(
                'usuario'       => USER_SERVICIOS,
                'password'      => PASS_SERVICIOS,
                'sucursal'      => 14005,
                'perini'        => '2012-10-01',
                'perfin'        => '2012-10-15'
            );
            
            
            $result = $client->call('desplazamiento_sucursal', $params, "urn:retail", '');
            
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

	function subida()
	{
	   $data['menu'] = 3;
	   $data['submenu'] = 3.13;
       $data['titulo'] = 'Subida de Inventario a partir de un archivo CSV';
       $data['contenido'] = 'inv/subida';
       $data['js'] = 'inv/subida_js';
       $data['query'] = $this->inv_model->get_inv_csv();
       $this->load->view('main', $data);
        
	}

	function do_upload_subida()
	{
        $this->load->helper('path');
        $directory = './uploads';
        $submenu = $this->input->post('submenu');

		if ($_FILES["file"]["error"] > 0)
        {
            redirect('inv/subida/');
        }else{
            
            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);
            
            if($extension == 'csv'){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])){
                    
                    $filePath = './uploads/' . $_FILES["file"]["name"];
                    
                    $row = 1;
                    $a = array();
                    
                    if (($handle = fopen($filePath, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            //echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                            }
                            
                            //clave, cant, id
                            $b = array(
                                'clave' => $data[0],
                                'cant' => $data[1]
                                );
                            
                            array_push($a, $b);
                            
                            
                        }
                        $this->inv_model->inserta_inv_csv($a);
                        //$this->pedidos_model->procesar_subida($id);
                        fclose($handle);
                        redirect('inv/subida/');
                    }
                }
            }else{
                redirect('inv/subida/');
            }
            
            
            
        }
	}
    
    function subida_eliminar()
    {
        $this->inv_model->eliminar_subida();
        redirect('inv/subida/');
    }

}
/* End of file inv.php */
/* Location: ./application/controllers/inv.php */