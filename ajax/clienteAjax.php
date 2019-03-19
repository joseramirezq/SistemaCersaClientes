<?php

$peticionAjax=true;
require_once("../core/configgeneral.php");

if (isset($_POST['nombre'])) {
    require_once('../controladores/clienteControlador.php');
    $instanciaCliente = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['nombre'])) {
            echo $instanciaCliente->agregar_cliente_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }
}
else{
    //aqui debemos votar al login porque ha ocurido quizas una insercion
}
