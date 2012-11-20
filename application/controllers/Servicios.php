<?php
class Servicios extends Controller {
 function __construct() {
 parent::Controller();

 $this->load->library("nuSoap_lib");

 $this->nusoap_server = new soap_server();
 $this->nusoap_server->configureWSDL("servicios", "urn:servicios");


 $this->nusoap_server->register(
 "Inventario",
 array(
 "usuario" => "xsd:string",
 "password" => "xsd:string"
 ),
 array("return"=>"xsd:string"),
 "urn:servicioInv",
 "urn:sevicioInv#Inventario",
 "rpc",
 "encoded",
 "Inventario"
 );

}

 function index() {
 if($this->uri->segment(3) == "wsdl") {
 $_SERVER['QUERY_STRING'] = "wsdl";
 } else {
 $_SERVER['QUERY_STRING'] = "";
 }

 $this->nusoap_server->service(file_get_contents("php://input"));
 }

 function Inventario_() {
 function Inventario($usuario, $password) {

 $CI =& get_instance();
 $CI->load->model("soap");
 return $CI->soap->inventario($usuario, $password);

 }

 $this->nusoap_server->service(file_get_contents("php://input"));
 }

}