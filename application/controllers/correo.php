<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('correo_model');
            // Your own constructor code
    }
    
    function index()
    {
        $this->correo_model->envio_masivo();
    }
    

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */