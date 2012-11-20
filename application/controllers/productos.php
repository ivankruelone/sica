<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('productos_model');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function index($submenu)
	{
	   $this->load->library('pagination');
       $config['base_url'] = site_url().'/productos/index/'.$submenu;
       $config['total_rows'] = $this->productos_model->registros();
       $config['per_page'] = 2000;
       $config['anchor_class'] = 'class="button" ';
       $config['cur_tag_open'] = '<b class ="big-button">';
       $config['cur_tag_close'] = '</b>';
       $config['uri_segment'] = 4;
       
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';

       
       $this->pagination->initialize($config);
       
       $data['tr'] = $this->productos_model->registros();

	   $data['menu'] = 2;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Productos';
       $data['query'] = $this->productos_model->catalogo($config['per_page'], $this->uri->segment(4));
       $data['contenido'] = 'productos/catalogo';
       $data['paginacion']  = 1;
       $data['js'] = 'productos/js_catalogo';
       $this->load->view('main', $data);
        
	}
    
	function estado($estado, $submenu)
	{
	   $this->load->library('pagination');
       $config['base_url'] = site_url().'/productos/estado/'.$estado.'/'.$submenu.'/';
       $config['total_rows'] = $this->productos_model->registros_estado($estado);
       $config['per_page'] = 2000;
       $config['anchor_class'] = 'class="button" ';
       $config['cur_tag_open'] = '<b class ="big-button">';
       $config['cur_tag_close'] = '</b>';
       
       $config['first_link'] = 'Primera';
       $config['last_link'] = 'Ultima';
       $config['uri_segment'] = 5;
       
       
       $this->pagination->initialize($config);
       
       $data['tr'] = $this->productos_model->registros_estado($estado);


	   $data['menu'] = 2;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Productos';
       $data['query'] = $this->productos_model->catalogo_estado($estado, $config['per_page'], $this->uri->segment(5));
       $data['contenido'] = 'productos/catalogo';
       $data['paginacion']  = 1;
       $data['js'] = 'productos/js_catalogo';
       $this->load->view('main', $data);
        
	}

	function detalle($id)
	{
	   $data['menu'] = 2;
	   $data['submenu'] = 2.1;
       $data['titulo'] = 'Productos';
       $data['query'] = $this->productos_model->detalle($id);
       $data['contenido'] = 'productos/catalogo';
       $this->load->view('main', $data);
        
	}

	function editar_producto($id, $submenu)
	{
	   $data['menu'] = 2;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Editar Producto';
       $data['row'] = $this->productos_model->producto_id($id);
       $data['tipo'] = $this->productos_model->tipo_producto_drop();
       $data['subtipo'] = $this->productos_model->subtipo_producto_drop();
       $data['contenido'] = 'productos/editar_producto';
       $data['js'] = 'productos/js_editar_producto';
       $this->load->view('main', $data);
        
	}
    
    function submit_editar_producto(){
        echo $this->productos_model->update_producto();
    }

	function nuevo_producto($submenu)
	{
	   $data['menu'] = 2;
	   $data['submenu'] = $submenu;
       $data['titulo'] = 'Nuevo Producto';
       $data['tipo'] = $this->productos_model->tipo_producto_drop();
       $data['subtipo'] = $this->productos_model->subtipo_producto_drop();
       $data['contenido'] = 'productos/nuevo_producto';
       $data['js'] = 'productos/js_nuevo_producto';
       $this->load->view('main', $data);
        
	}
    
    function submit_nuevo_producto(){
        echo $this->productos_model->insert_producto();
    }

    function busca_productos_autocomplete()
    {
		$this->load->helper('text');
        $query = $this->productos_model->autocomplete($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->clave.'","value":"'.$row->clave.' - '.ascii_to_entities(str_replace(array('"'), array(''), $row->descripcion)).'","lc":"'.$row->lc.'"},';
        }
        
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }

    function busca_productos_estado_autocomplete()
    {
		$this->load->helper('text');
        $query = $this->productos_model->autocomplete_estado($this->input->get_post('estado'), $this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->clave.'","value":"'.$row->clave.' - '.ascii_to_entities(str_replace(array('"'), array(''), $row->descripcion)).'","lc":"'.$row->lc.'"},';
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

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */