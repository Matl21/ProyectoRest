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




  //METODO PARA PONER LOS ENCABEZADOS SEGUN EL METODO HTTP A USAR Y UN PARAMETRO TRUE SI RECIBE Y DEVUELVE DATOS
  function encabezado($metodo, $param=false)
  {
    //HEADER PARA DEFINIR LO QUE SE MANDARA Y RECIBIRA POR LO API.
    //ENCABEZADO PARA RECIBIR Y OBJETO DE TIPO JSON ADEMAS TEXT PLANO, METODOS A RECIBIR, AUTENTIFICACION ETC.
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: '.$metodo.'"');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    //SI RECIBE PARAMETROS RETORNARA DATOS
    if ($param) {
        //VERIFICACION SI EL DATO RECIBIDO ES UN JSON LO QUE VIENE
        if ($data = json_decode(file_get_contents("php://input"), true)) {
        //CAPTACION DE DATO Y RETORNA DEL DATOS PERO TRANFORMADO A TEXTO PLANO
        return $datos = json_decode(file_get_contents("php://input"), true);
        
       } else {
        //CAPTACION DE DATO Y RETORNA EN TEXTO PLANO
        return $_REQUEST;      
      }
    }
  }





  //METODO PARA API GET QUE PUEDE O NO RECIBIR UN ID DE USUARIO
  public function get($id = null)
  {
   
    //TRY CATCH POR CUALQUIER PROBLEMA REALIZADO DURANTE LA PETICION
    try {
        //VERIFICACION DE QUE METODO HTTP GET 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //LLAMADA A LA FUNCION ENCABEZADOS PARA PONERLO HEADER
            $this->encabezado($_SERVER['REQUEST_METHOD']);
            
            //VERIFICAMOS SI HAY DATOS EN EL ID PARA MOSTRA UN DATO
            if (isset($id)) {
                //OBTENEMOS EL REGISTRO  DE LA BASE CON EL METODO DEL MODEL GETBYID
                $dato = $this->UsuariosModel->getById($id);
                //ENCABEZADO DE QUE SE A REALIZADO CORRECTAMENTE LA PETICION
                header("HTTP/1.1 200 OK");
                //   echo json_encode($this->correcto);

                //PRESENTACION DEL REGISTRO OBTENIDO
                echo json_encode($dato);            
         
            } else {
                //OBTENEMOS LOS REGISTRO  DE LA BASE CON EL METODO DEL MODEL GETALL
              $data = $this->UsuariosModel->getAll();
              header("HTTP/1.1 200 OK");
            //   echo json_encode($this->correcto);
              
            //PRESENTACION DE TODOS LOS DATOS OBTENIDOS EN LA PETICION
              echo json_encode($data);
            }
            
          }else{
            //MENSAJE Y HEADER POR SI NO ES EL METODO HTTP CORRECTO
            echo json_encode($this->incorrecto);
            header("HTTP/1.1 400 OK");
          }

        } catch (Exception $e) {
            //MENSAJE POR SI OCURRE UNA EXCEPCION
            echo $e;echo json_encode($this->incorrecto);
    }
    
  }


  //METODO DE API PARA POST DE DATOS DE USUARIOS 
  public function create()
  {
    //TRY CATCH POR CUALQUIER PROBLEMA REALIZADO DURANTE LA PETICION
    try{
        //VERIFICACION DE QUE METODO HTTP POST Y SI LO DATOS NO VIENE VACIOS
        if (($_SERVER['REQUEST_METHOD'] == 'POST')&&($_SERVER!=null)) {
            
            //LLAMADA AL METODO ENCABEZADOS PARA PONERLO HEADER
            $datos = $this->encabezado($_SERVER['REQUEST_METHOD'], true);

            //VECTOR DE ASIGNACION DE LOS DATOS EN CASO DE NO VENIR ORDENADAMENTE YA SE POR TEXT PLAIN O JSON
            $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido']]; 

            //REALIZACION DE LA INSERCION EN LA BASE CON EL METODO DEL MODEL INGRESAR
            $this->UsuariosModel->ingresar($data);

            //ENCABEZADO DE QUE SE A REALIZADO CORRECTAMENTE LA PETICION
            header("HTTP/1.1 200 OK");
            
            //UN ARRAY PUSH PARA ABJUNTAR LA RESPUESTA RECIBIDA Y DATOS INGRESADO SOLO PARA PRESENTACION
            array_push($this->correcto, $data);
            // echo json_encode($this->correcto);

            //PRESENTACION DE TODOS LOS DATOS OBTENIDOS EN LA PETICION
            echo json_encode($this->correcto);
     
        } else {
             //MENSAJE Y HEADER POR SI NO ES EL METODO HTTP CORRECTO  
             header("HTTP/1.1 400 ERROR");          
            echo json_encode($this->incorrecto);
      
        }
        } catch (Exception $e) {
            //MENSAJE POR SI OCURRE UNA EXCEPCION
        echo $e;echo json_encode($this->incorrecto);
    }

  }


  
  public function delete($id=null)
  {
      try{

        //VERIFICACION SI ES EL METODO HTTP DELETE Y SI EL ID NO VIENE VACIO
        if (($_SERVER['REQUEST_METHOD'] == "DELETE")&&($id!=null)) {
            
                 //LLAMADA AL METODO ENCABEZADOS PARA PONERLO HEADER
                  $this->encabezado($_SERVER['REQUEST_METHOD']);
    
                  //VERIFICAMOS SI HAY DATOS EN EL ID PARA MOSTRA UN DATO
                  if (isset($id)) {
                    //REALIZACION DE LA ELIMINACION EN LA BASE CON EL METODO DEL MODEL DELETE
                    $this->UsuariosModel->delete($id);
                    
                    //PRESENTACION DEL HEADER Y UN MENSAJE QUE MUESTRA DE MUESTRA
                    header("HTTP/1.1 200 OK");
                    echo json_encode($this->correcto);
                    
                } else {
                    //MENSAJE Y HEADER POR SI NO ES EL METODO HTTP CORRECT
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);

                    }
                } else {
                    //MENSAJE Y HEADER POR SI NO ES EL METODO HTTP CORRECT
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);
                }} catch (Exception $e) {
                    //MENSAJE POR SI OCURRE UNA EXCEPCION
                    echo $e;echo json_encode($this->incorrecto);
                }
  }



  public function update()
  {
      try{
                 //VERIFICACION SI ES EL METODO HTTP ES PUT
            if ($_SERVER['REQUEST_METHOD'] == "PUT") {
                 
                //LLAMADA AL METODO ENCABEZADOS PARA PONERLO HEADER
                $datos = $this->encabezado($_SERVER['REQUEST_METHOD'], true);

                //VECTOR DE ASIGNACION DE LOS DATOS EN CASO DE NO VENIR ORDENADAMENTE YA SE POR TEXT PLAIN O JSON
                $data = ['nombre' => $datos['nombre'], 'apellido' => $datos['apellido'], 'id' => $datos['id']];
                
                //REALIZACION DE LA UPDATE EN LA BASE CON EL METODO DEL MODEL UPDATE
                $this->UsuariosModel->update($data);

                //UN ARRAY PUSH PARA ADJUNTAR LA RESPUESTA RECIBIDA Y DATOS INGRESADO SOLO PARA PRESENTACION
                array_push($this->correcto, $data);
                echo json_encode($this->correcto);
                
            } else {
                //MENSAJE Y HEADER POR SI NO ES EL METODO HTTP CORRECT
                    header("HTTP/1.1 400 ERROR");
                    echo json_encode($this->incorrecto);
            }
                } catch (Exception $e) {
                    //MENSAJE POR SI OCURRE UNA EXCEPCION
                    echo $e;echo json_encode($this->incorrecto);
                }}

}

?>