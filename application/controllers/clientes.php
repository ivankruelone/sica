<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('clientes_model');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function catalogo()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/clientes/catalogo/';
       $config['total_rows'] = $this->clientes_model->catalogo_rows();
       $config['per_page'] = 50;
       $this->pagination->initialize($config); 
	   
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Catalogo de Clientes';
       $data['query'] = $this->clientes_model->catalogo($config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'clientes/catalogo';
       $this->load->view('main', $data);
        
	}

	function nuevo_cliente()
	{
	   $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Nuevo Cliente';
       $data['contenido'] = 'clientes/nuevo_cliente';
       $data['js'] = 'clientes/js_nuevo_cliente';
       $data['zonas'] = $this->comun->zonas_combo();
       $data['condiciones'] = $this->comun->condiciones();
       $data['precios'] = $this->comun->precios();
       $data['iva'] = $this->comun->iva();
       $this->load->view('main', $data);
        
	}
    
    function submit_nuevo_cliente()
    {
        $data['res'] = $this->clientes_model->insert_cliente();
        $this->load->view('clientes/resultado', $data);
    }

	function editar_cliente($id, $submenu)
	{
	   $data['menu'] = 5;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Editar Cliente';
       $data['row'] = $this->clientes_model->get_cliente($id);
       $data['contenido'] = 'clientes/editar_cliente';
       $data['js'] = 'clientes/js_editar_cliente';
       $data['zonas'] = $this->comun->zonas_combo();
       $data['condiciones'] = $this->comun->condiciones();
       $data['precios'] = $this->comun->precios();
       $data['iva'] = $this->comun->iva();
       $this->load->view('main', $data);
        
	}
    
    function submit_editar_cliente()
    {
        $data['res'] = $this->clientes_model->update_cliente();
        $this->load->view('clientes/resultado', $data);
    }

    function busca_clientes_autocomplete()
    {
        $query = $this->clientes_model->autocomplete($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->id.'","value":"'.$row->id.' - '.$row->rfc.' - '.$row->razon.'"},';
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
       $data['contenido'] = 'clientes/consignar';
       $data['js'] = 'clientes/js_consignar';
       $this->load->view('main', $data);
        
	}

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */