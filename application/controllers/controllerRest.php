<?php
class ControllerRest extends CI_Controller {

public function __construct(){

 parent::__construct();
 //leer el model
 $this->load->model('UsuariosModel');
} 


public function obtenerTodos(){
    if ($_SERVER['REQUEST_METHOD']=='GET') {
        # code...
    }
}








}

?>