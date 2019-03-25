<?php
     
        if ($peticionAjax) {
            require_once('../modelos/estadisticasModelo.php');
           
        } else {
            require_once('./modelos/estadisticasModelo.php');
          
        }

        class estadisticasControlador extends estadisticasModelo{

           

        public function total_clientes_controlador()
        {
            $cantidadCli="";
            $table="";
            
            $conexion=mainModel::conectar();

            //cantidad de clientes en total
            $datosCli = $conexion->query("
            SELECT COUNT(*) AS TOTAL FROM cliente");
             $datosCli = $datosCli->fetchAll();
            foreach ($datosCli as $rowsCli) {
            $cantidadCli=$rowsCli['TOTAL'];
        }

 
        //cantidad de nuevos REVISAR NO FUNCIONA ESTA FUNCION
        $totalhoy="";
        $datosClifecha = $conexion->query("
        
        SELECT COUNT(*) AS TOTALHOY FROM cliente WHERE fecha_registro < NOW();");
         $datosClifecha = $datosClifecha->fetchAll();
        foreach ($datosClifecha as $rows) {
        $totalhoy=$rows['TOTALHOY'];
    }

    $table.='   <p class="mb-2">Total de Clientes</p> <p class="display-3 mb-4 font-weight-light">'.$cantidadCli.'</p>';
    $table.='    <p class="mb-2">Clientes Nuevos</p><p class="display-3 mb-4 font-weight-light">'.$totalhoy.'</p> </div>
    </div>';
   
    //cantidad de estados
    $cantestados="";
    $datoscantestado = $conexion->query("
    SELECT COUNT(*) AS totalestado FROM interes");
     $datoscantestado = $datoscantestado->fetchAll();
    foreach ($datoscantestado as $rowsestadocant) {
    $cantestados=$rowsestadocant['totalestado'];
    }

    $table.='
    <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">TOTAL DE ESTADOS</p>
                      <p class="mb-2 text-primary">100% -'.$cantestados.'</p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
    </div><hr>';


    //estados de cada interes
    $idestado=0;
    $datosestadoG = $conexion->query("
    SELECT *  FROM estado");
     $datosestadoG = $datosestadoG->fetchAll();
    foreach ($datosestadoG as $rowsestadog) {
    $idestado=$rowsestadog['idestado'];
   

    $porcentaje=0;
    $estados="";
    $datosestado = $conexion->query("
    SELECT COUNT(*) AS totalestado FROM interes WHERE idestado='$idestado'");
     $datosestado = $datosestado->fetchAll();
    foreach ($datosestado as $rowsestado) {
    $estados=$rowsestado['totalestado'];
    }
    $porcentaje=($estados*100)/$cantestados;

    $table.='
    <style>
    .bcolores{
        background-color: '.$rowsestadog['color'].';
    }
    </style>
    <div class="wrapper">
    <div class=" d-flex justify-content-between">
      <p class="mb-2">'.$rowsestadog['nombre_estado'].'</p>
      <p class="mb-2 text-primary">'.$porcentaje.'% -'.$estados.'</p>
    </div>
    <div class="progress">
      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: '.$porcentaje.'%" aria-valuenow="'.$estados.'" aria-valuemin="0" aria-valuemax="'.$cantestados.'"></div>
    </div>
  </div>
  <hr> ';
   

}



    
    
  
          
              return $table;

        }
        
    
    }