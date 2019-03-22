<?php
     $codigocliente="Sin codigo";
        if ($peticionAjax) {
            require_once('../modelos/clienteModelo.php');
           
        } else {
            require_once('./modelos/clienteModelo.php');
          
        }

        class clienteControlador extends clienteModelo{

           

        public function agregar_cliente_controlador(){
                //PARA AGREGAR INTERES
                 $cursointeres=$_POST['idespecialidad'];
                $codigodeusuario=$_POST['codigousuario'];


                $nombre=mainModel::limpiar_cadena($_POST['nombre']);
                $apellidos=mainModel::limpiar_cadena($_POST['apellidos']);
                $correo=mainModel::limpiar_cadena($_POST['correo']);
                $telefono=mainModel::limpiar_cadena($_POST['telefono']);
                $profesion=mainModel::limpiar_cadena($_POST['profesion']);
                $grado=mainModel::limpiar_cadena($_POST['grado']);
                $pais=mainModel::limpiar_cadena($_POST['pais']);
                $departamento=mainModel::limpiar_cadena($_POST['departamento']);
                $distrito=mainModel::limpiar_cadena($_POST['distrito']);
                $direccion=mainModel::limpiar_cadena($_POST['direccion']);

                $dni=mainModel::limpiar_cadena($_POST['dni']);
                $fecha=mainModel::limpiar_cadena($_POST['fechanacimiento']);
                $alumno=mainModel::limpiar_cadena($_POST['alumno']);
                $detalle=mainModel::limpiar_cadena($_POST['detalle']);

                $consulta3=mainModel::ejecutar_consulta_simple("SELECT 
                idcliente FROM cliente ");
                $numero=($consulta3->rowCount())+1;
                $codigo=mainModel::generar_codigo_aleatorio("CLI", 1, $numero);

                
                $estado=1;
                session_start(['name'=>'SRCP']);
                $codigodeusuario=$_SESSION['id_usuario'];
  
                $datosInteres=[
                      "Estado"=>$estado,
                      "Usuario"=>$codigodeusuario,
                      "Curso"=>$cursointeres, //aqui debemos pasar el parametro del curso
                      "Cliente"=>$codigo,
                      "Descripcion"=>"Cliente nuevo",
                  ];
                  clienteModelo::agregar_interes_modelo($datosInteres);

                $datosCliente=[
                    "Codigo"=>$codigo,
                    "Nombre"=>$nombre,
                    "Apellidos"=>$apellidos,
                    "Correo"=>$correo,
                    "Telefono"=>$telefono,
                    "Profesion"=>$profesion,
                    "Grado"=>$grado,
                    "Pais"=>$pais,
                    "Departamento"=>$departamento,
                    "Distrito"=>$distrito,
                    "Direccion"=>$direccion,

                    "Dni"=>$dni,
                    "Fecha"=>$fecha,
                    "Detalle"=>$detalle,
                    "Alumno"=>$alumno

                ];
                $guardarCliente=clienteModelo::agregar_cliente_modelo($datosCliente);

                if($guardarCliente->rowCount()>=1){
                 
                    $direccion=SERVERURL."sesioncurso";
                    header('location:'.$direccion);
                }else{
                    $a= "<script>console.log( 'No insertado' );</script>";
                }
             
            
                return $a;
            }


                //MOSTRAR CLIENTES EN ESTADO CLIENTE 
        
     public function cliente_actualizacion_estado(){
        //
        $idespecialidad=0;
        $tarjetaEstado="";
        $cod= $_SESSION['codigocliente'];
        $conexion=mainModel::conectar();

        //variables de interes
        $idinteres="";
        $descriestado="";
        $fechacambio="";
        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
           
        }

        //datos de interes que serviran par ala inseriocn 
        $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespecialidad'AND codigocliente='$cod' ORDER by idestado ");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rowsInt) {

            $descriestado=$rowsInt['descri_estado'];
            $fechacambio=$rowsInt['fecha_cambio_estado'];
            $idinteres=$rowsInt['idinteres'];
        }

        //selecionando cliente
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$cod'  ");
        $datosCliente = $datosCliente->fetchAll();
       
        foreach($datosCliente as $rows){
            $tarjetaEstado.='
            <h3 class="text-primary">Cliente:'.$rows['nombres_cli'].' '.$rows['apellidos_cli'].'</h3>
                <div class="btn-group dropdown ">
                    ';


                    //DATOS DEL ESTADO 
                    $estado=$_SESSION['estadocliente'];
                    $datosEstado = $conexion->query("
                    SELECT * FROM estado WHERE 	idestado='$estado' ");
                    $datosEstado = $datosEstado->fetchAll();
                    foreach ($datosEstado as $rowsEstado) {
                        $tarjetaEstado.=' <mark style="background-color:'.$rowsEstado['color'].';" class=" text-white" >'.$rowsEstado['nombre_estado'].' </mark>
                         <mark  class="bg-inverse-danger " > '.$descriestado.'</mark>';
                    } 
                    $tarjetaEstado.='
                </div>
                <hr>
                  <!--infomacion del contacto-->
                  <div class="row">
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold">
                                    Correo
                                </p>
                                <p class="mb-2">
                                '.$rows['correo_cli'].'
                                </p>
                                <p class="font-weight-bold">
                                    Telefono
                                </p>
                                <p>
                                '.$rows['telefono_cli'].'
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold">
                                    Profesión
                                </p>
                                <p class="mb-2">
                                '.$rows['profesion_cli'].'
                                </p>
                                <p class="font-weight-bold">
                                    Grado
                                </p>
                                <p>
                                '.$rows['grado_cli'].'
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold">
                                    Pais
                                </p>
                                <p class="mb-2">
                                '.$rows['pais_cli'].'
                                </p>
                                <p class="font-weight-bold">
                                    Departamento
                                </p>
                                <p>
                                '.$rows['departamento_cli'].'
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold">
                                    Distrito
                                </p>
                                <p class="mb-2">
                                '.$rows['distrito_cli'].'
                                </p>
                                <p class="font-weight-bold">
                                Dirección
                                </p>
                                <p>
                                '.$rows['direccion_cli'].'
                                </p>
                            </address>
                        </div>
                    </div>
                    <!--fin informacion del contacto-->
                    
            </div>
            </div>
        </div>
    </div>
    
            ';
        }
        $tarjetaEstado.='<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title"> Verifique todos los datos ingresados antes de confirmar</h1>
                            
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                            <div class="card-body">
                                                
                                                <form action="'.SERVERURL.'ajax/interesAjax.php" method="POST" class="forms-sample" 
                                                autocomplete="off" enctype="multipart/form-data">
                                                <input type="text name="idespecialidad" id="idespecialidad"  value="'.$idespecialidad.'">
                                                <input type="text name="codigousuario" id="codigousuario"  value="'.$usuario.'">
                                                <input type="text" name="codigocliente" id="codigocliente" value="'.$cod.'">
                                                <input type="text" name="idinteres" id="idinteres" value="'.$idinteres.'">
                                               
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <!--modelo de estado que se cambiara-->
                                                        
                                                            <!--fin del modelo que se cambiara-->
                                                            <!--modelo de estado que se cambiara-->
                                                           ';
                                                                    $datosE=$conexion->query("
                                                                    SELECT * FROM estado WHERE estado_actual=1 ORDER BY codigoestado");
                                                           
                                                                    $datosE=$datosE->fetchAll();
                                                                    foreach($datosE as $rowsE){
                                                                        $tarjetaEstado.='
                                                                        <div class="col-sm-12">

                                                                        <div class="form-group">
                                                                        
               
                                                                            <div class="form-radio">
                                                                           
                                                                                
                                                                              <input  type="radio" class="form-check-input" name="estado" id="estado"  value="'.$rowsE['idestado'].'" > 
                                                                                <p> <font  style="background-color: '.$rowsE['color'].';"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>&nbsp;'.$rowsE['nombre_estado'].' : &nbsp;  '.$rowsE['descri_estado'].'</p> 
                                                                                <i class="input-helper"></i><i class="input-helper"></i>
                                                                            </div>

                                                                        </div>

                                                                        <div class="form-radio">
                                                            
                                                                        
                                                                        </div>
                                                                      </div>
                                                                      
                                                                      
                                                                        '; 
                                                                    }
                                              
                                                          
                                                        
                                            $tarjetaEstado.='     </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                <!--inicio del nuevo formulario-->
                                                        <div class="card">
                                                            <div class="card-body">
                                                            <!--fecha-->
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                
                                                                    <input type="datetime-local"  class="form-control" name="fechanotificacion" id="fechanotificacion">
                                                             
                                                                </div>
                                                            </div>
                                                            <!--descripcion-->
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                <div class="input-group-prepend bg-primary border-primary">
                                                                    <span class="input-group-text bg-transparent">
                                                                    <i class=" fa fa-align-left text-white"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="Descripcion"  name="descripcion" id="descripcion" aria-describedby="colored-addon2">
                                                                </div>
                                                            </div>
                                                            <!--baucher-->
                                                            <div class="form-group">
                                                            
                                                                <div class="input-group">
                                                                    <input class="form-control" type="file" name="boucher" id="boucher>
                                                                    <div class="input-group-append bg-primary border-primary">
                                                                        <span class="input-group-text bg-transparent">
                                                                        <i class="fa fa-file-text-o text-white"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                        
                                                            
                                                        
                                                            </div></div></div>
                                                        </div>
                                                        <!--findel nuevo formukario-->
                                                    
                                                    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="form-group">
                                                        <div class="form-group">
                                                            <button type="submit" name="actualizarinteres" class="btn btn-success"><i class="fa fa-check"></i> Actualizar</button>
                                                            <a href="'.SERVERURL.'sesioncurso" class="btn btn-info"><i class="fa fa-meh-o"></i> Cancel</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                   
                                                </form>
                                            </div>
                                            
                                            </div>
                                        </div>
                        
                                    </div>
                                </div>
                            </div>
                        </div>';
        return $tarjetaEstado;
        }



        public function   pasando_variable_controlador($variable,$identificador){
            session_start(['name'=>'SRCP']);
            $_SESSION['codigocliente']=$variable;
            $_SESSION['estadocliente']=$identificador;
        }      //mostrar tabla estados
        public function leer_cliente_controlador(){
            $table="";
            $conexion=mainModel::conectar();
            $datos=$conexion->query("
            SELECT * FROM cliente ORDER BY idcliente");

            $datos=$datos->fetchAll();
            foreach($datos as $rows){
                $table.='
                <tr>
                <td>'.$rows['codigocliente'].'</td>
                <td>'.$rows['nombres_cli'].'</td>
                <td>'.$rows['apellidos_cli'].'</td>
                <td>jlramirezq@unc.edu.pe</td>
                <td class="text-danger"> 964923450</td>
                <td>Cajamarca</td>
                <td>
                    <a href="<?php SERVERURL;?>detallecliente" class="btn btn-inverse-dark ">Ver</a>
                </td>
            </tr>
                ';
            }
            return $table;
         }
    }


