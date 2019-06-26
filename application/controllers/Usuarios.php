<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once('C:/xampp/htdocs/proyectoRest/application/helpers/encabezadoApi.php');

class Usuarios extends CI_Controller
{

  // $encabezado = new Encabezados();
  
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




















  private $correcto=['respuesta' => 'Correctamente Realizado'];
  private $incorrecto=['Error' => 'Fallo Algun proceso'];

  //-------METODOS PARA API RETFULL GET, POST, PUT, DELETE-------------//


  function encabeza($metodo, $param=false){
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: '.$metodo.'"');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    //Si RECIBE PARAMETROS RETORNARA DATOS
    if ($param) {
      if ($data = json_decode(file_get_contents("php://input"), true)) {
        //Obteniendo
        return $datos = json_decode(file_get_contents("php://input"), true);
        
       } else {
        return $_REQUEST;      
      }
    }
  }





  public function cargarUsuario($id = null)
  {
   
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $this->encabeza($_SERVER['REQUEST_METHOD']);
      if (isset($id)) {
        $dato = $this->UsuariosModel->getById($id);
        header("HTTP/1.1 200 OK");
        echo json_encode($this->correcto);
        //echo json_encode($dato);
      } else {
        $data = $this->UsuariosModel->getAll();
        header("HTTP/1.1 200 OK");
        echo json_encode($this->correcto);
        echo json_encode($dato);
      }
    }
  }


  public function ingresarUsuario()
  {
    
    if (($_SERVER['REQUEST_METHOD'] == 'POST')&&($_SERVER!=null)) {
      
      $datos = $this->encabeza($_SERVER['REQUEST_METHOD'], true);
      $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido']];    
      
      $this->UsuariosModel->ingresar($data);
      header("HTTP/1.1 200 OK");
      echo json_encode($this->correcto);
      // echo json_encode($data);
      exit();
    } else {
      header("HTTP/1.1 400 ERROR");
      echo json_encode($this->incorrecto);
      exit();
    }
  }


  
  public function eliminarUsuario($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
      $this->encabeza($_SERVER['REQUEST_METHOD']);
      if (isset($id)) {
        $this->UsuariosModel->delete($id);
        header("HTTP/1.1 200 OK");
        echo json_encode($this->correcto);
        exit();
      } else {
        header("HTTP/1.1 500 ERROR");
        exit();
      }
    } else {
      header("HTTP/1.1 400 ERROR");
      exit();
    }
  }



  public function modificarUsuario()
  {

    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
      $datos = $this->encabeza($_SERVER['REQUEST_METHOD'], true);
      $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido'], 'id' => $datos['id']];
      
      $this->UsuariosModel->update($data);
      header("HTTP/1.1 200 OK");
      echo "ERROR NO SE ACTUALIZADO";
      echo json_encode($datos);

      exit();
    } else {
      header("HTTP/1.1 400 ERROR");
      echo "ERROR NO SE ACTUALIZADO";
      exit();
    }
  }
}