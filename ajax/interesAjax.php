<?php
$peticionAjax=true;
 require_once("../core/configgeneral.php");
 if(isset($_POST['actualizarinteres'])){
    require_once("../controladores/interesControlador.php");
    
    //INSTANCIOAMOS LA CLASE
    $instInteres= new interesControlador();
    echo  $instInteres->actualizar_interes_controlador();
   
 }else{

 }