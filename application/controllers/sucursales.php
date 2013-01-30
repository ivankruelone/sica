<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('sucursales_model');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function tipos()
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.2;
       $data['titulo'] = 'Catalogo de Tipos';
       $data['query'] = $this->sucursales_model->tipos();
       $data['contenido'] = 'sucursales/tipos';
       $this->load->view('main', $data);
	}

	function nuevo_tipo()
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.2;
       $data['titulo'] = 'Nuevo Tipo';
       $data['contenido'] = 'sucursales/nuevo_tipo';
       $this->load->view('main', $data);
	}
    
    function submit_nuevo_tipo()
    {
        
    }

	function juris()
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.3;
       $data['titulo'] = 'Catalogo de Jurisdicciones';
       $data['query'] = $this->sucursales_model->juris();
       $data['contenido'] = 'sucursales/juris';
       $this->load->view('main', $data);
	}

	function catalogo()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/sucursales/catalogo/';
       $config['total_rows'] = $this->sucursales_model->catalogo_rows();
       $config['per_page'] = 500;
       $this->pagination->initialize($config); 
	   
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Catalogo de Sucursales';
       $data['query'] = $this->sucursales_model->catalogo($config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'sucursales/catalogo';
       $data['js'] = 'sucursales/js_catalogo';
       $this->load->view('main', $data);
        
	}

	function nueva_sucursal()
	{
	   $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Nueva Sucursal';
       $data['contenido'] = 'sucursales/nueva_sucursal';
       $data['js'] = 'sucursales/js_nueva_sucursal';
       $data['cias'] = $this->comun->cias_combo();
       $data['estados'] = $this->comun->estados_combo();
       $data['dias'] = $this->comun->dias_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_nueva_sucursal()
    {
        echo $this->sucursales_model->insert_sucursal();
    }

	function editar_sucursal($id, $submenu)
	{
	   $data['menu'] = 5;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Editar Sucursal';
       $data['row'] = $this->sucursales_model->get_sucursal($id);
       $data['contenido'] = 'sucursales/editar_sucursal';
       $data['js'] = 'sucursales/js_editar_sucursal';
       $data['cias'] = $this->comun->cias_combo();
       $data['estados'] = $this->comun->estados_combo();
       $data['juris'] = $this->comun->juris_combo($id);
       $data['dias'] = $this->comun->dias_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_editar_sucursal()
    {
        echo $this->sucursales_model->update_sucursal();
    }

    function busca_sucursales_autocomplete()
    {
        $query = $this->sucursales_model->autocomplete($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"numsuc":"'.$row->numsuc.'","value":"'.$row->numsuc.' - '.$row->sucursal.'"},';
        }
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }

	function consignar($id, $submenu)
	{
       $data['menu'] = 5;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Catalogo de Domicilios a Consignar';
       $data['query'] = $this->clientes_model->consignar($id);
       $data['contenido'] = 'sucursales/consignar';
       $data['js'] = 'sucursales/js_consignar';
       $this->load->view('main', $data);
        
	}

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */