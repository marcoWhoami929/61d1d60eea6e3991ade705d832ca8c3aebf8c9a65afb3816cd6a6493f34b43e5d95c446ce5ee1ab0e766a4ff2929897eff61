<?php

$idParticipante = $_SESSION["id"];
$facturas = ControladorFunciones::ctrMostrarCompras($idParticipante);


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <link rel="stylesheet" href="vistas/modulos/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vistas/modulos/vendors/base/vendor.bundle.base.css">

  <link rel="stylesheet" href="vistas/modulos/css/style.css">

</head>
<body>
  <div class="container-scroller">
    <?php include("cabecera.php") ?>
    
    <div class="container-fluid page-body-wrapper">
    
      <?php include("menu.php") ?>
     
      <div class="main-panel">
        <div class="content-wrapper " >
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Bienvenido <strong style="text-transform: uppercase;"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellidoPaterno"]." ".$_SESSION["apellidoMaterno"] ?></strong></h4>
                </div>
                
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Mis Compras</p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Serie</th>
                          <th>Folio</th>
                          <th>Total</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $total = count($facturas);
                          if ($total > 0) {
                              
                               foreach ($facturas as $key => $value) {
                                  $numero = $key+1;
                                  echo "<tr>
                                        <td>".$numero."</td>
                                        <td>".$value["serie"]."</td>
                                        <td>".$value["folio"]."</td>
                                        <td><label class='badge badge-success'>$ ".number_format($value["total"],2)."</label></td>
                                        <td class='text-success'>".$value["fechaFactura"]."<i class='ti-arrow-up'></i></td>
                                        
                                      </tr>";
                                }


                          }else{

                               echo "<strong style='font-size:18px;'>AUN NO REGISTRAS TUS COMPRAS</strong>";

                          }
                         
                        ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        
          </div>
         
        </div>

      </div>
     
    </div>

  </div>
    <style type="text/css" media="screen">
    /*  ========================
        BASIC STYLING
    ========================  */


a, a.link {
  display: block;
  padding: 33px 0 0 0;
  color: #313131;
  text-decoration: none;
  cursor: pointer;
}

/*  ================================================
                        CONTENT
    ================================================  */
span {
  display: block;
  font-size: 29px;
  color: #540c5d;
}

strong {
  display: block;
  font-size: 35px;
  color: #a52958;
  margin: 0 0 10px 0;
}

em {
  display: block;
  font-size: 20px;
  font-style: normal;
  color: #86db78;
  border-top: 2px dashed rgba(0,0,0,.1);
  padding: 10px 0;
}

  </style>
  <script src="vistas/modulos/vendors/chart.js/Chart.min.js"></script>

  <script src="vistas/modulos/js/off-canvas.js"></script>
  <script src="vistas/modulos/js/hoverable-collapse.js"></script>
  <script src="vistas/modulos/js/template.js"></script>
  <script src="vistas/modulos/js/todolist.js"></script>

  <script src="vistas/modulos/js/dashboard.js"></script>
  
</body>

</html>

