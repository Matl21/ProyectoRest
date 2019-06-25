<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

  public function __construct()
  {

    parent::__construct();
    //leer el model
    $this->load->model('UsuariosModel');
  }





  public function index()
  {

    //mandar mensajea nuestra vistas
    $datos['titulo'] = 'CONTROLADOR DE USUARIOS';

    //CARGANDO LA VISTA
    $this->load->view('Usuarios/index.php', $datos);
  }



  //metodo de cargar los datos

  public function recargar()
  {
    $data = ['usuarios' => $this->UsuariosModel->getAll()];


    //renderizar la vista
    $this->load->view('usuarios/tabla', $data);
  }


  //METODO PARA 

  public function agregar()
  {
    $data = [$_POST['nombre'], $_POST['apellido']];

    //para llamar el metodo que hara la insersion a la base de datos
    $this->UsuariosModel->ingresar($data);


    // //renderizar la vista
    // $this->load->view('usuarios/tabla', $data);
  }


  //METODO DELETEAR 
  public function delete($id)
  {
    //llamar el metodo delete de mi modelo
    $this->UsuariosModel->delete($id);
  }







  //METODO DE GETBYID PARA MODIFIVCAR
  public function getById($id)
  {
    //obtiene el registro de la BD
    $dato = ['usuarios' => $this->UsuariosModel->getById($id)];
    //enviando el registro de la base de datos
    $this->load->view('usuarios/form', $dato);
  }





  public function update()
  {
    $data = [$_POST['nombre'], $_POST['apellido'], $_POST['id']];

    //para llamar el metodo que hara la updaye a la base de datos
    $this->UsuariosModel->update($data);


    // //renderizar la vista
    // $this->load->view('usuarios/tabla', $data);
  }


  public function json()
  {
    echo json_encode($this->UsuariosModel->getAll());
  }










  //METODOS RESFULLL


  public function cargarUsuario($id=null)
  {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     
      
      if (isset($id)) {
        $dato =$this->UsuariosModel->getById($id);
        echo json_encode($dato);
        header("HTTP/1.1 200 OK");
       
      }else{

        $data = $this->UsuariosModel->getAll();
        header("HTTP/1.1 200 OK");
        echo json_encode($data);

      }
     }
    
  }


  public function ingresarUsuario()
  {
   
    if (($_SERVER['REQUEST_METHOD'] == 'POST')&&($_REQUEST!=null) ) {
       $dato=$_REQUEST;
       header("HTTP/1.1 200 OK");
       $this->UsuariosModel->ingresar($dato);
       echo json_encode($dato);
       exit();
      }else{
        header("HTTP/1.1 400 ERROR");
        exit();
      }}
    

  public function eliminarUsuario($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
      
      if (isset($id)) {
        $this->UsuariosModel->delete($id);
        header("HTTP/1.1 200 OK");
        echo "BORRADO EXITOSAMENTE";
        exit();
      }else{
      header("HTTP/1.1 500 ERROR");
      exit();
      }}else{
        header("HTTP/1.1 400 ERROR");
        exit();
      }
    }

      public function modificarUsuario()
      {

    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
      
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: PUT');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
      header("HTTP/1.1 200 OK");
      $datos = json_decode(file_get_contents("php://input"), true); 
      
      $data = [
        'nombre' => $datos['nombre'],
        'apellido' => $datos['apellido'],
        'id' => $datos['id']];

      var_dump($data);


      $this->UsuariosModel->update($data);
      echo json_encode($datos);
      echo " REGISTRO ACTUALIZADO EXITOSAMENTE";
      exit();
     }else{
       header("HTTP/1.1 400 ERROR");
       exit();
     }}













}
