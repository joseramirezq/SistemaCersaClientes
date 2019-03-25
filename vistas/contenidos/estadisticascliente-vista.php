<div class="row">
<div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-5">Número de Clientes</h2>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                    
                      <?php
                            require_once("./controladores/estadisticasControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insCat = new estadisticasControlador();
                        echo $insCat->total_clientes_controlador();
                        ?>
                </div>
              </div>
            </div>

            <div class="col-lg-7 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ultimos 10 clientes insertados</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            First name
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Sales
                          </th>
                          <th>
                            Deadline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            require_once("./controladores/estadisticasControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insCat = new estadisticasControlador();
                        echo $insCat->top_clientes_controlador();
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>