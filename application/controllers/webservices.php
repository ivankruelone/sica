<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservices extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('soap');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	public function index($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Servicios Disponibles';
       $data['contenido'] = 'webservices/entrada';
       $data['query'] = $this->soap->get_servicios();
       $this->load->view('main', $data);
	}

    function nuevo_servicio($submenu)
    {
        $data['menu'] = 1;
        $data['submenu'] = $submenu;
        $data['titulo'] = 'Agregar Servicio Web';
        $data['contenido'] = 'webservices/nuevo_servicio';
        $data['js'] = 'webservices/nuevo_servicio_js';
        $data['tipos'] = $this->comun->tipo_servicio_web();
        $data['sino'] = $this->comun->si_no();
        $data['estados'] = $this->comun->estados_combo_todos();
        $this->load->view('main', $data);
    }
    
    function nuevo_servicio_submit()
    {
        echo $this->soap->nuevo_servicio();
    }
    
    function modificar_servicio($id, $submenu)
    {
        $data['menu'] = 1;
        $data['submenu'] = $submenu;
        $data['titulo'] = 'Modificar Servicio Web';
        $data['contenido'] = 'webservices/modificar_servicio';
        $data['js'] = 'webservices/modificar_servicio_js';
        $data['tipos'] = $this->comun->tipo_servicio_web();
        $data['sino'] = $this->comun->si_no();
        $data['estados'] = $this->comun->estados_combo_todos();
        $data['query'] = $this->soap->get_servicio($id);
        $this->load->view('main', $data);
    }
    
    function modificar_servicio_submit()
    {
        echo $this->soap->modificar_servicio();
    }

    function asignar($id, $submenu)
    {
        $data = new stdClass();
        $data->uso = 0;
        $this->db->update('servicios_web', $data);
        
        $data2 = new stdClass();
        $data2->uso = 1;
        $this->db->where('id', $id);
        $this->db->update('servicios_web', $data2);
        
        $this->index($submenu);
        
    }

	public function metodos($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Metodos Disponibles';
       $data['contenido'] = 'webservices/metodos';
       $data['query'] = $this->soap->get_servicio_activo();
       $this->load->view('main', $data);
	}

	public function retail_inv($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Inventario en Retail';
       $data['contenido'] = 'webservices/retail_inv';
       $data['js'] = 'webservices/retail_inv_js';
       $data['sucursales'] = $this->soap->get_sucursales_retail();
       $this->load->view('main', $data);
	}
    
	public function retail_buffer($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Desplazamiento en Retail x Sucursal';
       $data['contenido'] = 'webservices/retail_buffer';
       $data['js'] = 'webservices/retail_buffer_js';
       $data['sucursales'] = $this->soap->get_sucursales_retail();
       $this->load->view('main', $data);
	}

	public function retail_buffer_completo($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Desplazamiento en Retail del Estado';
       $data['contenido'] = 'webservices/retail_buffer_completo';
       $data['js'] = 'webservices/retail_buffer_completo_js';
       $this->load->view('main', $data);
	}
    
	public function catalogo($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Catalogo de Productos';
       $data['contenido'] = 'webservices/catalogo';
       $data['xml'] = $this->soap->get_catalogo();
       print_r($data['xml']);
       
       //$this->load->view('main', $data);
	}
    
    function prueba()
    {
        $xml = $this->soap->ws_catalogo();
        echo "<pre>";
        print_r($xml);
        echo "</pre>";
    }

    public function guardar_desplazamiento_estado($estado)
    {
        $this->soap->guarda_desplazamiento_estado($estado);
    }

	public function retail_pedido($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Desplazamiento en Retail';
       $data['contenido'] = 'webservices/retail_pedido';
       $data['js'] = 'webservices/retail_pedido_js';
       $data['sucursales'] = $this->soap->get_sucursales_retail();
       $this->load->view('main', $data);
	}

	public function desplazamiento($submenu)
	{
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Desplazamiento Total Recetas';
       $data['contenido'] = 'webservices/desplazamiento';
       $data['query'] = $this->soap->get_desplazamiento();
       $data['query2'] = $this->soap->get_periodo_desplazamiento();
       $this->load->view('main', $data);
	}

    function get_inv_retail()
    {
        $sucursal = $this->input->post('sucursal');
        $data['xml'] = $this->soap->get_sucursal_retail_inv($sucursal);
        $this->load->view('webservices/retail_inv_resultado', $data);
    }

    function get_buffer_retail()
    {
        $sucursal = $this->input->post('sucursal');
        $perini = $this->input->post('perini');
        $perfin = $this->input->post('perfin');
        $data['xml'] = $this->soap->get_sucursal_retail_buffer($sucursal, $perini, $perfin);
        $this->load->view('webservices/retail_buffer_resultado', $data);
    }

    function get_buffer_completo_retail()
    {
        $perini = $this->input->post('perini');
        $perfin = $this->input->post('perfin');
        $xml = $this->soap->get_retail_buffer($perini, $perfin);
        $data['xml'] = $xml;
        $this->soap->guarda_previo_buffer_completo($xml);
        $this->load->view('webservices/retail_buffer_completo_resultado', $data);
    }

    function get_pedido_retail()
    {
        $sucursal = $this->input->post('sucursal');
        $perini = $this->input->post('perini');
        $perfin = $this->input->post('perfin');
        $data['xml'] = $this->soap->get_sucursal_retail_pedido($sucursal, $perini, $perfin);
        $this->load->view('webservices/retail_pedido_resultado', $data);
    }
    
    function previo_pedido_retail()
    {
	   $data['menu'] = 1;
       $data['submenu'] = 1.2;
       $this->session->keep_flashdata('pedido');
       $data['titulo'] = 'Previo de Pedido';
       $data['contenido'] = 'webservices/retail_previo_pedido';
       $data['xml'] = $this->session->flashdata('pedido');
       //$data['js'] = 'webservices/retail_previo_pedido_js';
       $this->load->view('main', $data);
    }
    
    function guardar_pedido_retail()
    {
        $this->session->keep_flashdata('pedido');
        $res = $this->soap->guardar_pedido_retail($this->session->flashdata('pedido'));
        redirect('webservices/pedido_generado_detalle/'.$res.'/1.2');
    }
    
    function retail_pedidos_generados($submenu)
    {
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Pedidos Generados';
       $data['contenido'] = 'webservices/pedidos_generados';
       $data['query'] = $this->soap->get_pedidos_generados();
       $this->load->view('main', $data);
    }

    function pedido_generado_detalle($id, $submenu)
    {
	   $data['menu'] = 1;
       $data['submenu'] = $submenu;
       $data['titulo'] = 'Pedido Generado';
       $data['contenido'] = 'webservices/pedido_generado_detalle';
       $data['query'] = $this->soap->get_pedido_generado($id);
       $data['query2'] = $this->soap->get_pedido_generado_detalle($id);
       $this->load->view('main', $data);
    }
    
    function automaticos($res = 0, $tipo = null)
    {
	   $data['menu'] = 4;
       $data['submenu'] = 4.9;
       $data['titulo'] = 'Pedidos automaticos';
       $data['contenido'] = 'webservices/pedidos_automaticos_portada';
       $mensaje = null;
       
       if($res == 0){
        $mensaje = "Hola";
       }elseif($res == 1){
        $mensaje = "Pedidos generados correctamente";
       }elseif($res == 2){
        $mensaje = "No hay sucursales configuradas para pedido el dia de hoy";
       }elseif($res == 3){
        $mensaje = "Ya has generado pedidos el dia de hoy, para generar nuevamente debes borrarlos primero.";
       }elseif($res == 4){
        $mensaje = "Los pedidos han sido cerrados correctamente, favor de verificarlos en el menu de pedidos con fecha del dia de hoy.";
       }elseif($res == 5){
        $mensaje = "Los pedidos de hoy ya han sido procesados y cerrados.";
       }elseif($res == 6){
        $mensaje = "No hay nada que procesar por el momento.";
       }
       
       $this->load->model('sucursales_model');
       $data['query'] = $this->sucursales_model->get_sucurales_auto_hoy();
       $data['row'] = $this->comun->settings();
       $data['mensaje'] = $mensaje;
       $data['tipo'] = $tipo;
       $this->load->view('main', $data);
    }
    
    function generar_automaticos()
    {
        $this->load->model('sucursales_model');
        
        $sql = "SELECT id FROM pedidos_retail_c p where fecha = date(now());";
        $q = $this->db->query($sql);
        
        if($q->num_rows() > 0){
            
            redirect('webservices/automaticos/3/warning');
            
        }else{

            $query = $this->sucursales_model->get_sucurales_auto_hoy();
            $row2 = $this->comun->settings();
            
            if($query->num_rows() > 0){
    
                foreach($query->result() as $row)
                {
                    $xml = $this->soap->get_sucursal_retail_pedido($row->numsuc, $row2->perini, $row2->perfin);
                    $xml2 = $this->soap->genera_xml_temp($xml);
                    $this->soap->guardar_pedido_retail($xml2);
                }
                
                redirect('webservices/automaticos/1/success');
                
            }else{
                
                redirect('webservices/automaticos/2/warning');
                
            }
            
        }



        
    }

}

/* End of file webservices.php */
/* Location: ./application/controllers/webservices.php */