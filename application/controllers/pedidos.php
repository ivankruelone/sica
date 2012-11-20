<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('pedidos_model');
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
	   $data['menu'] = 4;
       $data['titulo'] = 'Pedidos';
       $data['contenido'] = 'pedidos/portada';
       $this->load->view('main', $data);
        
	}

	function en_captura()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/pedidos/en_captura/';
       $config['total_rows'] = $this->pedidos_model->pedidos_rows(0);
       $config['per_page'] = 100;
       $this->pagination->initialize($config); 

	   $data['menu'] = 4;
	   $data['submenu'] = 4.2;
       $data['titulo'] = 'Pedidos en Captura';
       $data['query'] = $this->pedidos_model->pedidos(0, $config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pedidos/pedidos';
       $data['js'] = "pedidos/js_pedidos";
       $this->load->view('main', $data);
        
	}

	function en_surtido()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/pedidos/en_surtido/';
       $config['total_rows'] = $this->pedidos_model->pedidos_rows(1);
       $config['per_page'] = 100;
       $this->pagination->initialize($config); 

	   $data['menu'] = 4;
	   $data['submenu'] = 4.3;
       $data['titulo'] = 'Pedidos en Surtido';
       $data['query'] = $this->pedidos_model->pedidos(1, $config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pedidos/pedidos';
       $data['js'] = "pedidos/js_pedidos";
       $this->load->view('main', $data);
        
	}

	function en_embarque()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/pedidos/en_embarque/';
       $config['total_rows'] = $this->pedidos_model->pedidos_rows(2);
       $config['per_page'] = 100;
       $this->pagination->initialize($config); 

	   $data['menu'] = 4;
	   $data['submenu'] = 4.4;
       $data['titulo'] = 'Pedidos en Embarque';
       $data['query'] = $this->pedidos_model->pedidos(2, $config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pedidos/pedidos';
       $data['js'] = "pedidos/js_pedidos";
       $this->load->view('main', $data);
        
	}

	function embarcados()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/pedidos/embarcados/';
       $config['total_rows'] = $this->pedidos_model->pedidos_rows(3);
       $config['per_page'] = 500;
       $this->pagination->initialize($config); 

	   $data['menu'] = 4;
	   $data['submenu'] = 4.5;
       $data['titulo'] = 'Pedidos en Embarque';
       $data['query'] = $this->pedidos_model->pedidos(3, $config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pedidos/pedidos';
       $data['js'] = "pedidos/js_pedidos";
       $this->load->view('main', $data);
        
	}

	function cancelados()
	{
	   $this->load->library('pagination');
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['next_link'] = 'Siguiente';
       $config['prev_link'] = 'Anterior';
       $config['base_url'] = site_url().'/pedidos/cancelados/';
       $config['total_rows'] = $this->pedidos_model->pedidos_rows(5);
       $config['per_page'] = 100;
       $this->pagination->initialize($config); 

	   $data['menu'] = 4;
	   $data['submenu'] = 4.6;
       $data['titulo'] = 'Pedidos Cancelados';
       $data['query'] = $this->pedidos_model->pedidos(5, $config['per_page'], $this->uri->segment(3));
       $data['contenido'] = 'pedidos/pedidos';
       $data['js'] = "pedidos/js_pedidos";
       $this->load->view('main', $data);
        
	}

	function nuevo_pedido()
	{
	   $data['menu'] = 4;
	   $data['submenu'] = 4.1;
       $data['titulo'] = 'Nuevo Pedido';
       $data['contenido'] = 'pedidos/nuevo_pedido';
       $data['js'] = 'pedidos/js_nuevo_pedido';
       $this->load->view('main', $data);
        
	}
    
	function busqueda()
	{
	   $data['menu'] = 4;
	   $data['submenu'] = 4.7;
       $data['titulo'] = 'Busqueda de Pedidos';
       $data['contenido'] = 'pedidos/busqueda';
       $data['js'] = 'pedidos/js_busqueda';
       $this->load->view('main', $data);
        
	}
    
	function subida()
	{
	   $data['menu'] = 4;
	   $data['submenu'] = 4.8;
       $data['titulo'] = 'Subida de Pedidos';
       $data['contenido'] = 'pedidos/subida';
       $data['js'] = 'pedidos/js_subida';
       $this->load->view('main', $data);
        
	}

    function busqueda_sucursal()
    {
        $data['submenu'] = 4.7;
        $data['query'] = $this->pedidos_model->busqueda_sucursal($this->input->post('sucursal'));
        $this->load->view('pedidos/pedidos_pedidos', $data);
    }

    function busqueda_pedido()
    {
        $data['submenu'] = 4.7;
        $data['query'] = $this->pedidos_model->busqueda_pedido($this->input->post('pedido'));
        $this->load->view('pedidos/pedidos_pedidos', $data);
    }

    function submit_nuevo_pedido()
    {
        $id = $this->pedidos_model->insert_pedido();
        if($id > 0){
            redirect('pedidos/captura_pedido/'.$id.'/'.$this->input->post('submenu'));
        }else{
            redirect('pedidos/nuevo_pedido');
        }
        
    }

	function captura_pedido($id, $submenu, $error = null)
	{
	   $data['menu'] = 4;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Captura de Pedido';
       $data['contenido'] = 'pedidos/captura_pedido';
       $data['row'] = $this->pedidos_model->get_pedido($id);
       $data['js'] = 'pedidos/js_captura_pedido';
       $this->load->view('main', $data);
        
	}

	function do_upload()
	{
        $this->load->helper('path');
        $directory = './uploads';
        $id = $this->input->post('id');
        $submenu = $this->input->post('submenu');

		if ($_FILES["file"]["error"] > 0)
        {
            redirect('pedidos/captura_pedido/'.$id.'/'.$submenu);
        }else{
            
            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);
            
            if($extension == 'csv'){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])){
                    
                    $filePath = './uploads/' . $_FILES["file"]["name"];
                    
                    $row = 1;
                    if (($handle = fopen($filePath, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            //echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                            }
                            
                            $this->pedidos_model->submit_captura_clave($id, $data[0], $data[1]);
                            
                        }
                        fclose($handle);
                        redirect('pedidos/captura_pedido/'.$id.'/'.$submenu);
                    }
                }
            }else{
                redirect('pedidos/captura_pedido/'.$id.'/'.$submenu);
            }
            
            
            
        }
	}
    
	function do_upload_subida()
	{
        $this->load->helper('path');
        $directory = './uploads';
        $submenu = $this->input->post('submenu');

		if ($_FILES["file"]["error"] > 0)
        {
            redirect('pedidos/subida/');
        }else{
            
            $archivo = $_FILES["file"]["name"];
            $extension = explode('.', $archivo);
            $extension = $extension[count($extension) - 1];
            $extension = strtolower($extension);
            
            if($extension == 'csv'){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], set_realpath($directory) . $_FILES["file"]["name"])){
                    
                    $filePath = './uploads/' . $_FILES["file"]["name"];
                    $id = $this->pedidos_model->inserta_pedido_option_c($filePath);
                    
                    $row = 1;
                    if (($handle = fopen($filePath, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            //echo "<p> $num fields in line $row: <br /></p>\n";
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                            }
                            
                            $this->pedidos_model->inserta_pedido_option_d($data[0], $data[1], $data[2], $id);
                            
                            
                        }
                        $this->pedidos_model->procesar_subida($id);
                        fclose($handle);
                        redirect('pedidos/en_surtido/');
                    }
                }
            }else{
                redirect('pedidos/subida/');
            }
            
            
            
        }
	}    

    function submit_captura_clave()
    {
        $data['insert_id'] = $this->pedidos_model->submit_captura_clave();
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'));
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle', $data);
    }
    
    function detalle_captura()
    {
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'));
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle', $data);
    }
    
    function detalle_surtido()
    {
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'));
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle_surtido', $data);
    }

    function detalle_surtido2()
    {
        $data['query'] = $this->pedidos_model->get_productos2($this->input->post('id'), 'd.id', 'ASC');
        $data['estatus'] = $this->input->post('estatus');
        $data['anios_validos'] = $this->comun->anios_validos();
        $this->load->view('pedidos/detalle_surtido2', $data);
    }

    function detalle_en_embarque()
    {
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'), 'd.id', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle_en_embarque', $data);
    }

    function detalle_embarcado()
    {
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'), 'd.id', 'DESC');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle_embarcado', $data);
    }

    function cerrar_captura()
    {
        echo $this->pedidos_model->cerrar_captura($this->input->post('id'));
    }
    
    function borra_detalle()
    {
        $res = $this->pedidos_model->borra_detalle($this->input->post('id'));
        echo $res;
    }
    
	function captura_surtido($id, $submenu)
	{
	   $data['menu'] = 4;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Captura de Piezas Surtidas';
       $data['contenido'] = 'pedidos/captura_surtido';
       $data['row'] = $this->pedidos_model->get_pedido($id);
       $data['js'] = 'pedidos/js_captura_surtido';
       $this->load->view('main', $data);
        
	}

	function captura_surtido2($id, $submenu)
	{
	   $data['menu'] = 4;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Captura de Piezas Surtidas';
       $data['contenido'] = 'pedidos/captura_surtido2';
       $data['row'] = $this->pedidos_model->get_pedido($id);
       $data['js'] = 'pedidos/js_captura_surtido2';
       $this->load->view('main', $data);
        
	}
    
	function embarcado($id, $submenu)
	{
	   $data['menu'] = 4;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Captura de Piezas Surtidas';
       $data['contenido'] = 'pedidos/embarcado';
       $data['row'] = $this->pedidos_model->get_pedido($id);
       $data['js'] = 'pedidos/js_embarcado';
       $this->load->view('main', $data);
        
	}

    function detalle_captura_cambio()
    {
        echo $this->pedidos_model->detalle_captura_cambio();
    }

    function detalle_captura_cambio_lote_caucidad()
    {
        echo $this->pedidos_model->detalle_captura_cambio_lote_caucidad();
    }

    function busca_pedidos_autocomplete()
    {
        $query = $this->pedidos_model->autocomplete($this->input->get_post('id'), $this->input->get_post('estado_int'), $this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->id.'","value":"'.$row->id.' - '.$row->clave.' - '.$row->descripcion.'","lc":"'.$row->lc.'"},';
        }
        
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }
    
    function submit_captura_cansur_clave()
    {
        $this->pedidos_model->submit_captura_cansur_clave();
        $data['query'] = $this->pedidos_model->get_productos($this->input->post('id'), 'modificado');
        $data['estatus'] = $this->input->post('estatus');
        $this->load->view('pedidos/detalle_surtido', $data);    
    }

    function cerrar_surtido()
    {
        $data['res'] = $this->pedidos_model->cerrar_surtido($this->input->post('id'));
        $this->load->view('pedidos/resultado', $data);
    }

	function captura_embarque($id, $submenu)
	{
	   $data['menu'] = 4;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Embarcar este pedido';
       $data['contenido'] = 'pedidos/captura_embarque';
       $data['row'] = $this->pedidos_model->get_pedido($id);
       $data['js'] = 'pedidos/js_captura_embarque';
       $this->load->view('main', $data);
        
	}

    function busca_personal()
    {
        $query = $this->pedidos_model->busca_personal($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->num_emp.'","value":"'.$row->nombre.'"},';
        }
        
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }
    
    function previo_pedido($id)
    {
        $data['header'] = $this->pedidos_model->previo_pedido_header($id);
        $data['detalle'] = $this->pedidos_model->previo_pedido($id);
        $this->load->view('impresiones/previo_pedido', $data);
    }

    function previo_pedido_surtido($id)
    {
        $data['header'] = $this->pedidos_model->previo_pedido_header($id);
        $data['detalle'] = $this->pedidos_model->previo_pedido_surtido($id);
        $this->load->view('impresiones/previo_pedido_surtido', $data);
    }

    function pedido_embarque($id)
    {
        $data['header'] = $this->pedidos_model->embarque_header($id);
        $data['detalle'] = $this->pedidos_model->pedido_embarque($id);
        //echo $this->pedidos_model->embarque_header($id);
        //echo $this->pedidos_model->pedido_embarque($id);
        $this->load->view('impresiones/previo_pedido', $data);
    }
    
	function cerrar_embarque()
	{
	   $data['res'] = $this->pedidos_model->cerrar_embarque($this->input->post('id'));
	   $data['menu'] = 4;
	   $data['submenu'] = 1;
       $data['titulo'] = 'Embarque Cerrado';
       $data['contenido'] = 'pedidos/resultado_cierre_embarque';
       $this->load->view('main', $data);
        
	}

    function pedido_embarcado_excel($id)
    {
        $data['row'] = $this->pedidos_model->get_pedido($id);
        $data['query'] = $this->pedidos_model->get_productos($id, 'd.id', 'DESC');
        $this->load->view('excel/pedido_embarcado', $data);
    }
    
    function cambiar_pedido_attr()
    {
        echo $this->pedidos_model->cambiar_pedido_attr();
    }
    
    function cancela_pedido($id)
    {
        $motivo = $this->input->post('motivo');
        echo $this->pedidos_model->cancela_pedido($id, $motivo);
    }

    function regresa_pedido($id, $estatus)
    {
        echo $this->pedidos_model->regresa_pedido($id, $estatus);
    }

}

/* End of file pedidos.php */
/* Location: ./application/controllers/pedidos.php */