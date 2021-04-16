<?php 
session_start();
require_once "../../../controladores/funciones.controlador.php";
require_once "../../../modelos/funciones.modelo.php";

$serie = $_POST["serieCompraSend"];
$folio = $_POST["folioCompraSend"];

$respuesta = ControladorFunciones::ctrObtenerDatosFactura($serie,$folio);
$idFactura = $respuesta["id"];

$idParticipante = $_SESSION["id"];

$buscarBoletosGanados = ControladorFunciones::ctrObtenerBoletosGanados($idParticipante,$idFactura);

$destinatario = $_SESSION["correo"]; 
$asunto = "UN GUSTO VOLVER A VERTE ".$_SESSION["nombre"].""; 
$string = "Has ganado ".count($buscarBoletosGanados)." boleto(s) por tu compra<br>";
foreach ($buscarBoletosGanados as $key => $value) {
                
    $string .= "<br><strong>".$value["folioBoleto"]."</strong>";
}
$email_body = $string;
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: SORTEO | SAN FRANCISCO DEKKERLAB <dekkerapp@sanfranciscodekkerlab.com>\r\n"; 


  $rcss = "../../../complementos/plantilla/estilo.css";//ruta de archivo css
                    $fcss = fopen ($rcss, "r");//abrir archivo css
                    $scss = fread ($fcss, filesize ($rcss));//leer contenido de css
                    fclose ($fcss);//cerrar archivo css

                //reemplazar sección de plantilla html con el css cargado y mensaje creado
                    $shtml = file_get_contents('../../../complementos/plantilla/sendMessage.html');
                    $incss  = str_replace('<style id="estilo"></style>',"<style>$scss</style>",$shtml);
                    $cuerpo = str_replace('<p id="mensaje"></p>',$email_body,$incss);



   if(mail($destinatario,$asunto,$cuerpo,$headers)) {
                        return true; 
                    } else {
                        $errorMessage = error_get_last()['message'];
                        echo $errorMessage;
                    }
?>