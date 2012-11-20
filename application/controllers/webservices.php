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

}

/* End of file webservices.php */
/* Location: ./application/controllers/webservices.php */