<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
    var $nivel = null; 


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('usuarios_model');
        $this->nivel = $this->session->userdata('nivel');
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
       $config['base_url'] = site_url().'/usuarios/catalogo/';
       $config['total_rows'] = $this->usuarios_model->catalogo_rows();
       $config['per_page'] = 50;
       $this->pagination->initialize($config); 
	   
       $data['menu'] = 6;
	   $data['submenu'] = 6.1;
       $data['titulo'] = 'Catalogo de Usuarios';
       $data['query'] = $this->usuarios_model->catalogo($config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'usuarios/catalogo';
       $data['nivel'] = $this->nivel;
       $this->load->view('main', $data);
        
	}

	function nuevo_usuario()
	{
	   $data['menu'] = 6;
	   $data['submenu'] = 6.1;
       $data['titulo'] = 'Nuevo Usuario';
       $data['contenido'] = 'usuarios/nuevo_usuario';
       $data['js'] = 'usuarios/js_nuevo_usuario';
       $data['niveles'] = $this->comun->niveles_combo();
       $data['estados'] = $this->comun->estados_combo();
       $data['dias'] = $this->comun->dias_combo();
       $this->load->view('main', $data);
        
	}
}