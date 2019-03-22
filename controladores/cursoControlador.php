<?php


if ($peticionAjax) {
    require_once('../modelos/cursoModelo.php');
} else {
    require_once('./modelos/cursoModelo.php');
}

class cursoControlador extends cursoModelo
{

    public function agregar_curso_controlador()
    {
        $categoria = mainModel::limpiar_cadena($_POST['categoria']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $duracion = mainModel::limpiar_cadena($_POST['duracion']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $fechainicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fechafin = mainModel::limpiar_cadena($_POST['fechafin']);
        $horario = mainModel::limpiar_cadena($_POST['horario']);
        $costomatricula = mainModel::limpiar_cadena($_POST['costomatricula']);
        $costocertificado = mainModel::limpiar_cadena($_POST['costocertificado']);
        $costoalternativo = mainModel::limpiar_cadena($_POST['costoalternativo']);
        $horascertificado = mainModel::limpiar_cadena($_POST['horascertificado']);
        $modalidad = mainModel::limpiar_cadena($_POST['modalidad']);
        $docente = mainModel::limpiar_cadena($_POST['docente']);

        $datosCurso = [
            "Categoria" => $categoria,
            "Nombre" => $nombre,
            "Descripcion" => $descripcion,
            "Duracion" => $duracion,
            "FechaI" => $fechainicio,
            "FechaF" => $fechafin,
            "Horario" => $horario,
            "Costomatricula" => $costomatricula,
            "Costocerti" => $costocertificado,
            "Costoalternativo" => $costoalternativo,
            "Horascerti" => $horascertificado,
            "Modalidad" => $modalidad,
            "Docente" => $docente

        ];
        $guardarCurso = cursoModelo::agregar_curso_modelo($datosCurso);
    }


    //mostrar tabla estados
    public function leer_cursos_controlador()
    {
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM especialidad WHERE estado_actual=0 ORDER BY fecha_registro");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            //nombre de la categoia
            $idcat = $rows['idcategoria'];
            $datos2 = $conexion->query("
            SELECT * FROM categoria WHERE idcategoria='$idcat'");
            foreach ($datos2 as $rows2) {
                $cat = $rows2['nombre_cat'];
            }


            //total de interesados
            $ides = $rows['idespecialidad'];
            $datos3 = $conexion->query("
            SELECT COUNT(*) as total FROM interes WHERE idespecialidad='$ides'");

            foreach ($datos3 as $rows3) {
                $cat = $rows3['total'];
            }

            //cantidad de clientes por estados
            //$ides=$rows['idespecialidad'];
            $datos4 = $conexion->query("
             SELECT COUNT(*) as totales FROM interes WHERE idespecialidad='$ides' AND idestado=30");

            foreach ($datos4 as $rows4) {
                $cant = $rows4['totales'];
            }

            $table .= '
                <tr>
                            <td>' . $rows['idespecialidad'] . '</td>
                            <td>' . $cat . '</td>
                            <td>' . $rows['nombre_es'] . '</td>
                            <td>' . $cat . '</td>
                            <td>' . $rows['fecha_inicio'] . '</td>
                            <td class="text-danger">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-inverse-warning btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#' . $rows['idespecialidad'] . '">
                                        Detalle
                                    </button>

                                </div>
                            </td>

                            <td>
                                <a href="cursodetalle.php" class="btn btn-inverse-dark ">Ver</a>
                            </td>
                </tr>

                <!--nodal de la tabla de curos-->
                <div class="modal fade" id="' . $rows['idespecialidad'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header bg-dark">
                                <h3 class="text-light text-center">Detalle de clientes por estado: ' . $rows['nombre_es'] . '</h3>
            
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-white">×</span>
                                </button>
                            </div>
            
                            <!--Body-->
                            <div class="modal-body">
                                <div class="row ">
                                
                                    <div class="col-md-3 badge badge-warning">
                                        <div class="wrapper d-flex justify-content-between">
                                            <div class="side-left">
                                                <p class="mb-2">Estado 1</p>
                                                <p class="display-3 mb-4 font-weight-light">40</p>
                                            </div>
            
                                        </div>
                                    </div>
            
            
                                    
                                </div>
            
            
            
                            </div>
                        </div>
                    </div>
                </div> 

            ';
        }
        return $table;
    }



    //mostrar cursos en el inicio
    public function mostrar_cursos_controlador()
    {
        
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //validacion 
        $codigousuario=$_SESSION['codigo_srcp'];
        $con=0;
        $datosSesion = $conexion->query("
        SELECT COUNT(*) AS sesiones FROM especialidad WHERE sesion='$codigousuario'");

        $datosSesion = $datosSesion->fetchAll();
        foreach ($datosSesion as $rowssesion) {
           if($rowssesion['sesiones']>=1){
                $con=1;
           }
        }

        if($con==0){
        $datos = $conexion->query("
            SELECT * FROM especialidad WHERE estado_actual=0  ORDER BY 	fecha_inicio");
    
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {


            $tarjeta .= '
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
              <div class="card-body">
                <div class="clearfix">
                  <h4 class="text-center">'.$rows['nombre_es'].'</h4>
                  <div class="float-left">
                    <div class="d-flex flex-row align-items-center">
                        <i class="mdi mdi-compass icon-sm text-danger"></i>
                          <p class="mb-0 ml-1">
                          '.$rows['fecha_inicio'].'
                          </p>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                          <i class="mdi mdi-compass icon-sm text-danger"></i>
                          <p class="mb-0 ml-1">
                          '.$rows['costo_matricula'].'
                          </p>
                      </div>
                    
                  </div>
                  <div class="float-right">
                    <p class="mb-0 text-right">Registros</p>
                    <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">';

            $idinteres= $rows['idespecialidad'];
             $datos2 = $conexion->query("
            SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres");
            $datos2 = $datos2->fetchAll();
            foreach ($datos2 as $rows2) {
                
            $tarjeta .= '<p> '.$rows2['total'].'</p>';

            }
            $tarjeta .= '
                        </h3>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                   <div class="btn-group" role="group" aria-label="First group">';

               if($rows['sesion']==$_SESSION['codigo_srcp']){
                $tarjeta .= '<a href="sesioncurso" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a>
               ';
             }
                if($rows['sesion']=="disponible"){
                  $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                    <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                    <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                    <button type="submit" name="ocuparcurso"  class="btn btn-primary"><i class="fa fa-star-o"></i> Disponible </button>
                   </form>  ';
                }

                if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                    $tarjeta .= '<a href="" class="btn btn-warning"><i class="fa fa-star-o"></i> Ocupado</a>
                   ';
                 }

                
            $tarjeta .= '<a href="http://"><button type="button" class="btn btn-dark"><i class="fa fa-eye"></i> Ver</button></a>
                      </div>
                  </div>
                  
                </div>
                
              
                ';
                  
                    $codigouser=$rows['sesion'];
                    $datosUSER = $conexion->query("
                        SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
                
                    $datosUSER = $datosUSER->fetchAll();
                    foreach ($datosUSER as $rowsUSER) {
                     $tarjeta .= ' <p class="text-muted mt-3 mb-0">
                     <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> '.$rowsUSER['nombre_us'].'</p>';
                    }
            $tarjeta .= ' 
              </div>
            </div>
          </div>

                ';
        }}

        if($con==1){
            $datos = $conexion->query("
                SELECT * FROM especialidad WHERE sesion!='disponible'  ORDER BY 	fecha_inicio");
        
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
    
    
                $tarjeta .= '
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="text-center">'.$rows['nombre_es'].'</h4>
                      <div class="float-left">
                        <div class="d-flex flex-row align-items-center">
                            <i class="mdi mdi-compass icon-sm text-danger"></i>
                              <p class="mb-0 ml-1">
                              '.$rows['fecha_inicio'].'
                              </p>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                              <i class="mdi mdi-compass icon-sm text-danger"></i>
                              <p class="mb-0 ml-1">
                              '.$rows['costo_matricula'].'
                              </p>
                          </div>
                        
                      </div>
                      <div class="float-right">
                        <p class="mb-0 text-right">Registros</p>
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0">';
    
                $idinteres= $rows['idespecialidad'];
                 $datos2 = $conexion->query("
                SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres");
                $datos2 = $datos2->fetchAll();
                foreach ($datos2 as $rows2) {
                    
                $tarjeta .= '<p> '.$rows2['total'].'</p>';
    
                }
                $tarjeta .= '
                            </h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                       <div class="btn-group" role="group" aria-label="First group">';
    
                   if($rows['sesion']==$_SESSION['codigo_srcp']){
                    $tarjeta .= '<a href="sesioncurso" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a>
                   ';
                 }
                    if($rows['sesion']=="disponible"){
                      $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                        <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                        <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                        <button type="submit" name="ocuparcurso"  class="btn btn-primary"><i class="fa fa-star-o"></i> Disponible </button>
                       </form>  ';
                    }
    
                    if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                        $tarjeta .= '<a href="" class="btn btn-warning"><i class="fa fa-star-o"></i> Ocupado</a>
                       ';
                     }
    
                    
                $tarjeta .= '<a href="http://"><button type="button" class="btn btn-dark"><i class="fa fa-eye"></i> Ver</button></a>
                          </div>
                      </div>
                      
                    </div>
                    
                  
                    
                ';
                  
                $codigouser=$rows['sesion'];
                $datosUSER = $conexion->query("
                    SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
            
                $datosUSER = $datosUSER->fetchAll();
                foreach ($datosUSER as $rowsUSER) {
                 $tarjeta .= ' <p class="text-muted mt-3 mb-0">
                 <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Usuario:  '.$rowsUSER['nombre_us'].'</p>';
                }
        $tarjeta .= ' 
                  </div>
                </div>
              </div>
    
                    ';
            }}
        return $tarjeta;
    }

    /*public function iniciar_sesion_curso(){
        session_start(['name'=>'SRCP']);

        if($_SESSION['sesioncurso']=="libre"){
            $Codigo=$_GET['Curso'];
           //$Codigo=1;
           $_SESSION['curso']= $Codigo;
            $datos=[
                "Usuario"=>$_SESSION['codigo_srcp'],
                 "Curso"=>$Codigo
              
            ];
            //return "true";
            return cursoModelo::iniciar_sesion_curso_modelo($datos);
        }
        else if($_SESSION['sesioncurso']=="ocupado"){
            return "ocupado";
        }else{
            return "false";
        }
     
       
    }*/

   /* public function cerrar_sesion_curso(){
        session_start(['name'=>'SRCP']);

        if($_SESSION['sesioncurso']=="ocupado"){
            $Codigo=$_GET['Especialidad'];
           //$Codigo=1;
         
            $datos=[
              
                 "Curso"=>$Codigo
              
            ];
            //return "true";
            return cursoModelo::cerrar_sesion_curso_modelo($datos);
        }
       else{
            return "false";
        }
     
       
    }*/
     //mostrar cursos en el inicio
    /* public function mostrar_sesion_cursos_controlador()
     {
        //session_start(['name'=>'SRCP']);
        //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
         $tarjeta = "";
         $conexion = mainModel::conectar();
         $curso=$_SESSION['curso'];      
         $datosd = $conexion->query("
             SELECT * FROM especialidad WHERE idespecialidad='$curso' ");
 
         $datosd = $datosd->fetchAll();
         foreach ($datosd as $rows) {
 
 
             $tarjeta .= '
                    '.$rows['nombre_es'].'
                
                 ';
         }
         return $tarjeta;
     }
*/

     public function mostrar_sesion2_cursos_controlador()
     {
        $codigocurso = mainModel::limpiar_cadena($_POST['codigocurso']);
        $codigousuario = mainModel::limpiar_cadena($_POST['codigousuario']);
       

        $datosCurso = [
            "Codigocurso" => $codigocurso,
            "Codigusuario" => $codigousuario,
        

        ];
        $guardarsesionCurso = cursoModelo::agregar_sesion_curso_modelo($datosCurso);
        if($guardarsesionCurso->rowCount()>=1){
            $direccion=SERVERURL."sesioncurso";
           header('location:'.$direccion);

          
        }

        
    
    
    }

    public function cerrar_cursos2_controlador()
    {
       $codigocerrar= mainModel::limpiar_cadena($_POST['codigocerrar']);
     
       $datosCursoCerrar = [
           "Codigocursoc" => $codigocerrar  

       ];
       $guardarsesionCurso = cursoModelo::cerrar_sesion_curso_modelo($datosCursoCerrar);
       if($guardarsesionCurso->rowCount()>=1){
           $direccion=SERVERURL."home";
          header('location:'.$direccion);
         
       }
 
   }


    public function sesion_curso_exitoso_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $tarjeta = "";
        $conexion = mainModel::conectar();
        $usuario=$_SESSION['codigo_srcp'];
        $datosd = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");

        $datosd = $datosd->fetchAll();
        foreach ($datosd as $rows) {


            $tarjeta .= '<h3 class="text-primary">'.$rows['nombre_es'].'
                   <div class="btn-group dropdown float-right">
                        <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#agregarcli">
                            Agregar Cliente
                        </button>

                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            En línea
                        </button>
                        <div class="dropdown-menu ">
                            <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">       
                            
                                <input type="hidden" name="codigocerrar" value="'.$rows['idespecialidad'].'">
                                   <button  type="submit" name="cerrarcurso" class="dropdown-item text-danger " >
                                <i class="fa fa-reply fa-fw"></i>
                                <p class="">Cerrar Session</p>
                            </button>
                            </form> 
                        </div>
                    </div>
                    </h3>
                ';

                //Descripcion del curso 
                $tarjeta .= '
                    <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title text-success mb-2">
                                    Detalle del Curso/Diplomado
                                </h2>

                                <div class="row">
                                    <div class="col-md-3">
                                        <address class="">
                                            <p class="font-weight-bold">
                                                Fecha
                                            </p>
                                            <p class="mb-2">
                                            '.$rows['fecha_inicio'].'
                                            </p>
                                            <p class="font-weight-bold">
                                                Duración
                                            </p>
                                            <p>
                                            '.$rows['duracion_es'].'
                                            </p>
                                        </address>
                                    </div>

                                    <div class="col-md-3">
                                        <address class="">
                                            <p class="font-weight-bold">
                                                Modalidad
                                            </p>
                                           
                                             '; 
                                             
                                    if($rows['modalidad']==1){
                                        $tarjeta .= '<p class="mb-2">Virtual en Vivo</p>';
                                            }
                                          else  if($rows['modalidad']==2){
                                                $tarjeta .= '<p class="mb-2">Solo Accesos</p>';
                                                    }else{
                                                        $tarjeta .= '<p class="mb-2">Presencial</p>';
                                              
                                                    }
                                    $tarjeta .= ' 
                                            <p class="font-weight-bold">
                                                Certificacion
                                            </p>
                                            <p>
                                            '.$rows['horas_certificado'].'
                                            </p>
                                        </address>
                                    </div>

                                    <div class="col-md-3">
                                        <address class="">
                                            <p class="font-weight-bold">
                                                Costo matricula
                                            </p>
                                            <p class="mb-2">
                                            '.$rows['costo_matricula'].'
                                            </p>
                                            <p class="font-weight-bold">
                                                Costo certificado
                                            </p>
                                            <p>
                                            '.$rows['costo_certi'].'
                                            </p>
                                        </address>
                                    </div>

                                    <div class="col-md-3">
                                        <address class="">
                                            <p class="font-weight-bold">
                                                Costo total
                                            </p>
                                            '; 
                                             
                                            $costototal=$rows['costo_matricula']+$rows['costo_certi'];
                                            
                                                $tarjeta .= '  <p class="mb-2">
                                               '.$costototal.'
                                            </p>';

                                                   
                                            $tarjeta .= '  
                                          
                                            <p class="font-weight-bold">
                                                Costo Alternativo
                                            </p>
                                            <p>
                                                '.$rows['costo_alternativo'].'
                                            </p>
                                        </address>
                                    </div>
                                </div>';

                               //ESTADOS

                                $tarjeta .= '   <div class="row ">
                                    <div class="col-md-3 badge badge-warning">
                                        <div class="wrapper d-flex justify-content-between">
                                            <div class="side-left">
                                                <p class="mb-2">Estado 1</p>
                                                <p class="display-3 mb-4 font-weight-light">40</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 badge badge-danger">
                                        <div class="wrapper d-flex justify-content-between">
                                            <div class="side-left">
                                                <p class="mb-2">Estado 2</p>
                                                <p class="display-3 mb-4 font-weight-light">45</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 badge badge-info">
                                        <div class="wrapper d-flex justify-content-between">
                                            <div class="side-left">
                                                <p class="mb-2">Estado 3</p>
                                                <p class="display-3 mb-4 font-weight-light">20</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 badge badge-success">
                                        <div class="wrapper d-flex justify-content-between">
                                            <div class="side-left">
                                                <p class="mb-2">Estado 4</p>
                                                <p class="display-3 mb-4 font-weight-light">25</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        return $tarjeta;
    }

    public function tabla_interesados_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
        }

       
        //SECCION INTERES
        $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespecialidad' ORDER by idestado ");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rows) {

        //SELECIONAR
        $codigoCliente=$rows['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
            $tarjeta .= '
                    <tr>
                        <td>'.$rows['codigocliente'].'</td>
                        <td>'.$rowsCliente['nombres_cli'].'</td>
                        <td>'.$rowsCliente['apellidos_cli'].'</td>

                        <td class="text-danger">
                            <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">
                                <input type="hidden" name="enlacecliente" value="'.$rows['codigocliente'].'">
                                <input type="hidden" name="idenestado" value="'.$rows['idestado'].'">
                               
                                    <button type="submit" name="vistacambioestado" class="btn btn-success  btn-sm">
                                         Atender
                                    </button>
                              
                            </form>
                        </td>


                        <td>
                            <div class="btn-group dropdown float-right">';
                          
                            
                    //SECCION ESTADOS
                    $estado=$rows['idestado'];
                    $datosEstado = $conexion->query("
                    SELECT * FROM estado WHERE 	idestado='$estado' ");
                    $datosEstado = $datosEstado->fetchAll();
                    foreach ($datosEstado as $rowsEstado) {
                     $tarjeta .= '<button type="button" style="background-color:'.$rowsEstado['color'].';" class="btn  btn-sm white-text " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                 '.$rowsEstado['nombre_estado'].'
                                </button>

                                <button type="button" style="background-color:'.$rowsEstado['color'].';" class=" btn btn-inverse btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#'.$rowsEstado['idestado'].'">
                                      <i class="fa fa-comments-o"></i>
                                </button>

                                <!--NODAL DESCRIPCION DE ESTADO ACTUAL-->

                                <div class="modal fade" id="'.$rowsEstado['idestado'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!--Header-->
                                        <div class="modal-header " style="background-color:'.$rowsEstado['color'].';">
                                            <h3 class="text-white text-center">Estado 1</h3>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="white-text">×</span>
                                            </button>
                                        </div>

                                        <!--Body-->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p class="text-center">Fecha 01/02/2019</p>
                                                <hr />
                                                <p>'.$rows['descri_estado'].'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                    }

                    $tarjeta .= '     
                            </div>
                        </td>
                        <td>
                        '.$rows['fecha_notificacion'].'
                        </td>
                        <td>
                        '.$rows['fecha_cambio_estado'].'
                        </td>
                        <td>
                            <a href="alumnodetalle.php" class="btn btn-inverse-dark ">Ver</a>
                        </td>
                     </tr>';
        }}
        return $tarjeta;
    }


    
    public function agregar_interesados_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
        }

         $tarjeta .= '
         <div class="modal fade" id="agregarcli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-success">
                            <h3 class="text-light text-center">Agregar Cliente</h3>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="white-text">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body">
                            <div class="form-group">
                                <p class="text-center">Verifique todos los datos ingresados antes de confirmar</p>

                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">

                                                <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!--nombre/apellidos/correo-->

                                                            <div class="row">
                                                                <div class="col-md-3 form-group">
                                                                    <label for="exampleInputEmail1">DNI</label>
                                                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$idespecialidad.'" >
                                                                    <input type="hidden" class="form-control" name="codigousuario" id="codigousuario" value="'. $usuario.'">
                                                               
                                                                    <input type="text" class="form-control" name="dni" id="dni" placeholder="Nombre" required>
                                                                </div>
                                                                <div class="col-md-5 form-group">
                                                                    <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                                                    <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Nombre" required>
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputEmail1">Alumno</label>
                                                                    <select class="form-control form-control-lg" name="alumno" id="alumno">
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="ExAlumno">ExAlumno</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputEmail1">Nombres</label>
                                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Apellidos</label>
                                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Correo</label>
                                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputEmail1">Teléfono</label>
                                                                    <input type="text" class="form-control" name="telefono" id="telefono" required placeholder="Telefono">
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <!--telefono/profesion/grado-->
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Profesión</label>
                                                                    <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Grado</label>
                                                                    <input type="text" class="form-control" name="grado" id="grado" placeholder="grado">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Pais</label>
                                                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="pais" value="Perú">
                                                                </div>

                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Departamento</label>
                                                                    <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Distrito</label>
                                                                    <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Direccion</label>
                                                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label for="exampleInputPassword1">Detalle</label>
                                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Direccion">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                                                            <button type="button" class=" btn btn-info" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class=""><i class="fa fa-meh-o"></i> Cancel</a></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
                   ';
        
        return $tarjeta;
    }

   
   
}
