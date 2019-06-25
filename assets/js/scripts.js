
window.addEventListener('load', recargar);

//metodo recargar informacion
function recargar(){
    var peticion=new XMLHttpRequest();
    peticion.onreadystatechange=function(){
        //verifica si el estado fue efectivo al cuerpo de mi tabla le concatene la respuestas
        //luego que llamame al metodo get por el protocolo https al metodo recargar
        if(this.readyState==4){
            document.getElementById('cuerpo').innerHTML=this.responseText;
            asignarEventos();
        }};
    peticion.open('GET', 'Usuarios/recargar');
    peticion.send();
}




//Evento controlador de evento pr nuestro botones
function asignarEventos(){
    // escucha del evento click y un metodo que se llama a
    document.getElementById('btn').addEventListener('click', accion);
    var btnEditar=document.getElementsByClassName('btnEditar');
    var btnEliminar=document.getElementsByClassName('btnEliminar');

    for (var index = 0; index <btnEditar.length; index++) {
        //hace un eveneto addeven y al darle click lo tiramos a un evento actualizar
        btnEditar[index].addEventListener('click', actualizar);
        btnEliminar[index].addEventListener('click', eliminar);
        
    }
}



function accion() {
    alert('BOTON AGREGAR O MODIFCAR');
    //recibimos este tipo de id
    var id=document.getElementById('id').value;

    var nombre=document.getElementById('txtNombre').value;
    var apellido=document.getElementById('txtApellido').value;

    //validadcion de datos no vaya vacios
    // if (nombre==""&apellido=="") {
    //     alert('Por favor ingresar todos lo campos')
    // }else{
    //  return;
    // }
        
    var peticion=new XMLHttpRequest();
    peticion.onreadystatechange=function(){
        //verifica si el estado fue efectivo al cuerpo de mi tabla le concatene la respuestas
        //luego que llamame al metodo get por el protocolo https al metodo recargar
        if(this.readyState==4){
            document.getElementById('cuerpo').innerHTML=this.responseText;
           
            recargar();
            limpiar();
            //contenido a monificar
            document.getElementById('btn').value="agregar";
            document.getElementById('btn').innerHTML="AGREGAR";
        }};


        //DATOS PARA EL MODIFICAR
        var datos='nombre='+nombre+"&apellido="+apellido;
        if (this.value=="update") {
            datos +='&id='+id;
        }
        alert(datos);



        peticion.open('POST', 'Usuarios/'+this.value);
        //se especifica lo que se le esta enviando un formato de que es

        peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        //nombre y aprellido son la claves pasadas en 
        peticion.send(datos);
    

}


function eliminar() {
    var peticion=new XMLHttpRequest();
    peticion.onreadystatechange=function(){
        //verifica si el estado fue efectivo al cuerpo de mi tabla le concatene la respuestas
        //luego que llamame al metodo get por el protocolo https al metodo recargar
        if(this.readyState==4){
            recargar();
        }};

       // una peticion de tipo get en mi controlador 
       //this value para que agarre le valor 
    peticion.open('GET', 'Usuarios/delete/'+this.value);
    peticion.send()
}



function limpiar(){
    document.getElementById('txtNombre').value='';
    document.getElementById('txtApellido').value='';
}


//tareaaaaaaaaaaa validadr que debe ir campos siempre con dcatos





//-----------------------------------------------------------------------
// ACTUALIZAR 

function actualizar() {
    var peticion=new XMLHttpRequest();
    peticion.onreadystatechange=function(){
        //verifica si el estado fue efectivo al cuerpo de mi tabla le concatene la respuestas
        //luego que llamame al metodo get por el protocolo https al metodo recargar
        if(this.readyState==4){
            document.getElementById('frm').innerHTML=this.responseText;
            recargar();
        }};

       // una peticion de tipo get en mi controlador 
       //this value para que agarre le valor 
    peticion.open('GET', 'Usuarios/getById/'+this.value);
    peticion.send()


    //ASDAS
}