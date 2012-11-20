<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('proveedores_model');
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
       $config['base_url'] = site_url().'/proveedores/catalogo/';
       $config['total_rows'] = $this->proveedores_model->catalogo_rows();
       $config['per_page'] = 50;
       $this->pagination->initialize($config); 
	   
       $data['menu'] = 7;
	   $data['submenu'] = 7.1;
       $data['titulo'] = 'Catalogo de Proveedores';
       $data['query'] = $this->proveedores_model->catalogo($config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'proveedores/catalogo';
	   $data['js'] = 'proveedores/js_catalogo';
       $this->load->view('main', $data);
        
	}

	function nuevo_proveedor()
	{
	   $data['menu'] = 7;
	   $data['submenu'] = 7.1;
       $data['titulo'] = 'Nuevo Proveedor';
       $data['contenido'] = 'proveedores/nuevo_proveedor';
       $data['js'] = 'proveedores/js_nuevo_proveedor';
       $data['condiciones'] = $this->comun->condiciones();
       $this->load->view('main', $data);
        
	}
    
    function submit_nuevo_proveedor()
    {
        echo $this->proveedores_model->insert_proveedor();
    }

	function editar_proveedor($id, $submenu)
	{
	   $data['menu'] = 7;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Editar Proveedor';
       $data['row'] = $this->proveedores_model->get_proveedor($id);
       $data['contenido'] = 'proveedores/editar_proveedor';
       $data['js'] = 'proveedores/js_editar_proveedor';
       $data['condiciones'] = $this->comun->condiciones();
       $this->load->view('main', $data);
        
	}
    
    function submit_editar_proveedor()
    {
        $data['res'] = $this->proveedores_model->update_proveedor();
        $this->load->view('proveedores/resultado', $data);
    }

    function busca_proovedores_autocomplete()
    {
        $query = $this->proveedores_model->autocomplete($this->input->get_post('term'));
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

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */