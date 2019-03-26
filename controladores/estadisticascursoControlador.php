<?php
     
        if ($peticionAjax) {
            require_once('../modelos/estadisticascursoModelo.php');
           
        } else {
            require_once('./modelos/estadisticascursoModelo.php');
          
        }

        class estadisticascursoControlador extends estadisticascursoModelo{

           

        public function total_clientes_interes_controlador()
        {
                    $porcentaje=0;
                    $table="";
                    
                    $conexion=mainModel::conectar();

                    //cantidad de clientes en total
            
            $contador=0;
            //cantidad total de interesados
            $cantTotal=0;
            $datoscantestado = $conexion->query("
            SELECT COUNT(*) AS total FROM interes");
            $datoscantestado = $datoscantestado->fetchAll();
            foreach ($datoscantestado as $rowsestadocant) {
            $cantTotal=$rowsestadocant['total'];
            }

           


            //estados de cada interes
            $idcat=0;
            $datosespe = $conexion->query("
            SELECT *  FROM especialidad LIMIT 10");
            $datosespe = $datosespe->fetchAll();
            foreach ($datosespe as $rowsespecialidad) {
            $idespecialidad=$rowsespecialidad['idespecialidad'];
            $idcat=$rowsespecialidad['idcategoria'];


            $contador++;
        
            //nombre de categoria
            
            $datoscat = $conexion->query("
            SELECT 	nombre_cat FROM categoria WHERE idcategoria='$idcat'");
            $datoscat = $datoscat->fetchAll();
            foreach ($datoscat as $rowscat) {
            $nombrecat=$rowscat['nombre_cat'];
            }


            //interesados por curso
           
            $totalinterescurso=0;
            $datosinteres = $conexion->query("
            SELECT COUNT(*) AS totalint FROM interes WHERE idespecialidad='$idespecialidad'");
            $datosinteres = $datosinteres->fetchAll();
            foreach ($datosinteres as $rowsinteres) {
            $totalinterescurso=$rowsinteres['totalint'];
            }

            $porcentaje=(($totalinterescurso*100)/$cantTotal);
        
           
               //USUARIO EN LINEA

              $nombreuser="Disponible";
              $codigousuer=$rowsespecialidad['sesion'];
              if($codigousuer!="Disponible"){
              
           
               $datosuser = $conexion->query("
               SELECT nombre_us FROM usuario WHERE codigousuario='$codigousuer'");
               $datosuser = $datosuser->fetchAll();
               foreach ($datosuser as $rowsuser) {
                
               $nombreuser=$rowsuser['nombre_us'];
               if($nombreuser==""){
                $nombreuser="Disponible";
               }
              }
               }



            $table.='
            <tr>
                <td class="font-weight-medium">
                  '.$contador.'
                </td>

                <td class="font-weight-medium">
                  '.$nombrecat.'
                </td>

                <td>
                '.$rowsespecialidad['nombre_es'].'
                </td>

                <td>
                '.$totalinterescurso.' de '.$cantTotal.' --->   '.round($porcentaje,2).'
                  <div class="progress">
                     <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: '.$porcentaje.'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </td>

                <td>
                  '.$rowsespecialidad['fecha_fin'].'
                </td>
                <td class="text-danger">
                '.$rowsespecialidad['fecha_registro'].'
                </td>
                
                <td class="bg">
                '.$nombreuser.'
                </td>
          </tr> 
          ';
            

            }
                return $table;

        }

        
        public function estadisticas_generales_controlador(){
            $tableGe="";
            $contador=0;
            $fecha=date("Y-m-d ");  
                    
            $conexion=mainModel::conectar();

            //cantidad de clientes en total
            $totalcursos=0;
            $datosCur= $conexion->query("
            SELECT COUNT(*) as total FROM especialidad");
            $datosCur = $datosCur->fetchAll();
            foreach ($datosCur as $datosCur) {
              $totalcursos=$datosCur['total'];

            }
            $totalcursos2=0;
            $datosCurso= $conexion->query("
            SELECT COUNT(*) as totalcursos FROM especialidad WHERE idcategoria='1'");
            $datosCurso = $datosCurso->fetchAll();
            foreach ($datosCurso as $datosCurso) {
              $totalcursos2=$datosCurso['totalcursos'];

            }

            $totaldiplomados=0;
            $datosDiplomados= $conexion->query("
            SELECT COUNT(*) as total FROM especialidad WHERE idcategoria='2'");
            $datosDiplomados = $datosDiplomados->fetchAll();
            foreach ($datosDiplomados as $datosDip) {
              $totaldiplomados=$datosDip['total'];

            }


            $datosCur= $conexion->query("
            SELECT COUNT(*) as total FROM especialidad");
            $datosCur = $datosCur->fetchAll();
            foreach ($datosCur as $datosCur) {
              $totalcursos=$datosCur['total'];

            }

            //el capo de los cursos o dimplomados
            $variablemayor=0;
            $nombrecurso="";
            $nombrecursomayor="";
            $idespecialidad=0;
            $datosespe = $conexion->query("
            SELECT *  FROM especialidad");
            $datosespe = $datosespe->fetchAll();
            foreach ($datosespe as $rowsespecialidad) {
            $idespecialidad=$rowsespecialidad['idespecialidad'];
            $nombrecurso=$rowsespecialidad['nombre_es'];

            $totalinterescurso=0;
            $datosinteres = $conexion->query("
            SELECT COUNT(*) AS totalint FROM interes WHERE idespecialidad='$idespecialidad'");
            $datosinteres = $datosinteres->fetchAll();
            foreach ($datosinteres as $rowsinteres) {
            $totalinterescurso=$rowsinteres['totalint'];
            }

            if( $variablemayor<$totalinterescurso){
                $variablemayor=$totalinterescurso;
                $nombrecursomayor= $nombrecurso;

            }

           
             }

         


              $contador++;
                $tableGe.='
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-desktop text-danger icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Total de Cursos/Dip</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">'. $totalcursos.'</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Datos hasta el '.$fecha.'
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-graduation-cap text-warning icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Diplomados</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">'.$totaldiplomados.'</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Datos hasta el '.$fecha.'
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-book text-success icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Cursos</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">'.$totalcursos2.'</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Datos hasta el '.$fecha.'
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Mayor interes</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">'.$variablemayor.'</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Nombre :'.$nombrecursomayor.'
                        </p>
                      </div>
                    </div>
                  </div>
                  
           ';
        

        return $tableGe;
        }
    }