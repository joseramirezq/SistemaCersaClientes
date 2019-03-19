<!--titulo del curso-->
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-primary">Cursos / Diplomados
                    <div class="btn-group dropdown float-right">
                        <a href="<?php SERVERURL; ?>agregarcurso"><button type="button" class="btn btn-success  btn-sm">
                                <i class="fa fa-plus"></i> Agregar nuevo
                            </button>
                        </a>

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
                <h2 class="card-title text-INFO mb-2">TOP 4 CURSOS Y DIPLOMADOS</h2>

                <!--Estadisticas de los clientes-->

                <div class="row ">


                    <div class="col-sm-4 col-md-3 grid-margin stretch-card ¿">
                        <div class="card  badge-warning">
                            <div class="card-body">
                                <h4 class="card-title text-white text-center"><i class="fa fa-graduation-cap"></i> METEOROLOGÍA APLICADA AL MONITOREO AMBIENTAL</h4>
                                <div class="media">
                                    <h1>1 | </h1>
                                    <div class="media-body">
                                        <p class="card-text text-center">
                                            Numero de Participantes : 98</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 col-md-3 grid-margin stretch-card ¿">
                        <div class="card  badge-danger">
                            <div class="card-body">
                                <h4 class="card-title text-white text-center"> <i class="fa fa-book"></i> COBERTURAS METÁLICAS CURVADAS</h4>
                                <div class="media">
                                    <h1>2 | </h1>
                                    <div class="media-body">
                                        <p class="card-text text-center">
                                            Numero de Participantes : 92</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 grid-margin stretch-card ¿">
                        <div class="card  badge-info">
                            <div class="card-body">
                                <h4 class="card-title text-white text-center"> <i class="fa fa-book"></i> MODELAMIENTO GEOLÓGICO CON LEAPFROG</h4>
                                <div class="media">
                                    <h1>3 | </h1>
                                    <div class="media-body">
                                        <p class="card-text text-center">
                                            Numero de Participantes : 85</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 grid-margin stretch-card ¿">
                        <div class="card  badge-success">
                            <div class="card-body">
                                <h4 class="card-title text-white text-center"><i class="fa fa-graduation-cap"></i> GESTIÓN Y MANEJO INTEGRAL DE RESIDUOS SÓLIDOS </h4>
                                <div class="media">
                                    <h1>4 | </h1>
                                    <div class="media-body">
                                        <p class="card-text text-center">
                                            Numero de Participantes : 84</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>





<!--tabla de liosta de clientes-->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de Cursos/Diplomados</h4>

                <!--formulario de busqueda-->
                <form action="">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control" placeholder="Escribe nombre">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-inverse-success" type="button">Buscar</button>
                        </span>
                    </div>
                </form>

                <!--fin fformulario de bisqueda-->
                <hr>

                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Categoria</th>
                                    <th>Nombre</th>
                                    <th>Clientes</th>

                                    <th>Fecha I.</th>
                                    <th>Estados</th>

                                    <th>Detalle</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!--resgistro de un alumno-->
                                <?php
                                require_once("./controladores/cursoControlador.php");

                                //INSTANCIOAMOS LA CLASE//
                                $insCurso = new cursoControlador();
                                echo $insCurso->leer_cursos_controlador();

                                ?>


                                <!--fin de registro de un alumno-->



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--nodal de la tabla de curos-->
    <div class="modal fade" id="nodalcurestado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header bg-dark">
                    <h3 class="text-light text-center">Detalle de clientes por estado</h3>

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