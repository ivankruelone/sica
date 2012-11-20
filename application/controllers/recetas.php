<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recetas extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('pacientes_model');
        $this->load->model('recetas_model');
            // Your own constructor code
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
	   $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Busca Receta';
       $data['contenido'] = 'recetas/busca_receta';
       $data['js'] = 'recetas/js_busca_receta';
       $this->load->view('main', $data);
    }
    
    function submit_busca_receta()
    {
        $folio = $this->input->post('folio');
        $largo = strlen($folio);
        //014001201207070000000010
        if($largo == 24)
        {
            $id = substr($folio, -10); 
            $suc = substr($folio, 0, 6);
             
        }else{
            $id = $folio;
            $suc = $this->session->userdata('numsuc');
        }
        
        $this->db->where('id', $id);
        $this->db->where('estatus', 0);
        $query = $this->db->get('receta');
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            echo $row->id;
        }else{
            echo 0;
        }
        
        
        
        
        
    }

    function receta($receta)
    {
	   $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Receta';
       $data['contenido'] = 'recetas/formato_receta_surtido';
       $data['js'] = 'recetas/js_formato_receta_surtido';
	   $data['receta'] = $receta;
       $this->load->view('main', $data);
    }
    
    function surtidas()
    {
	   $data['menu'] = 5;
	   $data['submenu'] = 5.2;
       $data['titulo'] = 'Recetas Surtidas';
       $data['contenido'] = 'recetas/recetas';
	   $data['query'] = $this->recetas_model->recetas();
       $this->load->view('main', $data);
    }

    function submit_surte_receta()
    {
        $paso =  $this->input->post('paso');
        //echo $paso;
        $paso = explode('&', $paso);
        foreach($paso as $matrix){
            $paso1 = explode('=', $matrix);
            if(substr($paso1[0], 0, 2) == 'id'){
                $receta_id = $paso1[1];
            }elseif(substr($paso1[0], 0, 4) == 'lote'){
                $paso2 = explode('_', $paso1[0]);
                $paso3 = explode('_', $paso1[1]);
                
                $var[$paso2[1]]['lote'] = $paso3[0];  
                
                
            }elseif(substr($paso1[0], 0, 6) == 'cansur'){
                $paso2 = explode('_', $paso1[0]);
                $paso3 = explode('_', $paso1[1]);
                
                $var[$paso2[1]]['cansur'] = $paso3[0];  
                
                
            }elseif(substr($paso1[0], 0, 9) == 'caducidad'){
                $paso2 = explode('_', $paso1[0]);
                $paso3 = explode('_', $paso1[1]);
                
                $var[$paso2[1]]['caducidad'] = $paso3[0];  
                
                
            }
        }
        
        //print_r($var);
        $llaves = array_keys($var);
        foreach($llaves as $llave)
        {
            if($var[$llave]['caducidad'] == null || $var[$llave]['caducidad'] == ''){
                $this->db->where('id', $llave);
                $data->lote = $var[$llave]['lote'];
                $data->cansur = $var[$llave]['cansur'];
                $data->listo = 1;
                $this->db->update('receta_detalle', $data);
            }else{
                
                $data->lote = $var[$llave]['lote'];
                $data->caducidad = $var[$llave]['caducidad'];
                $data->cansur = $var[$llave]['cansur'];
                $data->listo = 1;
                $this->db->where('id', $llave);
                $this->db->update('receta_detalle', $data);
            }
        }
        
        $data2->estatus = 1;
        $this->db->set('surtida', 'now()', false);
        $this->db->where('id', $receta_id);
        $this->db->update('receta', $data2);
        
        echo $this->db->affected_rows();
        
        
        
    }
}