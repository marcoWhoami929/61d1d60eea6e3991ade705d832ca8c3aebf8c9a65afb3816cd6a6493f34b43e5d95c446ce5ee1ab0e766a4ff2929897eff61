<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>

  <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>RIFA 2021 | SAN FRANCISCO DEKKERLAB</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="vistas/assets/images/logo.ico" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="vistas/assets/css/bootstrap.min.css">

    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="vistas/assets/css/flaticon.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="vistas/assets/css/LineIcons.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="vistas/assets/css/animate.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="vistas/assets/css/slick.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="vistas/assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="vistas/assets/css/style.css">

    <!-----=====================JAVACRIPT=====================--->
      <!--====== jquery js ======-->
    <script src="vistas/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="vistas/assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="vistas/assets/js/bootstrap.min.js"></script>
    <script src="vistas/assets/js/popper.min.js"></script>

    <!--====== Counter Up js ======-->
    <script src="vistas/assets/js/waypoints.min.js"></script>
    <script src="vistas/assets/js/jquery.counterup.min.js"></script>

    <!--====== Slick js ======-->
    <script src="vistas/assets/js/slick.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="vistas/assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="vistas/assets/js/jquery.easing.min.js"></script>
    <script src="vistas/assets/js/scrolling-nav.js"></script>

    <!--====== Countdown js ======-->
    <script src="vistas/assets/js/jquery.countdown.min.js"></script>

    <!--====== wow js ======-->
    <script src="vistas/assets/js/wow.min.js"></script>


    <!--====== Main js ======-->
    <script src="vistas/assets/js/main.js"></script>

     <!--====== Boostrap validation js ======-->
    <script src="vistas/assets/js/jqBootstrapValidation.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X29J1963F8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-X29J1963F8');
    </script>

</head>

<body>

	    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
/*=============================================
HEADER
=============================================*/

 if(isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok"){

    echo '<div class="wrapper">';



     /*=============================================
     CONTENIDO
     =============================================*/

     if(isset($_GET["ruta"])){

          $carpeta = "vistas/modulos/";
          $class = $carpeta . $_GET["ruta"]. '.php';


          if (!file_exists($class)) {
              //include "modulos/404.php";
          }else{

          	if ($_GET["ruta"] == "inicio") {
          		
				include "modulos/header.php";
          	}else{

          	}

            include "modulos/".$_GET["ruta"].".php";
            

          }   

     }else{
       include "modulos/header.php";
       include "modulos/inicio.php";

     }



    echo '</div>';

 }else{

  
	include "modulos/header.php";
	include "modulos/inicio.php";

 }
 include "modulos/footer.php";

 
?>
<!--SCRIPTS JS-->
<script type="text/javascript" src="vistas/assets/js/funciones.js"></script>

<script type="text/javascript" src="vistas/assets/js/geolocationClient.js"></script>

<!--SCRIPTS JS-->
</body>
</html>