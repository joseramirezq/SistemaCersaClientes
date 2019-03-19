<!--titulo del curso-->
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-primary">
                    <?php
                        require_once("./controladores/cursoControlador.php");
                        $insCurso = new cursoControlador();
                      //  $variable=$_GET['Curso'];
                       // $variable=1;
                    echo $insCurso->mostrar_sesion_cursos_controlador();

                    ?>
                 
                    <div class="btn-group dropdown float-right">
                        <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#agregarcli">
                            Agregar Cliente
                        </button>

                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            En línea
                        </button>
                        <div class="dropdown-menu ">
                            <a class="dropdown-item text-danger btn-cerrar-curso" href="<?php echo $_SESSION['curso']?>">
                                <i class="fa fa-reply fa-fw"></i>
                                <p class="">Cerrar Session</p>
                            </a>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </div>
</div>

<!--descripcion del curso y de los estados -->
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
                                Jueves, 28 de febrero
                            </p>
                            <p class="font-weight-bold">
                                Duración
                            </p>
                            <p>
                                6 semanas
                            </p>
                        </address>
                    </div>

                    <div class="col-md-3">
                        <address class="">
                            <p class="font-weight-bold">
                                Modalidad
                            </p>
                            <p class="mb-2">
                                Virtual en Vivo
                            </p>
                            <p class="font-weight-bold">
                                Certificacion
                            </p>
                            <p>
                                60 horas
                            </p>
                        </address>
                    </div>

                    <div class="col-md-3">
                        <address class="">
                            <p class="font-weight-bold">
                                Costo matricula
                            </p>
                            <p class="mb-2">
                                s/. 150.00
                            </p>
                            <p class="font-weight-bold">
                                Costo certificado
                            </p>
                            <p>
                                s/. 50.00
                            </p>
                        </address>
                    </div>

                    <div class="col-md-3">
                        <address class="">
                            <p class="font-weight-bold">
                                Costo total
                            </p>
                            <p class="mb-2">
                                s/. 200.00
                            </p>
                            <p class="font-weight-bold">
                                otra informacion
                            </p>
                            <p>
                                De importancia
                            </p>
                        </address>
                    </div>
                </div>

                <!--descricon de los estados-->

                <div class="row ">
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
</div>

<!--lista de participantes o interesado sen el curso-->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de interesados</h4>

                <!--fin fformulario de bisqueda-->
                <hr />

                <div class="table-responsive">
                    <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Nombre</th>
                                <th>Apellido</th>

                                <th>Acción</th>

                                <th>Estado</th>
                                <th>Fecha programada</th>

                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--resgistro de un alumno-->
                            <tr>
                                <td>A0001</td>
                                <td>Jose Luis</td>
                                <td>Ramirez Quiroz</td>

                                <td class="text-danger">
                                    <a href="<?php SERVERURL; ?>sesionestados"><button type="button" class="btn btn-success  btn-sm">
                                            Atender
                                        </button></a>
                                </td>


                                <td>
                                    <div class="btn-group dropdown float-right">
                                        <button type="button" class="btn btn-warning  btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Estado 1
                                        </button>

                                        <button type="button" class="btn btn-inverse-warning btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#nodalestado">
                                            <i class="fa fa-comments-o"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    07/03/2019 14:15
                                </td>
                                <td>
                                    <a href="alumnodetalle.php" class="btn btn-inverse-dark ">Ver</a>
                                </td>
                            </tr>
                            <!--fin de registro de un alumno-->
                            <!--resgistro de un alumno-->

                            <!--fin de registro de un alumno-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--NoDALES-->

<!--nodal de descripcion de la observacion-->

<div class="modal fade" id="nodalestado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-warning">
                <h3 class="text-light text-center">Estado 1</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">Fecha 01/02/2019</p>
                    <hr />
                    <p>Esta es la descripcion del estado que se enceuntra activo</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--nodal agregar nuevo clieten-->

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

                                    <form data-form="save" action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!--nombre/apellidos/correo-->

                                                <div class="row">
                                                    <div class="col-md-3 form-group">
                                                        <label for="exampleInputEmail1">DNI</label>
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