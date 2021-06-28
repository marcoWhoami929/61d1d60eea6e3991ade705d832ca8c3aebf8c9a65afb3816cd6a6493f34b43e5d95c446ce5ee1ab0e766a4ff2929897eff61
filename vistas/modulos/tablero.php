<?php
$idParticipante = $_SESSION["id"];

$acumula = ControladorFunciones::ctrMostrarTotalAcumulado($idParticipante);
$facturasRegistradas = $acumula["facturasRegistradas"];
$acumuladoPremio1 = $acumula["premio1"];
$acumuladoPremio2 = $acumula["premio2"];
$acumuladoPremio3 = $acumula["premio3"];
$acumuladoPremio4 = $acumula["premio4"];

$obtenerPremios = ControladorFunciones::ctrBuscarPremios();

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
                <div class="content-wrapper ">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="font-weight-bold mb-0">Bienvenido <strong style="text-transform: uppercase;"><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellidoPaterno"] . " " . $_SESSION["apellidoMaterno"] ?></strong></h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title text-md-center text-xl-left">Facturas Registradas</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $facturasRegistradas ?></h3>
                                        <i class="ti-ticket icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title text-md-center text-xl-left">$ Acumulado Promocion 1</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">$<?php echo number_format($acumuladoPremio1, 2) ?></h3>
                                        <i class="ti-money icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title text-md-center text-xl-left">$ Acumulado Promocion 2</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo number_format($acumuladoPremio2, 2) ?></h3>
                                        <i class="ti-money icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title text-md-center text-xl-left">$ Acumulado Promocion 3</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo number_format($acumuladoPremio3, 2) ?></h3>
                                        <i class="ti-money icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title text-md-center text-xl-left">$ Acumulado Promocion 4</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo number_format($acumuladoPremio4, 2) ?></h3>
                                        <i class="ti-money icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
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
                                            <p class="card-description">
                                                Cuanto me falta
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                #
                                                            </th>
                                                            <th>
                                                                Premio
                                                            </th>
                                                            <th>
                                                                Acumulado
                                                            </th>
                                                            <th>
                                                                Progreso
                                                            </th>
                                                            <th>
                                                                Detalle
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $total = count($obtenerPremios);
                                                        if ($total > 0) {

                                                            foreach ($obtenerPremios as $key => $value) {
                                                                $numero = $key + 1;
                                                                $pendiente = (($acumula["premio" . $numero . ""] / $value["montoAcumulado"]) * 100);

                                                                if ($pendiente <= 30) {
                                                                    $clase = 'danger';
                                                                } else if ($pendiente > 30 and $pendiente <= 70) {
                                                                    $clase = 'warning';
                                                                } else if ($pendiente > 70) {
                                                                    $clase = 'success';
                                                                }
                                                                $porcentaje = 100 - $pendiente;
                                                                $mensaje = "Te falta el  <strong>" . number_format($porcentaje, 2) . " %</strong> para ganarte el premio $numero";
                                                                echo "<tr>
                                                                    <td>" . $numero . "</td>
                                                                    <td>" . $value["promocion"] . "</td>
                                                                    <td>$ " . number_format($acumula["premio" . $numero . ""], 2) . "</td>
                                                                    <td> <p>Llevas el " . number_format($pendiente, 2) . " % acumulado</p><div class='progress'>
                                                                   
                                                                    <div class='progress-bar bg-$clase' role='progressbar' style='width: $pendiente%' aria-valuenow='$pendiente' aria-valuemin='0' aria-valuemax='100'></div>
                                                                    </div></td>
                                                                    <td>" . $mensaje . "</td>
                                                                    
                                                                </tr>";
                                                            }
                                                        } else {

                                                            echo "<strong style='font-size:18px;'>AUN NO HAY PREMIOS REGISTRADOS</strong>";
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

        </div>

    </div>

    <style type="text/css" media="screen">
        /*  ========================
        BASIC STYLING
    ========================  */


        a,
        a.link {
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
            border-top: 2px dashed rgba(0, 0, 0, .1);
            padding: 10px 0;
        }
    </style>




    <script src="vistas/modulos/js/off-canvas.js"></script>
    <script src="vistas/modulos/js/hoverable-collapse.js"></script>
    <script src="vistas/modulos/js/template.js"></script>

    <script src="vistas/modulos/js/dashboard.js"></script>

</body>

</html>