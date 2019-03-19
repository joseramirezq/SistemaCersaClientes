<?php
 $peticionAjax=true;
 require_once("../core/configgeneral.php");
//echo "probando al admin";

if(isset($_POST['nombre'])){
     require_once("../controladores/cursoControlador.php");
     
     //INSTANCIOAMOS LA CLASE
     $instanciaCurso= new cursoControlador();
    //valida los campos requeridos
     if(isset($_POST['nombre'])){
        echo  $instanciaCurso->agregar_curso_controlador();
     }else{

     }

 }else{
}
 
