<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pacientes extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('pacientes_model');
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
       $config['base_url'] = site_url().'/pacientes/catalogo/';
       $config['total_rows'] = $this->pacientes_model->catalogo_rows();
       $config['per_page'] = 50;
       $this->pagination->initialize($config); 
	   
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Catalogo de pacientes';
       $data['query'] = $this->pacientes_model->catalogo($config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pacientes/catalogo';
       $this->load->view('main', $data);
        
	}

	function nuevo_paciente()
	{
	   $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Nuevo Paciente';
       $data['contenido'] = 'pacientes/nuevo_paciente';
       $data['js'] = 'pacientes/js_nuevo_paciente';
       $data['sexo'] = $this->comun->sexo_combo();
       $data['programas'] = $this->comun->programas_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_nuevo_paciente()
    {
        echo $this->pacientes_model->insert_paciente();
    }

	function editar_paciente($id, $submenu)
	{
	   $data['menu'] = 5;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Editar Paciente';
       $data['row'] = $this->pacientes_model->get_paciente($id);
       $data['contenido'] = 'pacientes/editar_paciente';
       $data['js'] = 'pacientes/js_editar_paciente';
       $data['sexo'] = $this->comun->sexo_combo();
       $data['programas'] = $this->comun->programas_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_editar_paciente()
    {
        echo $this->pacientes_model->update_paciente();
    }

	function expediente($id)
	{

       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Expediente Electronico';
       $data['row'] = $this->pacientes_model->get_paciente2($id);
       $data['anotaciones'] = $this->pacientes_model->get_anotaciones($id);
       $data['recetas'] = $this->pacientes_model->get_recetas($id);
       $data['contenido'] = 'pacientes/expediente';
       $data['js'] = 'pacientes/js_expediente';
       $data['id'] = $id;
       $this->load->view('main', $data);
        
	}

	function todas_recetas($id)
	{

       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Expediente Electronico';
       $data['row'] = $this->pacientes_model->get_paciente2($id);
       $data['recetas'] = $this->pacientes_model->get_recetas_todas($id);
       $data['contenido'] = 'pacientes/recetas';
       $data['id'] = $id;
       $this->load->view('main', $data);
        
	}

	function nueva_anotacion($id)
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Agrega Anotacion';
	   $data['id'] = $id;
       $data['row'] = $this->pacientes_model->get_paciente2($id);
       $data['contenido'] = 'pacientes/nueva_anotacion';
       $this->load->view('main', $data);
        
	}
    
    function submit_nueva_anotacion()
    {
        $id = $this->input->post('paciente_id');
        
        $last = $this->pacientes_model->insert_anotacion();
        
        redirect('pacientes/expediente/'.$id);
    }

	function nueva_receta($id)
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Nueva Receta';
	   $data['id'] = $id;
       $data['row'] = $this->pacientes_model->get_paciente2($id);
       $data['contenido'] = 'pacientes/nueva_receta';
       $data['js'] = 'pacientes/js_nueva_receta';
       $this->load->view('main', $data);
        
	}

    function detalle_captura_receta_temp()
    {
        $data['query'] = $this->pacientes_model->get_detalle_captura_receta_temp();
        $this->load->view('pacientes/detalle', $data);
    }

    function submit_captura_clave()
    {
        $data['insert_id'] = $this->pacientes_model->submit_captura_clave();
        $data['query'] = $this->pacientes_model->get_detalle_captura_receta_temp();
        $this->load->view('pacientes/detalle', $data);
    }

    function borra_detalle()
    {
        $res = $this->pacientes_model->borra_detalle($this->input->post('id'));
        echo $res;
    }
    
    function posologia()
    {
        $data->posologia = $this->input->post('texto');
        $this->db->where('id', $this->input->post('id'));
        
        $this->db->update('receta_detalle_temp', $data);
    }
    
    function terminar_receta()
    {
        echo $this->pacientes_model->guardar_receta();
    }

    function busca_pacientes_autocomplete()
    {
        $query = $this->pacientes_model->autocomplete($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->id.'","value":"'.$row->id.' - '.$row->apaterno.' '.$row->amaterno.' '.$row->nombre.'"},';
        }
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }

    function busca_cie_primaria()
    {
        $this->db->or_like('id10', $this->input->get_post('term'));
        $this->db->or_like('dec10', $this->input->get_post('term'));
        $this->db->having('LENGTH(id10) =3', FALSE);
        $this->db->limit('15');
        $sql = $this->db->get('db29179_cie10');
        
        $query = $sql->result();
        
        
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"cie":"'.$row->id10.'","value":"'.$row->id10.' - '.$row->dec10.'"},';
        }
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"cie":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }
    
    function busca_cie_secundaria()
    {
        $this->db->like('id10', $this->input->post('cieprimaria'));
        $query = $this->db->get('db29179_cie10');
        
        $a= '<option value="0">Selecciona una opcion</option>';
        
        foreach($query->result() as $row)
        {
            $a.= '<option value="'.$row->id10.' - '.$row->dec10.'">'.$row->id10.' - '.$row->dec10.'</option>';
        }
        
        echo $a;
    }

	function receta($paciente_id, $receta_id)
	{
       $data['menu'] = 5;
	   $data['submenu'] = 5.1;
       $data['titulo'] = 'Receta';
	   $data['id'] = $paciente_id;
	   $data['receta'] = $receta_id;
       $data['row'] = $this->pacientes_model->get_paciente2($paciente_id);
       $data['contenido'] = 'pacientes/receta';
       $data['js'] = 'pacientes/js_formato_receta';
       $this->load->view('main', $data);
        
	}
    
    function folio_codebar($folio)
    {
        require('class/BCGFontFile.php');
        require('class/BCGColor.php');
        require('class/BCGDrawing.php');
        require('class/BCGcode39.barcode.php');
         
        $font = new BCGFontFile('Arial.ttf', 10);
        $color_black = new BCGColor(0, 0, 0);
        $color_white = new BCGColor(255, 255, 255);
         
        // Barcode Part
        $code = new BCGcode39();
        $code->setScale(1);
        $code->setThickness(72);
        $code->setForegroundColor($color_black);
        $code->setBackgroundColor($color_white);
        $code->setFont($font);
        $code->setChecksum(false);
        $code->parse($folio);
         
        // Drawing Part
        $drawing = new BCGDrawing('', $color_white);
        $drawing->setBarcode($code);
        $drawing->draw();
         
        header('Content-Type: image/png');
         
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);    
    }
}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */