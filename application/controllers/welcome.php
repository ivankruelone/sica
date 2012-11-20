<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        $this->logeado();
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	public function index()
	{
	   $data['menu'] = 1;
		$this->load->view('main', $data);
	}
    
    
    function get_juris_combo()
    {
        $query = $this->comun->juris_act($this->input->post('estado'));
        $a = "
            <option value=\"0\">Selecciona una opcion</option>";
        
        foreach($query as $row){
            $a.= "
            <option value=\"$row->juris\">$row->jurisdiccion</option>";
        }
        
        echo $a;
        
    }
    
    function get_plaza_combo_editar()
    {
        $query = $this->comun->plazas($this->input->post('zona'));
        $a = null;
        
        foreach($query as $row){
            
            if($row->plaza == $this->input->post('plaza')){
                $b = "selected=\"selected\"";
            }else{
                $b = null;
            }
            
            $a.= "
            <option value=\"$row->plaza\" $b>$row->nombre_plaza</option>";
        }
        
        echo $a;
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */