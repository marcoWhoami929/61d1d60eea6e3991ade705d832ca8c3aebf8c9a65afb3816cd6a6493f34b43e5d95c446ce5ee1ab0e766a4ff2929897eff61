<?php
$idParticipante = $_SESSION["id"];
$boletos = ControladorFunciones::ctrMostrarTotalBoletos($idParticipante);
$totalBoletos = $boletos["total"];

$compras = ControladorFunciones::ctrMostrarTotalCompras($idParticipante);
$totalCompras = $compras["montoAcumulado"];
$totalRegistradas= $compras["comprasRegistradas"];

$boletosGanados = ControladorFunciones::ctrMostrarBoletosObtenidos($idParticipante);


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
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Mis Boletos</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $totalBoletos ?></h3>
                    <i class="ti-ticket icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                 
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">$ Compras</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">$<?php echo number_format($totalCompras,2) ?></h3>
                    <i class="ti-money icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                 
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Compras Registradas</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $totalRegistradas ?></h3>
                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                
                </div>
              </div>
            </div>
        
          </div>
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="container">
                    <div class="row" id="contenedorBoletos">
                      <?php 
                        for ($i=0; $i <count($boletosGanados); $i++) { 
                          $numero = $i+1;
                          echo "<div class='col-lg-6 col-md-6 col-sm-12'>
                          <div class='ticket'>
                            <div class='datas'>
                              <a class='link'>
                                <div class='ribbon'>
                                  <div class='label'>".$numero."</div>
                                </div>
                                <span>Folio</span>
                                <strong># ".$boletosGanados[$i]['folioBoleto']."</strong>
                                <em>".$boletosGanados[$i]['fecha']."</em>
                              </a>
                            </div>
                            <a class='button'></a>
                          </div>
                          </div>";
                          
                        }
                        ?>
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
            TICKET STYLING & COUPON EFFECT
    ================================================  */
.ticket {
position: relative;
display: table;
width: 400px;
height: 200px;
margin-top:20px;
padding-bottom: 57px;
background: #F4F4F4;
text-align: center;
}

.ticket::before {
  content:"";
  position: absolute;
  top: 54.5%;
  left: 0;
  border-top: 20px solid transparent;
  border-bottom: 20px solid transparent;
  border-left: 20px solid #a52958;
}

.ticket::after {
  content:"";
  position: absolute;
  top: 54.5%;
  right: 0;
  border-top: 20px solid transparent;
  border-bottom: 20px solid transparent;
  border-right: 20px solid #185661;
}

/*  ================================================
                    RIBBON EFFECT
    ================================================  */
.ribbon {
position: absolute;
display: block;
top: -4px;
right: -4px;
width: 110px;
height: 110px;
overflow: hidden;
}

.ribbon .label {
position: relative;
display: block;
left: -10px;
top: 23px;
width: 158px;
padding: 10px 0;
font-size: 15px;
text-align: center;
color: #fff;
background-color: #e85e68;
-webkit-box-shadow: 0px 0px 4px rgba(0,0,0,0.3);
-moz-box-shadow: 0px 0px 4px rgba(0,0,0,0.3);
-ms-box-shadow: 0px 0px 4px rgba(0,0,0,0.3);
box-shadow: 0px 0px 4px rgba(0,0,0,0.3);
-webkit-transform: rotate(45deg) translate3d(0,0,0);
-moz-transform: rotate(45deg) translate3d(0,0,0);
-ms-transform: rotate(45deg) translate3d(0,0,0);
transform: rotate(45deg) translate3d(0,0,0);
}

.label:before, .label:after {
content: '';
position: absolute;
bottom: -4px;
border-top: 4px solid #a71c26;
border-left: 4px solid transparent;
border-right: 4px solid transparent;
}

.label:before {
left: 0;
}

.label:after {
right: 0;
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



/*  ================================================
              ACTION CALL & ARROW UP EFFECT
    ================================================  */
.button {
  display: block;
  color: white;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 57px;
  padding: 0;
  line-height: 58px;
  text-align: center;
  border-radius: 0;
  background-color: #86db78;
}

.button::before {
  content:"";
  position: absolute;
  top: -10px;
  left: calc(50% - 20px);
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  border-bottom: 10px solid #86db78;
}



/*  ================================================
                    INSIDE TICKET
    ================================================  */
.ticket-in {
  width: 450px;
  height: 280px;
  position: absolute;
  background: #a52958;
  top: 55px;
  left: calc(50% - 280px);
  z-index: -1;
  transition: left 2s;
}

.ticket-in.active {
  left: calc(50% - 585px);
  transition: left 1.5s;
}

.content {
  height: 260px;
  margin: 8px;
  border: 2px dashed #e0c68e;
  border-radius: 10px;
}

.content h1 {
  font-size: 29px;
  color: #4c483b;
  text-align: center;
  margin: 0;
  padding: 0;
  font-family: 'Berkshire Swash', cursive;
}

.pass {
  display: block;
  color: white;
  position: absolute;
  top: 0;
  left: 0;
  width: 420px;
  height: 57px;
  margin: 15px 0 0 15px; 
  padding: 0;
  line-height: 58px;
  text-align: center;
  border-radius: 10px 10px 0 0;
  background: #eadbb8;
  border: 1px solid #82113c;
}

.pass::before {
  content:"";
  position: absolute;
  bottom: -10px;
  left: calc(50% - 20px);
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  border-top: 10px solid #eadbb8;
}

.content span {
  margin: 85px 0 0 0;
  text-align: center;
  color: #82113c;
}

.content em {
  border: none;
  text-align: center;
  font-size: 89px;
  color: #eadbb8;
  text-shadow: 1px 1px 0 rgba(0,0,0,.7);
}

.check{
  
  opacity: 0.8;
    
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

