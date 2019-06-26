<?php
class ControllerRest extends CI_Controller {

public function __construct(){

 parent::__construct();
 //Leo el modelo de la base de datos
 $this->load->model('UsuariosModel');
} 




//VARIABLE PARA MOSTRAR EN LOS RESULTADOS

private $correcto=['respuesta' => 'Metodo correctamente Realizado'];
private $incorrecto=['Error' => 'Fallo Algo del proceso'];

  

//-------METODOS PARA API RETFULL GET, POST, PUT, DELETE-------------//




  //METODO PARA PONER LOS ENCABEZADOS RECIBE UN METODO RESQUEST Y UN PARAMETRO TRUE SI DEVUELVE DATOS
  function encabezado($metodo, $param=false)
  {
    //HEADER PARA DEFINIR LO QUE SE MANDARA Y RECIBIRA POR LO API.
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: '.$metodo.'"');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    //SI RECIBE PARAMETROS RETORNARA DATOS
    if ($param) {
        //VERIFICA SI ES UNA JSON LO QUE VIENE
        if ($data = json_decode(file_get_contents("php://input"), true)) {
        //RETORNA EL DATOS EN TEXTO PLANO
        return $datos = json_decode(file_get_contents("php://input"), true);
        
       } else {
        //RETORNA EN ESTE CASO TEXTO PLANO
        return $_REQUEST;      
      }
    }
  }





  //METODO PARA API GET QUE PUEDE O NO RECIBIR UN ID DE USUARIO
  public function get($id = null)
  {
   
    try {
        //VERIFICACION DE QUE METODO HTTP GET 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //LLAMADA AL FUNCION ENCABEZADOS PARA PONERLO HEADER
            $this->encabezado($_SERVER['REQUEST_METHOD']);
            
            if (isset($id)) {
                
                if($dato = $this->UsuariosModel->getById($id)){
                    header("HTTP/1.1 200 OK");
                    echo json_encode($this->correcto);
                    echo json_encode($dato);
                }else{
                    header("HTTP/1.1 500 ERROR DATA");
                    echo json_encode($this->incorrecto);
                }
              
            } else {
              $data = $this->UsuariosModel->getAll();
              header("HTTP/1.1 200 OK");
            //   echo json_encode($this->correcto);
              echo json_encode($data);
            }
          }else{
            json_encode($this->incorrecto);
          }
        } catch (Exception $e) {
        echo $e;echo json_encode($this->incorrecto);
    }
    
  }


  public function create()
  {
    try{
    
        if (($_SERVER['REQUEST_METHOD'] == 'POST')&&($_SERVER!=null)) {
      
            $datos = $this->encabezado($_SERVER['REQUEST_METHOD'], true);
            $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido']];    
            
            $this->UsuariosModel->ingresar($data);
            header("HTTP/1.1 200 OK");
            array_push($this->correcto, $data);
            // echo json_encode($this->correcto);
            echo json_encode($this->correcto);
     
        } else {
            header("HTTP/1.1 400 ERROR");
            echo json_encode($this->incorrecto);
      
        }
        } catch (Exception $e) {
        echo $e;echo json_encode($this->incorrecto);
    }

  }


  
  public function delete($id=null)
  {
      try{

        if (($_SERVER['REQUEST_METHOD'] == "DELETE")&&($id!=null)) {
                  $this->encabezado($_SERVER['REQUEST_METHOD']);
    
                  if (isset($id)) {
                    $this->UsuariosModel->delete($id);
                        header("HTTP/1.1 200 OK");
                        echo json_encode($this->correcto);
                    
                } else {
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);

                    }
                } else {
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);
                }} catch (Exception $e) {
                    echo $e;echo json_encode($this->incorrecto);
                }
  }



  public function update()
  {
      try{
              if ($_SERVER['REQUEST_METHOD'] == "PUT") {
                $datos = $this->encabezado($_SERVER['REQUEST_METHOD'], true);
                $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido'], 'id' => $datos['id']];
                
                $this->UsuariosModel->update($data);

                    array_push($this->correcto, $data);
                    echo json_encode($this->correcto);
                } else {
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);
                }
                } catch (Exception $e) {
                    echo $e;echo json_encode($this->incorrecto);
                }}

}

?>