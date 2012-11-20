<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {


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
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Estadisticas del Almacen';
       $data['contenido'] = 'stats/portada';
       $this->load->view('main', $data);
        
	}

	function req_vs_sur_diario()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Requeridas Vs. Surtidas Diarias';
       $data['contenido'] = 'stats/req_vs_sur_diario';
       $data['js'] = 'stats/req_vs_sur_diario_js';
       $this->load->view('main', $data);
        
	}

    function get_json_req_vs_sur_diario($serie)
    {
        header("Content-type: text/json");
        $this->db->select('unix_timestamp(fec_embarque) as fecha, '.$serie.' as can');
        $query = $this->db->get('canreq_vs_cansur_embarcado');
        
        $a = "[";
        
        foreach($query->result() as $row)
        {
            //$a.= "[Date.UTC(".$row->anio.",".$row->mes.",".$row->dia.",".$row->horas.",".$row->minuto.",".$row->segundo."),".$row->inventario."],";
            $a.= "[".($row->fecha*1000).",".$row->can."],";
        }
        
        $a = substr($a, 0, -1); 
        
        $a.="]";
        
        
        echo $a;
        
    }

	function negados()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Negados';
       $data['contenido'] = 'stats/negados';
       $data['js'] = 'stats/negados_js';
       $this->load->view('main', $data);
        
	}
    
    function negados_resultado()
    {
        $this->load->model('inv_model');
        $data['query'] = $this->inv_model->negados($this->input->post('perini'), $this->input->post('perfin'));
        $this->load->view('stats/negados_resultado', $data);
    }

}