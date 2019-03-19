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
        $datos = $conexion->query("
            SELECT * FROM especialidad WHERE estado_actual=0 ORDER BY fecha_registro");


            
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
                   <div class="btn-group" role="group" aria-label="First group">
                   <a href='.$rows['idespecialidad'].' class="btn btn-success btn-curso-system"><i class="fa fa-star-o"></i> Disponible</a>
                    <a href="http://"><button type="button" class="btn btn-dark"><i class="fa fa-eye"></i> Ver</button></a>
                      </div>
                  </div>
                  
                </div>
                
              
                <p class="text-muted mt-3 mb-0">
                  <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Usuario1: hace 46 minutes
                </p>
              </div>
            </div>
          </div>

                ';
        }
        return $tarjeta;
    }

    public function iniciar_sesion_curso(){
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
     
       
    }

    public function cerrar_sesion_curso(){
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
     
       
    }
     //mostrar cursos en el inicio
     public function mostrar_sesion_cursos_controlador()
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
                   es '.$rows['nombre_es'].'
                
                 ';
         }
         return $tarjeta;
     }
}
