<?php
class Correo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('email');
    }
    
    function correo_masivo()
    {
        $query = $this->db->get('usuarios');
        
        foreach($query->result() as $row){
        
            if (valid_email($row->email)){
                
                $mensaje = "
                Hola:
                
                Bienvenido al sistema xxxxxx.
                
                Usuario: $row->usuario
                Password: $row->password
                
                Gracias.
                ";
                
                send_email($row->email, 'Alta en el sistema', $mensaje);
                
            }else{
                //echo 'email is not valid';
            }
        
        }
    }
    

}