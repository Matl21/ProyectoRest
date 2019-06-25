<?php

class UsuariosModel extends CI_Model{

    //medtodo get
    public function getAll(){
        //referencia a la tabla de la base
        return $this->db->get('usuarios')->result();
    }




    //POST

    public function ingresar($datos){
     //haciendo sentencia en CODEIGNITER
        $sql="INSERT INTO USUARIOS(nombre, apellido) VALUES(?,?)";
    //MANDA LA CONSULTA Y LOS DATO A UN METODO YA CREADO OR CODE IGNATE
        $this->db->query($sql, $datos);
    }



    //METODO PARA ELIMINAR
    public function delete($id){
    $this->db->query("DELETE FROM usuarios WHERE id=$id");

    }





///---------------------- METODOS DE MODIFICAER.---------------------


public function getById($id){
    //
    return $this->db->query("SELECT * FROM USUARIOS WHERE id=$id")->row();
    //se pasa el metodo row porque el entontrara una lista pero no interesara un registro de ea lisra
}




// METODO UPDATE FINISH
public function update($data){
    //haciendo sentencia en CODEIGNITER
       $sql="UPDATE USUARIOS SET nombre=?, apellido=? WHERE id=?";
   //MANDA LA CONSULTA Y LOS DATO A UN METODO YA CREADO OR CODE IGNATE
       $this->db->query($sql, $data);
   }










}

?>