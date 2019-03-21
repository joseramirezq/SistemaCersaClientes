<!--Inicio de vista cliente nuevo-->


<!--titulo del curso-->
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                        <?php
                                    // $codigo=$_GET['codigo'];
                                     require_once("./controladores/clienteControlador.php");
                                     $insCurso = new clienteControlador();
                                     echo $insCurso->cliente_actualizacion_estado();

                                ?>                        
               

            </div>
        </div>
    </div>
</div>



<!--formulario de configuracion para el cliente-->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"> Verifique todos los datos ingresados antes de confirmar</h1>
    
                <div class="col-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        
                        <form data-form="save"  action="<?php echo SERVERURL;?>ajax/administradorAjax.php" method="POST" class="forms-sample FormularioAjax" 
                        autocomplete="off" enctype="multipart/form-data">
                         
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <!--modelo de estado que se cambiara-->
                                
                                      <!--fin del modelo que se cambiara-->
                                      <!--modelo de estado que se cambiara-->
                                      <?php
                                            require_once("./controladores/secundariosControlador.php");

                                            //INSTANCIOAMOS LA CLASE//
                                            $insEstado = new secundariosControlador();
                                            echo $insEstado->cambios_estados_controlador();

                                     ?>
                             
                                      <!--fin del modelo que se cambiara-->
                                
                                      <!--fin del modelo que se cambiara-->
                                   
                                  </div>
                            </div>
                            <div class="col-md-6">
                         <!--inicio del nuevo formulario-->
                                <div class="card">
                                    <div class="card-body">
                                    <!--fecha-->
                                    <div class="form-group">
                                        <div class="input-group">
                                        <div class="input-group-prepend bg-success">
                                            <span class="input-group-text bg-transparent">
                                            <i class="fa fa-calendar text-white"></i>
                                         
                                            </span>
                                        </div>
                                        <input type="datetime" class="form-control" placeholder="Fecha"  aria-describedby="colored-addon1">
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
                                        <input type="text" class="form-control" placeholder="Descripcion"  name="descripcion" aria-describedby="colored-addon2">
                                        </div>
                                    </div>
                                    <!--baucher-->
                                    <div class="form-group">
                                      
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="myFile">
                                            <div class="input-group-append bg-primary border-primary">
                                                <span class="input-group-text bg-transparent">
                                                <i class="fa fa-file-text-o text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                   
                                    </div>
                                </div>
                                <!--findel nuevo formukario-->
                             
                            
                            </div>
                          </div>
                          <div class="row">
                                <div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Actualizar</button>
                                    <a href="index.php" class="btn btn-info"><i class="fa fa-meh-o"></i> Cancel</a>
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
</div>
<!--fin del formulario para configuracion del cliente-->


<!--fin  de vista cliente nuevo-->
