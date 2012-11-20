<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
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
	   $data['menu'] = 11;
	   $data['submenu'] = 11.1;
       $data['titulo'] = 'Acerca de';
       $data['contenido'] = 'settings/acercade';
       $this->load->view('main', $data);
        
	}

	function modificar_password()
	{
	   $data['menu'] = 11;
	   $data['submenu'] = 11.2;
       $data['titulo'] = 'Modificar Contrase&ntilde;a';
       $data['contenido'] = 'settings/modificar_password';
       $data['js'] = 'settings/modificar_password_js';
       $this->load->view('main', $data);
        
	}
    
    function submit_modificar_password()
    {
        $this->db->where('usuario', $this->session->userdata('usuario'));
        $this->db->where('password', $this->input->post('pa'));
        $q = $this->db->get('usuarios');
        
        if($q->num_rows() == 1){
            
            
            $data = new stdClass();
            $data->password = $this->input->post('pn1');
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->update('usuarios', $data);
            
            echo "1";
        }else{
            echo "0";
        }
    }
}
