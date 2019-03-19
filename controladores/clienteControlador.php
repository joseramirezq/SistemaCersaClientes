<?php

        if ($peticionAjax) {
            require_once('../modelos/clienteModelo.php');
           
        } else {
            require_once('./modelos/clienteModelo.php');
          
        }

        class clienteControlador extends clienteModelo{

            public function agregar_cliente_controlador(){
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

                session_start(['name'=>'SRCP']);   
                $estado=20;
                $usuario= $_SESSION['id_usuario'];
                $curso=1;
  
                $datosInteres=[
                      "Estado"=>$estado,
                      "Usuario"=>$usuario,
                      "Curso"=>$curso, //aqui debemos pasar el parametro del curso
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
                 
                    $a= "<script>console.log( 'Insertado' );</script>";
                }else{
                    $a= "<script>console.log( 'No insertado' );</script>";
                }
             
            
                return $a;
            }


              //mostrar tabla estados
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


