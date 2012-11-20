<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
     
    

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->logeado();
		$this->load->view('login');
	}
    
    function submit()
    {
        $this->logeado();
        $this->db->where('usuario', $this->input->post('login'));
        $this->db->where('password', $this->input->post('pass'));
        $query = $this->db->get('usuarios');
        
        if($query->num_rows() == 1){
            
            $row = $query->row();
            
            if($row->numsuc == '0')
            {
                $row->numsuc = SUCURSAL;
            }
            
            if($row->estado == '0')
            {
                $row->estado = ESTADO;
            }
            
            
            $this->db->select('sucursal');
            $this->db->where('numsuc', $row->numsuc);
            $query2 = $this->db->get('sucursales');
            
            if($query2->num_rows() > 0){
                
                $row2 = $query2->row();

            }else{
                
                $row2->sucursal = "No Asignada";
                
            }
            
            
            $this->db->select('estado');
            $this->db->where('estado_int', $row->estado);
            $query3 = $this->db->get('estados');
            
            if($query3->num_rows() > 0){
                
                $row3 = $query3->row();

            }else{
                
                $row3->estado = "No Asignado";
                
            }
            
            $this->db->where('id', $row->servicio);
            $query4 = $this->db->get('servicios');

            if($query4->num_rows() > 0){
                
                $row4 = $query4->row();

            }else{
                
                $row4->servicio = "No Asignado";
                
            }
            
            
            //id, usuario, password, nombre, email, nivel, estado, juris, numsuc, servicio, rfc
            
            $newdata = array(
                   'id'         => $row->id,
                   'usuario'    => $row->usuario,
                   'nombre'     => $row->nombre,
                   'email'      => $row->email,
                   'nivel'      => $row->nivel,
                   'estado'     => $row->estado,
                   'juris'      => $row->juris,
                   'numsuc'     => $row->numsuc,
                   'servicio'   => $row->servicio,
                   'rfc'        => $row->rfc,
                   'sucursal'   => $row2->sucursal,
                   'estado_nombre'  => $row3->estado,
                   'servicio_nombre'    => $row4->servicio,
                   'logged_in'  => TRUE
               );

            $this->session->set_userdata($newdata);
            
            redirect('welcome');
            
        }else{
            redirect('login');
        }
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === TRUE){
            redirect('welcome');
        }
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */